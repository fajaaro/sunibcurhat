<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'campus_id' => $this->campus_id,
            'username' => $this->username,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'birthdate' => $this->birthdate,
            'gender' => $this->gender,
            'created_at' => (string)$this->created_at,
            'updated_at' => (string)$this->updated_at,
            'campus' => $this->whenLoaded('campus'),  
            'avatar' => $this->whenLoaded('avatar'),
            'posts' => $this->whenLoaded('posts'),    
            'comments' => $this->whenLoaded('comments'),    
        ];
    }
}
