<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CFT : CMS Management system</title>
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
                                <h1>Payment Link</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Payment Link</li>
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
								<div class="row">
									<form action="<?=site_url('manual_payment');?>" method="post">
										<div class="col-md-4">
											<input type="text" class="form-control" name="from_date" id="datepicker1" value="<?=$from_date;?>">
										</div>
										<div class="col-md-4">
											<input type="text" class="form-control" name="to_date" id="datepicker2" value="<?=$to_date;?>">
										</div>
										<div class="col-md-2">
											<input type="submit" class="form-control btn btn-success" value="Fetch">
										</div>
									</form>
									<div class="col-md-2 text-right">
										<?php if(in_array('1',$other_action)){ ?>
										<input type="button" class="form-control btn btn-success" data-toggle="modal" data-target="#addPayment" value="Add">
										<?php } ?>
									</div>
								</div>
							</div>
                        </div>
                        <div class="card-body">
							<table class="table f-s-13">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
										<th>Name</th>
                                        <th>Email-ID</th>
                                        <th>Contact</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Last Update</th>
                                        <th>Update By</th>
                                    	<th>Status</th>
                                        <th>SendLink</th>
                                        <th>SendInvoice</th>
                                    </tr>
                                </thead>
								<tbody>
								<?php $i=1; foreach($paylink as $pay) { ?>
									<tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$pay->name;?></td>
                                        <td><?=$pay->email_id;?></td>
                                        <td><?=$pay->contact;?></td>
                                        <td><?=$pay->product;?></td>
                                        <td><?=$pay->amount;?></td>
                                        <td><?=$pay->last_update;?></td>
                                        <td><?=isset($user_info[$pay->update_by]->f_name)?$user_info[$pay->update_by]->f_name:'Visitor';?></td>
                                        <td><?=(($pay->status=='A')?'Approved':(($pay->status == 'R')?'Recieved':'Pending'));?></td>
                                        <td id="email-<?= $pay->id; ?>">
											<a href="#" data-id="<?= $pay->id; ?>" class="send-email badge badge-primary">Send Email</a>
										</td>
										<td id="invoice-<?= $pay->id; ?>">
											<a href="#" data-id="<?= $pay->id; ?>" class="send-invoice badge badge-primary">Send Invoice</a>
										</td>
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

<div class="modal fade" id="addPayment" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Payment Link</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12 attach-details">
						<form class="form-submit" method="post" action="<?= site_url('payment/add_payment_link'); ?>">
							<div class="row">
								<div class="col-md-6 col-sm-12 form-group" >
									<label>Name</label>
									<input type="text" class="form-control" name="name">
								</div>
								<div class="col-md-6 col-sm-12 form-group" >
									<label>Email ID</label>
									<input type="text" class="form-control" name="email_id">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12 form-group" >
									<label>Contact</label>
									<input type="text" class="form-control" name="contact">
								</div>
								<div class="col-md-6 col-sm-12 form-group" >
									<label>Program/Course/Product</label>
									<input type="text" class="form-control" name="product">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12 form-group" >
									<label>University/Institution/Details</label>
									<input type="text" class="form-control" name="detail">
								</div>
								<div class="col-md-6 col-sm-12 form-group" >
									<label>Bill Amount (Only Value)</label>
									<input type="text" class="form-control" name="amount">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group" >
									<label>Type</label>
									<select class="form-control" name="type">
										<option value="TISS">TISS</option>
										<option value="Short-Term">Short-Term</option>
										<option value="CFT">CFT</option>
										<option value="PCTI">PCTI</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group">
									<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Submit</span></button>
								</div>
							</div>
						</form>
					</div>
				</div>
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
			
			$('.change-status').on('click',function(){
				var id = $(this).data('id');
				var status = $(this).data('status');
				var owner_type = $(this).data('owner-type');
				var owner_id = $(this).data('owner-id');
				var membership_type = $(this).data('membership-type');
				
				$('input[name=chg_transaction_id]').attr('value',id);
				$('input[name=chg_membership_type]').attr('value',membership_type);
				$('input[name=chg_owner_type]').attr('value',owner_type);
				$('input[name=chg_owner_id]').attr('value',owner_id);
				$('select[name=chg_status]').find("option[value='"+status+"']").attr('selected','selected');
				
			});
			
			$('.send-invoice').on('click', function(){
				var item = $(this).data('id');
				var button = $("#invoice-"+item).html();
				$("#invoice-"+item).html("<img src='<?= base_url('assets'); ?>/images/loader.gif' style='width: 40px;'>");
					$.ajax({
					type: "POST",
					url: "<?= site_url('invoice/send_invoice_email'); ?>",
					data: {id:item},
					dataType: 'json',
					cache: false,
					success: function(result){
						if(result.success == true){
							if(result.rlink){
								window.location.href = result.rlink;
							}else if(result.alert){
								frm.before(result.alert);
							}else if(result.alert1){
								alert(result.alert1);
								location.reload();
							}else{
								location.reload();
							}
						}else{
							$.each(result.message, function(key,value){
								var inpt = frm.find('input[name='+key+'], textarea[name='+key+'], select[name='+key+']');
								if(value.length > 2){
									if(result.border == true){
										inpt.addClass('border-danger');
										$('#toast-erromsg').show().append(value);
									}else{
										inpt.addClass('border-danger').before(value);
									}
								}
							});
							setTimeout(function(){
								$('#toast-erromsg').fadeOut(600)
							}, 3500);
						}
						$('.preloader').hide();
						$("#email-"+item).html(button);
					}
				});
			});
			
			$('.send-email').on('click', function(){
				var item = $(this).data('id');
				var button = $("#email-"+item).html();
				$("#email-"+item).html("<img src='<?= base_url('assets'); ?>/images/loader.gif' style='width: 40px;'>");
					$.ajax({
					type: "POST",
					url: "<?= site_url('payment/send_link_email'); ?>",
					data: {id:item},
					dataType: 'json',
					cache: false,
					success: function(result){
						if(result.success == true){
							if(result.rlink){
								window.location.href = result.rlink;
							}else if(result.alert){
								frm.before(result.alert);
							}else if(result.alert1){
								alert(result.alert1);
								location.reload();
							}else{
								location.reload();
							}
						}else{
							$.each(result.message, function(key,value){
								var inpt = frm.find('input[name='+key+'], textarea[name='+key+'], select[name='+key+']');
								if(value.length > 2){
									if(result.border == true){
										inpt.addClass('border-danger');
										$('#toast-erromsg').show().append(value);
									}else{
										inpt.addClass('border-danger').before(value);
									}
								}
							});
							setTimeout(function(){
								$('#toast-erromsg').fadeOut(600)
							}, 3500);
						}
						$('.preloader').hide();
						$("#email-"+item).html(button);
					}
				});
			});
		});
    </script>
</body>
</html>