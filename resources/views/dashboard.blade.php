<x-app-layout>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="flex max-w sm:px-6 mx-auto shadow-xls">
        <!-- Notificaciones-->
        <div id="notificaciones" class="bg-white dark:bg-slate-200 rounded-lg px-6 py-4 mt-4 ring-1 ring-slate-900/5">
            <h3 class="text-xl font-semibold mb-4">Notificaciones</h3>
            <div class="space-y-4">
                <!-- Notificación 1 -->
                <div class="flex items-center justify-between px-4 py-2 bg-gray-100 dark:bg-gray-800 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                    <div class="flex items-center space-x-2">
                        <img src="https://via.placeholder.com/40" alt="User" class="w-8 h-8 rounded-full">
                        <div>
                            <strong>Admin</strong>: Bienvenido al sistema.
                        </div>
                    </div>
                    <button  onclick="showChat()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Ver</button>
                </div>
                <!-- Notificación 2 -->
                <div class="flex items-center justify-between px-4 py-2 bg-gray-100 dark:bg-gray-800 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                    <div class="flex items-center space-x-2">
                        <img src="https://via.placeholder.com/40" alt="User" class="w-8 h-8 rounded-full">
                        <div>
                            <strong>Usuario 1</strong>: Tienes un nuevo mensaje.
                        </div>
                    </div>
                    <button  onclick="showChat()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Ver</button>
                </div>
                <!-- Notificación 3 -->
                <div class="flex items-center justify-between px-4 py-2 bg-gray-100 dark:bg-gray-800 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                    <div class="flex items-center space-x-2">
                        <img src="https://via.placeholder.com/40" alt="User" class="w-8 h-8 rounded-full">
                        <div>
                            <strong>Usuario 2</strong>: Tu factura ha sido procesada.
                        </div>
                    </div>
                    <button  onclick="showChat()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Ver</button>
                </div>
            </div>
        </div>

        <!-- Chats de Whatsapp -->
        <div id="chat" class="bg-white dark:bg-slate-200 rounded-lg px-6 py-8 mt-4 ring-1 ring-slate-900/5 shadow-xl" style="border-color: #4a5568;">
            <h3 class="text-xl font-semibold mb-4">Chat</h3>
            <div class="flex flex-col h-64 border border-gray-300 rounded-lg" style="border-color: #4a5568;">
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

    @include('layouts.footer')

    <script>
        function abrirChat() {
            var notificaciones = document.getElementById('notificaciones');
            var chat = document.getElementById('chat');

            // Ocultar notificaciones y mostrar chat
            notificaciones.style.display = 'none';
            chat.style.display = 'block';
        }
    </script>
</x-app-layout>
