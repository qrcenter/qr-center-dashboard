@extends('layouts.app')
@section('content')
    <div class="container">
        <h4>أضافة مقالة جديده</h4><br />
        <form method="post" action="{{ route('article.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="tag">الاشارة</label>
                <select id="tag" name="tag" class="form-control" required>
                    <option selected disabled></option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="title">العنوان</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="text">النص</label>
                <textarea class="edit form-control" id="text" name="text" rows="15"></textarea>
            </div>
            <div class="form-group">
                <label for="date">التاريخ</label>
                <input type="date" class="form-control" id="date" name="date" required />
            </div>
            
            <div class="form-group">
                <img id="preview-image"  class="img-fluid img-thumbnail w-25">
                </div>

            <div class="form-group">
                <label for="img">الصوره</label>
                <input type="file" accept="image/*" id="img" name="img" required>
            </div>

            <button type="submit" class="btn btn-sm btn-primary px-4">حفظ</button>
            <a href="{{ route('article.index') }}" class="btn btn-sm btn-secondary px-4">الغاء</a>
        </form>
    </div>
    <script src="https://cdn.ckeditor.com/4.19.0/full/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            CKEDITOR.replace('text', {
                language: 'ar',
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
