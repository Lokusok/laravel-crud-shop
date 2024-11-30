<?php

namespace App\Http\Controllers\Api;

use App\Events\NewMessageEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\Message\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::all();

        return MessageResource::collection($messages);
    }

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
