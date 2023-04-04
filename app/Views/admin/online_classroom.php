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
	<style>
	.btn-custom {
		width: 100%;
		color: #fff;
		border-radius: 0;
		outline: 0 !important;
		font-weight: 500;
		background: #ee0000;
	}
	.media-list, .media-list1 {
		list-style-type: none;
		margin-top: 0;
		padding-top: 20px;
		padding-left: 0;
		height: 420px;
		overflow-y: overlay;
	}
	.media-list li, .media-list1 li {
		display: inline-block;
		margin-bottom: 12px;
	}
	.media-list1 input[type=radio] {
		display: none;
		position: relative;
		top: -67px;
		left: 12px;
	}
	.media-list img, .media-list1 img {
		width: 130px;
		height: 120px;
	}
	.attach-details {
		background: #f2f2f2;
		padding: 10px 10px;
		overflow-y: scroll;
	}
	.attach-details h6 {
		text-transform: uppercase;
		text-align: center;
	}
	.attach-details img {
		width: 100%;
		height: 140px;
	}
	.attach-details hr {
		border-top: 1px solid #ddd;
	}
	.attach-details .form-group {
		display: inline-block;
		margin-bottom: 5px;
	}
	.attach-details label {
		display: inline-block;
		width: 100%;
		text-align: left;
		padding-right: 5px;
		font-size: 12px;
		font-weight: 500;
	}
	.attach-details .form-control {
		color: #666 !important;
		font-size: 14px;
		padding: 5px 5px;
		display: inline-block;
		width: 100%;
		vertical-align: middle;
	}
	.btn-custom {
		width: 100%;
		color: #fff;
		border-radius: 0;
		outline: 0 !important;
		font-weight: 500;
		background: #ee0000;
	}
	.btn-custom span.btn-val {
		top: 0;
		right: 0;
		padding: 0;
		color: #fff;
		font-size: 14px;
		cursor: pointer;
		display: inline-block;
		position: relative;
		transition: 0.5s;
	}
	.modal-dialog{
		margin: 0px auto;
	}
	.radio-control label {
		width: 20%;
		font-size: 16px;
	}
	.width-33{
		width: 33% !important;
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
                                <h1>Online Classroom</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Online Classroom</li>
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
									<form action="<?= site_url('web-admin/online_classroom');?>" method="post">
										<div class="col-md-3">
											<input type="text" id="datepicker1" class="form-control" name="class_date" value="<?=$class_date;?>" placeholder="YYYY-MM-DD">
										</div>
										<div class="col-md-3">
										<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
											<input type="submit" class="form-control btn btn-success" value="Fetch">
										</div>
									</form>
									<div class="col-md-3 text-right">
										<?php if(in_array('1',$other_action)){ ?>
										<input type="button" class="form-control btn btn-success" data-toggle="modal" data-target="#addObject" value="Add">
										<?php } ?>
									</div>
									<div class="col-md-3 text-right">
										<?php if(in_array('1',$other_action)){ ?>
										<input type="button" class="form-control btn btn-success" data-toggle="modal" data-target="#uploadObject" value="Upload">
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
                                        <th>Program</th>
                                        <th>Course</th>
                                        <th>Date</th>
                                        <th>StartTime</th>
                                        <th>EndTime</th>
                                        <th>LastUpdate</th>
										<th>UpdateBy</th>
										<th>Status</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
								<tbody>
									<?php $i=1; foreach($classroom as $cls){ ?>
									<tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$cls->program;?></td>
                                        <td><?=$cls->course;?></td>
                                        <td><?=$cls->class_date;?></td>
                                        <td><?=$cls->start_time;?></td>
                                        <td><?=$cls->end_time;?></td>
                                        <td><?= date('Y-m-d H:i:s',strtotime($cls->last_update)); ?></td>
										<td><?=$user_info[$cls->update_by]->f_name;?></td>
										<td id="status-<?= $cls->id; ?>"><?= ($cls->status == 'D')?'<a href="#" data-id="'.$cls->id.'" data-status="'.$cls->status.'" class="change-status badge badge-primary">ACTIVE</a>':'<a href="#" data-id="'.$cls->id.'" data-status="'.$cls->status.'" class="change-status badge badge-danger">DEACTIVE</a>'; ?></td>
                                        <td>
										<?php if(in_array('2',$other_action)){ ?>
											<a href="#" class="edit-object" data-program="<?=$cls->program;?>" data-course="<?=$cls->course;?>" data-class_date="<?=$cls->class_date;?>" data-start_time="<?=$cls->start_time;?>" data-end_time="<?=$cls->end_time;?>" data-id="<?=$cls->id;?>" data-link="<?=$cls->link;?>" data-toggle="modal" data-target="#editobject"><i class="ti-pencil-alt" aria-hidden="true"></i></a>
										<?php } ?>
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
<div class="modal fade" id="editobject" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Classroom</h4>
			</div>
			<div class="modal-body">
				<div class="tab-content">
					<div id="mediaedit" class="tab-pane fade in active">
						<div class="row">
							<div class="col-sm-12 attach-details">
								<form class="form-submit" method="post" action="<?= site_url('Online_classroom/update_classroom'); ?>">
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<select name="edt_program" class="form-control">
												<option value="CC">CC</option>
												<option value="CFT">CFT</option>
												<option value="TISS">TISS</option>
												<option value="IGNOU">IGNOU</option>
												<option value="SEMINAR">SEMINAR</option>
												<option value="WEBINAR">WEBINAR</option>
												<option value="WORKSHOP">WORKSHOP</option>
											</select>
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<input type="text" name="edt_course" class="form-control" placeholder="Course Title">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<input type="text" id="datepicker2" name="edt_class_date" class="form-control" placeholder="YYYY-MM-DD">
										</div>
									</div>
									<div class="row">
										<div class="col-md-2 col-sm-12 form-group" >
											<p>Start Time</p>
										</div>
										<div class="col-md-2 col-sm-12 form-group" >
											<select name="edt_start_hour" class="form-control">
												<?php for($i=0;$i<24;$i++){ ?>
													<option value="<?=(($i<10)?0:'')?><?=$i;?>"><?=(($i<10)?0:'')?><?=$i;?></option>
												<?php } ?>
											</select>
										</div>
										<div class="col-md-2 col-sm-12 form-group" >
											<select name="edt_start_minute" class="form-control">
												<?php for($i=0;$i<60;$i=$i+5){ ?>
													<option value="<?=(($i<10)?0:'')?><?=$i;?>"><?=(($i<10)?0:'')?><?=$i;?></option>
												<?php } ?>
											</select>
										</div>
										<div class="col-md-2 col-sm-12 form-group" >
											<p>End Time</p>
										</div>
										<div class="col-md-2 col-sm-12 form-group" >
											<select name="edt_end_hour" class="form-control">
												<?php for($i=0;$i<24;$i++){ ?>
													<option value="<?=(($i<10)?0:'')?><?=$i;?>"><?=(($i<10)?0:'')?><?=$i;?></option>
												<?php } ?>
											</select>
										</div>
										<div class="col-md-2 col-sm-12 form-group" >
											<select name="edt_end_minute" class="form-control">
												<?php for($i=0;$i<60;$i=$i+5){ ?>
													<option value="<?=(($i<10)?0:'')?><?=$i;?>"><?=(($i<10)?0:'')?><?=$i;?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<input type="text" name="edt_class_link" class="form-control" placeholder="Class Link">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group">
											<input type="hidden" name="classroom_id" value="">
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
    </div>
</div>
<!--End Add Home Slide-->


<div class="modal fade" id="uploadObject" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">ClassRoom</h4>
			</div>
			<div class="modal-body">
				<div class="tab-content">
					<div id="mediaadd" class="tab-pane fade in active">
						<div class="row">
							<div class="col-sm-12 attach-details">
								<form class="form-submit" method="post" action="<?= site_url('Online_classroom/upload_classroom'); ?>">
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Upload File (.csv)</label>
											<input type="file" class="form-control" name="upload_file" >
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Schedule Date</label>
											<input type="text" id="datepicker4" name="schedule_date" class="form-control" placeholder="YYYY-MM-DD" >
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group">
											<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Upload Classes</span></button>
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


<div class="modal fade" id="addObject" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">ClassRoom</h4>
			</div>
			<div class="modal-body">
				<div class="tab-content">
					<div id="mediaadd" class="tab-pane fade in active">
						<div class="row">
							<div class="col-sm-12 attach-details">
								<form class="form-submit" method="post" action="<?= site_url('Online_classroom/add_classroom')?>">
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<select name="program" class="form-control">
												<option value="CC">CC</option>
												<option value="CFT">CFT</option>
												<option value="TISS">TISS</option>
												<option value="IGNOU">IGNOU</option>
												<option value="SEMINAR">SEMINAR</option>
												<option value="WEBINAR">WEBINAR</option>
												<option value="WORKSHOP">WORKSHOP</option>
											</select>
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<input type="text" name="course" class="form-control" placeholder="Course Title">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<input type="text" id="datepicker3" name="class_date" class="form-control" placeholder="YYYY-MM-DD">
										</div>
									</div>
									<div class="row">
										<div class="col-md-2 col-sm-12 form-group" >
											<p>Start Time</p>
										</div>
										<div class="col-md-2 col-sm-12 form-group" >
											<select name="start_hour" class="form-control">
												<?php for($i=0;$i<24;$i++){ ?>
													<option value="<?=(($i<10)?0:'')?><?=$i;?>"><?=(($i<10)?0:'')?><?=$i;?></option>
												<?php } ?>
											</select>
										</div>
										<div class="col-md-2 col-sm-12 form-group" >
											<select name="start_minute" class="form-control">
												<?php for($i=0;$i<60;$i=$i+5){ ?>
													<option value="<?=(($i<10)?0:'')?><?=$i;?>"><?=(($i<10)?0:'')?><?=$i;?></option>
												<?php } ?>
											</select>
										</div>
										<div class="col-md-2 col-sm-12 form-group" >
											<p>End Time</p>
										</div>
										<div class="col-md-2 col-sm-12 form-group" >
											<select name="end_hour" class="form-control">
												<?php for($i=0;$i<24;$i++){ ?>
													<option value="<?=(($i<10)?0:'')?><?=$i;?>"><?=(($i<10)?0:'')?><?=$i;?></option>
												<?php } ?>
											</select>
										</div>
										<div class="col-md-2 col-sm-12 form-group" >
											<select name="end_minute" class="form-control">
												<?php for($i=0;$i<60;$i=$i+5){ ?>
													<option value="<?=(($i<10)?0:'')?><?=$i;?>"><?=(($i<10)?0:'')?><?=$i;?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<input type="text" name="class_link" class="form-control" placeholder="Class Link">
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
            $( "#datepicker1,#datepicker2,#datepicker3,#datepicker4" ).datepicker({
				dateFormat: 'yy-mm-dd',
                changeYear: true,
                changeMonth: true
            });
			
			$('.edit-object').on('click',function(){
				
				var id = $(this).data('id');
				var program = $(this).data('program');
				var course = $(this).data('course');
				var class_date = $(this).data('class_date');
				var start_time = $(this).data('start_time');
				var end_time = $(this).data('end_time');
				var class_link = $(this).data('link');
				var start_cls_time = start_time.split(":");
				var end_cls_time = end_time.split(":");
				
				$('input[name=classroom_id]').attr('value',id);
				$('select[name=edt_program]').find("option[value='"+program+"']").attr('selected','selected');
				$('input[name=edt_course]').attr('value',course);
				$('input[name=edt_class_date]').attr('value',class_date);
				$('input[name=edt_class_link]').attr('value',class_link);
				$('select[name=edt_start_hour]').find("option[value='"+start_cls_time[0]+"']").attr('selected','selected');
				$('select[name=edt_start_minute]').find("option[value='"+start_cls_time[1]+"']").attr('selected','selected');
				$('select[name=edt_end_hour]').find("option[value='"+end_cls_time[0]+"']").attr('selected','selected');
				$('select[name=edt_end_minute]').find("option[value='"+end_cls_time[1]+"']").attr('selected','selected');
				
			});
			
			$('.change-status').on('click', function(){
				var item = $(this).data('id');
				var status = $(this).data('status');
				if(item != "" && status != "")
				{
					$("#status-"+item).html("<img src='<?= base_url('assets'); ?>/images/loader.gif' style='width: 40px;'>");
					$.ajax({
						type: "POST",
						url: "<?= site_url('Online_classroom/change_class_status'); ?>",
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