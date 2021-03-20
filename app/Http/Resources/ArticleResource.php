<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'createdOn' => $this->created_at->isoFormat('LLLL'),
            'lastUpdated' => $this->updated_at->isoFormat('LLLL'),
            'categories' => CategoryResource::collection($this->categories),
        ];
    }
}
