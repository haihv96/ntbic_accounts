@extends('layouts.dashboards.app')

@section('container')
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject font-dark sbold uppercase">Sửa user</span>
                </div>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                <form action="{{url('management/users/'.$user->id)}}" method="POST" id="editForm" class="form-horizontal" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-body">
                        @include('shared.error')
                        @include('shared.message')
                        <div class="form-group">
                            <label class="control-label col-md-3">Email
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="email" data-required="1" class="form-control" value="{{$user->email}}" required/>
                                <span class="required"> {{$errors->first('email')}}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tên người dùng
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-4">
                                <input type="text" name="name" data-required="1" class="form-control" value="{{$user->name}}" required/>
                                <span class="required"> {{$errors->first('name')}}</span>
                            </div>
                        </div>              
                        <div class="form-group">
                                <label for="exampleInputFile" class="col-md-3 control-label">Avatar
                                </label>
                                <div class="col-md-9">
                                    <input type="file" name="image" class="form-control" value="{{old('hinh_anh')}}" multiple>
                                    <span class="required"> {{$errors->first('image')}}</span>
                                </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">Sửa</button>
                                <a class="btn default cancel" href="{{route('users.index')}}">Hủy</a>
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