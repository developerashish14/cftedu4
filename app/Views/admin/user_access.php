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
                                <h1>User Access</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">User Access</li>
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
								<form action="<?=site_url('web-admin/user/user_access');?>" method="get">
									<div class="col-md-4">
										<select class="form-control" name="user_id">
											<?php foreach($emp as $em){ ?>
												<option value="<?=data_encode($em->id);?>" <?php echo (($user_id==$em->id)?'selected':''); ?>><?=ucfirst($em->f_name);?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-md-4">
										<input type="submit" class="form-control btn btn-success" value="Fetch">
									</div>
								</form>
							</div>
                        </div>
                        <div class="card-body">
							<div class="row">
                                <div class="col-md-6">
									<form class="form-submit" method="post" action="<?= site_url('web-admin/user/update_user_info'); ?>">
									<fieldset>
									<legend>User Information</legend>
										<div class="row form-group">
											<div class="col-md-6">
												<label>First Name</label>
												<input type="text" name="f_name" value="<?=$emp_info->f_name;?>" class="form-control">
											</div>
											<div class="col-md-6">
												<label>Last Name</label>
												<input type="text" name="l_name" value="<?=$emp_info->l_name;?>" class="form-control">
											</div>
										</div>
										<div class="row form-group">
											<div class="col-md-12">
												<label>Email ID</label>
												<input type="text" name="email" value="<?=$emp_info->email_id;?>" class="form-control">
											</div>
										</div>
										<div class="row form-group">
											
											<div class="col-md-6">
												<select name="status" class="form-control">
													<option value="A" <?= (($emp_info->status == "A")?'selected':''); ?> >Activate</option>
													<option value="D" <?= (($emp_info->status == "D")?'selected':''); ?> >Deactivate</option>
												</select>
											</div>
										</div>
										<div class="row form-group">
											<div class="col-md-12">
											<?php if(in_array('2',$other_action)){ ?>
												<input type="hidden" name="user_id" value="<?= $user_id; ?>">
													<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
													
												<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Update</span></button>
											<?php } ?>
											</div>
										</div>
									</fieldset>
									</form>
									<div class="col-md-12">
										<h4>Change Password</h4>
										<hr>
										<form class="form-submit" method="post" action="<?= site_url('web-admin/user/update_user_password'); ?>">
											<div class="row form-group">
												<div class="col-md-12">
													<label>New Password</label>
													<input type="text" name="new_password" class="form-control">
												</div>
											</div>
											<div class="row form-group">
												<div class="col-md-12">
													<label>Confirm Password</label>
													<input type="text" name="con_password" class="form-control">
												</div>
											</div>
											<div class="row form-group">
												<div class="col-md-12">
												<?php if(in_array('2',$other_action)){ ?>
													<input type="hidden" name="user_id" value="<?= isset($user_id)?$user_id:''; ?>">
													<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
													<button type="submit" class="btn btn-success form-control">Update</button>
												<?php } ?>
												</div>
											</div>
										</form>
									</div>
							   </div>
                                <div class="col-md-6">
									<form class="form-submit" method="post" action="<?= site_url('web-admin/user/update_access'); ?>">
										<table class="table f-s-13">
											<?php
												//var_dump($menu);die();
											foreach($menu as $tbgroup => $submenu){ ?>
												<tr><th><i class="<?=$submenu['icon'];?>"></i></th><th colspan="2"><?=$tbgroup;?></th></tr>
												<?php 
													//print_r($submenu['icon']);die();
												
													foreach($submenu['menu'] as $name => $prop){ 
													$oa = explode(',',$prop['other_action']);
													?>
														<tr>
															<th><input type="checkbox" name="tab[]" value="<?=$prop['id'];?>" <?php echo ((isset($user_access[$prop['id']]) && $user_access[$prop['id']]['status']=='A')?'checked':''); ?> ></th>
															<th><?=$name;?></th>
															<td>
																<?php 
																if($oa[0] != null)
																{
																	$uaoa = array();
																	if(isset($user_access[$prop['id']]['other_action']))
																	{
																		$uaoa = explode(' ',$user_access[$prop['id']]['other_action']);
																	}
																	foreach($oa as $a){
																		$toa = explode('|',$a);
																		echo '<label><input type="checkbox" name="action['.$prop['id'].'][]" value="'.$toa[1].'" '.((in_array($toa[1],$uaoa)?'checked':'')).'> '.ucfirst($toa[0]).'</label> ';
																		
																	}
																}
																?>
															</td>
														</tr>
													<?php } ?>
											<?php } ?>
											<tr>
												<td colspan="3">
												<?php if(in_array('2',$other_action)){ ?>
													<input type="hidden" name="user_id" value="<?= $user_id; ?>">
														<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
													
													<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Update</span></button>
												<?php } ?>
												</td>
											</tr>
										</table>
									</form>
                                </div>
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
	
<div class="modal fade" id="addUser" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add User</h4>
			</div>
			<div class="modal-body">
				<div class="tab-content">
					<div id="mediaadd" class="tab-pane fade in active">
						<div class="row">
							<div class="col-sm-12 attach-details">
								<form class="form-submit" method="post" action="<?= site_url('web-admin/user/add_user')?>">
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<label>First Name</label>
											<input type="text" name="fname" class="form-control" placeholder="First Name">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Last Name</label>
											<input type="text" name="lname" class="form-control" placeholder="Last Name">
										</div>
									</div>
									<div class="row">
									
										<div class="col-md-6 col-sm-12 form-group ">
											<label>Email ID</label>
											<input type="email" name="email" class="form-control" placeholder="Email-ID">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group">
											<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
													
											<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Add User</span></button>
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
			
			$('.change-status').on('click', function(){
				var item = $(this).data('id');
				var status = $(this).data('status');
				if(item != "" && status != "")
				{
					$("#page-"+item).html("<img src='<?= base_url('assets'); ?>/images/loader.gif' style='width: 40px;'>");
					$.ajax({
						type: "POST",
						url: "<?= site_url('home/change_testimonial_status'); ?>",
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