<?php 
    
namespace Controllers;

use Model\Categoria;
use Model\Dia;
use Model\Hora;
use MVC\Router;

class EventosController{
    public static function index(Router $router){

        // Render a la vista 
        $router->render('admin/eventos/index', [
            'titulo' => 'Confrerencias y Workshops',
            
        ]);
    }

    public static function crear(Router $router){

        $alertas = [];

        $categorias = Categoria::all();
        $dias = Dia::all('ASC');
        $horas = Hora::all('ASC');

        

        // Render a la vista 
        $router->render('admin/eventos/crear', [
            'titulo' => 'Registrar Evento',
            'alertas' => $alertas,
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas
            
        ]);
    }




}