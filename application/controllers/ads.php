<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	author Stella Tīda
 *  ads.php
 *	class Ads extends CI_Controller
 * 
 *	functions:
 *	public function index($page = 0)
 *	public function getAds($page, $perPage, $criteria)
 *	public function createNewAd()
 *	public function countTotalAds($criteria)
 *	protected function getCategories()
 *	protected function getTypes()
 *	protected function getCities()
 *	public function delete($id)
 *	
 */

class Ads extends CI_Controller
{
	protected $perPage = 10;
	
	public function index($page = 0)
	{
		$page = intval($page);
		if ($page < 0) {
			$page = 0;
		}
		
		$types = $this->getTypes();
		$categories = $this->getCategories();
		$cities = $this->getCities();
		$ads = $this->getAds($page, $this->perPage, $this->input->post());
		
		$this->load->library('pagination');
		$config['base_url'] = site_url('ads/index');
		$config['total_rows'] = $this->countTotalAds($this->input->post());
		$config['per_page'] = $this->perPage; 
		$this->pagination->initialize($config); 
		
		$body['categories'] = $this->getCategories();
		$body['types'] = $this->getTypes();
		$body['cities'] = $this->getCities();
		$body['curCategory'] = array_key_exists('category', $_POST) ? $_POST['category'] : NULL;
		$body['curType'] = array_key_exists('type', $_POST) ? $_POST['type'] : NULL;
		$body['curCity'] = array_key_exists('city', $_POST) ? $_POST['city'] : NULL;
		$body['ads'] = $ads;

		$this->lib_page->header(array('title' => 'Harmonija: Sludinājumi'))->body('ads', $body)->footer();
	}
	
	public function getAds($page, $perPage, $criteria)
	{
		$criteria = array_filter($criteria ?: array());
		
		$this->load->model('mdl_ads');
		$this->db->order_by('dateAdded', 'desc')->limit($perPage, $page);
		$records = $this->mdl_ads->readMany($criteria) ?: array();
		foreach($records as &$record) {
			$recordTextLength = strlen($record['text']);
			if ($recordTextLength < 90) {
				continue;
			}
			$record['text'] = substr($record['text'], 0, 70) . '...';
		}
		return ($records);
	}
	
	public function createNewAd()
	{
		$messages = array();
		if (!empty($_POST['submit']))
		{
			$data = array();
			$data['category'] = array_key_exists('category', $_POST) ? $_POST['category'] : NULL;
			$data['type'] = array_key_exists('type', $_POST) ? $_POST['type'] : NULL;
			$data['city'] = array_key_exists('city', $_POST) ? $_POST['city'] : NULL;
			$data['text'] = array_key_exists('text', $_POST) ? $_POST['text'] : NULL;
			$data['price'] = array_key_exists('price', $_POST) ? $_POST['price'] : NULL;
			$data['phone'] = array_key_exists('phone', $_POST) ? $_POST['phone'] : NULL;
			$data['email'] = array_key_exists('email', $_POST) ? $_POST['email'] : NULL;
			
			if (($data['email']) && !valid_email($data['email']))
			{
				$messages[] = 'Ievadiet pareizo e-pastu';
			}
			if (empty($data['email']) && empty($data['phone']))
			{
				$messages[] = 'Jābūt norādītai kontaktinformācijai: e-pastam un/vai telefona numuram';
			}
			if ($data['category'] < 1)
			{
				$messages[] = 'Izvēlieties sludinājuma kategoriju';
			}
			if ($data['type'] < 1)
			{
				$messages[] = 'Izvēlieties sludinājuma tipu';
			}
			if ($data['city'] < 1)
			{
				$messages[] = 'Izvēlieties pilsētu';
			}
			if (empty($data['text']))
			{
				$messages[] = 'Sludinājumam nav teksta';
			}
			if (strlen($data['text']) < 5)
			{
				$messages[] = 'Sludinājuma teksts ir pārāk īss';
			}
			if (($data['type'] == 2) && empty($data['price']))
			{
				$messages[] = 'Sludinājumos ar tipu "pārdod" jānorada cena';
			}
			
			$this->load->model('mdl_ads');
			if (empty($messages))
			{
				$this->mdl_ads->create($data);
				header('Refresh: 0; Url=' . site_url('ads'));
				exit;
			}	
		}
		
		$header = array();
		$header['title'] = 'Harmonija: Jauns sludinājums';
		$body = array(); 
		
		$body['categories'] = $this->getCategories();
		$body['types'] = $this->getTypes();
		$body['cities'] = $this->getCities();
		$body['curCategory'] = array_key_exists('category', $_POST) ? $_POST['category'] : NULL;
		$body['curType'] = array_key_exists('type', $_POST) ? $_POST['type'] : NULL;
		$body['curCity'] = array_key_exists('city', $_POST) ? $_POST['city'] : NULL;
		$body['messages'] = $messages;
		
		$this->lib_page->header($header)->body('create_ad', $body)->footer();
	}
	
	public function countTotalAds($criteria)
	{
		$criteria = array_filter($criteria ?: array());
		$this->load->model('mdl_ads');
		$records = $this->mdl_ads->readMany($criteria);
		return count($records);
	}
	
	protected function getCategories()
	{
		return array(
			0 => '---',
			1 => 'Bērniem',
			2 => 'Skaistums un veselība',
			3 => 'Kursi un apmācība',
			4 => 'Sīkie remonta darbi',
			5 => 'Dažādi',
		);
	}
	
	protected function getTypes()
	{
		return array(
			0 => '---',
			1 => 'pērk',
			2 => 'pārdod',
			3 => 'pakalpojumi',
			4 => 'atdošu ar brīvu',
		);
	}
	
	protected function getCities()
	{
		return array(
			0 => '---',
			1 => 'Jelgava',
			2 => 'Rīga',
			3 => 'Cits',
		);
	}
	
	public function delete($id)
	{
//		if (!$this->mdl_user->isAdmin()) {
//			echo 'Access denied.';
//			return;
//		}
		// init id
		$id = intval($id);
		// delete item
		$this->load->model('mdl_ads');
		$this->mdl_ads->delete($id);
		
		// redirect back
//		header('Location: ' . $_SERVER['HTTP_REFERER']);
		header('Location: '.site_url('ads'));
	}

	
}
