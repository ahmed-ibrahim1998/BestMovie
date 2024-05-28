@extends('admin.layouts.master')
@section('css')
@section('title')
    {{ trans('main_trans.warehouse') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.warehouse') }}
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
                                <a href="{{route('returnReceipts.create')}}" class="btn btn-success btn-sm"
                                   role="button"
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
                                            <th>{{ trans('educations_trans.returnInvoiceNumber') }}</th>
                                            <th>{{ trans('educations_trans.partialReturnInvoiceNumber') }}</th>
                                            <th>{{ trans('educations_trans.returnItemNumber') }}</th>
                                            <th>{{ trans('educations_trans.partialReturnItemNumber') }}</th>
                                            <th>{{ trans('educations_trans.invoiceValue') }}</th>
                                            <th>{{ trans('educations_trans.goodsValue') }}</th>
                                            <th>{{ trans('educations_trans.cash') }}</th>
                                            <th>{{ trans('educations_trans.conversionsValue') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>
                                        @foreach ($returnReceipts as $returnReceipt)
                                            <?php  $distributionBacks = App\Models\DistributionsBack::where('driver_id', $returnReceipt->driver_id)->get()  ?>

                                            <tr>
                                                <?php $i++; ?>
                                                <td>{{ $i }}</td>
                                                <td>{{$returnReceipt->driveris->name }}</td>
                                                <td>{{ $returnReceipt->current_time }}</td>
                                                <td>{{ $returnReceipt->backdistribution->returnInvoiceNumber }}</td>
                                                <td>{{ $returnReceipt->backdistribution->partialReturnInvoiceNumber }}</td>
                                                <td>{{ $returnReceipt->backdistribution->returnItemNumber }}</td>
                                            <td>{{ $returnReceipt->backdistribution->partialReturnItemNumber }}</td>
                                            <td>{{ $returnReceipt->backdistribution->invoiceValue }}</td>
                                            <td>{{ $returnReceipt->backdistribution->goodsValue }}</td>
                                            <td>{{ $returnReceipt->backdistribution->cash }}</td>
                                            <td>{{ $returnReceipt->backdistribution->conversionsValue }}</td>
                                                  
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
