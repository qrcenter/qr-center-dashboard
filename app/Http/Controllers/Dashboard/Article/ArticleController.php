<?php

namespace App\Http\Controllers\Dashboard\Article;

use App\Http\Controllers\Controller;
use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:مستخدم,مدير,محرر');
    }

    public function index()
    {
        $articles=Article::paginate(5);
        return view('dashboard.article.index',compact('articles'));
    }


    public function create()
    {
        return view('dashboard.article.create');
    }

    public function store(Request $request)
    {
        $article= new Article;

        if($request->hasfile('img'))
        {
            $storagePath =Storage::put("public/assets", $request->file('img'));
            $article->image_url =$storagePath;
            $article->image_name = basename($storagePath);
        }
        $article->title=$request->get('title');
        $article->text=$request->get('text');
        $article->date=$request->get('date');

        $article->save();
        return redirect('dashboard/article')->with('success', 'تمت الأضافه بنجاح');
    }
    public function show($id)
    {
        $article = Article::find($id);
        return view('dashboard.article.detail',compact('article'));
    }


    public function edit($id)
    {
        $article = Article::find($id);
        return view('dashboard.article.edit',compact('article','id'));
    }


    public function update(Request $request, $id)
    {
        $article= Article::find($id);

        if($request->hasfile('img'))
        {
            Storage::delete($article->image_url);
            $storagePath =Storage::put("public/assets", $request->file('img'));
            $article->image_url =$storagePath;
            $article->image_name = basename($storagePath);
        }

        $article->title=$request->get('title');
        $article->text=$request->get('text');
        $article->date=$request->get('date');

        $article->save();
        return redirect('dashboard/article')->with('success', 'تم التعديل بنجاح');
    }


    public function destroy($id)
    {
        $article = Article::find($id);

        if($article->image_url!=null)
        {
          Storage::delete($article->image_url);
        }
        $article->delete();
        return redirect('dashboard/article')->with('success','تم الحذف بنجاح');
    }
}
