CREATE DATABASE tecnoperu;
USE tecnoperu;

-- Catálogo de productos, marcas y sus especificaciones
CREATE TABLE marcas
(
	id 			INT AUTO_INCREMENT PRIMARY KEY,
    marca 		VARCHAR(40) 	NOT NULL,
    creado 		DATETIME 		NOT NULL DEFAULT NOW(),
    modificado	DATETIME 		NULL,
    CONSTRAINT uk_marca_mar UNIQUE (marca)
)ENGINE = INNODB;

CREATE TABLE productos
(
	id 			INT AUTO_INCREMENT PRIMARY KEY,
    idmarca 	INT 			NOT NULL,
    tipo 		VARCHAR(40) 	NOT NULL,
    descripcion	VARCHAR(70) 	NOT NULL,
    precio		DECIMAL(7,2) 	NOT NULL,
    garantia	TINYINT 		NOT NULL DEFAULT 6,
    esnuevo		ENUM('S', 'N') 	NOT NULL DEFAULT 'S' COMMENT 'Estado del producto',
    creado 		DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 	DATETIME		NULL,
    CONSTRAINT fk_idmarca_prd FOREIGN KEY (idmarca) REFERENCES marcas (id)
)ENGINE = INNODB;

CREATE TABLE especificaciones
(
	id			INT AUTO_INCREMENT PRIMARY KEY,
    especificacion  VARCHAR(40) NOT NULL,
	creado 		DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 	DATETIME		NULL,
    CONSTRAINT uk_especificacion_esp UNIQUE (especificacion)
)ENGINE = INNODB;

CREATE TABLE bloques
(
	id 			INT AUTO_INCREMENT PRIMARY KEY,
    idproducto 	INT 			NOT NULL,
    bloque	 	VARCHAR(40) 	NOT NULL,
	creado 		DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 	DATETIME		NULL,
    CONSTRAINT fk_idproducto_blq FOREIGN KEY (idproducto) REFERENCES productos (id),
    CONSTRAINT uk_bloqle_blq UNIQUE (idproducto, bloque)
)ENGINE = INNODB;

CREATE TABLE caracteristicas
(
	id 			INT AUTO_INCREMENT PRIMARY KEY,
    idbloque 	INT 			NOT NULL,
    idespecificacion INT 		NOT NULL,
    valor 		VARCHAR(40) 	NOT NULL,
	creado 		DATETIME 		NOT NULL DEFAULT NOW(),
    modificado 	DATETIME		NULL,
    CONSTRAINT fk_idbloque_crt FOREIGN KEY (idbloque) REFERENCES bloques (id),
    CONSTRAINT fk_idespecificacion_crt FOREIGN KEY (idespecificacion) REFERENCES especificaciones (id)
)ENGINE = INNODB;

-- OBJETOS BD
-- Tablas: contenedores
-- Vistas: consultas con nombre (tablas en memoria)
-- Procedimientos almacenados: programas (I/O), algoritmos
-- Desencadenadores (triggers): evento (acción automática)
-- Funciones: tarea recurrente

INSERT INTO marcas (marca) VALUES
	('Samsung'),
    ('Lenovo'),
    ('Epson');

INSERT INTO productos (idmarca, tipo, descripcion, precio) VALUES
	(1, 'Smartphone', 'A51', 1000),
    (2, 'Laptop', 'Gamer RGB', 4000),
    (3, 'Impresora', 'L500', 750);

-- Requerimiento:
-- Cuando se cambie cualquier dato de cualquier registro, se deberá actualizar el campo "modificado"
DELIMITER //
CREATE TRIGGER productos_actualizar_fecha_modificacion
BEFORE UPDATE ON productos
FOR EACH ROW
BEGIN
	-- UPDATE => (1) ELIMINAR > (2) CREAR
	SET NEW.modificado = NOW();
END //

DELIMITER //
CREATE TRIGGER caracteristicas_actualizar_fecha_modificacion
BEFORE UPDATE ON caracteristicas
FOR EACH ROW
BEGIN
	SET NEW.modificado = NOW();
END //

CREATE VIEW vs_productos_todos
AS
	SELECT
		P.id,
        M.marca,
        P.tipo,
        P.descripcion,
        P.precio,
        P.garantia,
        P.esnuevo
		FROM productos P
        INNER JOIN marcas M ON P.idmarca = M.id;



