<x-app-layout>
    <link rel="stylesheet" href="{{ asset('../resources/css/estilosProductos.css') }}" />
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Packages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div id = " "class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action = "{{ route('paquetes.store') }}">
                        @csrf
                        <p class="mt-1 p-1 ml-4">Nombre del paquete:</p>
                        <input type="text" name="nombre_paquete"
                            class="mb-4 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{ __('Put your message here') }}" value="{{ old('nombre_paquete') }}">

                        {{-- message --}}
                        <p class="mt-1 p-1 ml-4">Descripción del paquete</p>
                        <input type="text" name="message"
                            class="mb-4 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{ __('Put your message here') }}" value="{{ old('message') }}">

                        <p class="mt-1 p-1 ml-4">Número de días: </p>
                        <input type="number" name="num_dias"
                            class="mb-4 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{ __('Put your message here') }}" value="{{ old('num_dias') }}">


                        <p class="mt-1 p-1 ml-4">Número de noches:</p>
                        <input type="number" name="num_noches"
                            class="mb-4 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{ __('Put your message here') }}" value="{{ old('num_noches') }}">

                        <p class="mt-1 p-1 ml-4">Precio Afiliados:</p>
                        <input type="number" name="precio_afiliado" step="0.01"
                            class="mb-4 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{ __('Put your message here') }}" value="{{ old('precio_afiliado') }}">

                        <p class="mt-1 p-1 ml-4">Precio no afiliados:</p>
                        <input type="number" name="precio_no_afiliado" step="0.01"
                            class="mb-4 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{ __('Put your message here') }}" value="{{ old('predio_no_afiliado') }}">
                        <p >Listado de caracteristicas</p>
                        <x-input-error :messages="$errors->get('message')" />
                        <x-primary-button class='mt-4'>Agregar</x-primary-button>

                    </form>
                </div>
            </div>
        </div>
        <div class="mt-6 mr-20 ml-20 bg-white dark:bg-gray-800 shadow-sm rounded-lg divide-y dark:divide-gray-900">
            @foreach ($paquetes as $paquete)
                <div class=" p-6 bg-transparent flex justify-between items-center bg-transparent">
                    <div class="p-6 flex space-x-2">
                        <svg class="h-6 w-6 text-gray-600 dark:text-gray-400 -scale-x-100" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"></path>
                        </svg>

                        <p class="text-gray-800 dark:text-gray-200">Nombre del paquete: {{ $paquete->nombre_paquete }}
                        </p>
                        <!-- Mensaje del paquete -->
                        <p class="text-gray-800 dark:text-gray-200">Descripcion: {{ $paquete->message }}</p>

                        <p class="text-gray-800 dark:text-gray-200"> Numero de días: {{ $paquete->num_dias }}</p>

                        <p class="text-gray-800 dark:text-gray-200"> Número de Noches: {{ $paquete->num_noches }}</p>
                        <p class="text-gray-800 dark:text-gray-200"> Precio para afiliados:
                            {{ $paquete->precio_afiliado }}
                        </p>
                        <p class="text-gray-800 dark:text-gray-200"> Predio para no Afiliados:
                            {{ $paquete->precio_no_afiliado }}</p>

                        <!-- Mostrar las características del paquete -->
                        <p class="text-gray-800 dark:text-gray-200">Características del paquete:</p>
                        <ul>
                            @foreach ($paquete->incluye as $caracteristica)
                                <li>{{ $caracteristica->descripción }}</li>
                            @endforeach
                        </ul>


                    </div>

                    <!-- Dropdown para acciones -->
                    <x-dropdown>
                        <x-slot name="trigger">
                            <button>
                                <svg class="w-5 h-5 text-gray-400 dark:text-gray-200" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Enlace para editar el paquete -->
                            <x-dropdown-link :href="route('paquetes.edit', $paquete)">
                                {{ __('Edit Package') }}
                            </x-dropdown-link>

                            <!-- Formulario para eliminar el paquete -->
                            <form method="POST" action="{{ route('paquetes.destroy', $paquete) }}">
                                @csrf @method('DELETE')
                                <x-dropdown-link :href="route('paquetes.destroy', $paquete)"
                                    onclick="event.preventDefault(); this.closest('form').submit()">
                                    {{ __('Delete Package') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Separador entre paquetes -->
                <hr class="my-4 border-gray-300 dark:border-gray-700">
            @endforeach
        </div>



    </div>
    </div>
</x-app-layout>
