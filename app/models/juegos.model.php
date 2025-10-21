<?php

class JuegosModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS);
    }

    public function getJuegos() {
    $query = $this->db->prepare(
        "SELECT videojuegos.*, generos.nombre AS genero_nombre FROM videojuegos JOIN generos ON videojuegos.id_genero = generos.id_genero");
    $query->execute();
    $videojuegos = $query->fetchAll(PDO::FETCH_OBJ);
    return $videojuegos;
}

    public function getJuegosXGenero($id_genero) {
    $query = $this->db->prepare("SELECT * FROM videojuegos WHERE id_genero = ?");
    $query->execute([$id_genero]);
    $juegosXGenero = $query->fetchAll(PDO::FETCH_OBJ);
    return $juegosXGenero;
}
    
    public function mostrarDetalleJuego($id_videojuego) {
    $query = $this->db->prepare(
        "SELECT titulo, anio_publicacion, imagen, sinopsis 
         FROM videojuegos 
         WHERE id_videojuego = ?"
    );
    $query->execute([$id_videojuego]);
    $videojuego = $query->fetch(PDO::FETCH_OBJ);
    return $videojuego;
}
    public function getJuegoById($id_videojuego) {
    $query = $this->db->prepare("SELECT * FROM videojuegos WHERE id_videojuego = ?");
    $query->execute([$id_videojuego]);
    $videojuego = $query->fetch(PDO::FETCH_ASSOC);
    return $videojuego;
}


    public function agregarJuego($titulo, $id_genero, $anio_publicacion, $imagen, $sinopsis) {
    $query = $this->db->prepare("INSERT INTO videojuegos (titulo, id_genero, anio_publicacion, imagen, sinopsis) VALUES (?, ?, ?, ?, ?)"
    );
    $query->execute([$titulo, $id_genero, $anio_publicacion, $imagen, $sinopsis]);

    return $this->db->lastInsertId();
}

    public function eliminarJuego($id_videojuego) {
    $query = $this->db->prepare("DELETE FROM videojuegos WHERE id_videojuego = ?");
    $query->execute([$id_videojuego]);
}

    public function editJuego($id_videojuego, $titulo, $id_genero, $anio_publicacion, $imagen, $sinopsis) {
    $query = $this->db->prepare(
        "UPDATE videojuegos SET titulo = ?, id_genero = ?, anio_publicacion = ?, imagen = ?, sinopsis = ? WHERE id_videojuego = ?"
    );
    $query->execute([$titulo, $id_genero, $anio_publicacion, $imagen, $sinopsis, $id_videojuego]);
}
}