
<div class="col-md-4 col-md-offset-4 login">
    <h2>Logueo De usuario</h2>
<?php
if($session->check('Message.auth')) $session->flash('auth');

    /* @var $form FormHelper */
$form;
echo $form->create('User', array('action'=>'login'));
echo $form->input('username',array('label'=>'Usuario'));
echo "<div class='clear'></div>";
echo $form->input('password', array('type'=>'password','label'=>'Contraseña'));
echo "<div class='clear'></div>";
echo $form->button('Entrar', array('type'=>'submit'));
echo "<div class='clear'></div>";
echo $form->end();


?>
</div>