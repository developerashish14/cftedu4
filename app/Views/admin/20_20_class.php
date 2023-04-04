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
	.ui-autocomplete {
		z-index: 1052 !important;
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
                                <h1>20-20 Class Schedule</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">20-20 Class</li>
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
									<form action="<?=site_url('20_20_class');?>" method="post">
										<div class="col-md-6">
											<input type="text" id="datepicker" class="form-control" name="date" value="<?=$date;?>">
										</div>
										<div class="col-md-3">
											<input type="submit" class="form-control btn btn-success" value="Fetch">
										</div>
									</form>
									<div class="col-md-3">
									<?php if(in_array('1',$other_action)){ ?>
										<input type="button" class="form-control btn btn-success" data-toggle="modal" data-target="#addClass" value="Add New">
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
                                        <th>Topic</th>
                                        <th>Class Time</th>
                                        <th>Username</th>
										<th>Password</th>
										<th>LastUpdate</th>
										<th>UpdateBy</th>
										<th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
								<tbody>
									<?php $i=1; foreach($class as $cls){ ?>
										<tr>
											<td><?=$i;?></td>
											<td><?=$cls->topic;?></td>
											<td><?=$cls->class_time;?></td>
											<td><?=$cls->username;?></td>
											<td><?=$cls->password;?></td>
											<td><?=$cls->last_update;?></td>
											<td><?=$user_info[$cls->update_by]->f_name;?></td>
											<td id="class-<?= $cls->id; ?>"><?php if(in_array('3',$other_action)){ ?><?= ($cls->status == 'D')?'<a href="#" data-id="'.$cls->id.'" data-status="'.$cls->status.'" class="change-status badge badge-primary">ACTIVE</a>':'<a href="#" data-id="'.$cls->id.'" data-status="'.$cls->status.'" class="change-status badge badge-danger">DEACTIVE</a>'; } ?></td>
											<td>
											<?php if(in_array('2',$other_action)){ ?>
											<a href="#" class="edit-button btn btn-success" data-toggle="modal" data-target="#editClass" data-batch="<?=$cls->batch_code;?> | <?=$batch[$cls->batch_code]->topic;?>" data-batch_code="<?=$cls->batch_code;?>" data-id="<?=$cls->id;?>" data-topic="<?=$cls->topic;?>" data-date="<?=date('Y-m-d',strtotime($cls->class_time));?>" data-hour="<?=date('H',strtotime($cls->class_time));?>" data-minute="<?=date('i',strtotime($cls->class_time));?>" data-username="<?=$cls->username;?>" data-password="<?=$cls->password;?>" data-link="<?=$cls->zoom_link;?>" >Edit</a>
											<?php } ?>
											</td>
										</tr>
									<?php $i++; } ?>
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
	
<div class="modal fade" id="addClass" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Class</h4>
			</div>
			<div class="modal-body">
				<div class="tab-content">
					<div id="mediaadd" class="tab-pane fade in active">
						<div class="row">
							<div class="col-sm-12 attach-details">
								<form class="form-submit" method="post" action="<?= site_url('content/add_2020_class')?>">
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<label>Batch Code</label>
											<input type="text" name="batch" class="form-control batchsearch" placeholder="Batch Code">
											<input type="hidden" name="batch_code">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Topic</label>
											<input type="text" name="topic" class="form-control" placeholder="Class Name">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Zoom Link</label>
											<input type="text" name="link" class="form-control" placeholder="Zoom Link">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<label>User Name</label>
											<input type="text" name="username" class="form-control" placeholder="Username">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Password</label>
											<input type="text" name="password" class="form-control" placeholder="Password">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Class Date</label>
											<input type="text" id="datepicker1" name="class_date" class="form-control" placeholder="YYYY-MM-DD">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Class Time</label>
											<div style="display: flex;">
											<select name="hour" class="form-control" style="width:50%;">
												<?php for($i=0;$i<24;$i++){ ?>
													<option value="<?=$i;?>"><?=$i;?></option>
												<?php }?>
											</select>
											<select name="minute" class="form-control" style="width:50%;">
												<?php for($i=0;$i<60;$i++){ ?>
													<option value="<?=$i;?>"><?=$i;?></option>
												<?php }?>
											</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group">
											<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Add Class</span></button>
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
<div class="modal fade" id="editClass" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Class</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12 attach-details">
						<form class="form-submit" method="post" action="<?= site_url('content/update_2020_class')?>">
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group" >
									<label>Batch Code</label>
									<input type="text" name="edt_batch" class="form-control editbatchsearch" placeholder="Batch Code">
									<input type="hidden" name="edt_batch_code">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12 form-group" >
									<label>Topic</label>
									<input type="text" name="edt_topic" class="form-control" placeholder="Class Name">
								</div>
								<div class="col-md-6 col-sm-12 form-group" >
									<label>Zoom Link</label>
									<input type="text" name="edt_link" class="form-control" placeholder="Zoom Link">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12 form-group" >
									<label>User Name</label>
									<input type="text" name="edt_username" class="form-control" placeholder="Username">
								</div>
								<div class="col-md-6 col-sm-12 form-group" >
									<label>Password</label>
									<input type="text" name="edt_password" class="form-control" placeholder="Password">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12 form-group" >
									<label>Class Date</label>
									<input type="text" id="datepicker2" name="edt_class_date" class="form-control" placeholder="YYYY-MM-DD">
								</div>
								<div class="col-md-6 col-sm-12 form-group" >
									<label>Class Time</label>
									<div style="display: flex;">
									<select name="edt_hour" class="form-control" style="width:50%;">
										<?php for($i=0;$i<24;$i++){ ?>
											<option value="<?=$i;?>"><?=$i;?></option>
										<?php }?>
									</select>
									<select name="edt_minute" class="form-control" style="width:50%;">
										<?php for($i=0;$i<60;$i++){ ?>
											<option value="<?=$i;?>"><?=$i;?></option>
										<?php }?>
									</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group">
									<input type="hidden" name="class_id" value="">
									<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Update Class</span></button>
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
                dateFormat: 'yy-mm-dd'
            });
            $( "#datepicker1,#datepicker2" ).datepicker({
				dateFormat: 'yy-mm-dd'
            });
			
			$(".batchsearch").autocomplete({
				source: "<?= site_url('virtual_classroom/searchbatchcode'); ?>",
				focus: function( event, ui ) {
					$(this).val( ui.item.label );
					return false;
				},
				select: function( event, ui ) {
					$('input[name=batch_code]').attr('value',ui.item.code);
					$('input[name=batch]').attr('value',ui.item.label);
				}
			});
			
			$(".editbatchsearch").autocomplete({
				source: "<?= site_url('virtual_classroom/searchbatchcode'); ?>",
				focus: function( event, ui ) {
					$(this).val( ui.item.label );
					return false;
				},
				select: function( event, ui ) {
					$('input[name=edt_batch_code]').attr('value',ui.item.code);
					$('input[name=edt_batch]').attr('value',ui.item.label);
				}
			});
			
			$('.edit-button').on('click',function(){
				var id = $(this).data('id');
				var batch_code = $(this).data('batch_code');
				var batch = $(this).data('batch');
				var topic = $(this).data('topic');
				var link = $(this).data('link');
				var username = $(this).data('username');
				var password = $(this).data('password');
				var date = $(this).data('date');
				var hour = $(this).data('hour');
				var minute = $(this).data('minute');
			
				$('input[name=class_id]').attr('value',id);
				$('input[name=edt_topic]').attr('value',topic);
				$('input[name=edt_batch]').attr('value',batch);
				$('input[name=edt_batch_code]').attr('value',batch_code);
				$('input[name=edt_link]').attr('value',link);
				$('input[name=edt_username]').attr('value',username);
				$('input[name=edt_password]').attr('value',password);
				$('input[name=edt_class_date]').attr('value',date);
				$('select[name=edt_hour]').find("option[value='"+hour+"']").attr('selected','selected');
				$('select[name=edt_minute]').find("option[value='"+minute+"']").attr('selected','selected');
			});
			
			$('.change-status').on('click', function(){
				var item = $(this).data('id');
				var status = $(this).data('status');
				if(item != "" && status != "")
				{
					$("#class-"+item).html("<img src='<?= base_url('assets'); ?>/images/loader.gif' style='width: 40px;'>");
					$.ajax({
						type: "POST",
						url: "<?= site_url('content/change_2020_class_status'); ?>",
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