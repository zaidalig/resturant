<?php 
    $ci =& get_instance();  
    $user_id = $_SESSION['user_id'];
?>
<style type="text/css">
    .modaling{
        padding-right: 450px!important; 
    }
    body{
        background-image: url(../../assets/img/seafood2.png)!important;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }
    label, table tr td{
        color: #fff
    }

    .txtwhite{
        color:#000!important;
    }

    .bordertab {
        border: 1px solid #000!important;
    }

    .border-btm{
        border-bottom: 1px solid #000;
    }

    .bor-btm{border-top:#000}
</style>
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Reservation</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url("users/dashboard/") ?>">Home</a></li>
                        <li class="breadcrumb-item active">Reservation</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="modal" id="receipt" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Reservation List</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> -->
                    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>users/add_reservations" onsubmit="return confirm('Do you really want to submit the reservation?');">
                        <div class="modal-body" id="modalview"></div>  
                    </form>                                      
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card oh">
                    <div class="card-body">
                        <form id="form-wizard" class="form-horizontal" method="post" >
                            <div id="form-wizard-1" class="step">
                                <div class="d-flex m-b-30 align-items-center no-block">
                                    <h5 class="card-title "><b>HUT RESERVATIONS</b></h5>
                                </div>
                                <div class="d-flex m-b-30 align-items-center no-block">
                                    <table width="100%">
                                        <tr>
                                            <td width="8%"></td>
                                            <td width="5%"><label>Start Date:</label></td>
                                            <td width="20%"> <input type="date" name= "start" class = "form-control" required=""></td>
                                            <td width="3%"></td>
                                            <td width="5%"><label>End Date:</label></td>
                                            <td width="20%"> <input type="date" name= "end" class = "form-control" required=""></td>
                                            <td width="2%"></td>
                                            <td width="10%"></td>
                                        </tr>         
                                    </table>
                                </div>
                                <?php if(!empty($hut)){ ?>
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Hut Number:</label>
                                    <table class="table table-bordered shadow" id="item_table">
                                        <thead>
                                            <tr>
                                                <td align="center"><b>#</b></td>
                                                <td align="center"><b>Hut Name</b></td>
                                                <td align="center"><b>Hut Image</b></td>
                                            </tr>                               
                                        </thead>
                                        <tbody>
                                            <?php foreach($hut AS $h){ ?>
                                            <tr>
                                                <td align="center"><input type="checkbox" id="hut_id" name="hut_id[]" value= "<?php echo $h->hut_id; ?>"></td>
                                                <td align="center"><?php echo $h->hut_name; ?></td>
                                                <td align="center"><img style = "width:180px;border-radius:10px;box-shadow: 0px 0px 10px 5px #aeaeae;" src="<?php echo is_file("uploads/{$h->hut_image}")? base_url("uploads/{$h->hut_image}") : base_url("uploads/default/no-image-available.png") ?>" alt="your image" /></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php }else { ?>
                                    <h1><center><b>Huts Are Fully Booked!<br><span class="fa fa-warning animated pulse infinite m-t-50" style ="font-size:200px;color:#ff3737"></span></b></center></h1>
                                <?php } ?>
                            </div>
                            <div id="form-wizard-2" class="step">
                                <div class="d-flex m-b-30 align-items-center no-block">
                                    <h5 class="card-title "><b>FOOD RESERVATIONS</b></h5>
                                </div>
                                <div class="widget-box">
                                    <div class="widget-title">
                                        <ul class="nav nav-tabs">
                                            <?php foreach($menu AS $men){ ?>
                                                <li class="active"><a data-toggle="tab" id = "Url" href="#tab1"  data-id = '<?php echo $men['menusel_id']; ?>'><?php echo $men['menu_selection'];?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <div class="widget-content tab-content">
                                        <div id="tab1" class="tab-pane active">
                                            <div id ="foodmenu"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="form-wizard-3" class="step">
                                <div class="d-flex m-b-30 align-items-center no-block">
                                    <h5 class="card-title "><b>TABLE RESERVATIONS</b></h5>
                                </div>
                                <?php if(!empty($tables)){ ?>
                                <table class="table table-bordered shadow" id="item_table">
                                    <thead>
                                        <tr>
                                            <td align="center"><b>#</b></td>
                                            <td align="center"><b>Table Number</b></td>
                                            <td align="center"><b>Table Image</b></td>
                                        </tr>                               
                                    </thead>
                                    <tbody>
                                        <?php foreach($tables AS $t){ ?>
                                        <tr>
                                            <td align="center"><input type="checkbox" id="table" name="table[]" value= "<?php echo $t['table_id']; ?>"></td>
                                            <td align="center"><?php echo $t['table_no']; ?></td>
                                            <td align="center"><img style = "width:180px;border-radius:10px;box-shadow: 0px 0px 10px 5px #aeaeae;" src="<?php echo is_file("uploads/{$t['table_img']}")? base_url("uploads/{$t['table_img']}") : base_url("uploads/default/no-image-available.png") ?>" alt="your image" /></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <?php }else { ?>
                                    <h1><center><b>Tables Are Fully Occupied!<br><span class="fa fa-warning animated pulse infinite m-t-50" style ="font-size:200px;color:#ff3737"></span></b></center></h1>
                                <?php } ?>
                            </div>
                            <br>
                            <center>
                                <div class="form-actions">
                                    <input name="user_id" id = "user_id" type="hidden" value="<?php echo $user_id;?>">
                                    <input type ="hidden" name="reservation_id" id = "reservation_id">
                                    <input name="baseurl" id = "baseurl" type="hidden" value="<?php echo base_url();?>">
                                    <input id="back" class="btn btn-info" type="reset" value="Back" />
                                    <input id="next" class="btn btn-primary" name="submit" type="button" value="Next" />
                                    <div id="status"></div>
                                </div>
                            </center>
                            <div id="submitted"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function OpenModal(){
        var reservation_id = document.getElementById("reservation_id").value;
        var loc= document.getElementById("baseurl").value;
        var redirect1=loc+'users/fetch_modal/';
        $.ajax({
              url: redirect1,
              type: 'POST',
              data: 'id='+reservation_id,
            success:function(data){
               $("#modalview").html(data);
            },
        })
    }

    $( document ).ready(function() {
        $(document).on('click', '#next', function(e){
            var receipt_data = $("#form-wizard").serialize();
            var loc= document.getElementById("baseurl").value;
            var redirect = loc+'users/add_reservations_tmp/';
            $.ajax({
                type: "POST",
                url: redirect,
                data: receipt_data,
                success: function(output){
                    $('#reservation_id').val(output);
                    OpenModal();
                    $('#receipt').modal('show');
                }
            });  
        });
    });

    $( document ).ready(function() {
        $(document).on('click', '#Url', function(e){
            e.preventDefault();
            var url = $(this).data('id');    
            var loc= document.getElementById("baseurl").value;
            var redirect1=loc+'users/fetch_order/';
            $.ajax({
                  url: redirect1,
                  type: 'POST',
                  data: 'id='+url,
                success:function(data){
                   $("#foodmenu").append(data);
                },
            })
            /*$.ajaxSetup ({
                cache:false
            });

            $("#tab1").load(redirect1);*/
        });
    });
</script>