<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends CI_Controller {

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

	public function employee_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $data[]=array();
        $data['position']=$this->super_model->select_all_order_by("position","position_name","ASC");
        $data['schedule']=$this->super_model->select_all("schedules");
        foreach($this->super_model->select_all_order_by("employees","firstname","ASC") AS $emp){
        	$position=$this->super_model->select_column_where("position","position_name","position_id",$emp->position_id);
        	$time_in=$this->super_model->select_column_where("schedules","time_in","schedule_id",$emp->schedule_id);
        	$time_out=$this->super_model->select_column_where("schedules","time_out","schedule_id",$emp->schedule_id);
        	$schedule=date('h:i A', strtotime($time_in))." - ".date('h:i A', strtotime($time_out));
        	$data['employeee'][]=array(
        		"employee_id"=>$emp->employee_id,
        		"employee_number"=>$emp->employee_number,
        		"firstname"=>$emp->firstname,
                "lastname"=>$emp->lastname,
                "address"=>$emp->address,
                "birthdate"=>$emp->birthdate,
        		"contact_info"=>$emp->contact_info,
        		"schedule"=>$schedule,
        		"position"=>$position,
        		"sss_amount"=>$emp->sss_amount,
        		"philhealth_amount"=>$emp->philhealth_amount,
        		"pagibig_amount"=>$emp->pagibig_amount,
        		"photo"=>$emp->photo,
        		"created_on"=>$emp->created_on,
        	);
		}
        $this->load->view('employees/employee_list',$data);
        $this->load->view('template/footer');
    }

    public function fetch_emp_update(){
        $data[]=array();
        $data['position']=$this->super_model->select_all_order_by("position","position_name","ASC");
        $data['schedule']=$this->super_model->select_all("schedules");
        $employee_id = $this->input->post('id');
        foreach($this->super_model->select_row_where("employees","employee_id",$employee_id) AS $emp){
            $position=$this->super_model->select_column_where("position","position_name","position_id",$emp->position_id);
            $time_in=$this->super_model->select_column_where("schedules","time_in","schedule_id",$emp->schedule_id);
            $time_out=$this->super_model->select_column_where("schedules","time_out","schedule_id",$emp->schedule_id);
            $schedule=date('h:i A', strtotime($time_in))." - ".date('h:i A', strtotime($time_out));
            $data['employeee'][]=array(
                "employee_id"=>$emp->employee_id,
                "employee_number"=>$emp->employee_number,
                "firstname"=>$emp->firstname,
                "lastname"=>$emp->lastname,
                "address"=>$emp->address,
                "birthdate"=>$emp->birthdate,
                "contact_info"=>$emp->contact_info,
                "position_id"=>$emp->position_id,
                "schedule_id"=>$emp->schedule_id,
                "gender"=>$emp->gender,
                "schedule"=>$schedule,
                "position"=>$position,
                "sss_amount"=>$emp->sss_amount,
                "philhealth_amount"=>$emp->philhealth_amount,
                "pagibig_amount"=>$emp->pagibig_amount,
                "photo"=>$emp->photo,
                "created_on"=>$emp->created_on,
            );
        }
        $this->load->view('employees/fetch_emp_update',$data);
    }

	public function insert_employee(){
        $bio_num = trim($this->input->post('bio_num')," ");
        $fname = trim($this->input->post('fname')," ");
        $lname = trim($this->input->post('lname')," ");
        $address = trim($this->input->post('address')," ");
        $bday = trim($this->input->post('bday')," ");
        $contact_info = trim($this->input->post('contact_info')," ");
        $gender = trim($this->input->post('gender')," ");
        $sss_amount = trim($this->input->post('sss_amount')," ");
        $pagibig_amount = trim($this->input->post('pagibig_amount')," ");
        $philhealth_amount = trim($this->input->post('philhealth_amount')," ");
        $position = trim($this->input->post('position')," ");
        $schedule = trim($this->input->post('schedule')," ");
        $photo = trim($this->input->post('photo')," ");
        $error_ext=0;
        $dest= realpath(APPPATH . '../uploads/');
        if(!empty($_FILES['photo']['name'])){
             $photo= basename($_FILES['photo']['name']);
             $photo=explode('.',$photo);
             $name=$photo[0];
             $ext1=$photo[1];
            
            if($ext1=='php' || ($ext1!='png' && $ext1 != 'jpg' && $ext1!='jpeg')){
                $error_ext++;
            } else {
                 $filename=$name.'.'.$ext1;
                 move_uploaded_file($_FILES["photo"]['tmp_name'], $dest.'/'.$filename);
            }

        } else {
            $filename="";
        }
        $data = array(
            'employee_number'=>$bio_num,
            'firstname'=>$fname,
            'lastname'=>$lname,
            'address'=>$address,
            'birthdate'=>$bday,
            'contact_info'=>$contact_info,
            'gender'=>$gender,
            'sss_amount'=>$sss_amount,
            'pagibig_amount'=>$pagibig_amount,
            'philhealth_amount'=>$philhealth_amount,
            'position_id'=>$position,
            'schedule_id'=>$schedule,
            'photo'=>$filename,
            'created_on'=>date("Y-m-d H:i:s")
        );
        if($this->super_model->insert_into("employees", $data)){
           echo "<script>alert('Successfully Added!'); 
                window.location ='".base_url()."employees/employee_list'; </script>";
        }
    }

    public function update_employee(){
        $bio_num = trim($this->input->post('bio_num')," ");
        $fname = trim($this->input->post('fname')," ");
        $lname = trim($this->input->post('lname')," ");
        $address = trim($this->input->post('address')," ");
        $bday = trim($this->input->post('bday')," ");
        $contact_info = trim($this->input->post('contact_info')," ");
        $gender = trim($this->input->post('gender')," ");
        $sss_amount = trim($this->input->post('sss_amount')," ");
        $pagibig_amount = trim($this->input->post('pagibig_amount')," ");
        $philhealth_amount = trim($this->input->post('philhealth_amount')," ");
        $position = trim($this->input->post('position')," ");
        $schedule = trim($this->input->post('schedule')," ");
        $data = array(
            'employee_number'=>$bio_num,
            'firstname'=>$fname,
            'lastname'=>$lname,
            'address'=>$address,
            'birthdate'=>$bday,
            'contact_info'=>$contact_info,
            'gender'=>$gender,
            'sss_amount'=>$sss_amount,
            'pagibig_amount'=>$pagibig_amount,
            'philhealth_amount'=>$philhealth_amount,
            'position_id'=>$position,
            'schedule_id'=>$schedule,
        );
        $employee_id = $this->input->post('employee_id');
        if($this->super_model->update_where('employees', $data, 'employee_id', $employee_id)){
           echo "<script>alert('Successfully Updated!'); 
                window.location ='".base_url()."employees/employee_list'; </script>";
        }
    }

    public function update_photo(){
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
            'photo'=>$filename,
        );
        $employee_id = $this->input->post('employee_id');
        if($this->super_model->update_where('employees', $data, 'employee_id', $employee_id)){
            echo "<script>alert('Successfully Updated!'); 
                window.location ='".base_url()."employees/employee_list'; </script>";
        }
    }

    public function delete_employee(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('employees', 'employee_id', $id)){
            echo "<script>alert('Succesfully Deleted');
            window.location = '".base_url()."employees/employee_list'; </script>";
        }
    }

    public function overtime_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $data['employees']=$this->super_model->select_all_order_by("employees","firstname","ASC");
        $data['overtime']=$this->super_model->select_all_order_by("overtime","date_overtime","ASC");
        $this->load->view('employees/overtime_list',$data);
        $this->load->view('template/footer');
    }

    public function insert_overtime(){
        $employee_name = trim($this->input->post('employee_name')," ");
        $date = trim($this->input->post('date')," ");
        $num_min = trim($this->input->post('num_min')," ");
        $num_hr = trim($this->input->post('num_hr')," ") + ($num_min / 60);
        $rate = trim($this->input->post('rate')," ");
        $data = array(
            'employee_id'=>$employee_name,
            'date_overtime'=>$date,
            'hours'=>$num_hr,
            'rate'=>$rate,
        );
        if($this->super_model->insert_into("overtime", $data)){
           echo "<script>alert('Successfully Added!'); 
                window.location ='".base_url()."employees/overtime_list'; </script>";
        }
    }

    public function update_overtime(){
        $employee_name = trim($this->input->post('employee_name')," ");
        $date = trim($this->input->post('date')," ");
        $num_min = trim($this->input->post('num_min')," ");
        $num_hr = trim($this->input->post('num_hr')," ") + ($num_min / 60);
        $rate = trim($this->input->post('rate')," ");
        $data = array(
            'employee_id'=>$employee_name,
            'date_overtime'=>$date,
            'hours'=>$num_hr,
            'rate'=>$rate,
        );
        $overtime_id = $this->input->post('overtime_id');
        if($this->super_model->update_where('overtime', $data, 'overtime_id', $overtime_id)){
            echo "<script>alert('Successfully Updated!'); 
                window.location ='".base_url()."employees/overtime_list'; </script>";
        }
    }

    public function delete_overtime(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('overtime', 'overtime_id', $id)){
            echo "<script>alert('Succesfully Deleted');
            window.location = '".base_url()."employees/overtime_list'; </script>";
        }
    }

    public function get_name($employee_id){
        $firstname = $this->super_model->select_column_where("employees", "firstname", "employee_id", $employee_id);
        $lastname = $this->super_model->select_column_where("employees", "lastname", "employee_id", $employee_id);
        $fullname = $firstname." ".$lastname;
        return $fullname;
    }

    public function cashad_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $data['employees']=$this->super_model->select_all_order_by("employees","firstname","ASC");
        $data['cashadvance']=$this->super_model->select_all_order_by("cashadvance","date_advance","ASC");
        $this->load->view('employees/cashad_list',$data);
        $this->load->view('template/footer');
    }

    public function insert_cashad(){
        $employee_name = trim($this->input->post('employee_name')," ");
        $date = trim($this->input->post('date')," ");
        $amount = trim($this->input->post('amount')," ");
        $data = array(
            'employee_id'=>$employee_name,
            'date_advance'=>$date,
            'amount'=>$amount,
        );
        if($this->super_model->insert_into("cashadvance", $data)){
           echo "<script>alert('Successfully Added!'); 
                window.location ='".base_url()."employees/cashad_list'; </script>";
        }
    }

    public function update_cashad(){
        $employee_name = trim($this->input->post('employee_name')," ");
        $date = trim($this->input->post('date')," ");
        $amount = trim($this->input->post('amount')," ");
        $data = array(
            'employee_id'=>$employee_name,
            'date_advance'=>$date,
            'amount'=>$amount,
        );
        $cash_id = $this->input->post('cash_id');
        if($this->super_model->update_where('cashadvance', $data, 'cash_id', $cash_id)){
            echo "<script>alert('Successfully Updated!'); 
                window.location ='".base_url()."employees/cashad_list'; </script>";
        }
    }

    public function delete_cashad(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('cashadvance', 'cash_id', $id)){
            echo "<script>alert('Succesfully Deleted');
            window.location = '".base_url()."employees/cashad_list'; </script>";
        }
    }

    public function schedule_list(){
        $this->load->view('template/header');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $data['employees']=$this->super_model->select_all_order_by("employees","firstname","ASC");
        $data['schedules']=$this->super_model->select_all_order_by("schedules","time_in","ASC");
        $this->load->view('employees/schedule_list',$data);
        $this->load->view('template/footer');
    }

    public function insert_schedule(){
        $time_in = trim($this->input->post('time_in')," ");
        $time_out = trim($this->input->post('time_out')," ");
        $data = array(
            'time_in'=>$time_in,
            'time_out'=>$time_out,
        );
        if($this->super_model->insert_into("schedules", $data)){
           echo "<script>alert('Successfully Added!'); 
                window.location ='".base_url()."employees/schedule_list'; </script>";
        }
    }

    public function update_schedule(){
        $time_in = trim($this->input->post('time_in')," ");
        $time_out = trim($this->input->post('time_out')," ");
        $data = array(
            'time_in'=>$time_in,
            'time_out'=>$time_out,
        );
        $schedule_id = $this->input->post('schedule_id');
        if($this->super_model->update_where('schedules', $data, 'schedule_id', $schedule_id)){
            echo "<script>alert('Successfully Updated!'); 
                window.location ='".base_url()."employees/schedule_list'; </script>";
        }
    }

    public function delete_schedule(){
        $id=$this->uri->segment(3);
        if($this->super_model->delete_where('schedules', 'schedule_id', $id)){
            echo "<script>alert('Succesfully Deleted');
            window.location = '".base_url()."employees/schedule_list'; </script>";
        }
    }

    public function generateImport(){
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
        window.location.href ='<?php echo base_url(); ?>employees/import_list/<?php echo $from; ?>/<?php echo $to; ?>'</script> <?php
    }

    public function import_list(){
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
        $data['employees']=$this->super_model->select_all_order_by("employees","firstname","ASC");
        $data['import']=$this->super_model->custom_query("SELECT * FROM biometrics_attendance WHERE date BETWEEN '$from' AND '$to' ORDER BY date ASC, time_in ASC");
        $this->load->view('employees/import_list',$data);
        $this->load->view('template/footer');
    }

    public function upload_excel(){
        $dest= realpath(APPPATH . '../uploads/excel/');
        $error_ext=0;
        if(!empty($_FILES['csv']['name'])){
             $exc= basename($_FILES['csv']['name']);
             $exc=explode('.',$exc);
             $ext1=$exc[1];
            if($ext1=='php' || $ext1!='xlsx'){
                $error_ext++;
            } 
            else {
                $filename1='Attendance.'.$ext1;
                if(move_uploaded_file($_FILES["csv"]['tmp_name'], $dest.'/'.$filename1)){
                    $this->readExcel_import();
                }   
            }
        }
    }

    public function readExcel_import(){
        require_once(APPPATH.'../assets/dist/js/vendor/autoload.php');
        $inputFileName =realpath(APPPATH.'../uploads/excel/Attendance.xlsx');
        $objPHPExcel = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        try {
            $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
            $objPHPExcel = $reader->load($inputFileName);
        } catch(Exception $e) {
            die('Error loading file"'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }

        $objPHPExcel->setActiveSheetIndex(0);
        $highestRow = $objPHPExcel->getActiveSheet(1)->getHighestRow(); 
        // echo "<pre>";
        for($x=1;$x<=$highestRow;$x++){
            $bio_id = $objPHPExcel->getActiveSheet(1)->getCell('A'.$x)->getValue();
            $name = trim($objPHPExcel->getActiveSheet(1)->getCell('B'.$x)->getValue());
            $date = trim($objPHPExcel->getActiveSheet(1)->getCell('C'.$x)->getFormattedValue());
            $day = trim($objPHPExcel->getActiveSheet(1)->getCell('D'.$x)->getFormattedValue());
            $check_in = trim($objPHPExcel->getActiveSheet(1)->getCell('E'.$x)->getFormattedValue());
            $check_out = trim($objPHPExcel->getActiveSheet(1)->getCell('H'.$x)->getFormattedValue());
            $break_out = trim($objPHPExcel->getActiveSheet(1)->getCell('F'.$x)->getFormattedValue());
            $break_in = trim($objPHPExcel->getActiveSheet(1)->getCell('G'.$x)->getFormattedValue());
            $count=$this->super_model->count_custom_where("biometrics_attendance","biometric_num = '$bio_id' AND date = '$date'");
            
            if($count>0){
                
                $imp = $this->super_model->select_custom_where("biometrics_attendance","biometric_num = '$bio_id' AND date = '$date'");
                
               
                if(!isset($imp[0]))
                continue;
                $imp = $imp[0];
                $emp =$this->super_model->select_row_where("employees","employee_number",$bio_id);
                if(!isset($emp[0]))
                continue;
                $emp = $emp[0];
                $sched = $this->super_model->select_row_where("schedules","schedule_id",$emp->schedule_id);
                if(!isset($sched[0]))
                continue;
                $sched = $sched[0];
                if(strtotime($check_in) > strtotime($sched->time_in)){
                    $logstatus=0;
                }else {
                    $logstatus=1;
                }

                if(strtotime($sched->time_in) > strtotime($check_in)){
                    $time_in = $sched->time_in;
                }

                if(strtotime($sched->time_out) < strtotime($check_in)){
                    $time_out = $sched->time_out;
                }

                $date1 = $check_in;
                $date2 = $check_out;
                $timestamp1 = strtotime($date1);
                $timestamp2 = strtotime($date2);
                $int = abs($timestamp2 - $timestamp1)/(60*60);
                $data=array(
                    'biometric_num'=>$bio_id,
                    'employee_name'=>$name,
                    'date'=>$date,
                    'dtr_day'=>$day,
                    'time_in'=>$check_in,
                    'dtr_breakout'=>$break_out,
                    'dtr_breakin'=>$break_in,
                    'time_out'=>$check_out,
                    'employee_id'=>$emp->employee_id,
                    'status'=>$logstatus,
                    'num_hr'=>$int,
                );
                
                $this->super_model->update_where('biometrics_attendance', $data, 'bio_id', $imp->bio_id);
                    // echo "<script>alert('Successfully Updated!'); window.location = 'import_list';</script>";
                
            }else{
                $emp = $this->super_model->select_row_where("employees","employee_number",$bio_id);
                if(!isset($emp[0]))
                continue;
                $emp = $emp[0];
                $sched = $this->super_model->select_row_where("schedules","schedule_id",$emp->schedule_id);
                if(!isset($sched[0]))
                continue;
                $sched = $sched[0];
                if(strtotime($check_in) > strtotime($sched->time_in)){
                    $logstatus=0;
                }else {
                    $logstatus=1;
                }

                if(strtotime($sched->time_in) > strtotime($check_in)){
                    $time_in = $sched->time_in;
                }

                if(strtotime($sched->time_out) < strtotime($check_in)){
                    $time_out = $sched->time_out;
                }

                $date1 = $check_in;
                $date2 = $check_out;
                $timestamp1 = strtotime($date1);
                $timestamp2 = strtotime($date2);
                $int = abs($timestamp2 - $timestamp1)/(60*60);
                $data=array(
                    'biometric_num'=>$bio_id,
                    'employee_name'=>$name,
                    'date'=>$date,
                    'dtr_day'=>$day,
                    'time_in'=>$check_in,
                    'dtr_breakout'=>$break_out,
                    'dtr_breakin'=>$break_in,
                    'time_out'=>$check_out,
                    'employee_id'=>$emp->employee_id,
                    'status'=>$logstatus,
                    'num_hr'=>$int,
                );
                $this->super_model->insert_into("biometrics_attendance", $data);
                // print_r($data);
                // echo " \n\r";
                // continue;

                // echo "<script>alert('Successfully Uploaded!'); window.location = 'import_list';</script>";
            }
        }
                echo "<script>alert('Successfully Uploaded!'); window.location = 'import_list';</script>";
        
    }

    // public function readExcel_import(){
    //     require_once(APPPATH.'../assets/dist/js/phpexcel/Classes/PHPExcel/IOFactory.php');
    //     $objPHPExcel = new PHPExcel();
    //     $inputFileName =realpath(APPPATH.'../uploads/excel/Attendance.xlsx');
    //     try {
    //         $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    //         $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    //         $objPHPExcel = $objReader->load($inputFileName);
    //     } catch(Exception $e) {
    //         die('Error loading file"'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
    //     }

    //     $objPHPExcel->setActiveSheetIndex(0);
    //     $highestRow = $objPHPExcel->getActiveSheet(1)->getHighestRow(); 
    //     for($x=1;$x<=$highestRow;$x++){
    //         $bio_id = $objPHPExcel->getActiveSheet(1)->getCell('A'.$x)->getValue();
    //         $name = trim($objPHPExcel->getActiveSheet(1)->getCell('B'.$x)->getValue());
    //         $date = trim($objPHPExcel->getActiveSheet(1)->getCell('C'.$x)->getFormattedValue());
    //         $day = trim($objPHPExcel->getActiveSheet(1)->getCell('D'.$x)->getFormattedValue());
    //         $check_in = trim($objPHPExcel->getActiveSheet(1)->getCell('E'.$x)->getFormattedValue());
    //         $check_out = trim($objPHPExcel->getActiveSheet(1)->getCell('H'.$x)->getFormattedValue());
    //         $break_out = trim($objPHPExcel->getActiveSheet(1)->getCell('F'.$x)->getFormattedValue());
    //         $break_in = trim($objPHPExcel->getActiveSheet(1)->getCell('G'.$x)->getFormattedValue());
    //         $count=$this->super_model->count_custom_where("biometrics_attendance","biometric_num = '$bio_id' AND date = '$date' AND time_in = '$check_in'");
    //         if($count>0){
    //             foreach($this->super_model->select_custom_where("biometrics_attendance","biometric_num = '$bio_id' AND date = '$date' AND time_in = '$check_in'") AS $imp){
                
    //                 foreach($this->super_model->select_row_where("employees","employee_number",$bio_id) AS $emp){
    //                     foreach($this->super_model->select_row_where("schedules","schedule_id",$emp->schedule_id) AS $sched){
    //                         if($check_in > $sched->time_in){
    //                             $logstatus=0;
    //                         }else {
    //                             $logstatus=1;
    //                         }

    //                         if($sched->time_in > $check_in){
    //                             $time_in = $sched->time_in;
    //                         }

    //                         if($sched->time_out < $check_in){
    //                             $time_out = $sched->time_out;
    //                         }

    //                         $date1 = $check_in;
    //                         $date2 = $check_out;
    //                         $timestamp1 = strtotime($date1);
    //                         $timestamp2 = strtotime($date2);
    //                         $int = abs($timestamp2 - $timestamp1)/(60*60);
    //                         $data=array(
    //                             'biometric_num'=>$bio_id,
    //                             'employee_name'=>$name,
    //                             'date'=>$date,
    //                             'dtr_day'=>$day,
    //                             'time_in'=>$check_in,
    //                             'dtr_breakout'=>$break_out,
    //                             'dtr_breakin'=>$break_in,
    //                             'time_out'=>$check_out,
    //                             'employee_id'=>$emp->employee_id,
    //                             'status'=>$logstatus,
    //                             'num_hr'=>$int,
    //                         );
    //                         $this->super_model->update_where('biometrics_attendance', $data, 'bio_id', $imp->bio_id);
    //                     }
    //                 }
    //                 echo "<script>alert('Successfully Updated!'); window.location = 'import_list';</script>";
    //             }
    //         }else{
    //             foreach($this->super_model->select_row_where("employees","employee_number",$bio_id) AS $emp){
    //                 foreach($this->super_model->select_row_where("schedules","schedule_id",$emp->schedule_id) AS $sched){
    //                     if($check_in > $sched->time_in){
    //                         $logstatus=0;
    //                     }else {
    //                         $logstatus=1;
    //                     }

    //                     if($sched->time_in > $check_in){
    //                         $time_in = $sched->time_in;
    //                     }

    //                     if($sched->time_out < $check_in){
    //                         $time_out = $sched->time_out;
    //                     }

    //                     $date1 = $check_in;
    //                     $date2 = $check_out;
    //                     $timestamp1 = strtotime($date1);
    //                     $timestamp2 = strtotime($date2);
    //                     $int = abs($timestamp2 - $timestamp1)/(60*60);
    //                     $data=array(
    //                         'biometric_num'=>$bio_id,
    //                         'employee_name'=>$name,
    //                         'date'=>$date,
    //                         'dtr_day'=>$day,
    //                         'time_in'=>$check_in,
    //                         'dtr_breakout'=>$break_out,
    //                         'dtr_breakin'=>$break_in,
    //                         'time_out'=>$check_out,
    //                         'employee_id'=>$emp->employee_id,
    //                         'status'=>$logstatus,
    //                         'num_hr'=>$int,
    //                     );
    //                     $this->super_model->insert_into("biometrics_attendance", $data);
    //                 }
    //             }
    //             echo "<script>alert('Successfully Uploaded!'); window.location = 'import_list';</script>";
    //         }
    //     }
    // }

    public function get_empnum($employee_id){
        $empnum = $this->super_model->select_column_where("employees", "employee_number", "employee_id", $employee_id);
        return $empnum;
    }

}