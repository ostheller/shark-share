<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Collection extends CI_Model {
/* this model's methods interact with the database to upload batches of samples (and assign them into a particular user's collection), pulling the data for viewing a particular collection, deleting samples from a collection */

/* !!!!!!!!!!!!!!!!!! Uploading !!!!!!!!!!!!!!!!!! */

// method to read the data out of the excel file and put it into an array
	public function extract_data_xlsx($file) {

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

// method to submit the data in the array into the database
	public function submit_data($data) {
		$query = "INSERT INTO samples(preservationMedium, comments) VALUES (?,?)";

		// need to loop through each of the rows to insert        
         for ($i=2; $i < count($data['values']) ; $i++) { 
         	/* the data is embedded in an array with keys 1,2,3 for each row
         	and then each row is an array with keys A,B,C for columns */
         	$values = array($data['values'][$i]['B'], $data['values'][$i]['C']);
         	$this->db->query($query, $values);  
         }
        return TRUE;
	}


} // end of model ?>