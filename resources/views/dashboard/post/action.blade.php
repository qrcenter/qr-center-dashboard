<meta name="csrf-token" content="{{ csrf_token() }}">

<a class="btn btn-info btn-sm text-white shadow"  href="{{ url('dashboard/post/'.$id) }}" >
<i class="fa fa-binoculars" aria-hidden="true"></i>
 عرض
</a>

<a class="btn btn-success btn-sm shadow" href="{{ url('dashboard/post/' . $id . '/edit') }}">
    <i class="fa fa-edit" aria-hidden="true"></i>
     تعديل
</a>

<a  class="btn btn-danger btn-sm text-white shadow delete-post" id="delete-post" data-id="{{ $id }}">
<i class="fa fa-trash-alt" aria-hidden="true"></i>
 حذف
</a>
