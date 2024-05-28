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
                            <form action="{{ route('returnReceipts.update', 'test') }}" method="post">
                                {{ method_field('patch') }}
                                @csrf
                                <div class="row font-weight-bold">
                                    <input type="hidden" class="form-control" name="id" value="{{$returnReceipt->id}}"/>
                                    <div class="col">
                                        <label for="inputName"
                                               class="control-label">{{ trans('educations_trans.type') }}</label>
                                        <select name="car_id"
                                                class="custom-select"
                                                onclick="console.log($(this).val())">
                                            <!--placeholder-->
                                            <option value="">اختر</option>
                                            @foreach (App\Models\Car::all() as $car)
                                                <option
                                                    value="{{ $car->id }}">
                                                    {{ $car->type }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('car_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="inputName"
                                               class="control-label">{{ trans('educations_trans.driver_name') }}</label>
                                        <select name="driver_id"
                                                class="custom-select"
                                                onclick="console.log($(this).val())">
                                            <!--placeholder-->
                                            <option value="">اختر</option>
                                            @foreach (App\User::where('roles_name', '["Drivers"]')->get() as $car)
                                                <option
                                                    value="{{ $car->id }}"{{($car->id == $returnReceipt->driver_id) ? 'selected':''}}>
                                                    {{ $car->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('driver_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row font-weight-bold">
                                    <div class="col">
                                        <label for="item_number"
                                               class="mr-sm-2 text-bold">{{ trans('educations_trans.item_number_returns') }}
                                            :</label>
                                        <input type="number" class="form-control" name="item_number_returns"
                                               value="{{$returnReceipt->item_number_returns}}"/>
                                        @error('item_number_returns')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="item_number_partial"
                                               class="mr-sm-2 text-bold">{{ trans('educations_trans.item_number_partial') }}
                                            :</label>
                                        <input type="number" class="form-control" name="item_number_partial"
                                               value="{{$returnReceipt->item_number_partial}}"/>
                                        @error('item_number_partial')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br><br>
                                <div class="modal-footer">
                                    <button type="submit"
                                            class="btn btn-success">{{ trans('educations_trans.Submit') }}</button>
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
