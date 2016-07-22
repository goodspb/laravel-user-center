@extends('layouts.front.user')

@section('css')
    <link rel="stylesheet" href="{{ Config::get('app.cdn_url') }}plugins/select2/select2.min.css">
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
    @include('public/message')
    <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('user.menu_list.profile_edit') }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{ url('/user/profile') }}" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="username" class="col-sm-2 control-label">{{ trans('common.username') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="username" value="{{ $item->username }}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">{{ trans('common.email') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" value="{{ $item->email }}" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="col-sm-2 control-label">{{ trans('common.mobile') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="mobile" name="mobile"
                                   value="{{ $item->mobile }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nickname" class="col-sm-2 control-label">{{ trans('common.nickname') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nickname" name="nickname"
                                   value="{{ $item->profile->nickname }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sex" class="col-sm-2 control-label">{{ trans('common.sex') }}</label>
                        <div class="col-sm-10">
                            <select name="sex" class="form-control">
                                <option @if ('' === $sex = $item->profile->sex)) selected
                                        @endif value="">{{ trans('common.sex_select') }}</option>
                                <option @if (0 === $sex) selected @endif value="0">{{ trans('common.sex_0') }}</option>
                                <option @if (1 === $sex) selected @endif value="1">{{ trans('common.sex_1') }}</option>
                                <option @if (2 === $sex) selected @endif value="2">{{ trans('common.sex_2') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="avatar" class="col-sm-2 control-label">{{ trans('common.avatar') }}</label>
                        <div class="col-sm-10">
                            <label>
                                <img id="avatar-img" style="cursor: pointer" class="profile-user-img img-responsive img-circle pull-left" src="{{ $item->profile->avatar }}" alt="User profile picture">
                                <input id="avatar-input" type="hidden" name="avatar" value="{{ $item->profile->avatar }}" />
                                <input style="display: none" type="file" name="avatar-file" data-url="{{ url('user/avatar') }}" id="avatar" />
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-2 control-label">{{ trans('common.province') }}</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="province" id="province">
                                <option value="0">{{ trans('common.select') }}</option>
                                @foreach($provinces as $province)
                                    <option @if($province['id'] == $item->profile->province) selected @endif value="{{ $province['id'] }}">{{ $province['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-2 control-label">{{ trans('common.city') }}</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="city" id="city">
                                <option value="0">{{ trans('common.select') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-2 control-label">{{ trans('common.area') }}</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="area" id="area">
                                <option value="0">{{ trans('common.select') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-2 control-label">{{ trans('common.description') }}</label>
                        <div class="col-sm-10">
                            <textarea id="description" title="description" name="description" class="form-control">{{ $item->profile->description }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-2 control-label">{{ trans('common.password') }}</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation"
                               class="col-sm-2 control-label">{{ trans('common.password_confirmation') }}</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                                   value="">
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-info pull-right">{{ trans('common.edit') }}</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box -->
    </section>

@endsection

@section('js')
    <script type="text/javascript" src="{{ Config::get('app.cdn_url') }}plugins/AjaxFileUpload/jquery.ajaxfileupload.js"></script>
    <script src="{{ Config::get('app.cdn_url') }}plugins/select2/select2.full.min.js"></script>
    <script src="{{ Config::get('app.cdn_url') }}plugins/select2/i18n/zh-CN.js"></script>
    <script>
        $(function(){
            $('#avatar').AjaxFileUpload({
                action: $('#avatar').attr('data-url'),
                onComplete: function (filename, response) {
                    if (response.status == 'success') {
                        $('#avatar-img').attr('src', '/' + response.path + '?t=' + Math.random());
                        $('#avatar-input').val(response.path);
                    } else {
                        alert(response.msg);
                    }
                }
            });

            $('select').select2({
                placeholder: "{{ trans('common.role_select') }}",
                language: "zh-CN"
            });

            $('#province').change(function(){
                var $option = $(this).find("option:selected");
                getRegion('city',$option.val(),1,0);
            });

            $('#city').change(function() {
                var $option = $(this).find("option:selected");
                getRegion('area',$option.val(),2,0);
            });

            var provinceDefaultId = $('#province').find("option:selected").val();
            var cityDefaultId = {{ isset($item) ? (int)$item->profile->city : 0 }};
            var areaDefaultId = {{ isset($item) ? (int)$item->profile->area : 0}};
            if (provinceDefaultId > 0) {
                getRegion('city', provinceDefaultId, 1, cityDefaultId);
                if (cityDefaultId > 0) {
                    getRegion('area', cityDefaultId, 2, areaDefaultId);
                }
            }

        });

        function getRegion(_nextId, _pid, _type, _defalutId) {
            var $region = $('#'+_nextId);
            $region.html('<option value="0" selected>{{ trans('common.select') }}</option>');
            $.get('/user/region?type='+_type+'&pid='+_pid,function(data){
                if (data.status == 0) {
                    var _list = data.list;
                    if ($(_list).first().length != 0) {
                        $region.show();
                        $.each(_list, function(i,val){
                            $region.append('<option '+( val.id == _defalutId ? 'selected' : '' )+' value="'+val.id+'">'+val.name+'</option>');
                            $region.trigger('change.select2');
                        });
                    } else {
                        $region.hide();
                    }
                }
            });
        }
    </script>
@endsection