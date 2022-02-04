@extends('layouts/fullLayoutMaster')

@section('title', 'Certificación')

@section('content')
    <style>
        label {
            margin: 10px 0px;
        }

    </style>
    <center>
        <h1>Consultar Certificado</h1>
    </center>

    <div class="card" id="pagina_uno">
        <div class="card-header">

        </div>
        <form method="post" action="{{ URL::to('vercertificado') }}" id="env_form">
                @csrf
        <div class="card-content collapse show" aria-expanded="true">
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">¡Error!<i class="fa fa-check"></i></h4>

                        <p class="mb-0">
                            No se encontro el registro en la base de datos.
                        </p>
                    </div>
                @endif                
                <div class="row">                    

                    {{-- DATOS --}}
                    <div class="col-md-12"><br>
                        <h4>No. de documento</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="documento" name="documento" required>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-info" style="float: right;">Consultar <i
                    class="fa fa-floppy-o"></i></button>
            <!-- <button type="button" class="btn btn-info" onclick="anterior(3);"><i class="feather icon-arrow-left"></i> anterior</button>  -->
        </div>
    </form>
    </div>

@endsection