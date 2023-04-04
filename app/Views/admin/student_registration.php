<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CFT : Managemant system</title>
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
                                <h1>Student Registration</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Registration</li>
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
									<form action="<?=site_url('student_registration');?>" method="post">
										<div class="col-md-6">
											<input type="text" class="form-control" name="email_id" value="<?=$email_id;?>" placeholder="Student Email ID">
										</div>
										<div class="col-md-2">
											<input type="submit" class="form-control btn btn-success" value="Fetch">
										</div>
									</form>
									<?php if(in_array('1',$other_action)){ ?>
									<div class="col-md-2">
										<a class="form-control btn btn-success" href="#" data-toggle="modal" data-target="#addStudent">Add</a>
									</div>
									<div class="col-md-2">
										<a class="form-control btn btn-success" href="#" data-toggle="modal" data-target="#uploadExcel">Upload</a>
									</div>
									<?php } ?>
								</div>
								<div class="row form-group">
									<form action="<?=site_url('student_registration');?>" method="post">
										<div class="col-md-5">
											<input type="text" class="form-control datepicker" name="from_date" value="<?=$from_date;?>" placeholder="YYYY-MM-DD">
										</div>
										<div class="col-md-5">
											<input type="text" class="form-control datepicker" name="to_date" value="<?=$to_date;?>" placeholder="YYYY-MM-DD">
										</div>
										<div class="col-md-2">
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
                                        <th>Details</th>
                                        <th>Type</th>
                                        <th>LastUpdate</th>
										<th>UpdateBy</th>
                                        <th>Update</th>
										<th>Action</th>
                                    </tr>
                                </thead>
								<tbody>
									<?php $i=1; foreach($student as $stu){ ?>
									<tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$stu->name;?><br><?=$stu->email_id;?><br><?=$stu->contact;?><br><?=$stu->dob;?></td>
                                        <td><?=$member[$stu->type];?></td>
                                        <td><?= date('Y-m-d H:i:s',strtotime($stu->last_update)); ?></td>
										<td><?=(isset($user_info[$stu->update_by])?$user_info[$stu->update_by]->f_name:'Student');?></td>
										<td id="student-<?= $stu->id; ?>">
											<?= ($stu->status == 'D')?'<a href="#" data-id="'.$stu->id.'" data-status="'.$stu->status.'" class="change-status badge badge-primary">ACTIVE</a>':'<a href="#" data-id="'.$stu->id.'" data-status="'.$stu->status.'" class="change-status badge badge-danger">DEACTIVE</a>'; ?>
											<br>
											<a href="#" data-id="<?= $stu->id; ?>" class="send-email badge badge-primary">Send Email</a>
											<br>
											<a href="#" data-id="<?=$stu->id;?>" data-type="<?=$stu->type;?>" class="upgrade-student badge badge-primary" data-toggle="modal" data-target="#upgradeStudent">Upgrade</a>
										</td>
                                        <td>
										<?php if(in_array('2',$other_action)){ ?>
											<a href="#" class="edit-student" data-id="<?=$stu->id?>" data-name="<?=$stu->name;?>" data-email_id="<?=$stu->email_id;?>" data-contact="<?=$stu->contact;?>" data-password="<?=$stu->password;?>" data-program="<?=$stu->program;?>" data-qualification="<?=$stu->qualification;?>" data-dob="<?=$stu->dob;?>" data-gender="<?=$stu->gender;?>" data-address="<?=$stu->address;?>" data-consultant="<?=$stu->consultant;?>" data-toggle="modal" data-target="#editStudent"><i class="ti-pencil-alt" aria-hidden="true"></i></a>
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
	
	
<div class="modal fade" id="upgradeStudent" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Upgrade Membership</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12 attach-details">
						<form class="form-submit" method="post" action="<?= site_url('student/upgrade_student')?>">
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group" >
									<label>Type</label>
									<select name="membership" class="form-control">
										<?php foreach($member as $id => $name){ if($id != 5){ ?>
										<option value="<?=$id;?>"><?=$name;?></option>
										<?php } } ?>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group">
									<input type="hidden" name="upgrade_id" value="">
									<button type="submit" class="btn btn-success form-control">Upgrade Student</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>	
	
<div class="modal fade" id="uploadExcel" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">ExcelFile</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12 attach-details">
						<form class="form-submit" method="post" action="<?= site_url('student/upload_student')?>" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-6 col-sm-12 form-group" >
									<label>File (.csv)</label>
									<input type="file" name="file" class="form-control" placeholder="Student List">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group">
									<button type="submit" class="btn btn-success" style="width: 100%;"> 
										<span class="btn-val">Upload Student</span>
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>	
  <!--add slider-->

<div class="modal fade" id="editStudent" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Update Student</h4>
			</div>
			<div class="modal-body">
				<div class="tab-content">
					<div id="mediaadd" class="tab-pane fade in active">
						<div class="row">
							<div class="col-sm-12 attach-details">
								<form class="form-submit" method="post" action="<?= site_url('student/update_student'); ?>">
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Name</label>
											<input type="text" name="edt_name" class="form-control" placeholder="Name">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Contact</label>
											<input type="text" name="edt_contact" class="form-control" placeholder="Contact">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Email ID</label>
											<input type="text" name="edt_email_id" class="form-control" readonly placeholder="Email ID">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Password</label>
											<input type="text" name="edt_password" class="form-control" placeholder="Password">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Program</label>
											<input type="text" name="edt_program" class="form-control" placeholder="Program">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Qualification</label>
											<input type="text" name="edt_qualification" class="form-control" placeholder="Qualification">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<label>DOB</label>
											<input type="text" name="edt_dob" id="datepicker" autocomplete="off" class="form-control" placeholder="YYYY-MM-DD">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Gender</label>
											<select class="form-control" name="edt_gender">
												<option value="M">Male</option>
												<option value="F">Female</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-6">
											<label>Consultant</label>
											<select name="edt_consultant" class="form-control">
												<option value="0">None</option>
												<?php foreach($consultant as $csl){ ?>
												<option value="<?=$csl->id;?>"><?=ucfirst(strtolower($csl->name));?></option>
												<?php } ?>
											</select>
										</div>
										<div class="col-md-6 col-sm-6 form-group" >
											<label>Address</label>
											<textarea name="edt_address" class="form-control" placeholder="Address"></textarea>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group">
											<input type="hidden" name="student_id" value="">
											<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Update Student</span></button>
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
<div class="modal fade" id="addStudent" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Student</h4>
			</div>
			<div class="modal-body">
				<div class="tab-content">
					<div id="mediaadd" class="tab-pane fade in active">
						<div class="row">
							<div class="col-sm-12 attach-details">
								<form class="form-submit" method="post" action="<?= site_url('student/add_student'); ?>">
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Name</label>
											<input type="text" name="name" class="form-control" placeholder="Name">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Contact</label>
											<input type="text" name="contact" class="form-control" placeholder="Contact">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Email ID</label>
											<input type="text" name="email_id" class="form-control" placeholder="Email ID">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Password</label>
											<input type="text" name="password" class="form-control" placeholder="Password">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Program</label>
											<input type="text" name="program" class="form-control" placeholder="Program">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Qualification</label>
											<input type="text" name="qualification" class="form-control" placeholder="Qualification">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<label>DOB</label>
											<input type="text" name="dob" id="datepicker1" autocomplete="off" class="form-control" placeholder="YYYY-MM-DD">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Gender</label>
											<select class="form-control" name="gender">
												<option value="M">Male</option>
												<option value="F">Female</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-6">
											<label>Consultant</label>
											<select name="consultant" class="form-control">
												<option value="0">None</option>
												<?php foreach($consultant as $csl){ ?>
												<option value="<?=$csl->id;?>"><?=ucfirst(strtolower($csl->name));?></option>
												<?php } ?>
											</select>
										</div>
										<div class="col-md-6 col-sm-6 form-group" >
											<label>Address</label>
											<textarea name="address" class="form-control" placeholder="Address"></textarea>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group">
											<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Add Student</span></button>
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
                dateFormat: 'yy-mm-dd',
                changeYear: true,
                changeMonth: true
            });
			$( ".datepicker" ).datepicker({
                dateFormat: 'yy-mm-dd',
                changeYear: true,
                changeMonth: true
            });
            $( "#datepicker1,#datepicker2" ).datepicker({
				dateFormat: 'yy-mm-dd',
                changeYear: true,
                changeMonth: true
            });
			
			$('.edit-student').on('click',function(){
				var id = $(this).data('id');
				var name = $(this).data('name');
				var email_id = $(this).data('email_id');
				var contact = $(this).data('contact');
				var password = $(this).data('password');
				var program = $(this).data('program');
				var qualification = $(this).data('qualification');
				var dob = $(this).data('dob');
				var gender = $(this).data('gender');
				var consultant = $(this).data('consultant');
				var address = $(this).data('address');
				
				$('input[name=student_id]').attr('value',id);
				$('input[name=edt_name]').attr('value',name);
				$('input[name=edt_email_id]').attr('value',email_id);
				$('input[name=edt_contact]').attr('value',contact);
				$('input[name=edt_password]').attr('value',password);
				$('input[name=edt_program]').attr('value',program);
				$('input[name=edt_qualification]').attr('value',qualification);
				$('input[name=edt_dob]').attr('value',dob);
				$('textarea[name=edt_address]').html(address);
				$('select[name=edt_gender]').find("option[value='"+gender+"']").attr('selected','selected');
				$('select[name=edt_consultant]').find("option[value='"+consultant+"']").attr('selected','selected');
			});
			
			$('.upgrade-student').on('click',function(){
				var id = $(this).data('id');
				var type = $(this).data('type');
				
				$('select[name=membership]').find('option[value='+type+']').attr('selected','selected');
				$('input[name=upgrade_id]').attr('value',id); 
			});
			
			$('.send-email').on('click', function(){
				var item = $(this).data('id');
				var button = $("#student-"+item).html();
				$("#student-"+item).html("<img src='<?= base_url('assets'); ?>/images/loader.gif' style='width: 40px;'>");
					$.ajax({
					type: "POST",
					url: "<?= site_url('student/student_detail_email'); ?>",
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
						$("#student-"+item).html(button);
					}
				});
			});
			
			$('.change-status').on('click', function(){
				var item = $(this).data('id');
				var status = $(this).data('status');
				if(item != "" && status != "")
				{
					$("#student-"+item).html("<img src='<?= base_url('assets'); ?>/images/loader.gif' style='width: 40px;'>");
					$.ajax({
						type: "POST",
						url: "<?= site_url('student/change_student_status'); ?>",
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