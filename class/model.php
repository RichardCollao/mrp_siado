<?php

abstract class Model {

    // Database Handle.
    public $_dbh;
    // Statement handle.
    public $_sth;

    public function __construct() {
        if (!$this->_dbh) {
            try {
                require(path::appConfigs('/database.php'));
                // $this->_dbh = new PDO($dsn . ';charset=utf8', $username, $password);// Correct or down 
                $this->_dbh = new PDO($dsn, $username, $password
                        , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
                );
                // Configure Attributes.
                $this->_dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                #self::$instance->setAttribute(PDO::MYSQL_ATTR_DIRECT_QUERY, TRUE);
                $this->_dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE); // FALSE en produccion
            } catch (Exception $ex) {
                die('<pre>Connection failed: ' . $ex->getMessage() . '</pre>');
            }
        }
    }

    public function query($query, $args) {
//        highlight_string($query);
//        Debug::printRF($args);
        try {
            $this->_sth = $this->_dbh->prepare($query);
            return $this->_sth->execute($args);
        } catch (PDOException $ex) {
//            die('<pre>Connection failed: ' . $ex->getMessage() . '</pre>');
//            die('Error in the database');
            throw new Exception('Error in the database');
        }
    }

    public function getLastInsertId() {
        return $this->_dbh->lastInsertId();
    }

    public function getRowCount() {
        return $this->_sth->rowCount();
    }

    public function getFetch() {
        return $this->_sth->fetch(PDO::FETCH_ASSOC);
    }

    public function getFetchAll() {
        return $this->_sth->fetchAll(PDO::FETCH_ASSOC);
    }

}
