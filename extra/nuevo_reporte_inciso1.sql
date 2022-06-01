CREATE OR REPLACE FUNCTION /*FUNCTION*/ top_5_content_per_month(
	year_i NUMERIC,
	month_i NUMERIC
)
RETURNS TABLE (
	movie_title VARCHAR(255),
	tiempo_visto NUMERIC,
	s_position NUMERIC,
	hora INTEGER
)
AS $$
	DECLARE
		hour_time NUMERIC;
		last_day_previous_month NUMERIC;
		id_temp BIGINT;
		tme_watch_temp BIGINT; 
		rec1 record;
		t_row record;
		is_new_hour bool;
		cont_position NUMERIC;
		previous_month NUMERIC;
		next_month NUMERIC;
	BEGIN
		CREATE TEMPORARY TABLE reporte_temp(
			id_movie BIGINT,
			time_watching NUMERIC,
			hora INT);
		CREATE TEMPORARY TABLE reporte_final(
			movie_title VARCHAR(255),
			tiempo_visto NUMERIC,
			s_position NUMERIC,
			hora INTEGER);
		-- DECLARO EL VALOR DEL DIA MAXIMO DEL MES SEGUN EL MES
		--Ultimo dia del mes anterior
		IF month_i=3 THEN
			SELECT 28 INTO last_day_previous_month;
		ELSE 
			IF(month_i=5) OR (month_i=7) OR (month_i=10) OR (month_i=12) THEN
				SELECT 30 INTO last_day_previous_month;
			ELSE SELECT 31 INTO last_day_previous_month;
				RAISE NOTICE 'es 31 el limite';
			END IF;
		END IF;
		--Mes anterior
		IF month_i=1 THEN
			SELECT 12 INTO previous_month;
		ELSE
			SELECT month_i-1 INTO previous_month;
		END IF;
		--Mes siguiente
		IF month_i=12 THEN
			SELECT 1 INTO next_month;
		ELSE
			SELECT month_i+1 INTO next_month;
		END IF;
		-- Reporte temporal
		FOR counter IN 9..25 LOOP
			IF counter>23 THEN SELECT counter-24 INTO hour_time;
			ELSE SELECT counter INTO hour_time;
			END IF;
			--Inicia codigo iterado
			FOR t_row IN SELECT * FROM contenido LOOP
				IF (t_row.ultima_vez_visto>=TO_TIMESTAMP(CONCAT(year_i,'-',previous_month ,'-1',' ', hour_time,':00:00'),'YYYY-MM-DD HH24:MI:SS')) 
					AND (t_row.ultima_vez_visto<=TO_TIMESTAMP(CONCAT(year_i,'-',next_month ,'-1',' ', hour_time,':00:00'),'YYYY-MM-DD HH24:MI:SS'))
					AND (EXTRACT(HOUR FROM t_row.ultima_vez_visto )=hour_time)
					THEN
					SELECT t_row.id_pelicula INTO id_temp;
					SELECT reporte_temp.time_watching INTO tme_watch_temp FROM reporte_temp WHERE reporte_temp.id_movie = id_temp AND reporte_temp.hora =hour_time;
					IF (tme_watch_temp IS NULL)  THEN
						INSERT INTO reporte_temp (id_movie, time_watching, hora) VALUES (id_temp,t_row.tiempo, hour_time);
					ELSE 
						UPDATE reporte_temp 
						SET time_watching = tme_watch_temp+t_row.tiempo
						WHERE reporte_temp.id_movie = id_temp AND reporte_temp.hora =hour_time; 
					END IF;
				END IF;
			END LOOP;
			--Termina cogido iteradro
		END LOOP;
		-- Reporte final a partir del temporal
		FOR counter2 IN 9..25 LOOP
			IF counter2>23 THEN SELECT counter2-24 INTO hour_time;
			ELSE SELECT counter2 INTO hour_time;
			END IF;
			SELECT 1 INTO cont_position;
			FOR t_row IN 
				SELECT peliculas_series.nombre AS titulo,reporte_temp.time_watching AS tiempo_visto, reporte_temp.hora AS hora_vis FROM reporte_temp 
				LEFT JOIN peliculas_series ON reporte_temp.id_movie =peliculas_series.id
				WHERE reporte_temp.hora = hour_time ORDER BY reporte_temp.time_watching DESC LIMIT 5
			LOOP
				INSERT INTO reporte_final (movie_title ,tiempo_visto ,s_position,hora) VALUES (t_row.titulo,t_row.tiempo_visto,cont_position ,t_row.hora_vis);
				SELECT cont_position+1 INTO cont_position;
			END LOOP;	
		END LOOP;
		-- RETURN TABLE
		RETURN QUERY SELECT * FROM reporte_final;
		-- ELIMINO LAS TABLAS TEMPORALES
		DROP TABLE reporte_temp;
		DROP TABLE reporte_final;
END; $$
LANGUAGE PLPGSQL;

select * from users
select * from contenido
select * from top_5_content_per_month(2022, 4)

