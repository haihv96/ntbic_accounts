@extends('layouts.dashboards.app')

@section('container')
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">User Has Roles</span>
                </div>
            </div>
            <div class="portlet-body">
                @include('shared.message')
                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                    <thead>
                        <tr>
                            <th> STT </th>
                            <th> Email</th>
                            <th> Roles </th>
                            <th> Sửa </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $key => $item)
                            <tr class="odd gradeX">
                                <td>{{$key+1}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{ str_replace(array('[',']','"'),' ', $item->getRoleNames($source_rpl)) }}</td>             
                                <td class="center"><div ><a class='edit' href="{{route('user-roles.edit', ['source' => $source, 'id' => $item->id])}}" data-id="{{$item->id}}"><span class="fa fa-pencil-square"></span></a></div></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $users->links() !!}
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
@endsection