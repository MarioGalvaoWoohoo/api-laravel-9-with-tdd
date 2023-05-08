<?php

namespace Tests\Feature\App\Repository\Eloquent;

use App\Models\Message;
use App\Repository\Contracts\MessageRepositoryInterface;
use App\Repository\Eloquent\MessageRepository;
use App\Repository\Exceptions\NotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessageRepositoryTest extends TestCase
{
    protected $repository;

    protected function setUp(): void
    {
        $this->repository = new MessageRepository(new Message());

        parent::setUp();
    }

    public function test_implements_interface()
    {
        $this->assertInstanceOf(
            MessageRepositoryInterface::class,
            $this->repository
        );
    }

    public function test_find_all_empty()
    {
        $response = $this->repository->findAll();

        $this->assertIsArray($response);
        $this->assertCount(0, $response);
    }

    public function test_find_all()
    {
        Message::factory()->count(10)->create();

        $response = $this->repository->findAll();

        $this->assertCount(10, $response);
    }

    public function test_create()
    {
        $data = [
            'title' => 'Mensagem Exemplo para veriricação em testes',
            'message' => 'Titulo da Mensagem Para melhorar o conteúdo melhorar o conteúdo melhorar o conteúdo',
            'type' => 2,
            'start_date' => '2023-04-01',
            'end_date' => '2023-04-30',
            'user_id' => 1
        ];

        $response = $this->repository->create($data);

        $this->assertNotNull($response);
        $this->assertIsObject($response);
        $this->assertDatabaseHas('messages', [
            'title' => 'Mensagem Exemplo para veriricação em testes',
        ]);
    }

    public function test_create_exception()
    {
        $this->expectException(QueryException::class);

        $data = [
            'title' => 'Mensagem Exemplo para veriricação em testes',
            'message' => 'Titulo da Mensagem Para melhorar o conteúdo melhorar o conteúdo melhorar o conteúdo'
        ];

        $this->repository->create($data);
    }

    public function test_update()
    {
        $message = Message::factory()->create();

        $data = [
            'title' => 'Mensagem Exemplo para veriricação em testes atualizado',
        ];

        $response = $this->repository->update($message->id, $data);

        $this->assertNotNull($response);
        $this->assertIsBool($response);
        $this->assertDatabaseHas('messages', [
            'title' => 'Mensagem Exemplo para veriricação em testes atualizado',
        ]);
    }

    public function test_delete()
    {
        $message = Message::factory()->create();

        $deleted = $this->repository->delete($message->id);

        $this->assertTrue($deleted);
        $this->assertDatabaseMissing('messages', [
            'id' => $message->id
        ]);
    }

    public function test_find()
    {
        $message = Message::factory()->create();

        $response = $this->repository->findById($message->id);

        $this->assertIsObject($response);
    }

    // public function test_find_not_found()
    // {
    //     $this->expectException(NotFoundException::class);

    //     $this->repository->findById(9999);
    //     // $this->assertNull($response);
    // }
}
