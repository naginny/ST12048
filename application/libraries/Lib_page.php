<?php

class Lib_page
{	
	protected $ci = NULL;
	protected $headerVars = array();
	protected $bodyVars = array();
	protected $footerVars = array();
	
	public function __construct() 
	{
		$this->ci = &get_instance();
		$this->ci->load->helper('form');
	}
	
	public function header(array $vars = array())
	{
		$this->headerVars = $vars;
		$this->headerVars['user'] = $this->ci->mdl_user->getCurrentRecord() ?: array();
		$this->ci->load->view('header', $this->headerVars);
		return $this;
	}
	
	public function body($template, array $vars = array())
	{
		$this->bodyVars = $vars;
		$this->ci->load->view($template, $this->bodyVars);
		return $this;
	}
	
	public function footer(array $vars = array())
	{
		$this->footerVars = $vars;
		$this->ci->load->view('footer', $this->footerVars);
		return $this;
	}
}