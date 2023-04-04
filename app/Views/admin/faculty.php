
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Faculty</title>
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
                                <h1>Faculty</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Faculty</li>
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
									<div class="col-md-12 text-right">
										<?php if(in_array('1',$other_action)){ ?>
										<a class="badge badge-success" href="#" data-toggle="modal" data-target="#addObject">Add</a>
										<?php } ?>
									</div>
								</div>
							</div>
                        </div>
                        <div class="card-body">
							<table class="table f-s-13">
                                <thead>
                                    <tr>
                                        <th>So no </th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Category</th>
										<th>LastUpdate</th>
										<th>UpdateBy</th>
                                        <th>Action</th>
										<th>Edit</th>
                                    </tr>
                                </thead>
								 <tbody>
                                    <?php  $i=1; if(isset($faculty_data)){ foreach($faculty_data as $crs){?>
									<tr>
                                        <td><?=$i++;?></td>
										<td><img src="<?=web_url();?>images/<?= $images[$crs->img_id]->location; ?>" width="100px"></td>
                                        <td><?= $crs->name; ?></td>
                                        <td><?= $crs->contact; ?></td>
                                        <td><?= $crs->email; ?></td>
                                        <td><?= $crs->faculty_type; ?></td>
                                         <td><?= $crs->last_update; ?></td>
                                        <td><?= $user_info[$crs->update_by]->f_name; ?></td>
                                        <td id="course-<?=$crs->id?>"><?= ($crs->status == 'D')?'<a href="#" data-id="'.$crs->id.'" data-status="'.$crs->status.'" class="change-status badge badge-primary">ACTIVE</a>':'<a href="#" data-id="'.$crs->id.'" data-status="'.$crs->status.'" class="change-status badge badge-danger">DEACTIVE</a>'; ?></td>
										
										
                                        <td><a class="edit-video badge badge-primary" href="#" 
										data-toggle="modal" 
										data-target="#edit-video"  
										data-name="<?= $crs->name; ?>" 
										data-email="<?= $crs->email; ?>" 
										data-age="<?= $crs->age; ?>" 
										data-contact="<?= $crs->contact; ?>" 
										data-specialization="<?= $crs->specialization; ?>" 
										data-qualification="<?= $crs->qualification; ?>" 
										data-cat_id="<?=$crs->faculty_type; ?>" 
										data-discription="<?=$crs->discription;?>" 
										data-img_id="<?=$crs->img_id;?>" 
										data-img_src="<?=web_url();?>images/<?= $images[$crs->img_id]->location; ?>"
										data-dignitaryid="<?= $crs->id; ?>" >Edit</a></td>
                                    </tr>
									<?php } }?>
									
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
    
<div class="modal fade" id="addObject" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Home Images</h4>
			</div>
			<div class="modal-body">
				<ul class="nav nav-tabs">
					<li ><a data-toggle="tab" href="#uploadadd">Upload Files</a></li>
					<li class="active"><a data-toggle="tab" href="#mediaadd">Media Library</a></li>
				</ul>
				<div class="tab-content">
					<div id="uploadadd" class="tab-pane fade">
						<form class="form-submit" style="margin:40px 0;" action="<?= site_url('web-admin/faculty/upload_faculty_img')?>" method="post" enctype="multipart/form-data">
							<input type="file" name="slider_images" multiple>
							<small>Image Size : (200x200)</small>
							<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">

							<button type="submit" class="btn btn-custom" style="margin-top:10px;"> <span class="btn-val">Upload</span></button>
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
								<form class="form-submit" method="post" action="<?= site_url('web-admin/faculty/add_faculty')?>">
									<div class="row">
										<div class="col-md-12">
											<h6>Images Details</h6>
											<img src="<?=base_url("assets/images/question/")?>Penguins.jpg" id="display-img" title="">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-6 form-group" >
											<input type="text" name="name" class="form-control" placeholder="Name">
										</div>
										<div class="col-md-6 col-sm-6 form-group" >
											<input type="text" name="contact" class="form-control" placeholder="Contact">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-6 form-group">
											<select name="cat_id" class="form-control">
												<option value="guest faculty">Guest Faculty</option>
												<option value="permanent faculty">Permanent Faculty</option>
											</select>
										</div>
										<div class="col-md-6 col-sm-6 form-group" >
											<input type="text" name="specialization" class="form-control" placeholder="Specialization">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<input type="text" name="email" class="form-control" placeholder="E-mail">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<input type="text" name="age" class="form-control" id="datepicker" placeholder="Age">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<input type="text" name="discription" class="form-control" placeholder="Discription">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<input type="text" name="qualification" class="form-control" placeholder="Qualification">
										</div>
									</div>
									<!---->
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group">
											<input type="hidden" class="form-control" name="image_id">
											<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
                                
											<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Add Faculty</span></button>
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
   
<div class="modal fade" id="edit-video" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Faculty</h4>
			</div>
			<div class="modal-body">
				<ul class="nav nav-tabs">
					<li ><a data-toggle="tab" href="#edtuploadadd">Upload Files</a></li>
					<li class="active"><a data-toggle="tab" href="#edtmediaadd">Media Library</a></li>
				</ul>
				<div class="tab-content">
					<div id="edtuploadadd" class="tab-pane fade">
						<form class="form-submit" style="margin:40px 0;" action="<?= site_url('web-admin/faculty/upload_faculty_img')?>" method="post" enctype="multipart/form-data">
							<input type="file" name="slider_images" multiple>
							<small>Image Size : (200x200)</small>
							<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">

							<button type="submit" class="btn btn-custom" style="margin-top:10px;"> <span class="btn-val">Upload</span></button>
						</form>
					</div>
					<div id="edtmediaadd" class="tab-pane fade in active">
						<div class="row">
							<div class="col-sm-6">
								<ul class="media-list1">
									<?php foreach($images as $img){ ?>
									<li>
										<label> <input type='radio' value='<?= $img->id; ?>' name='imgradio'/> <img class="edit-img-select" data-id="<?= $img->id; ?>" src='<?= web_url(); ?>images/<?= $img->location; ?>' class='single-image'/> </label>
									</li>
									<?php } ?>
								</ul>
							</div>

							<div class="col-sm-6 attach-details">
								<form class="form-submit" method="post" action="<?= site_url('web-admin/faculty/update_faculty')?>">
									<div class="row">
										<div class="col-md-12">
											<h6>Images Details</h6>
											<img src="<?=base_url("assets/images/question/")?>Penguins.jpg" id="edit-display-img" title="">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<input type="text" name="edt_name" class="form-control" placeholder="Name">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<input type="text" name="edt_contact" class="form-control" placeholder="Contact">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group ">
											<select name="edt_cat_id" class="form-control">
												<option value="guest faculty">Guest Faculty</option>
												<option value="permanent faculty">Permanent Faculty</option>
											</select>
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<input type="text" name="edt_specialization" class="form-control" placeholder="specialization">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<input type="text" name="edt_email" class="form-control" placeholder="email">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<input type="text" name="edt_age" class="form-control"  placeholder="Age">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<input type="text" name="edt_discription" class="form-control datepicker">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<input type="text" name="edt_qualification" class="form-control datepicker">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group">
											<input type="hidden" class="form-control" name="edt_image_id">
											<input type="hidden" class="form-control" name="dignitaryid">
											<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">

											<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Update </span></button>
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
<!---video model-------->

<div class="modal fade" id="video-Modal" role="dialog">
	<div class="modal-dialog" style="width: 680px;">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" id="close" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Course Title</h4>
			</div>
			<div class="modal-body" > 
				<div id="player"></div>
			</div>
			<div class="modal-footer">
				<button type="button" id="close" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!---video model-------->


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
	<script type="text/javascript" src="https://www.youtube.com/player_api"></script>
	
    <script>
        $( function() {
            $( "#datepicker" ).datepicker({
               dateFormat: 'yy-mm-dd',
                changeYear: true,
                changeMonth: true
            });
			$( "#datepicker1,#datepicker2" ).datepicker({
                changeYear: true,
                changeMonth: true
            });
			$('.img-select').on('click',function(){
				var img_src = $(this).attr('src');
				var img_id = $(this).data('id');
				$('#display-img').attr('src',img_src);
				$('input[name=image_id]').attr('value',img_id);
			});
			$('.edit-img-select').on('click',function(){
				//alert($(this).data('id'));
				var img_src = $(this).attr('src');
				var img_id = $(this).data('id');
				$('#edit-display-img').attr('src',img_src);
				$('input[name=edt_image_id]').attr('value',img_id);
			});
			
			$('.edit-video').on('click',function(){
				var dignitaryid = $(this).data('dignitaryid');
				var img_id = $(this).data('img_id');
				var cat_id = $(this).data('cat_id');
				var name = $(this).data('name');
				var email = $(this).data('email');
				var age = $(this).data('age');
				var contact = $(this).data('contact');
				var specialization = $(this).data('specialization');
				var qualification = $(this).data('qualification');
				var discription = $(this).data('discription');
				var img_src = $(this).data('img_src');
				
				$('input[name=dignitaryid]').attr('value',dignitaryid);
				$('input[name=edt_image_id]').attr('value',img_id);
				$('input[name=edt_name]').attr('value',name);
				$('input[name=edt_contact]').attr('value',contact);
				$('input[name=edt_specialization]').attr('value',specialization);
				$('input[name=edt_email]').attr('value',email);
				$('input[name=edt_age]').attr('value',age);
				$('input[name=edt_discription]').attr('value',discription);
				$('input[name=edt_qualification]').attr('value',qualification);
				$('#edit-display-img').attr('src',img_src);
				$('select[name=edt_cat_id]').find("option[value='"+cat_id+"']").attr('selected','selected');
			});
			
			$('.change-status').on('click', function(){
				var item = $(this).data('id');
				var status = $(this).data('status');
				var crsf_name = '<?=csrf_token();?>';
				var crsf_hash = '<?=csrf_hash();?>';
				if(item != "" && status != "")
				{
					$("#page-"+item).html("<img src='<?= base_url('assets'); ?>/images/loader.gif' style='width: 40px;'>");
					$.ajax({
						type: "POST",
						url: "<?= base_url('web-admin/faculty/change_faculty_status'); ?>",
						data: {status:status,id:item, [crsf_name]:crsf_hash},
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