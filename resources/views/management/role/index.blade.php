@extends('layouts.dashboards.app')

@section('container')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase"> Roles</span>
                    </div>
                </div>
                <div class="portlet-body">
                    @if($sidebarView[$source_rpl]['role_permissions']['store'])
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <a id="create" class="btn sbold green btn-outline"
                                           href="{{route('roles.create', ['source' => $source])}}"><span
                                                    class="fa fa-pencil"></span> Create Role</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @include('shared.message')
                    <table class="table table-striped table-bordered table-hover table-checkable order-column"
                           id="sample_1">
                        <thead>
                        <tr>
                            <th> STT</th>
                            <th> Roles</th>
                            <th> Permissions</th>
                            <th> Sửa</th>
                            <th> Xóa</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $key => $item)
                            <tr class="odd gradeX">
                                <td>{{$key+1}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{ str_replace(array('[',']','"'),' ', $item->permissions()->pluck('name')) }}</td>
                                @if($sidebarView[$source_rpl]['role_permissions']['update'])
                                    <td class="center">
                                        <div><a class='edit'
                                                href="{{route('roles.edit', ['source' => $source, 'id' => $item->id])}}"
                                                data-id="{{$item->id}}"><span class="fa fa-pencil-square"></span></a>
                                        </div>
                                    </td>
                                @endif

                                @if($sidebarView[$source_rpl]['role_permissions']['destroy'])
                                    <td class="center"><a class="delete-modal" data-toggle="modal" href="#small"
                                                          data-id="{{$item->id}}"><span
                                                    class="fa fa-trash-o"></span></a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $roles->links() !!}
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
    <div class="modal fade bs-modal-sm" id="small" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Xóa role</h4>
                </div>
                <div class="modal-body">
                    <form>
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        Bạn chắc chắn muốn xóa role?
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="button" id="delete" class="btn red">Delete</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection