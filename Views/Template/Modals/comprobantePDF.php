<?php

// dep($data);

// exit();
//dep($data['seguimiento']);



//dep($data['seguimiento']['cod_purchase_empire']);

//  exit();
?>

<style>
  .container {
    text-align: center;

  }

  .container::after {
    content: "";
    display: inline-block;
    /* Ajusta la altura de este pseudo-elemento según sea necesario */
    vertical-align: middle;
  }

  .image {
    max-width: 28%;
    /* Ajusta el ancho de la imagen según sea necesario */
    vertical-align: middle;
  }

  a {
    color: #5D6975;
    text-decoration: underline;
  }

  body {


    color: #001028;
    background: #FFFFFF;
    font-family: Arial, sans-serif;

    font-family: Arial;
  }



  #table-material {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 5px;
    border: 1px solid #000;
  }

  #table-material th,
  #table-material td {
    text-align: center;
    border-top: 1px solid #000;
    border-left: 1px solid #000;
    border: 1px solid #000;
    padding: 5px;
  }

  #table-material th {
    color: #fff;
    border-bottom: 1px solid #000;
    white-space: nowrap;
    font-weight: normal;
    background: #000;
  }

  #table-orden {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 10px;
    border: 1px solid #000;
  }

  #table-orden th,
  #table-orden td {
    text-align: center;
    border-top: 1px solid #000;
    border-left: 1px solid #000;
    border: 1px solid #000;
    padding: 5px;
  }

  #table-orden th {
    color: #fff;
    border-bottom: 1px solid #000;
    white-space: nowrap;
    font-weight: normal;
    background: #000;
  }

  #table-info {
    border-collapse: collapse;
    /* margin-bottom: 10px; */
  }

  #table-info th,
  #table-info td {
    /* text-align: center;    */
    border: 1px solid #000;
    /* padding:5px; */
  }

  #table-info th {
    color: #000;
    /* white-space: nowrap;         */

  }


  .rounded-corner {
    /* background: url('ruta-a-tu-imagen.png') no-repeat center center; */
    /* background-size: cover; Ajusta según sea necesario */
    width: 570px;
    /* Ajusta según sea necesario */
    border: 1px solid #000;
    font-size: 14px;
    font-weight: bold;
    padding: 5px;
    padding-left: 10px;
    margin-bottom: 5px;
  }

  .fondo-color {
    background-color: #000;
    width: 570px;
    border: 1px solid #000;
    padding: 5px;
    margin-top: 5px;
    margin-bottom: 5px;
  }

  .qty {
    font-size: 14px;
    font-weight: bold;
  }

  .qty-1 {
    font-size: 13px;

  }
</style>

<body>
  <header>
    <div class="container">
      <img class="image" src="http://localhost/empire/Assets/images/empire2.png" alt="centered image">
    </div>
  </header>

  <main>
    <div class="fondo-color"> </div>
    <div class="rounded-corner"><?= strtoupper($data['seguimiento']['nombre']); ?></div>

    <table id="table-material">
      <thead>
        <tr>
          <th class="qty-1">QTY</th>
          <th class="qty-1">Tamaño</th>
          <th class="qty-1">MATERIAL</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="qty"><?= $data['seguimiento']['qty_empire']; ?></td>
          <td class="qty"><?= $data['seguimiento']['size_empire']; ?></td>
          <td class="qty"><?= $data['seguimiento']['material_empire']; ?></td>
        </tr>
      </tbody>
    </table>

    <table id="table-orden">
      <thead>
        <tr>
          <th class="qty-1">Número de orden #</th>
          <th class="qty-1">FECHA DE ENVÍO</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="qty"><?= $data['seguimiento']['purchase_order_empire']; ?></td>
          <td class="qty"><?= $data['seguimiento']['ship_date_empire']; ?></td>
        </tr>
      </tbody>
    </table>

    <style>
      #tabla-actual {
        border-collapse: collapse;

      }

      #tabla-actual,
      #tabla-actual th,
      #tabla-actual td {

        border-left: 1px solid #D9D9D9;
        border-right: 1px solid #D9D9D9;
        border-bottom: 1px solid #D9D9D9;
        border: none;
      }

      .tm {
        padding: 5px;
        margin-right: 4px;
      }

      span {
        font-size: 12px;
      }
    </style>
    </style>

    <table id="tabla-actual">
      <thead>
        <tr rowspan="2" height:50px;>
          <th class="qty-1" style="background:#000; color:#fff; font-weight:700;">NOTAS</th>

        </tr>
      </thead>
      <tr>
        <td rowspan="4" style="font-size:12px; border:1px solid #000; padding:0; padding-top:-50px; ">
          <p style="max-width: 10px; word-wrap: break-word;"><?= $data['seguimiento']['Notes_empire']; ?> </p>


        </td>

        <td></td>
        <td colspan="2" rowspan="4"><img class="image" src="http://localhost/empire/Assets/images/04.png" style="width:80px; "></td>
      </tr>
      <tr>
        <td class="tm"><img class="image" src="http://localhost/empire/Assets/images/01.png" style="width:100px;"> <span></span></td>
      </tr>
      <tr>
        <td class="tm"><img class="image" src="http://localhost/empire/Assets/images/02.png" style="width:100px;"><span>      </td>
      </tr>
      <tr>
        <td class="tm"><img class="image" src="http://localhost/empire/Assets/images/03.png" style="width:180px;"></td>
      </tr>

    </table>

  </main>

    <!-- Script para imprimir automáticamente al cargar la página -->
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>