<?php

class UserModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=tpeweb2musica;charset=utf8', 'root', '');
    }

    public function getByUsername($username) {
        $query = $this->db->prepare('SELECT * FROM sesion WHERE username = ?');
        $query->execute([$username]);
        $result = $query->fetch(PDO::FETCH_OBJ);
        

        
        return $result;
    }
    
}