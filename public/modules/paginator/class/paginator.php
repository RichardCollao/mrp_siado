<?php

class Paginator {
    // Total de items por pagina
    private $_items_per_page;

    // Total de items con este valor se puede calcular cuantas paginas generara el paginador
    private $_items_total;

    // Contiene el indice alcual de la pagina que se esta viendo
    private $_current_page;

    // Numero de columnas que mostrara el paginador, para 5 columnas seria muestra [primera][<][1][2][3][4][5][>][Ultima]
    private $_columns_display;

    // Url con la que se trabajara
    private $_url;

    // Guarda el total de paginas que es el resultado de la divicion de $_items_total \ $_constant('FW_ERP_ITEMS_PER_PAGE')
    private $_total_pages;

    private $_str_page;

    // Especifica la vista que se usara por defecto es default
    private $_file_view;

    public function __construct() {
        $this->_columns_display = 7;
        $this->_str_page = 'page=';
        $this->_file_view = 'bootstrap.php';
    }
    

    /**
     * Establece la cantidad de items o filas por cada pagina.
     */
    public function setItemsPerPage($value) {
        $this->_items_per_page = $value;
    }

    /**
     * Establece el total de items los cjuales seran distribuidos en cada pagina.
     */
    public function setItemsTotal($value) {
        $this->_items_total = $value;
    }

    /**
     * Establece la pagina actual.
     */
    public function setCurrentPage($value) {
        $this->_current_page = (int) $value;
    }

    /**
     * Establece la cantidad de columnas que tendra el paginador ignora las columnas automaticas como Next, Back, First, Last.
     */
    public function setColumnsDisplay($value) {
        $this->_current_page = $value;
    }

    /**
     * Establece el valor de la url la cual debe contener un identificador para que el paginador 
     * pueda modificar 
     * Ej: www.mipagina/index[page]
     * Resulta en www.mipagina/index/page-2
     */
    public function setUrl($value) {
        $this->_url = $value;
    }

    /**
     * Setea el string que se presenta en la url junto con el identificador de la pagina 
     * por defecto es '/page-2'
     * Ej: www.mipagina.com/index/page-2 
     */
    public function setStrPage($value) {
        $this->_str_page = $value;
    }

    /**
     * Nombre del archivo que contiene la vista.
     */
    public function setFileView($value) {
        $this->_file_view = $value;
    }

    /**
     * Calcula la cantidad de paginas basado en los datos recibidos.
     */
    private function _calculate() {
        $this->_total_pages = ceil($this->_items_total / $this->_items_per_page);
        if ($this->_total_pages < 1) {
            $this->_total_pages = 1;
        }
    }

    /**
     * Metodo con la logica para crear el paginador.
     */
    public function getView() {
        $this->_calculate();

        // Si no hay paginas escapa del flujo del script.
        if ($this->_total_pages <= 1) {
            return;
        }

        $data = array();

        $data['current_page'] = $this->_current_page;
        $data['total_pages'] = $this->_total_pages;
        $data['links'] = array();

        // Condiciona si se muestra Back
        if ($this->_current_page > 2) {
            $data['back'] = str_replace('[page]', $this->_str_page . ($this->_current_page - 1), $this->_url);
        } elseif ($this->_current_page == 2) {
            $data['back'] = str_replace('[page]', '', $this->_url);
        }

        // Condiciona si se muestra Next
        if ($this->_current_page < $this->_total_pages) {
            $data['next'] = str_replace('[page]', $this->_str_page . ($this->_current_page + 1), $this->_url);
        }

        // Condiciona si se muestran first y last
        if ($this->_total_pages > $this->_columns_display) {
            if ($this->_current_page > 2) {
                $data['first'] = str_replace('[page]', '', $this->_url);
            }

            if ($this->_current_page < ($this->_total_pages - 1)) {
                $data['last'] = str_replace('[page]', $this->_str_page . $this->_total_pages, $this->_url);
            }
        }

        // Define el numero de columnas que tendra el paginador no considera next, back, first, last
        if ($this->_total_pages < $this->_columns_display) {
            $columns = $this->_total_pages;
        } else {
            $columns = $this->_columns_display;
        }
        
        // Calcula el principio del rango
        // para que el cursor quede a la mitad del paginador si es posible
        $range = 1;
        if ($this->_total_pages > $this->_columns_display) {
            // Calcula la mitad redondeada hacia abajo del total de columnas que se muestran.
            $midle_range = floor($this->_columns_display / 2);

            $range = $this->_current_page - $midle_range;

            // Verifica que el rango no se desborde hacia arriba
            if ($range > ($this->_total_pages - $columns)) {
                $range = $this->_total_pages - $columns + 1;
            }

            // Verifica que el rango no se desborde hacia abajo
            if ($range < 1) {
                $range = 1;
            }
        }

        # echo "columns=$columns<br />range=$range<br />midle_range=$midle_range";
        // inicia el bucle que crea los links
        for ($i = 0; $i < ($columns); $i++) {
            $page = $i + $range;
            if ($page == 1) {
                $data['links'][$page] = str_replace('[page]', '', $this->_url);
            } else {
                $data['links'][$page] = str_replace('[page]', $this->_str_page . $page, $this->_url);
            }
        }

        // Captura la vista del paginador y la devuelve como una cadena con codigo HTML
        return $this->_capture($this->_file_view, $data);
    }

    /**
     * Metodo que centraliza las capturas de las vistas, devuelve la vista como un string.
     */
    private function _capture($file, $data) {
        ob_start();
        require (constant('MOD_PAGINATOR_DIR') . 'views' . DS . $file);
        $view = ob_get_contents();
        ob_end_clean();
        return $view;
    }

}