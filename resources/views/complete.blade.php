@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mt-3">Completa para confirmar orden</h1>
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <form action="">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" class="form-control mb-2">
                <div class="text-center">
                    <button class="btn btn-block btn-outline-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection