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
    <a class="btn  btn-sm btn-primary shadow mb-2" href="{{route('video.create')}}"> <i class="fa fa-file" aria-hidden="true"></i>  جديد  </a>
    <table class="table table-bordered data-table table-image" >
        <thead>
        <tr id="">
            <th width="5%">التسلسل</th>
            <th width="20%">العنوان</th>
            <th width="20%">المعرف</th>
            <th width="20%">العمليات</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function () {

        var table = $('.data-table').DataTable({
            language: {url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Arabic.json'},
            processing: true,
            serverSide: true,
            ajax: "{{ route('video.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'title', name: 'title'},
                {data: 'video_id', name: 'video_id'},
                {data: 'action', name: 'action', orderable: false, searchable: false},

            ]
        });

        $('body').on('click', '#delete-video', function () {
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
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
                        $.ajax({
                            type: "DELETE",
                            url: "video/"+id,
                            data: {
                                "id": id,
                                "_token": token,
                            },
                            success: function (data) {
                                bootbox.alert({
                                    locale: 'ar',
                                    size: 'small',
                                    message: "تم الحذف بنجاح",

                                });

                                table.ajax.reload();
                            },
                            error: function (data) {
                                console.log('Error:', data);
                            }
                        });
                    }

                }
            });


        });

    });

</script>
@endsection