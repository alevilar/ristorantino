<?php

class CustomQuery extends PqueryAppModel{
	var $sql;
	var $limit = 20;
	var $useTable = false;

	
	function setSql($sql){
		$this->sql = $sql;
	}
	
	function setLimit($l=20) {
		$this->limit=$l;
	}

	/**
	 * Esta funcion sobreescribe a la del paginador. Como son 
	 * consultas guardadas en la tabla query, tengo que calcular 
	 * la cantidad de registros para que pagine bien.
	 * @param $conditions, $recursive
	 * @return cantidad de registro.
	 */
		
	function paginateCount($conditions, $recursive){

		$sql  = $this->sql;
		return count($this->query($sql));
	}

	/**
	 * Esta funcion sobreescribe a la del paginador. Como son 
	 * consultas guardadas en la tabla query, tengo que  
	 * reescribir el limit y el offset para poder mostrar por pantalla
	 * @param $conditions, $recursive
	 * @return registros paginados.
	 */
		
	function paginate($conditions, $fields, $order, $limit, $page, $recursive){

		$sql  = $this->sql;
		$sql .= " LIMIT " . $this->limit . " ";
		$sql .= " OFFSET " . (($page - 1) * $this->limit);

		return $this->query($sql);
	}	
	
	
	//TODO deprecated
	function getData(){
		$this->query();
	}
	
	
	function query($sql = null){
            $consultaFinal = array();
		if(!empty($sql)){
			$result =  parent::query($sql);
		}
		else{
			$result = parent::query($this->sql);
		}

                $i = 0;
                foreach ($result as $r){
                    foreach ($r as $r2){
                        foreach ($r2 as $key=>$value) {
                            $consultaFinal[$i][$key] = $value;
                        }
                    }
                    $i++;
                }
                return $consultaFinal;
	}
	
}


?>
