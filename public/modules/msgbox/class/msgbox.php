<?php

/**
 * Esta clase permite crear mensajes relacionados con la informacion asociada generalmente a la accion de un formulario.
 * Esto es debido a que hay mensajes que deben ser mostrados al usuario aun cuando la pagina sea redireccionada.
 * Para esto la clase guarda los mensaje en las sessiones permitiendo recuperarlos posteriormente.
 * Resulta util guadar un mensaje cuando se redirecciona para evitar el reenvio de datos o al refrescar la pagina.
 */
class MsgBox {

    private $_col_events = array();
    private $_path;
    private $_event; // Indica el evento con este se carga el icono y se puede agregar alguna funcion de tipo log
    private $_icon; // Indica la ruta de la imagen correspondiente al icono
    private $_title; // valor que se muestrara en la barra de titulo de la ventana de MsgBox
    private $_message; // Cuerpo del mensaje
    private $_items; // Puede ser una lista de elementos que pueden ser desplegados en orden.
    private $_footer; // Pie de la ventana pueden ser botones, link, etc.
    private $_expire; // tiempo de vida del mensaje antes de ser eliminado
    private $_hops; // Numero de veces que el mensaje puede ser mostrado por defecto tiene un valor igual a 1
    private $_for; // Es posible asignar el mensage a un controlador especifico 

    public function __construct() {
        $this->_col_events = array(
            'success',
            'info',
            'warning',
            'danger');

        // Asignar valores por defecto
        $this->_event = 'info';
        $this->_title = 'Informacion.';
        $this->_message = '';
        $this->_items = array();
        $this->_expire = NULL;
        $this->_hops = 1;
        $this->_controller = 'all';
    }

    /**
     * Establece el tipo de evento necesario para mostrar el icono asociado. 
     * danger, info, success, warning
     */
    public function setEvent($event) {
        if (in_array($event, $this->_col_events)) {
            $this->_event = trim(strtolower($event));
        } else {
            throw new Exception("MsgBox: El evento $event no es valido");
        }
    }

    /**
     * cambia el titulo por defecto "Aviso del foro" por uno personalizado. 
     */
    public function setTitle($title) {
        $this->_title = trim($title);
    }

    /**
     * Define el mensaje que se mostrara.
     */
    public function setMessage($message) {
        $this->_message = trim($message);
    }

    /**
     * Es una lista de elementos que se pueden desplegar en listas, pueden ser errores etc.
     */
    public function setItems($col = array()) {
        if (is_array($col)) {
            $this->_items = $col;
        } else {
            'MsgBox: Se esperaba un array.';
        }
    }

    /**
     * Agrega elementos que se pueden desplegar en listas, pueden ser errores etc.
     */
    public function addItems($item) {
        $this->_items[] = $item;
    }

    /**
     * Agrega elementos que se pueden desplegar en listas, pueden ser errores etc.
     */
    public function setFooter($str) {
        $this->_footer = $str;
    }

    /**
     * Establece una fecha de expiracion del mensaje para su destruccion.
     */
    public function setExpire($datetime) {
        $this->_expire = $datetime;
    }

    /**
     * Establece la cantidad de veces que se muestra el mensaje antes de ser destruido.
     */
    public function setHops($hops) {
        $this->_hops = $hops;
    }

    /**
     * Guarda el mensaje en una variable de sesion para tenerlo disponible aun frente a redireccionamientos. 
     */
    public function saveInSession() {
        if ($this->_message == '') {
            throw new Exception('MsgBox: No se ha enviado ningun mensaje.');
        }
        
        // Parametros
        $msgbox['event'] = $this->_event;
        $msgbox['title'] = $this->_title;
        $msgbox['message'] = $this->_message;
        $msgbox['items'] = $this->_items;
        $msgbox['footer'] = $this->_footer;
        $msgbox['hops'] = $this->_hops;

        $msgbox['icon'] = constant('MSGBOX_URL') . 'images/' . $this->_event . '.png';
        if ($this->_expire != NULL) {
            $msgbox['expire'] = $this->_expire;
        }

        // Agrega el mensaje a la variable de sesion
        $_SESSION['msgbox'][] = $msgbox;
    }

}