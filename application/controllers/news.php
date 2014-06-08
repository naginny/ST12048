<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	author Stella Tīda
 *  news.php
 *	class News extends CI_Controller
 * 
 *	functions:
 *	public function index($page = 0)
 *	protected function collect_news($page, $perPage)
 *	public function countTotalNews()
 *	public function delete($id)
 *	public function createArticle()
 * 
 */

class News extends CI_Controller
{
	
	protected $perPage = 4;
	
	public function index($page = 0)
	{
		$page = intval($page);
		if ($page < 0) {
			$page = 0;
		}
		$this->load->library('pagination');
		
		$config['base_url'] = site_url('news/index');
		$config['total_rows'] = $this->countTotalNews();
		$config['per_page'] = $this->perPage; 
		$this->pagination->initialize($config); 
		
		$data = $this->collect_news($page, $this->perPage);
		
		$this->lib_page->header(array('title' => 'Harmonija: Ziņas'))->body('news', array(
			'data' => $data
		))->footer();
	}
	
	protected function collect_news($page, $perPage)
	{
		header('Content-Type: text/html; charset=utf-8');
		$this->load->model('mdl_news');
		
		$this->db->order_by('id', 'desc')->limit($perPage, $page);
		$records = $this->mdl_news->readMany();
		
		return($records);
	}
	
	public function countTotalNews()
	{
		$this->load->model('mdl_news');
		$records = $this->mdl_news->readMany();
		return count($records);
	}
	
	public function delete($id)
	{
		if (!$this->mdl_user->isAdmin())
		{
			echo 'Access denied.';
			return;
		}
		// init id
		$id = intval($id);
		// delete item
		$this->load->model('mdl_news');
		$this->mdl_news->delete($id);
		
		header('Location: ' . site_url('news'));
	}
	
	public function createArticle()
	{
		$messages = array();
		if (!empty($_POST['submit']))
		{
			$data = array();
			$data['title'] = array_key_exists('title', $_POST) ? $_POST['title'] : NULL;
			$data['summary'] = array_key_exists('summary', $_POST) ? $_POST['summary'] : NULL;
			$data['text'] = array_key_exists('text', $_POST) ? $_POST['text'] : NULL;
			$data['source'] = array_key_exists('source', $_POST) ? $_POST['source'] : NULL;
			
			if (strlen($data['title']) < 5)
			{
				$messages[] = 'Jābūt virsrakstam';
			}
			elseif (strlen($data['title']) > 255)
			{
				$messages[] = 'Virsraksts ir pārāk garš';
			}
			if (strlen($data['text']) < 5)
			{
				$messages[] = 'Jābūt raksta saturam';
			}
			if (strlen($data['summary']) > 255)
			{
				$messages[] = 'Īss apraksts ir pārāk garš';
			}
			if (strlen($data['source']) > 40)
			{
				$messages[] = 'Avots ir pārāk garš';
			}
			
			$this->load->model('mdl_news');
			if (empty($messages))
			{
				$this->mdl_news->create($data);
				header('Refresh: 0; Url=' . site_url('news'));
				exit;
			}	
		}
		
		$header['title'] = 'Harmonija: Jauns raksts';
		$body['title'] = array_key_exists('title', $_POST) ? $_POST['title'] : NULL;
		$body['summary'] = array_key_exists('summary', $_POST) ? $_POST['summary'] : NULL;
		$body['text'] = array_key_exists('text', $_POST) ? $_POST['text'] : NULL;
		$body['source'] = array_key_exists('source', $_POST) ? $_POST['source'] : NULL;
		$body['messages'] = $messages;
		
		$this->lib_page->header($header)->body('create_article', $body)->footer();
	}
}
