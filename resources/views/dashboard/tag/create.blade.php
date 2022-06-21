@extends('layouts.app')
@section('content')
  <div class="container">
    <h4>أضافة اشارة جديده</h4><br/>
    <form method="post" action="{{route('tag.store')}}" enctype="multipart/form-data">
      @csrf

        <div class="form-group">
            <label for="type">النوع</label>
            <select id="type" name="type" class="form-control" required>
                <option selected disabled></option>
                @foreach($types as $type)
                    <option value="{{$type->value}}">{{$type->name}}</option>
                    @endforeach
            </select>
        </div>

      <div class="form-group">
        <label for="name">الاسم</label>
        <input type="text" class="form-control" id="name"  name="name" required>
      </div>


      <button type="submit" class="btn btn-sm btn-primary px-4">حفظ</button>
        <a href="{{route('tag.index')}}" class="btn btn-sm btn-secondary px-4">الغاء</a>
    </form>
  </div>
@endsection
