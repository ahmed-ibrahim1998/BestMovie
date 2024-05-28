@extends('admin.layouts.master')
@section('css')
@section('title')
    {{ trans('main_trans.area') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.area') }}
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
                            <form action="{{route('areas.store','test')}}" method="POST" id="form">
                                <!-- add_form -->
                                @csrf
                                <div class="row font-weight-bold">
                                    <div class="col">
                                        <label for="name"
                                               class="mr-sm-2 text-bold">{{ trans('educations_trans.area_name_ar') }}
                                            :</label>
                                        <input type="text" class="form-control" name="name_ar"
                                               value="{{old('name_ar')}}"/>
                                        @error('name_ar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="name_en"
                                               class="mr-sm-2 text-bold">{{ trans('educations_trans.area_name_en') }}
                                            :</label>
                                        <input type="text" class="form-control" name="name_en"
                                               value="{{old('name_en')}}"/>
                                        @error('name_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="number"
                                               class="mr-sm-2 text-bold">{{ trans('educations_trans.number') }}
                                            :</label>
                                        <input type="number" class="form-control" name="number"
                                               value="{{old('number')}}"/>
                                        @error('number')
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
