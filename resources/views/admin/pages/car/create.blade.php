@extends('admin.layouts.master')
@section('css')
@section('title')
    {{ trans('educations_trans.add_car') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('educations_trans.add_car') }}
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
                            <form action="{{route('cars.store','test')}}" method="POST" id="form">
                                <!-- add_form -->
                                @csrf
                                <div class="row font-weight-bold">
                                    <div class="col">
                                        <label for="type"
                                               class="mr-sm-2 text-bold">{{ trans('educations_trans.type_ar') }}
                                            :</label>
                                        <input type="text" class="form-control" name="type_ar"
                                               value="{{old('type')}}"/>
                                        @error('type')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="specialize_en"
                                               class="mr-sm-2 text-bold">{{ trans('educations_trans.type_en') }}
                                            :</label>
                                        <input type="text" class="form-control" name="type_en"
                                               value="{{old('type_en')}}"/>
                                        @error('specialize_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row font-weight-bold">
                                    <div class="col">
                                        <label
                                            for="scientific_side"
                                            class="mr-sm-2 text-bold">{{trans('educations_trans.model')}}</label>
                                        <input type="text" class="form-control" name="model"
                                               value="{{old('model')}}"/>
                                        @error('model')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label
                                            for="scientific_side"
                                            class="mr-sm-2 text-bold">{{trans('educations_trans.color')}}</label>
                                        <input type="text" class="form-control" name="color"
                                               value="{{old('color')}}"/>
                                        @error('color')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br><br>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success"
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
@endsection
