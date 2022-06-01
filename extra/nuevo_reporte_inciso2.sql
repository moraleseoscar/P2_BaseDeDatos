/*
Se tiene que crear esta nueva tabla
de abajo , con el indice que dice dice despues de crear la tabla
*/

CREATE TABLE busquedas (
	id BIGSERIAL PRIMARY KEY, 
	palabra_clave TEXT NOT NULL
);
CREATE INDEX palabra_clave_busquedas_index ON busquedas(palabra_clave);
/*
QUERY A HACER EN BACK por cada busqueda
INSERT INTO busquedas (palabra_clave) VALUES ('adios');
*/

SELECT palabra_clave, COUNT(palabra_clave) AS veces_buscada FROM busquedas
GROUP BY palabra_clave
ORDER BY veces_buscada DESC
LIMIT 10;
