<?php

class RegisterController extends MembersController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new RegisterModel();

        view::setLayout(path::appViews('./default.layout.php'));
    }

    /**
     * Metodo responsable de enviar el correo de registro al usuario.
     */
    protected function _sendMail($mail, $id_user, $activation_code) {
        $tag_a_activate = url::tag('activate/' . $id_user . '/' . $activation_code, 'activar cuenta');

        $to = $mail;
        $sender = constant('PAGE_MAIL');
        $subject = 'Confirmacion del registro de nuevos usuarios';
        $message = 'Mensaje de ' . constant('PAGE_NAME') . '<br />';
        $message .= 'Bienvenido, Haz click en el siguiente enlace para completar el registro<br />';
        $message .= $tag_a_activate;

        if (@sendMail($to, $sender, $subject, $message)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

?>