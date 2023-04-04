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
                                <h1>Virtual Classroom Batch</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Virtual Classroom Batch</li>
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
									<div class="col-md-6">
										<h4>Virtual Classroom Batch</h4>
									</div>
									<div class="col-md-6 text-right">
										<?php if(in_array('1',$other_action)){ ?>
										<a class="badge badge-success" href="#" data-toggle="modal" data-target="#addBatch">Add</a>
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
                                        <th>BatchCode</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Topic</th>
										<th>LastUpdate</th>
										<th>UpdateBy</th>
										<th>Status</th>
										<th>Edit</th>
										<th>View</th>
                                    </tr>
                                </thead>
								<tbody>
									<?php $i=1; foreach($virtual_class_batch as $batch){ ?>
									<tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$batch->batch_code;?></td>
                                        <td><?=$batch->from_date;?></td>
                                        <td><?=$batch->to_date;?></td>
                                        <td><?=$batch->topic;?></td>
                                        <td><?=$batch->last_update;?></td>
										<td><?=$user_info[$batch->update_by]->f_name;?></td>
										<td id="batch-<?=$batch->id;?>">
										<?php if(in_array('3',$other_action)){ ?>
											<?= ($batch->status == 'D')?'<a href="#" data-id="'.$batch->id.'" data-status="'.$batch->status.'" class="change-status badge badge-primary">ACTIVE</a>':'<a href="#" data-id="'.$batch->id.'" data-status="'.$batch->status.'" class="change-status badge badge-danger">DEACTIVE</a>'; ?>
										<?php } ?>
										</td>
                                        <td>
										<?php if(in_array('2',$other_action)){ ?>
											<a href="#" class="edit-batch" data-id="<?=$batch->id;?>" data-code="<?=$batch->batch_code;?>" data-topic="<?=$batch->topic;?>" data-from_date="<?=$batch->from_date;?>" data-to_date="<?=$batch->to_date;?>" data-toggle="modal" data-target="#editBatch"><i class="ti-pencil-alt" aria-hidden="true"></i></a>
										<?php } ?>
										</td>
										<td>
											<a class="change-status badge badge-success" href="<?=site_url('virtual_classroom/batch_student');?>?batch_code=<?=$batch->batch_code;?>" >Student List</a>
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

<div class="modal fade" id="editBatch" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Batch</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12 attach-details">
						<form class="form-submit" method="post" action="<?= site_url('virtual_classroom/edit_batch')?>">
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group" >
									<label>Batch Code</label>
									<input type="text" name="edt_code" class="form-control" placeholder="Batch Code">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12 form-group" >
									<label>From Date</label>
									<input type="text" name="edt_from_date" id="datepicker3" autocomplete="off" class="form-control" placeholder="YYYY-MM-DD">
								</div>
								<div class="col-md-6 col-sm-12 form-group" >
									<label>To Date</label>
									<input type="text" name="edt_to_date" id="datepicker4" autocomplete="off" class="form-control" placeholder="YYYY-MM-DD">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group" >
									<label>Topic</label>
									<input type="text" name="edt_topic" class="form-control" placeholder="Batch Topic">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group">
									<input type="hidden" name="batch_id" value="">
									<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Update Batch</span></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
<!--End Add Home Slide-->
<div class="modal fade" id="addBatch" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Batch</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12 attach-details">
						<form class="form-submit" method="post" action="<?= site_url('virtual_classroom/add_batch'); ?>">
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group" >
									<label>Batch Code</label>
									<input type="text" name="code" class="form-control" placeholder="Batch Code">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12 form-group" >
									<label>From Date</label>
									<input type="text" name="from_date" id="datepicker1" autocomplete="off" class="form-control" placeholder="YYYY-MM-DD">
								</div>
								<div class="col-md-6 col-sm-12 form-group" >
									<label>To Date</label>
									<input type="text" name="to_date" id="datepicker2" autocomplete="off" class="form-control" placeholder="YYYY-MM-DD">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group" >
									<label>Topic</label>
									<input type="text" name="topic" class="form-control" placeholder="Batch Topic">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group">
									<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Add Batch</span></button>
								</div>
							</div>
						</form>
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
			
			$('.edit-batch').on('click',function(){
				var id = $(this).data('id');
				var code = $(this).data('code');
				var from_date = $(this).data('from_date');
				var to_date = $(this).data('to_date');
				var topic = $(this).data('topic');
				
				$('input[name=batch_id]').attr('value',id);
				$('input[name=edt_code]').attr('value',code);
				$('input[name=edt_from_date]').attr('value',from_date);
				$('input[name=edt_to_date]').attr('value',to_date);
				$('input[name=edt_topic]').attr('value',topic);
				
			});
			
			$('.change-status').on('click', function(){
				var item = $(this).data('id');
				var status = $(this).data('status');
				if(item != "" && status != "")
				{
					$("#program-"+item).html("<img src='<?= base_url('assets'); ?>/images/loader.gif' style='width: 40px;'>");
					$.ajax({
						type: "POST",
						url: "<?= site_url('virtual_classroom/change_batch_status'); ?>",
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