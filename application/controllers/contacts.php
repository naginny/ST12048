<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	author Stella Tīda
 *  contacts.php
 *	class Contacts extends CI_Controller
 * 
 *	functions:
 *	public function index()
 *	public function getContactsInfo()
 *	public function updateContactsInfo($id)
 *	
 */

class Contacts extends CI_Controller
{

	public function index()
	{
		$data = $this->getContactsInfo();
		
		$this->lib_page->header(array('title' => 'Harmonija: Kontakti'))->body('contacts', array('data' => $data))->footer();
	}
	
	public function getContactsInfo()
	{
		$contacts = array();
		for ($n = 1; $n < 4; $n ++)
		{
			$contacts[] = $this->db->from('contents')->where('type', 'contacts_block_'.$n)->limit(1)->get()->row_array();
		}
		return $contacts;
	}
	
	public function updateContactsInfo($id)
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
