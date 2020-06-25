@extends('layouts.app')
@section('content')
  <div class="container">
      <h4> تعديل الفديو</h4><br/>
      <form method="post" action="{{route('video.update', $video->id)}}" enctype="multipart/form-data">
        @csrf
        <input name="_method" type="hidden" value="PATCH">

      <div class="form-group">
        <label for="title">العنوان</label>
        <input type="text" class="form-control" id="title" name="title" required  value="{{$video->title}}">
      </div>

      <div class="form-group">
        <label for="video_id">المعرف</label>
        <input class="form-control" id="description" name="video_id"required  value=" {{$video->video_id}}">
      </div>

          <button type="submit" class="btn btn-sm btn-primary  px-4">حفظ</button>
          <a href="{{route('video.index')}}" class="btn btn-sm btn-secondary  px-4">رجوع</a>
    </form>
  </div>
@endsection
