@extends('layouts.admin')

@section('title') {{ trans('admin.menu_list.role') }} @endsection

@section('css')
    <link rel="stylesheet" href="{{ Setting::get('cdn_url', '/') }}plugins/iCheck/all.css">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ trans('admin.menu_list.role_edit') }}
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <form id="save-perms-form">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">
                                {{ $role->display_name }}
                                <small>{{ $role->name }}</small>
                            </h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                            <?php $i = 1; ?>
                            @foreach($permissions as $permission)
                                <div class="form-group col-sm-3">
                                    <label data-toggle="tooltip" data-placement="bottom" title="{{ $permission->description }}">
                                        <input @foreach($role->perms as $perm) @if($perm->id == $permission->id) checked @endif @endforeach type="checkbox" class="minimal" name="perms[]" value="{{ $permission->id }}">
                                        &nbsp;
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @if($i % 4 == 0)
                            </div>
                            <div class="row">
                            @endif
                            <?php $i++; ?>
                            @endforeach
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="hidden" name="id" value="{{ $role->id }}" />
                            <button type="button" id="save-perms-btn" class="btn btn-info pull-right">{{ trans('common.save') }}</button>
                        </div>
                    </div>
                </form>
                <!-- /.box -->
            </div>
            <!-- /.col (right) -->
        </div>
        <!-- /.row -->
    </section>
@endsection

@section('js')
    <script src="{{ Setting::get('cdn_url', '/') }}plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function(){
            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
            $('#save-perms-btn').click(function() {
                $.post('{{ url('admin/role/permission') }}', $('#save-perms-form').serialize(), function(response) {
                    doAlert(response.msg);
                });
            });
        });
    </script>
@endsection
