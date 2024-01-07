<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\History;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\View;
use NumberFormatter;

class MainController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function index2()
    {
        $id_usuario = Auth::id();

        $historicoDeConversao = History::where('id_usuario', $id_usuario)->get();

        //dd($historicoDeConversao); 
        
        return view('history', ['historicoDeConversao' => $historicoDeConversao]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $padrao = new NumberFormatter("pt_BR", NumberFormatter::CURRENCY);

        if ($request->moedaOrigem = 'BRL') {
            if ($request->quantidade >= 1000 && $request->quantidade <= 100000 ) {
                $client = new Client();

                $response = $client->get('https://economia.awesomeapi.com.br/' . $request->moedaDestino . '-' . $request->moedaOrigem . '/1');
        
                $data = $response->getBody()->getContents();
        
                $dataResponse = json_decode($data, true);

                //$valorMoedaDestino = number_format($dataResponse[0]['bid'],2,'.','');
                $valorMoedaDestino = $padrao->formatCurrency(number_format($dataResponse[0]['bid'],2,'.',''), $request->moedaDestino);

                if ($request->metodoPagamento == 'boleto') {

                    $valorCompra = $request->quantidade;

                    $valorCompraComDescontos = $valorCompra - $taxaPagamento = ( 1.45 * $valorCompra / 100);

                    $valorCompraFinal = ($valorCompraComDescontos < 3000) ? $valorCompraComDescontos - $taxaConversao = number_format((2 * $valorCompra / 100), 2, '.', '') : $valorCompraComDescontos - $taxaConversao = number_format((1 * $valorCompra / 100), 2, '.', '');

                    $valorCompraConvertido = $padrao->formatCurrency($valorCompraFinal / number_format($dataResponse[0]['bid'],2,'.',''), $request->moedaDestino);

                    $taxaPagamentoFormatado = $padrao->formatCurrency($taxaPagamento, "BRL");
                    $taxaConversaoFormatado = $padrao->formatCurrency($taxaConversao, "BRL");
                    $valorCompraFormatado = $padrao->formatCurrency($request->quantidade, "BRL");
                    $valorCompraFinalFormatado = $padrao->formatCurrency($valorCompraFinal, "BRL");
                    $metodoPagamentoFormatado = 'Boleto';

                    $dataHoraConversao = Carbon::now()->setTimezone('America/Sao_Paulo')->format('Y-m-d H:i:s');

                    $History = new History([
                        'id_usuario' => Auth::id(),
                        'origin_currency' => $request->moedaOrigem,
                        'destination_currency' => $request->moedaDestino,
                        'value_for_conversion' => $valorCompraFormatado,
                        'form_of_payment' => $metodoPagamentoFormatado,
                        'value_of_the_quoted_currency' => $valorMoedaDestino,
                        'purchased_value_of_quoted_currency' => $valorCompraConvertido,
                        'payment_rate' => $taxaPagamentoFormatado,
                        'conversion_rate' => $taxaConversaoFormatado,
                        'total_value_excluding_rates' => $valorCompraFinalFormatado,
                        'conversion_data' => $dataHoraConversao
                    ]);

                    $History->save();

                    return view('result',
                    [
                        'moedaOrigem' => $request->moedaOrigem,
                        'moedaDestino' => $request->moedaDestino,
                        'valorConversao' => $valorCompraFormatado,
                        'formaPagamento' => $metodoPagamentoFormatado,
                        'valorDestinoUsado' => $valorMoedaDestino,
                        'valorCompradoDestino' => $valorCompraConvertido,
                        'taxaPagamento' => $taxaPagamentoFormatado,
                        'taxaConversao' => $taxaConversaoFormatado,
                        'valorUtilizadoDescontandoTaxas' => $valorCompraFinalFormatado
                    ]);

                }  else if ($request->metodoPagamento == 'cartao') {
                    $valorCompra = $request->quantidade;

                    $valorCompraComDescontos = $valorCompra - $taxaPagamento = ( 7.63 * $valorCompra / 100);

                    $valorCompraFinal = ($valorCompraComDescontos < 3000) ? $valorCompraComDescontos - $taxaConversao = number_format((2 * $valorCompra / 100), 2, '.', '') : $valorCompraComDescontos - $taxaConversao = number_format((1 * $valorCompra / 100), 2, '.', '');

                    $valorCompraConvertido = $padrao->formatCurrency($valorCompraFinal / number_format($dataResponse[0]['bid'],2,'.',''), $request->moedaDestino);

                    $taxaPagamentoFormatado = $padrao->formatCurrency($taxaPagamento, "BRL");
                    $taxaConversaoFormatado = $padrao->formatCurrency($taxaConversao, "BRL");
                    $valorCompraFormatado = $padrao->formatCurrency($request->quantidade, "BRL");
                    $valorCompraFinalFormatado = $padrao->formatCurrency($valorCompraFinal, "BRL");
                    $metodoPagamentoFormatado = 'Cartão de Credito';

                    $dataHoraConversao = Carbon::now()->setTimezone('America/Sao_Paulo')->format('Y-m-d H:i:s');

                    $History = new History([
                        'id_usuario' => Auth::id(),
                        'origin_currency' => $request->moedaOrigem,
                        'destination_currency' => $request->moedaDestino,
                        'value_for_conversion' => $valorCompraFormatado,
                        'form_of_payment' => $metodoPagamentoFormatado,
                        'value_of_the_quoted_currency' => $valorMoedaDestino,
                        'purchased_value_of_quoted_currency' => $valorCompraConvertido,
                        'payment_rate' => $taxaPagamentoFormatado,
                        'conversion_rate' => $taxaConversaoFormatado,
                        'total_value_excluding_rates' => $valorCompraFinalFormatado,
                        'conversion_data' => $dataHoraConversao
                    ]);

                    $History->save();

                    return view('result',
                    [
                        'moedaOrigem' => $request->moedaOrigem,
                        'moedaDestino' => $request->moedaDestino,
                        'valorConversao' => $valorCompraFormatado,
                        'formaPagamento' => $metodoPagamentoFormatado,
                        'valorDestinoUsado' => $valorMoedaDestino,
                        'valorCompradoDestino' => $valorCompraConvertido,
                        'taxaPagamento' => $taxaPagamentoFormatado,
                        'taxaConversao' => $taxaConversaoFormatado,
                        'valorUtilizadoDescontandoTaxas' => $valorCompraFinalFormatado
                    ]);

                }


                //dd($request->metodoPagamento);
                //dd($dataArray[0]['code']);
        }   else dd('notGod2'); 
    } else dd('notGod1');

    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $conversaoHistorico = History::where('id', $id)->get();

        //dd($conversaoHistorico[0]->origin_currency);
        
        return view('result',
        [
            'moedaOrigem' => $conversaoHistorico[0]->origin_currency,
            'moedaDestino' => $conversaoHistorico[0]->destination_currency,
            'valorConversao' => $conversaoHistorico[0]->value_for_conversion,
            'formaPagamento' => $conversaoHistorico[0]->form_of_payment,
            'valorDestinoUsado' => $conversaoHistorico[0]->value_of_the_quoted_currency,
            'valorCompradoDestino' => $conversaoHistorico[0]->purchased_value_of_quoted_currency,
            'taxaPagamento' => $conversaoHistorico[0]->payment_rate,
            'taxaConversao' => $conversaoHistorico[0]->conversion_rate,
            'valorUtilizadoDescontandoTaxas' => $conversaoHistorico[0]->total_value_excluding_rates
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
