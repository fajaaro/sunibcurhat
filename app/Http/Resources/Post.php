<?php

namespace App\Http\Resources;

use App\Http\Resources\Comment as CommentResource;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'content' => $this->content,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
            'user' => new UserResource($this->whenLoaded('user')),
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
            'total_likes' => count($this->whenLoaded('likes')),
            'total_dislikes' => count($this->whenLoaded('dislikes')),
        ];
    }
}
