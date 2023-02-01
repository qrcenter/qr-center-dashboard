<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\TagTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:مستخدم,مدير,محرر');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            return Datatables::of(Article::latest()->with('tag'))
                ->addIndexColumn()
                ->addColumn('action', 'dashboard.article.action')
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.article.index');
    }
    public function create()
    {
        $tags = Tag::where('type', TagTypeEnum::مقال->value)->get();
        return view('dashboard.article.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $article = new Article;

        if ($request->hasfile('img')) {
            $storagePath = Storage::put("public/assets", $request->file('img'));
            $article->image_url = $storagePath;
            $article->image_name = basename($storagePath);
        }
        $article->title = $request->get('title');
        $article->text = $request->get('text');
        $article->date = $request->get('date');
        $article->tag_id = $request->get('tag');

        $article->save();
        return redirect()->route('article.create')->with(['success' => 'تمت اضافة المقال بنجاح']);
    }
    public function show($id)
    {
        $article = Article::find($id);
        $tags = Tag::all();
        return view('dashboard.article.detail', compact('article', 'tags'));
    }

    public function edit($id)
    {
        $article = Article::find($id);
        $tags = Tag::where('type', TagTypeEnum::مقال->value)->get();
        return view('dashboard.article.edit', compact('article', 'id', 'tags'));
    }


    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        if ($request->hasfile('img')) {
            Storage::delete($article->image_url);
            $storagePath = Storage::put("public/assets", $request->file('img'));
            $article->image_url = $storagePath;
            $article->image_name = basename($storagePath);
        }

        $article->title = $request->get('title');
        $article->text = $request->get('text');
        $article->date = $request->get('date');
        $article->tag_id = $request->get('tag');

        $article->save();
        return redirect()->route('article.index')->with('success', 'تم التعديل المقال بنجاح');
    }


    public function destroy($id)
    {
        $article = Article::find($id);

        if ($article->image_url != null) {
            Storage::delete($article->image_url);
        }
        return Response::json($article->delete());
    }
}
