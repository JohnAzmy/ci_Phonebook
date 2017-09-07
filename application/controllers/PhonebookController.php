<?php

class PhonebookController extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Phonebook_model');
        
        // Load form helper library
        $this->load->helper('form');

        // Load form validation library
        $this->load->library('form_validation');

        // Load session library
        $this->load->library('session');
            
    }
    
    public function index()
    {
        $data['news'] = $this->Phonebook_model->get_entries();
        $data['title'] = 'News archive';
        $data['menuNum'] = 3;
                
        $this->load->view('templates/header', $data);
        $this->load->view('books/index', $data);
        $this->load->view('templates/footer');
    }
 
    public function view($slug = NULL)
    {
        $data['news_item'] = $this->Phonebook_model->get_news($slug);
        
        if (empty($data['news_item']))
        {
            show_404();
        }
 
        $data['title'] = $data['news_item']['title'];
 
        $this->load->view('templates/header', $data);
        $this->load->view('news/view', $data);
        $this->load->view('templates/footer');
    }
    
    
    public function create() {
        $data['title'] = 'Create an item';
        $data['menuNum'] = 3;
 
        $this->form_validation->set_rules('name', 'name', 'required');
        $this->form_validation->set_rules('number', 'number', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('books/create');
            $this->load->view('templates/footer');
        
        }else{
            $this->Phonebook_model->set_item();
            $this->load->view('templates/header', $data);
            $this->load->view('books/create');
            $this->load->view('templates/footer');
        }
    }
    
    public function edit() {
        $id = $this->uri->segment(3);
        
        if (empty($id))
        {
            show_404();
        }
        
        $data['title'] = 'Edit an item';
        $data['menuNum'] = 3;
        $data['news_item'] = $this->Phonebook_model->get_item_by_id($id);
        
        $this->form_validation->set_rules('name', 'number', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('books/edit', $data);
            $this->load->view('templates/footer');
        }else{
            if ($this->input->post('submit')) {
                $this->Phonebook_model->set_item($id);
                
                redirect( base_url() . 'index.php/books/edit/'.$id);
            }
        }
        
    }
    
    public function editAjax(){
        $id = $this->input->post('id');
        $number = $this->input->post('number');
        $this->Phonebook_model->set_number($id, $number);
        echo $id.','.$number;
    }
    
    public function search_photos_ajax()
    {
        $txtSearch = $this->input->get('q');
                        
        $this->load->model("pictures_model");
        $clsSearch = new pictures_model();
        $clsSearch->getSearch($txtSearch,50);
        $rsSearch = $clsSearch->arr_results;
        
        if(strlen($txtSearch)>2){
        if($rsSearch){
            foreach($rsSearch as $row){
                $arrSearch[] = $row;
            }
        }
        }
        
        $arrSearch[] = array("id"=>'0', "name"=>$txtSearch, "tagtitle"=>'search for '.$txtSearch,"newstype"=>'0');   //first item in the results autocomplete array
        
        echo json_encode($arrSearch);
    }
    
    public function delete()
    {
        $id = $this->uri->segment(3);
        
        if (empty($id))
        {
            show_404();
        }
                
        $news_item = $this->Phonebook_model->get_item_by_id($id);
        
        $this->Phonebook_model->delete_item($id);        
        redirect( base_url() . 'index.php/books');       
    }

}