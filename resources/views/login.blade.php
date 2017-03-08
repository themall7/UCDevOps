@extends ('layouts.plane')
@section ('body')
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
            <br /><br /><br />
               @section ('login_panel_title','Please Sign In')
               @section ('login_panel_body')
                        <form role="form" action="login" method="post">
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                            <fieldset>
                                <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" value="{{Input::old('email')}}" autofocus>
                                    <label class="control-label" for="inputError">{{ $errors->first('email') }}</label>
                                </div>
                                <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                    <label class="control-label" for="inputError">{{ $errors->first('password') }}</label>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                @if (Session::get('message'))
                                <div class="alert alert-danger " role="alert">
                                    <i class="fa fa-remove"></i> {{Session::get('message')}}
                                </div>
                                @endif
                                <!-- Change this to a button or input when using this as a form -->
                                <!--<a href="{{ url ('') }}" class="btn btn-lg btn-success btn-block">Login</a>-->
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Login">
                            </fieldset>
                        </form>
                    
                @endsection
                @include('widgets.panel', array('as'=>'login', 'header'=>true))
            </div>
        </div>
    </div>
@stop