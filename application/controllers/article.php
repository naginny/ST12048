<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	author Stella Tīda
 *  article.php
 *	class Article extends CI_Controller
 * 
 *	functions:
 *	public function index()
 *	
 */

class Article extends CI_Controller
{

	public function index()
	{
		$id = $_GET['id'];
		$data = $this->db->from('news')->where('id', $id)->limit(1)->get()->row_array();
		
		$this->lib_page->header(array('title' => 'Harmonija: Ziņas'))->body('article', array('data' => $data))->footer();
	}
	
}