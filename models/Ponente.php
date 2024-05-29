<?php

namespace Model;

class Ponente extends ActiveRecord {
    protected static $tabla = 'ponentes';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'ciudad', 'pais', 'imagen', 'tags', 'redes'];

    public $id;
    public $nombre;
    public $apellido;
    public $ciudad;
    public $pais;
    public $imagen;
    public $tags;
    public $redes;


    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->ciudad = $args['ciudad'] ?? '';
        $this->pais = $args['pais'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->tags = $args['tags'] ?? '';
        $this->redes = $args['redes'] ?? '';
    }

    public function validar() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }else if (strlen($this->nombre) > 40){
            self::$alertas['error'][] = 'El Nombre no puede superar los 40 caracteres';
        }
        if(!$this->apellido) {
            self::$alertas['error'][] = 'El Apellido es Obligatorio';
        }else if (strlen($this->apellido) > 40){
            self::$alertas['error'][] = 'El Apellido no puede superar los 40 caracteres';
        }
        if(!$this->ciudad) {
            self::$alertas['error'][] = 'El Campo Ciudad es Obligatorio';
        }else if (strlen($this->ciudad) > 20){
            self::$alertas['error'][] = 'La ciudad no puede superar los 20 caracteres';
        }
        if(!$this->pais) {
            self::$alertas['error'][] = 'El Campo País es Obligatorio';
        }else if (strlen($this->pais) > 20){
            self::$alertas['error'][] = 'El Pais no puede superar los 20 caracteres';
        }
        if(!$this->imagen) {
            self::$alertas['error'][] = 'La imagen es obligatoria';
        }
        if(!$this->tags) {
            self::$alertas['error'][] = 'El Campo áreas es obligatorio';
        }
    
        return self::$alertas;
    }
}