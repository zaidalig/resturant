<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservation extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->model('super_model');
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/welcome
	 *	- or -
	 * 		http://example.com/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	  function arrayToObject($array){
            if(!is_array($array)) { return $array; }
            $object = new stdClass();
            if (is_array($array) && count($array) > 0) {
                foreach ($array as $name=>$value) {
                    $name = strtolower(trim($name));
                    if (!empty($name)) { $object->$name = arrayToObject($value); }
                }
                return $object;
            } 
            else {
                return false;
            }
        }

	}
	public function calendar_data(){
    	$events = array();
        foreach($this->super_model->select_custom_where("reservation","done='0'") AS $eve){
            $end_date = date("Y-m-d",strtotime($eve->end_date. ' +1 day'));
            $room_name = $this->super_model->select_column_where("rooms","room_no","room_id",$eve->room_id);
            $e = array();
            $e['title'] = $room_name;
            $e['start'] = $eve->start_date;
            $e['end'] = $end_date;    
            $e['color'] = '#ce371485';   
            $e['description'] = $room_name." is already reserved / occupied!";   
            array_push($events, $e);
        }

    	foreach($this->super_model->select_custom_where("reservation","done='0'") AS $eve){
            $end_date = date("Y-m-d",strtotime($eve->end_date. ' +1 day'));
	    	$e = array();
	    	$e['title'] = $room_name;
	    	$e['start'] = $eve->start_date;
	    	$e['end'] = $end_date;      
            $e['rendering'] = 'background';   
            $e['backgroundColor'] = '#F00'; 
            $e['description'] = $room_name." is already reserved / occupied!";  
	     	array_push($events, $e);
	    }
	    echo json_encode($events);
    }

    public function add_reservations(){
        $room_no = trim($this->input->post('room_no')," ");
        $start = trim($this->input->post('start')," ");
        $end = trim($this->input->post('end')," ");
        $count= count($this->input->post('sel_menu'));
        $menuid='';
        for($x=0; $x<$count;$x++){
            if($this->input->post('sel_menu['.$x.']')!=''){
                $me = $this->input->post('sel_menu['.$x.']');
                $menuid .= $me.",";
            }
        }
        $data = array(
            'room_id'=>$room_no,
            'start_date'=>$start,
            'end_date'=>$end,
            'menu_id'=>$menuid,
        );

        if($this->super_model->insert_into("reservation", $data)){
            $data_res = array(
                'reserved'=>1,
            );
            $this->super_model->update_where('rooms', $data_res, 'room_id', $room_no);
            echo "<script>alert('Successfully Added!'); window.location ='".base_url()."reservation/dashboard'; </script>";
        }
    }

    public function done_reservation(){
        $room_id = $this->input->post('room_no');
        $data = array(
            'reserved'=>0,
        );
        if($this->super_model->update_where('rooms', $data, 'room_id', $room_id)){
            $datadone = array(
                'done'=>1,
            );
            $this->super_model->update_where('reservation', $datadone, 'room_id', $room_id);
            echo "<script>alert('Successfully Tag as Done!'); 
                window.location ='".base_url()."reservation/dashboard'; </script>";
        }
    }

    public function reservation_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        foreach($this->super_model->select_custom_where("reservation","done='0' ORDER BY start_date DESC") AS $res){
            $room_no = $this->super_model->select_column_where("rooms","room_no","room_id",$res->room_id);
            $data['reserve'][]=array(
                'reservation_id'=>$res->reservation_id,
                'room_no'=>$room_no,
                'menu'=>$res->menu_id,
                'start_date'=>$res->start_date,
                'end_date'=>$res->end_date,
            );
        }
        $this->load->view('reservation/reservation_list',$data);
        $this->load->view('template/footer');
    }

    public function get_menu($menu_id){
        $menu = $this->super_model->select_column_where("menu", "menu_name", "menu_id", $menu_id);
        return $menu;
    }
}