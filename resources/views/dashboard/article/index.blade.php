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
        <table class="table table-bordered table-image">
            <thead>
            <tr>
            <th>العنوان</th>
            <th>التاريخ</th>
            <th>الصورة</th>
            <th>العمليات</th>
            </tr>
            </thead>
            <tbody>
            <a class="btn  btn-sm btn-success m-2  px-4" href="{{route('article.create')}}">جديد</a>
            @foreach ($articles as $article)
                <tr>
                    <td>{{$article->title}}</td>
                    <td>{{$article->date}}</td>
                    <td class="w-25">
                        <img src="{{Storage::url($article->image_url)}}" class="img-fluid img-thumbnail" alt="Sheep">
                    </td>
                    <td>
                        <form class="delFrm" action="{{route('article.destroy',$article->id)}}" method="post">
                        <a  href="{{route('article.show', $article->id)}}" class="btn  btn-sm btn-primary mr-1">معاينة</a>
                        <a href="{{route('article.edit', $article->id)}}" class="btn  btn-sm btn-secondary">تعديل</a>
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger mx-1" type="submit">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $articles->links() !!}
        <script>
            $('.delFrm').on('submit',function (e) {
                e.preventDefault();
                let form=this;
                bootbox.confirm({
                    locale:'ar',
                    size: "small",
                    message: "هل انت متاكد؟",
                    buttons: {
                        confirm: {
                            label: 'تاكيد',
                            className: 'btn-sm btn-success px-4'
                        },
                        cancel: {
                            label: 'الغاء',
                            className: ' btn-sm btn-danger px-4'
                        }
                    },

                    callback: function (result) {
                        if(result===true){
                            form.submit();
                        }

                    }
                });

            });


        </script>
</div>
@endsection
