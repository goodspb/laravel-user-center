@extends('layouts.admin')

@section('title') {{ trans('admin.menu_list.'.$type) }} @endsection

@section('content')

    <section class="content-header">
        <h1>
            {{ trans('admin.menu_list.'.$type) }}
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        @include('public/message')
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                @if (isset($item))
                <h3 class="box-title">{{ trans('admin.menu_list.'.$type.'_edit') }}
                    <small>{{ ucfirst($type) }} Id: {{ $item->id }}</small>
                </h3>
                @else
                    <h3 class="box-title">{{ trans('admin.menu_list.'.$type.'_add') }}</h3>
                @endif
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{{ isset($item) ? url('admin/'.$type.'/edit') :  url('admin/'.$type.'/add') }}" method="post">
                <div class="box-body">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">{{ trans('admin.'.$type.'.name') }}</label>
                        <div class="col-sm-10">
                            @if (isset($item))
                            <input type="text" class="form-control" id="name" value="{{ $item->name }}"
                                   readonly>
                            @else
                                <input type="text" class="form-control" id="name" name="{{ $type }}_name" value="{{ old($type.'_name') }}" >
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="display_name" class="col-sm-2 control-label">{{ trans('admin.'.$type.'.display_name') }}</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="display_name" name="{{ $type }}_display_name" value="{{ isset($item) ? $item->display_name : old($type.'_display_name') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-sm-2 control-label">{{ trans('admin.'.$type.'.description') }}</label>
                        <div class="col-sm-10">
                            <textarea id="description" title="description" name="{{ $type }}_description" class="form-control">{{ isset($item) ?  $item->description : old($type.'_description') }}</textarea>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    {{ csrf_field() }}
                    <button type="button" class="btn btn-cancel pull-left" onclick="location='{{ url('admin/'.$type.'/list') }}';">{{ trans('common.return') }}</button>
                    @if (isset($item))
                        <input type="hidden" name="id" value="{{ $item->id }}" />
                        <button type="submit" class="btn btn-info pull-right">{{ trans('common.edit') }}</button>
                    @else
                        <button type="submit" class="btn btn-success pull-right">{{ trans('common.add') }}</button>
                    @endif
                </div>
                <!-- /.box-footer -->
            </form>
        </div>
        <!-- /.box -->
    </section>

@endsection
