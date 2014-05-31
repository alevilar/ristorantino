<?php

echo $form->create('Caja');
echo $form->input('id');
echo $form->input('name');
echo $form->input('computa_ingresos');
echo $form->input('computa_egresos');
echo $form->end('Guardar');