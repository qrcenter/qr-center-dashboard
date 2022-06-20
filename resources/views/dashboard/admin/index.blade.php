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
    <table class="table table-bordered">
        <thead>
        <th>الاسم</th>
        <th>الايميل</th>
        <th>مدير</th>
        <th>محرر</th>
        <th>مستخدم</th>
        <th>العمليات</th>
        </thead>
        <tbody>
            <div class="row ">
                <div class="col-md-6">
                    <h5>المستخدمين</h5>

                </div>

                <div class="col-md-6 text-right">
                    <a class="btn  btn-sm btn-primary shadow mb-2" href="{{route('admin.create')}}"> <i class="fa fa-file" aria-hidden="true"></i>  أضافة جديد  </a>
                </div>
            </div>


        @foreach($users as $user)
            <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }} <input type="hidden" name="email" value="{{ $user->email }}"></td>
                    <td><input type="checkbox" {{ $user->hasRole('مدير') ? 'checked' : '' }} name="role_admin" onclick="return false;"></td>
                    <td><input type="checkbox" {{ $user->hasRole('محرر') ? 'checked' : '' }} name="role_author" onclick="return false;"></td>
                    <td><input type="checkbox" {{ $user->hasRole('مستخدم') ? 'checked' : '' }} name="role_user" onclick="return false;"></td>

                    <td class="d-flex">
                        <a  href="{{ route('admin.edit',$user->id)}}" class="btn  btn-sm btn-success mr-1">   <i class="fa fa-edit" aria-hidden="true"></i> تعديل</a>
                        <a href="{{ route('editPassword',$user->id)}}" class="btn  btn-sm btn-secondary">  <i class="fa fa-cog" aria-hidden="true"></i> تغير كلمة المرور</a>
                        <form class="delFrm" action="{{route('admin.destroy',$user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger mx-1" type="submit"><i class="fa fa-trash-alt" aria-hidden="true"></i> حذف</button>
                        </form>
                    </td>
            </tr>
        @endforeach
        </tbody>
    </table>
        {!! $users->links() !!}
    </div>
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
                        className: 'btn-sm btn-success px-2'
                    },
                    cancel: {
                        label: 'الغاء',
                        className: ' btn-sm btn-danger px-2'
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
@endsection
