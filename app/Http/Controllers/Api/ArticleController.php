<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Resources\Article as ArticleResource;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(){
        $articles=Article::orderBy('id', 'DESC')->paginate(11);
        return ArticleResource::collection($articles);
    }
    public function show($id)
    {
        $article = Article::find($id);
        return new ArticleResource($article);
    }
    public function search($query)
    {
        if($query){
        $articles = Article::search($query)->paginate(11);
        return ArticleResource::collection($articles);}
            $articles=Article::orderBy('id', 'DESC')->paginate(11);
            return ArticleResource::collection($articles);

    }
}
