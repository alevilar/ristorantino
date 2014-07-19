<?php
App::import('Model','Pquery.CustomQUery');

class QueriesController extends StatsAppController {

	var $name = 'Queries';
	var $helpers = array('Html', 'Form','Ajax');
	var $components = array('Auth','RequestHandler');
        

	function index() {
		$this->Query->recursive = 0;
		$this->set('queries', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Query.'));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('query', $this->Query->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->Query->create();
			if ($this->Query->save($this->request->data)) {
				$this->Session->setFlash(__('The Query has been saved'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Query could not be saved. Please, try again.'));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid Query'));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Query->save($this->request->data)) {
				$this->Session->setFlash(__('The Query has been saved'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Query could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Query->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Query'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Query->del($id)) {
			$this->Session->setFlash(__('Query deleted'));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	function descargar_queries() {
		$categoria=(isset($this->request->data['Query']['categoria']))? $this->request->data['Query']['categoria'] : "";
		$this->set('categoria',$categoria);

		$categorias = array();
		$categorias[''] = 'Todos';
		$categorias_aux = $this->Query->listarCategorias();
		foreach($categorias_aux as $c){
			$categorias[$c['Query']['categoria']] = $c['Query']['categoria'];
		}
		$this->set('categorias',$categorias);

		$conditions=array();
		if($categoria!=""){
			$conditions['categoria']=$categoria;
		}
		if(isset($this->request->data['Query']['description']) && $this->request->data['Query']['description']!="") {
			$conditions['OR']['lower(to_ascii(Query.description)) SIMILAR TO ?'] = array($this->Query->convertir_para_busqueda_avanzada(utf8_decode($this->request->data['Query']['description'])));
			$conditions['OR']['lower(to_ascii(Query.name)) SIMILAR TO ?'] = array($this->Query->convertir_para_busqueda_avanzada(utf8_decode($this->request->data['Query']['description'])));
		}

		$queries=$this->Query->find('all',array('order'=>'modified DESC', 'conditions'=>$conditions));
		$this->set('queries',$queries);
	}
	
	/**
	 * esto me construye un excel en la vista con el id de la query
	 * @param $id
	 */
	function contruye_excel($id){
		$this->layout = 'excel';
		Configure::write('debug',0);
		$this->RequestHandler->setContent('xls', 'application/vnd.ms-excel');
		$res = $this->Query->findById($id);
		$sql = $res['Query']['query'];
		$this->Query->recursive = -1;
		$consulta_ejecutada = $this->Query->query($sql);

		$precols = array_keys($consulta_ejecutada[0]);

                $quitar_columnas = $consulta_ejecutada[0][0];
		while(list($key,$value) = each($quitar_columnas)):
			$columnas[] = $key;
		endwhile;

		$this->set('nombre',$res['Query']['name']);
		$this->set('columnas',$columnas);
		$this->set('filas',$consulta_ejecutada);

	}
	
	
	function listado_categorias()
	{
		Configure::write('debug', 0);
		$this->Query->recursive = -1;
                
		$categorias = array();
		if(!empty($this->request->data['Query']['categoria'])){
			$categorias = $this->Query->listarCategorias($this->request->data['Query']['categoria']);
		}
                if (!empty($this->passedArgs['term'])) {
                    $categorias = $this->passedArgs['term'];
                }
		if (empty($categorias)) {
			$categorias = $this->Query->listarCategorias('*'); // me trae todas
		}



		$this->set('categorias',$categorias);
		$this->set('string_categoria',$this->request->data['Query']['categoria']);
		$this->layout = 'ajax';
	}



        function list_view($id="") {
            $this->layout = "sin_menu";
            $this->CustomQuery =& ClassRegistry::init('Pquery.CustomQuery');

            if (isset($this->passedArgs['query.id'])) {
                $id = $this->passedArgs['query.id'];
            }

            if (!$id) {
                $this->Session->setFlash(__('Invalid id for Query'));
                $this->redirect(array('action'=>'index'));
            }

            $this->rutaUrl_for_layout[] =array('name'=> 'Queries','link'=>'/Instits/add' );
            $res = $this->Query->findById($id);

            $this->CustomQuery->setSql($res['Query']['query']);

            if (!empty($this->passedArgs['viewAll'])) {
                if ($this->passedArgs['viewAll'] == 'true') {
                    $data = $this->CustomQuery->query();
                    $viewAll = false;
                }
            } else {
                $data = $this->paginate($this->CustomQuery);
                $viewAll = true;
            }

            $precols = array_keys($data[0]);
            //$cols = array_keys($data['0']['0']);
            $this->set('cols', $precols);
            $url_conditions['query.id'] = $id;
            $this->set('queries', $data);
            $this->set('url_conditions', $url_conditions);
            $this->set('name', $res['Query']['name']);
            $this->set('descripcion', $res['Query']['description']);
            $this->set('viewAll', $viewAll);


            if ($this->RequestHandler->ext == 'xls') {
                $this->layout = 'xls';
                $this->render('xls/'.$this->action);
            }
        }


}
?>