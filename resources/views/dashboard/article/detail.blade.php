@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>التفاصيل</h3>
        <hr>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">


        <div class="form-group">
          <strong>العنوان: </strong>
        {{$article->title}}
        </div>
        <div class="form-group">
          <strong>النص: </strong>
          {!!$article->text!!}
        </div>
        <div class="form-group">
          <strong>التأريخ: </strong>
          {!!$article->date!!}
        </div>
        <div class="form-group w-25">
          <strong>الصوره: </strong>
          <img src="{{Storage::url($article->image_url)}}" class="img-fluid img-thumbnail" alt="Sheep">
        </div>
      </div>
      <div class="col-md-12">
        <a href="{{route('article.edit', $article->id)}}" class="btn  btn-sm btn-primary px-4">تعديل</a>
        <a href="{{route('article.index')}}" class="btn btn-sm btn-secondary px-4">رجوع</a>
      </div>
    </div>
  </div>
@endsection
