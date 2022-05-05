<?php 
    $ci =& get_instance();  
    $user_id = $_SESSION['user_id'];
?>
<style type="text/css">
    .modaling{
        padding-right: 450px!important; 
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
                <h4 class="text-themecolor">Delivery</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url("users/dashboard/") ?>">Home</a></li>
                        <li class="breadcrumb-item active">Delivery</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="modal" id="receipt" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> -->
                    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>users/add_order">
                        <div class="modal-body" id="modalview"></div>  
                    </form>                                      
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card oh">
                    <div class="card-body">
                        <form id="form-wizard" class="form-horizontal" method="post" action="<?php echo base_url(); ?>users/add_order_tmp" onsubmit="return confirm('Do you really want to submit the reservation?');">
                            <div id="form-wizard-1" class="step">
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
                            <center>
                                <div class="form-actions">
                                    <input name="delivery_id" id = "delivery_id" type="hidden" value="<?php echo $id;?>">
                                    <input name="user_id" id = "user_id" type="hidden" value="<?php echo $user_id;?>">
                                    <input name="baseurl" id = "baseurl" type="hidden" value="<?php echo base_url();?>">
                                    <input id="next" class="btn btn-primary" name="submit" type="button" value="Submit" />
                                </div>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function OpenModal(){
        var delivery_id = document.getElementById("delivery_id").value;
        var loc= document.getElementById("baseurl").value;
        var redirect1=loc+'users/fetch_modal_delivery/';
        $.ajax({
              url: redirect1,
              type: 'POST',
              data: 'id='+delivery_id,
            success:function(data){
               $("#modalview").html(data);
            },
        })
    }

    $( document ).ready(function() {
        $(document).on('click', '#next', function(e){
            var receipt_data = $("#form-wizard").serialize();
            var loc= document.getElementById("baseurl").value;
            var redirect = loc+'users/add_order_tmp/';
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
        });
    });
</script>