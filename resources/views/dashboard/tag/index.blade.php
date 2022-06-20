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
        <div class="row ">
            <div class="col-md-6">
                <h5>الاشارات</h5>

            </div>

            <div class="col-md-6 text-right">
                <a class="btn  btn-sm btn-primary shadow mb-2" href="{{route('tag.create')}}"> <i class="fa fa-file" aria-hidden="true"></i>  أضافة جديد  </a>
            </div>
        </div>




    <table class="table table-bordered data-table table-image" >
        <thead>
        <tr id="">
            <th >التسلسل</th>
            <th >الاسم</th>
            <th >النوع</th>
            <th >العمليات</th>
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
            ajax: "{{ route('tag.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'type', name: 'type'},
                {data: 'action', name: 'action', orderable: false, searchable: false},

            ]
        });

        $('body').on('click', '#delete-tag', function () {
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
                            url: "tag/"+id,
                            data: {
                                "id": id,
                                "_token": token,
                            },
                            success: function (data) {

                                bootbox.alert({
                                    locale: 'ar',
                                    size: 'small',
                                    message: data.message,

                                });

                                table.ajax.reload();
                            },
                            error: function (data) {
                                bootbox.alert({
                                    locale: 'ar',
                                    size: 'small',
                                    message: data.responseJSON.message,

                                });
                            }
                        });
                    }

                }
            });


        });

    });

</script>
@endsection
