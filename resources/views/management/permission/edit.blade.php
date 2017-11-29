@extends('layouts.dashboards.app')

@section('container')
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject font-dark sbold uppercase">Edit permission</span>
                </div>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                <form action="{{route('permissions.update', ['source' => $source, 'id' => $permission->id])}}" method="POST" id="editForm" class="form-horizontal">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <div class="form-body">
                        @include('shared.error')
                        @include('shared.message')
                        <div class="form-group">
                            <label class="control-label col-md-3">Permission
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="name" data-required="1" class="form-control" value="{{$permission->name}}" required/> </div>
                        </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">Sửa</button>
                                <a class="btn default cancel" href="{{route('permissions.index', ['source' => $source])}}">Hủy</a>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>
</div>
@endsection