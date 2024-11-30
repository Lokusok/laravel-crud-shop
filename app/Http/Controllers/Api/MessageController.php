<?php

namespace App\Http\Controllers\Api;

use App\Events\NewMessageEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\Message\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
