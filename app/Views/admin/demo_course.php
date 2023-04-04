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
		width: 40%;
		font-size: 20px;
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
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Course List</h4>
                                </div>
                                
                                <div class="col-md-6 text-right">
                                    <a class="badge badge-success" href="#" data-toggle="modal" data-target="#addCourse">Add</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table f-s-13">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Course</th>
                                        <th>Title</th>
                                        <th>Alt</th>
                                        <th>Last Update</th>
                                        <th>Updated By</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($course as $crs){?>
									<tr>
                                        <td>
											<img src="<?=web_url();?>images/<?= $images[$crs->img]->location; ?>" width="200px">
											<a class="play-video badge badge-primary" href="#" data-toggle="modal" data-target="#video-Modal" data-id="<?= $crs->yt_video_id; ?>" >Play</a>
										</td>
                                        <td><?= $crs->course_title; ?></td>
                                        <td><?= $crs->title; ?></td>
                                        <td><?= $crs->alt; ?></td>
                                        <td><?= $crs->last_update; ?></td>
                                        <td><?=$user_info[$crs->update_by]->f_name;?></td>
                                        <td id="course-<?=$crs->id?>"><?= ($crs->status == 'D')?'<a href="#" data-id="'.$crs->id.'" data-status="'.$crs->status.'" class="change-status badge badge-primary">ACTIVE</a>':'<a href="#" data-id="'.$crs->id.'" data-status="'.$crs->status.'" class="change-status badge badge-danger">DEACTIVE</a>'; ?></td>
                                        <td><a class="edit-course badge badge-primary" href="#" data-toggle="modal" data-target="#editCourse" data-imgid="<?=$crs->img?>" data-course_title="<?= $crs->course_title; ?>" data-title="<?= $crs->title; ?>" data-alt="<?= $crs->alt; ?>" data-description="<?= $crs->description ;?>" data-yt_video_id="<?= $crs->yt_video_id; ?>" data-img_src="<?=web_url();?>images/<?= $images[$crs->img]->location; ?>" data-courseid="<?= $crs->id; ?>" >Edit</a></td>
                                    </tr>
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
    <!--add slider-->
	
<div class="modal fade" id="addCourse" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Demo Course</h4>
			</div>
			<div class="modal-body">
				<ul class="nav nav-tabs">
					<li ><a data-toggle="tab" href="#uploadadd">Upload Files</a></li>
					<li class="active"><a data-toggle="tab" href="#mediaadd">Media Library</a></li>
				</ul>
				<div class="tab-content">
					<div id="uploadadd" class="tab-pane fade">
						<form class="form-submit" style="margin:40px 0;" action="<?= site_url('gadget/upload_demo_course_img')?>" method="post" enctype="multipart/form-data">
							<input type="file" name="course_images[]" multiple>
							<small>Image Size : (370x240)</small>
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
								<form class="form-submit" method="post" action="<?= site_url('gadget/add_course')?>">
									<div class="row">
										<div class="col-md-12">
											<h6>Course Details</h6>
											<img src="<?=base_url("assets/images/question/")?>Penguins.jpg" id="display-img" title="">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<input type="text" name="course_title" class="form-control" placeholder="Course Title">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group ">
											<input type="text" name="title" class="form-control" placeholder="Image Title">
										</div>
										<div class="col-md-6 col-sm-12 form-group ">
											<input type="text" name="alt" class="form-control" placeholder="Image Alt">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<input type="text" name="yt_video_id" class="form-control" placeholder="YT-Video-Id">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<input type="text" name="description" class="form-control" placeholder="Description">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group">
											<input type="hidden" class="form-control" name="image_id">
											<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Add Course</span></button>
										</div>
										<div class="col-md-6 col-sm-12 form-group">
											<button type="submit" class="btn btn-danger" style="width: 100%;"> <span class="btn-val">Delete Image</span></button>
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

<!--Edit slider-->
	
<div class="modal fade" id="editCourse" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Course</h4>
			</div>
			<div class="modal-body">
				<ul class="nav nav-tabs">
					<li ><a data-toggle="tab" href="#edtuploadadd">Upload Files</a></li>
					<li class="active"><a data-toggle="tab" href="#edtmediaadd">Media Library</a></li>
				</ul>
				<div class="tab-content">
					<div id="edtuploadadd" class="tab-pane fade">
						<form class="form-submit" style="margin:40px 0;" action="<?= site_url('gadget/upload_demo_course_img')?>" method="post" enctype="multipart/form-data">
							<input type="file" name="course_images[]" multiple>
							<small>Image Size : (370x240)</small>
							<button type="submit" class="btn btn-custom" style="margin-top:10px;"> <span class="btn-val">Upload</span></button>
						</form>
					</div>
					<div id="edtmediaadd" class="tab-pane fade in active">
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
								<form class="form-submit" method="post" action="<?= site_url('gadget/update_course')?>">
									<div class="row">
										<div class="col-md-12">
											<h6>Course Details</h6>
											<img src="<?=base_url("assets/images/question/")?>Penguins.jpg" id="edit-display-img" title="">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<input type="text" name="edt_course_title" class="form-control" placeholder="Course Title">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group ">
											<input type="text" name="edt_title" class="form-control" placeholder="Image Title">
										</div>
										<div class="col-md-6 col-sm-12 form-group ">
											<input type="text" name="edt_alt" class="form-control" placeholder="Image Alt">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<input type="text" name="edt_yt_video_id" class="form-control" placeholder="YT-Video-Id">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<input type="text" name="edt_description" class="form-control" placeholder="Description">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group">
											<input type="hidden" class="form-control" name="edt_image_id">
											<input type="hidden" class="form-control" name="course_id">
											<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Update Course</span></button>
										</div>
										<div class="col-md-6 col-sm-12 form-group">
											<button type="submit" class="btn btn-danger" style="width: 100%;"> <span class="btn-val">Delete Image</span></button>
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
<!--End Edit Home Slide-->
   

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
	<script type="text/javascript" src="http://www.youtube.com/player_api"></script>
	<script>
	var player;
	function onYouTubeIframeAPIReady() {
		player = new YT.Player('player', {
			height: '390',
			width: '640',
			events: {
				
			}
		});
	}
	function onPlayerReady(event) {
		event.target.playVideo();
	}

	$(".play-video").on('click',function(){
		//alert($(this).data('id'));
		loadVideo($(this).data('id'));
	});

	$('#video-Modal').on('hidden.bs.modal', function (e) {
		stopVideo();
	});
	function loadVideo(tag){
		//alert(tag);
		player.loadVideoById(tag, 0, "large");
	}
	function stopVideo() {
		player.stopVideo();
	}
	</script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker({
                maxDate : "-18y",
                changeYear: true,
                changeMonth: true
            });
            $( "#datepicker1,#datepicker2" ).datepicker({
                changeYear: true,
                changeMonth: true
            });
			$('.img-select').on('click',function(){
				//alert($(this).data('id'));
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
			
			$('.edit-course').on('click',function(){
				var courseid = $(this).data('courseid');
				var imgid = $(this).data('imgid');
				var course_title = $(this).data('course_title');
				var title = $(this).data('title');
				var alt = $(this).data('alt');
				var yt_video_id = $(this).data('yt_video_id');
				var description = $(this).data('description');
				var img_src = $(this).data('img_src');
				
				$('input[name=course_id]').attr('value',courseid);
				$('input[name=edt_image_id]').attr('value',imgid);
				$('input[name=edt_course_title]').attr('value',course_title);
				$('input[name=edt_title]').attr('value',title);
				$('input[name=edt_alt]').attr('value',alt);
				$('input[name=edt_yt_video_id]').attr('value',yt_video_id);
				$('#edit-display-img').attr('src',img_src);
				$('input[name=edt_description]').attr('value',description);
			});
			
			$('.change-status').on('click', function(){
				var item = $(this).data('id');
				var status = $(this).data('status');
				if(item != "" && status != "")
				{
					$("#course-"+item).html("<img src='<?= base_url('assets'); ?>/images/loader.gif' style='width: 40px;'>");
					$.ajax({
						type: "POST",
						url: "<?= site_url('gadget/change_course_status'); ?>",
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