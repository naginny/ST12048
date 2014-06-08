<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	author Stella Tīda
 *  about.php
 *	class About extends CI_Controller
 * 
 *	functions:
 *	public function index()
 *	public function getArticle()
 *	public function updateArticle($id)
 *	
 */

class About extends CI_Controller
{

	public function index()
	{
		$data = $this->getArticle();
		
		$this->lib_page->header(array('title' => 'Harmonija: Par mums'))->body('about', array('data' => $data))->footer();
	}
	
	public function getArticle()
	{
		return $this->db->from('contents')->where('type', 'about')->limit(1)->get()->row_array();
	}
	
	public function updateArticle($id)
	{
		if (isset($_POST['text']))
		{
			$id = intval($id);
			$data = array('text' => $_POST['text']);

			$this->load->model('mdl_content');
			$this->mdl_content->update($id, $data);
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}
	
}
