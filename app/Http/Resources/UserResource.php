<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->role,
            'is_verified' => $this->is_verified == 0 ? false : true ,
            'email_verified' => $this->email_verified == 0 ? false : true ,
            'phone_verified' => $this->phone_verified == 0 ? false : true ,
            'id_proof' => asset('storage/' .$this->id_proof_path) ?? null,
            'id_proof_status' => $this->id_proof_status,
            'id_proof_rejection_reason' => $this->id_proof_rejection_reason ?? null,
            'token' => $this->token,
        ];
    }
}
