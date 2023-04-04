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
									<div class="col-md-12 text-right">
										<?php if(in_array('1',$other_action)){ ?>
										<a class="btn btn-success form-control" href="#" data-toggle="modal" data-target="#addProgram">Add</a>
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Course</th>
                                        <th>LastUpdate</th>
										<th>UpdateBy</th>
										<th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
								<tbody>
									<?php if(isset($faculty_detals)) { $i=1; foreach($faculty_detals as $prg){ ?>
									<tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$faculty_info[$prg->faculty_id]->name;?></td>
                                        <td><?=$faculty_info[$prg->faculty_id]->email;?></td>
                                        <td><?=$course_info[$prg->course_id]->course_code;?></td>
                                        <td><?= date('Y-m-d H:i:s',strtotime($prg->last_update)); ?></td>
										<td><?=$user_info[$prg->update_by]->f_name;?></td>
										<td id="program-<?= $prg->id; ?>"><?= ($prg->status == 'D')?'<a href="#" data-id="'.$prg->id.'" data-status="'.$prg->status.'" class="change-status badge badge-primary">ACTIVE</a>':'<a href="#" data-id="'.$prg->id.'" data-status="'.$prg->status.'" class="change-status badge badge-danger">DEACTIVE</a>'; ?></td>
                                        <td>
										<?php if(in_array('2',$other_action)){ ?>
											<a href="#" class="editProgram" 
											data-id="<?=$prg->id?>"  
											data-details="<?=$faculty_info[$prg->faculty_id]->email;?>" 
											data-course="<?=$course_info[$prg->course_id]->course_code;?>" 
											data-toggle="modal" 
											data-target="#editProgram" data-edt_td="<?=$prg->id?>"><i class="ti-pencil-alt" aria-hidden="true"></i></a>
										<?php } ?>
										</td>
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
								<form class="form-submit" method="post" action="<?= site_url('web-admin/faculty/update_faculty_course')?>">
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Type</label>
												<input type="text" name="edt_details" class="form-control" placeholder="Program Title">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Title</label>
											<input type="text" name="edt_course" value="<?=$course_info[$prg->course_id]->course_code;?>" class="form-control" placeholder="Program Title">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group">
											<input type="hidden" name="edt_td"  value="">
											<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
                                
											<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Update</span></button>
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
								<form class="form-submit" method="post" action="<?= site_url('web-admin/faculty/add_faculty_course')?>">
									<div class="row">
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Faculty</label>
											<input type="text" name="details"  id="beneficiary_details" class="form-control"  value="" placeholder="Email ID">
										</div>
										<div class="col-md-6 col-sm-12 form-group" >
											<label>Type</label>
											<input type="text" name="course" class="form-control" placeholder="Course Code">
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 col-sm-12 form-group">
										<input id="csrf-token" type="hidden" name="<?= csrf_token(); ?>" value="<?= csrf_hash(); ?>">
                                
											<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">ADD</span></button>
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
			
		//
			$('.editProgram').on('click',function(){
				//alert("Hello");
				var edt_td = $(this).data('edt_td');
				var details = $(this).data('details');
				var course = $(this).data('course');
				
				
				$('input[name=edt_td]').attr('value',edt_td);
				$('input[name=edt_details]').attr('value',details);
				$('input[name=edt_course]').attr('value',course);
				
			
			});
		//
			
			$('#beneficiary_details').autocomplete({
				source: function( request, response ) {
					console.log(request.term);
					$.ajax({
						type: "POST",
						url: "<?=site_url('ajax_request/catch_faculty_info');?>",
						dataType: "json",
						data: {details:request.term},
						cache: false,
						success: function( data ) {
							//response( data );
							response( $.map( data, function( item ) {
								console.log(data);
								//alert('test');
								return {
									label: item.email,
									value: item.email
								};
							}));
						}
					});
				},
				minLength: 3,
				/*select: function (event, ui)
				{
					log(ui.item ? "Selected: " + ui.item.label : "Nothing selected, input was " + this.value);
				}*/
				select: function (event, ui)
				{
					//do anything u need
					//alert(ui.item.email);
					// ui.item.email
				}			
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
						url: "<?= base_url('web-admin/faculty/change_faculty_course_status'); ?>",
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