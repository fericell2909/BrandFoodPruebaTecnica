@extends('layouts.app')

@section('content')
<div class="container" >
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default " >
                <div class="panel-heading ">Iniciar Sesion</div>

                <div class="panel-body ">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo Electronico</label>

                            <div class="col-md-6 ">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordarme
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Iniciar Sesion
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                        <label>Olvidaste tu Contraseña? </label>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    body
    {
        background-image: url('/img/login.jpg');
    }
    body::before{
    content: "";
    display: block;
    position: absolute;
    z-index: -1;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: #005bea;
    background: -webkit-linear-gradient(bottom, #005bea, #00c6fb);
    background: -o-linear-gradient(bottom, #005bea, #00c6fb);
    background: -moz-linear-gradient(bottom, #005bea, #00c6fb);
    background: linear-gradient(bottom, #005bea, #00c6fb);
    opacity: 0.9;
}
label{
    color: white;
}
.titulo_heading
{
    color : #00c6fb !important;
}
</style>
