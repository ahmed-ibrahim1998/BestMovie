@extends('admin.layouts.app')
@section('content')
    <section class="flexbox-container">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
                <div class="card border-grey border-lighten-3 mt-5">
                    <div class="card-header border-0 mb-3">
                        <div class="card-title text-center">
                            <div class="p-1">
                                <img src="{{env('APP_URL').'public/assets/images/images.jpeg'}}" alt="LOGO"/>
                            </div>
                        </div>
                        <h3 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                            <span> {{__('auth.Login')}}</span>
                        </h3>
                    </div>

                    <div class="card-content">
                        <div class="card-body">
                            <form class="form-horizontal form-simple" action="{{route('login')}}" method="post"
                                  novalidate>
                                @csrf
                                <fieldset class="form-group position-relative has-icon-right mb-3">
                                    <input type="text" name="email" class="form-control form-control-lg input-lg text-right"
                                           value="" id="email" placeholder="{{__('auth.E-Mail_Address')}}">
                                    <div class="form-control-position">
                                        <i class="ft-user"></i>
                                    </div>
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </fieldset>
                                <fieldset class="form-group position-relative has-icon-right">
                                    <input type="password" name="password" class="form-control form-control-lg input-lg text-right"
                                           id="user-password"
                                           placeholder="{{__('auth.Password')}}">
                                    <div class="form-control-position">
                                        <i class="la la-key"></i>
                                    </div>
                                    @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </fieldset>
                                <div class="form-group row">
                                    <div class="col-md-6 col-12 text-center text-md-left">
                                        <fieldset>
                                            <input type="checkbox" name="remember_me" id="remember-me"
                                                   class="chk-remember ">
                                            <label for="remember-me">{{__('auth.Remember_Me')}}</label>
                                        </fieldset>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i>
                                    {{__('auth.login')}}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
