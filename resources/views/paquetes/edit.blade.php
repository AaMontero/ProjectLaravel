<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Packages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action = "{{ route('paquetes.update', $paquete) }}">
                        @csrf @method('PUT')
                        Descripción del paquete
                        <textarea name="message"
                            class="block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{ __('Put what you want to add here') }}">{{ old('message', $paquete->message) }}</textarea>
                        <x-input-error :messages="$errors->get('message')" />

                        <p class="mt-1 p-1 ml-4">Número de días: </p>
                        <input type="number" name="num_dias"
                            class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{ __('Put your message here') }}"
                            value="{{ old('num_dias', $paquete->num_dias) }}">


                        <p class="mt-1 p-1 ml-4">Número de noches:</p>
                        <input type="number" name="num_noches"
                            class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{ __('Put your message here') }}"
                            value="{{ old('num_noches', $paquete->num_noches) }}">

                        <p class="mt-1 p-1 ml-4">Precio Afiliados:</p>
                        <input type="number" name="precio_afiliado" step="0.01"
                            class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{ __('Put your message here') }}"
                            value="{{ old('precio_afiliado', $paquete->precio_afiliado) }}">

                        <p class="mt-1 p-1 ml-4">Precio no afiliados:</p>
                        <input type="number" name="precio_no_afiliado" step="0.01"
                            class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                            placeholder="{{ __('Put your message here') }}"
                            value="{{ old('predio_no_afiliado', $paquete->precio_no_afiliado) }}">
                        <p class="mt-1 p-1 ml-4">Imagen del paquete:</p>
                        <input type="file" name="imagen_paquete" class ="form-control mb-2">
                        <input type="hidden" id = "lista_caracteristicas" name = "lista_caracteristicas">
                        <div>
                            <p class="mt-1 p-1 ml-4">Característica</p>
                            <div class = "ml-10">
                                @foreach ($paquete->incluye as $caracteristica)
                                    <li class="spaninfo flex items-center">
                                        <img src="{{ asset('images/iconoEtiqueta.png') }}" class="w-4 h-4 mr-2"
                                            alt="Check Circle Icon">
                                        <input class = "w-100"type="text" value = "{{ old('caracteristica_paquete',  $caracteristica->descripcion)}}">
                                    </li>
                                @endforeach
                            </div>

                            <div class="flex">
                                <input type="text" name="caracteristica" id="caracteristica"
                                    class="mb-2 block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                                    placeholder="{{ __('Ingrese su característica aquí') }}"
                                    value="{{ old('caracteristica') }}">
                                <button type="button" onclick="agregarCaracteristica()"
                                    class="ml-2 h-full bg-blue-500 text-white font-bold py-2 px-4 rounded">
                                    Agregar
                                </button>
                            </div>
                            <x-primary-button class='mt-4'>Realizar Ediciones</x-primary-button>

                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
