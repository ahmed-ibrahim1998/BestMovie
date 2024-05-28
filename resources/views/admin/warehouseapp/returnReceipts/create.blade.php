@extends('admin.layouts.master')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<style>
    span.select2.select2-container.select2-container--classic{
        width: 100% !important;
    }
</style>
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
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{route('returnReceipts.store','test')}}" method="POST" id="form">
                                <!-- add_form -->
                                @csrf
                                <div class="row font-weight-bold">
                                    <div class="col">
                                        <label for="inputName"
                                               class="control-label">{{ trans('educations_trans.driver_name') }}</label>
                                        <select name="back_distributions_id" class="custom-select searchable_list">
                                            <!--placeholder-->
                                            <option value="">اختر</option>
                                        
                                            @foreach ($distributionBacks as $distribution)
                                                    <option data-drivermid="{{ $distribution->distributionBack->id }}"
                                                        value="{{ $distribution->id }}">
                                                        {{ $distribution->distributionBack->name }}
                                                    </option>
                                            @endforeach

                                            
                                        </select>
                                        @error('back_distributions_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div><br>
                                <div class="row font-weight-bold distrbutiondata" style="display:none">
                                    <div class="col" >
                                        <label for="returnInvoiceNumber" class="control-label">{{ trans('educations_trans.returnInvoiceNumber') }}</label>
                                        <div class="alert alert-primary" id="returnInvoiceNumber"></div>
                                    </div>
                                    <div class="col" >
                                        <label for="partialReturnInvoiceNumber" class="control-label">{{ trans('educations_trans.partialReturnInvoiceNumber') }}</label>
                                        <div class="alert alert-primary" id="partialReturnInvoiceNumber"></div>
                                    </div>
                                    
                                </div>
                                <div class="row font-weight-bold distrbutiondata" style="display:none">
                                    <div class="col" >
                                        <label for="returnItemNumber" class="control-label">{{ trans('educations_trans.returnItemNumber') }}</label>
                                        <div class="alert alert-primary" id="returnItemNumber"></div>
                                    </div><div class="col" >
                                        <label for="partialReturnItemNumber" class="control-label">{{ trans('educations_trans.partialReturnItemNumber') }}</label>
                                        <div class="alert alert-primary" id="partialReturnItemNumber"></div>
                                    </div>
                                </div>
                                <div class="row font-weight-bold distrbutiondata" style="display:none">
                                    <div class="col" >
                                        <label for="invoiceValue" class="control-label">{{ trans('educations_trans.invoiceValue') }}</label>
                                        <div class="alert alert-primary" id="invoiceValue"></div>
                                    </div><div class="col" >
                                        <label for="goodsValue" class="control-label">{{ trans('educations_trans.goodsValue') }}</label>
                                        <div class="alert alert-primary" id="goodsValue"></div>
                                    </div>
                                </div>
                                <div class="row font-weight-bold distrbutiondata" style="display:none">
                                    <div class="col" >
                                        <label for="cash" class="control-label">{{ trans('educations_trans.cash') }}</label>
                                        <div class="alert alert-primary" id="cash"></div>
                                    </div><div class="col" >
                                        <label for="conversionsValue" class="control-label">{{ trans('educations_trans.conversionsValue') }}</label>
                                        <div class="alert alert-primary" id="conversionsValue"></div>
                                    </div>
                                </div>

                                <br><br>
                                <div class="modal-footer">
                                   <input type="hidden" name="driver_id" id="driver_id">
                                   <input type="hidden" name="upload_goods_id" id="upload_goods_id">
                                    <button type="submit" class="btn btn-success" disabled="disabled" 
                                            id="ajaxSubmit">{{ trans('educations_trans.Submit') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
    $(document).ready(function () {
        $('#form').submit(function() {
            $("#ajaxSubmit").attr("disabled", true);
        });
        $('select[name="back_distributions_id"]').on('change', function () {
            var distributionBackID = $(this).val();
            // var distributionBackID = $(this).find(':selected').data('drivermid');
            // var distributionBackID = $(this).find(':selected').attr('data-drivermid');
            if (distributionBackID) {
                $.ajax({
                    url: "{{ URL::to('Get_ReturnReceipts') }}/" + distributionBackID,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $.each(data, function (key, value) {
                            console.log(value);
                            console.log(value.driver_id);
                            $("#returnInvoiceNumber").html(value.returnInvoiceNumber);
                            $("#partialReturnInvoiceNumber").html(value.partialReturnInvoiceNumber);
                            $("#returnItemNumber").html(value.returnItemNumber);
                            $("#partialReturnItemNumber").html(value.partialReturnItemNumber);
                            $("#invoiceValue").html(value.invoiceValue);
                            $("#cash").html(value.cash);
                            $("#conversionsValue").html(value.conversionsValue);
                            $("#goodsValue").html(value.goodsValue);
                            $("#upload_goods_id").val(value.upload_goods_id);
                            $("#driver_id").val(value.driver_id);
                            $(".distrbutiondata").show();
                            $("#ajaxSubmit").prop('disabled', false);
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
                $("#ajaxSubmit").prop('disabled', true);
                $(".distrbutiondata").hide();
            }
        });
    });
    $('.searchable_list').select2();
</script>
@endsection
