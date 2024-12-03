<?php

namespace App\Http\Controllers\Api;

use App\Events\NewMessageEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\Message\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use OpenApi\Attributes as OA;

class MessageController extends Controller
{
    #[OA\Get(path: "/api/community/messages", tags: ["Messages"])]
    #[OA\Response(
        response: '200',
        description: 'List of messages',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: "data", type: "array", items: new OA\Items(
                    type: "object",
                    properties: [
                        new OA\Property(property: "id", type: "number", example: 1),
                        new OA\Property(property: "content", type: "string", example: "Lorem ipsum dolot sit amet"),
                        new OA\Property(property: "date", type: "string", example: "2024-11-30 08:22:13"),
                        new OA\Property(property: "user", type: "object", properties: [
                            new OA\Property(property: "name", type: "string", example: "Lokusok")
                        ])
                    ]
                ))
            ]
        )
    )]
    public function index()
    {
        $messages = Message::all();

        return MessageResource::collection($messages);
    }

    #[OA\Post(path: "/api/community/messages", tags: ["Messages"])]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: "content", type: "string", example: "Text of the message")
            ]
        )
    )]
    #[OA\Response(
        response: '200',
        description: 'Save message',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: "data", type: "object", properties: [
                    new OA\Property(property: "id", type: "number", example: 1),
                    new OA\Property(property: "content", type: "string", example: "Lorem ipsum dolot sit amet"),
                    new OA\Property(property: "date", type: "string", example: "2024-11-30 08:22:13"),
                    new OA\Property(property: "user", type: "object", properties: [
                        new OA\Property(property: "name", type: "string", example: "Lokusok")
                    ])
                ])
            ]
        )
    )]
    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => ['required', 'string', 'min:10']
        ]);

        $data['user_id'] = Auth::user()->id;

        $message = Message::query()->create($data);

        broadcast(new NewMessageEvent($message))->toOthers();

        return MessageResource::make($message);
    }

    #[OA\Delete(path: '/api/community/messages/{message}', tags: ['Messages'])]
    #[OA\Parameter(
        name: 'message',
        in: 'path',
        required: true,
        description: 'ID сообщения для удаления',
    )]
    #[OA\Response(
        response: '200',
        description: 'Destroy message',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: "message", type: "string", example: "Success delete")
            ]
        )
    )]
    public function destroy(Message $message)
    {
        if (! Gate::allows('delete-message', $message)) {
            return response([
                'message' => __('Недостаточно прав для удаления сообщения')
            ], 403);
        }

        $message->delete();

        return response([
            'message' => __('Сообщение успешно удалено')
        ], 200);
    }
}
