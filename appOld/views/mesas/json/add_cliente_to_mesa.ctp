<?php

if (!empty($cliente['Descuento'])) {
    $cliente['Cliente']['Descuento'] = $cliente['Descuento'];
    unset($cliente['Descuento']);
}

$cliente['msg'] = $session->read('Message.flash');
if ($session->check('auth')) {
    $cliente['msg-auth'] = $session->read('Message.auth');
}

echo $javascript->object($cliente);

