<?php
    setlocale(LC_TIME, 'es_MX.UTF-8');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Pagos</title>
    <style>

    @page {
        margin: 180px 15px;
    }

    .contenedor {
        font-size: 12px;
        font-weight: normal;
        margin: 0 auto;
        line-height: 1.4;
        padding: 0;
    }

    .cabecera {
        display: block;
        margin: auto;
        position: relative;
        text-align: center;
    }

    h2, .cabecera{
        margin-top: 10px;
        padding: 5px 5px;
        text-transform: uppercase;
    }

    .contenido {
        display: block;
        margin-top: 10px;
        position: relative;
        text-align: left;
    }

    #header {
        position: fixed;
        left: 0px;
        top: -180px;
        right: 0px;
        height: 200px;
        text-align: center;
    }

    #header p.small {
        font-size: 11px;
    }

    #footer {
        counter-reset: page 1;
        position: fixed;
        left: 0px;
        bottom: -180px;
        right: 0px;
        height: 100px;
        text-align: center;
    }

    #footer .page:before {
        content: "Pág " counter(page);
    }

    #footer .page2:after {
        counter-reset: page;
        counter-increment: page;
        content: " de " counter(page);
    }

    table {
        border-spacing: 0;
        border-collapse: collapse;
        max-width: 100%;
        margin-bottom: 20px;
        text-align: left;
        width: 100%;
    }

    th {
        text-transform: uppercase;
    }

    td, th {
        padding: 0;
        text-align: left;
    }

    .valor {
        text-align: right;
    }

    .table > thead > tr > th,
    .table > tbody > tr > th,
    .table > tfoot > tr > th,
    .table > thead > tr > td,
    .table > tbody > tr > td,
    .table > tfoot > tr > td {
      padding: 8px;
      line-height: 1.42857143;
      vertical-align: top;
      border-top: 1px solid #ddd;
    }
    .table > thead > tr > th {
      vertical-align: bottom;
      border-bottom: 2px solid #ddd;
    }
    .table > caption + thead > tr:first-child > th,
    .table > colgroup + thead > tr:first-child > th,
    .table > thead:first-child > tr:first-child > th,
    .table > caption + thead > tr:first-child > td,
    .table > colgroup + thead > tr:first-child > td,
    .table > thead:first-child > tr:first-child > td {
      border-top: 0;
    }
    .table > tbody + tbody {
      border-top: 2px solid #ddd;
    }
    .table .table {
      background-color: #fff;
    }
    .table-condensed > thead > tr > th,
    .table-condensed > tbody > tr > th,
    .table-condensed > tfoot > tr > th,
    .table-condensed > thead > tr > td,
    .table-condensed > tbody > tr > td,
    .table-condensed > tfoot > tr > td {
      padding: 5px;
    }

    .table-striped > tbody > tr:nth-of-type(odd) {
      background-color: #f9f9f9;
    }

    .tex-right {
        display: block;
        float: right;
        margin: 20px 20px;
        text-align: right;
    }

    </style>
</head>
<body>

    <script type="text/php">

        if (isset($pdf)) {

            $font = Font_Metrics::get_font("verdana", "bold");
            $footer = $pdf->page_text( 260, 800, "Pág: {PAGE_NUM} de {PAGE_COUNT}", $font, 12, array(0,0,0));
        }

    </script>

    <div id="header">
        <img src="{{asset('assets/images/pdf/header.jpg')}}" alt="" />
        <h2>Reporte de Pagos</h2>

        <p class="small">
            De {{ strftime("%d %b %Y", strtotime($desde)) }} A {{ strftime("%d %b %Y", strtotime($hasta)) }}
        </p>
    </div>

    <div id="footer">
        <p>Reporte generado: {{ strftime("%B %d, %Y, %I:%M %p")  }}</p>
    </div>

<div class="contenedor">
    <div class="contenido">
        <table class="table table-striped table-condensed " id="table-record">
        <thead>
            <tr>
                <th>ID</th>
                <th>FECHA</th>
                <th nowrap>NOMBRE VECINO</th>
                <th>CONCEPTO</th>
                <th class="valor">CARGO</th>
                <th class="valor">ABONO</th>
                <th class="valor">SALDO</th>
            </tr>
        </thead>

        <tbody>

    <?php $mesActual = date("m"); $cont = 1; $saldo = -$cuotas[$mes_ini]; ?>


    @for($i=$mes_ini; $i<=$mesActual; $i++)

                    <?php

                    if($i <= 9)
                        $mes_corriente = date('Y')."-0".$i;
                    else
                        $mes_corriente = date('Y')."-".$i;

                    if($i != $mes_ini){
                        if($saldo < 0 )
                            $saldo = $saldo + $cuotas[$i];
                        else
                           $saldo = $saldo - $cuotas[$i];
                    }

                    ?>

                    <tr>
                                        <td>{{$cont++}}</td>
                                        <td>01/{{$mes[$i-1]}}/{{date("Y")}}</td>
                                        <td nowrap>{{$payments[0]->name}} {{$payments[0]->last_name}}</td>
                                        <td>Cuota {{$meses[$i-1]}}</td>
                                        <td class="valor">${{number_format($cuotas[$i],2,'.',',')}}</td>
                                        <td class="valor"></td>
                                        <td class="valor">${{number_format($saldo,2,'.',',')}}</td>
                   </tr>

        @foreach($payments as $payment)
            @if(strftime("%Y-%m",strtotime($payment->created_at)) == $mes_corriente )
                <tr>
                                        <td>{{$cont++}}</td>
                                        <td>{{strftime("%d/%b/%Y",strtotime($payment->created_at)) }}</td>
                                        <td>{{$payment->name}} {{$payment->last_name}}</td>

                                        @if ($payment->description == "Pago de cuota mensual")

                                        <?php $saldo = $payment->amount + $saldo; ?>

                                            <td>Su abono gracias</td>
                                            <td class="valor"></td>
                                            <td class="valor">${{number_format($payment->amount,2,'.',',')}}</td>
                                            <td class="valor">${{number_format($saldo,2,'.',',')}}</td>
                                        @else
                                        <?php $saldo = $saldo - $payment->amount; ?>

                                            <td>{{$payment->description}}</td>
                                            <td class="valor">${{number_format($payment->amount,2,'.',',')}}</td>
                                            <td class="valor"></td>
                                            <td class="valor">${{number_format($saldo,2,'.',',')}}</td>
                                            <tr>

                                        <?php $saldo = $saldo + $payment->amount; ?>
                                                    <td>{{$cont++}}</td>
                                                    <td>{{strftime("%d/%b/%Y",strtotime($payment->created_at)) }}</td>
                                                    <td>{{$payment->name}} {{$payment->last_name}}</td>
                                                    <td>{{$payment->description}}</td>
                                                    <td class="valor"></td>
                                                    <td class="valor">${{number_format($payment->amount,2,'.',',')}}</td>
                                                    <td class="valor">${{number_format($saldo,2,'.',',')}}</td>
                                           </tr>
                                        @endif

                </tr>
            @endif
        @endforeach
    @endfor
        </tbody>
    </table>
    </div>


</div>


</div>
</body>
</html>
