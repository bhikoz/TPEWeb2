<?php
include 'config.php';

class GenerosModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS);
    }

    function getGeneros() {
    $query = $this->db->prepare("SELECT * FROM generos");
    $query->execute();
    $generos = $query->fetchAll(PDO::FETCH_OBJ);
    return $generos;
}

    public function getGeneroById($id_genero) {
    $query = $this->db->prepare("SELECT * FROM generos WHERE id_genero = ?");
    $query->execute([$id_genero]);
    $genero = $query->fetch(PDO::FETCH_OBJ);
    if ($genero) {
        return $genero;
    } else {
        return false;
    }
    }

    public function agregarGenero($nombre, $descripcion) {
    $query = $this->db->prepare("INSERT INTO generos (nombre, descripcion) VALUES (?, ?)");
    $query->execute([$nombre, $descripcion]);
    return $this->db->lastInsertId();
}

    public function eliminarGenero($id_genero) {
    $query = $this->db->prepare("DELETE FROM generos WHERE id_genero = ?");
    $query->execute([$id_genero]);
}
    public function modificarGenero($id_genero, $nombre, $descripcion) {
    $query = $this->db->prepare("UPDATE generos SET nombre = ?, descripcion = ? WHERE id_genero = ?");
    $query->execute([$nombre, $descripcion, $id_genero]);
}
}