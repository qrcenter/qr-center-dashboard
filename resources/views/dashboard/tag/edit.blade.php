@extends('layouts.app')
@section('content')
  <div class="container">
      <h4> تعديل الاشارة</h4><br/>
      <form method="post" action="{{route('tag.update', $tag->id)}}" enctype="multipart/form-data">
        @csrf
        <input name="_method" type="hidden" value="PATCH">

        <div class="form-group">
            <label for="type">النوع</label>
            <select id="type" name="type" class="form-control" required>
                @foreach($types as $type)
                    <option
                    @if ($type->value==$tag->type->value)
                    selected
                    @endif

                    value="{{$type->value}}">{{$type->name}}</option>
                    @endforeach
            </select>
        </div>

      <div class="form-group">
        <label for="title">الاسم</label>
        <input type="text" class="form-control" id="name" name="name" required  value="{{$tag->name}}">
      </div>

          <button type="submit" class="btn btn-sm btn-primary  px-4">حفظ</button>
          <a href="{{route('tag.index')}}" class="btn btn-sm btn-secondary  px-4">رجوع</a>
    </form>
  </div>
@endsection
