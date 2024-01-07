<link rel="stylesheet" href="{{ asset('css/styleResult.css') }}">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Resultado da Cotação') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div > <!-- class="p-6 text-black-900 dark:text-black-100" -->
                    <div class="container">
                        <h2>Detalhes da Cotação</h2>
                            <div id="apiResponse">
                                    <p><strong>Moeda de Origem:</strong> {{$moedaOrigem}}</p>
                                    <p><strong>Moeda de Destino:</strong> {{$moedaDestino}}</p>
                                    <p><strong>Valor para Conversão:</strong> {{$valorConversao}}</p>
                                    <p><strong>Forma de Pagamento:</strong> {{$formaPagamento}}</p>
                                    <p><strong>Valor da "Moeda de Destino" usado para Conversão:</strong> {{$valorDestinoUsado}}</p>
                                    <p><strong>Valor Comprado em "Moeda de Destino":</strong> {{$valorCompradoDestino}}</p>
                                    <p><strong>Taxa de Pagamento:</strong> {{$taxaPagamento}}</p>
                                    <p><strong>Taxa de Conversão:</strong> {{$taxaConversao}}</p>
                                    <p><strong>Valor Utilizado para Conversão Descontando Taxas:</strong> {{$valorUtilizadoDescontandoTaxas}}</p>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
