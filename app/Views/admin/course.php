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
		height: 420px;
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
		width: 90%;
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
                                <h1>Course</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Course</li>
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
									<form action="<?=site_url('course');?>" method="get">
										<div class="col-md-3">
											<select class="form-control" name="program_id">
												<option value="0" <?php echo (($program_id==0)?'selected':''); ?>>All</option>
											<?php foreach($program as $pg => $pgdt){ ?>
												<option value="<?=$pgdt->id;?>" <?php echo (($program_id==$pgdt->id)?'selected':''); ?>><?=ucfirst($pgdt->title);?></option>
											<?php } ?>
											</select>
										</div>
										<div class="col-md-3">
											<select class="form-control" name="status">
												<option value="0" <?php echo (($status=='0')?'selected':''); ?>>All</option>
												<option value="A" <?php echo (($status=='A')?'selected':''); ?>>ACTIVE</option>
												<option value="D" <?php echo (($status=='D')?'selected':''); ?>>DEACTIVE</option>
											</select>
										</div>
										<div class="col-md-3">
											<input type="submit" class="form-control btn btn-success" value="Fetch">
										</div>
									</form>
									<div class="col-md-3 text-right">
										<?php if(in_array('1',$other_action)){ ?>
										<input type="button" class="form-control btn btn-success" data-toggle="modal" data-target="#addcourse" value="Add">
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
                                        <th>Code</th>
                                        <th>Title</th>
                                        <th>Program</th>
                                        <th>LastUpdate</th>
										<th>UpdateBy</th>
										<th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
								<tbody>
									<?php $i=1; foreach($course as $crs){ ?>
									<tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$crs->course_code;?></td>
                                        <td><?=$crs->title;?></td>
                                        <td><?=$program[$crs->program_id]->title;?></td>
                                        <td><?= date('Y-m-d H:i:s',strtotime($crs->last_update)); ?></td>
										<td><?=$user_info[$crs->update_by]->f_name;?></td>
										<td id="course-<?= $crs->id; ?>">
										<?php if(in_array('3',$other_action)){ ?>
											<?= ($crs->status == 'D')?'<a href="#" data-id="'.$crs->id.'" data-status="'.$crs->status.'" class="change-status badge badge-primary">ACTIVE</a>':'<a href="#" data-id="'.$crs->id.'" data-status="'.$crs->status.'" class="change-status badge badge-danger">DEACTIVE</a>'; ?>
										<?php } ?>  </br>
										<select class="form-control faculty1"  data-change="<?= $crs->id;?>" name="faculty">
												<option value="0">Select</option>
											<?php foreach($faculty as $fct){ ?>
													<option value="<?=$fct->id;?>" <?=(isset($faculty_course[$crs->id]) && ($faculty_course[$crs->id] == $fct->id))?'selected':'';?> ><?=ucfirst($fct->name);?></option>
											<?php } ?>
										</select>
										</td>
                                        <td>
										<?php if(in_array('2',$other_action)){ ?>
											<a href="#" class="edit-course" data-description="<?=$crs->description;?>" data-allow="<?=$crs->allow_for;?>" data-code="<?=$crs->course_code;?>" data-id="<?=$crs->id;?>" data-program_id="<?=$crs->program_id;?>" data-title="<?=$crs->title;?>" data-img-id="<?=$crs->img_id;?>" data-img-alt="<?=$crs->img_alt;?>" data-img-title="<?=$crs->img_title;?>" data-img-src="<?=web_url();?>images/<?=(isset($images[$crs->img_id])?$images[$crs->img_id]->location:'');?>" data-toggle="modal" data-target="#editcourse"><i class="ti-pencil-alt" aria-hidden="true"></i></a> 
											<a target="_blank" href="<?=web_url();?>course-detail/<?=isset($course_url[$crs->id])?$course_url[$crs->id]:'';?>.html"><i class="ti-eye" aria-hidden="true"></i></a>
										<?php } ?>
										<?php if(in_array('2',$other_action)){ ?>
											<a href="<?=site_url("content/course_detail/".$crs->id);?>" class="badge badge-primary">Detail</a>
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
<div class="modal fade" id="editcourse" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Course</h4>
			</div>
			<div class="modal-body">
				<ul class="nav nav-tabs">
					<li ><a data-toggle="tab" href="#uploadedit">Upload Files</a></li>
					<li class="active"><a data-toggle="tab" href="#mediaedit">Media Library</a></li>
				</ul>
				<div class="tab-content">
					<div id="uploadedit" class="tab-pane fade">
						<form class="form-submit" style="margin:40px 0;" action="<?= site_url('content/upload_course_img')?>" method="post" enctype="multipart/form-data">
							<input type="file" name="course_images[]" multiple>
							<small>Image Size : (370x240)</small>
							<p><button type="submit" width="100%" class="btn btn-primary" style="margin-top:10px;"> <span class="btn-val">Upload</span></button></p>
						</form>
					</div>
					<div id="mediaedit" class="tab-pane fade in active">
						<div class="row">
							<div class="col-sm-6">
								<ul class="media-list1">
									<?php foreach($images as $img){?>
									<li>
										<label> <input type='radio' value='<?= $img->id; ?>' name='imgradio'/> <img class="edit-img-select" data-id="<?= $img->id; ?>" src='<?= web_url(); ?>images/<?= $img->location; ?>' class='single-image'/> </label>
									</li>
									<?php } ?>
								</ul>
							</div>

							<div class="col-sm-6 attach-details">
								<form class="form-submit" method="post" action="<?= site_url('content/update_course')?>">
									<div class="row">
										<div class="col-md-6">
											<img src="<?=base_url("assets/images/question/")?>Penguins.jpg"  id="edit-display-img" class="m-b-10" title="">
											<input type="hidden" name="edt_img_id" id="edit_img_id" class="form-control">
										</div>
										<div class="col-md-6">
											<input type="text" name="edt_img_title" class="form-control" placeholder="Image Title">
											<input type="text" name="edt_img_alt" class="form-control" placeholder="Image Alt">
											<?php 
												foreach($membership as $mem){
													echo '<label class="width-33"><input class="edt_mem_checkbox" type="checkbox" name="edt_membership[]" value="'.$mem->id.'">'.$mem->name.'</label>';
												}
											?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<input type="text" name="edt_code" class="form-control" placeholder="Course Code">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<input type="text" name="edt_title" class="form-control" placeholder="Course Title">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<select class="form-control" name="edt_program">
											<?php foreach($program as $pg_id => $v){ ?>
												<option value="<?= $pg_id; ?>"><?= $v->title; ?></option>
											<?php } ?>
											</select>
										</div>
									</div>
									<!--
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Credit</label>
											<input type="number" name="credit" class="form-control" placeholder="Course Credit">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Price</label>
											<input type="text" name="price" class="form-control" placeholder="Course Price">
										</div>
									</div>
									-->
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<textarea name="edt_description" class="form-control" placeholder="Description"></textarea>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group">
											<input type="hidden" name="edt_id" value="">
											<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Update Course</span></button>
										</div>
										<div class="col-md-6 col-sm-12 form-group">
											<button type="button" class="edit-delete-img btn btn-danger" data-img-id="" style="width: 100%;"> <span class="btn-val">Delete Image</span></button>
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
<!--End Add Home Slide-->
	
<div class="modal fade" id="addcourse" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Course</h4>
			</div>
			<div class="modal-body">
				<ul class="nav nav-tabs">
					<li ><a data-toggle="tab" href="#uploadadd">Upload Files</a></li>
					<li class="active"><a data-toggle="tab" href="#mediaadd">Media Library</a></li>
				</ul>
				<div class="tab-content">
					<div id="uploadadd" class="tab-pane fade">
						<form class="form-submit" style="margin:40px 0;" action="<?= site_url('Content/upload_course_img')?>" method="post" enctype="multipart/form-data">
							<input type="file" name="course_images[]" multiple>
							<small>Image Size : (370x240)</small>
							<p><button type="submit" width="100%" class="btn btn-primary" style="margin-top:10px;"> <span class="btn-val">Upload</span></button></p>
						</form>
					</div>
					<div id="mediaadd" class="tab-pane fade in active">
						<div class="row">
							<div class="col-sm-6">
								<ul class="media-list1">
									<?php foreach($images as $img){?>
									<li>
										<label> <input type='radio' value='<?= $img->id; ?>' name='imgradio'/> <img class="img-select" data-id="<?= $img->id; ?>" src='<?= web_url(); ?>images/<?= $img->location; ?>' class='single-image'/> </label>
									</li>
									<?php } ?>
								</ul>
							</div>

							<div class="col-sm-6 attach-details">
								<form class="form-submit" method="post" action="<?= site_url('content/add_course')?>">
									<div class="row">
										<div class="col-md-6">
											<img src="<?=web_url()."images/course/202006110050300.png";?>"  id="add-display-img" class="m-b-10" title="">
											<input type="hidden" name="img_id" id="add_img_id" value="110" class="form-control">
										</div>
										<div class="col-md-6">
											<input type="text" name="img_title" class="form-control" placeholder="Image Title">
											<input type="text" name="img_alt" class="form-control" placeholder="Image Alt">
											<?php 
												foreach($membership as $mem){
													echo '<label class="width-33"><input class="mem_checkbox" type="checkbox" name="membership[]" value="'.$mem->id.'">'.$mem->name.'</label>';
												}
											?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<input type="text" name="code" class="form-control" placeholder="Course Code">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<input type="text" name="title" class="form-control" placeholder="Course Title">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<select class="form-control" name="program">
											<?php foreach($program as $pg_id => $v){ ?>
												<option value="<?= $pg_id; ?>"><?= $v->title; ?></option>
											<?php } ?>
											</select>
										</div>
									</div>
									<!--
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Credit</label>
											<input type="number" name="credit" class="form-control" placeholder="Course Credit">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Price</label>
											<input type="text" name="price" class="form-control" placeholder="Course Price">
										</div>
									</div>
									-->
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<textarea name="description" class="form-control" placeholder="Description"></textarea>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group">
											<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Add Course</span></button>
										</div>
										<div class="col-md-6 col-sm-12 form-group">
											<button type="button" class="add-delete-img btn btn-danger" data-img-id="" style="width: 100%;"> <span class="btn-val">Delete Image</span></button>
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
			
			$('.img-select').on('click',function(){
				//alert($(this).data('id'));
				var img_src = $(this).attr('src');
				var img_id = $(this).data('id');
				$('#add-display-img').attr('src',img_src);
				$('#add_img_id').attr('value',img_id);
				$('.add-delete-img').attr('data-img-id',img_id);
				
			});
			$('.edit-img-select').on('click',function(){
				//alert($(this).data('id'));
				var img_src = $(this).attr('src');
				var img_id = $(this).data('id');
				$('#edit-display-img').attr('src',img_src);
				$('#edit_img_id').attr('value',img_id);
				$('.edit-delete-img').attr('data-img-id',img_id);
			});
			
			$('.add-delete-img,.edit-delete-img').on('click',function(){
				var img_id = $(this).data('img-id');
				if(parseInt(img_id) > 0)
				{
					if(window.confirm("Do you realy want to delete that Image."))
					{
						$.ajax({
							type: "POST",
							url: "<?= site_url('content/delete_course_image'); ?>",
							data: {img_id:img_id},
							dataType: 'json',
							cache: false,
							success: function(result){
								location.reload();
							}
						});
					}
				}
				else{
					alert("Please Select The Image First.");
				}
			});
			
			$('.edit-course').on('click',function(){
				$('.edt_mem_checkbox').prop('checked', false);
				var code = $(this).data('code');
				var id = $(this).data('id');
				var program_id = $(this).data('program_id');
				var title = $(this).data('title');
				var img_id = $(this).data('img-id');
				var img_src = $(this).data('img-src');
				var img_title = $(this).data('img-title');
				var img_alt = $(this).data('img-alt');
				var description = $(this).data('description');
				var allow_for = $(this).data('allow');
				var allow = allow_for.split(" ");
				$(allow).each(function(item,val){
					$('.edt_mem_checkbox[value="'+val+'"]').prop('checked', 'checked');
				});
				
				$('#edit-display-img').attr('src',img_src);
				$('input[name=edt_img_id]').attr('value',img_id);
				$('input[name=edt_img_title]').attr('value',img_title);
				$('input[name=edt_img_alt]').attr('value',img_alt);
				$('input[name=edt_title]').attr('value',title);
				$('input[name=edt_code]').attr('value',code);
				$('textarea[name=edt_description]').html(description);
				$('select[name=edt_program]').find("option[value='"+program_id+"']").attr('selected','selected');
				$('input[name=edt_id]').attr('value',id);
				$('.edit-delete-img').attr('data-img-id',img_id);
				
			});
			
			$('.faculty1').on('change',function()
			{
				var change = $(this).data('change');
				var id = this.value;
				//alert(change);
				//alert(id);
				
					$.ajax({
					type: "POST",
					url: "https://www.cftedu.in/lms/gadget/add_course_by_code",
					data: {faculty:id,course:change},
					dataType: 'json',
					cache: false,
				
					//success: == true
					success: function(result){
							if(result.success == true){
								alert("Add Successfully");
								location.reload();
							}else
							{
							alert("Not Added");	
							location.reload();
							}
							//$('.preloader').hide();
						}
					//success: == true
				});
			});
			
			
			
			$('.change-status').on('click', function(){
				var item = $(this).data('id');
				var status = $(this).data('status');
				if(item != "" && status != "")
				{
					$("#program-"+item).html("<img src='<?= base_url('assets'); ?>/images/loader.gif' style='width: 40px;'>");
					$.ajax({
						type: "POST",
						url: "<?= site_url('content/change_course_status'); ?>",
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