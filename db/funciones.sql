drop procedure if exists incVisitados;

delimiter //

create procedure incVisitados(id int )
	begin
		declare cant int;

		select n_visitado into cant from producto where id_producto = id;

		set cant = cant + 1;

		update producto set n_visitado = cant where id_producto = id;

	end

// delimiter ;