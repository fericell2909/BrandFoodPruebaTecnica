@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <label class="label label-primary">Solicita tu Pedido</label></div>

                    <div class="panel-body">
                    <component-listproduct></component-listproduct>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
