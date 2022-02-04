@extends('layouts/contentLayoutMaster')

@section('title', 'Formulario') 

@section('content')
<div class="card overflow-hidden">
    <div class="card-header">
        <h4 class="card-title">Usuarios</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
        	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-user-plus"> Nuevo usuario</i></button><br>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tec" data-toggle="tab" href="#formadores" role="tab" aria-controls="formadores" aria-selected="true">Formadores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="admin" data-toggle="tab" href="#admins" role="tab" aria-controls="admins" aria-selected="false">Administradores</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content pt-1">
                <div class="tab-pane active" id="formadores" role="tabpanel" aria-labelledby="tec">
                    <div class="table-responsive">
                        <table class="table zero-configuration">
                            <thead>
                                <tr>
                                    <th>Id</th>                                                        
                                    <th>Nombre</th>
                                    <th>Documento</th>
                                    <th>Celular</th>
                                    <th>Email</th>
                                    <th>Punto</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($formadores as $key)
                            	<tr>
                            		<td>{{$key->id}}</td>
                            		<td>{{$key->name}}</td>
                            		<td>{{$key->documento}}</td>
                            		<td>{{$key->celular}}</td>
                            		<td>{{$key->email}}</td>
                                    <td>{{$key->nombre_punto}} - {{$key->ubicacion}}</td>
                            		<td></td>
                            	</tr>
                            	@endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                	<th>Id</th>                                                        
                                    <th>Nombre</th>
                                    <th>Documento</th>
                                    <th>Celular</th>
                                    <th>Email</th>
                                    <th>Punto</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="tab-pane" id="admins" role="tabpanel" aria-labelledby="admin">
                    <div class="table-responsive">
                        <table class="table zero-configuration">
                            <thead>
                                <tr>
                                    <th>Id</th>                                                        
                                    <th>Nombre</th>
                                    <th>Documento</th>
                                    <th>Email</th>
                                    <th>Punto</th>
                                </tr>
                            </thead>
                            <tbody>
                            	@foreach($admins as $admin)
                            	<tr>
                            		<td>{{$admin->id}}</td>
                            		<td>{{$admin->name}}</td>
                            		<td>{{$admin->documento}}</td>
                            		<td>{{$admin->email}}</td>
                                    <td>{{$admin->nombre_punto}} - {{$admin->ubicacion}}</td>
                            	</tr>
                            	@endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                	<th>Id</th>                                                        
                                    <th>Nombre</th>
                                    <th>Documento</th>
                                    <th>Email</th>
                                    <th>Punto</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Crear usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{URL::to('usuario/guardarusuario')}}" enctype="multipart/form-data" id="env_usuario">
                	@csrf
                	<div class="row">
                		<div class="col-sm-12">
                			<label>Nombre completo</label>

                			<input type="text" class="form-control" id="nombre" name="nombre">
                		</div>

                		<div class="col-sm-12">
                			<label>Numero de documento</label>

                			<input type="number" class="form-control" id="documento" name="documento">
                		</div>

                		<div class="col-sm-12">
                			<label>Correo electronico</label>

                			<input type="text" class="form-control" id="email" name="email">
                		</div>

                		<div class="col-sm-12">
                			<label>Permisos</label>

                			<select class="form-control" id="rol" name="rol">                				
                				@foreach($permisos as $key)
                				    <option value="{{$key->id}}">{{$key->name}}</option>
                				@endforeach
                			</select>
                		</div>
                	</div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="guardarusuario()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	function guardarusuario(){
		var nombre = $('#nombre').val();
		if (nombre=="") {
			$('#nombre').focus();
			return;
		}
		var documento = $('#documento').val();
		if (documento=="") {
			$('#documento').focus();
			return;
		}
		var email = $('#email').val();
		if (email=="") {
			$('#email').focus();
			return;
		}
		var rol = $('#rol').val();
		if (rol=="") {
			$('#rol').focus();
			return;
		}
		$('#env_usuario').submit();
	}
</script>
@endsection