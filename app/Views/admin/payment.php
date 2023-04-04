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
                                <h1>Payment</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Payment</li>
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
									<form action="<?=site_url('payment');?>" method="get">
										<div class="col-md-2">
											<select class="form-control" name="product">
												<option value="" <?php echo (($product=='')?'selected':''); ?>>All</option>
											<?php foreach($product_type as $prod){ ?>
												<option value="<?=$prod->name;?>" <?php echo (($product==$prod->name)?'selected':''); ?>>
													<?=$prod->name;?>
												</option>
											<?php } ?>
											</select>
										</div>
										<div class="col-md-2">
											<select class="form-control" name="payment_type">
												<option value="" <?php echo (($payment_type=='')?'selected':''); ?>>All</option>
											<?php foreach($mode as $md => $type){ if($type->payment_mode != ""){ ?>
												<option value="<?=$type->payment_mode;?>" <?php echo (($payment_type==$type->payment_mode)?'selected':''); ?>><?=strtoupper($type->payment_mode);?></option>
											<?php } } ?>
											</select>
										</div>
										<div class="col-md-2">
											<select class="form-control" name="status">
												<option value="C" <?php echo (($status=='C')?'selected':''); ?>>CHECKOUT</option>
												<option value="P" <?php echo (($status=='P')?'selected':''); ?>>PAYMENT</option>
												<option value="A" <?php echo (($status=='A')?'selected':''); ?>>APPROVED</option>
												<option value="R" <?php echo (($status=='R')?'selected':''); ?>>REJECTED</option>
											</select>
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control" name="from_date" id="datepicker1" value="<?=$from_date;?>">
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control" name="to_date" id="datepicker2" value="<?=$to_date;?>">
										</div>
										<div class="col-md-1">
											<input type="submit" class="form-control btn btn-success" value="Fetch">
										</div>
									</form>
									<div class="col-md-1 text-right">
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
										<th>TxnId</th>
                                        <th>Product Info</th>
                                        <th>Client Details</th>
                                        <th>Insert Time</th>
                                        <th>Pay Mode</th>
                                        <th>Price</th>
										<th>Status</th>
                                        <th>Action</th>
                                        <th>SendEmail</th>
                                    </tr>
                                </thead>
								<tbody>
									<?php 
										$i=1; 
										foreach($payment as $pay)
										{ 
											$membership_id = (($pay->product_info == 'BASIC')?1:(($pay->product_info == 'SILVER')?2:(($pay->product_info == 'GOLD')?3:(($pay->product_info == 'DIAMOND')?4:(($pay->product_info == 'SPECIAL')?5:1))))); 
											
									?>
									<tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$pay->txnid;?></td>
                                        <td><?=$pay->product_info;?></td>
                                        <td><?=$pay->name;?> | <?=$pay->phone;?><br><?=$pay->email;?></td>
                                        <td><?=$pay->insert_time;?></td>
                                        <td><?=$pay->payment_mode;?></td>
                                        <td><?=$pay->price;?></td>
                                        <td><?php echo (($pay->status=='C')?'Checkout':(($pay->status=='P')?'Payment':(($pay->status=='A')?'Approved':(($pay->status=='R')?'Rejected':'Not Found')))); ?></td>
										<td><a href="#" data-id="<?=$pay->id;?>" data-status="<?=$pay->status;?>" data-membership-type="<?= $membership_id; ?>" data-owner-type="<?= $pay->transaction_by; ?>" data-owner-id="<?= $pay->owner_id; ?>" data-payment_mode="<?= $pay->payment_mode; ?>" data-txnid="<?= $pay->txnid; ?>" class="change-status badge badge-primary" data-toggle="modal" data-target="#change-status">Change Status</a></td>
										<td id="email-<?= $pay->id; ?>">
											<a href="#" data-id="<?= $pay->id; ?>" class="send-email badge badge-primary">Send Details</a>
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
				<h4 class="modal-title">Off Line Payment</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12 attach-details">
						<form class="form-submit" method="post" action="<?= site_url('payment/add_payment'); ?>">
							<div class="row">
								<div class="col-md-6 col-sm-12 form-group" >
									<label>Student EmailID</label>
									<input type="text" class="form-control" name="email_id">
								</div>
								<div class="col-md-6 col-sm-12 form-group" >
									<label>Transaction</label>
									<input type="text" class="form-control" name="txnid">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12 form-group" >
									<label>Amount</label>
									<input type="text" class="form-control" name="price">
								</div>
								<div class="col-md-6 col-sm-12 form-group" >
									<label>Product</label>
									<select class="form-control" name="product">
										<?php foreach($product_type as $prod){ ?>
										<option value="<?=$prod->name;?>"><?=$prod->name;?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group">
									<input type="hidden" name="transaction_by" value="Student">
									<input type="hidden" name="payment_mode" value="offline">
									<input type="hidden" name="status" value="P">
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

<div class="modal fade" id="change-status" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Change Status</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12 attach-details">
						<form class="form-submit" method="post" action="<?= site_url('payment/change_status'); ?>">
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group" >
									<label>Status</label>
									<select class="form-control" name="chg_status">
										<option value="C">CHECKOUT</option>
										<option value="P">PAYMENT</option>
										<option value="A">APPROVED</option>
										<option value="R">REJECTED</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group" >
									<label>Payment Mode</label>
									<select class="form-control" name="chg_paymode">
										<option value="">Select Payment Mode</option>
										<option value="NB">NetBanking</option>
										<option value="CC">Credit Card</option>
										<option value="DC">Debit Card</option>
										<option value="UPI">UPI</option>
										<option value="CASH">CASH</option>
										<option value="offline">Offline Cash</option>
										<option value="BT">Offline Bank Transfer</option>
										<option value="PayTM">Direct PayTM</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group" >
									<label>Transaction ID</label>
									<input type="text" name="chg_txnid" class="form-control" placeholder="Remarks">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group" >
									<label>Remarks</label>
									<textarea name="remark" class="form-control" placeholder="Remarks"></textarea>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group">
									<input type="hidden" name="chg_transaction_id" value="">
									<input type="hidden" name="chg_membership_type" value="">
									<input type="hidden" name="chg_owner_type" value="">
									<input type="hidden" name="chg_owner_id" value="">
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
			
			$('.change-status').on('click',function(){
				var id = $(this).data('id');
				var status = $(this).data('status');
				var owner_type = $(this).data('owner-type');
				var owner_id = $(this).data('owner-id');
				var membership_type = $(this).data('membership-type');
				var payment_mode = $(this).data('payment_mode');
				var txnid = $(this).data('txnid');
				var product_info = $(this).data('product_info');
				
				$('input[name=chg_transaction_id]').attr('value',id);
				$('input[name=chg_membership_type]').attr('value',membership_type);
				$('input[name=chg_owner_type]').attr('value',owner_type);
				$('input[name=chg_owner_id]').attr('value',owner_id);
				$('input[name=chg_txnid]').attr('value',txnid);
				$('select[name=chg_status]').find("option[value='"+status+"']").attr('selected','selected');
				$('select[name=chg_paymode]').find("option[value='"+payment_mode+"']").attr('selected','selected');
				
			});
			
			$('.send-email').on('click', function(){
				var item = $(this).data('id');
				var button = $("#email-"+item).html();
				$("#email-"+item).html("<img src='<?= base_url('assets'); ?>/images/loader.gif' style='width: 40px;'>");
					$.ajax({
					type: "POST",
					url: "<?= site_url('payment/detail_email'); ?>",
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
								frm.before(result.alert1);
								frm.remove();
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