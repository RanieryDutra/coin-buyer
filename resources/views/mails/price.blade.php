<link rel="stylesheet" href="{{asset('css/styleResult.css') }}">

    <div class="container" id="contContainer">
        <h2>Detalhes da Cotação</h2>
            <div id="apiResponse">
                    <p><strong>Email:</strong> {{$data['fromEmail']}}</p>
                    <p><strong>Nome:</strong> {{$data['fromName']}}</p>
                    <p><strong>Data da Conversão:</strong> {{$data['message']['conversion_data']}}</p>
                    <p><strong>Moeda de Origem:</strong> {{$data['message']['origin_currency']}}</p>
                    <p><strong>Moeda de Destino:</strong> {{$data['message']['destination_currency']}}</p>
                    <p><strong>Valor para Conversão:</strong> {{$data['message']['value_for_conversion']}}</p>
                    <p><strong>Forma de Pagamento:</strong> {{$data['message']['form_of_payment']}}</p>
                    <p><strong>Valor da "Moeda de Destino" usado para Conversão:</strong> {{$data['message']['value_of_the_quoted_currency']}}</p>
                    <p><strong>Valor Comprado em "Moeda de Destino":</strong> {{$data['message']['purchased_value_of_quoted_currency']}}</p>
                    <p><strong>Taxa de Pagamento:</strong> {{$data['message']['payment_rate']}}</p>    
                    <p><strong>Taxa de Conversão:</strong> {{$data['message']['conversion_rate']}}</p>
                    <p><strong>Valor Utilizado para Conversão Descontando Taxas:</strong> {{$data['message']['total_value_excluding_rates']}}</p>
            </div>
    </div>