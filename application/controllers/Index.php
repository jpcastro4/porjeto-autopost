<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct(){
        parent::__construct();   

        $this->load->model('instagram_model','IG');
    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{	
		$this->IG->getUser();
		
	}

	public function location(){

		//$this->IG->timeline();

		$this->IG->location();
	}

	public function searchLocation($cidade){
		$this->IG->searchLocation($cidade);
	}

	public function feedLocation($locationID){

		$this->IG->feedLocation($locationID);
	}

	public function explorer(){

		$this->IG->explorer();
	}


}
