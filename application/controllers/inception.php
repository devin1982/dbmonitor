<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

class Inception extends Front_Controller  {
    function __construct(){
	    parent::__construct();
            $this->load->library('form_validation');
            $this->load->model("inception_model","inception");       
	}
    public function index(){
        parent::check_privilege();
        $data["datalist"]=$this->inception->get_all_form();
        $this->layout->view("inception/index",$data);
    }
    
    public function create() {
        parent::check_privilege();
        $data['error_code']='';
        if(isset($_POST['submit']) && $_POST['submit']=='add'){
                $this->form_validation->set_rules('line_id', 'Line_id', 'required');
                $this->form_validation->set_rules('form_sql', 'Form_sql', 'required');
                $this->form_validation->set_rules('form_description', 'Form_description', 'required');
            if ($this->form_validation->run() == FALSE){
		$data['error_code']='validation_error';
            }else{
               $form_info = array( 
                   $this->input->post('form_sql'),
                   $this->input->post('form_description'),
                   1,
                   $this->session->userdata['uid'],
                   $this->input->post('line_id')
                   );
                $this->inception->add_inception_form($form_info);
                redirect(site_url('inception/index')); 
            }
        }
        $data["datalist"]=$this->inception->get_service_line();
        $this->layout->view("inception/create",$data);
    }
    
    
    public function status($form_id='',$act=''){
        parent::check_privilege();
        switch ($act) {
            case 'approve_yes':
                $form_status_list=$this->inception->get_form_status($form_id);
                foreach ($form_status_list as $item) {
                    if (($item['form_status']==1) && ($item['leader_id']==$this->session->userdata['uid'])){
                        $this->inception->change_form_status($form_id,2);
                    }
                }
                //then goto inception exame the sql
               
                /*$form_status_list=$this->inception->get_form_status($form_id);
                foreach ($form_status_list as $item) {
                    if (($item['form_status']==2) {
                 *   //excute python script to do something in inception system
                 *   //insert the exame result to exame status table
                 *      if( $excute_status==1){ 
                            $this->inception->change_form_status($form_id,3);
                 *      } else {
                 *          $this->inception->change_form_status($form_id,12);  
                 *      }
                    }
                }*/
                break;
            case 'approve_no':
                $form_status_list=$this->inception->get_form_status($form_id);
                foreach ($form_status_list as $item) {
                    if (($item['form_status']==1) && ($item['leader_id']==$this->session->userdata['uid'])){
                        $this->inception->change_form_status($form_id,11);
                    }
                }
                break;

            case 'excute_yes':
                $form_status_list=$this->inception->get_form_status($form_id);
                foreach ($form_status_list as $item) {
                    if (($item['form_status']==3) && ($item['creater_id']==$this->session->userdata['uid'])){
                        //excute sql in inception for online
                        //if ($excute_status==1){
                        $this->inception->change_form_status($form_id,0);
                        //else {$this->inception->change_form_status($form_id,13);}
                    }
                }
                //do something in inception system 
                // if ( $result==1){$this->inception->change_form_status($form_id,0);}else{$this->inception->change_form_status($form_id,14);}
                break;
            case 'excute_no':
                $form_status_list=$this->inception->get_form_status($form_id);
                foreach ($form_status_list as $item) {
                    if (($item['form_status']==3) && ($item['creater_id']==$this->session->userdata['uid'])){
                        $this->inception->change_form_status($form_id,13);
                    }
                }
                break;
            default:             
                break;
        }
        
        
        $data["datalist"]=$this->inception->get_form_info($form_id);
        $this->layout->view("inception/status",$data);
    }
}
/* End of file inception.php */
/* Location: ./application/controllers/inception.php */

