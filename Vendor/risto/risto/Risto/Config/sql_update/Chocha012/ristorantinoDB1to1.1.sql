ALTER TABLE detalle_comandas
ADD COLUMN es_entrada TINYINT DEFAULT 0;


ALTER TABLE comandas
ADD COLUMN observacion TEXT;

