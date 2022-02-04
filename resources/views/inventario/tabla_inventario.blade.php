<h4>Número de registros: {{ count($conteoC) }}</h4>

<table class="table">
    <thead>
        <tr>
            <th>
                <center>Id</center>
            </th>

            <th>
                <center>PDF Detalle</center>
            </th>

            <th>
                <center>Punto</center>
            </th>

            <th>
                <center>usuario</center>
            </th>

            <th>
                <center>Fecha</center>
            </th>
        </tr>
    </thead>

    <tbody>
        @foreach ($inventario as $key)
            <tr>
                <td>
                    <center>
                        <button type="button" id="mostrarDetalleModal"
                            onclick="showModal({{ $key->id }},'{{ $key->created_at }}')"
                            class="btn btn-default show" data-toggle="modal" data-target="#detalleModal">
                            <i class="feather icon-eye"> {{ $key->id }}</i>
                        </button>
                    </center>
                </td>

                <td>
                    <a href="pdfregistrochequeos?id={{ $key->id }}" target="_blank"><button type="button"
                            class="btn bg-gradient-success btn-sm mr-1 mb-1 waves-effect waves-light"><i
                                class="feather icon-file-plus"></i></button></a>
                </td>

                <td>
                    <center>{{ $key->nombre_punto }} - {{ $key->ubicacion }}</center>
                </td>

                <td>
                    <center>{{ $key->name }}</center>
                </td>

                <td>
                    <center>{{ $key->fecha }} {{ $key->hora }}</center>
                </td>
            </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <th>
                <center>Id</center>
            </th>

            <th>
                <center>PDF Detalle</center>
            </th>

            <th>
                <center>Punto</center>
            </th>

            <th>
                <center>usuario</center>
            </th>

            <th>
                <center>Fecha</center>
            </th>
        </tr>
    </tfoot>
</table>

<div class="pagination">
    {{ $inventario->appends(['puntoC' => Request::input('puntoC'), 'fechaC' => Request::input('fechaC')])->links() }}
</div>
