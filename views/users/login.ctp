<?php echo $html->link('INICIO','/pages/home')?>

<h1>Logueo De usuario</h1>
<?php
if($session->check('Message.auth')) $session->flash('auth');

echo $form->create('User', array('action'=>'login'));
echo $form->input('username',array('label'=>'Usuario'));
echo $form->input('password', array('type'=>'password','label'=>'Contraseña'));
echo $form->end('Entrar');


?>
<br><br>