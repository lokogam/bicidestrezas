<h4>Número de registros: {{-- {{ count($conteoR) }} --}}</h4>

<table class="table">
    <thead>
        <tr>
            <th>Detalle</th>
            <th>Colectivo</th>
            <th>Nombre</th>
            <th>Documento</th>
            <th>Correo</th>
            <th>Celular</th>
            <th>Niveles</th>
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
            
            <td>{{ $registro->nombre_punto }} <br> {{ $registro->colectivo }} - {{ $registro->ubicacion }}</td>
            <td>{{ $registro->nombre }}</td>
            <td>{{ $registro->numero_documento }}</td>
            <td>{{ $registro->correo }}</td>
            <td>{{ $registro->numero_celular }}</td>
            
            <th>{{ $registro->nivel }}</th>
        </tr>
            
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <th>Detalle</th>
            <th>Colectivo</th>
            <th>Nombre</th>
            <th>Documento</th>
            <th>Correo</th>
            <th>Celular</th>
            <th>Niveles</th>
        </tr>
    </tfoot>
</table>

<div class="pagination">
    {{ $registros->appends(['puntoR' => Request::input('puntoR'), 'fechaR' => Request::input('fechaR'), 'fechahR' =>
    Request::input('fechahR')])->links() }}
</div>