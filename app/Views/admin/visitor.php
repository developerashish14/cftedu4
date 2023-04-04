<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CFT LMS</title>
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
.accordion-head{
	border-radius: 8px;
	font-weight: normal;
    color: #ffffff;
	cursor: pointer;
}
.text-white{
	color: #fff !important;
}
.Emergency{
	border: 1px solid #ff2a29;
    background-color: #ff2a29;
}
.Regular{
	border: 1px solid #6f42c1;
	background-color: #6f42c1;
}
.Urgent{
	border: 1px solid #ffc217;
    background-color: #ffc217;
}
.font {
  font-family: Arial, Helvetica, sans-serif;
}


</style>
</head>

<body>

<?php include('common/side.php'); ?>
<?php include('common/header.php'); ?>
<div class="content-wrap">
	<div class="main">
		<div class="container-fluid">
			
			<div class="row">
				<div class="col-lg-6 p-r-0 title-margin-right">
					<div class="page-header">
						<div class="page-title">
							<h1>Query</h1>
						</div>
					</div>
				</div>
				<div class="col-lg-6 p-l-0 title-margin-left">
					<div class="page-header">
						<div class="page-title">
							<ol class="breadcrumb text-right">
								<li><a href="#">Dashboard</a></li>
								<li class="active">Query</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<section id="main-content">
				<div class="card">
					<div class="card-header m-b-20">
						<div class="card-header m-b-20">
							<div class="row form-group">
								<form class="search" method="post" action="<?= site_url('visitor/search_customer'); ?>">
									<div class="col-md-6">
										<input type="text" id="visitor_details" required name="contact" class="form-control" placeholder="Contact NO">
									</div>
									<div class="col-md-4">
										<button class="form-control btn btn-success"  type="submit">
								<i class="fa fa-search"></i>  Search</a>
									</div>
								</form>	
								<div class="col-md-2"> 
									<button id="add_customer" style="display: none;" class="form-control btn btn-info" href="#" data-toggle="modal" data-target="#addCustomer">+ Add</button>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row show-user border-bottom" style="display:none">
						<div class="col-md-4">
							<div class="row">
								<div class="col-md-2">
									<p class="font">Name</p>
								</div>
								<div class="col-md-10">
									: <strong class="font" id="visitor-name"></strong>
								</div>
							</div>
							<div class="row">
								<div class="col-md-2">
									<p class="font">Contact</p>
								</div>
								<div class="col-md-10">
									: <strong class="font" id="visitor-contact"></strong>
								</div>
							</div>
							<div class="row">
								<div class="col-md-2">
									<p class="font">Email</p>
								</div>
								<div class="col-md-10">
									: <strong class="font" id="visitor-email"></strong>
								</div>
							</div>
							<!--<p >Name    : <strong id="visitor-name"></strong></p>
							<p >Contact : <strong id="visitor-contact"></strong></p>
							<p >Email   : <strong id="visitor-email"></strong></p>-->
						</div>
						<div class="col-md-4">
							<div class="row">
								<div class="col-md-2">
									<p class="font">Address</p>
								</div>
								<div class="col-md-10">
									: <strong class="font" id="visitor-address"></strong>
								</div>
							</div>
							<!--<p>Address : <strong id="visitor-address"></strong></p>-->
							<div class="row">
								<div class="col-md-2">
								</div>
								<div class="col-md-10">
									<button class="btn btn-danger" data-target="#addQuery" data-toggle="modal" >+ Add Query</button>
							
								</div>
							</div>
							
						</div>
						<div class="col-md-4">
						</div>
					</div>
					
					<div class="card-body" id="customer_details">
						
					</div>
					
					   
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="footer">
							<p>This page was generated on<span id="date-time"><?= date('h:i a, d M Y')?>.</span><a href="#" class="page-refresh">Refresh Page</a></p>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
	


<div class="modal fade" id="addQuery" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Query</h4>
			</div>
			<div class="modal-body">
				<div class="tab-content">
					<div id="mediaadd" class="tab-pane fade in active">
						<div class="row">
							<div class="col-sm-12 attach-details">
								<form class="form-query" method="post" action="<?= site_url('visitor/add_query'); ?>">
									<div class="row">
										
										<input type="hidden" name="cust_id" class="form-control" placeholder="Name">
										<input type="hidden" name="stage" class="form-control" value="1">
									
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Program</label>
											<select  class="form-control required courseDetails" name="type">
												<option value="">Select Program</option>
												<?php foreach($program as $pro){ ?>
												<option value="<?=$pro->id;?>"><?=$pro->program;?></option>
												<?php } ?>
											</select>
										</div>
										<div class="row">
											<div class="col-md-6 col-sm-12 form-group" >
												<label>Amount</label>
												<input name="amount" readonly type="number" class="form-control" placeholder="Amount">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="row">
											<div class="col-md-12 col-sm-12 form-group" >
												<label>Remark</label>
												<input name="remark" class="form-control" placeholder="Remark">
											</div>
										</div>
									</div>
									
									
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group">
											<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Add </span></button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
	

<!--End Add Home Slide-->
<div class="modal fade" id="addCustomer" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Visitor</h4>
			</div>
			<div class="modal-body">
				<div class="tab-content">
					<div id="mediaadd" class="tab-pane fade in active">
						<div class="row">
							<div class="col-sm-12 attach-details">
								<form class="form-submit" method="post" action="<?= site_url('visitor/add_customer'); ?>">
									<div class="row">
										<div class="col-md-3 col-sm-12 form-group" >
											<label>Prefix</label>
											<select class="form-control" name="prefix">
												<option value="Mr">Mr.</option>
												<option value="Mrs">Mrs.</option>
												<option value="Dr.">Dr.</option>
												<option value="Prof.">Prof.</option>
											</select>
										</div>
										<div class="col-md-3 col-sm-12 form-group" >
											<label>Name</label>
											<input type="text" name="name" class="form-control" placeholder="Name">
										</div>
										<div class="col-md-3 col-sm-12 form-group" >
											<label>Contact</label>
											<input type="text" name="contact" readonly class="form-control" placeholder="Contact">
										</div>
										<div class="col-md-3 col-sm-12 form-group" >
											<label>Gender</label>
											<select class="form-control" name="gender">
												<option value="M">Male</option>
												<option value="F">Female</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 col-sm-12 form-group" >
											<label>Email ID</label>
											<input type="text" name="email" class="form-control" placeholder="Email ID">
										</div>
										<div class="col-md-4 col-sm-12 form-group" >
											<label>Topic</label>
											<input type="text" name="topic" class="form-control" placeholder="Topic">
										</div>
										<div class="col-md-4 col-sm-12 form-group" >
											<label>Date of Birth</label>
											<input type="date" name="dob" class="form-control" placeholder="Age">
										</div>
										
									</div>
									
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<label>Address</label>
											<input name="address" class="form-control" placeholder="Address">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group">
											<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Add </span></button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>


<div class="modal fade" id="upamountModal" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Offer Amount</h4>
			</div>
			<div class="modal-body">
				<form class="form-submit-amount" action="<?=base_url('visitor/offer_amount');?>">
				<div class="row">
					<div class="col-md-12 form-group">
						<input type="number" class="form-control" name="offer_amount" >
					</div>
					<div class="col-md-12 form-group">
						<input type="hidden" name="qry_id" value="">
						<button type="submit" class="form-control btn btn-success">Submit</button>
					</div>
				</div>
				</form>
			</div>
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
	
	<script src="<?= base_url('assets'); ?>/js/query.js"></script>
    
</body>
</html>