            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
									<!-- Page-header start -->
                                    <div class="page-header card">
                                        <div class="card-block">
                                            
                                            <h5 class="m-b-10">Payroll List</h5>
                                            <ul class="breadcrumb-title b-t-default p-t-10">
                                                <li class="breadcrumb-item">
                                                    <a href="<?php echo base_url(); ?>masterfile/dashboard"> <i class="fa fa-home"></i> </a>
                                                </li>
                                               <li class="breadcrumb-item"><a href="#!">Payroll List</a></li><br>
                                               <table width="100%">
                                                    <form method="POST" action="<?php echo base_url(); ?>masterfile/generatePayroll">
                                                        <tr>
                                                            <td width="8%"></td>
                                                            <td width="5%"><label>From:</label></td>
                                                            <td width="20%"> <input type="date" name= "from" value="<?php echo $from ?>" class = "form-control" required></td>
                                                            <td width="3%"></td>
                                                            <td width="5%"><label>To:</label></td>
                                                            <td width="20%"> <input type="date" name= "to" value="<?php echo $to ?>" class = "form-control" required></td>
                                                            <td width="2%"></td>
                                                            <td width="10%"><input name='generate' type="submit" class="btn btn-primary" value = "Search"></td>
                                                        </tr>
                                                    </form>            
                                                </table>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Page-header end -->
                                    
                                <!-- Page-body start -->
                                <div class="page-body">
                                    <!-- Basic table card start -->
                                    <div class="card">
                                        <div class="card-header">
                                            <!-- <h5>Basic table</h5>
                                            <span>use class <code>table</code> inside table element</span> -->
                                            <!-- <div class="card-header-right"> -->
												<!-- <ul class="list-unstyled card-option">
													<li><i class="fa fa-chevron-left"></i></li>
													<li><i class="fa fa-window-maximize full-card"></i></li>
													<li><i class="fa fa-minus minimize-card"></i></li>
													<li><i class="fa fa-refresh reload-card"></i></li>
													<li><i class="fa fa-times close-card"></i></li>
												</ul> -->
                                                <a href="<?php echo base_url(); ?>masterfile/export_payslip/<?php echo $from; ?>/<?php echo $to; ?>" target="_blank" class = "btn btn-primary pull-right">Payslip</a>
                                                <a href="<?php echo base_url(); ?>masterfile/export_payroll/<?php echo $from; ?>/<?php echo $to; ?>" target="_blank" class = "btn btn-success pull-right">Payroll</a>
                                            <!-- </div>
                                            <br> -->
                                        </div>
                                        <div class="card-block table-border-style">
                                            <div class="table-responsive">
                                                <table class="table" id="myTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Employee Name</th>
                                                            <th>Employee Number</th>
                                                            <th>Gross</th>
                                                            <th>Deductions</th>
                                                            <th>Cash Advance</th>
                                                            <th>Net Pay</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if(!empty($payroll)){ foreach($payroll AS $p){ ?>
                                                        <tr class="icon-btn">
                                                            <td><?php echo $p['fullname'];?></td>
                                                            <td><?php echo $p['employee_number'];?></td>
                                                            <td><?php echo number_format($p['gross'],2);?></td>
                                                            <td><?php echo "<b>Cash Advance:</b> ".number_format($p['cashadvance'], 2)."<br> <b>Pag-Ibig:</b> ".number_format($p['pagibig_amount'], 2)."<br> <b>SSS:</b> ".number_format($p['sss_amount'], 2)."<br> <b>PhilHealth:</b> ".number_format($p['philhealth_amount'], 2)."<br> <b>Total Deduction: <u>".number_format($p['total_deduction'], 2)."</b></u>"?>
                                                            </td>
                                                            <td><?php echo number_format($p['cashadvance'], 2);?></td>
                                                            <td><?php echo number_format($p['net'], 2);?></td>
                                                        </tr>
                                                    <?php } } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Basic table card end -->
                                </div>
                                <!-- Page-body end -->
                            </div>
                        </div>
                        <!-- Main-body end -->

                        <div id="styleSelector">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
