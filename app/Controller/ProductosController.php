<?php

/**
 * Productos Controller
 *
 * @property Producto $Producto
 * @property PrgComponent $Prg
 */
class ProductosController extends AppController
{

    var $name = 'Productos';
    public $components = array('Search.Prg');
    public $paginate = array(
        'limit' => 30,
        'order' => array(
            'Producto.name' => 'asc',
        )
    );
    public $presetVars = true; // using the model configuration

    function beforeFilter()
    {
        parent::beforeFilter();
    }

    function index()
    {
        $this->request->params['PaginateConditions'] = array();
        $this->paginate['contain'] = array(
            'Categoria', 'Tag', 'ProductosPreciosFuturo', 'Comandera'
        );

        $this->Prg->commonProcess();
        $this->paginate['conditions'] = $this->Producto->parseCriteria($this->passedArgs);


        $comanderas = $this->Producto->Comandera->listWithDescription();
        $categorias = $this->Producto->Categoria->generateTreeList();
        $this->set(compact('categorias', 'comanderas'));
        $this->set('productos', $this->paginate());
    }

    function view($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid Producto.'));
            $this->redirect(array('action' => 'index'));
        }
        $fields = array(
            'DetalleComanda.producto_id',
            'sum(DetalleComanda.cant_eliminada) as "cant_eliminada"',
            'sum(DetalleComanda.cant - DetalleComanda.cant_eliminada) as "suma"',
            'DATE(DetalleComanda.created) as "date"');

        $this->set('consumiciones', $this->Producto->DetalleComanda->find('all', array(
                    'conditions' => array(
                        'DetalleComanda.producto_id' => $id,
                    ),
                    'contain' => array('DetalleSabor.Sabor'),
                    'fields' => $fields,
                    'group' => 'DetalleComanda.producto_id, DATE(DetalleComanda.created) HAVING sum(DetalleComanda.cant - DetalleComanda.cant_eliminada) > 0',
                    'order' => 'DetalleComanda.created DESC',
                )));

        $this->Producto->contain(array(
            'Categoria', 'HistoricoPrecio' => array('order' => 'HistoricoPrecio.created DESC'), 'Comandera', 'ProductosPreciosFuturo'
        ));
        $this->set('producto', $this->Producto->read(null, $id));
    }

    /**
     * busca un producto por su nombre
     * @param string $nombre
     * @return array
     */
    function buscar_por_nombre($nombre)
    {
        $this->Producto->recursive = -1;
        $this->set('productos', $this->Producto->buscarPorNombre($nombre));
        $this->set('buscando', $nombre);
    }

    function add()
    {
        if ($this->request->is('post')) {
            $this->Producto->create();
            if ($this->Producto->save($this->request->data)) {
                $this->Session->setFlash(__('The Producto has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Producto could not be saved. Please, try again.'));
            }
        }
        $comanderas = $this->Producto->Comandera->find('list', array('fields' => array('id', 'description')));
        $tags = $this->Producto->Tag->find('list');
        $categorias = $this->Producto->Categoria->generateTreeList(null, null, null, '___');
        $this->set(compact('categorias', 'comanderas', 'tags'));
    }

    function edit($id = null)
    {
        $this->Producto->id = $id;
        if (!$this->Producto->exists()) {
            throw new NotFoundException(__('Invalid producto'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Producto->save($this->request->data)) {
                $this->redirect(array('action' => 'index'));
                $this->Session->setFlash(__('The Producto was saved.'));
            } else {
                $this->Session->setFlash(__('The Producto could not be saved. Please, try again.'));
            }
        }

        $this->request->data = $this->Producto->read(null, $id);
        $tags = $this->Producto->Tag->find('list');
        $comanderas = $this->Producto->Comandera->find('list', array('fields' => array('id', 'description')));
        $categorias = $this->Producto->Categoria->generateTreeList(null, null, null, '___');
        $this->set(compact('categorias', 'comanderas', 'tags'));
    }

    function delete($id = null)
    {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Producto->id = $id;
        if (!$this->Producto->exists()) {
            throw new NotFoundException(__('Invalid producto'));
        }
        if ($this->Producto->delete()) {
            $this->Session->setFlash(__('Producto deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Producto was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

    function buscarProductos()
    {

        $this->render('index');
    }

    function actualizarPreciosFuturos()
    {
        $failed = false;
        $preciosFuturos = $this->Producto->ProductosPreciosFuturo->find('all');
        foreach ($preciosFuturos as $pf) {
            $productos = array();
            $productos['Producto']['precio'] = $pf['ProductosPreciosFuturo']['precio'];
            $productos['Producto']['id'] = $pf['ProductosPreciosFuturo']['producto_id'];
            if (!$this->Producto->save($productos, array('validate' => false))) {
                $failed = true;
            }
        }
        if (!$failed) {
            $this->Producto->query("
                    truncate productos_precios_futuros
                ");
            $this->Session->setFlash('Se han modificado TODOS los precios futuros de los productos');
        } else {
            $this->Session->setFlash('Fallo al aplicar los cambios');
            debug($this->Producto);
        }


        $this->redirect($this->referer());
    }

    function sinpreciosfuturos()
    {
        if (!empty($this->request->data)) {
            $condiciones = array();
            $pagCondiciones = array();
            foreach ($this->request->data as $modelo => $campos) {
                foreach ($campos as $key => $val) {

                    if (!is_array($val)) {
                        $condiciones[$modelo . "." . $key . " LIKE"] = '%' . $val . '%';
                        $pagCondiciones[$modelo . "." . $key] = $val;
                    }
                }
            }

            $this->paginate[$this->modelClass] = array(
                'conditions' => $condiciones,
            );
        }


        if (!empty($this->passedArgs) && empty($this->request->data)) {
            $condiciones = array();
            $pagCondiciones = array();
            foreach ($this->passedArgs as $campo => $valor) {
                if ($campo == 'page' || $campo == 'sort' || $campo == 'direction') {
                    continue;
                }
                $condiciones["$campo LIKE"] = '%' . $valor . '%';
                $pagCondiciones[$campo] = $valor;
                $this->request->data[$campo] = $valor;
            }
            $this->paginate[$this->modelClass] = array(
                'conditions' => $condiciones
            );
        }

        $query = 'SELECT * FROM `productos` WHERE `id` NOT IN 
                                (SELECT DISTINCT `producto_id` FROM `productos_precios_futuros`) 
                                        ORDER BY `productos`.`id` ASC';

        $prod_sinpf = $this->Producto->query($query);

//                 //debug($prod_sinpf);
//                 
//                 $condiciones["productos_precios NOT IN"] = '(SELECT DISTINCT `producto_id` FROM `productos_precios_futuros`)';
//                 
//                 	$this->paginate['Producto'] = array(
//				'conditions' => $condiciones
//			);


        $this->Producto->recursive = 0;
        $this->set('productos', $prod_sinpf);
    }

    function update($id = null)
    {
        if (!empty($id)) {
            $this->Producto->id = $id;
        }
        $this->Producto->id = $this->request->data['id'];

        if (!empty($this->Producto->id)) {
            $pf = 'precio_futuro';


            if ($this->Producto->saveField($this->request->data['field'], $this->request->data['value'], false)) {
                $txtShow = (!empty($this->request->data['text'])) ? $this->request->data['text'] : $this->request->data['value'];
                echo $txtShow;
            } else {
                throw new InternalErrorException(__('Error saving Product'));
            }
        } else {
            throw new NotFoundException(__('Product not exists'));
        }
        exit;
    }

}

?>