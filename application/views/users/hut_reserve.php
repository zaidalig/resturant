<?php 
    $ci =& get_instance();  
?>
<style type="text/css">
    .modaling{
        padding-right: 450px!important; 
    }
</style>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Hut Reservation</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url("users/dashboard/") ?>">Home</a></li>
                        <li class="breadcrumb-item active">Hut Reservation</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="modal fade" id="reserveModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Add New Reservation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action = "<?php echo base_url(); ?>users/add_reservations">
                            <?php if(!empty($hut)){ ?>
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Hut Number:</label>
                                    <select name="hut_name" class="form-control bor-radius5" id="image" onChange="imageUpdate();" required>
                                        <option value = "">--Select Hut--</option>
                                        <?php foreach($hut AS $h){ ?>
                                        <option value = "<?php echo $h->hut_id; ?>" myTag="<?php echo $h->hut_image;?>"><?php echo $h->hut_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <!--<div class="form-group">
                                    <div class="thumbnail" style="width: 150px">
                                        <img class="imageNews"  />
                                    </div>                       
                                </div>-->
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Start Date:</label>
                                    <input name="start" type="date" class="form-control bor-radius5" placeholder="" required>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">End Date:</label>
                                    <input name="end" type="date" class="form-control bor-radius5" placeholder="" required>
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-info btn-block" value ="Submit">
                                </div>
                            <?php }else { ?>
                                <h1><center><b>Fully Booked!<br><span class="fa fa-warning animated pulse infinite m-t-50" style ="font-size:200px;color:#ff3737"></span></b></center></h1>
                            <?php } ?>
                            <input type="hidden" name="baseurl" id="baseurl" value ="<?php echo base_url(); ?>">
                        </form>
                    </div>                                        
                </div>
            </div>
        </div>
        <div class="modal fade" id="reservation_list" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Reservation List</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-borderless table-striped table-earning table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Hut Number</th>
                                        <th>Table Number</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                    </tr>
                                </thead>
                                <?php 
                                    foreach($reserve as $res){ 
                                        /*$tabs = explode(",", $res['table_id']);  
                                                     
                                        $count = count($tabs);
                                        $tab='';
                                        for($x=0;$x<$count;$x++){
                                            $tab.= $ci->get_table($tabs[$x]). ", ";
                                        } 
                                        $table = substr($tab, 0, -2);*/
                                ?>
                                    <tr>
                                        <td><?php echo $res['hut_no'];?></td>
                                        <td><?php echo $res['table_no'];?></td>
                                        <td><?php echo $res['start_date'];?></td>
                                        <td><?php echo $res['end_date'];?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>                                        
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card oh">
                    <div class="card-body">
                        <div class="d-flex m-b-30 align-items-center no-block">
                            <h5 class="card-title "><b>RESERVATIONS</b></h5>
                            <div class="ml-auto">
                                <ul class="list-inline font-12">
                                    <!-- <li><a data-toggle="modal" data-target="#reserveModal" class = "btn btn-primary" style="color:white"><i class = "fa fa-plus"></i> Create Reservation</a></li> -->
                                    <li><a href="<?php echo base_url(); ?>users/reserve_order/" target='_blank' class = "btn btn-primary" style="color:white"><i class = "fa fa-plus"></i> Create Reservation</a></li>
                                </ul>
                            </div>
                        </div>
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>