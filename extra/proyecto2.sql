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
	ultima_vez_visto TIMESTAMP,
	FOREIGN KEY (id_pelicula) REFERENCES peliculas_series(id) ON DELETE CASCADE,
	FOREIGN KEY (id_perfil) REFERENCES perfil(id) ON DELETE CASCADE
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
	id			BIGSERIAL PRIMARY KEY,
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

CREATE TABLE anuncios(
	id			BIGSERIAL PRIMARY KEY,
	imagen		VARCHAR(255),
	background	VARCHAR(255),
	nombre		VARCHAR(255),
	descripcion	VARCHAR(255)
)

Insert into anuncios(imagen, background, nombre, descripcion) values ('https://cdn-3.expansion.mx/dims4/default/a4dc17e/2147483647/strip/true/crop/2096x1430+0+0/resize/1200x819!/format/webp/quality/90/?url=https%3A%2F%2Fcdn-3.expansion.mx%2F95%2F6c%2F722abfb544dcb4a46b9ca967a1ef%2Fistock-499925476.jpg', 'https://tentulogo.com/wp-content/uploads/2017/06/cocacola-logo.jpg', 'Coca-cola', 'Comercial de mundial');

select * from users