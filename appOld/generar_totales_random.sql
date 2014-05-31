update mesas
set 
total = cant_comensales*40 + ( RAND() * (cant_comensales*100-cant_comensales*40) )
where cant_comensales > 0;

update mesas
set 
total = 40 + ( RAND() * (100-40) )
where cant_comensales = 0;