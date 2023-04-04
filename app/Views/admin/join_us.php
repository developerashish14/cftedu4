<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CFT : CMS Managemant system</title>
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/fevicon.png'); ?>">

    <!-- Styles -->
    <link href="<?= base_url('assets'); ?>/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/lib/themify-icons.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/lib/unix.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/style.css" rel="stylesheet">
	
	<style>
	.ui-datepicker{
		top:138px !important;
	}
	</style>
	
</head>

<body>

    <?php include('common/side.php'); ?>
    <!-- /# sidebar -->

    <?php include('common/header.php'); ?>
    


    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-lg-6 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Join Us</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Join Us</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">
                    <div class="card">
                        <div class="card-header m-b-20">
                            <div class="row form-group">
								<form action="<?=site_url('join_us');?>" method="post">
									<div class="col-md-3">
										<input type="text" class="form-control" id="datepicker1" value="<?=date('Y-m-d',strtotime($from_date));?>" name="from_date" placeholder="From Date">
									</div>
									<div class="col-md-3">
										<input type="text" class="form-control" id="datepicker2" value="<?=date('Y-m-d',strtotime($to_date));?>" name="to_date" placeholder="To Date">
									</div>
									<div class="col-md-3">
										<input type="submit" class="form-control btn btn-success" value="submit" >
									</div>
								</form>
								<div class="col-md-3">
									<form  action="<?=site_url('student/frm_joinus_export_data');?>" method="post">
									  <input type="hidden" name="from_date" value="<?=$from_date;?>">
									  <input type="hidden" name="to_date" value="<?=$to_date;?>">
									  <button type="submit" class="form-control btn btn-success" id="btn-export" >Export</button>
									</form>
								</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table f-s-13">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Email_ID</th>
                                        <th>Company</th>
                                        <th>Location</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($joinus as $cnt){?>
									<tr>
                                        <td>
											<?= $i++; ?>
										</td>
                                        <td><?= $cnt->name; ?></td>
										<td><?= $cnt->contact; ?></td>
										<td><?= $cnt->email_id; ?></td>
										<td><?= $cnt->company; ?></td>
	                                    <td width="150px;"><?= $cnt->location; ?></td>
	                                    <td width="150px;"><?= $cnt->message; ?></td>
                                        <td><?= $cnt->ip_address; ?><br>
										<?= $cnt->insert_time; ?><br>
										<?php
											$info = json_decode($cnt->system_info);
											foreach($info as $in => $v)
											{
												echo $in.' : '.$v.'<br>';
											}
										?>
										
										</td>
                                    </tr>
									<?php } ?>
									
                                </tbody>
                            </table>
                            <div class="m-t-10 text-center">
                               
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer">
                                <p>This page was generated on <span id="date-time"><?= date('h:i a, d M Y')?>. </span> <a href="#" class="page-refresh">Refresh Page</a></p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


    <!-- jquery vendor -->
    <script src="<?= base_url('assets'); ?>/js/lib/jquery.min.js"></script>
    <script src="<?= base_url('assets'); ?>/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="<?= base_url('assets'); ?>/js/lib/menubar/sidebar.js"></script>
    <script src="<?= base_url('assets'); ?>/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="<?= base_url('assets'); ?>/js/lib/bootstrap.min.js"></script>
    <!-- bootstrap -->
    <script src="<?= base_url('assets'); ?>/js/scripts.js"></script>
    <script src="<?= base_url('assets'); ?>/js/myjs.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker({
                maxDate : "-18y",
                changeYear: true,
                changeMonth: true
            });
            $( "#datepicker1,#datepicker2" ).datepicker({
				dateFormat: 'yy-mm-dd',
                changeYear: true,
                changeMonth: true
            });
			
		});
    </script>
</body>
</html>