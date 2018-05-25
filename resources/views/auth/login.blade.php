@extends('layouts.app')

@section('content')
<div class="container h-100 justify-content-center align-self-center" style="padding-top: 10%; background-color: #3f3f3f;">
    <div class="row justify-content-center align-self-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-danger text-center">{{ __('Login') }}</div>

                <div class="card-body">
                    <form id="login_form"><!-- method="POST" action="{{ route('login') }}">-->
                        <!--@csrf-->

                        <!-- <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->
                         <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                                  <span>
                                        <strong id ="usernameError"></strong>
                                </span>          
                                <!-- @if ($errors->has('username'))
                                    <span  class="invalid-feedback">
                                        <strong id ="usernameError">HELLO{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif -->
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span  class="invalid-feedback">
                                        <strong id="passwordError">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-danger" style="display: none" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script type="text/javascript">


    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('#csrfMeta').attr('content')
        },
    });
    $('#login_form').on('submit', function(event){
        event.preventDefault();
        
        var postData = {
            "username": $('input[name=username]').val(),
            "password": $('input[name=password]').val(),
            "remember_token": $('input[name=remember]').is(':checked'),
        }
        $.ajax({
            type: 'POST',
            url: '/login',
            data: postData,
            success: function(response){
                window.location.href = "/home";
                $("#usernameError").text("Success");
            },
            error: function(response) {
                $("#usernameError").text(response.responseJSON.message);
            }
            
        })
    });
</script>
@endsection

