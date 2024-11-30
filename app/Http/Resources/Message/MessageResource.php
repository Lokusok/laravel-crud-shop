<?php

namespace App\Http\Resources\Message;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class MessageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $response =  [
            'id' => $this->id,
            'content' => $this->content,
            'date' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'user' => [
                'name' => $this->user->name
            ],
        ];

        if (Auth::check()) {
            $response['from_me'] = $this->user->id === Auth::user()->id;
        }

        return $response;
    }
}
