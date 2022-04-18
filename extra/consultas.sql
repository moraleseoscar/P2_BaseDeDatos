/*
1. El top 10 de géneros de contenido más visto, y los minutos consumidos para un rango
de fechas dado
*/
SELECT * FROM suscripciones
SELECT cat.nombre, SUM(cont.tiempo) as minutos_cons FROM categorias cat
LEFT JOIN categoria_pelicula cat_pel ON cat.id = cat_pel.id_categoria
LEFT JOIN contenido cont ON cont.id_pelicula = cat_pel.id_pelicula
WHERE 	TO_DATE('2022-04-18', 'YYYY-MM-DD')<cont.ultima_vez_visto /*<<<<<----fecha ejemplo, sustituius todo el to date */
AND 	cont.ultima_vez_visto<TO_DATE('2022-04-18', 'YYYY-MM-DD')/*<<<<<----fecha ejemplo, sustituius todo el to date por la fecha que queres*/
GROUP BY cat.nombre
ORDER BY minutos_cons DESC
LIMIT 10; 
/*
2. Cantidad de reproducciones por cada categoría, por tipo de cuenta para un rango de
fechas dado.
*/
SELECT cat.nombre, usrs.tipo, COUNT(prf.id) as reprod FROM categorias cat
LEFT JOIN categoria_pelicula cat_pel ON cat.id = cat_pel.id_categoria
LEFT JOIN contenido cont ON cont.id_pelicula = cat_pel.id_pelicula
LEFT JOIN perfil prf ON prf.id = cont.id_perfil
LEFT JOIN users usrs ON usrs.id = prf.id_usuario
WHERE 	TO_DATE('2022-04-18', 'YYYY-MM-DD')<cont.ultima_vez_visto/*<<<<<----fecha ejemplo, sustituius todo el to date */ 
AND 	cont.ultima_vez_visto<TO_DATE('2022-04-18', 'YYYY-MM-DD')/*<<<<<----fecha ejemplo, sustituius todo el to date */
GROUP BY cat.nombre, usrs.tipo
ORDER BY reprod DESC
/*
3. El top 10 de los directores y actores principales de las películas que los perfiles estándar
y avanzados han visto.
*/
/*
ACTORES
*/
SELECT act.nombre, COUNT(cont.id) AS visto FROM contenido cont
INNER JOIN actores_peliculas ac_pe ON cont.id_pelicula = ac_pe.id_pelicula
INNER JOIN actores act ON act.id = ac_pe.id_actores
INNER JOIN perfil prf ON prf.id = cont.id_perfil
INNER JOIN users usrs ON usrs.id = prf.id_usuario
INNER JOIN suscripciones sus ON sus.id_usuario= usrs.id
WHERE (sus.tipo = '4' OR sus.tipo = '8')
GROUP BY act.nombre
ORDER BY visto DESC;
/*
DIRECTORES
*/

SELECT dir.nombre,  COUNT(cont.id) AS visto FROM contenido cont
INNER JOIN actores_peliculas ac_pe ON cont.id_pelicula = ac_pe.id_pelicula
INNER JOIN director dir ON dir.id = ac_pe.id_actores
INNER JOIN perfil prf ON prf.id = cont.id_perfil
INNER JOIN users usrs ON usrs.id = prf.id_usuario
INNER JOIN suscripciones sus ON sus.id_usuario= usrs.id
WHERE (sus.tipo = '4' OR sus.tipo = '8')
GROUP BY dir.nombre
ORDER BY visto DESC;
/*
4. La cantidad de cuentas avanzadas se han creado en los últimos 6 meses.
*/
SELECT COUNT(*) FROM users usrs
INNER JOIN suscripciones sus ON sus.id_usuario= usrs.id
WHERE created_at>=(CURRENT_DATE-180) AND sus.tipo = '8';

/*
5. Para una fecha específica, ¿cuál es la hora pico donde el servicio es más utilizado?
*/

SELECT EXTRACT (HOUR FROM ultima_vez_visto) as hora, COUNT(id) AS visualizaciones FROM contenido 
WHERE 	TO_DATE('2022-04-18', 'YYYY-MM-DD')-1<ultima_vez_visto 
AND 	ultima_vez_visto<TO_DATE('2022-04-18', 'YYYY-MM-DD')+1/*<<<<<----fecha ejemplo, sustituius todo el to date por la fecha que queres*/
GROUP BY hora
ORDER BY visualizaciones DESC
LIMIT 1;


SELECT EXTRACT (HOUR FROM CURRENT_TIME)
