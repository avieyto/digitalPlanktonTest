<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TokenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->token->id,
            'client_id' => $this->token->client_id,
            'name' => $this->token->name,
            'scopes' => $this->token->scopes,
            'created_at' => $this->token->created_at,
            'expires_at' => $this->token->expires_at,
            'accessToken' => $this->accessToken
        ];
    }
}
