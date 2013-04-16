<?php

class BackupShell extends Shell
{

    function __initializeScript()
    {
        $this->Config = & ClassRegistry::init('Config');

        $ccc = $this->Config->find('all');

        foreach ($ccc as $c) {
            $confName = '';
            if (!empty($c['ConfigCategory']['name'])) {
                $confName = $c['ConfigCategory']['name'] . '.';
            }
            $keyName = $confName . $c['Config']['key'];
            Configure::write($keyName, $c['Config']['value']);
        }
    }

    function main()
    {
        $this->__initializeScript();
        App::import('Component', 'Email');
        $this->Email = & new EmailComponent(null);

        $dbSource = & new DATABASE_CONFIG();

        $MUSER = $dbSource->default['login'];
        $MPASS = $dbSource->default['password'];
        $MHOST = "localhost";
        $BAK = "/tmp";
        $EMAIL = "mail@gmail.com";
        $NOMBREDDBB = $dbSource->default['database'];

        $DATE = date('Y_m_d_H_i_s', strtotime('now'));

        $FILE = "$BAK/ristorantino_$DATE.gz";
        $this->out("El siguiente archivo será enviado por mail: " . $FILE);
        exec("mysqldump -u $MUSER -h $MHOST -p$MPASS $NOMBREDDBB | gzip -9 > $FILE");

        $mensaje = '';
        $backupemail = Configure::read('Restaurante.backup_mail');
        $email = Configure::read('Restaurante.mail');
        if (empty($backupemail)) {
            $backupemail = $email;
        }
        $nombreResto = Configure::read('Restaurante.name');

        $mail = $nombreResto . ' <' . $email . '>';
        $this->Email->from = $mail;
        $this->Email->to = $backupemail;
        $this->out("Al mail: " . $backupemail);
        $this->Email->attachments = array($FILE);
        $this->Email->subject = 'Backup';
        $this->Email->send($mensaje);
    }

}
