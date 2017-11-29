@extends('layouts.dashboards.app')

@section('container')
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject font-dark sbold uppercase">Update User Permissions</span>
                </div>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                <form action="{{route('user-permissions.update', ['source' => $source, 'id' => $user->id])}}" method="POST" id="editForm" class="form-horizontal">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <div class="form-body">
                        @include('shared.error')
                        @include('shared.message')
                        <div class="form-group">
                            <label class="control-label col-md-3">Email
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="email" data-required="1" class="form-control" value="{{$user->email}}" disabled />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Permissions
                                <span class="required"> * </span>
                            </label>
                            <div class="input-group col-md-8" style="border: 1px solid #c2cad8;padding: 6px 12px;margin-left:15px;">
                            <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible="1" data-rail-color="white" data-handle-color="gray">
                                <div class="icheck-list">
                                    @foreach($permissions as $item)
                                        @if($user->hasPermissionViaRole($source_rpl, $item))
                                            <label class="col-md-6">
                                                <input type="checkbox" class="icheck" value="{{$item->name}}" checked disabled> {{$item->name}}
                                            </label>                                        
                                        @elseif($user->hasPermissionTo($source_rpl, $item))
                                            <label class="col-md-6">
                                                <input type="checkbox" class="icheck" name="permissions[]" value="{{$item->name}}" checked> {{$item->name}}
                                            </label>
                                        @else
                                            <label class="col-md-6">
                                                <input type="checkbox" class="icheck" name="permissions[]" value="{{$item->name}}"> {{$item->name}}
                                            </label>
                                        @endif
                                    @endforeach
                                </div>
                            </div></div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">Submit</button>
                                <a class="btn default" href="{{route('user-permissions.index', ['source' => $source])}}">Cancel</a>
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