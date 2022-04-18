/***
	BASE DE DATOS 1
	-----------------------------------
	Oscar Estrada		20565
	Axel Lopez			20768
	Luis Gonzales		20008
***/

CREATE TABLE users(
	id				BIGSERIAL PRIMARY KEY,
	nombre			VARCHAR(50),
	email			VARCHAR(50),
	password		VARCHAR(75),
	tipo			VARCHAR(50)
);

CREATE TABLE perfil(
	id			BIGSERIAL PRIMARY KEY,
	nombre		VARCHAR(255),
	id_usuario	BIGINT,
	activo		BOOLEAN,
	icon		VARCHAR(10),
	FOREIGN KEY (id_usuario) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE login_fallido (
	id				BIGSERIAL PRIMARY KEY,
	id_usuario		BIGINT,
	veces			INT,
	FOREIGN KEY (id_usuario) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE director(
	id			BIGSERIAL PRIMARY KEY,
	nombre		VARCHAR(255)
);

CREATE TABLE categorias(
	id 			BIGSERIAL PRIMARY KEY,
	nombre		VARCHAR(75)
);

CREATE TABLE peliculas_series(
	id				BIGSERIAL PRIMARY KEY,
	nombre			VARCHAR(255),
	id_director		BIGINT,
	tipo			VARCHAR(75),
	fecha_estreno	DATE,
	descripcion		VARCHAR(1000),
	duracion		VARCHAR(50),
	link_video		VARCHAR(1000),
	FOREIGN KEY (id_director) REFERENCES director(id) ON DELETE CASCADE
);

CREATE TABLE favoritos(
	id			BIGSERIAL PRIMARY KEY,
	id_pelicula	BIGINT,
	id_perfil	BIGINT,
	FOREIGN KEY (id_pelicula) REFERENCES peliculas_series(id) ON DELETE CASCADE,
	FOREIGN KEY (id_perfil) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE contenido(
	id			BIGSERIAL PRIMARY KEY,
	id_pelicula	BIGINT,
	id_perfil	BIGINT,
	tiempo		INT,
	FOREIGN KEY (id_pelicula) REFERENCES peliculas_series(id) ON DELETE CASCADE,
	FOREIGN KEY (id_perfil) REFERENCES users(id) ON DELETE CASCADE
);


CREATE TABLE sugerencias(
	id				BIGSERIAL PRIMARY KEY,
	id_categoria	BIGINT,
	id_perfil		BIGINT,
	FOREIGN KEY (id_categoria) REFERENCES categorias(id) ON DELETE CASCADE,
	FOREIGN KEY (id_perfil) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE suscripciones(
	id				BIGSERIAL PRIMARY KEY,
	tipo			VARCHAR(10),
	fecha_inicio	DATE,
	fecha_caducidad	DATE,
	/**
	dia pago		DATE,
	**/
	id_usuario		BIGINT,
	FOREIGN KEY (id_usuario) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE categoria_pelicula(
	id				BIGSERIAL PRIMARY KEY,
	id_categoria	BIGINT,
	id_pelicula		BIGINT,
	FOREIGN KEY (id_categoria) REFERENCES categorias(id) ON DELETE CASCADE,
	FOREIGN KEY (id_pelicula) REFERENCES peliculas_series(id) ON DELETE CASCADE
);

CREATE TABLE actores(
	id			BIGINT PRIMARY KEY,
	nombre		VARCHAR(255)
);

CREATE TABLE actores_peliculas(
	id			BIGSERIAL PRIMARY KEY,
	id_actores	BIGINT,
	id_pelicula	BIGINT,
	FOREIGN KEY (id_actores) REFERENCES actores(id) ON DELETE CASCADE,
	FOREIGN KEY (id_pelicula) REFERENCES peliculas_series(id) ON DELETE CASCADE
);

CREATE TABLE premios(
	id			BIGSERIAL PRIMARY KEY,
	nombre		VARCHAR(255),
	id_pelicula	BIGINT,
	FOREIGN KEY (id_pelicula) REFERENCES peliculas_series(id) ON DELETE CASCADE
);