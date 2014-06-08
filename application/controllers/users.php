<?php

/*
 *	author Stella Tīda
 *	users.php
 *	class Users extends CI_Controller
 * 
 *	functions:
 *	public function listUsers();
 *	public function deleteUser($id);
 *	public function updateUserInfo($id);
 * 
 */

class Users extends CI_Controller
{
	public function listUsers()
	{
		$this->lib_page->header(array('title' => 'Harmonija: Lietotāji'))->body('users',
				array('users' => $this->mdl_user->getList()))->footer();
	}
	
	public function deleteUser($id)
	{
		$id = intval($id);
		$this->load->model('mdl_user');
		$this->mdl_user->delete($id);
		
		$this->load->model('mdl_ads');
		$this->db->delete($this->mdl_ads->getTable(), array('authorId' => $id));
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}
	
	public function updateUserInfo($id)
	{
		if (isset($_POST['permissions_index']))
		{
			$id = intval($id);
			$data = array('permissions_index' => $_POST['permissions_index']);
			
			$this->load->model('mdl_user');
			$this->mdl_user->update($id, $data);
		}
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}
	
}
?>
