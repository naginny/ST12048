<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	author Stella Tīda
 *  ad.php
 *	class Ad extends CI_Controller
 * 
 *	functions:
 *	public function index()
 * 
 */

class Ad extends CI_Controller
{

	public function index()
	{
		$id = $_GET['id'];
		$data = $this->db->from('ad')->where('id', $id)->limit(1)->get()->row_array();
		
		$this->lib_page->header(array('title' => 'Harmonija: Sludinājums'))->body('ad', array('data' => $data))->footer();
	}
	
}
