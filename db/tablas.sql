drop table if exists categoria;

create  table categoria (
	id_categoria int not null AUTO_INCREMENT,
	v_descripcion varchar(50) not null,
	id_categoria_padre int,
	primary key (id_categoria)
);

drop table if exists producto ;

create table producto (
	id_producto int not null AUTO_INCREMENT,
	v_nombre varchar(50) not null,
	v_descripcion text not null,
	f_precio float not null,
	v_img_path varchar(100) not null,
	id_categoria int not null,
	id_usuario int not null,
	n_visitado int default 0,
    ts_creado timestamp default CURRENT_TIMESTAMP,
	primary key (id_producto)
);

drop table if exists caracteristica;

create table caracteristica (
	id_caracteristica int not null  AUTO_INCREMENT,
	v_nombre varchar(100) not null,
	id_categoria int not null,
	primary key (id_caracteristica)
);

drop table if exists caracteristica_x_producto ;

create table caracteristica_x_producto (
	id_caracteristica int not null,
	id_producto int not null,
	v_valor varchar(100),
	primary key (id_caracteristica,id_producto)
);

drop table if exists usuario ;

create table usuario (
	id_usuario int not null AUTO_INCREMENT,
	v_nombre varchar(100) not null,
	v_apellido varchar(100) not null,
	v_telefono varchar(100) not null,
	b_admin boolean not null default false,
	primary key (id_usuario)
);

drop table if exists carrito;

create table carrito (
	id_carrito int not null AUTO_INCREMENT,
	id_usuario int not null,
	ts_creado timestamp default CURRENT_TIMESTAMP,
	ts_actualizado timestamp null,
	b_confirmado boolean not null default false,
	b_habilitado boolean not null default true,
	primary key (id_carrito)
);

drop table if exists producto_x_carrito;

create table producto_x_carrito (
	id_producto int not null,
	id_carrito int not null,
	n_cantidad int not null,
	f_precio_unidad float not null,
	primary key (id_producto, id_carrito)
);

alter table carrito 
  add constraint fk_carrito_usuario 
  foreign key (id_usuario) references usuario (id_usuario);

alter table producto_x_carrito
  add constraint fk_carritoxproducto_producto
  foreign key (id_producto) references producto(id_producto),
  add constraint fk_carritoxproducto_carrito
  foreign key (id_carrito) references carrito (id_carrito);

alter table categoria
  add constraint fk_categoria_padre
  foreign key (id_categoria_padre) references categoria (id_categoria);

alter table producto 
	add constraint fk_categoria_producto
	foreign key (id_categoria) references categoria(id_categoria),
	add constraint fk_usuario_producto
	foreign key (id_usuario) references usuario(id_usuario);

alter table caracteristica 
	add constraint fk_categoria_caracteristica
	foreign key (id_categoria) references categoria(id_categoria);

alter table caracteristica_x_producto
	add constraint fk_caracteristica_carxpro 
	foreign key (id_caracteristica) references caracteristica(id_caracteristica),
	add constraint fk_producto_carxpro 
	foreign key (id_producto) references producto(id_producto);	