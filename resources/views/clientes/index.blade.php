<x-app-layout>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
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
        <div id="idAgregarCliente" class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4" style="display: none;">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" enctype="multipart/form-data" action = "{{ route('clientes.store') }} ">
                        @csrf
                        <p class="mt-1 p-1 ml-4">Cédula:</p>
                        <input type="text" name="cedula"
                            class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{ __('Ingrese la cédula') }}" value="{{ old('cedula') }}">

                        <p class="mt-1 p-1 ml-4">Nombres:</p>
                        <input type="text" name="nombres"
                            class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{ __('Ingrese los nombres') }}" value="{{ old('nombres') }}">

                        <p class="mt-1 p-1 ml-4">Apellidos:</p>
                        <input type="text" name="apellidos"
                            class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{ __('Ingrese los apellidos') }}" value="{{ old('apellidos') }}">

                        <p class="mt-1 p-1 ml-4">Número Telefónico:</p>
                        <input type="text" name="numTelefonico"
                            class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{ __('Ingrese el número telefónico') }}" value="{{ old('numTelefonico') }}">
                        <p class="mt-1 p-1 ml-4">Email:</p>
                        <input type="email" name="email"
                            class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{ __('Ingrese el correo electrónico') }}" value="{{ old('email') }}">

                        <p class="mt-1 p-1 ml-4">Provincia:</p>
                        <select name="provincia"
                            class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{ __('Seleccione la provincia') }}">
                            <option value="" disabled selected>
                                {{ __('Seleccione la provincia') }}</option>
                            @foreach ($provincias as $provincia)
                                <option value="{{ $provincia }}"
                                    {{ old('provincia') == $provincia ? 'selected' : '' }}>
                                    {{ $provincia }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1 p-1 ml-4">Ciudad:</p>
                        <input type="text" name="ciudad"
                            class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{ __('Ingrese la ciudad') }}" value="{{ old('ciudad') }}">

                        <!-- Agrega los demás campos del cliente según tu estructura -->
                        <x-input-error :messages="$errors->get('message')" />
                </div>
                <x-primary-button class='mt-4'>Agregar nuevo cliente</x-primary-button>
                <x-input-error :messages="$errors->get('message')" />
                </form>
            </div>
        </div>
        <script>
            function abrirVentanaAgregarPaquete() {

                var ventanaAgregarPaquete = document.getElementById("idAgregarCliente");
                console.log(ventanaAgregarPaquete.style.display);
                if (ventanaAgregarPaquete.style.display === 'none') {
                    ventanaAgregarPaquete.style.display = 'block';
                } else {
                    ventanaAgregarPaquete.style.display = 'none';
                }

                console.log("esta dando click en el boton para ocultar");

            }
        </script>
    </div>


    <!-- Tabla para visualizar los usuarios -->
    <div class="mx-auto min-w-full">

        <table class=" w-100 mx-auto  bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Cédula</th>
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
                        <td class="py-2 px-4 border-b text-center">{{ $cliente->nombres }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $cliente->apellidos }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $cliente->numTelefonico }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $cliente->email }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $cliente->provincia }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $cliente->ciudad }}</td>
                        <td class="py-2 px-4 border-b text-center">
                            @if ($cliente->activo == 1)
                                Activo
                            @else
                                Inactivo
                            @endif
                        </td>
                        <td>
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button>
                                        <svg class="ml-5 w-5 h-5 text-gray-400 dark:text-gray-200"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                        </svg>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('clientes.edit', $cliente)">
                                        {{ __('Editar Cliente') }}
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('layouts.footer')
</x-app-layout>
