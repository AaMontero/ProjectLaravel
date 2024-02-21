<x-app-layout>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Contracts') }}
            </h2>
            <div onclick="abrirVentanaAgregarContrato()" class="cursor-pointer flex items-center">
                <span class="mr-2">Agregar un nuevo contrato</span>
                <svg class="h-6 w-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </div>
        </div>
    </x-slot>

    <?php
    $nombres = $email = $apellidos = $ciudad = $provincia = $ubicacionSala = $cedula = $contrato = $formasPago = $pagareText = $montoCuotaPagare = '';
    $aniosContrato = $montoContrato = $numCuotas = $valor_pagare = 0;
    $bonoQory = $bonoQoryInt = $pagareBoolean = $otroFormaPagoBoolean = $contienePagare = $contieneCreditoDirecto = false;
    date_default_timezone_set('America/Guayaquil');
    $fechaActual = $fechaVencimiento = $fechaInicioCredDir = date('Y-m-d');
    $errorNombres = $errorCedula = $errorApellidos = $errorUbicacionSala = $errorCiudad = $errorCorreo = $erroraniosContrato = $errorMontoContrato = $errorProvincia = '';
    ?>


    <div class="py-8">
        <div id="idAgregarContrato" class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('contrato.store') }}" method="POST" class="p-4">

                        @csrf
                        <!-- Hidden -->
                        <input type="hidden" id="formas_pago" name="formas_pago">
                        <input type="hidden" id="pagare_monto_info" name="pagare_monto_info">
                        <input type="hidden" id="pagare_fecha_info" name="pagare_fecha_info">
                        <input type="hidden" id="contiene_pagare" name="contiene_pagare">
                        <input type="hidden" id="contiene_credito_directo" name="contiene_credito_directo">
                        <input type="hidden" id="cred_dir_fecha_inicio" name="cred_dir_fecha_inicio">
                        <input type="hidden" id="cred_dir_num_cuotas" name="cred_dir_num_cuotas">
                        <input type="hidden" id="cred_dir_valor" name="cred_dir_valor">
                        <input type="hidden" id="cred_dir_abono" name="cred_dir_abono">

                        <!-- Nombres -->
                        <input type="hidden" id="nombres" name="nombres" value="{{ $cliente->nombres }}"
                            class="border rounded-md px-3 py-2 w-full" readonly="readonly">
                        <!-- Apellidos -->
                        <input type="hidden" id="apellidos" name="apellidos" value="{{ $cliente->apellidos }}"
                            class="border rounded-md px-3 py-2 w-full " readonly="readonly">
                        <!-- Cédula -->
                        <input type="hidden" id="cedula" name="cedula" value="{{ $cliente->cedula }}"
                            class="border rounded-md px-3 py-2 w-full" readonly="readonly">
                        <!-- Email -->
                        <input type="hidden" id="email" name="email" value="{{ $cliente->email }}"
                            class="border rounded-md px-3 py-2 w-full" readonly="readonly">
                        <!-- Ciudad -->
                        <input type="hidden" id="ciudad" name="ciudad" value="{{ $cliente->ciudad }}"
                            class="border rounded-md px-3 py-2 w-full" readonly="readonly">
                        <!-- Provincia -->
                        <input type="hidden" id="provincia" name="provincia" value="{{ $cliente->provincia }}"
                            class="border rounded-md px-3 py-2 w-full" readonly="readonly">
                        <!-- Ubicacion de la sala -->
                        <div class="mb-4">
                            <label for="ubicacion_sala" class="block">Ubicación de la sala</label>
                            <input type="text" id="ubicacion_sala" name="ubicacion_sala" value="{{ $ubicacionSala }}"
                                class="border rounded-md px-3 py-2 w-full">
                            @if (!empty($errorUbicacionSala))
                                <span class="text-red-500">{{ $errorUbicacionSala }}</span>
                            @endif
                        </div>

                        <!-- Años del contrato -->
                        <div class="mb-4">
                            <label for="anios_contrato" class="block">Años del contrato</label>
                            <input type="number" id="anios_contrato" name="anios_contrato"
                                value="{{ $aniosContrato }}" class="border rounded-md px-3 py-2 w-full">
                            @if (!empty($erroraniosContrato))
                                <span class="text-red-500">{{ $erroraniosContrato }}</span>
                            @endif
                        </div>

                        <!-- Monto del contrato -->
                        <div class="mb-4">
                            <label for="monto_contrato" class="block">Monto del contrato</label>
                            <input type="number" id="monto_contrato" name="monto_contrato"
                                value="{{ $montoContrato }}" class="border rounded-md px-3 py-2 w-full">
                            @if (!empty($errorMontoContrato))
                                <span class="text-red-500">{{ $errorMontoContrato }}</span>
                            @endif
                        </div>

                        <!-- Forma de pago (añadir más de una) -->
                        <div class="mb-4">
                            <label class="block">Forma de pago:</label>
                            <div class="mt-2">
                                <input type="checkbox" name="forma_pago" value="{{ $pagareBoolean }}"
                                    id="pagareCheckbox" class="mr-2"> Pagaré
                            </div>

                            <div id="divPagareCheckbox" class="hidden mt-2">
                                <label for="valor" class="mr-2">Valor:</label>
                                <input type="number" id="valor_pagare" name="valor_pagare"
                                    placeholder="Ingrese el valor" class="border rounded-md px-3 py-2 mr-2">
                                <label for="fechaPago" class="mr-2">Fecha de Pago:</label>
                                <input type="date" id="fecha_pago_pagare" name="fechaPago"
                                    class="border rounded-md px-3 py-2 mr-2">
                                <button onclick="functionAgregarPagare()"
                                    class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">+</button>
                            </div>

                            <div class="mt-2">
                                <input type="checkbox" value="{{ $pagareBoolean }}" id="creditoDirectoCheckbox"
                                    class="mr-2">
                                Crédito Directo
                            </div>
                            <div id="divCreditoDirectoCheckBox" class="hidden mt-2">
                                <label for="montoCredDir" class="mr-2">Valor:</label>
                                <input type="number" id="monto_credito_directo" name="montoCredDir"
                                    placeholder="Valor" class="border rounded-md px-3 py-2 mr-2 w-15">
                                <label for="abonoCredDir" class="mr-2">Abono:</label>
                                <input type="number" id="abono_credito_directo" name="abonoCredDir"
                                    placeholder="Abono" class="border rounded-md px-3 py-2 mr-2 w-15">
                                <label for="mesesCredDir" class="mr-2 py-2"># Meses: </label>
                                <select id="meses_credito_directo" name="mesesCredDir"
                                    class="border rounded-md px-3 py-2 mr-2 w-20">
                                    <option value="12">12</option>
                                    <option value="24">24</option>
                                    <option value="36">36</option>
                                </select>
                                <label for="fechaInicioCredDir" class="mr-2">Fecha de Inicio:</label>
                                <input type="date" id="fecha_inicio_cred_dir" name="fechaInicioCredDir"
                                    class="border rounded-md px-3 py-2 mr-2">
                                <button onclick="functionAgregarCreditoDirecto()"
                                    class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">+</button>
                            </div>

                            <div class="mt-2">
                                <input type="checkbox" value="{{ $otroFormaPagoBoolean }}" id="otroCheckbox"
                                    class="mr-2"> Otro
                            </div>
                            <div id="divOtrosCheckbox" class="hidden mt-2">
                                <label for="monto" class="mr-2">Valor:</label>
                                <input type="number" id="monto_forma_pago" name="montoPago"
                                    placeholder="Ingrese el valor" class="border rounded-md px-3 py-2 mr-2 w-15">
                                <label for="formaPago" class="mr-2">Forma:</label>
                                <input type="text" id="forma_pago" name="formaPago"
                                    class="border rounded-md px-3 py-2 mr-2">
                                <button onclick="functionAgregar()"
                                    class="bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">+</button>
                            </div>
                        </div>
                        <ul id="listaFormasPagoUl"></ul>

                        <!-- Bono hospedaje Qory Loyalty -->
                        <div class="mt-4">
                            <label class="inline-flex items-center">Bono hospedaje Qory Loyalty</label>
                            <input type="checkbox" name="bono_hospedaje" id="bono_hospedaje_checkbox" value="1"
                                class="ml-2">
                        </div>

                        <!-- Bono de hospedaje internacional Qory Loyalty -->
                        <div class="mt-4">
                            <label class="inline-flex items-center">Bono de hospedaje internacional Qory
                                Loyalty</label>
                            <input type="checkbox" name="bono_hospedaje_internacional"
                                id="bono_hospedaje_internacional_checkbox" value="{{ $bonoQoryInt }}"
                                class="ml-2">
                        </div>

                        <!-- Aquí está el botón para ejecutar el código -->
                        <button type="submit"
                            class="mt-4 bg-gray-800 hover:bg-gray-500 text-white font-semibold py-2 px-4 rounded shadow-md transition duration-300 ease-in-out">Generar
                            Contrato</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
    <script>
        var listaFormasPago = [];
        var pagareBoolean = false;
        var creditoDirectoBoolean = false;

        function functionAgregar() {
            event.preventDefault();
            const valor = document.getElementById("monto_forma_pago");
            const forma = document.getElementById("forma_pago");
            const formaValue = forma.value;
            const valorValue = valor.value;
            if (valorValue === "" || formaValue === "") {
                alert("Por favor, complete todos los campos antes de agregar una forma de pago.");
            } else {
                var cadena = "$" + valorValue + " con " + formaValue;
                listaFormasPago.push(cadena);
                console.log("Lista");
                listaFormasPago.forEach((element) => console.log(element));
                valor.value = "";
                forma.value = "";
                document.getElementById("formas_pago").value = JSON.stringify(listaFormasPago);
                alert("Se agregó: " + cadena);
            }
        }

        function functionAgregarPagare() {
            if (pagareBoolean == true || creditoDirectoBoolean == true) {
                alert("Ya se agrego un Pagaré previamente");
            } else {
                event.preventDefault();
                const valor = document.getElementById("valor_pagare");
                const fecha = document.getElementById("fecha_pago_pagare");

                const valorValue = valor.value;
                const fechaValue = fecha.value;
                if (valorValue === "" || fechaValue === "") {
                    alert("Por favor, complete todos los campos antes de agregar el Pagaré.");
                } else {
                    ;
                    document.getElementById("pagare_monto_info").value = JSON.stringify(valorValue);
                    document.getElementById("pagare_fecha_info").value = JSON.stringify(fechaValue);
                    var cadena = "$" + valorValue + " con Pagaré Fecha: " + fechaValue;
                    listaFormasPago.push(cadena);
                    console.log("Lista");
                    listaFormasPago.forEach((element) => console.log(element));
                    valor.value = "";
                    fecha.value = "";

                    document.getElementById("formas_pago").value = JSON.stringify(listaFormasPago);
                    document.getElementById("contiene_pagare").value = "true";
                    pagareBoolean = true;
                    alert("Se agregó: " + cadena);
                }
            }

        }

        function functionAgregarCreditoDirecto() {
            event.preventDefault();

            if (pagareBoolean == true || creditoDirectoBoolean == true) {
                alert("Ya se ha agregado otra forma de pago");
            } else {
                const creditoDirectoValor = document.getElementById("monto_credito_directo");
                const creditoDirectoFecha = document.getElementById("fecha_inicio_cred_dir");
                const creditoDirectoNumCuotas = document.getElementById("meses_credito_directo");
                const creditoDirectoAbono = document.getElementById("abono_credito_directo");
                const CDValor = creditoDirectoValor.value;
                const CDFechaIni = creditoDirectoFecha.value;
                const CDNumCuotas = creditoDirectoNumCuotas.value;
                const CDAbono = creditoDirectoAbono.value;
                console.log(CDValor, CDFechaIni, CDNumCuotas, CDAbono);
                if (CDValor == "" || CDFechaIni == "" || CDNumCuotas == "") {
                    alert("Por favor complete todos los campos del Credito Directo");
                } else {
                    document.getElementById("cred_dir_fecha_inicio").value = JSON.stringify(CDFechaIni);
                    document.getElementById("cred_dir_num_cuotas").value = JSON.stringify(CDNumCuotas);
                    document.getElementById("cred_dir_valor").value = JSON.stringify(CDValor);
                    document.getElementById("cred_dir_abono").value = JSON.stringify(CDAbono);
                    listaFormasPago.push("Se inserto un Credito Directo");
                    document.getElementById("contiene_credito_directo").value = "true";
                    document.getElementById("formas_pago").value = JSON.stringify(listaFormasPago);
                    creditoDirectoValor.value = "";
                    creditoDirectoFecha.value = "";
                    creditoDirectoNumCuotas.value = "";
                    creditoDirectoAbono.value = "";
                    alert("Se agrego un Credito Directo");
                    creditoDirectoBoolean = true;
                }
            }

            console.log(pagareBoolean);
            console.log(creditoDirectoBoolean);


        }
        function abrirVentanaAgregarContrato() {

            var VentanaAgregarContrato = document.getElementById("idAgregarContrato");
            console.log(VentanaAgregarContrato.style.display);
            if (VentanaAgregarContrato.style.display === 'none') {
                VentanaAgregarContrato.style.display = 'block';
            } else {
                VentanaAgregarContrato.style.display = 'none';
            }

            console.log("esta dando click en el boton para ocultar");

            }


        document.addEventListener("DOMContentLoaded", function() {
            const pagareCheckbox = document.getElementById("pagareCheckbox");
            const otroCheckbox = document.getElementById("otroCheckbox");
            const credDirectoCheckBox = document.getElementById("creditoDirectoCheckbox");
            const pagareFields = document.getElementById("divPagareCheckbox");
            const otroFields = document.getElementById("divOtrosCheckbox");
            const creditoDirectoFields = document.getElementById("divCreditoDirectoCheckBox");
            pagareCheckbox.addEventListener("change", function() {
                if (pagareCheckbox.checked) {
                    console.log("Esta entrando a este metodo");
                    pagareFields.style.display = "flex";
                    pagareFields.style.alignItems = "center";
                } else {
                    pagareFields.style.display = "none";
                }
            });
            otroCheckbox.addEventListener("change", function() {
                if (otroCheckbox.checked) {
                    console.log("Esta entrando a este metodo otros");
                    otroFields.style.display = "flex";
                    otroFields.style.alignItems = "center";
                } else {
                    otroFields.style.display = "none";
                }
            });
            credDirectoCheckBox.addEventListener("change", function() {
                if (credDirectoCheckBox.checked) {
                    console.log("Esta entrando al metodo de credito directo");
                    creditoDirectoFields.style.display = "flex";
                    creditoDirectoFields.style.alignItems = "center";

                } else {
                    creditoDirectoFields.style.display = "none";
                }
            });

        });
    </script>
</x-app-layout>
