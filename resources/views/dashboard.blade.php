<x-app-layout>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto py-8">
                        <h1 class="text-2xl font-semibold mb-4">Conversaciones de WhatsApp</h1>

                        <!-- Sección de mensajes recibidos -->
                        <div>
                            <h2 class="text-lg font-semibold mb-2">Mensajes recibidos:</h2>
                            <ul>
                                @foreach ($messages as $message)
                                    <li>
                                        <strong>Teléfono:</strong> {{ $message->phone }} <br>
                                        <strong>Mensaje:</strong> {{ $message->message }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Sección de notificaciones -->
                        <div class="mt-8">
                            <h2 class="text-lg font-semibold mb-2">Notificaciones:</h2>
                            <ul>
                                @foreach ($notifications as $notification)
                                    <li>
                                        <strong>Remitente:</strong> {{ $notification->sender }} <br>
                                        <strong>Mensaje:</strong> {{ $notification->message }}
                                        <a href="{{ route('dashboard.reply', $notification->id) }}" class="text-blue-500 hover:underline">Responder</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Formulario de respuesta -->
                        <div class="mt-8">
                            <h1 class="text-2xl font-semibold mb-4">Respuesta a {{ $notification->sender }}</h1>
                            <form action="{{ route('dashboard.sendReply', $notification->id) }}" method="POST">
                                @csrf
                                <textarea name="reply" class="w-full h-32 border-gray-300 rounded-md px-4 py-2 mb-4" placeholder="Escribe tu respuesta..."></textarea>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Enviar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('layouts.footer')
</x-app-layout>
