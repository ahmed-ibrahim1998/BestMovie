@extends('admin.layouts.master')
@section('css')
@section('title')
    {{trans('main_trans.user_management')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{trans('main_trans.users_permission')}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}" class="default-color">{{trans('main_trans.Home')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('main_trans.users_permission')}}</li>
                </ol>
            </div>
        </div>
    </div>
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                @can('add_permission')
                                <a href="{{route('roles.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true"><i class="fa fa-plus"></i>
                                    {{trans('Works_trans.add_permission')}}</a>
                                @endcan

                                <br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('Works_trans.Name')}}</th>
                                            <th>{{trans('Works_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($roles as $key => $role)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>
                                                    @can('edit_permission')
                                                        <a class="btn btn-primary btn-sm"
                                                           href="{{ route('roles.edit', $role->id) }}"
                                                           title="{{ trans('Works_trans.Edit') }}"><i
                                                                class="fa fa-edit"></i></a>
                                                    @endcan

                                                    @can('view_permission')
                                                        <a class="btn btn-success btn-sm"
                                                           href="{{ route('roles.show', $role->id) }}"
                                                           title="{{ trans('Works_trans.show') }}"><i
                                                                class="fa fa-eye"></i></a>
                                                    @endcan

                                                    @if ($role->name !== 'owner')
                                                        @can('delete_permission')
                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy',
                                                            $role->id], 'style' => 'display:inline']) !!}
                                                            {!! Form::submit('حذف', ['class' => 'btn btn-danger btn-sm']) !!}
                                                            {!! Form::close() !!}
                                                        @endcan
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
@endsection
