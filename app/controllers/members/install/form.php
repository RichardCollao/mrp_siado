<?php

class FormController extends InstallController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        if (!is_empty($_POST)) {
            $data = $this->_loadDataFromPost();
            $this->_send($data);
        } else {
            $data = $this->_loadDefaultData();
        }

        $this->_view($data);
    }

    private function _send($data) {
        $errors = $this->_validateForm($data);
        if (is_empty($errors)) {
            $db_host = $data['db_host'];
            $db_type = $data['db_type'];
            $db_name = $data['db_name'];
            $db_user = $data['db_user'];
            $db_pass = $data['db_pass'];

            $connection = $this->_connectionTest($db_host, $db_type, $db_name, $db_user, $db_pass);

            if ($connection !== FALSE) {
                $content = '<?php' . PHP_EOL;
                $content.= "# Config Data Base" . PHP_EOL;
                $content.= '$hostname = "' . $db_host . '";' . PHP_EOL;
                $content.= '$dbdriver = "' . $db_type . '";' . PHP_EOL;
                $content.= '$database = "' . $db_name . '";' . PHP_EOL;
                $content.= '$username = "' . $db_user . '";' . PHP_EOL;
                $content.= '$password = "' . $db_pass . '";' . PHP_EOL;
                $content.= '$dsn="' . $db_type . ':host=' . $db_host . ';dbname=' . $db_name .  '";' . PHP_EOL;
                $content.= "?>";

                try {
                    $file = fopen(path::appConfigs('/database.php'), "w+");
                    fwrite($file, $content);
                    fclose($file);
                    redirect(Path::urlDomain('./createdatabase'));
                } catch (Exception $e) {
                    throw new Exception('No se pudo crear el archivo de configuracion.');
                }
            } else {

                $MsgBox = new MsgBox();
                $MsgBox->setEvent('warning');
                $MsgBox->setMessage('No se ha podido conectar con la base de datos, verifique que los datos sean correctos.');
                $MsgBox->saveInSession();
                unset($MsgBox);
            }
        } else {

            $MsgBox = new MsgBox();
            $MsgBox->setEvent('warning');
            $MsgBox->setMessage('No se ha podido completar la accion debido a los siguientes errores.');
            $MsgBox->setItems($errors);
            $MsgBox->saveInSession();
            unset($MsgBox);
        }
    }

    /**
     * Obtiene los valores para los campos desde el array $_POST.
     */
    private function _loadDataFromPost() {
        $data['db_host'] = trim($_POST['db_host']);
        $data['db_type'] = trim($_POST['db_type']);
        $data['db_name'] = trim($_POST['db_name']);
        $data['db_user'] = trim($_POST['db_user']);
        $data['db_pass'] = trim($_POST['db_pass']);
        return $data;
    }

    private function _loadDefaultData() {
        $data = array();
        $data['db_host'] = 'localhost';
        $data['db_type'] = 'mysql';
        $data['db_name'] = '';
        $data['db_user'] = 'root';
        $data['db_pass'] = '';
        return $data;
    }

    private function _connectionTest($db_host, $db_type, $db_name, $db_user, $db_pass) {
        try {
            $dsn = 'mysql:host=' . $db_host . ';dbname=' . $db_name;
            new PDO($dsn, $db_user, $db_pass);
            return TRUE;
        } catch (PDOException $e) {
            return FALSE;
        }
    }

    /**
     * Valida los datos enviados por el formulario.
     */
    private function _validateForm($data) {
        extract($data);
        $errors = array();
        if (is_empty($db_host)) {
            $errors[] = 'El campo host esta vacio';
        }
        if ($db_type != 'mysql') {
            $errors[] = 'El typo de base de datos no es soportado.';
        }
        if (is_empty($db_name)) {
            $errors[] = 'El campo nombre esta vacio';
        }
        if (is_empty($db_user)) {
            $errors[] = 'El campo usuario esta vacio';
        }
        return $errors;
    }

    private function _view($data) {
        $data['action_form'] = Path::urlDomain('./form');
        View::keep(path::appViews('./form.php'), $data, 'content');
    }

}
