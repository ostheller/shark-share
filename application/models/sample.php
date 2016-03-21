<?php
class Sample extends CI_Model {

	public function get_data($file) {

		$objPHPExcel = PHPExcel_IOFactory::load($file);
		 
		//get only the Cell Collection
		$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
		 
		//extract to a PHP readable array format
		foreach ($cell_collection as $cell) {
		    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
		    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
		    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
		 
		    //header will/should be in row 1 only. of course this can be modified to suit your need.
		    if ($row == 1) {
		        $header[$row][$column] = $data_value;
		    } else {
		        $arr_data[$row][$column] = $data_value;
		    }
		}
		 
		//send the data in an array format
		$data['header'] = $header;
		$data['values'] = $arr_data;
		return $data;
	}

	public function submit_data($data) {
		//var_export($data);
		$query = "INSERT INTO users(first_name, last_name) VALUES (?,?)";        
         for ($i=2; $i < count($data['values']) ; $i++) { 
         	$values = array($data['values'][$i]['B'], $data['values'][$i]['C']);
         	$this->db->query($query, $values);  
         }
         
	}
}

?>