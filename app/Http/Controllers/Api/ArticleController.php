<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        $articles = null;
        if ($request->tag && !$request->search) {
            $articles = Article::where('tag_id', $request->tag)->orderBy('id', 'DESC')->paginate(10);
        }
         elseif ($request->search) {
            $articles = Article::search($request->search)->paginate(10);
        }
        else {
            $articles = Article::latest()->paginate(10);
        }

        $current_page = $articles->currentPage();
        $last_page = $articles->lastPage();
        $total = $articles->total();
        return $this->apiResponse(ArticleResource::collection($articles), $current_page, $last_page, $total);
    }

    public function show($id)
    {
        $article = Article::find($id);
        if ($article) {
            return   $this->apiResponse(new ArticleResource($article));
        }
        return   $this->apiResponse(null);
    }

    // public function search($search)
    // {
    //     $articles = Article::search($search)->paginate(10);
    //     $current_page = $articles->currentPage();
    //     $last_page = $articles->lastPage();
    //     $total = $articles->total();
    //     return $this->apiResponse(ArticleResource::collection($articles), $current_page, $last_page, $total);
    // }
}
