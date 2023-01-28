@extends('layouts.app')
@section('content')
  <div class="container">
      <h4> تعديل منشور</h4><br/>
      <form method="post" action="{{route('post.update', $post->id)}}" enctype="multipart/form-data">
        @csrf
        <input name="_method" type="hidden" value="PATCH">
        <div class="form-group">
            <label for="tag">الاشارة</label>
            <select id="tag" name="tag" class="form-control" required>
                @foreach($tags as $tag)
                    <option
                    @if ($tag->id==$post->tag->id)
                        selected
                    @endif
                     value="{{$tag->id}}">{{$tag->name}}</option>
                    @endforeach
            </select>
        </div>
      <div class="form-group">
        <label for="title">العنوان</label>
        <input type="text" class="form-control" id="title" name="title" required  value="{{$post->title}}">
      </div>

     <div class="form-group">
        <label for="text">النص</label>
        <textarea class="form-control" id="description" name="text" rows="15">{{$post->text}}</textarea>
      </div>

          <div class="form-group">
              <label for="date">التاريخ</label>
              <input type="date" class="form-control" id="date" name="date" value="{{$post->date}}"/>
          </div>




              <div class="form-group">
              <img id="preview-image" src="{{Storage::url($post->image_url)}}" class="img-fluid img-thumbnail w-25">
              </div>
            
          <div class="form-group">
              <label for="img">الصوره</label>
              <input type="file" accept="image/*" id="img" name="img" value="{{Storage::url($post->image_url)}}">
          </div>

          <button type="submit" class="btn btn-sm btn-primary  px-4">حفظ</button>
          <a href="{{route('post.index')}}" class="btn btn-sm btn-secondary  px-4">رجوع</a>
    </form>
  </div>

  <script src="https://cdn.ckeditor.com/4.19.0/full/ckeditor.js"></script>
  <script type="text/javascript">
      $(document).ready(function () {

          CKEDITOR.replace( 'text', {
              language:'ar',
              //removeButtons:'Image,About,SpecialChar,Blockquote',

  });
  $('#img').change(function(){

let reader = new FileReader();

reader.onload = (e) => {

  $('#preview-image').attr('src', e.target.result);
}

reader.readAsDataURL(this.files[0]);

});
      });
  </script>
@endsection
