<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __Construct(){
		  	parent::__Construct();
		  	
		  	if($this->session->userdata('user')==NULL){
				redirect('/');
			}
	}
	public function index()
	{
		/*$this->load->view('top_section');
		$this->load->view('header');
		$this->load->view('sidebar');
		$this->load->view('welcome_message');
		$this->load->view('footer');
		$this->load->view('bottom_section');*/
		$data['title']="Welcome Page";
		//$this->template->load("","","welcome_message",$data);
		$this->load->view('welcome_message');
	}
	/*public function viewall($auth=''){
		if($auth!='superadmin'){ redirect('welcome/');}
		$this->load->model('All_model');
		$data['title']="All Data";
		$data['datatable']=true;
		$tables=$this->All_model->gettables();
		$option['']="Select Table";
		if(is_array($tables)){
			foreach($tables as $table){
				$key = key($table);
				$option[$table[$key]]=$table[$key];
			}
		}
		$data['tables']=$option;
		$this->template->load('','','alldata',$data);
	}
	
	public function gettable(){
		$this->load->model('All_model');
		$table=$this->input->post('table');
		if($table!=''){
			$data['columns']=$this->All_model->getcolumns($table);
			$data['data']=$this->All_model->getdata($table);
		}
		else{
			$data['columns'][]=array("Field"=>"Columns in Table");
			$data['data']=array();
		}
		$this->load->view("datatable",$data);
	}
	
	public function updatedata(){
		$this->load->model('All_model');
		if($this->input->post('table')!==NULL){
			echo json_encode($_POST);
			$table=$this->input->post('table');
			$id=$this->input->post('id');
			$where['id']=$id;
			unset($_POST['table']);
			unset($_POST['id']);
			$this->All_model->updatedata($table,$_POST,$where);
		}
	}*/
}
