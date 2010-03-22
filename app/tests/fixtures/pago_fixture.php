<?php
class PagoFixture extends CakeTestFixture {



    var $fields = array(
            'id' => array('type' => 'integer', 'key' => 'primary'),
            'valor'=> array('type' => 'float'),
            'mesa_id'=> array('type' => 'integer'),
            'tipo_de_pago_id'=> array('type' => 'integer'),
    );

    var $records = array(array(
            'id'=>1,
            'valor'=>100,
            'mesa_id'=>1,
            'tipo_de_pago_id'=>1,

    ));

}

?>