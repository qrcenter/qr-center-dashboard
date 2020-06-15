@extends('layouts.app')
@section('content')
  <div class="container">
    <h4>أضافة مقالة جديده</h4><br/>
    <form method="post" action="{{route('article.store')}}" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="title">العنوان</label>
        <input type="text" class="form-control" id="title"  name="title" required>
      </div>

      <div class="form-group">
        <label for="text">النص</label>
          <textarea class="form-control" id="text" name="text"></textarea>
      </div>
        <div class="form-group">
            <label for="date">التاريخ</label>
            <input type="date" class="form-control" id="date" name="date" />
        </div>
        <div class="form-group">
            <label for="img">الصوره</label>
            <input type="file" name="img">
        </div>
      <button type="submit" class="btn btn-sm btn-primary px-4">حفظ</button>
        <a href="{{route('article.index')}}" class="btn btn-sm btn-secondary px-4">الغاء</a>
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
