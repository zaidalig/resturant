<script src="<?php echo base_url(); ?>assets/dist/js/jquery.js"></script>
<?php 
    $ci =& get_instance();  
?>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <!-- <h4 class="text-themecolor">Employee List</h4> -->
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>masterfile/dashboard/">Home</a></li>
                        <li class="breadcrumb-item active">Reservations</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Reservations</h4>
                        <div class="table-responsive">
                            <table class="table table-borderless table-striped table-earning table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Room Number</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Orders</th>
                                    </tr>
                                </thead>
                                <?php 
                                    foreach($reserve as $res){ 
                                        $me = explode(",", $res['menu']);               
                                        $count = count($me)-1;
                                        $men='';
                                        for($x=0;$x<$count;$x++){
                                            $men.= "<b>- ".$ci->get_menu($me[$x]). "</b><br>";
                                        } 
                                        $menu = substr($men, 0, -2);
                                ?>
                                    <tr>
                                        <td><?php echo $res['room_no'];?></td>
                                        <td><?php echo $res['start_date'];?></td>
                                        <td><?php echo $res['end_date'];?></td>
                                        <td><?php echo $menu; ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>