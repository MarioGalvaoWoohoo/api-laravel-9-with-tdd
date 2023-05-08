<?php

namespace App\Repository\Eloquent;

use Carbon\Carbon;
use App\Models\Message;
use Illuminate\Database\Eloquent\Model;
use App\Repository\Contracts\MessageRepositoryInterface;

class MessageRepository implements MessageRepositoryInterface
{
    protected $model;

    public function __construct(Message $message)
    {
        $this->model = $message;
    }

    public function findAll(): array
    {
        return $this->model->all()->toArray();
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function findById(int $id): ?Model
    {
        return $this->model->find($id);
    }

    public function findByMessagePrioritize(): ?Model
    {
        $message = $this->model
            ->where('priority', 1)
            ->first();

        if ($message) {
            return $message;
        } else {
            return null;
        }
    }

    public function deprioritizeAllMessage(): bool
    {
        return $this->model->where('priority', 1)->update(['priority' => 0]);
    }

    public function prioritizeMessage($messageId): Model
    {
        $this->deprioritizeAllMessage();
        $this->model->where('id', $messageId)->update(['priority' => 1]);
        return $this->model->find($messageId);
    }

    public function update(int $id, array $data): bool
    {
        return $this->model->find($id)->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->model->find($id)->delete();
    }

    public function getAllIsActive(): array
    {
        return $this->model->where('status', 1)->get();
    }

    public function unreadMessages(string $userId): array
    {
        $now = Carbon::now();

        $messages = $this->model
            ->select('id', 'title', 'message', 'priority', 'type', 'start_date', 'end_date')
            ->whereRaw('? between start_date and end_date', [$now->format('Y-m-d')])
            ->where('status', 1)
            ->with(['messages_viewed' => function ($query) use ($userId) {
                $query->where('unknown_user', $userId);
            }])
            ->get()
            ->map(function ($message) {
                $isRead = $message['is_read'] || !empty($message['messages_viewed']);
                unset($message['messages_viewed']);
                $hasPriority = $message['priority'] == 1 ? true : false;
                return array_merge($message->toArray(), ['is_read' => $isRead, 'priority' => $hasPriority]);
            });

        return $messages;
    }

    public function messagesOnTimeIsActive(): array
    {
        $now = Carbon::now();
        return $this->model->where('status', 1)->whereRaw('? between start_date and end_date', [$now->format('Y-m-d')])->get();
    }

    public function checkDisplayedMessage($messageId): bool
    {
        $now = Carbon::now();

        $message = $this->model
            ->where('id', $messageId)
            ->where('status', 1)
            ->whereRaw('? between start_date and end_date', [$now->format('Y-m-d')])
            ->first();

        if ($message) {
            return true;
        } else {
            return false;
        }
    }

    public function checkIfMessageIsActive($messageId): bool
    {
        $message = $this->model->where('id', $messageId)->whereRaw('status', 1)->first();

        if ($message) {
            return true;
        } else {
            return false;
        }
    }

}
