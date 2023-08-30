<?php

class LogoController extends EstablishmentsController {

    private $_id_establishment;
    private $_establishment;

    public function __construct() {
        parent::__construct();

        $this->_Model = new LogoModel();
        $this->_checkPermissions();

        $this->_id_establishment = (int) DecomposeUrl::getArgument(0);
        $this->_establishment = $this->_Model->loadEstablishment($this->_id_establishment);

        $this->_checkEstablishment($this->_establishment['id_establishment']);
    }

    public function index() {
        if (!is_empty($_FILES)) {
            $this->_moveFiles($dir);
        }

        $this->_view($data);
    }

    public function _moveFiles($destination) {
        $errors = array();
        require_once(FW_DIR_CLASS . 'uploadimage.php');
        $uploadimage = new UploadImage($_FILES['logo']);
        $uploadimage->setDestination(path::dirPublicResources($this->relative_path_logos));
        $uploadimage->setOutName('logo');
        $uploadimage->setOutFormat('png');
        $uploadimage->execute($file);

        $errors = array_merge($errors, $uploadimage->getErrors());


        if (is_empty($errors)) {
            $MsgBox = new MsgBox();
            $MsgBox->setEvent('success');
            $MsgBox->setMessage('La operacion solicitada se ha realizado satisfactoriamente.');
            $MsgBox->setItems();
            $MsgBox->saveInSession();
            unset($MsgBox);
        } else {
            $MsgBox = new MsgBox();
            $MsgBox->setEvent('warning');
            $MsgBox->setMessage('No se ha podido completar la accion debido a los siguientes errores.');
            $MsgBox->setItems($errors);
            $MsgBox->saveInSession();
            unset($MsgBox);
        }

        redirect(path::urlDomain('./logo/' . $this->_id_establishment));
    }

    private function _view($data) {
        $data['action_form'] = path::urlDomain('./logo/') . $this->_id_establishment;
        $data['src_logo'] = path::urlResources($this->relative_path_logos . 'logo.png?nocache=' . md5(time()));
        $data['link_back'] = path::urlDomain('./');
        View::keep(path::appViews('./logo.php'), $data, 'content');
    }

}
