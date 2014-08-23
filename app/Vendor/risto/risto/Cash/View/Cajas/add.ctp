<?php

echo $this->Form->create('Caja');
echo $this->Form->input('id');
echo $this->Form->input('name');
echo $this->Form->input('computa_ingresos');
echo $this->Form->input('computa_egresos');
echo $this->Form->end('Guardar');