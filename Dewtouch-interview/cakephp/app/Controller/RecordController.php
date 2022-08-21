<?php
	class RecordController extends AppController{
		

		var $components = array('Paginator', 'DataTable');

		public function index(){
			ini_set('memory_limit','256M');
			set_time_limit(0);
			
			$this->setFlash('Listing Record page too slow, try to optimize it.');
			

			$param = array(
				'order'      => array('id'),
				'fields'     => array('id', 'name'),
				'recursive'  => -1,
 			);

			$conditions = array();	
			$sSearch = $this->request->query('sSearch');
			if($sSearch){
				foreach($param['fields'] as $search_field){
        			$conditions['OR'][] = array($search_field.' LIKE' => '%'.$sSearch.'%');
        		}

			}
			$param['conditions'] = $conditions;

			$total = $this->Record->find('count', $param);

			
            if( isset($this->request->query['iDisplayStart']) && $this->request->query['iDisplayLength'] != '-1' ){
				$len   = $this->request->query['iDisplayLength'];
				$start = $this->request->query['iDisplayStart'];
				$param['limit'] = $len;
				$param['page']  = ($start/$len)+1;
	        }
			$records        = $this->Record->find('all', $param);
			$total_filtered = $this->Record->find('count', $param);

			$aData = array();
			foreach($records as $i){
				$tmp = [$i['Record']['id'], $i['Record']['name']];
                $aData[] = $tmp;
            }

			// if request type is ajax, return json (referring AppController line 39)
			if($this->request->is('ajax')){
				$result["aData"]                = $aData; 
				$result["length"]               = count($records); 
				$result['iTotalRecords']        = $total;
				$result['iTotalDisplayRecords'] = $total_filtered;
				echo json_encode($result); exit;
			}

			// $this->set('datatabledatas', $records);
			// $this->set('_serialize','datatabledatas');
			$this->set('title',__('List Record'));


		}
		
		
// 		public function update(){
// 			ini_set('memory_limit','256M');
			
// 			$records = array();
// 			for($i=1; $i<= 1000; $i++){
// 				$record = array(
// 					'Record'=>array(
// 						'name'=>"Record $i"
// 					)			
// 				);
				
// 				for($j=1;$j<=rand(4,8);$j++){
// 					@$record['RecordItem'][] = array(
// 						'name'=>"Record Item $j"		
// 					);
// 				}
				
// 				$this->Record->saveAssociated($record);
// 			}
			
			
			
// 		}
	}
    
