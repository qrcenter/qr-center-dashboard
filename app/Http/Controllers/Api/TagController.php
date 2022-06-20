<?php

namespace App\Http\Controllers\Api;

use App\Enums\TagTypeEnum;
use App\Models\Tag;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Http\Resources\TypeResource;

class TagController extends Controller
{
    use ApiResponseTrait;
    public function index($type)
    {
        $tags = Tag::where('type', $type)->get();

        return $this->apiResponse(TagResource::collection($tags));
    }
    // public function show($id)
    // {
    //     $Tag = Tag::find($id);
    //     return $this->apiResponse(new TagResource($Tag));
    // }
    public function types()
    {
        $tagTypes = TagTypeEnum::cases();
        return $this->apiResponse(TypeResource::collection($tagTypes));
    }
}
