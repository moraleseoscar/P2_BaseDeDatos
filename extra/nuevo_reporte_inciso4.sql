/*
INSERT INTO contenido (id_pelicula, id_perfil, tiempo, ultima_vez_visto, inicio_de_visualizacion, estado) VALUES
(3, 2, 10, '2022-04-02', '2022-04-01', false);
*/

/*
se usa, pero ya se creo en el primer reporte
CREATE INDEX ultima_vez_visto_contenido_index ON contenido(ultima_vez_visto);
*/

/*
Crear esta funcion en la DB
*/
CREATE OR REPLACE FUNCTION top_20_left_behind_content(
	fecha_inicio DATE,
	fecha_final DATE
)
RETURNS TABLE (
	id_pelicula BIGINT, 
	titulo_pelicula VARCHAR(255),
	veces_dejada BIGINT
)
AS $$
	BEGIN
	RETURN QUERY 
		SELECT contenido.id_pelicula,peliculas_series.nombre, COUNT(contenido.id_pelicula) FROM contenido
		LEFT JOIN  peliculas_series ON contenido.id_pelicula =peliculas_series.id
		WHERE  EXTRACT(DAY FROM (NOW()-ultima_vez_visto ))>19
		AND estado=false
		AND inicio_de_visualizacion>= fecha_inicio
		AND inicio_de_visualizacion<= fecha_final
		GROUP BY (contenido.id_pelicula,peliculas_series.nombre )
		ORDER BY COUNT(contenido.id_pelicula) DESC
		LIMIT 20;	 
END; $$
LANGUAGE PLPGSQL;

SELECT * FROM top_20_left_behind_content('2022-03-30', '2022-05-01')




