<?php 
    
namespace Controllers;

use Model\Evento;
use MVC\Router;
use Model\Paquete;
use Model\Usuario;
use Model\Registro;

class DashboardController{
    public static function index(Router $router){

        if(!is_admin()){
            header('Location: /');
        }

        //Obtener los últimos regisros
        $registros = Registro::get(5);
        foreach($registros as $registro){
            $registro->usuario = Usuario::find($registro->usuario_id);
            $registro->paquete = Paquete::find($registro->paquete_id);
        }

        // Calcular los ingresos
        $virtuales = Registro::total('paquete_id', 2);
        $presenciales = Registro::total('paquete_id', 1);

        $ingresos = ($virtuales * 46.98) + ($presenciales * 191.88);

        //Obtener eventos con más y menos lugares disponibles
        $menos_disponibles = Evento::ordenarLimite('disponibles','ASC',5);
        
        $mas_disponibles = Evento::ordenarLimite('disponibles','DESC',5);
        

        // Render a la vista 
        $router->render('admin/dashboard/index', [
            'titulo' => 'Panel de Administracion',
            'registros' => $registros,
            'ingresos' => $ingresos,
            'menos_disponibles' => $menos_disponibles,
            'mas_disponibles' => $mas_disponibles
            
        ]);
    }


}