@extends('layouts.app')
@section('content')
  <div class="container">
  @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    <h4>أضافة فديو جديده</h4><br/>
    <form method="post" action="{{route('video.store')}}" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="tag">الاشارة</label>
        <select id="tag" name="tag" class="form-control" required>
            <option selected disabled></option>
            @foreach($tags as $tag)
                <option value="{{$tag->id}}">{{$tag->name}}</option>
                @endforeach
        </select>
    </div>
      <div class="form-group">
        <label for="title">العنوان</label>
        <input type="text" class="form-control" id="title"  name="title" required>
      </div>

      <div class="form-group">
        <label for="video_id">المعرف</label>
          <input type="text" class="form-control" id="video_id" name="video_id" required>
      </div>
      <button type="submit" class="btn btn-sm btn-primary px-4">حفظ</button>
        <a href="{{route('video.index')}}" class="btn btn-sm btn-secondary px-4">الغاء</a>
    </form>
  </div>
@endsection
