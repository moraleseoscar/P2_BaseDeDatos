<?php
namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;



class ReportsController extends Controller
{
    public function getTop10Cat($fecha_inicial, $fecha_final) {
        try {
            $top10 = \DB::select(
                "SELECT cat.nombre, SUM(cont.tiempo) as minutos_cons FROM categorias cat
                LEFT JOIN categoria_pelicula cat_pel ON cat.id = cat_pel.id_categoria
                LEFT JOIN contenido cont ON cont.id_pelicula = cat_pel.id_pelicula
                WHERE 	TO_DATE('$fecha_inicial', 'YYYY-MM-DD')<cont.ultima_vez_visto /*<<<<<----fecha ejemplo, sustituius todo el to date */
                AND 	cont.ultima_vez_visto<TO_DATE('$fecha_final', 'YYYY-MM-DD')/*<<<<<----fecha ejemplo, sustituius todo el to date por la fecha que queres*/
                GROUP BY cat.nombre
                ORDER BY minutos_cons DESC
                LIMIT 10"
            );
            return response(["result" => 'success', "data" => ["top10" => $top10]], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }
    public function getReproduccionesPorCategoria($fecha_inicial, $fecha_final) {
        try {
            $repPorCat = \DB::select(
                "SELECT cat.nombre, sus.tipo, COUNT(prf.id) as reprod FROM categorias cat
                LEFT JOIN categoria_pelicula cat_pel ON cat.id = cat_pel.id_categoria
                LEFT JOIN contenido cont ON cont.id_pelicula = cat_pel.id_pelicula
                LEFT JOIN perfil prf ON prf.id = cont.id_perfil
                LEFT JOIN users usrs ON usrs.id = prf.id_usuario
                INNER JOIN suscripciones sus ON sus.id_usuario= usrs.id
                WHERE 	TO_DATE('$fecha_inicial', 'YYYY-MM-DD')<cont.ultima_vez_visto/*<<<<<----fecha ejemplo, sustituius todo el to date */ 
                AND 	cont.ultima_vez_visto<TO_DATE('$fecha_final', 'YYYY-MM-DD')/*<<<<<----fecha ejemplo, sustituius todo el to date */
                GROUP BY cat.nombre, sus.tipo
                ORDER BY reprod DESC;"
            );
            return response(["result" => 'success', "data" => ["repPorCat" => $repPorCat]], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }
    public function getTop10ActorAndDirectorsForEstandarAndAdvance() {
        try {
            $top10Actors = \DB::select(
                "SELECT act.nombre, COUNT(cont.id) AS visto FROM contenido cont
                INNER JOIN actores_peliculas ac_pe ON cont.id_pelicula = ac_pe.id_pelicula
                INNER JOIN actores act ON act.id = ac_pe.id_actores
                INNER JOIN perfil prf ON prf.id = cont.id_perfil
                INNER JOIN users usrs ON usrs.id = prf.id_usuario
                INNER JOIN suscripciones sus ON sus.id_usuario= usrs.id
                WHERE (sus.tipo = '4' OR sus.tipo = '8')
                GROUP BY act.nombre
                ORDER BY visto DESC;"
            );
            $top10Directors = \DB::select( 
                "SELECT dir.nombre,  COUNT(cont.id) AS visto FROM contenido cont
                INNER JOIN peliculas_series pe_ser ON cont.id_pelicula = pe_ser.id
                INNER JOIN director dir ON dir.id = pe_ser.id_director
                INNER JOIN perfil prf ON prf.id = cont.id_perfil
                INNER JOIN users usrs ON usrs.id = prf.id_usuario
                INNER JOIN suscripciones sus ON sus.id_usuario= usrs.id
                WHERE (sus.tipo = '4' OR sus.tipo = '8')
                GROUP BY dir.nombre
                ORDER BY visto DESC"
            );
            return response(["result" => 'success', "data" => ["top10Actors" => $top10Actors, "top10Directors"=>$top10Directors]], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }
    public function getCantidadCreatedAdvanAcount() {
        try {
            $cantidadAdvAcc = \DB::select(
                "SELECT COUNT(*) FROM users usrs
                INNER JOIN suscripciones sus ON sus.id_usuario= usrs.id
                WHERE created_at>=(CURRENT_DATE-180) AND sus.tipo = '8'"
            );
            return response(["result" => 'success', "data" => ["Cantidad de cuentas avanzadas creadas en los ultimos 6 meses" => $cantidadAdvAcc]], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }
    public function getHoraPicoPorFecha($fecha) {
        try {
            $horaPico = \DB::select(    
                "SELECT EXTRACT (HOUR FROM ultima_vez_visto) as hora, COUNT(id) AS visualizaciones FROM contenido 
                WHERE 	TO_DATE('$fecha', 'YYYY-MM-DD')-1<ultima_vez_visto 
                AND 	ultima_vez_visto<TO_DATE('$fecha', 'YYYY-MM-DD')+1/*<<<<<----fecha ejemplo, sustituius todo el to date por la fecha que queres*/
                GROUP BY hora
                ORDER BY visualizaciones DESC
                LIMIT 1"
            );
            return response(["result" => 'success', "data" => ["Hora pico para la fecha $fecha" => $horaPico]], 200);
        } catch (\Exception $e) {
            return response(['result' => 'fail', 'message' => $e->getMessage()], 500);
        }
    }

}
