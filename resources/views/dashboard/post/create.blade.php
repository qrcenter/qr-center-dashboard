@extends('layouts.app')
@section('content')
  <div class="container">
    <h4>أضافة منشور جديد</h4><br/>
    <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
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

      {{-- <div class="form-group">
        <label for="text">النص</label>
          <textarea class="form-control" id="text" name="text" rows="15"></textarea>
      </div> --}}
        <div class="form-group">
            <label for="date">التاريخ</label>
            <input type="date" class="form-control" id="date" name="date" />
        </div>
        <div class="form-group">
            <label for="img">الصوره</label>
            <input type="file" accept="image/*" name="img">
        </div>
      <button type="submit" class="btn btn-sm btn-primary px-4">حفظ</button>
        <a href="{{route('post.index')}}" class="btn btn-sm btn-secondary px-4">الغاء</a>
    </form>
  </div>
@endsection
