update mesas
set 
total = cant_comensales*50 + ( RAND() * (cant_comensales*120-cant_comensales*50) )
where cant_comensales > 0;

update mesas
set 
total = 60 + ( RAND() * (520-60) )
where cant_comensales = 0;