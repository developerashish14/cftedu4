<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Management system</title>
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/fevicon.png'); ?>">

    <!-- Styles -->
    <link href="<?= base_url('assets'); ?>/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/lib/themify-icons.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/lib/unix.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/style.css" rel="stylesheet">
	
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
                                <h1>Faculty Request</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Faculty Request</li>
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
                           <div class="card-header m-b-20">
								<div class="row form-group">
									<form action="<?=site_url('web-admin/faculty_request');?>" method="post">
										<div class="col-md-4">
											<input type="text" id="datepicker1" name="from_date" value="<?=$from_date?>" class="form-control">
										</div>
										<div class="col-md-4">
											<input type="text" id="datepicker2" name="to_date" value="<?=$to_date?>" class="form-control">
										</div>
										<div class="col-md-4">
											<input type="submit" class="form-control btn btn-success" value="Fetch">
										</div>
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
                                        <th>Email_ID</th>
                                        <th>Contact</th>
                                        <th>Qualification</th>
                                        <th>Resume</th>
                                        <th>Approval</th>
                                    </tr>
                                </thead>
								<tbody>
									<?php $i=1; foreach($load_data as $frm){ ?>
									<tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$frm->name;?></td>
                                        <td><?=$frm->email;?></td>
                                        <td><?=$frm->contact;?></td>
                                        <td><?=$frm->qualification;?></td>
                                        <td><a  class="ti-eye" href="<?=web_url().'images/cv/'.$frm->cv;?>" target="_blank" ></a></td>
                                        <td><button class="btn btn-success janmitrApproval" data-request_id="<?=$frm->id;?>" data-toggle="modal" data-target="#ApproveModal">Approve</button></td>
                                    </tr>
									<?php } ?>
								</tbody>
							</table>
							<div class="m-t-10 text-center"></div>
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
  <!--add slider-->
	
	
<div class="modal fade" id="ApproveModal" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Approve Window</h4>
			</div>
			<div class="modal-body">
				<form class="form-submit" action="<?=site_url('web-admin/faculty/approve_faculty');?>">
				<div class="row">
					<div class="col-md-6 form-group">
						<select class="form-control" name="faculty_type">
							<option value="guest faculty">Guest Faculty</option>
							<option value="permanent faculty"  >Permanent Faculty</option>
						</select>
					</div>
					<div class="col-md-6 form-group">
						<input class="form-control" type="number" name="age" placeholder="AGE" />
					</div>
					<div class="col-md-12 form-group">
						<textarea class="form-control" name="remark" placeholder="Discription"></textarea>
					</div>
					<div class="col-md-12 form-group">
						<input type="hidden" name="request_id" value="">
						<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">

						<button class="form-control btn btn-success">Approved</button>
					</div>
				</div>
				</form>
			</div>
		</div>
    </div>
</div>
<!--End Add Home Slide-->
	
	
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
			
			$('.janmitrApproval').on('click',function(){
				var request_id = $(this).data('request_id');
				$("input[name=request_id]").attr('value',request_id);
			});
		});
    </script>
</body>
</html>