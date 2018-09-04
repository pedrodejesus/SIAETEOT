delimiter $
create trigger insere_nota_final 
after update on boletim b for each row
begin

select * from boletim b where b.nota_1t is not null and b.nota_2t is not null and b.nota_3t is not null;



end $
delimiter ;
