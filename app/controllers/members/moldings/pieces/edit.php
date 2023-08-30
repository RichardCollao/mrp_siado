<?php

class EditController extends PiecesController {

    public function __construct() {
        parent::__construct();

        $this->_Model = new EditModel();

//        $this->_checkPermissions();

        $this->_id_molding_piece = (int) DecomposeUrl::getArgument(0);

        $this->_molding_piece = $this->_Model->loadMoldingPiece(array(
            'id_molding_piece' => $this->_id_molding_piece)
        );

        $this->_molding = $this->_Model->loadMoldingPiece(array(
            'fk_id_establishment' => constant('AUTH_ESTABLISHMENT'),
            'id_molding_piece' => $this->_molding_piece['fk_id_molding_piece'])
        );
    }

    public function index() {
        if (!is_empty($_POST)) {
            $data = $this->_loadDataFromPost();
            $this->_send($data);
        } else {
            $data = $this->_molding_piece;
        }
        $this->_view($data);
    }

    private function _send($data) {
        $errors = $this->_validateForm($data);

        if (is_empty($errors)) {
            $values = Array(
                'fk_id_molding' => $this->_molding_piece['fk_id_molding'],
                'id_molding_piece' => $this->_id_molding_piece,
                'code' => $data['code'],
                'name' => $data['name'],
                'weight' => $data['weight']
            );

            if (!is_empty($this->_Model->duplicatePieceCode($values))) {
                $errors[] = 'El codigo de la pieza ya existe';
            } elseif (!is_empty($this->_Model->duplicatePieceName($values))) {
                $errors[] = 'El nombre de la pieza ya existe';
            } elseif ($this->_Model->editMoldingPiece($values)) {
                $MsgBox = new MsgBox();
                $MsgBox->setEvent('success');
                $MsgBox->setMessage('La operacion solicitada se ha realizado satisfactoriamente.');
                $MsgBox->setItems($errors);
                $MsgBox->saveInSession();
                unset($MsgBox);

                redirect(path::urlDomain('./' . $this->_molding_piece['fk_id_molding']));
            } else {
                $errors[] = 'Se produjo un error en la base de datos';
            }
        }

        $MsgBox = new MsgBox();
        $MsgBox->setEvent('warning');
        $MsgBox->setMessage('No se ha podido completar la accion debido a los siguientes errores.');
        $MsgBox->setItems($errors);
        $MsgBox->saveInSession();
        unset($MsgBox);
    }

    private function _loadDataFromPost() {
        return array(
            'code' => trim($_POST['code']),
            'name' => trim($_POST['name']),
            'weight' => trim($_POST['weight'])
        );
    }

    private function _validateForm($data) {
        extract($data);
        $errors = array();

        if (!preg_match('/[0-9a-zñ \/\-_"\#\$]+/i', $name)) {
            $errors[] = 'El nombre del material no es valido';
        } elseif (strlen($name) > 128) {
            $errors[] = 'El nombre del material no debe superar los 128 carateres';
        } elseif (strlen($name) < 3) {
            $errors[] = 'El nombre del material no debe tener menos de 3 carateres';
        }

        return $errors;
    }

    private function _view($data) {
        $data['action_form'] = path::urlDomain('./edit/' . $this->_id_molding_piece);

        View::keep(path::appViews('./edit.php'), $data, 'content');
    }

}
