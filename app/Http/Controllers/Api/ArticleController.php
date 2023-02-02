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
        $articles  = $this->getArticles($request);
        $currentPage = $articles->currentPage();
        $lastPage = $articles->lastPage();
        $total = $articles->total();
        return $this->apiResponse(ArticleResource::collection($articles), $currentPage, $lastPage, $total);
    }

    public function show($id)
    {
        $article = Article::find($id);
        if ($article) {
            return   $this->apiResponse(new ArticleResource($article));
        }
        return   $this->apiResponse(null);
    }

    private function getArticles(Request $request)
    {
        if ($request->search) {
            return Article::search($request->search)->paginate(12);
        }
        if ($request->tag) {
            return Article::where('tag_id', $request->tag)->orderBy('id', 'DESC')->paginate(12);
        }
    
        if ($request->exceptTag) {
            return Article::where('tag_id', '!=', $request->exceptTag)->orderBy('id', 'DESC')->paginate(12);
        }
        return Article::latest()->paginate(12);
    }
    // use ApiResponseTrait;

    // public function index(Request $request)
    // {
    //     $articles = null;
    //     if ($request->tag && !$request->search) {
    //         $articles = Article::where('tag_id', $request->tag)->orderBy('id', 'DESC')->paginate(12);
    //     }
    //      elseif ($request->search) {
    //         $articles = Article::search($request->search)->paginate(12);
    //     }
    //     else {
    //         $articles = $request->exceptTag ? Article::where('tag_id','!=', $request->exceptTag)->orderBy('id', 'DESC')->paginate(16):Article::latest()->paginate(16);
    //     }

    //     $current_page = $articles->currentPage();
    //     $last_page = $articles->lastPage();
    //     $total = $articles->total();
    //     return $this->apiResponse(ArticleResource::collection($articles), $current_page, $last_page, $total);
    // }

    // public function show($id)
    // {
    //     $article = Article::find($id);
    //     if ($article) {
    //         return   $this->apiResponse(new ArticleResource($article));
    //     }
    //     return   $this->apiResponse(null);
    // }

    // public function search($search)
    // {
    //     $articles = Article::search($search)->paginate(12);
    //     $current_page = $articles->currentPage();
    //     $last_page = $articles->lastPage();
    //     $total = $articles->total();
    //     return $this->apiResponse(ArticleResource::collection($articles), $current_page, $last_page, $total);
    // }
}
