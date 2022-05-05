<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
        $this->load->view('users/login');
    }

    public function dashboard(){
        $this->load->view('user_template/header');
        $this->load->view('user_template/navbar');
        $this->load->view('users/dashboard');
        $this->load->view('user_template/footer');
    }

    public function login(){
        $email=$this->input->post('email');
        $password=$this->input->post('password');
        $count=$this->super_model->login_register($email,$password);
        if($count>0){   
            $password1 =md5($this->input->post('password'));
            $fetch=$this->super_model->select_custom_where("registration", "email = '$email' AND (password = '$password' OR password = '$password1')");
            foreach($fetch AS $d){
                $complete_name = $d->fname." ".$d->mname." ".$d->lname; 
                $register_id = $d->register_id;
                $email = $d->email;
                $fullname = $complete_name;
            }
            $newdata = array(
               'user_id'=> $register_id,
               'email'=> $email,
               'fullname'=> $fullname,
               'logged_in'=> TRUE,
            );
            $this->session->set_userdata($newdata);
            redirect(base_url().'users/dashboard/');
        }
        else{
            $this->session->set_flashdata('error_msg', 'Email And Password Do not Exist!');
            $this->load->view('users/login');
        }
    }

    public function reset(){
        $email = $this->input->post('email');
        $count=$this->super_model->count_rows_where("registration","email",$email);
        if ($count > 0){
            $string="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            $code="";
            $limit=5;
            $i=0;
            while($i<=$limit){
                $rand=rand(0,61);
                $code.=$string[$rand];
                $i++;
            }
            $data=array(
                "password"=>$code
            );
            $this->super_model->update_where("registration", $data, "email", $email);
            ini_set( 'display_errors', 1 );
            error_reporting( E_ALL );
            $to = $email;
            $subject = "Email Verification";
            $message = "
            <html>
            <head>
            <title>Change the password for your username</title>
            </head>
            <body>
            <p>Here is the new password for you account ".$email."</p>
            <table>
            <tr>
            <th>Email</th>
            <th>New Password</th>
            </tr>
            <tr>
            <td>".$code."</td>
            <td></td>
            </tr>
            </table>
            </body>
            </html>
            ";
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $headers .= 'From: <webmaster@example.com>' . "\r\n";
            $headers .= 'Cc: myboss@example.com' . "\r\n";
            var_dump(mail($to,$subject,$message,$headers));
            echo "<script>alert('Successfully Changed!'); 
            window.location ='".base_url()."users/index'; </script>";      
        }else{
            echo "<script>alert('Email Address not found!'); 
            window.location ='".base_url()."users/index'; </script>";
       }
    }

    public function register(){
        $this->load->view('users/register');
    }

    public function insert_registration(){
        $fname = trim($this->input->post('fname')," ");
        $lname = trim($this->input->post('lname')," ");
        $mname = trim($this->input->post('mname')," ");
        $contact_no = trim($this->input->post('contact_no')," ");
        $email = trim($this->input->post('email')," ");
        $password = trim($this->input->post('password')," ");
        $data = array(
            'fname'=>$fname,
            'mname'=>$mname,
            'lname'=>$lname,
            'contact_no'=>$contact_no,
            'email'=>$email,
            'password'=>$password,
        );
        if($this->super_model->insert_into("registration", $data)){
           echo "<script>alert('Successfully Registered!'); 
                window.location ='".base_url()."users/index'; </script>";
        }
    }

    public function user_logout(){
        $this->session->sess_destroy();
        echo "<script>alert('You have successfully logged out.'); 
        window.location ='".base_url()."users/index'; </script>";
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

    public function hut_reserve(){
        $this->load->view('user_template/header');
        $this->load->view('user_template/navbar');
        $data['hut']=$this->super_model->select_custom_where("huts","reserved='0' ORDER BY hut_name ASC");
        $data['menu_list']=$this->super_model->select_all_order_by("menu","menu_name","ASC");
        foreach($this->super_model->select_custom_where("reservation","trans_done = '0' ORDER BY start_date ASC") AS $res){
            $hut_no='';
            $table_no='';
            $menu='';
            foreach($this->super_model->select_custom_where("reservation_details","done='0' AND reservation_id = '$res->reservation_id'") AS $rr){     
                if($rr->hut_id!=0){
                    $hut_no .= $this->super_model->select_column_where("huts","hut_name","hut_id",$rr->hut_id).", ";
                }

                if($rr->table_id!=0){
                    $table_no .= $this->super_model->select_column_where("tables","table_no","table_id",$rr->table_id).", ";
                }

                if($rr->menu_id!=0){
                    $menu .= $this->super_model->select_column_where("menu","menu_name","menu_id",$rr->menu_id).", ";
                }
            }
            $data['reserve'][]=array(
                'reservation_id'=>$res->reservation_id,
                'hut_no'=>$hut_no,
                'table_no'=>$table_no,
                'menu'=>$menu,
                'start_date'=>$res->start_date,
                'end_date'=>$res->end_date,
            );
        }
        $this->load->view('users/hut_reserve',$data);
        $this->load->view('user_template/footer');
    }

    public function get_menu($menu_id){
        $menu = $this->super_model->select_column_where("menu", "menu_name", "menu_id", $menu_id);
        return $menu;
    }

    public function get_table($table_id){
        $table = $this->super_model->select_column_custom_where("tables", "table_no", "table_id='$table_id' AND reserved = '1'");
        return $table;
    }

    public function get_huts($hut_id){
        $table = $this->super_model->select_column_custom_where("huts", "hut_name", "hut_id='$hut_id' AND reserved = '1'");
        return $table;
    }
    public function reserve_order(){
        $data['id']=$this->uri->segment(3);
        $this->load->view('user_template/header');
        $this->load->view('user_template/navbar');
        $data['hut']=$this->super_model->select_custom_where("huts","reserved='0' ORDER BY hut_name ASC");
        $data['menu_list']=$this->super_model->select_all_order_by("menu","menu_name","ASC");
        $data['menu_category']=$this->super_model->select_all_order_by("menu_category","menu_category","ASC");
        foreach($this->super_model->select_all_order_by("menu_selection","menu_selection","ASC") AS $ms){
            $data['menu'][]=array(
                "menusel_id"=>$ms->menusel_id,
                "menu_selection"=>$ms->menu_selection,
            );
        }

        foreach($this->super_model->select_custom_where("tables","reserved='0'") AS $t){
            $data['tables'][]=array(
                "table_id"=>$t->table_id,
                "table_no"=>$t->table_no,
                "table_img"=>$t->table_img,
                "reserved"=>$t->reserved,
            );
        }

        $this->load->view('users/reserve_order',$data);
        $this->load->view('user_template/footer_reserve');
    }

    public function fetch_modal(){
        $reservation_id = $this->input->post('id');
        $hut_disp='';
        $table_disp='';
        foreach($this->super_model->select_custom_where("reservation_details_tmp","reservation_id = '$reservation_id'") AS $rr){
            $hut_no = $this->super_model->select_column_where("huts","hut_name","hut_id",$rr->hut_id);
            $table_no = $this->super_model->select_column_where("tables","table_no","table_id",$rr->table_id);
            $menu = $this->super_model->select_column_where("menu","menu_name","menu_id",$rr->menu_id);
            $price = $this->super_model->select_column_where("menu","menu_price","menu_id",$rr->menu_id);
            $total = $rr->quantity * $price;
            if($rr->hut_id!=0){
                $hut_disp .= $hut_no.", ";
            }

            if($rr->table_id!=0){
                $table_disp .= $table_no.", ";
            }

            if($rr->menu_id!=0){
                $data['reserve'][]=array(
                    'qty'=>$rr->quantity,
                    'hut_no'=>$hut_no,
                    'menu_id'=>$rr->menu_id,
                    'menu'=>$menu,
                    'price'=>$total,
                );
            }
        }

        $data['hut_disp']=$hut_disp;
        $data['table_disp']=$table_disp;
        $this->load->view('users/fetch_modal',$data);
    }

    public function fetch_order(){
        $menusel_id = $this->input->post('id');
        $data['menu_list']=$this->super_model->select_all_order_by("menu","menu_name","ASC");
        $data['menu_selection']='';
        foreach($this->super_model->select_row_where("menu_category","menusel_id",$menusel_id) AS $men){
            foreach($this->super_model->select_row_where("menu_selection","menusel_id",$men->menusel_id) AS $m){
                $data['menu_selection']=$m->menu_selection;
                $data['menu_category'][]=array(
                    "menucat_id"=>$men->menucat_id,
                    "menusel_id"=>$m->menusel_id,
                    "menu_selection"=>$m->menu_selection,
                    "menu_category"=>$men->menu_category,
                );
            }
        }
        $this->load->view('users/fetch_order',$data);
    }

    public function add_reservations_tmp(){
        $user=$this->uri->segment(3);
        $hut_name = trim($this->input->post('hut_name')," ");
        $start = trim($this->input->post('start')," ");
        $end = trim($this->input->post('end')," ");
        $user_id = trim($this->input->post('user_id')," ");
        $count= count($this->input->post('check'));
        $count_table= count($this->input->post('table'));
        $count_hut= count($this->input->post('hut_id'));
        $head_rows = $this->super_model->count_rows("reservation");
        if($head_rows==0){
            $reservation_id=1;
        } else {
            $maxid=$this->super_model->get_max("reservation_tmp", "reservation_id");
            $reservation_id=$maxid+1;
        }

        $data = array(
            'reservation_id'=>$reservation_id,
            'start_date'=>$start,
            'end_date'=>$end,
            'register_id'=>$user_id,
        );
        if($this->super_model->insert_into("reservation_tmp", $data)){
            if($count!=0){
                if($count_table==0 && $count_hut==0){
                    $data_head = array(
                        'trans_done'=>1,
                    );
                    $this->super_model->update_where('reservation_tmp', $data_head, 'reservation_id', $reservation_id);
                }
            }
        }

        for($a=0; $a<$count;$a++){
            if($this->input->post('check['.$a.']')!=''){
                $data_menu = array(
                    'reservation_id'=>$reservation_id,
                    'menu_id'=>$this->input->post('check['.$a.']'),
                    'quantity'=>$this->input->post('qty_'.$this->input->post('check['.$a.']')),
                    'done'=>1
                );
                $this->super_model->insert_into("reservation_details_tmp", $data_menu);
            }
        }

        for($x=0; $x<$count_table;$x++){
            if($this->input->post('table['.$x.']')!=''){
                $data_table = array(
                    'reservation_id'=>$reservation_id,
                    'table_id'=>$this->input->post('table['.$x.']'),
                );
                $this->super_model->insert_into("reservation_details_tmp", $data_table);
            }
        }

        for($y=0; $y<$count_hut;$y++){
            if($this->input->post('hut_id['.$y.']')!=''){
                $data_huts = array(
                    'reservation_id'=>$reservation_id,
                    'hut_id'=>$this->input->post('hut_id['.$y.']'),
                );
                $this->super_model->insert_into("reservation_details_tmp", $data_huts);
            }
        }

        echo $reservation_id;
    }

    public function add_reservations(){
        $user=$this->uri->segment(3);
        $save = trim($this->input->post('save')," ");
        $cancel = trim($this->input->post('cancel')," ");
        $head_rows = $this->super_model->count_rows("reservation");
        if($head_rows==0){
            $reservation_id=1;
        } else {
            $maxid=$this->super_model->get_max("reservation", "reservation_id");
            $reservation_id=$maxid+1;
        }
        if($save=="Save"){
            foreach($this->super_model->select_all("reservation_tmp") AS $rec){
                $data = array(
                    'reservation_id'=>$reservation_id,
                    'start_date'=>$rec->start_date,
                    'end_date'=>$rec->end_date,
                    'register_id'=>$rec->register_id,
                );
                if($this->super_model->insert_into("reservation", $data)){
                    $data_head = array(
                        'trans_done'=>$rec->trans_done,
                    );
                    $this->super_model->update_where('reservation', $data_head, 'reservation_id', $reservation_id);
                    //EMAIL SENDER//
                    $hut_disp='';
                    $table_disp='';
                    foreach($this->super_model->select_row_where("reservation_details_tmp","reservation_id",$rec->reservation_id) AS $rd){
                        $hut_no = $this->super_model->select_column_where("huts","hut_name","hut_id",$rd->hut_id);
                        $table_no = $this->super_model->select_column_where("tables","table_no","table_id",$rd->table_id);
                        if($rd->hut_id!=0){
                            $hut_disp .= $hut_no.", ";
                        }

                        if($rd->table_id!=0){
                            $table_disp .= $table_no.", ";
                        }
                    }
                    $register_id = $this->super_model->select_column_where("reservation","register_id","reservation_id",$reservation_id);
                    $email = $this->super_model->select_column_where("registration","email","register_id",$register_id);
                    ini_set( 'display_errors', 1 );
                    error_reporting( E_ALL );
                    $to = $email;
                    $subject = "Order List From CIANO'S";
                    $message = "
                    <style>
                        .txtwhite{
                            color:#000!important;
                        }

                        .bordertab {
                            border: 1px solid #000!important;
                        }

                        .border-btm{
                            border-bottom: 1px solid #000!important;
                        }

                        .bor-btm{border-top:#000!important}
                    </style>
                    <table style='border: 0px solid #000;border-collapse:collapse;' width='100%'>
                        <tr>
                            <td style= 'color:#000!important' class='txtwhite' colspan='5'><center>ORDER SLIP</center><br></td>
                        </tr>
                        <tr>
                            <td style= 'color:#000!important' class='txtwhite' width='20%'></td>
                            <td style= 'color:#000!important' class='txtwhite' width='20%'></td>
                            <td style= 'color:#000!important' class='txtwhite' width='20%'></td>
                            <td style= 'color:#000!important' class='txtwhite' width='20%'></td>
                            <td style= 'color:#000!important' class='txtwhite' width='20%'></td>
                        </tr>
                        <tr>
                            <td style= 'color:#000!important;border-bottom:1px solid #000!important' class='txtwhite border-btm' colspan='2'></td>
                            <td style= 'color:#000!important' class='txtwhite '></td>
                            <td style= 'color:#000!important;border-bottom:1px solid #000!important' class='txtwhite border-btm' colspan='2' align='center'>".date('F d, Y')."</td>
                        </tr>
                        <tr>
                            <td style= 'color:#000!important' class='txtwhite ' colspan='2' align='center'>Waiter</td>
                            <td style= 'color:#000!important' class='txtwhite'></td>
                            <td style= 'color:#000!important' class='txtwhite' colspan='2' align='center'>Date</td>
                        </tr>
                        <tr>
                            <td colspan='5'><br></td>
                        </tr>
                        <tr>
                            <td style= 'color:#000!important' class='txtwhite'></td>
                            <td style= 'color:#000!important' class='txtwhite'></td>
                            <td style= 'color:#000!important' class='txtwhite'></td>
                            <td style= 'color:#000!important' class='txtwhite'></td>
                            <td style= 'color:#000!important' class='txtwhite'></td>
                        </tr>
                        <tr>
                            <td style= 'color:#000!important;border-bottom:1px solid #000!important' class='txtwhite border-btm' colspan='2'>".$table_disp."</td>
                            <td style= 'color:#000!important' class='txtwhite '></td>
                            <td style= 'color:#000!important;border-bottom:1px solid #000!important' class='txtwhite border-btm' colspan='2'>".$hut_disp."</td>
                        </tr>
                        <tr>
                            <td style= 'color:#000!important' class='txtwhite ' colspan='2' align='center'>Table No.</td>
                            <td style= 'color:#000!important' class='txtwhite'></td>
                            <td style= 'color:#000!important' class='txtwhite' colspan='2' align='center'>Hut No.</td>
                        </tr>
                        <tr>
                            <td style= 'color:#000!important' class='txtwhite' colspan='3'><br></td>
                            <td style= 'color:#000!important;border-bottom:1px solid #000!important' class='txtwhite border-btm' colspan='2'></td>
                        </tr>
                        <tr>
                            <td style= 'color:#000!important' class='txtwhite ' colspan='3'></td>
                            <td style= 'color:#000!important' class='txtwhite' colspan='2' align='center'>No.</td>
                        </tr>
                        <tr>
                            <td style= 'color:#000!important;border: 1px solid #000!important' class='txtwhite bordertab' align='center'>QTY</td>
                            <td style= 'color:#000!important;border: 1px solid #000!important' class='txtwhite bordertab' colspan='3' align='center'>DESCRIPTION</td>
                            <td style= 'color:#000!important;border: 1px solid #000!important' class='txtwhite bordertab' align='center'>PRICE</td>
                        </tr>
                    ";
                    //EMAIL SENDER//
                    $grtotal='0.00';
                    foreach($this->super_model->select_row_where("reservation_details_tmp","reservation_id",$rec->reservation_id) AS $rd){
                        //EMAIL SENDER//
                        $menu = $this->super_model->select_column_where('menu','menu_name','menu_id',$rd->menu_id);
                        $price = $this->super_model->select_column_where('menu','menu_price','menu_id',$rd->menu_id);
                        $total = $rd->quantity * $price;
                        $prices[] = $total;
                        if($rd->menu_id!=0){
                        $message.="
                        <tr>
                            <td style= 'color:#000!important;border: 1px solid #000!important' class='txtwhite bordertab'>".$rd->quantity."</td>
                            <td style= 'color:#000!important;border: 1px solid #000!important' class='txtwhite bordertab' colspan='3'>".$menu."</td>
                            <td style= 'color:#000!important;border: 1px solid #000!important' class='txtwhite bordertab'>".$total."</td>
                        </tr>
                        ";
                        }
                        //EMAIL SENDER//

                        $data_tab = array(
                            'reserved'=>1,
                        );
                        $this->super_model->update_where('tables', $data_tab, 'table_id', $rd->table_id);

                        $data_res = array(
                            'reserved'=>1,
                        );
                        $this->super_model->update_where('huts', $data_res, 'hut_id', $rd->hut_id);

                        $data_all = array(
                            'reservation_id'=>$reservation_id,
                            'menu_id'=>$rd->menu_id,
                            'quantity'=>$rd->quantity,
                            'table_id'=>$rd->table_id,
                            'hut_id'=>$rd->hut_id,
                            'done'=>$rd->done
                        );
                        if($this->super_model->insert_into("reservation_details", $data_all)){
                            $this->super_model->delete_where("reservation_tmp", "reservation_id", $rd->reservation_id);
                            $this->super_model->delete_where("reservation_details_tmp", "reservation_id", $rd->reservation_id);
                        }
                    }
                    $grtotal =array_sum($prices);
                    //EMAIL SENDER//
                    $message.="
                        <tr>
                            <td style= 'color:#000!important;border: 1px solid #000!important' class='txtwhite bordertab'><br></td>
                            <td style= 'color:#000!important;border: 1px solid #000!important;text-align: right!important' class='txtwhite bordertab' colspan='3'>Total: </td>
                            <td style= 'color:#000!important;border: 1px solid #000!important' class='txtwhite bordertab'>".$grtotal."</td>
                        </tr>
                    </table>
                    ";
                    // Always set content-type when sending HTML email
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    // More headers
                    $headers .= 'From: <webmaster@example.com>' . "\r\n";
                    $headers .= 'Cc: myboss@example.com' . "\r\n";
                    var_dump(mail($to,$subject,$message,$headers));
                    //EMAIL SENDER//
                    if($user=='admin'){
                        echo "<script>alert('Successfully Added!'); window.location ='".base_url()."masterfile/dashboard'; </script>";
                    }else{
                        echo "<script>alert('Successfully Added!'); window.location ='".base_url()."users/hut_reserve'; </script>";
                    }  
                }
            }
        }else{
            foreach ($this->super_model->select_all("reservation_tmp") AS $rec) {
                $this->super_model->delete_where("reservation_tmp", "reservation_id", $rec->reservation_id);
                foreach($this->super_model->select_row_where("reservation_details_tmp","reservation_id",$rec->reservation_id) AS $rd){
                    $this->super_model->delete_where("reservation_details_tmp", "reservation_id", $rd->reservation_id);
                }
            }
            echo "<script>alert('The Order Was Canceled!'); window.location ='".base_url()."users/reserve_order/'; </script>";
        }
    }

    public function order_delivery(){
        $data['id']=$this->uri->segment(3);
        $this->load->view('user_template/header');
        $this->load->view('user_template/navbar');
        $data['hut']=$this->super_model->select_custom_where("huts","reserved='0' ORDER BY hut_name ASC");
        $data['menu_list']=$this->super_model->select_all_order_by("menu","menu_name","ASC");
        $data['menu_category']=$this->super_model->select_all_order_by("menu_category","menu_category","ASC");
        foreach($this->super_model->select_all_order_by("reservation","start_date","ASC") AS $res){
            foreach($this->super_model->select_custom_where("reservation_details","done='0' AND reservation_id = '$res->reservation_id'") AS $rr){
                $hut_no = $this->super_model->select_column_where("huts","hut_name","hut_id",$rr->hut_id);
                $data['reserve'][]=array(
                    'reservation_id'=>$res->reservation_id,
                    'hut_no'=>$hut_no,
                    'menu'=>$rr->menu_id,
                    'start_date'=>$res->start_date,
                    'end_date'=>$res->end_date,
                );
            }
        }

        foreach($this->super_model->select_all_order_by("menu_selection","menu_selection","ASC") AS $ms){
            $data['menu'][]=array(
                "menusel_id"=>$ms->menusel_id,
                "menu_selection"=>$ms->menu_selection,
            );
        }

        foreach($this->super_model->select_custom_where("tables","reserved='0'") AS $t){
            $data['tables'][]=array(
                "table_id"=>$t->table_id,
                "table_no"=>$t->table_no,
                "table_img"=>$t->table_img,
                "reserved"=>$t->reserved,
            );
        }

        $this->load->view('users/order_delivery',$data);
        $this->load->view('user_template/footer_reserve');
    }

    public function add_delivery(){
        $user=$this->uri->segment(3);
        $user_id = trim($this->input->post('user_id')," ");
        $address = trim($this->input->post('address')," ");
        $remarks = trim($this->input->post('remarks')," ");
        $head_rows = $this->super_model->count_rows("delivery_head");
        if($head_rows==0){
            $delivery_id=1;
        } else {
            $maxid=$this->super_model->get_max("delivery_head", "delivery_id");
            $delivery_id=$maxid+1;
        }
        $data = array(
            'delivery_date'=>date('Y-m-d'),
            'address'=>$address,
            'remarks'=>$remarks,
            'register_id'=>$user_id,
        );
        if($this->super_model->insert_into("delivery_head", $data)){
            echo "<script>window.location ='".base_url()."users/order_delivery/$delivery_id'; </script>";
        }
    }

    public function fetch_modal_delivery(){
        $delivery_id = $this->input->post('id');
        $data['delivery_id'] = $this->input->post('id');
        foreach($this->super_model->select_custom_where("delivery_details_tmp","delivery_id = '$delivery_id'") AS $rr){
            $menu = $this->super_model->select_column_where("menu","menu_name","menu_id",$rr->menu_id);
            $price = $this->super_model->select_column_where("menu","menu_price","menu_id",$rr->menu_id);
            $total = $rr->quantity * $price;
            if($rr->menu_id!=0){
                $data['reserve'][]=array(
                    'qty'=>$rr->quantity,
                    'menu_id'=>$rr->menu_id,
                    'menu'=>$menu,
                    'price'=>$total,
                );
            }
        }

        $this->load->view('users/fetch_modal_delivery',$data);
    }

    public function add_order_tmp(){
        $delivery_id=$this->input->post('delivery_id');
        $count= count($this->input->post('check'));
        for($a=0; $a<$count;$a++){
            if($this->input->post('check['.$a.']')!=''){
                $data_menu = array(
                    'delivery_id'=>$delivery_id,
                    'menu_id'=>$this->input->post('check['.$a.']'),
                    'quantity'=>$this->input->post('qty_'.$this->input->post('check['.$a.']')),
                );
                $this->super_model->insert_into("delivery_details_tmp", $data_menu);
            }
        }
    }

    public function add_order(){
        // var_dump($this->input->post());exit;
        $delivery_id=$this->input->post('delivery_id');
        $save=$this->input->post('save');
        // $count= count($this->input->post('check'));
        if($save=="Save"){
            $register_id = $this->super_model->select_column_where("delivery_head","register_id","delivery_id",$delivery_id);
            $email = $this->super_model->select_column_where("registration","email","register_id",$register_id);
            ini_set( 'display_errors', 1 );
            error_reporting( E_ALL );
            $to = $email;
            $subject = "Order List From CIANO'S";
            $message = "
            <style>
                .txtwhite{
                    color:#000!important;
                }

                .bordertab {
                    border: 1px solid #000!important;
                }

                .border-btm{
                    border-bottom: 1px solid #000!important;
                }

                .bor-btm{border-top:#000!important}
            </style>
            <table style='border: 0px solid #000;border-collapse:collapse;' width='100%'>
                <tr>
                    <td style= 'color:#000!important' class='txtwhite' colspan='5'><center>ORDER SLIP</center><br></td>
                </tr>
                <tr>
                    <td style= 'color:#000!important' class='txtwhite' width='20%'></td>
                    <td style= 'color:#000!important' class='txtwhite' width='20%'></td>
                    <td style= 'color:#000!important' class='txtwhite' width='20%'></td>
                    <td style= 'color:#000!important' class='txtwhite' width='20%'></td>
                    <td style= 'color:#000!important' class='txtwhite' width='20%'></td>
                </tr>
                <tr>
                    <td style= 'color:#000!important;border-bottom:1px solid #000!important' class='txtwhite border-btm' colspan='2'></td>
                    <td style= 'color:#000!important' class='txtwhite '></td>
                    <td style= 'color:#000!important;border-bottom:1px solid #000!important' class='txtwhite border-btm' colspan='2' align='center'>".date('F d, Y')."</td>
                </tr>
                <tr>
                    <td style= 'color:#000!important' class='txtwhite ' colspan='2' align='center'>Waiter</td>
                    <td style= 'color:#000!important' class='txtwhite'></td>
                    <td style= 'color:#000!important' class='txtwhite' colspan='2' align='center'>Date</td>
                </tr>
                <tr>
                    <td colspan='5'><br></td>
                </tr>
                <tr>
                    <td style= 'color:#000!important' class='txtwhite'></td>
                    <td style= 'color:#000!important' class='txtwhite'></td>
                    <td style= 'color:#000!important' class='txtwhite'></td>
                    <td style= 'color:#000!important' class='txtwhite'></td>
                    <td style= 'color:#000!important' class='txtwhite'></td>
                </tr>
                <tr>
                    <td style= 'color:#000!important;border-bottom:1px solid #000!important' class='txtwhite border-btm' colspan='2'></td>
                    <td style= 'color:#000!important' class='txtwhite '></td>
                    <td style= 'color:#000!important;border-bottom:1px solid #000!important' class='txtwhite border-btm' colspan='2'></td>
                </tr>
                <tr>
                    <td style= 'color:#000!important' class='txtwhite ' colspan='2' align='center'>Table No.</td>
                    <td style= 'color:#000!important' class='txtwhite'></td>
                    <td style= 'color:#000!important' class='txtwhite' colspan='2' align='center'>Hut No.</td>
                </tr>
                <tr>
                    <td style= 'color:#000!important' class='txtwhite' colspan='3'><br></td>
                    <td style= 'color:#000!important;border-bottom:1px solid #000!important' class='txtwhite border-btm' colspan='2'></td>
                </tr>
                <tr>
                    <td style= 'color:#000!important' class='txtwhite ' colspan='3'></td>
                    <td style= 'color:#000!important' class='txtwhite' colspan='2' align='center'>No.</td>
                </tr>
                <tr>
                    <td style= 'color:#000!important;border: 1px solid #000!important' class='txtwhite bordertab' align='center'>QTY</td>
                    <td style= 'color:#000!important;border: 1px solid #000!important' class='txtwhite bordertab' colspan='3' align='center'>DESCRIPTION</td>
                    <td style= 'color:#000!important;border: 1px solid #000!important' class='txtwhite bordertab' align='center'>PRICE</td>
                </tr>
            ";
            //EMAIL SENDER//
            $grtotal='0.00';
            foreach($this->super_model->select_row_where("delivery_details_tmp","delivery_id",$delivery_id) AS $del){
                $data_menu = array(
                    'delivery_id'=>$del->delivery_id,
                    'menu_id'=>$del->menu_id,
                    'quantity'=>$del->quantity,
                );
                if($this->super_model->insert_into("delivery_details", $data_menu)){
                    $this->super_model->delete_where("delivery_details_tmp", "delivery_id", $del->delivery_id);
                }
                //EMAIL SENDER//
                $menu = $this->super_model->select_column_where('menu','menu_name','menu_id',$del->menu_id);
                $price = $this->super_model->select_column_where('menu','menu_price','menu_id',$del->menu_id);
                $total = $del->quantity * $price;
                $prices[] = $total;
                if($del->menu_id!=0){
                $message.="
                <tr>
                    <td style= 'color:#000!important;border: 1px solid #000!important' class='txtwhite bordertab'>".$del->quantity."</td>
                    <td style= 'color:#000!important;border: 1px solid #000!important' class='txtwhite bordertab' colspan='3'>".$menu."</td>
                    <td style= 'color:#000!important;border: 1px solid #000!important' class='txtwhite bordertab'>".$total."</td>
                </tr>
                ";
                }
                //EMAIL SENDER//
            }
            $grtotal =array_sum($prices);
            //EMAIL SENDER//
            $message.="
                <tr>
                    <td style= 'color:#000!important;border: 1px solid #000!important' class='txtwhite bordertab'><br></td>
                    <td style= 'color:#000!important;border: 1px solid #000!important;text-align: right!important' class='txtwhite bordertab' colspan='3'>Total: </td>
                    <td style= 'color:#000!important;border: 1px solid #000!important' class='txtwhite bordertab'>".$grtotal."</td>
                </tr>
            </table>
            ";
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $headers .= 'From: <webmaster@example.com>' . "\r\n";
            $headers .= 'Cc: myboss@example.com' . "\r\n";
            var_dump(mail($to,$subject,$message,$headers));
            //EMAIL SENDER//
            echo "<script>alert('Successfully Added!'); window.location ='".base_url()."users/dashboard/'; </script>";
        }else{
            foreach ($this->super_model->select_all("delivery_details_tmp") AS $rec) {
                $this->super_model->delete_where("delivery_details_tmp", "delivery_id", $rec->delivery_id);
            }
            echo "<script>alert('The Order Was Canceled!'); window.location ='".base_url()."users/order_delivery/$delivery_id'; </script>";
        }
    }
}