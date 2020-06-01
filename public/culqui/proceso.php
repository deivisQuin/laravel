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
     "currency_code" => "PEN",
     "email" => $_POST["email"],
     "source_id" => $_POST["token"]
   )
);
//echo 1;
exit;
?>