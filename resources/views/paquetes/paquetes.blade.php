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
                </div>
                <form method="POST" action = "{{ route('paquetes.store') }}">
                    @csrf
                    <textarea name="message"
                        class="block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                        placeholder="{{ __('Put your message here') }}">{{ old('message') }}</textarea>
                    <textarea name="nombre_paquete"
                        class="block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                        placeholder="{{ __('Put your message here') }}">{{ old('message') }}</textarea>
                    <textarea name="num_dias"
                        class="block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                        placeholder="{{ __('Put your message here') }}">{{ old('message') }}</textarea>
                    <textarea name="num_noches"
                        class="block w-full rounded-md border-gray-300 bg-white shadow-sm transition-colors duration-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:border-indigo-300 dark:focus:ring dark:focus:ring-indigo-200 dark:focus:ring-opacity-50"
                        placeholder="{{ __('Put your message here') }}">{{ old('message') }}</textarea>
                    <x-input-error :messages="$errors->get('message')" />
                    <x-primary-button class='mt-4'>Agregar</x-primary-button>

                </form>
            </div>
        </div>
        <div class="mt-6 mr-6 ml-6 bg-white dark:bg-gray-800 shadow-sm rounded-lg divide-y dark:divide-gray-900">
            @foreach ($paquetes as $paquete)
                <div class=" p-6 bg-transparent flex justify-between items-center bg-transparent">
                    <div>
                        <!-- Nombre del usuario -->
                        <span class="font-semibold">{{ $paquete->user->name }}</span>

                        <!-- Indicador de edición si ha sido editado -->
                        @if ($paquete->created_at != $paquete->updated_at)
                            <small class="text-gray-500 dark:text-gray-400">{{ __('edited') }}</small>
                        @endif

                        <!-- ID del usuario -->
                        <p class="text-gray-600 dark:text-gray-300">User ID: {{ $paquete->user_id }}</p>

                        <!-- Mensaje del paquete -->
                        <p class="text-gray-800 dark:text-gray-200">{{ $paquete->message }}</p>

                        <!-- Fechas de creación y actualización -->
                        <p class="text-gray-600 dark:text-gray-300">Created:
                            {{ $paquete->created_at->format('Y-m-d') }}
                        </p>
                        <p class="text-gray-600 dark:text-gray-300">Updated:
                            {{ $paquete->updated_at->format('Y-m-d') }}</p>
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
