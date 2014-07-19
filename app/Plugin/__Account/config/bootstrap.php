<?php
function mostrarNetoDe($tipoImpuestoId, $vec)
{
    foreach ($vec as $v) {
        if ($v['tipo_impuesto_id'] == $tipoImpuestoId) {
            return $v['neto'];
        }
    }
    return 0;
}

function mostrarImpuestoDe($tipoImpuestoId, $vec)
{
    foreach ($vec as $v) {
        if ($v['tipo_impuesto_id'] == $tipoImpuestoId) {
            return $v['importe'];
        }
    }
    return 0;
}