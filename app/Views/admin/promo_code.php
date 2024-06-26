<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TVS : Management system</title>
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
                                <h1>Promo Code</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Promo Code</li>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Promo Code</h4>
                                </div>
                                
                                <div class="col-md-6 text-right">
                                    <a class="badge badge-success" href="#" data-toggle="modal" data-target="#addPromo">Add</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table f-s-13">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>PromoCode</th>
                                        <th>Start</th>
                                        <th>Expire</th>
                                        <th>Discount</th>
                                        <th>Last Update</th>
                                        <th>Updated By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($promo_code as $pro){ ?>
									<form class="form-submit" action="<?= site_url('promo/update_promo'); ?>" method="post">
										<tr>
											<td><?= $i++; ?></td>
											<td><input type="text" name="promo_code" value="<?= $pro->promo_code; ?>" ></td>
											<td><input type="text" name="start_date" class="datepicker" value="<?= $pro->start_date; ?>" ></td>
											<td><input type="text" name="expire_date" class="datepicker" value="<?= $pro->expire_date; ?>" ></td>
											<td>
												<select name="type" class="form-control">
													<option value="P" <?= (($pro->type == 'P')?'selected':''); ?>>Percentage</option>
													<option value="A" <?= (($pro->type == 'A')?'selected':''); ?>>Amount</option>
												</select>
												<input type="text" name="value" value="<?= $pro->value; ?>" ></td>
											<td><?= $pro->last_update; ?></td>
											<td><?= $user_info[$pro->update_by]->f_name; ?></td>
											<td id="promo-<?=$pro->id?>"><?= ($pro->status == 'D')?'<a href="#" data-id="'.$pro->id.'" data-status="'.$pro->status.'" class="change-status badge badge-primary">ACTIVE</a>':'<a href="#" data-id="'.$pro->id.'" data-status="'.$pro->status.'" class="change-status badge badge-danger">DEACTIVE</a>'; ?>
											
												<input type="hidden" class="form-control" name="promo_id" value="<?= $pro->id; ?>">
												<button type="submit" class="edit-course badge badge-primary"> Update </button>
											</td>
										</tr>
									</form>
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
  <!--add slider-->
	
<div class="modal fade" id="addPromo" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Promo Code</h4>
			</div>
			<div class="modal-body">
				<div class="tab-content">
					<div id="mediaadd" class="tab-pane fade in active">
						<div class="row">
							<div class="col-sm-12 attach-details">
								<form class="form-submit" method="post" action="<?= site_url('promo/add_promo')?>">
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<label>Promo Code</label>
											<input type="text" name="promo_code" class="form-control" placeholder="Code">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group ">
											<label>Start Date</label>
											<input type="text" name="start_date" id="datepicker1" class="form-control" placeholder="YYYY-MM-DD">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<label>Expire Date</label>
											<input type="text" name="expire_date" id="datepicker2" class="form-control" placeholder="YYYY-MM-DD">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<label>Type</label>
											<select class="form-control" name="type">
												<option value="P">Percentage</option>
												<option value="A">Amount</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<label>Value</label>
											<input type="text" name="value" class="form-control" placeholder="value">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group">
											<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Add Promo</span></button>
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
            $( ".datepicker" ).datepicker({
                dateFormat: 'yy-mm-dd'
            });
            $( "#datepicker1,#datepicker2" ).datepicker({
				dateFormat: 'yy-mm-dd',
                changeYear: true,
                changeMonth: true
            });
			
			$('.change-status').on('click', function(){
				var item = $(this).data('id');
				var status = $(this).data('status');
				if(item != "" && status != "")
				{
					$("#promo-"+item).html("<img src='<?= base_url('assets'); ?>/images/loader.gif' style='width: 40px;'>");
					$.ajax({
						type: "POST",
						url: "<?= site_url('promo/change_promo_status'); ?>",
						data: {status:status,id:item},
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
						}
					});
				}
			});
		});
    </script>
</body>
</html>