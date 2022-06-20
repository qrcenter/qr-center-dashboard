<meta name="csrf-token" content="{{ csrf_token() }}">
<a class="btn btn-success btn-sm shadow" href="{{ url('dashboard/video/' . $id . '/edit') }}">
    <i class="fa fa-edit" aria-hidden="true"></i>
     تعديل
</a>

<a  class="btn btn-danger btn-sm text-white shadow delete-video" id="delete-video" data-id="{{ $id }}">
<i class="fa fa-trash-alt" aria-hidden="true"></i>
 حذف
</a>
