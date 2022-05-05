        <!-- <footer class="footer">
            © 2018 Elegent Admin by wrappixel.com
        </footer> -->
    </div>
    

    <!-- <script src="<?php echo base_url(); ?>assets/dist/js/jquery.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/node_modules/popper/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/waves.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/sidebarmenu.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/custom.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/node_modules/raphael/raphael-min.js"></script>
    <script src="<?php echo base_url(); ?>assets/node_modules/morrisjs/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/node_modules/d3/d3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/node_modules/c3-master/c3.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/dist/js/jquery-1.11.1.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/fullcalendar.js"></script>
    <!-- <script src="dist/js/dashboard1.js"></script> -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#myTable').DataTable({
                "order":[0, "desc"],
                "lengthMenu": [[50, 70, 100, -1], [50, 70, 100, "All"]]
            });
        });

        $(document).ready(function(){
            $('#prior').DataTable({
                "lengthMenu": false
            });
        });
    </script>
    <script type="text/javascript">
        function confirmationDelete(anchor){
            var conf = confirm('Are you sure you want to delete this record?');
            if(conf)
            window.location=anchor.attr("href");
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

        function imageUpdate() {
            var image = $('select#image option:selected').attr('mytag')
            //alert(image);
            //var image = $("select#image").val();
            var path = "<?php echo base_url(); ?>uploads/";
            var src = $("img.imageNews").attr({
                src: path + image,
                title: "Image",
                alt: "Image"
            });
        }

        var acc = document.getElementsByClassName("accordion1");
        var i;

        for (i = 0; i < acc.length; i++) {
          acc[i].addEventListener("click", function() {
            this.classList.toggle("active1");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
              panel.style.maxHeight = null;
            } else {
              panel.style.maxHeight = panel.scrollHeight + "px";
            }
          });
        }

        $(document).on("click", "#upRoom", function () {
            var room_id = $(this).attr("data-id");
            var room_no = $(this).attr("data-name");
            var room_img = $(this).attr("data-img");
            $("#room_id").val(room_id);
            $("#room_no").val(room_no);
            $("#room_img").val(room_img);
        });

        $(document).on("click", "#upMenu", function () {
            var menu_id = $(this).attr("data-id");
            var menu_name = $(this).attr("data-name");
            var menu_price = $(this).attr("data-price");
            var menu_desc = $(this).attr("data-desc");
            var menu_img = $(this).attr("data-img");
            $("#menu_id").val(menu_id);
            $("#menu_name").val(menu_name);
            $("#menu_price").val(menu_price);
            $("#menu_desc").val(menu_desc);
            $("#menu_img").val(menu_img);
        });
    </script>

</body>

</html>