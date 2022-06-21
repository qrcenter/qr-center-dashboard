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
            <strong>الاشارة: </strong>
          {{$post->tag->name}}
          </div>
        <div class="form-group">
          <strong>العنوان: </strong>
        {{$post->title}}
        </div>
        {{-- <div class="form-group">
          <strong>النص: </strong>
          {!!$post->text!!}
        </div> --}}
        <div class="form-group">
          <strong>التأريخ: </strong>
          {!!$post->date!!}
        </div>
        <div class="form-group w-25">
          <strong>الصوره: </strong>
          <img src="{{Storage::url($post->image_url)}}" class="img-fluid img-thumbnail" alt="Sheep">
        </div>
      </div>
      <div class="col-md-12">
        <a href="{{route('post.edit', $post->id)}}" class="btn  btn-sm btn-primary px-4">تعديل</a>
        <a href="{{route('post.index')}}" class="btn btn-sm btn-secondary px-4">رجوع</a>
      </div>
    </div>
  </div>
@endsection
