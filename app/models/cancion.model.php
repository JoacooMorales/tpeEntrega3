<?php

class CancionModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=tpeweb2musica;charset=utf8', 'root', '');
    }

    /**
     * Obtiene y devuelve de la base de datos todas las tareas.
     */
    function getCanciones() {
        $query = $this->db->prepare('SELECT canciones.*, albumes.tituloAlbum AS tituloAlbum FROM canciones LEFT JOIN albumes ON canciones.albumID = albumes.ID');
        $query->execute();
    
        // $canciones es un arreglo de canciones
        $canciones = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $canciones;
    }

    function getCancionesOrdenado($final = ""){
        $query = $this->db->prepare("SELECT * FROM canciones $final");
        $query->execute();
        $canciones = $query->fetchAll(PDO::FETCH_OBJ);
        return $canciones;
    }
    

    /**
     * Inserta la tarea en la base de datos
     */
    function insertCanciones($titulo, $duracion, $albumID) {
        $query = $this->db->prepare('INSERT INTO canciones (titulo, Duración, albumID) VALUES(?,?,?)');
        $query->execute([$titulo, $duracion, $albumID]);

        return $this->db->lastInsertId();
    }

    
function deleteCanciones($id) {
    $query = $this->db->prepare('DELETE FROM canciones WHERE ID = ?');
    $query->execute([$id]);
    $deleted = $query->fetch(PDO::FETCH_OBJ);
    return $deleted;
}

function getCancionByID($id) {    
    $query = $this->db->prepare('SELECT * FROM canciones WHERE ID =? ');
    $query->execute([$id]);
    $cancion = $query->fetch(PDO::FETCH_OBJ);
    return $cancion;
}

function getCancionesByAlbum($id) {    
    $query = $this->db->prepare('SELECT * FROM canciones INNER JOIN albumes ON canciones.albumID = albumes.ID WHERE canciones.albumID =? ');
    $query->execute([$id]);
    $cancion = $query->fetchAll(PDO::FETCH_OBJ);
    return $cancion;
}


function actualizarCancion($id, $titulo, $duracion, $albumID) {
    $query = $this->db->prepare("UPDATE `canciones` SET titulo = ?, Duración = ?, albumID = ? WHERE ID = ?");
    $query->execute([$titulo, $duracion, $albumID, $id]);
    return $query;
}




}