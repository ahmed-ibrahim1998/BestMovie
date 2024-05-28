@extends('admin.layouts.master')
@section('css')
@section('title')
    {{trans('main_trans.Cars')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.Cars')}}
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
                                <a href="{{route('cars.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{ trans('educations_trans.add_car') }}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('educations_trans.type') }}</th>
                                            <th>{{ trans('educations_trans.model') }}</th>
                                            <th>{{ trans('educations_trans.color') }}</th>
                                            <th>{{trans('Works_trans.user_status')}}</th>
                                            <th>{{ trans('educations_trans.Processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>
                                        @foreach ($cars as $car)
                                            <tr>
                                                <?php $i++; ?>
                                                <td>{{ $i }}</td>
                                                <td>{{ $car->type }}</td>
                                                <td>{{ $car->model }}</td>
                                                <td>{{ $car->color }}</td>
                                                <td>
                                                    <button class="btn btn-link p-0 change" type="submit"
                                                            data-id="{{ $car->id }}">
                                                        @if ($car->status == 1)
                                                            <span
                                                                class="fa fa-toggle-on text-success p-1 @if($car->status == 1) checked @endif"> Active</span>
                                                        @else
                                                            <span
                                                                class="fa fa-toggle-off text-danger p-1"> Not Active</span>
                                                        @endif
                                                    </button>
                                                    <div id="alert-message"></div>
                                                </td>
                                                <td>
                                                    <a href="{{route('cars.edit',$car->id)}}"
                                                       class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                            class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#delete_driver{{ $car->id }}"
                                                            title="{{ trans('educations_trans.Delete') }}"><i
                                                            class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="delete_driver{{$car->id}}"
                                                 tabindex="-1"
                                                 role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{route('cars.destroy','test')}}"
                                                          method="post">
                                                        {{method_field('delete')}}
                                                        {{csrf_field()}}
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;"
                                                                    class="modal-title"
                                                                    id="exampleModalLabel">{{ trans('educations_trans.delete_car') }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p> {{ trans('educations_trans.Warning_car') }}</p>
                                                                <input type="hidden" name="id"
                                                                       value="{{$car->id}}">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">{{ trans('educations_trans.Close') }}</button>
                                                                    <button type="submit"
                                                                            class="btn btn-danger">{{ trans('educations_trans.Submit') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
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
    <script>

        $(".change").click(function () {
            var id = $(this).data("id");

            $.ajax({
                url: "{{ URL::to('cars/change-status') }}/" + id,
                type: 'put',
                dataType: "JSON",
                data: {
                    "id": id,
                    "_method": 'put',
                    "_token": "{{ csrf_token() }}",
                },
                success: function () {
                    console.log("it Work");
                    $('#alert-message').html(success);
                }

            });
            location.reload();
        });
    </script>
@endsection
