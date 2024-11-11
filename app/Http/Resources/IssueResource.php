<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IssueResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'reporter' => $this->reporter,
            'tester' => $this->tester,
            'executor' => $this->executor,
            'status' => $this->status,
            'type' => $this->type,
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
        ];
    }
}
