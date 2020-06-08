<?php
require "request/library/Requests.php";
Requests::register_autoloader();
require "culqi/lib/culqi.php";

//$SECRET_KEY = "sk_test_bUwng5RuUSBNf0Yk";
$SECRET_KEY = "sk_test_086297f9e4572b08";

$culqi = new Culqi\Culqi(array('api_key' => $SECRET_KEY));



$charge = $culqi->Charges->create(
    array(
      "amount" => $_POST["precio"],
      "capture" => true,
      "currency_code" => "PEN",
      "description" => $_POST["producto"],
      //"email" => "test@culqi.com",
      "email" => $_POST["email"],
      "installments" => 0,
      "antifraud_details" => array(
          "address" => "Av. Lima 123",
          "address_city" => "LIMA",
          "country_code" => "PE",
          "first_name" => "Will",
          "last_name" => "Muro",
          "phone_number" => "9889678986",
      ),
      "source_id" => $_POST["token"]
    )
);

//Respuesta
//print_r($charge);

header('Content-type: application/json; charset=utf-8');
echo json_encode($charge);
exit();