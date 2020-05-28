<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Resources\Article as ArticleResource;

class ArticleController extends Controller
{
    public function index(){
        $articles=Article::orderBy('id', 'DESC')->paginate(6);
        return ArticleResource::collection($articles);
    }
    public function show($id)
    {
        $article = Article::find($id);
        return new ArticleResource($article);
    }
}
