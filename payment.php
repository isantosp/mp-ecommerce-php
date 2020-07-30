<?php

require __DIR__ .  '/vendor/autoload.php';

MercadoPago\SDK::setAccessToken('APP_USR-1159009372558727-072921-8d0b9980c7494985a5abd19fbe921a3d-617633181');

switch($_GET['res']){
    case 'failure':
        echo '<h1>Pago RECHAZADO!</h1>';
        break;

    case 'pending':
        echo '<h1>Pago PENDIENTE o EN PROCESO!</h1>';
        break;

    case 'success':
        echo '<h1>Pago EXITOSO!</h1>';
        echo '<hr>';
        echo '<strong>preference_id</strong>: '.$_GET['preference_id'].'<br>';
        echo '<strong>external_reference</strong>: '.$_GET['external_reference'].'<br>';
        echo '<strong>collection_id</strong>: '.$_GET['collection_id'].'<br>';
        echo '<strong>payment_type</strong>: '.$_GET['payment_type'].'<br>';

        $payment = MercadoPago\Payment::find_by_id($_GET['collection_id']);
        echo '<strong>payment_method_id</strong>: '.$payment->payment_method_id.'<br>';
        break;
}

?>

<hr>
<a href="/">Regresar</a>