<?php
Route::get('/cambiarhora', 'AdminController@cambiarhora');

Route::get('/certificacion', 'FormularioController@consultarCertificado');
Route::post('/vercertificado', 'FormularioController@verCertificado');

Route::middleware(['auth'])->group(function () {
	Route::get('/', 'DashboardController@dashboardAnalytics');

	Route::get('/pruebamail', 'FormularioController@pruebamail');

	Route::get('/misregistros', 'AdminController@misRegistros')->name('misregistros');

	Route::prefix('/mantenimiento')->group(function () {
		Route::get('/acciones', 'FormularioController@formularioMantenimiento');
	});

	Route::prefix('/formulario')->group(function () {
		Route::get('/selected_municipio', 'FormularioController@selected_municipio');

		//Rutas formulario acciones en vía
		Route::get('/acciones', 'FormularioController@formularioAcciones');
		
		Route::post('/consultaracciones', 'FormularioController@consultarAcciones');

		Route::post('/guardarformularioacciones', 'FormularioController@guardarFormularioAcciones');

		Route::get('/validarvideoaccion', 'FormularioController@validarVideoAccion');


		//Rutas formulario formación completa
		Route::get('/formacion', 'FormularioController@formularioFormacion');

		Route::post('/consultarformacion', 'FormularioController@consultarFormacion');

		Route::post('/guardarformularioformacion', 'FormularioController@guardarFormularioFormacion');

		Route::get('/guardadoformularioformacion', function () {
			return redirect('formulario/formacion')->with('status', 1);
		});

		Route::post('/guardararchivos', 'FormularioController@guardarArchivos')->name('guardararchivos');
		

		//Rutas puntos
		Route::get('/crearpuntocontrol', 'FormularioController@crearpuntocontrol');

		Route::get('/guardarpuntousuario', 'FormularioController@guardarpuntousuario');
		
		Route::get('/cambiarpc', 'FormularioController@cambiarpc');

		Route::get('/puntocambiado', function () {
			return redirect('formulario/cambiarpc')->with('status', 1);
		});
	});


	Route::prefix('/chequeo')->group(function () {
		Route::get('/selected_municipio', 'InventarioController@selected_municipio');

		Route::get('/listachequeo', 'InventarioController@formInventario');

		Route::get('/verlistachequeo', 'InventarioController@verInventario')->name('verlistachequeo');

		Route::get('/detallelistachequeo', 'InventarioController@detalleInventario')->name('detallelistachequeo');

		Route::get('/exportarexcelchequeo', 'InventarioController@exportarExcelInventario');

		Route::get('/pdfregistrochequeos', 'InventarioController@pdfRegistroInventario');

		Route::get('/pdfchequeos', 'InventarioController@pdfChequeos');

		Route::post('/guardarinventario', 'InventarioController@guardarInventario');

		Route::get('/guardado', function () {
			// Update the user's profile...
			return redirect('chequeo/listachequeo')->with('status', 1);
		});
	});
	
	
	//Rutas admin
	Route::prefix('/admin')->middleware('role')->group(function () {
		Route::get('/acciones', 'AdminController@verRegistrosAcciones')->name('registrosacciones');

		Route::get('/participantes', 'AdminController@verRegistrosParticipantes')->name('registrosparticipantes');
// filtro
		Route::get('/filtrocolectivo', 'AdminController@filtroColectivo')->name('filtrocolectivos');
		
		Route::get('/formacion', 'AdminController@verRegistrosFormacion')->name('registrosformacion');
		
		Route::get('/prueba', 'AdminController@verPrueba')->name('prueba');
		
		Route::get('/detalleaccion', 'AdminController@detalleAccion')->name('detalleaccion');
		
		Route::get('/detalleformacion', 'AdminController@detalleFormacion')->name('detalleformacion');

		Route::get('/detalleparticipantes', 'AdminController@detalleParticipante')->name('detalleparticipante');
		
		Route::get('/descargarimagen', 'AdminController@descargarImagen')->name('descargarimagen');
		
		Route::get('/exportarexcelacciones', 'AdminController@exportarExcelAcciones');

		Route::get('/exportarexcelparticipantes', 'AdminController@exportarExcelParticipantes');

		Route::get('/pdfaceptacion', 'AdminController@pdfAceptacion');

		Route::get('/pdfproteccionmasivo', 'AdminController@pdfProteccionMasivo');

		Route::get('/pdfconsentimientomasivo', 'AdminController@pdfConsentimientoMasivo');

		Route::get('/pdfregistroacciones', 'AdminController@pdfRegistroAcciones');
		
		Route::get('/cambiarhoracon', 'AdminController@cambiarhoracon');

		Route::get('/certificadomasivo', 'FormularioController@certificadoMasivo');

	});
	
	
	Route::prefix('/usuario')->middleware('role')->group(function () {
		
		Route::get('/', 'UserController@usuario');
		
		Route::post('/guardarusuario', 'UserController@guardarusuario');
	});
});

Route::get('login', 'Auth\LoginController@login');

Auth::routes(['register' => false]);

Auth::routes();
