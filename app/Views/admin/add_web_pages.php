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
	<script type="text/javascript" src="<?= base_url('assets'); ?>/js/nicEdit-latest.js"></script> 
	<script type="text/javascript">
	//<![CDATA[
		bkLib.onDomLoaded(function() { new nicEditor({fullPanel : true}).panelInstance('main-content-text'); });
	//]]>
	</script>
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
		margin-bottom: 0px;
		padding: 4px;
	}
	.media-list li:hover, .media-list1 li:hover {
		background-color:#8b8b8b;
	}
	.bg-color-active{
		background-color:#8b8b8b;
	}
	.media-list1 input[type=radio] {
		display: none;
		position: relative;
		top: -67px;
		left: 12px;
	}
	.media-list img, .media-list1 img {
		width: 280px;
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
                                <h1>Pages</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">addpage</li>
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
                                <div class="col-md-12">
                                    <h4>Add New Page</h4>
                                </div>
                            </div>
                        </div>
							<form class="form-submit" action="<?= site_url('web-admin/web_pages/create_page'); ?>" method="post">
                        <div class="card-body">
								<div class="row">
									<div class="col-md-6 form-group">
										<label> Heading</label>
										<p><input class="form-control" type="text" name="heading"></p>
									</div>
								
									<div class="col-md-6 form-group">
										<label> Title</label>
										<p><input class="form-control" type="text" name="title"></p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 form-group">
										<label> Keyword</label>
										<p><input class="form-control" type="text" name="keyword"></p>
									</div>
									<div class="col-md-6 form-group">
										<label> Description</label>
										<p><input class="form-control" type="text" name="description"></p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 form-group">
										<label> URL  (After Domain | without: space | without: any special charector )</label>
										<p><input class="form-control" type="text" name="url"></p>
									</div>
									<div class="col-md-6 form-group">
										<label> Contact Form</label>
										<p>
											<select class="form-control" name="form">
												<option value="Y">Yes</option>
												<option value="N">NO</option>
											</select>
										</p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 form-group">
										<label><a class="btn btn-success" style="width:100%;" href="#" data-toggle="modal" data-target="#banner_image"><span class="btn-val">Banner Image</span></a></label>
										<p><img id="display-img" src="" style="width:100%;height:200px;"><input type="hidden" name="image_id" value=""></p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 form-group">
										<label> Content</label>
										<p><textarea id="main-content-text" class="form-control" name="content" style="height: 200px;" ></textarea></p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 form-group">
										<label> Header Script Option</label>
										<p><textarea class="form-control" name="header_script" style="height: 200px;" ></textarea></p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 form-group">
										<label> Footer Script Option</label>
										<p><textarea class="form-control" name="footer_script" style="height: 200px;" ></textarea></p>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 form-group">
									<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
										<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Add Page</span></button>
									</div>
								</div>
							</form>
						
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
	
<div class="modal fade" id="banner_image" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Upload Banner</h4>
			</div>
			<div class="modal-body">
				<ul class="nav nav-tabs">
					<li ><a data-toggle="tab" href="#uploadadd">Upload Files</a></li>
					<li class="active"><a data-toggle="tab" href="#mediaadd">Media Library</a></li>
				</ul>
				<div class="tab-content">
					<div id="uploadadd" class="tab-pane fade">
						<form class="form-submit" style="margin:40px 0;" action="<?= site_url('web-admin/web_pages/upload_banner_img')?>" method="post" enctype="multipart/form-data">
							<input type="file" name="banner_images" multiple>
							<small>Image Size : (1920*1080)</small>
							<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
							<button type="submit" class="btn btn-custom" style="margin-top:10px;"> <span class="btn-val">Upload</span></button>
						</form>
					</div>
					<div id="mediaadd" class="tab-pane fade in active">
						<div class="row">
							<div class="col-sm-12">
								<ul class="media-list1">
									<?php foreach($images as $img){?>
									<li>
										<label class="m-b-0"> <input type='radio' value='<?= $img->id; ?>' name='imgradio'/> <img class="img-select" data-id="<?= $img->id; ?>" src='<?= base_url("images/".$img->location); ?>' class='single-image'/> </label>
									</li>
									<?php } ?>
								</ul>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="close" class="btn btn-default" data-dismiss="modal">Select</button>
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
                changeYear: true,
                changeMonth: true
            });
			$('.img-select').on('click',function(){
				$("li").removeClass('bg-color-active');
				$(this).parent().parent('li').addClass('bg-color-active');
				
				//alert($(this).data('id'));
				var img_src = $(this).attr('src');
				var img_id = $(this).data('id');
				$('#display-img').attr('src',img_src);
				$('input[name=image_id]').attr('value',img_id);
			});
			
		});
    </script>
</body>
</html>