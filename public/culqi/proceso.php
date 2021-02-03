<?php
require "request/library/Requests.php";
Requests::register_autoloader();
require "culqi/lib/culqi.php";

//$SECRET_KEY = "sk_test_086297f9e4572b08"; //Panel de Integración
$SECRET_KEY = "sk_live_Gg4P8eHTQPFzyvHH"; // Panel administrativo

$culqi = new Culqi\Culqi(array('api_key' => $SECRET_KEY));

// A solicitud de Culqi se pone un num aleatorio para que su sistema no lo rechace por varios uso del mismo número de teléfono
$numAleatorioUno = rand(1234, 9876);
$numAleatorioDos = rand(1234, 9876);

$numTelefono = "9" . $numAleatorioUno . $numAleatorioDos;

$charge = $culqi->Charges->create(
    array(
      "amount" => $_POST["precio"],
      "capture" => true,
      "currency_code" => "PEN",
      "description" => $_POST["producto"],
      "email" => $_POST["email"],
      "installments" => 0,
      "antifraud_details" => array(
          "address" => "Jr. Pilar Lara 335",
          "address_city" => "LIMA",
          "country_code" => "PE",
          "first_name" => "Guddaive",
          "last_name" => "Quin",
          "phone_number" => "$numTelefono",
      ),
      "source_id" => $_POST["token"]
    )
);

//Respuesta
//print_r($charge);

header('Content-type: application/json; charset=utf-8');
echo json_encode($charge);
exit();