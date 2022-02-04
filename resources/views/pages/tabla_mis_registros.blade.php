<h4>Número de registros: {{ count($conteoR) }}</h4>

<table class="table">
    <thead>
        <tr>
            <th>Detalle</th>
            <th>PDF detalle</th>
            <th>PDF aceptación</th>
            <th>Id</th>
            <th>Foto</th>
            <th>Video</th>
            {{-- <th>Punto</th> --}}
            <th>Documento</th>
            <th>Email</th>
            <th>Celular</th>
            <th>Fecha</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($registros as $registro)
            <tr>
                <td>
                    <button type="button" id="mostrarDetalleModal" onclick="showModal({{ $registro->id }})"
                        class="btn btn-default show" data-toggle="modal" data-target="#detalleModal">
                        <i class="feather icon-eye"></i>
                    </button>
                </td>
                <td>
                    <a href="admin/pdfregistroacciones?id={{ $registro->id }}" target="_blank"><button type="button"
                            class="btn bg-gradient-success btn-sm mr-1 mb-1 waves-effect waves-light"><i
                                class="feather icon-plus"></i></button></a>
                </td>
                <td>
                    <a href="admin/pdfaceptacion?id={{ $registro->id }}" target="_blank"><button type="button"
                            class="btn bg-gradient-success btn-sm mr-1 mb-1 waves-effect waves-light"><i
                                class="feather icon-plus"></i></button></a>
                </td>
                <td>{{ $registro->id }}</td>
                <td>
                    @if ($registro->foto == '')
                        <button type="button" onclick="showModalArchivos({{ $registro->id }})"
                            class="btn bg-gradient-success btn-sm mr-1 mb-1 waves-effect waves-light" data-toggle="modal"
                            data-target="#detalleArchivos">
                            <i class="feather icon-image"></i>
                        </button>
                    @else
                        <img style="width: 30px; heigth: 30px;" src="{{ URL::to('bicicletas/' . $registro->foto) }}">
                    @endif
                </td>
                <td>
                    @if ($registro->video == '')
                        <button type="button" onclick="showModalArchivos({{ $registro->id }})"
                            class="btn bg-gradient-success btn-sm mr-1 mb-1 waves-effect waves-light" data-toggle="modal"
                            data-target="#detalleArchivos">
                            <i class="feather icon-video"></i>
                        </button>
                    @else
                        <a href="{{ URL::to('admin/descargarimagen?video=' . $registro->video) }}" target="_blank">
                            <video style="width: 30px; heigth: 30px;"
                                src="{{ URL::to('videos/' . $registro->video) }}">
                        </a>
                    @endif
                </td>
                {{-- <td>{{ $registro->nombre_punto }} - {{ $registro->ubicacion }}</td> --}}
                <td>{{ $registro->numero_documento }}</td>
                <td>{{ $registro->correo }}</td>
                <td>{{ $registro->numero_contacto }}</td>
                <td>{{ $registro->fecha }} {{ $registro->hora_inicio }}</td>
            </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <th>Detalle</th>
            <th>PDF detalle</th>
            <th>PDF aceptación</th>
            <th>Id</th>
            <th>Foto</th>
            <th>Video</th>
            {{-- <th>Punto</th> --}}
            <th>Documento</th>
            <th>Email</th>
            <th>Celular</th>
            <th>Fecha</th>
        </tr>
    </tfoot>
</table>

<div class="pagination">
    {{ $registros->appends(['puntoR' => Request::input('puntoR'), 'fechaR' => Request::input('fechaR'), 'fechahR' => Request::input('fechahR')])->links() }}
</div>
