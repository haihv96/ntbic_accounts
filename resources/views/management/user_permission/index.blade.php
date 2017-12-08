@extends('layouts.dashboards.app')

@section('container')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">User Has Permissions</span>
                    </div>
                </div>
                <div class="portlet-body">
                    @include('shared.message')
                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="sample_1">
                        <thead>
                        <tr>
                            <th> STT</th>
                            <th> Email</th>
                            <th> Permissions</th>
                            <th> Sửa</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key => $item)
                            <tr class="odd gradeX">
                                <td>{{$key+1}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{ str_replace(array('[',']','"'),' ', $item->getAllPermissions($source_rpl)->pluck('name')) }}</td>
                                @if($sidebarView[$source_rpl]['user_permissions']['update'])
                                    <td class="center">
                                        <div><a class='edit'
                                                href="{{route('user-permissions.edit', ['source' => $source, 'id' => $item->id])}}"
                                                data-id="{{$item->id}}"><span class="fa fa-pencil-square"></span></a>
                                        </div>
                                    </td>
                                @endif
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