<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>

    <table>
      <tbody>

        <tr>
          <td>Factura</td>
          <td>{{ $datos['data'][0]['factura'][0]['nro_fact'] }}<</td>
        </tr>  


        <tr>
          <td>Fecha Emisi&oacute;n</td>
          <td>{{ $datos['data'][0]['factura'][0]['fecha_emi'] }}<</td>
        </tr>  

        <br>        

        <tr>
          <td>Cliente</td>
          <td>{{ $datos['data'][0]['cliente']['nombres'] }} {{ $datos['data'][0]['cliente']['apellidos'] }}</td>
        </tr>

        <tr>
          <td>Direcc&oacute;n</td>
          <td>{{ $datos['data'][0]['cliente']['direccion'] }}<</td>
        </tr>

        <tr>
          <td>RUC</td>
          <td>{{ $datos['data'][0]['cliente']['ci_cliente'] }}<</td>
        </tr>        

        <tr>
          <td>Tel&eacute;fono</td>
          <td>{{ $datos['data'][0]['cliente']['tlf_celular'] }}<</td>
        </tr>                  

      </tbody>
    </table>

    <br>
    <br>

    <table style="width:100%">
      <tr>
        <th>CANT.</th>
        <th>DESCRIPCI&Oacute;N</th>
        <th style="text-align: right;">V. UNIT.</th>
        <th style="text-align: right;">V. TOTAL</th>
      </tr>

        @foreach($datos['data'][0]['productos'] as $productos)


          <tr>
            <td style="text-align: center;">{{ $productos['cantidad'] }}</td>
            <td style="text-align: left;">{{ $productos['producto']['descripcion'] }}</td>
            <td style="text-align: right;">{{ $productos['producto']['costo'] }}</td>
            <td style="text-align: right;">{{ $productos['subtotal'] }}</td>
          </tr>


        @endforeach

        <br>
        <br>

        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right;">SUBTOTAL ${{ $datos['subtotal'] }}</td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right;">IVA ${{ $datos['iva'] }}</td>
            </tr> 

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right;">TOTAL A PAGAR ${{ $datos['total'] }}</td>
            </tr>                         
        </tfoot>

    </table>

</body>
</html>