<?php

class PurgeSessions extends AdministrationMod
{
    public function __construct()
    {
        parent::__construct();

        require_once ($this->_DIR_MODELS . 'purgesessions.php');
        $this->_Model = new PurgeSessionsModel();
    }

    public function index()
    {
        $data = array();

        if(isset($_POST['send']))
        {
            $this->_send($data);
        }

        # Carga la vista.
        $this->_view($data);
    }

    private function _send($data)
    {
        $this->_Model->purgeSessions($_SESSION['session_id']);

        # Mensaje
        $MsgBox = new MsgBox();
        $MsgBox->setEvent('success');
        $MsgBox->setMessage('La accion solicitada se ha ejecutado correctamente.');
        $MsgBox->saveInSession();
        unset($MsgBox);

        redirect(Url::link(''));
    }

    private function _view($data)
    {
        $data['action_form'] = url::link('purgesessions');
        $data['link_cancel'] = url::link('');

        View::keep('purge_sessions', $data, 'content');
    }
}

?>