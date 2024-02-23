<x-app-layout>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-4">
                <!-- Notificaciones -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4">Notificaciones</h3>
                    <div class="space-y-4">
                        <div class="border border-gray-300 rounded-lg py-2 px-4">
                            <strong>Admin</strong>: Bienvenido al sistema.
                        </div>
                        <div class="border border-gray-300 rounded-lg py-2 px-4">
                            <strong>Usuario 1</strong>: Tienes un nuevo mensaje.
                        </div>
                        <div class="border border-gray-300 rounded-lg py-2 px-4">
                            <strong>Usuario 2</strong>: Tu factura ha sido procesada.
                        </div>
                    </div>
                </div>

                <!-- Chat -->
                <div class="bg-white dark:bg-slate-800  overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4">Chat</h3>
                    <div class="flex flex-col h-64 border border-gray-300 rounded-lg">
                        <!-- Historial de mensajes -->
                        <div class="overflow-y-auto flex-1 p-4 space-y-4">
                            <div class="flex items-start">
                                <img src="https://via.placeholder.com/40" alt="User" class="w-8 h-8 rounded-full mr-2">
                                <div>
                                    <strong class="text-blue-500">Tú:</strong>
                                    <p class="bg-blue-100 rounded-lg py-2 px-4">Hola, ¿cómo estás?</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <img src="https://via.placeholder.com/40" alt="User" class="w-8 h-8 rounded-full mr-2">
                                <div>
                                    <strong class="text-blue-500">Usuario:</strong>
                                    <p class="bg-blue-100 rounded-lg py-2 px-4">¡Hola! Estoy bien, gracias. ¿Y tú?</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <img src="https://via.placeholder.com/40" alt="User" class="w-8 h-8 rounded-full mr-2">
                                <div>
                                    <strong class="text-blue-500">Tú:</strong>
                                    <p class="bg-blue-100 rounded-lg py-2 px-4">Muy bien, gracias por preguntar.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Campo de texto para escribir -->
                        <form action="#" method="POST" class="p-4 border-t border-gray-300">
                            @csrf
                            <div class="flex">
                                <input type="text" name="message" class="flex-1 border border-gray-300 rounded-l-md px-4 py-2 focus:outline-none focus:ring focus:border-blue-500" placeholder="Escribe un mensaje...">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r-md">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





    @include('layouts.footer')
</x-app-layout>
