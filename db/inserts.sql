
/*Categorias Principales*/

INSERT INTO categoria (id_categoria,v_descripcion,id_categoria_padre)
            values(1,'Automotores',1);
INSERT INTO categoria (id_categoria,v_descripcion,id_categoria_padre)
            values(2,'Computación',2);
INSERT INTO categoria (id_categoria,v_descripcion,id_categoria_padre)
            values(3,'Deportes',3);
INSERT INTO categoria (id_categoria,v_descripcion,id_categoria_padre)
            values(4,'Electrodomésticos',4);
INSERT INTO categoria (id_categoria,v_descripcion,id_categoria_padre)
            values(5,'Hogar',5);
INSERT INTO categoria (id_categoria,v_descripcion,id_categoria_padre)
            values(6,'Instrumentos Musicales',6);

/*subcategorias de Automotores*/
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Autos',1);
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Motos',1);
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Utilitarios',1);
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Otros',1);


/*subcategorias de Computación*/
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Escritorio',2);
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Portatiles',2);
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Accesorios',2);
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Monitores',2);
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Otros',2);

/*subcategorias de Deportes*/
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Aire Libre',3);
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Futbol',3);
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Paddle',3);
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Tenis',3);
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Rugby',3);

/*subcategorias de Electrodomésticos*/
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Celulares',4);
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Televisores',4);
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Audio',4);
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Fotografia',4);
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Video',4);

/*subcategorias de Hogar*/
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Hornos',5);
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Heladeras',5);
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Lavarropas',5);
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Jardin',5);
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Muebles',5);

/*subcategorias de Instrumentos Musicales*/
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Guitarras',6);
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Bajos',6);
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Baterias',6);
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Pianos',6);
INSERT INTO categoria (v_descripcion,id_categoria_padre)
            values('Efectos',6);

/*** usuarios *****/

INSERT INTO usuario(id_usuario,v_nombre,v_apellido,v_telefono)
            values(1,'Troy','McClure','555-5555-5555'); 


/*********productos**************/

INSERT INTO producto(v_nombre,v_descripcion,f_precio,v_img_path,id_categoria,id_usuario)
            values('Torino','No existe otro igual',100000,'img/torino.jpg',7,1);
INSERT INTO producto(v_nombre,v_descripcion,f_precio,v_img_path,id_categoria,id_usuario)
            values('Chevy','Que me sigan!!!',80000,'img/chevy.jpg',7,1);
INSERT INTO producto(v_nombre,v_descripcion,f_precio,v_img_path,id_categoria,id_usuario)
            values('Lotus','El sueño del pibe',800000,'img/1-lotus-esprit-2012.jpg',7,1);
INSERT INTO producto(v_nombre,v_descripcion,f_precio,v_img_path,id_categoria,id_usuario)
            values('Camaro','Subi que te llevo',650000,'img/camaro.jpg',7,1);
INSERT INTO producto(v_nombre,v_descripcion,f_precio,v_img_path,id_categoria,id_usuario)
            values('La bestia','YEAH',1000000,'img/art_autos.jpg',7,1);
INSERT INTO producto(v_nombre,v_descripcion,f_precio,v_img_path,id_categoria,id_usuario)
            values('Citroen 3cv','Motor a nuevo 0km',8000,'img/citroen-3cv-4_3.jpg',7,1);

/************Caracteristicas*****************/

INSERT INTO caracteristica(v_nombre,id_categoria)
            values('Marca',1);
INSERT INTO caracteristica(v_nombre,id_categoria)
            values('Modelo',1);
INSERT INTO caracteristica(v_nombre,id_categoria)
            values('Año',1);
INSERT INTO caracteristica(v_nombre,id_categoria)
            values('Motor',1);
INSERT INTO caracteristica(v_nombre,id_categoria)
            values('Combustible',1);
