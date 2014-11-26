

create or replace view view_categorias_pricipales as (
select id_categoria, v_descripcion from categoria
   where  id_categoria = id_categoria_padre OR id_categoria_padre is null
   order by v_descripcion ASC);

create or replace view view_top_visitados as (
	select * from producto 
		where n_visitado <> 0 
		order by n_visitado desc 
		limit 20
);

drop view if exists view_producto;
create view view_producto as (
	select p.*, concat(u.v_nombre, ' ', u.v_apellido) as v_nombre_vendedor, u.v_telefono as v_telefono_vendedor from producto p
		join usuario u on (u.id_usuario = p.id_usuario)
);

DROP VIEW IF EXISTS view_compras;
create view view_compras as (
	select c.id_carrito ,  sum(pxc.n_cantidad) as cantTotalUnidades , sum(pxc.n_cantidad * pxc.f_precio_unidad) as montoTotal , 
		   DATE_FORMAT(c.ts_creado,'%d/%m/%Y') as vFecha, concat(u.v_nombre, ' ', u.v_apellido) as vUsuario

	from carrito c

	join producto_x_carrito pxc on (pxc.id_carrito = c.id_carrito)
	join usuario u on (u.id_usuario = c.id_usuario)

	where c.b_confirmado and c.b_habilitado = false

	group by c.id_carrito

	order by c.ts_creado DESC

);