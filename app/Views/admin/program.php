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
                                <h1>Program</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Program</li>
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
										<h4>Program</h4>
									</div>
									
									<div class="col-md-6 text-right">
										<?php if(in_array('1',$other_action)){ ?>
										<a class="badge badge-success" href="#" data-toggle="modal" data-target="#addProgram">Add</a>
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
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>LastUpdate</th>
										<th>UpdateBy</th>
										<th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
								<tbody>
									<?php $i=1; foreach($program as $prg){ ?>
									<tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$prg->title;?></td>
                                        <td><?=$prg->type;?></td>
                                        <td><?= date('Y-m-d H:i:s',strtotime($prg->last_update)); ?></td>
										<td><?=$user_info[$prg->update_by]->f_name;?></td>
										<td id="program-<?= $prg->id; ?>"><?= ($prg->status == 'D')?'<a href="#" data-id="'.$prg->id.'" data-status="'.$prg->status.'" class="change-status badge badge-primary">ACTIVE</a>':'<a href="#" data-id="'.$prg->id.'" data-status="'.$prg->status.'" class="change-status badge badge-danger">DEACTIVE</a>'; ?></td>
                                        <td>
										<?php if(in_array('2',$other_action)){ ?>
											<a href="#" class="edit-program" data-id="<?=$prg->id?>" data-title="<?=$prg->title;?>" data-type="<?=$prg->type;?>" data-toggle="modal" data-target="#editProgram"><i class="ti-pencil-alt" aria-hidden="true"></i></a>
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

<div class="modal fade" id="editProgram" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Program</h4>
			</div>
			<div class="modal-body">
				<div class="tab-content">
					<div id="mediaadd" class="tab-pane fade in active">
						<div class="row">
							<div class="col-sm-12 attach-details">
								<form class="form-submit" method="post" action="<?= site_url('content/update_program')?>">
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Title</label>
											<input type="text" name="edt_title" class="form-control" placeholder="Program Title">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Type</label>
											<select class="form-control" name="edt_type">
												<option value="short-term">Short-Term</option>
												<option value="long-term">Long-Term</option>
												<option value="package">package</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group">
											<input type="hidden" name="edt_id" value="">
											<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Update Program</span></button>
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
<div class="modal fade" id="addProgram" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Program</h4>
			</div>
			<div class="modal-body">
				<div class="tab-content">
					<div id="mediaadd" class="tab-pane fade in active">
						<div class="row">
							<div class="col-sm-12 attach-details">
								<form class="form-submit" method="post" action="<?= site_url('content/add_program')?>">
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Title</label>
											<input type="text" name="title" class="form-control" placeholder="Program Title">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Type</label>
											<select class="form-control" name="type">
												<option value="short-term">Short-Term</option>
												<option value="long-term">Long-Term</option>
												<option value="package">package</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group">
											<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Add Program</span></button>
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
			
			$('.edit-program').on('click',function(){
				var title = $(this).data('title');
				var type = $(this).data('type');
				var id = $(this).data('id');
				
				$('input[name=edt_title]').attr('value',title);
				$('select[name=edt_type]').find("option[value='"+type+"']").attr('selected','selected');
				$('input[name=edt_id]').attr('value',id);
				
			});
			
			$('.change-status').on('click', function(){
				var item = $(this).data('id');
				var status = $(this).data('status');
				if(item != "" && status != "")
				{
					$("#program-"+item).html("<img src='<?= base_url('assets'); ?>/images/loader.gif' style='width: 40px;'>");
					$.ajax({
						type: "POST",
						url: "<?= site_url('content/change_program_status'); ?>",
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