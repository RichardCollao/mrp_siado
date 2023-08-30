<?php

class Filter {

    private $_html;
    private $_headers;
    private $_filters;
    private $_action_form;
    private static $_is_filtering = false;

    function __construct($action_form) {
        $this->_action_form = $action_form;

        if (isset($_POST['btn_filter'])) {
            $this->_saveFilters();
        } elseif (isset($_POST['btn_reset'])) {
            $this->_resetFilters();
        }
    }

    public function setHeaders($_headers) {
        $this->_headers = $_headers;
    }

    private function _saveFilters() {
        $_SESSION['filters'][$this->_action_form] = (array) $_POST;
        redirect($this->_action_form);
    }

    private function _resetFilters() {
        $_SESSION['filters'][$this->_action_form] = array();
        redirect($this->_action_form);
    }

    public function getQuery() {
        $querys = array();
        $values = array();
        if (is_empty($_SESSION['filters'][$this->_action_form]) || !is_array($_SESSION['filters'][$this->_action_form])) {
            return array();
        }

        foreach ($_SESSION['filters'][$this->_action_form] as $key => $value) {
            $type = $this->_filters[$key]['type'];
            $field = $this->_filters[$key]['field'];

            if ($type == 'input' && !is_empty($value)) {
                $querys[] = $field . ' LIKE ? ';
                $values[] = "%" . $value . "%";
            }

            if ($type == 'select' && !is_empty($value) && $value != -1) {
                $querys[] = $field . ' = ?';
                $values[] = $value;
            }

            if ($type == 'date' && $value['select'] > 0) {
                switch ($value['select']) {
                    case 1:
                        if (!is_empty($value['date1'])) {
                            $querys[] = $field . ' = ?';
                            $values[] = $value['date1'];
                        }
                        break;
                    case 2:
                        if (!is_empty($value['date1'])) {
                            $querys[] = $field . ' >= ?';
                            $values[] = $value['date1'];
                        }
                        break;
                    case 3:
                        if (!is_empty($value['date1'])) {
                            $querys[] = $field . ' <= ?';
                            $values[] = $value['date1'];
                        }
                        break;
                    case 4:
                        if (!is_empty($value['date1']) && !is_empty($value['date2'])) {
                            $querys[] = $field . ' > ? AND ' . $field . ' < ?';
                            $values[] = $value['date1'];
                            $values[] = $value['date2'];
                        }
                        break;
                }
            }

            // SELECT_STOCK
            if ($type == 'select_stock' && !is_empty($value) && $value != -1) {
                if ($value == 1) {
                    $querys[] = '(total_in_guides - total_in_vouchers) = 0';
                } elseif ($value == 2) {
                    $querys[] = '(total_in_guides - total_in_vouchers) > 0';
                } elseif ($value == 3) {
                    $querys[] = 'critical_stock > 0 '
                            . 'AND (total_in_guides - total_in_vouchers) <= critical_stock';
                }
//                $values[] = '';
            }
        }

        if (!is_empty($querys)) {
            self::$_is_filtering = true;
            $query = ' AND ' . implode(' AND ', $querys) . ' ';
        }
        return array($query, $values);
    }

    public function addFieldInput($name, $data) {
        $data['value'] = $_SESSION['filters'][$this->_action_form][$name];
        $data['name'] = $name;
        $this->_html[] = $this->_capture(MOD_FILTER_DIR . 'snippets/input.php', $data);
        $this->_filters[$name] = array('type' => 'input', 'field' => $data['field'], 'name' => $data['name'], 'value' => $data['value']);
    }

    public function addFieldSelect($name, $data) {
        $data['value'] = $_SESSION['filters'][$this->_action_form][$name];
        $data['name'] = $name;
        $this->_html[] = $this->_capture(MOD_FILTER_DIR . 'snippets/select.php', $data);
        $this->_filters[$name] = array('type' => 'select', 'field' => $data['field'], 'name' => $data['name'], 'value' => $data['value']);
    }

    public function addFieldDate($name, $data) {
        $data['values'] = $_SESSION['filters'][$this->_action_form][$name];
        $data['name'] = $name;
        $this->_html[] = $this->_capture(MOD_FILTER_DIR . 'snippets/date.php', $data);
        $this->_filters[$name] = array('type' => 'date', 'field' => $data['field'], 'name' => $data['name'], 'value' => $data['value']);
    }

    public function addFieldSelectStock($name, $data) {
        $data['value'] = $_SESSION['filters'][$this->_action_form][$name];
        $data['name'] = $name;
        $this->_html[] = $this->_capture(MOD_FILTER_DIR . 'snippets/select_stock.php', $data);
        $this->_filters[$name] = array('type' => 'select_stock', 'field' => $data['field'], 'name' => $data['name'], 'value' => $data['value']);
    }

    public function getHtml() {
        return $this->_html;
    }

    function getBarFilters() {
        $data['action_form'] = $this->_action_form;
        $data['html'] = $this->getHtml();
        $data['headers'] = $this->_headers;
        $data['is_filtering'] = self::$_is_filtering;
        return $this->_capture(constant('MOD_FILTER_DIR') . 'bar_filters.php', $data);
    }

    private function _capture($file, $data) {
        extract($data);
        ob_start();
        require ($file);
        $view = ob_get_contents();
        ob_end_clean();
        return $view;
    }

}
