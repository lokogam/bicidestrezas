<h4>Número de registros: {{ count($conteoR) }}</h4>

<table class="table">
    <thead>
        <tr>
            <th>Detalle</th>
            <th>Punto</th>
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

            <td>{{ $registro->nombre_punto }} <br> {{ $registro->ubicacion }}</td>
            <td>{{ $registro->colectivo }} <br> {{ $registro->ubicacion_espacio }}</td>
            <td>{{ $registro->nombre }}</td>
            <td>{{ $registro->numero_documento }}</td>
            <td>{{ $registro->correo }}</td>
            <td>{{ $registro->numero_celular }}</td>

            <th>
                1
                <input type="radio" {{ $registro->evaluacion_taller_1 != '' ? 'checked' : 'disabled' }}>
                2
                <input type="radio" {{ $registro->evaluacion_taller_2 != '' ? 'checked' : 'disabled' }}>
                3
                <input type="radio" {{ $registro->evaluacion_taller_3 != '' ? 'checked' : 'disabled' }}>
                4
                <input type="radio" {{ $registro->evaluacion_taller_4 != '' ? 'checked' : 'disabled' }}>
            </th>
        </tr>

        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <th>Detalle</th>
            <th>Punto</th>
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
    {{ $registros->appends([
    'nivelF' => Request::input('nivelF'),
    'nivelFP' => Request::input('nivelFP'),
    'puntoR' => Request::input('puntoR'),
    'puntoRF' => Request::input('puntoRF'),
    'fechaR' => Request::input('fechaR'),
    'fechahR' => Request::input('fechahR')
    ])->links() }}
</div>