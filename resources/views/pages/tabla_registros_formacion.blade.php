<h4>Número de registros: {{ count($conteoR) }}</h4>

<table class="table">
    <thead>
        <tr>
            <th>Detalle</th>
            {{-- <th>PDF detalle</th> --}}
            {{-- <th>PDF aceptación</th> --}}
            <th>Punto</th>
            <th>Documento</th>
            <th>Fecha</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($registros as $registro)
            <tr>
                <td>
                    <button type="button" id="mostrarDetalleModal" onclick="showModal({{ $registro->id }})"
                        class="btn btn-default show" data-toggle="modal" data-target="#detalleModal">
                        

                        <i class="feather icon-eye">{{ $registro->id }}</i>
                    </button>
                </td>

                {{-- <td>
                    <a href="pdfregistroformacion?id={{ $registro->id }}" target="_blank"><button type="button"
                            class="btn bg-gradient-success btn-sm mr-1 mb-1 waves-effect waves-light"><i
                                class="feather icon-file-plus"></i></button></a>
                </td> --}}

                {{-- <td>
                    <a href="pdfaceptacion?id={{ $registro->id }}" target="_blank"><button type="button"
                            class="btn bg-gradient-success btn-sm mr-1 mb-1 waves-effect waves-light"><i
                                class="feather icon-file-plus"></i></button></a>
                </td> --}}

                <td>{{ $registro->nombre_punto }} - {{ $registro->ubicacion }}</td>
                <td>{{ $registro->numero_documento }}</td>
                <td>{{ $registro->fecha }} {{ $registro->hora_inicio }}</td>
            </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <th>Detalle</th>
            {{-- <th>PDF detalle</th> --}}
            {{-- <th>PDF aceptación</th> --}}
            <th>Punto</th>
            <th>Documento</th>
            <th>Fecha</th>
        </tr>
    </tfoot>
</table>

<div class="pagination">
    {{ $registros->appends(['puntoR' => Request::input('puntoR'), 'fechaR' => Request::input('fechaR'), 'fechahR' => Request::input('fechahR')])->links() }}
</div>
