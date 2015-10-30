<?php
    setlocale(LC_TIME, 'es_MX.UTF-8');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Reporte de Ingresos</title>
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
        margin-right: 15px;
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
        position: fixed;
        left: 0px;
        bottom: -180px;
        right: 0px;
        height: 100px;
        text-align: center;

    }

    #footer .page:after {
            content: "Pág " counter(page) " de " counter(pages);
        
    }

    #footer .small{
        font-size: 11px;
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
            $footer = $pdf->page_text( 260, 800, "Pág: {PAGE_NUM} de {PAGE_COUNT}", $font, 10, array(0,0,0));
        }

    </script>

    <div id="header">
        <img src="{{asset('assets/images/pdf/header.jpg')}}" alt="" />
        <h2>Reporte de Ingresos </h2>
       
             
       
        <p class="small">
             @if($neighbor_property_id == 'Todos')
                De Todos los Vecinos
            @endif
            De {{ strftime("%d %b %Y", strtotime($desde)) }} A {{ strftime("%d %b %Y", strtotime($hasta)) }}
        </p>
    </div>

    <div id="footer" class="small" >
        <p class="small">Reporte generado: {{ strftime("%B %d, %Y, %I:%M %p")  }}</p>
    </div>

<div class="contenedor">
    <div class="contenido">
        <table class="display table table-striped table-hover" id="table-2">

					  <thead>

						<tr>

						  <th width="10">ID</th>
						  <th>Fecha</th>
						  <th>Hora</th>
                          <th>Vecino</th>
						  <th>Concepto</th>
						  <th width="20">Monto</th>
						  <th>Cobrador</th>

						  <th>Comentarios</th>

						</tr>
					  </thead>

					  <tbody>
						@foreach($payments as $row)

						<tr>
							<td>{{$row->id}}</td>

							<td>{{strftime("%d/%b/%Y",strtotime($row->created_at))}} </td>
							<td>{{date('h:ia', strtotime($row->created_at))}}</td>
                            <td>{{$row->name}} {{$row->last_name}}</td>
							<td>{{$row->description}}</td>
							<td class="valor">${{number_format($row->amount,2,'.',',')}}</td>
							<?php

								 $cobrador = Collector::join('users','users.id' , '=', 'collectors.user_id')
	                             ->join('neighbors','neighbors.user_id' , '=', 'users.id')
	                             ->where('collectors.id','=',$row->collector_id)
	                             ->first();
                            ?>
							<td>{{$cobrador->name}} {{$cobrador->last_name}}</td>

							<td>{{$row->coments}}</td>


						</tr>
						@endforeach
					  </tbody>
					</table>
    </div>
</div>
</body>
</html>
