<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masterfile extends CI_Controller {

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

    public function index(){
        $this->load->view('masterfile/login');
    }

    public function login(){
        $username=$this->input->post('username');
        $password=$this->input->post('password');
        $count=$this->super_model->login_user($username,$password);
        if($count>0){   
            $password1 =md5($this->input->post('password'));
            $fetch=$this->super_model->select_custom_where("users", "username = '$username' AND (password = '$password' OR password = '$password1')");
            foreach($fetch AS $d){
                $userid = $d->user_id;
                $username = $d->username;
                $fullname = $d->fullname;
                $usertype = $d->usertype;
            }
            $newdata = array(
               'user_id'=> $userid,
               'username'=> $username,
               'fullname'=> $fullname,
               'usertype'=> $usertype,
               'logged_in'=> TRUE,
            );
            $this->session->set_userdata($newdata);
            redirect(base_url().'masterfile/dashboard/');
        }
        else{
            //$this->session->set_flashdata('error_msg', 'Username And Password Do not Exist!');
            echo "<script>alert('Username And Password Do not Exist!');</script>";
            $this->load->view('masterfile/login');
        }
    }

    public function get_huts($hut_id){
        $table = $this->super_model->select_column_custom_where("huts", "hut_name", "hut_id='$hut_id' AND reserved = '1'");
        return $table;
    }

    public function dashboard(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $data['year']=$this->uri->segment(3);
        $data['hut']=$this->super_model->select_custom_where("huts","reserved='0' ORDER BY hut_name ASC");
        $data['menu_list']=$this->super_model->select_all_order_by("menu","menu_name","ASC");
        $data['emp_count'] = $this->super_model->count_rows("employees");
        $ym=date("Y-m");
        $total_attendance=$this->super_model->count_rows("biometrics_attendance");
        $early=$this->super_model->count_rows_where("biometrics_attendance","status","1");
        if($early!=0 && $total_attendance!=0){
            $data['percentage']=($early/$total_attendance)*100;
        }else{
            $data['percentage']=0;
        }
        $data['on_time']=$this->super_model->count_custom_where("biometrics_attendance","date LIKE '%$ym%' AND status='1'");
        $data['late']=$this->super_model->count_custom_where("biometrics_attendance","date LIKE '%$ym%' AND status='0'");
        foreach($this->super_model->select_custom_where("reservation","trans_done = '0' ORDER BY start_date ASC") AS $res){
            $hut_name='';
            $table_no='';
            $menu='';
            foreach($this->super_model->select_custom_where("reservation_details","done='0' AND reservation_id = '$res->reservation_id'") AS $rs){
                if($rs->hut_id!=0){
                    $hut_name .= "- ".$this->super_model->select_column_where("huts","hut_name","hut_id",$rs->hut_id)."<br> ";
                }

                if($rs->table_id!=0){
                    $table_no .= "- ".$this->super_model->select_column_where("tables","table_no","table_id",$rs->table_id)."<br> ";
                }
            }
            foreach($this->super_model->select_custom_where("reservation_details","done='1' AND reservation_id = '$res->reservation_id'") AS $rt){
                if($rt->menu_id!=0){
                    $menu .= "- ".$this->super_model->select_column_where("menu","menu_name","menu_id",$rt->menu_id)."<br> ";
                }
            }
            //$hut_name = $this->super_model->select_column_where("huts","hut_name","hut_id",$res->hut_id);
            $fname = $this->super_model->select_column_where("registration","fname","register_id",$res->register_id);
            $lname = $this->super_model->select_column_where("registration","lname","register_id",$res->register_id);
            $mname = $this->super_model->select_column_where("registration","mname","register_id",$res->register_id);
            $fullname = $fname." ".$mname." ".$lname;
            $data['reserve'][]=array(
                'reservation_id'=>$res->reservation_id,
                'hut_name'=>$hut_name,
                'fullname'=>$fullname,
                'menu'=>$menu,
                'table_no'=>$table_no,
                'start_date'=>$res->start_date,
                'end_date'=>$res->end_date,
            );
        }

        foreach($this->super_model->select_custom_where("reservation","trans_done = '0' ORDER BY start_date ASC") AS $rd){
            $hut_name='';
            foreach($this->super_model->select_custom_where("reservation_details","done='0' AND reservation_id = '$rd->reservation_id'") AS $rr){ 
                $hut_name = $this->super_model->select_column_where("huts","hut_name","hut_id",$rr->hut_id);
                $data['hut_done'][]=array(
                    'reservation_id'=>$rr->reservation_id,
                    'res_det_id'=>$rr->res_det_id,
                    'hut_id'=>$rr->hut_id,
                    'hut_name'=>$hut_name,
                );
            }
            
        }

        foreach($this->super_model->select_custom_where("reservation","trans_done = '0' ORDER BY start_date ASC") AS $td){
            foreach($this->super_model->select_custom_where("reservation_details","done='0' AND reservation_id = '$td->reservation_id'") AS $rt){ 
                $table_no = $this->super_model->select_column_where("tables","table_no","table_id",$rt->table_id);
                $data['table_done'][]=array(
                    'reservation_id'=>$rt->reservation_id,
                    'res_det_id'=>$rt->res_det_id,
                    'table_id'=>$rt->table_id,
                    'table_no'=>$table_no,
                );
            }
        }
        $this->load->view('masterfile/dashboard',$data);
        $this->load->view('template/footer');
    }

    public function fetch_deliveries(){
        $alert= $this->super_model->count_rows_where("delivery_head","delivered","0")." Order/s for Delivery.";
        $count= $this->super_model->count_rows_where("delivery_head","delivered","0");
        $return = array('alert' => $alert,'count' => $count);
        echo json_encode($return);  
    }

    public function get_table($table_id){
        $table = $this->super_model->select_column_custom_where("tables", "table_no", "table_id='$table_id' AND reserved = '1'");
        return $table;
    }

    public function getYear(){
        $year = $this->input->post('year');
        $and = 'AND YEAR(date) = '.$year;
        $return = array();
        for($m = 1; $m <= 12; $m++) {
            $ontime = $this->super_model->count_custom("SELECT * FROM biometrics_attendance WHERE MONTH(date) = '$m' AND status = '1' AND YEAR(date)='$year'");  
            $late = $this->super_model->count_custom("SELECT * FROM biometrics_attendance WHERE MONTH(date) = '$m' AND status = '0' AND YEAR(date)='$year'");
            $month =  date('M', mktime(0, 0, 0, $m, 1));
            $return = array(
                'ontime' => $ontime,
                'late' => $late,
                'month' => $month,
                'year' => $year,
            );
            //$return = array('ontime' => $ontime,'late' => $late,'month' => $month,'year'=> $year); 
        }
        echo json_encode($return);  
    }

    public function calendar_data(){
        $events = array();
        foreach($this->super_model->select_custom_where("reservation","trans_done='0' ORDER BY start_date ASC") AS $eve){
            $name='';
            foreach($this->super_model->select_custom_where("reservation_details","done='0' AND reservation_id = '$eve->reservation_id'") AS $rr){
                if($rr->hut_id!=0){
                    $name .= $this->super_model->select_column_where("huts","hut_name","hut_id",$rr->hut_id).", ";
                }else{
                    $name .= $this->super_model->select_column_where("tables","table_no","table_id",$rr->table_id).", ";
                } 
            }
            $end_date = date("Y-m-d",strtotime($eve->end_date. ' +1 day'));
            $e = array();
            $e['title'] = $name;
            $e['start'] = $eve->start_date;
            $e['end'] = $end_date;    
            $e['color'] = '#ce371485';   
            $e['description'] = $name." is already reserved / occupied!";   
            array_push($events, $e);   
        }

        foreach($this->super_model->select_custom_where("reservation","trans_done = '0' ORDER BY start_date ASC") AS $eve){
            $name='';
            foreach($this->super_model->select_custom_where("reservation_details","done='0' AND reservation_id = '$eve->reservation_id'") AS $rr){
                if($rr->hut_id!=0){
                    $name .= $this->super_model->select_column_where("huts","hut_name","hut_id",$rr->hut_id).", ";
                }else{
                    $name .= $this->super_model->select_column_where("tables","table_no","table_id",$rr->table_id).", ";
                }
            }
            $end_date = date("Y-m-d",strtotime($eve->end_date. ' +1 day'));
            $e = array();
            $e['title'] = $name;
            $e['start'] = $eve->start_date;
            $e['end'] = $end_date;      
            $e['rendering'] = 'background';   
            $e['backgroundColor'] = '#F00'; 
            $e['description'] = $name." is already reserved / occupied!";  
            array_push($events, $e); 
            
        }
        echo json_encode($events);
    }

    public function add_reservations(){
        $hut_name = trim($this->input->post('hut_name')," ");
        $start = trim($this->input->post('start')," ");
        $end = trim($this->input->post('end')," ");
        $count= count($this->input->post('sel_menu'));
        $data = array(
            'hut_id'=>$hut_name,
            'start_date'=>$start,
            'end_date'=>$end,
        );

        if($this->super_model->insert_into("reservation", $data)){
            $data_res = array(
                'reserved'=>1,
            );
            $this->super_model->update_where('huts', $data_res, 'hut_id', $hut_name);
            echo "<script>alert('Successfully Reserved!'); window.location ='".base_url()."masterfile/dashboard'; </script>";
        }
    }

    public function done_reservation(){
        $hut_id = $this->input->post('hut_name');
        $table_id = $this->input->post('table_name');
        $data = array(
            'reserved'=>0,
        );
        if(!empty($hut_id)){
            $counth=count($hut_id);
            for($x=0;$x<$counth;$x++){
                $h_id = $hut_id[$x];
                $new_hutid = explode(",", $h_id);
                $hut_ids = $new_hutid[0];
                $res_det_id1 = $new_hutid[1];
                $reservation_id1 = $new_hutid[2];
                if($this->super_model->update_where('huts', $data, 'hut_id', $hut_ids)){
                    $datadone = array(
                        'done'=>1,
                    );
                    $this->super_model->update_where('reservation_details', $datadone, 'res_det_id', $res_det_id1);

                    $count_hut = $this->super_model->count_custom_where("reservation_details","reservation_id = '$reservation_id1' AND done='0'");
                    if($count_hut==0){
                        $data_trans=array(
                            'trans_done'=>1,
                        );
                        $this->super_model->update_where('reservation', $data_trans, 'reservation_id', $reservation_id1);
                    }
                    echo "<script>alert('Successfully Tag as Done!'); window.location ='".base_url()."masterfile/dashboard'; </script>";
                }
            }
        }

        if(!empty($table_id)){
            $countt=count($table_id);
            for($y=0;$y<$countt;$y++){
                $t_id = $table_id[$y];
                $new_tabid = explode(",", $t_id);
                $table_ids = $new_tabid[0];
                $res_det_id2 = $new_tabid[1];
                $reservation_id2 = $new_tabid[2];
                if($this->super_model->update_where('tables', $data, 'table_id', $table_ids)){
                    $datadone = array(
                        'done'=>1,
                    );
                    $this->super_model->update_where('reservation_details', $datadone, 'res_det_id', $res_det_id2);
                    $count_table = $this->super_model->count_custom_where("reservation_details","reservation_id = '$reservation_id2' AND done='0'");
                    if($count_table==0){
                        $data_trans1=array(
                            'trans_done'=>1,
                        );
                        $this->super_model->update_where('reservation', $data_trans1, 'reservation_id', $reservation_id2);
                    }
                    echo "<script>alert('Successfully Tag as Done!'); window.location ='".base_url()."masterfile/dashboard'; </script>";
                }
            }
        }
    }

    public function get_menu($menu_id){
        $menu = $this->super_model->select_column_where("menu", "menu_name", "menu_id", $menu_id);
        return $menu;
    }

    public function user_logout(){
        $this->session->sess_destroy();
        echo "<script>alert('You have successfully logged out.'); 
        window.location ='".base_url()."masterfile/index'; </script>";
    }

    public function hut_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $data['huts']=$this->super_model->select_all_order_by("huts","hut_name","ASC");
        $this->load->view('masterfile/hut_list',$data);
        $this->load->view('template/footer');
    }

    public function insert_hut(){
        $hut_name = trim($this->input->post('hut_name')," ");
        $hut_img = trim($this->input->post('hut_img')," ");
        $error_ext=0;
        $dest= realpath(APPPATH . '../uploads/');
        if(!empty($_FILES['hut_img']['name'])){
             $hut_img= basename($_FILES['hut_img']['name']);
             $hut_img=explode('.',$hut_img);
             $ext1=$hut_img[1];
            
            if($ext1=='php' || ($ext1!='png' && $ext1 != 'jpg' && $ext1!='jpeg')){
                $error_ext++;
            } else {
                 $filename=$hut_name.'.'.$ext1;
                 move_uploaded_file($_FILES["hut_img"]['tmp_name'], $dest.'/'.$filename);
            }

        } else {
            $filename="";
        }
        $data = array(
            'hut_name'=>$hut_name,
            'hut_image'=>$filename,
        );
        if($this->super_model->insert_into("huts", $data)){
           echo "<script>alert('Successfully Added!'); 
                window.location ='".base_url()."masterfile/hut_list'; </script>";
        }
    }

    public function update_hut(){
        $hut_name = trim($this->input->post('hut_name')," ");
        $error_ext=0;
        $dest= realpath(APPPATH . '../uploads/');
        if(!empty($_FILES['hut_img']['name'])){
             $hut_img= basename($_FILES['hut_img']['name']);
             $hut_img=explode('.',$hut_img);
             $ext1=$hut_img[1];
            
            if($ext1=='php' || ($ext1!='png' && $ext1 != 'jpg' && $ext1!='jpeg')){
                $error_ext++;
            } else {
                 $filename=$hut_name.'.'.$ext1;
                 move_uploaded_file($_FILES["hut_img"]['tmp_name'], $dest.'/'.$filename);
            }

        } else {
            $filename="";
        }

        $data = array(
            'hut_name'=>$hut_name,
        );
        $hut_id = $this->input->post('hut_id');
        if($this->super_model->update_where('huts', $data, 'hut_id', $hut_id)){
            echo "<script>alert('Successfully Updated!'); 
                window.location ='".base_url()."masterfile/hut_list'; </script>";
        }
    }

    public function update_hutimg(){
        $error_ext=0;
        $dest= realpath(APPPATH . '../uploads/');
        if(!empty($_FILES['image']['name'])){
             $image= basename($_FILES['image']['name']);
             $image=explode('.',$image);
             $name=$image[0];
             $ext1=$image[1];
            
            if($ext1=='php' || ($ext1!='png' && $ext1 != 'jpg' && $ext1!='jpeg')){
                $error_ext++;
            } else {
                 $filename=$name.'.'.$ext1;
                 move_uploaded_file($_FILES["image"]['tmp_name'], $dest.'/'.$filename);
            }

        } else {
            $filename="";
        }

        $data = array(
            'hut_image'=>$filename,
        );
        $hut_id = $this->input->post('hut_imgid');
        if($this->super_model->update_where('huts', $data, 'hut_id', $hut_id)){
            echo "<script>alert('Successfully Updated!'); 
                window.location ='".base_url()."masterfile/hut_list'; </script>";
        }
    }

    public function delete_hut(){
        $id=$this->uri->segment(3);
        $row = $this->super_model->count_rows_where("reservation_details","hut_id",$id);
        if($row!=0){
           echo "<script>alert('You cannot delete this record!');window.location = '".base_url()."masterfile/hut_list';</script>";
        }else{
            if($this->super_model->delete_where('huts', 'hut_id', $id)){
                echo "<script>alert('Succesfully Deleted');
                window.location = '".base_url()."masterfile/hut_list'; </script>";
            }
        }
    }

    public function food_menu(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $row=$this->super_model->count_rows('menu');
        $data['menu_category']=$this->super_model->select_all_order_by("menu_category","menu_category","ASC");
        if($row!=0){
            foreach($this->super_model->select_all_order_by("menu","menu_name","ASC") AS $m){
                $menu_category=$this->super_model->select_column_where("menu_category","menu_category","menucat_id",$m->menucat_id);
                $data['menu'][]=array(
                    "menu_id"=>$m->menu_id,
                    "menucat_id"=>$m->menucat_id,
                    "menu_category"=>$menu_category,
                    "menu_name"=>$m->menu_name,
                    "menu_price"=>$m->menu_price,
                    "menu_desc"=>$m->menu_desc,
                    "menu_img"=>$m->menu_img,
                );
            }
        }else{
            $data['menu']=array();
        }
        $this->load->view('masterfile/food_menu',$data);
        $this->load->view('template/footer');
    }

    public function insert_menu(){
        $menu_category = trim($this->input->post('menu_category')," ");
        $menu_name = trim($this->input->post('menu_name')," ");
        if($this->input->post('menu_price')!=''){
            $menu_price = trim($this->input->post('menu_price')," ");
        }else{
            $menu_price = "0.00";
        }
        $menu_desc = trim($this->input->post('menu_desc')," ");
        $menu_img = $this->input->post('menu_img');

        $rows_head = $this->super_model->count_rows("menu");
        if($rows_head==0){
            $menu_id=1;
        } else {
            $max = $this->super_model->get_max("menu", "menu_id");
            $menu_id = $max+1;
        }
        $error_ext=0;
        $dest= realpath(APPPATH . '../uploads/');
        if(!empty($_FILES['menu_img']['name'])){
             $menu_img= basename($_FILES['menu_img']['name']);
             $menu_img=explode('.',$menu_img);
             $ext1=$menu_img[1];
            
            if($ext1=='php' || ($ext1!='png' && $ext1 != 'jpg' && $ext1!='jpeg')){
                $error_ext++;
            } else {
                 $filename=$menu_name.'-'.$menu_id.'.'.$ext1;
                 move_uploaded_file($_FILES["menu_img"]['tmp_name'], $dest.'/'.$filename);
            }

        } else {
            $filename="";
        }

        $data = array(
            'menucat_id'=>$menu_category,
            'menu_name'=>$menu_name,
            'menu_price'=>$menu_price,
            'menu_desc'=>$menu_desc,
            'menu_img'=>$filename,
        );
        if($this->super_model->insert_into("menu", $data)){
           echo "<script>alert('Successfully Added!'); 
           window.location ='".base_url()."masterfile/food_menu'; </script>";
        }
    }

    public function update_menu(){
        $menu_category = trim($this->input->post('menu_category')," ");
        $menu_name = trim($this->input->post('menu_name')," ");
        $menu_price = trim($this->input->post('menu_price')," ");
        $menu_desc = trim($this->input->post('menu_desc')," ");
        $menu_img = $this->input->post('menu_img');
        $menu_id = $this->input->post('menu_id');
        $error_ext=0;
        $dest= realpath(APPPATH . '../uploads/');
        if(!empty($_FILES['menu_img']['name'])){
             $menu_img= basename($_FILES['menu_img']['name']);
             $menu_img=explode('.',$menu_img);
             $ext1=$menu_img[1];
            
            if($ext1=='php' || ($ext1!='png' && $ext1 != 'jpg' && $ext1!='jpeg')){
                $error_ext++;
            } else {
                 $filename=$menu_name.'-'.$menu_id.'.'.$ext1;
                 move_uploaded_file($_FILES["menu_img"]['tmp_name'], $dest.'/'.$filename);
            }

        } else {
            $filename="";
        }
        
        $data = array(
            'menucat_id'=>$menu_category,
            'menu_name'=>$menu_name,
            'menu_price'=>$menu_price,
            'menu_desc'=>$menu_desc,
        );
        if($this->super_model->update_where('menu', $data, 'menu_id', $menu_id)){
            echo "<script>alert('Successfully Updated!'); 
            window.location ='".base_url()."masterfile/food_menu'; </script>";
        }
    }

    public function update_menuimg(){
        $error_ext=0;
        $dest= realpath(APPPATH . '../uploads/');
        if(!empty($_FILES['image']['name'])){
             $image= basename($_FILES['image']['name']);
             $image=explode('.',$image);
             $name=$image[0];
             $ext1=$image[1];
            
            if($ext1=='php' || ($ext1!='png' && $ext1 != 'jpg' && $ext1!='jpeg')){
                $error_ext++;
            } else {
                 $filename=$name.'.'.$ext1;
                 move_uploaded_file($_FILES["image"]['tmp_name'], $dest.'/'.$filename);
            }

        } else {
            $filename="";
        }

        $data = array(
            'menu_img'=>$filename,
        );
        $menu_id = $this->input->post('menu_idimg');
        if($this->super_model->update_where('menu', $data, 'menu_id', $menu_id)){
            echo "<script>alert('Successfully Updated!'); 
                window.location ='".base_url()."masterfile/food_menu'; </script>";
        }
    }

    public function delete_menu(){
        $id=$this->uri->segment(3);
        $row = $this->super_model->count_rows_where("reservation_details","menu_id",$id);
        if($row!=0){
           echo "<script>alert('You cannot delete this record!');window.location = '".base_url()."masterfile/food_menu';</script>";
        }else{
            if($this->super_model->delete_where('menu', 'menu_id', $id)){
                echo "<script>alert('Succesfully Deleted');
                window.location = '".base_url()."masterfile/food_menu'; </script>";
            }
        }
    }

    public function table_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $data['tables']=$this->super_model->select_all_order_by("tables","table_no","ASC");
        $this->load->view('masterfile/table_list',$data);
        $this->load->view('template/footer');
    }

    public function insert_table(){
        $table_no = trim($this->input->post('table_no')," ");
        $table_img = trim($this->input->post('table_img')," ");
        $error_ext=0;
        $dest= realpath(APPPATH . '../uploads/');
        if(!empty($_FILES['table_img']['name'])){
             $table_img= basename($_FILES['table_img']['name']);
             $table_img=explode('.',$table_img);
             $ext1=$table_img[1];
            
            if($ext1=='php' || ($ext1!='png' && $ext1 != 'jpg' && $ext1!='jpeg')){
                $error_ext++;
            } else {
                 $filename=$table_no.'.'.$ext1;
                 move_uploaded_file($_FILES["table_img"]['tmp_name'], $dest.'/'.$filename);
            }

        } else {
            $filename="";
        }
        $data = array(
            'table_no'=>$table_no,
            'table_img'=>$filename,
        );
        if($this->super_model->insert_into("tables", $data)){
           echo "<script>alert('Successfully Added!'); 
                window.location ='".base_url()."masterfile/table_list'; </script>";
        }
    }

    public function update_table(){
        $table_no = trim($this->input->post('table_no')," ");
        $error_ext=0;
        $dest= realpath(APPPATH . '../uploads/');
        if(!empty($_FILES['table_img']['name'])){
             $table_img= basename($_FILES['table_img']['name']);
             $table_img=explode('.',$table_img);
             $ext1=$table_img[1];
            
            if($ext1=='php' || ($ext1!='png' && $ext1 != 'jpg' && $ext1!='jpeg')){
                $error_ext++;
            } else {
                 $filename=$table_no.'.'.$ext1;
                 move_uploaded_file($_FILES["table_img"]['tmp_name'], $dest.'/'.$filename);
            }

        } else {
            $filename="";
        }

        $data = array(
            'table_no'=>$table_no,
        );
        $table_id = $this->input->post('table_id');
        if($this->super_model->update_where('tables', $data, 'table_id', $table_id)){
            echo "<script>alert('Successfully Updated!'); 
                window.location ='".base_url()."masterfile/table_list'; </script>";
        }
    }

    public function update_tableimg(){
        $error_ext=0;
        $dest= realpath(APPPATH . '../uploads/');
        if(!empty($_FILES['image']['name'])){
             $image= basename($_FILES['image']['name']);
             $image=explode('.',$image);
             $name=$image[0];
             $ext1=$image[1];
            
            if($ext1=='php' || ($ext1!='png' && $ext1 != 'jpg' && $ext1!='jpeg')){
                $error_ext++;
            } else {
                 $filename=$name.'.'.$ext1;
                 move_uploaded_file($_FILES["image"]['tmp_name'], $dest.'/'.$filename);
            }

        } else {
            $filename="";
        }

        $data = array(
            'table_img'=>$filename,
        );
        $table_id = $this->input->post('table_imgid');
        if($this->super_model->update_where('tables', $data, 'table_id', $table_id)){
            echo "<script>alert('Successfully Updated!'); 
                window.location ='".base_url()."masterfile/table_list'; </script>";
        }
    }

    public function delete_table(){
        $id=$this->uri->segment(3);
        $row = $this->super_model->count_rows_where("reservation_details","table_id",$id);
        if($row!=0){
           echo "<script>alert('You cannot delete this record!');window.location = '".base_url()."masterfile/table_list';</script>";
        }else{
            if($this->super_model->delete_where('tables', 'table_id', $id)){
                echo "<script>alert('Succesfully Deleted');
                window.location = '".base_url()."masterfile/table_list'; </script>";
            }
        }
    }

    public function position_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $data['position']=$this->super_model->select_all_order_by("position","position_name","ASC");
        $this->load->view('masterfile/position_list',$data);
        $this->load->view('template/footer');
    }

    public function insert_position(){
        $position_name = trim($this->input->post('position_name')," ");
        $rate = trim($this->input->post('rate')," ");
        $data = array(
            'position_name'=>$position_name,
            'rate'=>$rate,
        );
        if($this->super_model->insert_into("position", $data)){
           echo "<script>alert('Successfully Added!'); 
                window.location ='".base_url()."masterfile/position_list'; </script>";
        }
    }

    public function update_position(){
        $position_name = trim($this->input->post('position_name')," ");
        $rate = trim($this->input->post('rate')," ");
        $data = array(
            'position_name'=>$position_name,
            'rate'=>$rate,
        );
        $position_id = $this->input->post('position_id');
        if($this->super_model->update_where('position', $data, 'position_id', $position_id)){
            echo "<script>alert('Successfully Updated!'); 
                window.location ='".base_url()."masterfile/position_list'; </script>";
        }
    }

    public function delete_position(){
        $id=$this->uri->segment(3);
        $row = $this->super_model->count_rows_where("employees","position_id",$id);
        if($row!=0){
           echo "<script>alert('You cannot delete this record!');window.location = '".base_url()."masterfile/position_list';</script>";
        }else{
            if($this->super_model->delete_where('position', 'position_id', $id)){
                echo "<script>alert('Succesfully Deleted');
                window.location = '".base_url()."masterfile/position_list'; </script>";
            }
        }
    }

    public function menu_category(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $data['menu_category']=$this->super_model->select_all_order_by("menu_category","menu_category","ASC");
        $data['menu_selection']=$this->super_model->select_all_order_by("menu_selection","menu_selection","ASC");
        $this->load->view('masterfile/menu_category',$data);
        $this->load->view('template/footer');
    }

    public function insert_category(){
        $menu_category = trim($this->input->post('menu_category')," ");
        $menu_selection = trim($this->input->post('menu_selection')," ");
        $data = array(
            'menu_category'=>$menu_category,
            'menusel_id'=>$menu_selection,
        );
        if($this->super_model->insert_into("menu_category", $data)){
           echo "<script>alert('Successfully Added!'); 
                window.location ='".base_url()."masterfile/menu_category'; </script>";
        }
    }

    public function update_category(){
        $menu_category = trim($this->input->post('menu_category')," ");
        $menu_selection = trim($this->input->post('menu_selection')," ");
        $data = array(
            'menu_category'=>$menu_category,
            'menusel_id'=>$menu_selection,
        );
        $menucat_id = $this->input->post('menucat_id');
        if($this->super_model->update_where('menu_category', $data, 'menucat_id', $menucat_id)){
            echo "<script>alert('Successfully Updated!'); 
                window.location ='".base_url()."masterfile/menu_category'; </script>";
        }
    }

    public function delete_category(){
        $id=$this->uri->segment(3);
        $row = $this->super_model->count_rows_where("menu","menucat_id",$id);
        if($row!=0){
           echo "<script>alert('You cannot delete this record!');window.location = '".base_url()."masterfile/menu_category';</script>";
        }else{
            if($this->super_model->delete_where('menu_category', 'menucat_id', $id)){
                echo "<script>alert('Succesfully Deleted');
                window.location = '".base_url()."masterfile/menu_category'; </script>";
            }
        }
    }

    public function menu_selection(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $data['menu_selection']=$this->super_model->select_all_order_by("menu_selection","menu_selection","ASC");
        $this->load->view('masterfile/menu_selection',$data);
        $this->load->view('template/footer');
    }

    public function insert_selection(){
        $menu_selection = trim($this->input->post('menu_selection')," ");
        $data = array(
            'menu_selection'=>$menu_selection,
        );
        if($this->super_model->insert_into("menu_selection", $data)){
           echo "<script>alert('Successfully Added!'); 
                window.location ='".base_url()."masterfile/menu_selection'; </script>";
        }
    }

    public function update_selection(){
        $menu_selection = trim($this->input->post('menu_selection')," ");
        $rate = trim($this->input->post('rate')," ");
        $data = array(
            'menu_selection'=>$menu_selection,
        );
        $menusel_id = $this->input->post('menusel_id');
        if($this->super_model->update_where('menu_selection', $data, 'menusel_id', $menusel_id)){
            echo "<script>alert('Successfully Updated!'); 
                window.location ='".base_url()."masterfile/menu_selection'; </script>";
        }
    }

    public function delete_selection(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('menu_selection', 'menusel_id', $id)){
            echo "<script>alert('Succesfully Deleted');
            window.location = '".base_url()."masterfile/menu_selection'; </script>";
        }
    }

    public function get_selection($menusel_id){
        $menu = $this->super_model->select_column_where("menu_selection", "menu_selection", "menusel_id", $menusel_id);
        return $menu;
    }

    public function generatePayroll(){
        if(!empty($this->input->post('from'))){
            $from = $this->input->post('from');
        } else {
            $from = "null";
        }

        if(!empty($this->input->post('to'))){
            $to = $this->input->post('to');
        } else {
            $to = "null";
        }

        ?>
       <script>
        window.location.href ='<?php echo base_url(); ?>masterfile/payroll_list/<?php echo $from; ?>/<?php echo $to; ?>'</script> <?php
    }

    public function payroll_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $to = date('Y-m-d');
        $from = date('Y-m-d', strtotime('-30 day', strtotime($to)));
        $data['from']=date('Y-m-d', strtotime('-30 day', strtotime($to)));
        $data['to']=date('Y-m-d');
        if(!empty($this->uri->segment(3)) && !empty($this->uri->segment(4))){
            $from=$this->uri->segment(3);
            $to=$this->uri->segment(4);
            $data['from']=$this->uri->segment(3);
            $data['to']=$this->uri->segment(4);
        }
        $data[]=array();
        foreach($this->super_model->custom_query("SELECT *, sum(num_hr) AS total_hr, ba.employee_id AS empid FROM biometrics_attendance ba INNER JOIN employees e ON e.employee_id=ba.employee_id INNER JOIN position p ON p.position_id=e.position_id WHERE ba.date BETWEEN '$from' AND '$to' GROUP BY ba.employee_id ORDER BY e.lastname ASC, e.firstname ASC") AS $cust){
            foreach($this->super_model->custom_query("SELECT *, SUM(amount) AS cashamount FROM cashadvance WHERE employee_id='$cust->empid' AND date_advance BETWEEN '$from' AND '$to'") AS $ca){
                $cashadvance = $ca->cashamount;
                $gross = $cust->rate * $cust->total_hr;
                $total_deduction = $cashadvance + $cust->sss_amount + $cust->pagibig_amount + $cust->philhealth_amount;
                $net = $gross - $total_deduction;
                $fullname = $cust->firstname." ".$cust->lastname;
                $data['payroll'][]=array(
                    "fullname"=>$fullname,
                    "employee_number"=>$cust->employee_number,
                    "gross"=>$gross,
                    "cashadvance"=>$cashadvance,
                    "pagibig_amount"=>$cust->pagibig_amount,
                    "sss_amount"=>$cust->sss_amount,
                    "philhealth_amount"=>$cust->philhealth_amount,
                    "total_deduction"=>$total_deduction,
                    "net"=>$net,
                );
            }
        }
        $this->load->view('masterfile/payroll_list',$data);
        $this->load->view('template/footer');
    }

    public function generateRow($from, $to, $total_deduction){
        $contents = '';
        $total = 0;
        foreach($this->super_model->custom_query("SELECT *, sum(num_hr) AS total_hr, ba.employee_id AS empid FROM biometrics_attendance ba INNER JOIN employees e ON e.employee_id=ba.employee_id INNER JOIN position p ON p.position_id=e.position_id WHERE date BETWEEN '$from' AND '$to' GROUP BY ba.employee_id ORDER BY e.lastname ASC, e.firstname ASC") AS $cust){
            foreach($this->super_model->custom_query("SELECT *, SUM(amount) AS cashamount FROM cashadvance WHERE employee_id='$cust->empid' AND date_advance BETWEEN '$from' AND '$to'") AS $ca){
                $cashadvance = $ca->cashamount;
                $gross = $cust->rate * $cust->total_hr;
                $total_deduction = $cashadvance + $cust->sss_amount + $cust->pagibig_amount + $cust->philhealth_amount;
                $net = $gross - $total_deduction;

                $total += $net;
                $contents .= '
                <tr>
                    <td>'.$cust->lastname.', '.$cust->firstname.'</td>
                    <td>'.$cust->employee_number.'</td>
                    <td align="right">'.number_format($net, 2).'</td>
                </tr>
                ';
            }
        }

        $contents .= '
            <tr>
                <td colspan="2" align="right"><b>Total</b></td>
                <td align="right"><b>'.number_format($total, 2).'</b></td>
            </tr>
        ';
        return $contents;
    }

    public function export_payroll(){
        require_once(APPPATH.'../assets/tcpdf/tcpdf.php');
        $from=$this->uri->segment(3);
        $to=$this->uri->segment(4);
        $content = ''; 
        $from_title = date('M d, Y', strtotime($from));
        $to_title = date('M d, Y', strtotime($to));
        $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
        $pdf->SetCreator(PDF_CREATOR);  
        $pdf->SetTitle('Payroll: '.$from_title.' - '.$to_title);  
        $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
        $pdf->SetDefaultMonospacedFont('helvetica');  
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
        $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
        $pdf->setPrintHeader(false);  
        $pdf->setPrintFooter(false);  
        $pdf->SetAutoPageBreak(TRUE, 10);  
        $pdf->SetFont('helvetica', '', 11);  
        $pdf->AddPage();
        foreach($this->super_model->custom_query("SELECT *, sum(num_hr) AS total_hr, ba.employee_id AS empid FROM biometrics_attendance ba INNER JOIN employees e ON e.employee_id=ba.employee_id INNER JOIN position p ON p.position_id=e.position_id WHERE date BETWEEN '$from' AND '$to' GROUP BY ba.employee_id ORDER BY e.lastname ASC, e.firstname ASC") AS $cust){
            foreach($this->super_model->custom_query("SELECT *, SUM(amount) AS cashamount FROM cashadvance WHERE employee_id='$cust->empid' AND date_advance BETWEEN '$from' AND '$to'") AS $ca){
                $cashadvance = $ca->cashamount;
                $total_deduction = $cashadvance + $cust->sss_amount + $cust->pagibig_amount + $cust->philhealth_amount; 
                $content .= '
                <h2 align="center">Cianos Seafood Grill and Bar</h2>
                <h4 align="center">'.$from_title." - ".$to_title.'</h4>
                <table border="1" cellspacing="0" cellpadding="3">  
                <tr>  
                    <th width="40%" align="center"><b>Employee Name</b></th>
                    <th width="30%" align="center"><b>Employee Number</b></th>
                    <th width="30%" align="center"><b>Net Pay</b></th> 
                </tr>';  
                $content .= $this->generateRow($from, $to, $total_deduction);  
                $content .= '</table>';  
                $pdf->writeHTML($content);  
                $pdf->Output('payroll.pdf', 'I');
            }
        }
        if(empty($content)){
            $pdf->writeHTML($content);  
            $pdf->Output('payroll.pdf', 'I');
        }
    }

    public function generateSlip($from, $to, $total_deduction){
        $contents = '';
        $total = 0;
        $from_title = date('M d, Y', strtotime($from));
        $to_title = date('M d, Y', strtotime($to));
        foreach($this->super_model->custom_query("SELECT *, sum(num_hr) AS total_hr, ba.employee_id AS empid FROM biometrics_attendance ba INNER JOIN employees e ON e.employee_id=ba.employee_id INNER JOIN position p ON p.position_id=e.position_id WHERE date BETWEEN '$from' AND '$to' GROUP BY ba.employee_id ORDER BY e.lastname ASC, e.firstname ASC") AS $cust){
            foreach($this->super_model->custom_query("SELECT *, SUM(amount) AS cashamount FROM cashadvance WHERE employee_id='$cust->empid' AND date_advance BETWEEN '$from' AND '$to'") AS $ca){
                foreach($this->super_model->custom_query("SELECT *, SUM(rate) AS overrate FROM overtime WHERE employee_id='$cust->empid' AND date_overtime BETWEEN '$from' AND '$to'") AS $ov){
                $cashadvance = $ca->cashamount;
                $gross = $cust->rate * $cust->total_hr;
                $total_deduction = $cust->sss_amount + $cust->pagibig_amount + $cust->philhealth_amount;
                $account_bal = $gross - $cashadvance;
                $total_bal = $account_bal + $cashadvance;
                //$total_deduction = $cashadvance + $cust->sss_amount + $cust->pagibig_amount + $cust->philhealth_amount;
                $overtime_rate = $ov->overrate * $ov->hours;
                $net = ($gross - $total_deduction - $cashadvance) + $overtime_rate;
                $total_salary = $gross + $overtime_rate;
                $acc_final = $total_bal - $cashadvance;

                $total += $net;
                $contents .= '
                <h3>Payslip for the period: '.$from_title." - ".$to_title.'</h3>
                <table cellspacing="0" cellpadding="3" style="border-collapse:collapse" width="100%">  
                    <tr>  
                        <td><b>Employee Name: '.$cust->lastname.", ".$cust->firstname.'</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td align="center" style="background-color:#e6ff5b;border:1px solid black" colspan="2">DEDUCTIONS:</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black">
                            <span>ACCT. BALANCE: '.number_format($account_bal, 2).'</span><br>
                            <span>CASH ADVANCE: '.number_format($cashadvance, 2).'</span><br>
                            <span>ETC: </span><br><br>
                            <span>TOTAL ACCT: '.number_format($total_bal, 2).'</span>
                        </td>
                        <td style="border:1px solid black">
                            <span>SSS: '.number_format($cust->sss_amount, 2).'</span><br>
                            <span>PHILHEALTH: '.number_format($cust->pagibig_amount, 2).'</span><br>
                            <span>PAG IBIG: '.number_format($cust->philhealth_amount, 2).'</span><br><br>
                            <span>TOTAL: '.number_format($total_deduction, 2).'</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black">
                            <span>BASIC SALARY: '.number_format($gross, 2).'</span><br>
                            <span>OVERTIME: '.number_format($overtime_rate, 2).'</span><br>
                            <span>TOTAL SALARY: '.number_format($total_salary, 2).'</span><br>
                            <span style="background-color:#ff6767">LESS:account: '.number_format($cashadvance, 2).'</span><br>
                            <span style="background-color:#ff6767">S/P/P: '.number_format($total_deduction, 2).'</span><br>
                            <span>NET PAY: '.number_format($net, 2).'</span>
                        </td>
                        <td style="border:1px solid black">
                            <span>ACCOUNT BAL: '.number_format($acc_final, 2).'</span>
                        </td>
                    </tr>
                </table>
                <br><br><hr>
                ';
                /*$contents .= '
                <h2 align="center">Cianos Seafood Grill and Bar</h2>
                <h4 align="center">'.$from_title." - ".$to_title.'</h4>
                <table cellspacing="0" cellpadding="3">  
                    <tr>  
                        <td width="25%" align="right">Employee Name: </td>
                        <td width="25%"><b>'.$cust->firstname." ".$cust->lastname.'</b></td>
                        <td width="25%" align="right">Rate per Hour: </td>
                        <td width="25%" align="right">'.number_format($cust->rate, 2).'</td>
                    </tr>
                    <tr>
                        <td width="25%" align="right">Employee Number: </td>
                        <td width="25%">'.$cust->employee_number.'</td>   
                        <td width="25%" align="right">Total Hours: </td>
                        <td width="25%" align="right">'.number_format($cust->total_hr, 2).'</td> 
                    </tr>
                    <tr> 
                        <td></td> 
                        <td></td>
                        <td width="25%" align="right"><b>Gross Pay: </b></td>
                        <td width="25%" align="right"><b>'.number_format(($cust->rate*$cust->total_hr), 2).'</b></td> 
                    </tr>
                    <tr> 
                        <td></td> 
                        <td></td>
                        <td width="25%" align="right">SSS Deduction: </td>
                        <td width="25%" align="right">'.number_format($cust->sss_amount, 2).'</td> 
                    </tr>
                    <tr> 
                        <td></td> 
                        <td></td>
                        <td width="25%" align="right">Pag-Ibig Deduction: </td>
                        <td width="25%" align="right">'.number_format($cust->pagibig_amount, 2).'</td> 
                    </tr>
                    <tr> 
                        <td></td> 
                        <td></td>
                        <td width="25%" align="right">PhilHealth Deduction: </td>
                        <td width="25%" align="right">'.number_format($cust->philhealth_amount, 2).'</td> 
                    </tr>
                    <tr> 
                        <td></td> 
                        <td></td>
                        <td width="25%" align="right">Cash Advance: </td>
                        <td width="25%" align="right">'.number_format($cashadvance, 2).'</td> 
                    </tr>
                    <tr> 
                        <td></td> 
                        <td></td>
                        <td width="25%" align="right"><b>Total Deduction:</b></td>
                        <td width="25%" align="right"><b>'.number_format($total_deduction, 2).'</b></td> 
                    </tr>
                    <tr> 
                        <td></td> 
                        <td></td>
                        <td width="25%" align="right"><b>Net Pay:</b></td>
                        <td width="25%" align="right"><b>'.number_format($net, 2).'</b></td> 
                    </tr>
                </table>
                <br><hr>'; */ 
                }
            }
        }
        return $contents;
    }

    public function export_payslip(){
        require_once(APPPATH.'../assets/tcpdf/tcpdf.php');
        $from=$this->uri->segment(3);
        $to=$this->uri->segment(4);
        $contents = ''; 
        $from_title = date('M d, Y', strtotime($from));
        $to_title = date('M d, Y', strtotime($to));
        $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
        $pdf->SetCreator(PDF_CREATOR);  
        $pdf->SetTitle('Payslip: '.$from_title.' - '.$to_title);  
        $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
        $pdf->SetDefaultMonospacedFont('helvetica');  
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
        $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
        $pdf->setPrintHeader(false);  
        $pdf->setPrintFooter(false);  
        $pdf->SetAutoPageBreak(TRUE, 10);  
        $pdf->SetFont('helvetica', '', 11);  
        $pdf->AddPage();
        foreach($this->super_model->custom_query("SELECT *, sum(num_hr) AS total_hr, ba.employee_id AS empid FROM biometrics_attendance ba INNER JOIN employees e ON e.employee_id=ba.employee_id INNER JOIN position p ON p.position_id=e.position_id WHERE date BETWEEN '$from' AND '$to' GROUP BY ba.employee_id ORDER BY e.lastname ASC, e.firstname ASC") AS $cust){
            foreach($this->super_model->custom_query("SELECT *, SUM(amount) AS cashamount FROM cashadvance WHERE employee_id='$cust->empid' AND date_advance BETWEEN '$from' AND '$to'") AS $ca){
                $cashadvance = $ca->cashamount;
                //$total_deduction = $cashadvance + $cust->sss_amount + $cust->pagibig_amount + $cust->philhealth_amount;
                $total_deduction = $cust->sss_amount + $cust->pagibig_amount + $cust->philhealth_amount;
                $gross = $cust->rate * $cust->total_hr;
                $net = $gross - $total_deduction; 
                $contents .= $this->generateSlip($from, $to, $total_deduction); 
                $pdf->writeHTML($contents);  
                $pdf->Output('payslip.pdf', 'I');
            }
        }
        if(empty($contents)){
            $pdf->writeHTML($contents);  
            $pdf->Output('payslip.pdf', 'I');
        }
    }

    public function get_name($employee_id){
        $firstname = $this->super_model->select_column_where("employees", "firstname", "employee_id", $employee_id);
        $lastname = $this->super_model->select_column_where("employees", "lastname", "employee_id", $employee_id);
        $fullname = $firstname." ".$lastname;
        return $fullname;
    }

    public function get_empnum($employee_id){
        $empnum = $this->super_model->select_column_where("employees", "employee_number", "employee_id", $employee_id);
        return $empnum;
    }

    public function schedule_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $data['employee']=$this->super_model->custom_query("SELECT * FROM employees INNER JOIN schedules ON schedules.schedule_id=employees.schedule_id");
        $data['schedules']=$this->super_model->select_all_order_by("schedules","time_in","ASC");
        $this->load->view('masterfile/schedule_list',$data);
        $this->load->view('template/footer');
    }

    public function update_schedule(){
        $schedule = trim($this->input->post('schedule')," ");
        $data = array(
            'schedule_id'=>$schedule,
        );
        $employee_id = $this->input->post('employee_id');
        if($this->super_model->update_where('employees', $data, 'employee_id', $employee_id)){
            echo "<script>alert('Successfully Updated!'); 
                window.location ='".base_url()."masterfile/schedule_list'; </script>";
        }
    }

    public function generateSched(){
        $contents = '';
        foreach($this->super_model->custom_query("SELECT * FROM employees INNER JOIN schedules ON schedules.schedule_id=employees.schedule_id") AS $cust){
            $contents .= "
            <tr>
                <td>".$cust->lastname.", ".$cust->firstname."</td>
                <td>".$cust->employee_number."</td>
                <td>".date('h:i A', strtotime($cust->time_in)).' - '. date('h:i A', strtotime($cust->time_out))."</td>
            </tr>
            ";
        }
        return $contents;
    }

    public function export_schedule(){
        require_once(APPPATH.'../assets/tcpdf/tcpdf.php');
        $content='';
        foreach($this->super_model->custom_query("SELECT * FROM employees INNER JOIN schedules ON schedules.schedule_id=employees.schedule_id") AS $cust){
            $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
            $pdf->SetCreator(PDF_CREATOR);  
            $pdf->SetTitle('Schedule Report');  
            $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
            $pdf->SetDefaultMonospacedFont('helvetica');  
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
            $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
            $pdf->setPrintHeader(false);  
            $pdf->setPrintFooter(false);  
            $pdf->SetAutoPageBreak(TRUE, 10);  
            $pdf->SetFont('helvetica', '', 11);  
            $pdf->AddPage(); 
            $content .= '
            <h2 align="center">Cianos Seafood Grill and Bar</h2>
            <h4 align="center">Employee Schedule</h4>
            <table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
                <th width="40%" align="center"><b>Employee Name</b></th>
                <th width="30%" align="center"><b>Employee Number</b></th>
                <th width="30%" align="center"><b>Schedule</b></th> 
           </tr>';  
            $content .= $this->generateSched(); 
            $content .= '</table>';  
            $pdf->writeHTML($content);  
            $pdf->Output('payroll.pdf', 'I');
        }
    }

    public function generateReserve(){
        if(!empty($this->input->post('from'))){
            $from = $this->input->post('from');
        } else {
            $from = "null";
        }

        if(!empty($this->input->post('to'))){
            $to = $this->input->post('to');
        } else {
            $to = "null";
        }

        ?>
       <script>
        window.location.href ='<?php echo base_url(); ?>masterfile/reservation_report/<?php echo $from; ?>/<?php echo $to; ?>'</script> <?php
    }

    public function generateReservation(){
        $to = date('Y-m-d');
        $from = date('Y-m-d', strtotime('-30 day', strtotime($to)));
        if(!empty($this->uri->segment(3)) && !empty($this->uri->segment(4))){
            $from=$this->uri->segment(3);
            $to=$this->uri->segment(4);
        }
        $contents = '';
        foreach($this->super_model->custom_query("SELECT * FROM reservation WHERE start_date BETWEEN '$from' AND '$to' ORDER BY start_date DESC") AS $cust){
            $fname = $this->super_model->select_column_where("registration","fname","register_id",$cust->register_id);
            $lname = $this->super_model->select_column_where("registration","lname","register_id",$cust->register_id);
            $mname = $this->super_model->select_column_where("registration","mname","register_id",$cust->register_id);
            $fullname = $fname." ".$mname." ".$lname;
            $hut_name='';
            $table_no='';
            $menu='';
            foreach($this->super_model->select_custom_where("reservation_details","reservation_id = '$cust->reservation_id'") AS $rr){     
                if($rr->hut_id!=0){
                    $hut_name .= "- ".$this->super_model->select_column_where("huts","hut_name","hut_id",$rr->hut_id)."<br> ";
                }

                if($rr->table_id!=0){
                    $table_no .= "- ".$this->super_model->select_column_where("tables","table_no","table_id",$rr->table_id)."<br> ";
                }

                if($rr->menu_id!=0){
                    $menu .= "- ".$this->super_model->select_column_where("menu","menu_name","menu_id",$rr->menu_id)."<br> ";
                }
            }
            $contents .= "
            <tr>
                <td>".$fullname."</td>
                <td>".$hut_name."</td>
                <td>".$table_no."</td>
                <td>".$cust->start_date."</td>
                <td>".$cust->end_date."</td>
                <td>".$menu."</td>
            </tr>
            ";
        }
        return $contents;
    }

    public function export_reserve(){
        require_once(APPPATH.'../assets/tcpdf/tcpdf.php');
        $to = date('Y-m-d');
        $from = date('Y-m-d', strtotime('-30 day', strtotime($to)));
        if(!empty($this->uri->segment(3)) && !empty($this->uri->segment(4))){
            $from=$this->uri->segment(3);
            $to=$this->uri->segment(4);
        }
        $content='';
        foreach($this->super_model->custom_query("SELECT * FROM reservation WHERE start_date BETWEEN '$from' AND '$to' ORDER BY start_date DESC") AS $cust){
            $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
            $pdf->SetCreator(PDF_CREATOR);  
            $pdf->SetTitle('Reservations Report');  
            $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
            $pdf->SetDefaultMonospacedFont('helvetica');  
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
            //$pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
            $pdf->setPrintHeader(false);  
            $pdf->setPrintFooter(false);  
            $pdf->SetAutoPageBreak(TRUE, 10);  
            $pdf->SetFont('helvetica', '', 9);  
            $pdf->AddPage(); 
            $content .= '
            <h2 align="center">Cianos Seafood Grill and Bar</h2>
            <h4 align="center">Reservations Report</h4>
            <table border="1" cellspacing="0" cellpadding="3">  
            <tr>  
                <th width="20%" align="center"><b>Name</b></th>
                <th width="20%" align="center"><b>Hut Number</b></th>
                <th width="20%" align="center"><b>Table Number</b></th> 
                <th width="10%" align="center"><b>Start Date</b></th> 
                <th width="10%" align="center"><b>End Date</b></th>  
                <th width="20%" align="center"><b>Orders</b></th>  
            </tr>';  
            $content .= $this->generateReservation(); 
            $content .= '</table>';  
            $pdf->writeHTML($content);  
            $pdf->Output('reservation.pdf', 'I');
        }
    }

    public function reservation_report(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $to = date('Y-m-d');
        $from = date('Y-m-d', strtotime('-30 day', strtotime($to)));
        $data['from']=date('Y-m-d', strtotime('-30 day', strtotime($to)));
        $data['to']=date('Y-m-d');
        if(!empty($this->uri->segment(3)) && !empty($this->uri->segment(4))){
            $from=$this->uri->segment(3);
            $to=$this->uri->segment(4);
            $data['from']=$this->uri->segment(3);
            $data['to']=$this->uri->segment(4);
        }
        foreach($this->super_model->custom_query("SELECT * FROM reservation WHERE start_date BETWEEN '$from' AND '$to' ORDER BY start_date DESC") AS $res){
            //$hut_name = $this->super_model->select_column_where("huts","hut_name","hut_id",$res->hut_id);
            $fname = $this->super_model->select_column_where("registration","fname","register_id",$res->register_id);
            $lname = $this->super_model->select_column_where("registration","lname","register_id",$res->register_id);
            $mname = $this->super_model->select_column_where("registration","mname","register_id",$res->register_id);
            $fullname = $fname." ".$mname." ".$lname;

            $hut_name='';
            $table_no='';
            $menu='';
            foreach($this->super_model->select_custom_where("reservation_details","reservation_id = '$res->reservation_id'") AS $rr){     
                if($rr->hut_id!=0){
                    $hut_name .= "- ".$this->super_model->select_column_where("huts","hut_name","hut_id",$rr->hut_id)."<br> ";
                }

                if($rr->table_id!=0){
                    $table_no .= "- ".$this->super_model->select_column_where("tables","table_no","table_id",$rr->table_id)."<br> ";
                }

                if($rr->menu_id!=0){
                    $menu .= "- ".$this->super_model->select_column_where("menu","menu_name","menu_id",$rr->menu_id)."<br> ";
                }
            }
            $data['reserve'][]=array(
                'reservation_id'=>$res->reservation_id,
                'hut_name'=>$hut_name,
                'fullname'=>$fullname,
                'menu'=>$menu,
                'table'=>$table_no,
                'start_date'=>$res->start_date,
                'end_date'=>$res->end_date,
            );
        }
        $this->load->view('masterfile/reservation_report',$data);
        $this->load->view('template/footer');
    }

    public function delivery_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $row_head = $this->super_model->count_rows("delivery_head");
        if($row_head!=0){
            foreach($this->super_model->select_all_order_by("delivery_head","delivery_date","DESC") AS $del){
                $menu='';
                $price='0.00';
                $total='0.00';
                $total_price='0.00';
                foreach($this->super_model->select_custom_where("delivery_details","delivery_id='$del->delivery_id'") AS $d){
                    if($d->menu_id!=0){
                        $menu .= "- ".$this->super_model->select_column_where("menu","menu_name","menu_id",$d->menu_id)." - ".$d->quantity."<br> ";
                        $price = $this->super_model->select_column_where("menu","menu_price","menu_id",$d->menu_id);
                        $total= $d->quantity * $price;
                        $total_price +=$total;
                    }
                }
                $fname = $this->super_model->select_column_where("registration","fname","register_id",$del->register_id);
                $lname = $this->super_model->select_column_where("registration","lname","register_id",$del->register_id);
                $mname = $this->super_model->select_column_where("registration","mname","register_id",$del->register_id);
                $contact_no = $this->super_model->select_column_where("registration","contact_no","register_id",$del->register_id);
                $fullname = $fname." ".$mname." ".$lname;
                $data["delivery"][]=array(
                    "delivery_id"=>$del->delivery_id,
                    "delivery_date"=>$del->delivery_date,
                    "address"=>$del->address,
                    "remarks"=>$del->remarks,
                    "menu"=>$menu,
                    "price"=>$total_price,
                    "fullname"=>$fullname,
                    "contact_no"=>$contact_no,
                    "delivered"=>$del->delivered,
                );
                
            }
        }else{
            $data["delivery"]=array();
        }
        $this->load->view('masterfile/delivery_list',$data);
        $this->load->view('template/footer');
    }

    public function delivery_done(){
        $delivery_id = $this->uri->segment(3);
        $data=array(
            'delivered'=>1,
        );
        if($this->super_model->update_where('delivery_head', $data, 'delivery_id', $delivery_id)){
            echo "<script>alert('Succesfully Delivered');
            window.location = '".base_url()."masterfile/delivery_list'; </script>";
        }
    }
}
