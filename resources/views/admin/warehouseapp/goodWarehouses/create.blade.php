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
                            <form action="{{route('goodsUploads.store','test')}}" method="POST" id="form">
                                <!-- add_form -->
                                @csrf
                                <div class="row font-weight-bold">
                                    <div class="col">
                                        <label for="inputName"
                                               class="control-label">{{ trans('educations_trans.driver_name') }}</label>
                                        <select name="driver_id" class="custom-select searchable_list" required>
                                            <!--placeholder-->
                                            <option value="">اختر</option>
                                            
                                            @foreach ($driver_has_car_no_upload as $driver)
                                                @if( !empty($driver->goodsuploadgood) && empty($driver->goodwarehouse) )
                                                <option value="{{ $driver->id }}" data-uploadgoodid="@if(!empty( $driver->goodsuploadgood)){{ $driver->goodsuploadgood->id }}@endif">
                                                    {{ $driver->name }}
                                                </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('driver_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br><br>
                                <div class="modal-footer">
                                    <input type="hidden" name="uploadgoodid" id="uploadgoodid" >
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
            $('select[name="driver_id"]').on('change', function () {
                var uploadgoodid = $(this).find(':selected').attr('data-uploadgoodid');
                $('#uploadgoodid').val(uploadgoodid);
                $("#ajaxSubmit").attr("disabled", false);
            });
            $('#form').submit(function() {
                $("#ajaxSubmit").attr("disabled", true);
            });
        });
        $('.searchable_list').select2();
</script>
@endsection
