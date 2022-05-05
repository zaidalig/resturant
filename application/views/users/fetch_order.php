<br>
<table class="table table-bordered shadow">
    <thead>
        <tr>
            <td align="center" colspan="12"><b><?php echo $menu_selection; ?></b></td>
        </tr>                               
    </thead>
    <tbody>
        <?php if(!empty($menu_category)){ foreach($menu_category AS $cat){ ?>
        <tr style="background:#f9e065">
            <td align="center" colspan="12" style="color:#000"><b><?php echo $cat['menu_category']; ?></b></td>                                                               
        </tr>
        <?php 
            foreach($menu_list AS $sub){ 
                switch($sub){
                    case($cat['menucat_id'] == $sub->menucat_id): 
        ?>
        <tr>
            <td align="center"><input type="checkbox" name="check[]" value="<?php echo $sub->menu_id; ?>"></td>
            <td align="center"><input type="text" name="qty_<?php echo $sub->menu_id; ?>" placeholder="Quantity"></td>
            <td><?php echo $sub->menu_name;?></td>
            <td style = "text-indent:30px;"><?php echo $sub->menu_price;?></td>    
            <td><?php echo $sub->menu_desc;?></td>
            <td align="center">
                <img style = "width:180px;border-radius:10px;box-shadow: 0px 0px 10px 5px #aeaeae;" src="<?php echo is_file("uploads/{$sub->menu_img}") ? base_url("uploads/{$sub->menu_img}") : base_url("uploads/default/no-image-available.png") ?>" alt="image" />
            </td>
        </tr>
        <?php   
            break;
            default: 
            } } } }
        ?>
    </tbody>
</table>
<!-- <script type="text/javascript">
    $(document).ready(function() {
        var boxes = document.querySelectorAll("input[name='check[]']");
        for(var x = 0;x< boxes.length;x++){
            var box = boxes[x];
            if(box.hasAttribute("value")){
                setupBox(box);
            }
        }

        function setupBox(box){
            var storageId = box.getAttribute("value");
            var oldVal = localStorage.getItem(storageId);
            box.checked = oldVal === "true" ? true : false;
            box.addEventListener("change", function() {
                localStorage.setItem(storageId, this.checked);
            });
        }

        $('#next').on('click', function(){ 
            var next= document.getElementById("next").value;
            if(next=='Submit'){
                localStorage.clear();
            }
        });
    });
</script> -->