<?php

class Maintenance extends AdministrationMod
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if(isset($_POST['send']))
        {
            $data = $this->_loadDataFromPost();
            $this->_send($data);
        }else{
            $data['content_page'] = $this->_loadMaintenancePage();
        }

        # Carga la vista
        $this->_view($data);
    }

    private function _send($data)
    {
        $file = constant('DIR_REDIRECT') . 'maintenance.php';
        $content = $data['content_page'];
        $this->_saveFile($file, $content);

        $file =  constant('DIR_CONFIGS') . 'redirecting.php';
        $content = '<?php' . PHP_EOL;
        if(is_empty($data['force_redirect'])) $content.= '#';
        $content.= '$redirect = "maintenance.php";' . PHP_EOL;
        $content.= '?>';
        $this->_saveFile($file, $content);

        # Mensaje
        $MsgBox = new MsgBox();
        $MsgBox->setEvent('success');
        $MsgBox->setMessage('La accion solicitada se ha ejecutado correctamente.');
        $MsgBox->saveInSession();
        unset($MsgBox);
    }

    private function _loadMaintenancePage()
    {
        $page = '';
        $file = constant('DIR_REDIRECT') . 'maintenance.php';
        if(is_readable($file))
        {
            $r = fopen($file, 'r');
            while(!feof($r))
                $page.= fgets($r);
            fclose($r);
        }
        return $page;
    }

    private function _saveFile($file, $content)
    {
        try {
            $w = fopen($file, "w");
            fwrite($w, $content);
            fclose($w);
        }catch (Exception $e){
            throw new Exception ('No se pudo crear el archivo de configuracion.');
        }
    }

    /**
     * Obtiene los valores para los campos desde el array $_POST.
     */
    private function _loadDataFromPost()
    {
        $data = array();
        $data['force_redirect'] = trim($_POST['force_redirect']);
        $data['content_page']   = trim($_POST['content_page']);
        return $data;
    }

    private function _view($data)
    {
        $data['action_form']    = url::link('maintenance');

        View::keep('maintenance', $data, 'content');
    }
}

?>