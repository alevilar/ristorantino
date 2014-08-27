<?php

if (!empty($cliente['Descuento'])) {
    $cliente['Cliente']['Descuento'] = $cliente['Descuento'];
    unset($cliente['Descuento']);
}

$cliente['msg'] = $this->Session->read('Message.flash');
if ($this->Session->check('auth')) {
    $cliente['msg-auth'] = $this->Session->read('Message.auth');
}

echo json_encode( $cliente );

