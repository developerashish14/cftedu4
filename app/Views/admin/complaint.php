<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Management system</title>
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
.accordion-head{
	font-weight: normal;
    color: #ffffff;
	cursor: pointer;
}
.text-white{
	color: #fff !important;
}
.Emergency{
	border: 1px solid #ff2a29;
    background-color: #ff2a29;
}
.Regular{
	border: 1px solid #1de9b6;
	background-color: #1de9b6;
}
.Urgent{
	border: 1px solid #ffc217;
    background-color: #ffc217;
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
                                <h1>Complaint</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Complaint</li>
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
									<form action="<?=base_url('web-admin/complaint');?>" method="post">
										<div class="col-md-2">
											<select class="form-control" name="process_filter">
												<?php foreach($process as  $obj){ ?>
												<option value="<?=$obj->id;?>" <?=($obj->id == $process_filter)?'selected':'';?> ><?=$obj->stage;?></option>
												<?php } ?>
											</select>
										</div>
												<?php /* foreach($type as $id => $obj){ ?>
										<div class="col-md-2">
											<select class="form-control" name="type_filter">
												<option value="">All</option>
												<option value="<?=$id;?>" <?=($id == $type_filter)?'selected':'';?> ><?=$obj->service;?></option>
											</select>
										</div>
												<?php }  */ ?>
										<div class="col-md-2">
											<input type="text" id="datepicker1" name="from_date" value="<?=$from_date?>" class="form-control">
										</div>
										<div class="col-md-2">
											<input type="text" id="datepicker2" name="to_date" value="<?=$to_date?>" class="form-control">
										</div>
										<div class="col-md-4">
											<input type="submit" class="form-control btn btn-success" value="Fetch">
										</div>
										<div class="col-md-2">
											<button class="btn btn-primary form-control">Total: <?=isset($query)?count($query):'';?></button>
										</div>
									</form>
								</div>
							</div>
                        </div>
                        <div class="card-body">
							<div id="accordion">
							<?php $i=1; if(isset($query)){ 
										foreach($query as $id => $obj){ ?>
											<div class="accordion-head Regular p-10 m-t-10" data-toggle="collapse" data-target="#query<?=$id;?>">
												<div class="row ">
													<div class="col-md-2">
														<p class="text-white"><?=$i++;?></p>
													</div>
													<div class="col-md-2">
														<p class="text-white"><?=$user_info[$obj->update_by]->name;?></p>
													</div>
													<div class="col-md-2">
														<p class="text-white"><?=$user_info[$obj->update_by]->contact;?></p>
													</div>
													<div class="col-md-2">
														<p class="text-white"><?=$user_info[$obj->update_by]->email_id;?></p>
													</div>
													
													<div class="col-md-2">
														<p class="text-white"><?=$stage_details[$obj->stage_id]->stage;?></p>
													</div>
													<div class="col-md-2">
														<p class="text-white"><?=$obj->product;?></p>
													</div>
												</div>
												
											</div>
											<div class="row collapse border-bottom p-10" id="query<?=$id;?>">
												<div class="col-md-12">
												</div>
												<div class="row">
												
																								
												<div class="col-md-6 p-t-5" id="updated_remarks_<?=$id;?>" style="overflow-y: scroll;height: 250px;">
															<p><b>Subject:-</b><?=$obj->subject; ?></p>
															<h4>Message</h4>
																<?php if(isset($com_remarks)) { 
																	foreach($com_remarks as $remark_com){
																		if($obj->id == $remark_com->complain_id){?>
																			 
																					<p class="border-bottom bg-primary p-5">
																					<mark> <?=$remark_com->insert_by_type; ?></mark> :
																					<?php if($remark_com->insert_by_type == 'student'){ ?>
																						<span class="text-right "><?=$remark_com->remark;?></span></p>
																					<?php }else{ ?>
																						<span class="text-right"><?=$remark_com->remark;?></span></p>
																					<?php } ?>
																			<?php } 
																			} 
																	} ?>
															
															
															
															
													</div>
												
													<div class="col-md-6 p-t-5">
														<div class="row">
															<div class="col-md-12">
																<button class="btn btn-primary form-control action-button" data-toggle="modal" data-target="#ActionModal" data-id="<?=$obj->id;?>">Action</button>
															</div>
														</div>
														<form class="form-submit" action="<?=site_url('complaint/update_remarks');?>">
															<div class="row">
																<div class="col-md-12">
																	<input type="hidden" name="stage_id" value="<?=$obj->stage_id;?>">
																	<input type="hidden" name="complain_id" value="<?=$obj->id;?>">
																	<textarea name="remark" style="height:150px;" placeholder="Type Your Remark" class="form-control"></textarea>
																	<button class="form-control btn btn-success">Add</button>
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
											
											
											<?php 
											} 
										}
										?>
							</div>
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
	
	
<div class="modal fade" id="ActionModal" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Approve Window</h4>
			</div>
			<div class="modal-body">
				<form class="form-submit" action="<?=site_url('complaint/status_update');?>">
				<div class="row">
					<div class="col-md-12 form-group">
						<select class="form-control" name="stage_id">
							<?php foreach($stage_details as $id => $obj){ ?>
							<option value="<?=$obj->id;?>"><?=$obj->stage;?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-md-12 form-group">
						<textarea class="form-control" name="remark" placeholder="Message for approval"></textarea>
					</div>
					<div class="col-md-12 form-group">
						<input type="hidden" name="complain_id" value="">
						<button class="form-control btn btn-success">Approved</button>
					</div>
				</div>
				</form>
			</div>
		</div>
    </div>
</div>
<!--End Add Home Slide-->

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
			
			$('.action-button').on('click',function(){
				var id = $(this).data('id');
				$("input[name=complain_id]").attr('value',id);
			});
		});
		
		$('.add-remark').on('click',function(){
			alert('test');
			var complain_id = $(this).data('qry');
			var stage_id = $('textarea[name=stage_id]').val();
			var remark = $('textarea[name=remark_'+id+']').val();
			$.ajax({
				type: "POST",
				url: "<?= site_url('complaint/add_remark'); ?>",
				data: {complain_id:complain_id,remark:remark,stage_id:stage_id},
				dataType: 'json',
				cache: false,
				success: function(result){
					var str = 	'<p>'+result.remark.remark_msg+'</p>'+
								'<p class="border-bottom p-5 bg-primary">Admin: '+result.admin.f_name+' <span class="text-right">'+result.remark.insert_time+'</span></p>';
					$('#updated_remarks_'+id).append(str);
					$('textarea[name=remark_'+id+']').val('');
					$('#updated_remarks_'+id).animate({ scrollTop:  500 });
				}
			});
		});
    </script>
</body>
</html>