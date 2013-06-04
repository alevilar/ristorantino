<?php 
//echo $this->Html->css('alekeyboard');
//
//echo $this->link('alekeyboard');

?>


<div class="grid_4 prefix_4 login">
    <h2>Logueo De usuario</h2>
<?php
echo $this->Session->flash('auth');

    /* @var $form FormHelper */
$form;
echo $this->Form->create('User', array('action'=>'login'));
echo $this->Form->input('username',array('label'=>'Usuario'));
echo "<div class='clear'></div>";
echo $this->Form->input('password', array('type'=>'password','label'=>'Contraseña'));
echo "<div class='clear'></div>";
echo $this->Form->button('Entrar', array('type'=>'submit'));
echo "<div class='clear'></div>";
echo $this->Form->end();


?>
</div>