@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('login') }}" class="navbar-brand" style=" text-transform: uppercase;position: absolute;right: 10px; top: 18px;">Iniciar Sesion</a></li>
        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-default" >
                    <div class="panel-heading titulo_heading">
                        <img src="/img/new_user.png" style="width: 100px;" alt="Avatar de Login">
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nombre</label>

                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control text-center" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Correo Electronico</label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control text-center" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Clave</label>

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control text-center" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-12 control-label">Confirmar Clave</label>

                                <div class="col-md-12">
                                    <input id="password-confirm" type="password" class="form-control text-center" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Registrarse
                                    </button>
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
.container
{
    display: block;
    text-align: center;
    justify-content: flex-end;

}
</style>
