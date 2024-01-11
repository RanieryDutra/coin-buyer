<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function () {
        // Aguarde 3 segundos e remova a classe 'fade-out'
        setTimeout(function () {
            $('#alertM').removeClass('alert');
        }, 7000);

        setTimeout(function () {
            $('#alertM').remove();
        }, 7001);
    });
</script>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Compra de Moedas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div > <!-- class="p-6 text-black-900 dark:text-black-100" -->
                    <div class="container">

                        @if(isset($mensagem1))
                        <div id="alertM" class="alert">
                            {{ $mensagem1 }}
                        </div>
                        @endif

                        @if(isset($mensagem2))
                        <div id="alertM" class="alert">
                            {{ $mensagem2 }}
                        </div>
                        @endif

                        <form action="{{ route('result.query') }}" method="POST" id="currencyForm">
                            @csrf
                            <label for="moedaOrigem">Moeda de Origem (BRL):</label>
                            <input type="text" id="moedaOrigem" name="moedaOrigem" value="BRL" readonly>
                
                            <label for="moedaDestinoTitulo">Moeda de Destino:</label>
                            <select id="moedaDestino" name="moedaDestino">
                                <option value="USD">USD</option>
                                <option value="EUR">EUR</option>
                                <option value="BTC">BTC</option>
                            </select>
                
                            <label for="quantidade">Quantidade:</label>
                            <input type="number" id="quantidade" name="quantidade" placeholder="Insira a quantidade">
                
                            <label for="metodoPagamento">Método de Pagamento:</label>
                            <select id="metodoPagamento" name="metodoPagamento">
                                <option value= 'boleto'>Boleto</option>
                                <option value= 'cartao'>Cartão de Crédito</option>
                            </select>
                
                            <button class="bt" type="submit" >Converter</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>