<?php

class DeleteModel extends UsersModel {

    public function __construct() {
        parent::__construct();
    }

    public function delete($values) {
        extract($values);
        try {
            $this->_dbh->beginTransaction();
            $this->query('DELETE '
                    . 'FROM users_permissions '
                    . 'WHERE fk_id_user = ? '
                    , array($id_user)
            );
            $this->query('DELETE '
                    . 'FROM users '
                    . 'WHERE id_user = ? '
                    , array($id_user)
            );
            $this->_dbh->commit();
            return true;
        } catch (PDOException $e) {
            $this->_dbh->rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function loadUser($values) {
        extract($values);
        $this->query('SELECT * '
                . 'FROM users '
                . 'WHERE id_user = ? '
                , array($id_user)
        );
        return $this->getFetch();
    }

}
