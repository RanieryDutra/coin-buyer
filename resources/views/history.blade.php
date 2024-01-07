<link rel="stylesheet" href="{{ asset('css/styleHistory.css') }}">

<x-app-layout>
    <x-slot name="header">
        @auth
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Histórico das Cotações do(a)') }} {{ auth()->user()->name }}
        </h2>
        @endauth
    </x-slot>

    <ul>
        @foreach ($historicoDeConversao as $conversao)
        @php
        $conversionData = \Carbon\Carbon::parse($conversao->conversion_data);   
        @endphp
        <li>    
            <div class="py-4">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div > <!-- class="p-6 text-black-900 dark:text-black-100" -->
                            <div class="container">
                                <p>Valor da conversão: {{ $conversao->value_for_conversion }}</p>
                                <p>Data da conversão:  {{ $conversionData->format('d/m/Y H:i:s') }}</p>
                                </br>
                                <a class="details" href="{{ route('result.history', ['id' => $conversao->id]) }}"> Mais detalhes da cotação </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</x-app-layout>
