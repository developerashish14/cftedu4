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
                                <h1>Slider</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Slider</li>
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
                                    <h4>Slider List</h4>
                                </div>
                                
                                <div class="col-md-6 text-right">
                                    
                                    <a class="badge badge-success" href="#" data-toggle="modal" data-target="#addSlider">Add</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table f-s-13">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Heading</th>
                                        <th>Text</th>
                                        <th>Updated On</th>
                                        <th>Updated By</th>
                                        <th>Action</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($slider as $sld){?>
									<tr>
                                        <td><img src="<?=web_url();?>images/<?= $images[$sld->img]->location; ?>" width="200px"></td>
                                        <td><?= $sld->top_line; ?></td>
                                        <td><?= $sld->bottom_text; ?></td>
                                        <td><?= $sld->last_update; ?></td>
                                        <td><?= $user_info[$sld->update_by]->f_name; ?></td>
                                        <td id="slide-<?=$sld->id?>"><?= ($sld->status == 'D')?'<a href="#" data-id="'.$sld->id.'" data-status="'.$sld->status.'" class="change-status badge badge-primary">ACTIVE</a>':'<a href="#" data-id="'.$sld->id.'" data-status="'.$sld->status.'" class="change-status badge badge-danger">DEACTIVE</a>'; ?></td>
                                        <td><a class="edit-slider badge badge-primary" href="#" data-toggle="modal" data-target="#editSlider" data-imgid="<?=$sld->img?>" data-top="<?= $sld->top_line; ?>" data-bottom="<?= $sld->bottom_text ;?>" data-link_button="<?= $sld->link_button; ?>" data-form_button="<?= $sld->form_button; ?>" data-form_type="<?= $sld->form_type; ?>" data-url_ref="<?= $sld->url_ref; ?>" data-img_src="<?=web_url();?>images/<?= $images[$sld->img]->location; ?>" data-slideid="<?= $sld->id; ?>" >Edit</a></td>
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
    
    <!--add slider-->
	
<div class="modal fade" id="addSlider" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Home Slider</h4>
			</div>
			<div class="modal-body">
				<ul class="nav nav-tabs">
					<li ><a data-toggle="tab" href="#uploadadd">Upload Files</a></li>
					<li class="active"><a data-toggle="tab" href="#mediaadd">Media Library</a></li>
				</ul>
				<div class="tab-content">
					<div id="uploadadd" class="tab-pane fade">
						<form class="form-submit" style="margin:40px 0;" action="<?= site_url('web-admin/slider/upload_slider_img')?>" method="post" enctype="multipart/form-data">
							<input type="file" name="slider_images" multiple>
							<small>Image Size : (1920x1080)</small>
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
								<form class="form-submit" method="post" action="<?= site_url('web-admin/slider/add_slider')?>">
									<div class="row">
										<div class="col-md-12">
											<h6>Slider Details</h6>
											<img src="<?=base_url("assets/images/question/")?>Penguins.jpg" id="display-img" title="">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<input type="text" name="top" class="form-control" placeholder="Top Line">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<input type="text" name="bottom" class="form-control" placeholder="Bottom Text">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group ">
											<label><input type="checkbox" name="form_button" > Form</label>
										</div>
										<div class="col-md-6 col-sm-12 form-group ">
											<label><input type="checkbox" name="link_button" > Link</label>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 radio-control">
											<select name="form_type" class="form-control">
												<option value="">Select Form</option>
												<option value="event">Event</option>
											</select>
										</div>
										<div class="col-md-6 col-sm-12 form-group">
											<input type="text" name="url_ref" class="form-control" placeholder="URL Refrence">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group">
											<input type="hidden" class="form-control" name="image_id">
											<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Add Slider</span></button>
										</div>
										<div class="col-md-6 col-sm-12 form-group">
										<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
													
											<button type="button" class="btn btn-danger" style="width: 100%;"> <span class="btn-val">Delete Image</span></button>
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
	
<div class="modal fade" id="editSlider" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Home Slider</h4>
			</div>
			<div class="modal-body">
				<ul class="nav nav-tabs">
					<li ><a data-toggle="tab" href="#edtuploadadd">Upload Files</a></li>
					<li class="active"><a data-toggle="tab" href="#edtmediaadd">Media Library</a></li>
				</ul>
				<div class="tab-content">
					<div id="edtuploadadd" class="tab-pane fade">
						<form class="form-submit" style="margin:40px 0;" action="<?= site_url('web-admin/slider/upload_slider_img')?>" method="post" enctype="multipart/form-data">
							<input type="file" name="slider_images" multiple>
							<small>Image Size : (1920x1080)</small>
							<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
													
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
								<form class="form-submit" method="post" action="<?= site_url('web-admin/slider/update_slider')?>">
									<div class="row">
										<div class="col-md-12">
											<h6>Slider Details</h6>
											<img src="<?=base_url("assets/images/question/")?>Penguins.jpg" id="edit-display-img" title="">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<input type="text" name="edt_top" class="form-control" placeholder="Top Line">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group" >
											<input type="text" name="edt_bottom" class="form-control" placeholder="Bottom Text">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group ">
											<label><input type="checkbox" name="edt_form_button" > Form</label>
										</div>
										<div class="col-md-6 col-sm-12 form-group ">
											<label><input type="checkbox" name="edt_link_button" > Link</label>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 radio-control">
											<select name="edt_form_type" class="form-control">
												<option value="">Select Form</option>
												<option value="event">Event</option>
											</select>
										</div>
										<div class="col-md-6 col-sm-12 form-group">
											<input type="text" name="edt_url_ref" class="form-control" placeholder="URL Refrence">
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group">
											<input type="hidden" class="form-control" name="edt_image_id">
											<input type="hidden" class="form-control" name="slider_id">
											<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Update Slider</span></button>
										</div>
										<div class="col-md-6 col-sm-12 form-group">
										<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
													
											<button type="button" class="btn btn-danger" style="width: 100%;"> <span class="btn-val">Delete Image</span></button>
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
			
			$('.edit-slider').on('click',function(){
				var slideid = $(this).data('slideid');
				var imgid = $(this).data('imgid');
				var top = $(this).data('top');
				var bottom = $(this).data('bottom');
				var link_button = $(this).data('link_button');
				var form_button = $(this).data('form_button');
				var form_type = $(this).data('form_type');
				var url_ref = $(this).data('url_ref');
				var img_src = $(this).data('img_src');
				
				$('input[name=slider_id]').attr('value',slideid);
				$('input[name=edt_image_id]').attr('value',imgid);
				$('input[name=edt_top]').attr('value',top);
				$('input[name=edt_bottom]').attr('value',bottom);
				if(link_button == 'Y'){
					$('input[name="edt_link_button"]').prop("checked",true);
				}
				else{
					$('input[name="edt_link_button"]').prop("checked",false);
				}
				if(form_button == 'Y'){
					$('input[name="edt_form_button"]').prop("checked",true);
				}
				else{
					$('input[name="edt_form_button"]').prop("checked",false);
				}
				$('select[name="edt_form_type"]').find('option[value="'+form_type+'"]').attr("selected",true);
				$('input[name=edt_url_ref]').attr('value',url_ref);
				$('#edit-display-img').attr('src',img_src);
			});
			
			$('.change-status').on('click', function(){
				var item = $(this).data('id');
				var status = $(this).data('status');
				var crsf_name = '<?=csrf_token();?>';
				var crsf_hash = '<?=csrf_hash();?>';
				if(item != "" && status != "")
				{
					$("#slide-"+item).html("<img src='<?= base_url('assets'); ?>/images/loader.gif' style='width: 40px;'>");
					$.ajax({
						type: "POST",
						url: "<?= site_url('web-admin/slider/change_slide_status'); ?>",
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