<?php 
    
namespace Controllers;

use MVC\Router;

class PaginasController{
    public static function index(Router $router){

        // Render a la vista 
        $router->render('paginas/index', [
            'titulo' => 'Inicio',
            
        ]);
    }

    public static function evento(Router $router){

        // Render a la vista 
        $router->render('paginas/devwebcamp', [
            'titulo' => 'Sobre DevWebCamp',
            
        ]);
    }

    public static function paquetes(Router $router){

        // Render a la vista 
        $router->render('paginas/paquetes', [
            'titulo' => 'Paquetes DevWebCamp',
            
        ]);
    }

    public static function conferencias(Router $router){

        // Render a la vista 
        $router->render('paginas/conferencias', [
            'titulo' => 'Conferencias & Whorkshops',
            
        ]);
    }


}