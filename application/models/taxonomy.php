<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Taxonomy extends CI_Model {
/* this model's methods interact with the database to upload batches of samples (and assign them into a particular user's collection), pulling the data for viewing a particular collection, deleting samples from a collection */

// method to select all taxonomy information
	public function select_all() 
	{
		$query = "SELECT * FROM taxonomy;";
	    return $this->db->query($query)->result_array();
	} // end of method

// method to read an excel document with new taxonomy information
public function extract_taxonomy_data_xlsx($file) {

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

// method to submit new taxonomy information in the array into the database
	public function submit_taxonomy_data($data) {
		$query = "INSERT INTO taxonomy (taxonomy_genus, taxonomy_species, taxonomy_family, taxonomy_order) VALUES (?,?,?,?)";

		// need to loop through each of the rows to insert        
         for ($i=2; $i < count($data['values']) ; $i++) { 
         	/* the data is embedded in an array with keys 1,2,3 for each row
         	and then each row is an array with keys A,B,C for columns */
         	$values = array($data['values'][$i]['A'], $data['values'][$i]['B'], $data['values'][$i]['C'], $data['values'][$i]['D'], $data['values'][$i]['E'], $data['values'][$i]['F']);
         	$this->db->query($query, $values);  
         }
        return TRUE;
	}


// method to update existing taxonomy information in the array into the database
	public function update_taxonomy_data($data) {
		$query = "UPDATE `sharkshare`.`taxonomy`
			SET
			`species_ID_shark_references` = ?,
			`author` = ?
			WHERE `id` = ?";

		// need to loop through each of the rows to insert        
         for ($i=2; $i < count($data['values']) ; $i++) { 
         	$id = $i - 1;
         	/* the data is embedded in an array with keys 1,2,3 for each row
         	and then each row is an array with keys A,B,C for columns */
         	$values = array($data['values'][$i]['A'], $data['values'][$i]['D'], $id);
         	$this->db->query($query, $values);  
         }
        return TRUE;
	} // end of method


// method to submit new taxonomy information in the array into the database
	// public function delete_taxonomy_data($data) {
	// 	$query = "INSERT INTO taxonomy (taxonomy_genus, taxonomy_species, taxonomy_family, taxonomy_order) VALUES (?,?,?,?)";

	// 	// need to loop through each of the rows to insert        
 //         for ($i=2; $i < count($data['values']) ; $i++) { 
 //         	 the data is embedded in an array with keys 1,2,3 for each row
 //         	and then each row is an array with keys A,B,C for columns 
 //         	$values = array($data['values'][$i]['A'], $data['values'][$i]['B'], $data['values'][$i]['C'], $data['values'][$i]['D'], $data['values'][$i]['E'], $data['values'][$i]['F']);
 //         	$this->db->query($query, $values);  
 //         }
 //        return TRUE;
	// }
} // end of model