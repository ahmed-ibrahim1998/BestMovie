@extends('admin.layouts.master')
@section('css')
@section('title')
    {{trans('educations_trans.show')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('educations_trans.show')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row font-weight-bold">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('goodsUploads.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{ trans('educations_trans.add_data') }}</a>
                                <a href="{{route('dashboard')}}" class="btn btn-info btn-sm text-left" role="button"
                                   aria-pressed="true">{{ trans('educations_trans.back') }}</a> <br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('educations_trans.driver_name') }}</th>
                                            <th>{{ trans('educations_trans.current_time') }}</th>
                                            <th>{{ trans('educations_trans.date') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>
                                        @foreach($GoodWarehouses as $GoodWarehouse)
                                            <tr>
                                                <?php $i++; ?>
                                                <td>{{ $i }}</td>
                                                <td>{{$GoodWarehouse->drivers->name }}</td>
                                                    <td>{{ $GoodWarehouse->current_time }}</td>
                                                    <td>{{ $GoodWarehouse->created_at->format('Y-m-d')}} </td>
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
