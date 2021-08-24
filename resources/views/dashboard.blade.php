<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg text-center">
{{--                <x-jet-welcome />--}}

                <h1 class="text-xl">
                    <br><br><br>
                    Bienvenido !
                    <br><br><br>
                </h1>
                ( acceda al dashboard desde el menú de perfil )
                <br><br><br>
                <br><br><br>

            </div>
        </div>
    </div>
</x-app-layout>
