<?php
class jqgrid{
	private $model;
	private $_this;
	public function __construct($arrParams){
		$this->model = $arrParams['model'];
		$this->_this = $arrParams['this'];
		$this->model = ClassRegistry::init($this->model);
	}
	public function run(){
		$rVal = array();
		
		$arrCond = array();
		if (!empty($this->_this->params->query['filters'])){
			$arrQuery = json_decode($this->_this->params->query['filters'],true);
			foreach ($arrQuery['rules'] as $k => $v){
				$arrCond[ $v['field'].' LIKE'] = implode('', array('%',$v['data'],'%'));
			}
		}
		
		if (!empty($this->_this->params->query['q']) && $this->_this->params->query['q']==1){
			$arr = $this->model->find('all',array(
				'page' => $this->_this->params->query['page'],
				'limit' => $this->_this->params->query['rows'],
				'conditions' => $arrCond,
				'order' => array($this->_this->params->query['sidx'].' '.$this->_this->params->query['sord'])
			));
			$records = $this->model->find('count',array('conditions'=>$arrCond));
			$arr['rows'] = Set::classicExtract($arr, '{n}.Post');
			$arr['page'] = $this->_this->params->query['page'];
			$arr['total'] = ceil($records/$this->_this->params->query['rows']);
			$arr['records'] = $records;
			$rVal = $arr;
		}
		else if (!empty($this->_this->params->query['q']) && $this->_this->params->query['q']==2){
			if ($this->_this->data['oper']=='add'){
				$this->model->save($this->_this->data);
			}
			else if ($this->_this->data['oper']=='del'){
				$this->model->delete($this->_this->data['id']);
			}
			else if ($this->_this->data['oper']=='edit'){
				$this->model->save($this->_this->data);
			}
		}		
		return $rVal;
	}
}
?>