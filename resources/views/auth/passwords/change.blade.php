@extends('layouts.app')
@section('content')
    <div class="container">
        @if (Session::has('success'))
            <div class="row justify-content-center">
            <div class="col-md-8">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            </div>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">تغير كلمة المرور</div>

                   <div class="card-body">

                        <form method="POST" action="{{ route('changePassword') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="new-password" class="col-md-4 control-label">كلمة المرور الحاليه</label>

                                <div class="col-md-6">
                                    <input id="current-password" type="password" class="form-control @error('current-password') is-invalid @enderror" name="current-password" required>
                                    @error('current-password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="new-password" class="col-md-4 control-label">كلمة المرور الجديده</label>

                                <div class="col-md-6">
                                    <input id="new-password" type="password" class="form-control @error('new-password') is-invalid @enderror" name="new-password" required>
                                    @error('new-password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="new-password-confirm" class="col-md-4 control-label">تاكيد كلمة المرور الجديده</label>

                                <div class="col-md-6">
                                    <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-sm btn-primary px-4">
                                        {{ __('حفظ') }}
                                    </button>
                                    <a class="btn btn-sm btn-secondary px-4" href="{{route('admin.index')}}">رجوع</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection