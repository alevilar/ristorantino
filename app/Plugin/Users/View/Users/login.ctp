
<div class="col-md-4 col-md-offset-4 login">
    <h2>Logueo De usuario</h2>
<?php
if($this->Session->check('Message.auth')) $this->Session->flash('auth');

    /* @var $form FormHelper */
$form;
echo $this->Form->create('User', array('action'=>'login', 'role'=>'form'));
echo $this->Form->input('username',array('placeholder'=>'Usuario', 'label'=>false));
echo $this->Form->input('password', array('type'=>'password','placeholder'=>'Contraseña', 'label'=>false));
echo $this->Form->button('Entrar', array('type'=>'submit', 'class'=>'btn btn-primary btn-block'));
echo $this->Form->end();


?>
</div>