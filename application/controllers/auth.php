<?php

/*
 *	author Stella Tīda
 *  auth.php
 *	class Auth extends CI_Controller
 * 
 *	functions:
 *	public function login();
 *	public function logout();
 *	public function register();
 *	
 */

class Auth extends CI_Controller
{
	
	public function login()
	{
		if ($this->mdl_user->getCurrentRecord())
		{
			header('Refresh: 0; Url='.site_url());
			return;
		}
		
		$messages = array();
		
		if (!empty($_POST['submit']))
		{
			$data['email'] = array_key_exists('email', $_POST) ? $_POST['email'] : NULL;
			$data['password'] = array_key_exists('password', $_POST) ? $_POST['password'] : NULL;
			
			if (empty($data['email']) || !valid_email($data['email']))
			{
				$messages[] = 'Nepareizs e-pasts';				
			}
			
			if (empty($data['password']))
			{
				$messages[] = 'Nav ievadīta parole';
			}
			
			// performing logging attempt
			if (empty($messages))
			{
				$result = $this->mdl_user->login($data['email'], $data['password']);
				
				if ($result)
				{
					// success
					header('Refresh: 0; Url=' . site_url());
					return;
				}
				else
				{
					$messages[] = 'Nepareizs e-pasts vai parole';
				}
			}
		}
		
		// error messages showing
		$this->lib_page->header(array('title' => 'Harmonija: Autorizācija'))->body('login', array(
				'messages' => $messages
		))->footer();
	}
	
	public function logout()
	{
		$this->mdl_user->logout();
		header('Location: ' . base_url());
	}
	
	public function register()
	{
		$messages = array();
		if (!empty($_POST['submit']))
		{
			$data = array();
			$data['email'] = array_key_exists('email', $_POST) ? $_POST['email'] : NULL;
			$data['password'] = array_key_exists('password', $_POST) ? $_POST['password'] : NULL;
			$data['password_repeat'] = array_key_exists('password_repeat', $_POST) ? $_POST['password_repeat'] : NULL;
			
			if (empty($data['email']) || !valid_email($data['email']))
			{
				$messages[] = 'Ievadiet pareizo e-pastu';
			}
			elseif ($this->mdl_user->checkEmailExists($data['email']))
			{
				$messages[] = 'Šis e-pasts jau ir reģistrēts';
			}
			
			if (empty($data['password']) || empty($data['password_repeat']))
			{
				$messages[] = 'Jāatkārto parole';
			}
			elseif ($data['password'] != $data['password_repeat'])
			{
				$messages[] = 'Paroles nesakrīt';
			}
			elseif (strlen($data['password']) < 6 || strlen($data['password_repeat']) < 6)
			{
				$messages[] = 'Parole ir pārāk īsa. Tai jābūt vismaz 6 simboli';
			}
			
			if (empty($messages))
			{
				//success
				$this->mdl_user->create(array(
					'email' => $data['email'],
					'password' => $data['password'],
				));
				// user is automatically redirected to login form
				header('Refresh: 0; Url=' . site_url('auth/login'));
				exit;
			}
		}
		
		// error messages showing
		$this->lib_page->header(array('title' => 'Harmonija: Reģistrācija'))->body('register', array(
			'messages' => $messages
		))->footer();
	}
}

?>
