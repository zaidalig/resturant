<table style="border: 0px solid #000;" width="100%">
    <tr>
        <td class="txtwhite" colspan="5"><center>ORDER SLIP</center><br></td>
    </tr>
    <tr>
        <td class="txtwhite" width="20%"></td>
        <td class="txtwhite" width="20%"></td>
        <td class="txtwhite" width="20%"></td>
        <td class="txtwhite" width="20%"></td>
        <td class="txtwhite" width="20%"></td>
    </tr>
    <tr>
        <td class="txtwhite border-btm" colspan="2"></td>
        <td class="txtwhite "></td>
        <td class="txtwhite border-btm" colspan="2" align="center"><?php echo date('F d, Y'); ?></td>
    </tr>
    <tr>
        <td class="txtwhite " colspan="2" align="center">Waiter</td>
        <td class="txtwhite"></td>
        <td class="txtwhite" colspan="2" align="center">Date</td>
    </tr>
    <tr>
        <td colspan="5"><br></td>
    </tr>
    <tr>
        <td class="txtwhite"></td>
        <td class="txtwhite"></td>
        <td class="txtwhite"></td>
        <td class="txtwhite"></td>
        <td class="txtwhite"></td>
    </tr>
    <tr>
        <td class="txtwhite border-btm" colspan="2"></td>
        <td class="txtwhite "></td>
        <td class="txtwhite border-btm" colspan="2"></td>
    </tr>
    <tr>
        <td class="txtwhite " colspan="2" align="center">Table No.</td>
        <td class="txtwhite"></td>
        <td class="txtwhite" colspan="2" align="center">Hut No.</td>
    </tr>
    <tr>
        <td class="txtwhite" colspan="3"><br></td>
        <td class="txtwhite border-btm" colspan="2"></td>
    </tr>
    <tr>
        <td class="txtwhite " colspan="3"></td>
        <td class="txtwhite" colspan="2" align="center">No.</td>
    </tr>
    <tr>
        <td class="txtwhite bordertab" align="center">QTY</td>
        <td class="txtwhite bordertab" colspan="3" align="center">DESCRIPTION</td>
        <td class="txtwhite bordertab" align="center">PRICE</td>
    </tr>
    <?php 
        if(!empty($reserve)){ 
            foreach($reserve AS $res){ 
                $price[] = $res['price'];
    ?>
    <tr>
        <td class="txtwhite bordertab"><?php echo $res['qty']; ?></td>
        <td class="txtwhite bordertab" colspan="3"><?php echo $res['menu']; ?></td>
        <td class="txtwhite bordertab"><?php echo $res['price']; ?></td>
    </tr>
    <?php } }  $grtotal =array_sum($price); ?>
    <tr>
        <td class="txtwhite bordertab"><br></td>
        <td class="txtwhite bordertab" colspan="3" style="text-align: right">Total: </td>
        <td class="txtwhite bordertab"><?php echo number_format($grtotal,2); ?></td>
    </tr>
    
</table>
<br>
<div class="btn-group btn-block">
    <input type ="hidden" name="delivery_id" value ="<?php echo $delivery_id; ?>">
    <input type ="submit" class="btn btn-danger btn-md" style="width:50%" name="cancel" value ="Cancel" onclick="return confirm('Are you sure you want to cancel orders?');">
    <input type ="submit" class="btn btn-primary btn-md" style="width:50%" name="save" value ="Save" onclick="return confirm('Do you really want to submit the order?');">
</div>