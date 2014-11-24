

create or replace view view_categorias_pricipales as (
select id_categoria, v_descripcion from categoria
   where  id_categoria = id_categoria_padre 
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