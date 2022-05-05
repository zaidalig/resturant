<?php foreach($employeee AS $em){ ?>
    <div class="row">
        <div class="col-md-6">
            <label for="" class="control-label mb-1">Biometric No.:</label>
            <input id="bio_num" name="bio_num" type="text" class="form-control bor-radius5" value="<?php echo $em['employee_number']; ?>">
            <label for="" class="control-label mb-1">Firstname:</label>
            <input id="fname" name="fname" type="text" class="form-control bor-radius5" value="<?php echo $em['firstname']; ?>">
            <label for="" class="control-label mb-1">Lastname:</label>
            <input id="lname" name="lname" type="text" class="form-control bor-radius5" value="<?php echo $em['lastname']; ?>">
            <label for="" class="control-label mb-1">Address:</label>
            <input id="address" name="address" type="text" class="form-control bor-radius5" value="<?php echo $em['address']; ?>">
            <label for="" class="control-label mb-1">Birthdate:</label>
            <input id="bday" name="bday" type="text" class="form-control bor-radius5" value="<?php echo $em['birthdate']; ?>">
            <label for="" class="control-label mb-1">Contact Info:</label>
            <input id="contact_info" name="contact_info" type="text" class="form-control bor-radius5" value="<?php echo $em['contact_info']; ?>">
            <label for="" class="control-label mb-1">Gender:</label>
            <select class="form-control bor-radius5" name="gender" id="gender">
                <option value="">- Select Gender -</option>
                <option value="Male" <?php echo (($em['gender'] == 'Male') ? ' selected' : '');?>>Male</option>
                <option value="Female" <?php echo (($em['gender'] == 'Female') ? ' selected' : '');?>>Female</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="" class="control-label mb-1">SSS Deduction:</label>
            <input id="sss_amount" name="sss_amount" type="text" class="form-control bor-radius5" value="<?php echo $em['sss_amount']; ?>">
            <label for="" class="control-label mb-1">Pag-Ibig Deduction:</label>
            <input id="pagibig_amount" name="pagibig_amount" type="text" class="form-control bor-radius5" value="<?php echo $em['pagibig_amount']; ?>">
            <label for="" class="control-label mb-1">PhilHealth Deduction:</label>
            <input id="philhealth_amount" name="philhealth_amount" type="text" class="form-control bor-radius5" value="<?php echo $em['philhealth_amount']; ?>">
            <label for="" class="control-label mb-1">Position:</label>
            <select class="form-control bor-radius5" name="position" id="position">
                <option value="">- Select Position -</option>
                <?php foreach($position AS $p){ ?>
                <option value="<?php echo $p->position_id;?>" <?php echo (($em['position_id'] == $p->position_id) ? ' selected' : '');?>><?php echo $p->position_name;?></option>
                <?php } ?>
            </select>
            <label for="" class="control-label mb-1">Schedule:</label>
            <select class="form-control bor-radius5" name="schedule" id="schedule">
                <option value="">- Select Schedule -</option>
                <?php foreach($schedule AS $p){ ?>
                <option value="<?php echo $p->schedule_id;?>" <?php echo (($em['schedule_id'] == $p->schedule_id) ? ' selected' : '');?>><?php echo $p->time_in." - ".$p->time_out;?></option>
                <?php } ?>
            </select>
            <input id="employee_id" name="employee_id" type="hidden" class="form-control bor-radius5" value="<?php echo $em['employee_id']; ?>">
        </div>
    </div>
	
    
<?php } ?>