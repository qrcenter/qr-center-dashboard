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
            "id" => $this->id,
            "title" => $this->title,
            "text" => $this->text,
            "date" => $this->date,
            "image_url" => $this->image_url,
            "image_name" => $this->image_name,
            "tag" => new TagResource($this->tag),

        ];
    }
}
