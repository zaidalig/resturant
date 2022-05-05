<!-- Required Jquery -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets_user/js/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets_user/js/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets_user/js/popper.js/popper.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets_user/js/bootstrap/js/bootstrap.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets_user/js/jquery-slimscroll/jquery.slimscroll.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets_user/js/modernizr/css-scrollbars.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets_user/js/modernizr/modernizr.js"></script>
<!-- am chart -->
<script src="<?php echo base_url(); ?>assets_user/pages/widget/amchart/amcharts.min.js"></script>
<script src="<?php echo base_url(); ?>assets_user/pages/widget/amchart/serial.min.js"></script>
<!-- Chart js -->
<script src="<?php echo base_url(); ?>assets_user/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>assets_user/bower_components/morris.js/morris.min.js"></script>
<!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets_user/js/chart.js/Chart.js"></script> -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets_user/bower_components/chart.js/Chart.js"></script>
<!-- Todo js -->
<script type="text/javascript " src="<?php echo base_url(); ?>assets_user/pages/todo/todo.js "></script>
<!-- Custom js -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets_user/pages/dashboard/custom-dashboard.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets_user/js/script.js"></script>
<script type="text/javascript " src="<?php echo base_url(); ?>assets_user/js/SmoothScroll.js"></script>
<script src="<?php echo base_url(); ?>assets_user/js/pcoded.min.js"></script>
<script src="<?php echo base_url(); ?>assets_user/js/vartical-demo.js"></script>
<script src="<?php echo base_url(); ?>assets_user/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/node_modules/popper/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/fullcalendar.js"></script>
<!-- ChartJS -->
<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
    $(document).ready(function(){
        $('#myTable').DataTable({
            "lengthMenu": [[20, 35, 50, -1], [20, 35, 50, "All"]]
        });
    });

    $(document).ready(function(){
        $('#delivery_tab').DataTable({
            "lengthMenu": [[20, 35, 50, -1], [20, 35, 50, "All"]],
            "order":[0, "desc"],
        });
    });
    function goPage (newURL) {

        // if url is empty, skip the menu dividers and reset the menu selection to default
        if (newURL != "") {
            // if url is "-", it is this page -- reset the menu:
            if (newURL == "-" ) {
                resetMenu();            
            } 
            // else, send page to designated URL            
            else {  
                document.location.href = newURL;
            }
        }
    }

    // resets the menu selection upon entry to this page:
    function resetMenu() {
       document.gomenu.selector.selectedIndex = 2;
    }

    $(document).ready(function() {      
        var loc= document.getElementById("baseurl").value;
        var redirect = loc+'users/calendar_data';
        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },          
            navLinks: true, // can click day/week names to navigate views
            editable: true,
            eventLimit: true,
            events: redirect, 
            eventRender: function(event,element){
                element.popover({
                    content: event.description,
                    trigger: 'hover',
                    placement: 'top',
                    container: 'body'
                });
               // alert(event.description);
               $('#reservation_list').modal('show');
            },
            error: function() {
                alert('There was an error while fetching events.');
            }
            
        });
    });
    
    $(document).on("click", "#upHut", function () {
        var hut_id = $(this).attr("data-id");
        var hut_name = $(this).attr("data-name");
        var hut_img = $(this).attr("data-img");
        $("#hut_id").val(hut_id);
        $("#hut_name").val(hut_name);
        $("#hut_img").val(hut_img);
    });

    $(document).on("click", "#upTable", function () {
        var table_id = $(this).attr("data-id");
        var table_no = $(this).attr("data-name");
        var table_img = $(this).attr("data-img");
        $("#table_id").val(table_id);
        $("#table_no").val(table_no);
        $("#table_img").val(table_img);
    });

    $(document).on("click", "#upMenu", function () {
        var menu_id = $(this).attr("data-id");
        var menu_category = $(this).attr("data-menucat");
        var menu_name = $(this).attr("data-name");
        var menu_price = $(this).attr("data-price");
        var menu_desc = $(this).attr("data-desc");
        var menu_img = $(this).attr("data-img");
        $("#menu_id").val(menu_id);
        $("#menu_category").val(menu_category);
        $("#menu_name").val(menu_name);
        $("#menu_price").val(menu_price);
        $("#menu_desc").val(menu_desc);
        $("#menu_img").val(menu_img);
    });

    $(document).on("click", "#upPosition", function () {
        var position_id = $(this).attr("data-id");
        var position_name = $(this).attr("data-name");
        var rate = $(this).attr("data-rate");
        $("#position_id").val(position_id);
        $("#position_name").val(position_name);
        $("#rate").val(rate);
    });

    $(document).on("click", "#upCat", function () {
        var menucat_id = $(this).attr("data-id");
        var menu_category = $(this).attr("data-name");
        var menu_selection = $(this).attr("data-sel");
        $("#menucat_id").val(menucat_id);
        $("#menu_category").val(menu_category);
        $("#menu_selection").val(menu_selection);
    });

    $(document).on("click", "#upSel", function () {
        var menusel_id = $(this).attr("data-id");
        var menu_selection = $(this).attr("data-name");
        $("#menusel_id").val(menusel_id);
        $("#menu_selection").val(menu_selection);
    });

    $(document).on("click", "#img", function () {
        var employee_id = $(this).attr("data-id");
        $("#employee_id").val(employee_id);
    });

    $(document).on("click", "#upOv", function () {
        var overtime_id = $(this).attr("data-id");
        var date = $(this).attr("data-date");
        var employee_name = $(this).attr("data-emp");
        var num_hr = $(this).attr("data-hours");
        var rate = $(this).attr("data-rate");
        var time = num_hr;
        var split = time.split('.');
        var hour = split[0];
        var min = '.'+split[1];
        min = min * 60;
        console.log(min);
        $("#overtime_id").val(overtime_id);
        $("#date").val(date);
        $("#employee_name").val(employee_name);
        $("#num_hr").val(hour);
        $("#num_min").val(min);
        $("#rate").val(rate);
    });

    $( document ).ready(function() {
        $(document).on('click', '#upEmp', function(e){
            e.preventDefault();
            var uid = $(this).data('id');    
            var loc= document.getElementById("baseurl").value;
            var redirect1=loc+'employees/fetch_emp_update';
            $.ajax({
                  url: redirect1,
                  type: 'POST',
                  data: 'id='+uid,
                beforeSend:function(){
                    $("#employ").html('Please wait ..');
                },
                success:function(data){
                   $("#employ").html(data);
                },
            })
        });
    });

    $(document).on("click", "#upCh", function () {
        var cash_id = $(this).attr("data-id");
        var employee_name = $(this).attr("data-emp");
        var date = $(this).attr("data-date");
        var amount = $(this).attr("data-amount");
        $("#cash_id").val(cash_id);
        $("#employee_name").val(employee_name);
        $("#date").val(date);
        $("#amount").val(amount);
    });

    $(document).on("click", "#upSch", function () {
        var schedule_id = $(this).attr("data-id");
        var time_in = $(this).attr("data-in");
        var time_out = $(this).attr("data-out");
        $("#schedule_id").val(schedule_id);
        $("#time_in").val(time_in);
        $("#time_out").val(time_out);
    });

    $(document).on("click", "#upSched", function () {
        var employee_id = $(this).attr("data-id");
        var schedule_id = $(this).attr("data-name");
        $("#employee_id").val(employee_id);
        $("#schedule").val(schedule_id);
    });

    $(document).on("click", "#menuimg", function () {
        var menu_id = $(this).attr("data-id");
        $("#menu_idimg").val(menu_id);
    });

    $(document).on("click", "#tableimg", function () {
        var table_id = $(this).attr("data-id");
        $("#table_imgid").val(table_id);
    });

    $(document).on("click", "#hutimg", function () {
        var hut_id = $(this).attr("data-id");
        $("#hut_imgid").val(hut_id);
    });

    function confirmationDelete(anchor){
        var conf = confirm('Are you sure you want to delete this record?');
        if(conf)
        window.location=anchor.attr("href");
    }

    function isNumberKey(txt, evt){
       var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode == 46) {
            //Check if the text already contains the . character
            if (txt.value.indexOf('.') === -1) {
                return true;
            } else {
                return false;
            }
        } else {
            if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        }
        return true;
    }
</script>
<script type="text/javascript">
    function alertDelivery(){
        var loc= "<?php echo base_url() ?>";
        var redirect1=loc+'masterfile/fetch_deliveries/';
        $.ajax({
              url: redirect1,
              type: 'POST',
              dataType: 'json',
            success:function(response){
                var current_count = $('#delivery_count').text()
                console.log(response.count,current_count)
                if(response.count != current_count){
                    if (response.count > 0) {
                        $("#delivery_count").text(response.count);
                    } else {
                        $("#delivery_count").hide();
                    }
                    var conf = confirm(response.alert);
                    if(conf==true){
                        document.location=loc+'masterfile/delivery_list/';
                    }
                }
            },
        })
    }
    $(function(){
        alertDelivery();
        setInterval(function(){
            alertDelivery();
        }, 20000);
    })
</script>
</body>
</html>