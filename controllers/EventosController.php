<?php 
    
namespace Controllers;

use Classes\Paginacion;
use Model\Categoria;
use Model\Dia;
use Model\Evento;
use Model\Hora;
use Model\Ponente;
use MVC\Router;

class EventosController{
    public static function index(Router $router){

        if(!is_admin()){
            header('Location: /');
        }

        $pagina_actual= $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if(!$pagina_actual  || $pagina_actual < 1){
            header('Location: /admin/eventos?page=1');
            $pagina_actual = 1;
        }

        $total_registros = Evento::total();
        $registros_por_pagina = 10;
        $paginacion = new Paginacion($pagina_actual,$registros_por_pagina,$total_registros);

        if($paginacion->total_paginas() < $pagina_actual){
            header('Location: /admin/eventos?page=1');
            $pagina_actual = 1;
        }

        $eventos = Evento::paginar($registros_por_pagina, $paginacion->offset());

        foreach($eventos as $evento){
            $evento->categoria = Categoria::find($evento->categoria_id);
            $dia = Dia::find($evento->dia_id);
            $hora = Hora::find($evento->hora_id);
            $evento->fecha = $dia->nombre . ', ' . $hora->hora;
            $evento->ponente = Ponente::find($evento->ponente_id);
        }

        // Render a la vista 
        $router->render('admin/eventos/index', [
            'titulo' => 'Confrerencias y Workshops',
            'eventos' => $eventos,
            'paginacion' => $paginacion->paginacion()
            
        ]);
    }

    public static function crear(Router $router){

        if(!is_admin()){
            header('Location: /');
        }

        $alertas = [];

        $categorias = Categoria::all();
        $dias = Dia::all('ASC');
        $horas = Hora::all('ASC');

        $evento = new Evento();

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $evento->sincronizar($_POST);
            

            $alertas = $evento->validar();

            if(empty($alertas)){
                $resultado = $evento->guardar();

                if($resultado){
                    header('Location:/admin/eventos');
                }
            }
        }

        

        // Render a la vista 
        $router->render('admin/eventos/crear', [
            'titulo' => 'Registrar Evento',
            'alertas' => $alertas,
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas,
            'evento' => $evento
            
        ]);
    }

    public static function editar(Router $router){

        if(!is_admin()){
            header('Location: /');
        }

        $alertas = [];
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id){
            header('Location: /admin/eventos');
        }

        $categorias = Categoria::all();
        $dias = Dia::all('ASC');
        $horas = Hora::all('ASC');

        $evento = Evento::find($id);

        if(!$evento){
            header('Location: /admin/eventos'); 
        }


        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $evento->sincronizar($_POST);
            

            $alertas = $evento->validar();

            if(empty($alertas)){
                $resultado = $evento->guardar();

                if($resultado){
                    header('Location:/admin/eventos');
                }
            }
        }

        

        // Render a la vista 
        $router->render('admin/eventos/editar', [
            'titulo' => 'Editar Evento',
            'alertas' => $alertas,
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas,
            'evento' => $evento
            
        ]);
    }

    public static function eliminar() {

        if(!is_admin()){
            header('Location: /');
        }

        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = $_POST['id'];

            $id = filter_var($id, FILTER_VALIDATE_INT);

            if(!$id){
                header('Location: /admin/eventos');
            }

            $evento = Evento::find($id);

            if(!$evento){
                header('Location: /admin/eventos'); 
            }

            $resultado = $evento->eliminar();

            if($resultado){
                header('Location: /admin/eventos');
            }


        }
    }



}