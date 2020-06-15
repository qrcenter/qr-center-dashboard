@extends('layouts.app')
@section('content')
  <div class="container">
      <h4> تعديل مقالة</h4><br/>
      <form method="post" action="{{route('article.update', $article->id)}}" enctype="multipart/form-data">
        @csrf
        <input name="_method" type="hidden" value="PATCH">

      <div class="form-group">
        <label for="title">العنوان</label>
        <input type="text" class="form-control" id="title" name="title" required  value="{{$article->title}}">
      </div>

      <div class="form-group">
        <label for="text">النص</label>
        <textarea class="form-control" id="description" name="text">{{$article->text}}</textarea>
      </div>

          <div class="form-group">
              <label for="date">التاريخ</label>
              <input type="date" class="form-control" id="date" name="date" value="{{$article->date}}"/>
          </div>
              <div class="form-group">
              <img src="{{Storage::url($article->image_url)}}" class="img-fluid img-thumbnail w-25" alt="Sheep">
              </div>

          <div class="form-group">
              <label for="img">الصوره</label>
              <input type="file" name="img" value="{{Storage::url($article->image_url)}}">
          </div>

          <button type="submit" class="btn btn-sm btn-primary  px-4">حفظ</button>
          <a href="{{route('article.index')}}" class="btn btn-sm btn-secondary  px-4">رجوع</a>
    </form>
  </div>
@endsection
@section('js')
    <script src="https://cdn.ckeditor.com/4.14.0/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('text', {
            language: 'ar',
            removeButtons:'About',
        });
    </script>
@endsection
