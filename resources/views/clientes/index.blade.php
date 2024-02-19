<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Clients') }}
            </h2>
            <div onclick="abrirVentanaAgregarPaquete()" class="cursor-pointer flex items-center">
                <span class="mr-2">Agregar un nuevo cliente</span>
                <svg class="h-6 w-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <!--<div id="idAgregarPaquete" class="max-w-7xl mx-auto sm:px lg:px-8" style="display: none;">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" enctype="multipart/form-data">
                        @csrf
                        <p class="mt-1 p-1 ml-4">Nombre del paquete:</p>
                        <input type="text" name="nombre_paquete"
                            class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{ __('Put your message here') }}" value="{{ old('nombre_paquete') }}">

                        {{-- message --}}
                        <p class="mt-1 p-1 ml-4">Descripción del paquete</p>
                        <input type="text" name="message"
                            class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{ __('Put your message here') }}" value="{{ old('message') }}">

                        <p class="mt-1 p-1 ml-4">Número de días: </p>
                        <input type="number" name="num_dias"
                            class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{ __('Put your message here') }}" value="{{ old('num_dias') }}">


                        <p class="mt-1 p-1 ml-4">Número de noches:</p>
                        <input type="number" name="num_noches"
                            class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{ __('Put your message here') }}" value="{{ old('num_noches') }}">

                        <p class="mt-1 p-1 ml-4">Precio Afiliados:</p>
                        <input type="number" name="precio_afiliado" step="0.01"
                            class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{ __('Put your message here') }}" value="{{ old('precio_afiliado') }}">

                        <p class="mt-1 p-1 ml-4">Precio no afiliados:</p>
                        <input type="number" name="precio_no_afiliado" step="0.01"
                            class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{ __('Put your message here') }}" value="{{ old('precio_no_afiliado') }}">
                        <p class="mt-1 p-1 ml-4">Imagen del paquete:</p>
                        <input type="file" name="imagen_paquete" class ="form-control mb-2"
                            value = "{{ old('imagen_paquete') }}">
                        <input type="hidden" id = "lista_caracteristicas" name = "lista_caracteristicas">
                        <div>
                            <p class="mt-1 p-1 ml-4">Agregar Característica</p>
                            <div class="flex">
                                <input type = "text" name="lugar_caracteristica" id ="lugar_caracteristica"
                                    class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                    placeholder="{{ __('Lugar') }}" value="{{ old('ciudad_caracteristica') }}">
                                <input type="text" name="caracteristica" id="caracteristica"
                                    class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                    placeholder="{{ __('Ingrese su característica aquí') }}"
                                    value="{{ old('caracteristica') }}">
                                <button type="button" onclick="agregarCaracteristica()"
                                    class="ml-2 h-full bg-blue-500 text-white font-bold py-2 px-4 rounded">
                                    Agregar
                                </button>
                            </div>
                        </div>
                        <script>
                            function abrirVentanaAgregarPaquete() {

                                var ventanaAgregarPaquete = document.getElementById("idAgregarPaquete");
                                console.log(ventanaAgregarPaquete.style.display);
                                if (ventanaAgregarPaquete.style.display === 'none') {
                                    ventanaAgregarPaquete.style.display = 'block';
                                } else {
                                    ventanaAgregarPaquete.style.display = 'none';
                                }

                                console.log("esta dando click en el boton para ocultar");

                            }
                            let listaCaracteristicas = [];

                            function agregarCaracteristica() {
                                const caracteristicaCiudad = document.getElementById("lugar_caracteristica");
                                const caracteristicaInput = document.getElementById("caracteristica");
                                const caracteristicaTexto = caracteristicaInput.value.trim();
                                const caracteristicaCiudadTexto = caracteristicaCiudad.value.trim();
                                if (caracteristicaTexto !== "") {
                                    // Validación para asegurar que caracteristicaCiudadTexto no esté vacía
                                    const caracteristicaCiudadValidada = caracteristicaCiudadTexto !== "" ? caracteristicaCiudadTexto :
                                        "";

                                    const caracteristica = [
                                        caracteristicaTexto, caracteristicaCiudadValidada
                                    ];
                                    listaCaracteristicas.push(caracteristica);
                                    caracteristicaInput.value = "";
                                    caracteristicaCiudad.value = "";
                                    // Cambiado a innerHTML para mostrar la lista en un elemento div
                                    document.getElementById("lista_caracteristicas").value = JSON.stringify(listaCaracteristicas);
                                    alert("Se ha agregado la característica: " + caracteristicaTexto);
                                } else {
                                    alert("Por favor, ingresa una característica válida.");
                                }

                                console.log(listaCaracteristicas);
                            }
                        </script>
                        <x-input-error :messages="$errors->get('message')" />
                        <x-primary-button class='mt-4'>Agregar nuevo paquete</x-primary-button>
                    </form>
                </div>
            </div>
        </div>-->
        <div id="idAgregarCliente" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" enctype="multipart/form-data">
                        @csrf

                        <div id="idAgregarCliente" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                    <form method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <p class="mt-1 p-1 ml-4">Cédula:</p>
                                        <input type="text" name="cedula"
                                            class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                            placeholder="{{ __('Ingrese la cédula') }}" value="{{ old('cedula') }}">

                                        <p class="mt-1 p-1 ml-4">Usuario:</p>
                                        <input type="text" name="usuario"
                                            class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                            placeholder="{{ __('Ingrese el usuario') }}"
                                            value="{{ old('usuario') }}">

                                        <p class="mt-1 p-1 ml-4">Nombres:</p>
                                        <input type="text" name="nombres"
                                            class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                            placeholder="{{ __('Ingrese los nombres') }}"
                                            value="{{ old('nombres') }}">

                                        <p class="mt-1 p-1 ml-4">Apellidos:</p>
                                        <input type="text" name="apellidos"
                                            class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                            placeholder="{{ __('Ingrese los apellidos') }}"
                                            value="{{ old('apellidos') }}">

                                        <p class="mt-1 p-1 ml-4">Número Telefónico:</p>
                                        <input type="text" name="numTelefonico"
                                            class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                            placeholder="{{ __('Ingrese el número telefónico') }}"
                                            value="{{ old('numTelefonico') }}">
                                        <p class="mt-1 p-1 ml-4">Email:</p>
                                        <input type="email" name="email"
                                            class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                            placeholder="{{ __('Ingrese el correo electrónico') }}"
                                            value="{{ old('email') }}">

                                        <p class="mt-1 p-1 ml-4">Provincia:</p>
                                        <input type="text" name="provincia"
                                            class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                            placeholder="{{ __('Ingrese la provincia') }}"
                                            value="{{ old('provincia') }}">

                                        <p class="mt-1 p-1 ml-4">Ciudad:</p>
                                        <input type="text" name="ciudad"
                                            class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                            placeholder="{{ __('Ingrese la ciudad') }}" value="{{ old('ciudad') }}">

                                        <!-- Agrega los demás campos del cliente según tu estructura -->

                                        <x-input-error :messages="$errors->get('message')" />

                                        <x-primary-button class="mt-4">Agregar nuevo cliente</x-primary-button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Agrega los demás campos del cliente según tu estructura -->

                        <x-input-error :messages="$errors->get('message')" />
                    </form>
                </div>
            </div>
        </div>


        <!-- Tabla para visualizar los usuarios -->
        <div class="mx-auto min-w-full">

            <table class=" w-100 mx-auto  bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Cédula</th>
                        <th class="py-2 px-4 border-b">Usuario</th>
                        <th class="py-2 px-4 border-b">Nombres</th>
                        <th class="py-2 px-4 border-b">Apellidos</th>
                        <th class="py-2 px-4 border-b">Número Telefónico</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Provincia</th>
                        <th class="py-2 px-4 border-b">Ciudad</th>
                        <th class="py-2 px-4 border-b">Estado</th>
                        <th class="py-2 px-4 border-b">Contrato</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td class="py-2 px-4 border-b text-center">{{ $cliente->cedula }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $cliente->usuario }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $cliente->nombres }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $cliente->apellidos }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $cliente->numTelefonico }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $cliente->email }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $cliente->provincia }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $cliente->ciudad }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                @if ($cliente->activo == 1)
                                    Activo {{-- Agregar imagen de estado activo  --}}
                                @else
                                    Inactivo {{-- Agregar imagen de estado inactivo --}}
                                @endif
                            </td>
                            <td>Boton Agregar Contrato</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>



    </div>

</x-app-layout>
