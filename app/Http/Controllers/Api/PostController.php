<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;

class PostController extends Controller
{

    use ApiResponseTrait;
    public function index(Request $request)
    {
        $posts = null;
        if ($request->tag && !$request->search) {
            $posts = Post::where('tag_id', $request->tag)->paginate(12);
      }

      elseif ($request->search) {
        $posts = Post::search($request->search)->paginate(12);
    }

      else {
            $posts = Post::latest()->paginate(12);
        }


        $current_page = $posts->currentPage();
        $last_page = $posts->lastPage();
        $total = $posts->total();
        return $this->apiResponse(PostResource::collection($posts), $current_page, $last_page, $total);
    }
    public function show($id)
    {
        $post = Post::find($id);
        if ($post) {
            return   $this->apiResponse(new PostResource($post));
        }
        return   $this->apiResponse(null);
    }

    // public function search($search)
    // {
    //     $posts = Post::search($search)->paginate(12);
    //     $current_page = $posts->currentPage();
    //     $last_page = $posts->lastPage();
    //     $total = $posts->total();
    //     return $this->apiResponse(PostResource::collection($posts), $current_page, $last_page, $total);
    // }

}
