<?php

require __DIR__ .  '/vendor/autoload.php';
$url_root = 'https://isantosp-mp-commerce-php.herokuapp.com';

MercadoPago\SDK::setAccessToken('APP_USR-1159009372558727-072921-8d0b9980c7494985a5abd19fbe921a3d-617633181');
MercadoPago\SDK::setIntegratorId("dev_24c65fb163bf11ea96500242ac130004");

$preference = new MercadoPago\Preference();

// Medios de Pago
$preference->payment_methods = array(
  "installments" => 6,
  "excluded_payment_methods" => array(
    array("id" => "amex")
  ),
  "excluded_payment_types" => array(
    array("id" => "atm")
  ),
);

// Información del pagador
$payer = new MercadoPago\Payer();
  $payer->name = "Lalo";
  $payer->surname = "Landa";
  $payer->email = "test_user_58295862@testuser.com";
  $payer->phone = array(
    "area_code" => "52",
    "number" => "5549737300"
  );
  $payer->address = array(
    "street_name" => "Insurgentes Sur",
    "street_number" => 1602,
    "zip_code" => "03940"
  );
$preference->payer = $payer;

// Producto
$item = new MercadoPago\Item();
  $item->id = "1234";
  $item->title = $_POST['title'];
  $item->description = "Dispositivo móvil de Tienda e-commerce";
  $item->picture_url = $_POST['img'];
  $item->quantity = $_POST['unit'];
  $item->unit_price = $_POST['price'];
  $item->currency_id = "MXN";
$preference->items = array($item);
  
$preference->external_reference = "untalivan@isantosp.com";
  
// Páginas de retorno
$preference->back_urls = array(
  "failure" => "$url_root/payment.php?res=failure",
  "pending" => "$url_root/payment.php?res=pending",
  "success" => "$url_root/payment.php?res=success",
);
$preference->auto_return = "approved";

$preference->notification_url = "$url_root/notification.php";

$preference->save();
?>