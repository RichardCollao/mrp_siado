<?php

class IndexController extends RecoverController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if (!is_empty($_POST)) {
            $data = $this->_loadDataFromPost();
            $this->_send($data);
        } else {
            $data = array();
        }

        // Carga la vista
        $this->_view($data);
    }

    private function _send($data) {
        $errors = $this->_validateForm($data);

        $user = $this->_Model->getUserByMail($data['mail']);

        if (is_empty($errors)) {
            if ($user['state_acount'] != 'active') {
                $errors[] = 'Su cuenta no se encuentra activa.';
            } else {
                $id_user = $user['id_user'];
                $operation = 'recover_pass';
                // IMPORTANTE: El hash debe ser pasado a minusculas debido a que 
                // la clase DescomposeUrl tambien obtiene los segmentos en minusculas.
                $hash = strtolower(getRandomAlfaNum(32));
                $date_creation = constant('FW_DATETIME_CURRENT');

                $link_recover = path::urlDomain('./newpassword/' . $id_user . '/' . $hash);

                if ($this->_Model->saveHash($id_user, $operation, $hash, $date_creation)) {
                    // Intenta enviar el correo con el nuevo password.
                    $to = $data['mail'];
                    $sender = constant('FW_ERP_MAIL_NOREPLY');
                    $subject = 'SIADO, Reestablecer contraseña.';
                    $message = 'En respuesta a su solicitud se ha generado el siguiente enlace, ';
                    $message .= 'con el cual podra definir una nueva contraseña.<br />';
                    $message .= '<a href="' . $link_recover . '">Click aqui para cambiar contraseña</a><br />';
                    $message .= 'El vínculo solo se puede usar una vez y caducará al cabo de 24 horas.<br />';
                    $message .= 'es probable que este mensaje llegue a su bandeja de correo no deseado, <br/>';
                    $message .= 'se recomienda definir este remitente como seguro, para futuros mensajes.<br />';
                    $message .= 'Gracias.';

                    if (sendMail($to, $sender, $subject, $message)) {
                        redirect(path::urlDomain('./success'));
                    } else {
                        $errors[] = 'El servidor de correos no responde.';
                    }
                } else {
                    $errors[] = 'Ha ocurrido un error inesperado en la base de datos.';
                }
            }
        }

        // Mensaje
        $MsgBox = new MsgBox();
        $MsgBox->setEvent('warning');
        $MsgBox->setMessage('No se ha podido completar la accion debido a los siguientes errores.');
        $MsgBox->setItems($errors);
        $MsgBox->saveInSession();
        unset($MsgBox);
    }

    // Obtiene los valores para los campos desde el array $_POST.
    private function _loadDataFromPost() {
        return array(
            'mail' => trim($_POST['mail']),
            'captcha' => strtolower(trim($_POST['captcha']))
        );
    }

    private function _validateForm($data) {
        extract($data);
        $errors = array();
        // Validar que el usuario no se encuentre logeado
        if (constant('AUTHENTICATED') === TRUE) {
            $errors[] = 'Esta operacion es invalida ya se ha iniciado sesion.';
        }
        // Validar captcha
        if ($captcha != $_SESSION['captcha'] || strlen($captcha) < 4) {
            $errors[] = 'El campo correspondiente a la imagen de seguridad es incorrecto.';
        }
        // Evita en lo posible las consultas a la base de datos.
        if (!is_empty($errors)) {
            return $errors;
        }
        // Validar mail
        if (Validate::Mail($mail) !== TRUE) {
            $errors[] = Validate::Mail($mail);
        } else {
            $user = $this->_Model->getUserByMail($mail);
            if (is_empty($user)) {
                $errors[] = "El correo &nbsp;<b>$mail</b>&nbsp; no se encuentra en los registros.";
            }
        }
        return $errors;
    }

    private function _view($data) {
        $data['img_captcha'] = constant('FW_URL_DOMAIN_MODULES') . 'captcha/img.php';
        $data['img_refresh'] = constant('FW_URL_DOMAIN_MODULES') . 'captcha/refresh.png';
        $data['img_login'] = Path::urlImages('/logo.png');

        $data['link_form_action'] = path::urlDomain('recover');
        $data['link_back'] = path::urlDomain('');

        View::keep(path::appViews('./index.php'), $data, 'content');
    }

//    private function _view2($data) {
//        $data['link_back'] = path::urlDomain('');
//        View::keep(path::appViews('./index.php'), $data, 'content');
//    }

}
