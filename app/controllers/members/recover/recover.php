<?php

class RecoverController extends MembersController {

    public function __construct() {
        parent::__construct();

        view::setLayout(path::appViews('./default.layout.php'));

        if (constant('AUTHENTICATED') === TRUE) {
            $MsgBox = new MsgBox();
            $MsgBox->setEvent('warning');
            $MsgBox->setMessage('No es posible acceder al modulo de recuperacion de clave, estando autenticado.');
            #$MsgBox->setItems($errors);
            $MsgBox->saveInSession();
            unset($MsgBox);

            // Redireciona a la pagina principal.
            redirect(path::urlDomain(''));
        }

        $this->_Model = new RecoverModel();
    }

}
