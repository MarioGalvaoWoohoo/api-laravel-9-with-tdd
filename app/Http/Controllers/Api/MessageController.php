<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Repository\Contracts\MessageRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\{Request, Response};
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class MessageController extends Controller
{
    protected $repository;

    public function __construct(MessageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function listAll()
    {
        try {
            $messages =  $this->repository->getAll();
            return response()->json([
                'message' => 'Listagem realizada com sucesso',
                'data' => MessageResource::collection($messages),
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => false,
            ], 404);
        }
    }

    public function messagesIsActive()
    {
        try {
            $messages =  $this->repository->getAllIsActive();
            return response()->json([
                'message' => 'Listagem realizada com sucesso',
                'data' => MessageResource::collection($messages),
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => false,
            ], 500);
        }
    }

    public function messagesOnTimeIsActive()
    {
        try {
            $messages =  $this->repository->messagesOnTimeIsActive();
            return response()->json([
                'message' => 'Listagem realizada com sucesso',
                'data' => MessageResource::collection($messages),
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => false,
            ], 500);
        }
    }

    public function unreadMessages(Request $request)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'user_id' => 'required|min:30',
            ]);

            if ($validatedData->fails()) {
                return response()->json($validatedData->errors(), 422);
            }

            $messages = $this->repository->unreadMessages($request->user_id);

            return response()->json([
                'message' => 'Listagem realizada com sucesso',
                'data' => $messages,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => false,
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'title' => 'required|min:20|max:150',
                'message' => 'required|min:50|max:255',
                'type' => 'required|integer',
                // 'status' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'user_id' => 'required'
            ]);

            if ($validatedData->fails()) {
                return response()->json($validatedData->errors(), 422);
            }

            $message = $this->repository->create($request->all());
            return response()->json([
                'message' => 'Cadastro realizado com sucesso',
                'data' => new MessageResource($message),
            ], 201);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => false,
            ], 404);
        }
    }

    public function update(Request $request, int $id)
    {
        try {

            $validatedData = Validator::make($request->all(), [
                'title' => 'required|min:20|max:150',
                'message' => 'required|min:50|max:255',
                'type' => 'required|integer',
                // 'status' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'user_id' => 'required'
            ]);

            if ($validatedData->fails()) {
                return response()->json($validatedData->errors(), 422);
            }

            $message = $this->repository->update($id, $request->all());
            return response()->json([
                'message' => 'Mensagem atualizada com sucesso!',
                'data' => new MessageResource($message),
            ], 201);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => false,
            ], 404);
        }

    }

    public function destroy(int $id)
    {
        try {
            $this->repository->delete($id);
            return response()->json([
                'message' => 'Mensagem removida com sucesso!',
                'data' => [],
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => false,
            ], 404);
        }

    }

    public function prioritizeMessage(Request $request)
    {
        try {
            $validatedData = Validator::make($request->all(), [
                'messageId' => 'required|integer',
            ]);

            if ($validatedData->fails()) {
                return response()->json($validatedData->errors(), 422);
            }

            $message = $this->repository->prioritizeMessage(1);

            return response()->json([
                'message' => 'Mensagem priorizada com sucesso',
                'data' => new MessageResource($message),
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => false,
            ], 422);
        }
    }

    public function viewMessagePriority()
    {
        try {
            $message =  $this->repository->findByMessagePrioritize();

            return response()->json([
                'message' => 'Listagem realizada com sucesso',
                'data' => $message !== null ? new MessageResource($message) : [],
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => false,
            ], 500);
        }
    }

    public function deprioritizeMessage()
    {
        try {
            return response()->json([
                'message' => 'Mensagem despriorizada com sucesso',
                'data' => $this->repository->deprioritizeAllMessage(),
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'data' => false,
            ], 500);
        }
    }
}
