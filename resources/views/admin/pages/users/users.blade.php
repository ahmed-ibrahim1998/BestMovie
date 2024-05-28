@extends('admin.layouts.master')
@section('css')
@section('title')
    {{trans('main_trans.users_management')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{trans('main_trans.users_management')}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}"
                                                   class="default-color">{{trans('main_trans.Home')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('main_trans.users_management')}}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        @if ($errors->any())
            <div class="error">{{ $errors->first('Name') }}</div>
        @endif

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @can('add_user')
                        <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-plus"></i>
                            {{ trans('Works_trans.add_user') }}
                        </button>
                    @endcan
                    <br><br>

                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('Works_trans.user_name')}}</th>
                                <th>{{trans('Works_trans.email')}}</th>
                                <th>{{ trans('educations_trans.status') }}</th>
                                <th>{{trans('Works_trans.user_type')}}</th>
                                <th>{{ trans('Works_trans.Processes') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach ($data as $key => $user)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <button class="btn btn-link p-0 change" type="submit"
                                                data-id="{{ $user->id }}">
                                            @if ($user->status == 'Active')
                                                <span
                                                    class="fa fa-toggle-on text-success p-1 @if($user->status == 'Active') checked @endif"> صح</span>
                                            @else
                                                <span class="fa fa-toggle-off text-muted p-1"> خطأ</span>
                                            @endif
                                        </button>
                                        <div id="alert-message"></div>
                                    </td>
                                    <td>
                                        @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $v)
                                                @if($v=='owner')
                                                    <label class="badge badge-success">{{ $v }}</label>
                                                @elseif($v=='Drivers')
                                                    <label class="badge badge-info">{{ $v }}</label>
                                                @elseif($v=='Logistics')
                                                    <label class="badge badge-primary">{{ $v }}</label>
                                                @elseif($v=='Warehouses')
                                                    <label class="badge badge-warning">{{ $v }}</label>
                                                @elseif($v=='Balances')
                                                    <label class="badge badge-dark">{{ $v }}</label
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @can('edit_user')
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                    data-target="#edit{{ $user->id }}"
                                                    title="{{ trans('Works_trans.Edit') }}"><i class="fa fa-edit"></i>
                                            </button>
                                        @endcan
                                        @can('delete_user')
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete{{ $user->id }}"
                                                    title="{{ trans('Works_trans.Delete') }}"><i
                                                    class="fa fa-trash"></i></button>
                                        @endcan
                                    </td>
                                </tr>
                                <!-- edit_modal_Grade -->
                                <div class="modal fade" id="edit{{ $user->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('Works_trans.edit_Users') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- add_form -->
                                                <form action="{{ route('users.update',$user->id) }}" method="post">
                                                    {{ method_field('patch') }}
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="Name">{{ trans('Works_trans.user_name') }}
                                                                :</label>
                                                            <input id="name" type="text" value="{{ $user->name }}"
                                                                   name="name" class="form-control" required>
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                                   value="{{ $user->id }}">
                                                        </div>
                                                        <div class="col">
                                                            <label
                                                                for="email">{{ trans('Works_trans.email') }}
                                                                :</label>
                                                            <input id="email" type="text" value="{{ $user->email }}"
                                                                   name="email" class="form-control" required/>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label
                                                            for="exampleFormControlTextarea1">{{ trans('Works_trans.password') }}
                                                            :</label>

                                                        <input id="password" type="password"
                                                               name="password" class="form-control" required/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label
                                                            for="exampleFormControlTextarea1">{{ trans('Works_trans.password_confirmation') }}
                                                            :</label>
                                                        <input id="confirm-password" type="password"
                                                               name="confirm-password" class="form-control" required/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label
                                                            for="exampleFormControlTextarea1">{{ trans('Works_trans.user_status') }}
                                                        </label>
                                                        <select class="form-control form-control-lg"
                                                                id="exampleFormControlSelect1" name="Status">
                                                            <option value="{{ $user->Status}}">{{ $user->Status}}</option>
                                                            <option value="Active">Active</option>
                                                            <option value="Not Active">Not Active</option>
                                                        </select>
                                                    </div>
                                                    @php
                                                        $user = App\User::find($user->id);
                                                        $roles =  Spatie\Permission\Models\Role::pluck('name','name')->all();
                                                        $userRole = $user->roles->pluck('name','name')->all();
                                                    @endphp
                                                    <div class="form-group">
                                                        <label>{{ trans('Works_trans.user_type') }}</label>
                                                        {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple'))!!}
                                                    </div>
                                                    <br><br>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('Works_trans.Close') }}</button>
                                                <button type="submit"
                                                        class="btn btn-success">{{ trans('Works_trans.submit') }}</button>
                                            </div>
                                            {!! Form::close() !!}

                                        </div>
                                    </div>
                                </div>
                    </div>

                    <!-- delete_modal_Grade -->
                    <div class="modal fade" id="delete{{ $user->id }}" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                        id="exampleModalLabel">
                                        {{ trans('Works_trans.delete_Users') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('users.destroy', 'test') }}" method="post">
                                        {{ method_field('Delete') }}
                                        @csrf
                                        {{ trans('Works_trans.Warning_Users') }}
                                        <input id="id" type="hidden" name="id" class="form-control"
                                               value="{{$user->id}}">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ trans('Works_trans.Close') }}</button>
                                            <button type="submit"
                                                    class="btn btn-danger">{{ trans('Works_trans.submit') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    </table>
                </div>

                <!-- add_modal_Grade -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                    id="exampleModalLabel">
                                    {{ trans('Works_trans.add_Users') }}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- add_form -->
                                <form action="{{ route('users.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <label for="Name"
                                                   class="mr-sm-2">{{ trans('Works_trans.user_name') }}
                                            </label>
                                            <input type="text" class="form-control" name="name"
                                                   value="{{old('name')}}"/>
                                        </div>
                                        <div class="col">
                                            <label for="email"
                                                   class="mr-sm-2">{{ trans('Works_trans.email') }}
                                            </label>
                                            <input type="text" class="form-control" name="email"
                                                   value="{{old('email')}}"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password"
                                               class="mr-sm-2">{{ trans('Works_trans.password') }} </label>
                                        <input type="password" class="form-control" name="password"
                                               value="{{old('password')}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="password_confirmation"
                                               class="mr-sm-2">{{trans('Works_trans.password_confirmation')}}
                                        </label>
                                        <input type="password" class="form-control" name="confirm-password"
                                               value="{{old('confirm-password')}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label
                                            for="exampleFormControlTextarea1">{{ trans('Works_trans.user_status') }}
                                        </label>
                                        <select class="form-control form-control-lg"
                                                id="exampleFormControlSelect1" name="Status" value="{{old('Status')}}">
                                            <option value="Active">Active</option>
                                            <option value="Not Active">Not Active</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1"
                                               class="form-label">{{trans('main_trans.user_roles')}}</label>
                                        {!! Form::select('roles_name[]', $roles,[], array('class' => 'form-control','multiple','id'=>'multipleroles_id')) !!}
                                    </div>
                                    <br><br>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ trans('Works_trans.Close') }}</button>
                                <button type="submit"
                                        class="btn btn-success">{{ trans('Works_trans.submit') }}</button>
                            </div>
                            </form>
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
                url: "{{ URL::to('users/change-status') }}/" + id,
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
