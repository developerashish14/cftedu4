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
                                <h1>Certificate</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-6 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Certificate</li>
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
									<form action="<?=site_url('certificate_list');?>" method="post">
										<div class="col-md-2">
											<input type="text" class="form-control" name="from_date" id="datepicker1" value="<?=$from_date;?>">
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control" name="to_date" id="datepicker2" value="<?=$to_date;?>">
										</div>
										<div class="col-md-2">
											<select class="form-control" name="status">
												<option value="A" <?=(($status == 'A')?'selected':'');?> >Available</option>
												<option value="S" <?=(($status == 'S')?'selected':'');?> >Sent</option>
												<option value="R" <?=(($status == 'R')?'selected':'');?> >Resend</option>
											</select>
										</div>
										<div class="col-md-2">
											<input type="submit" class="form-control btn btn-success" value="Fetch">
										</div>
									</form>
									<div class="col-md-4 text-right">
										<?php if(in_array('1',$other_action)){ ?>
										<a class="badge badge-success" href="#" data-toggle="modal" data-target="#addCertificate">Add</a>
										<?php } ?>
										<a class="badge badge-success" href="#" data-toggle="modal" data-target="#uploadExcel">Upload</a>
										
									</div>
								</div>
							</div>
                        </div>
                        <div class="card-body">
							<table class="table f-s-13">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Email-ID</th>
                                        <th>Title</th>
                                        <th>From Date</th>
                                        <th>To Date</th>
										<th>Create</th>
										<th>Update</th>
										<th>Send</th>
                                        <th>Action</th>
                                        <th>Edit</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
								<tbody>
									<?php $i=1; foreach($certificate as $cer){ ?>
									<tr>
                                        <td><?=$i++;?></td>
                                        <td><?=$cer->email_id;?></td>
                                        <td><?=$cer->title;?></td>
                                        <td><?= date('Y-m-d',strtotime($cer->from_date)); ?></td>
                                        <td><?= (($cer->to_date != '')?date('Y-m-d',strtotime($cer->to_date)):''); ?></td>
										<td><?=$user_info[$cer->insert_by]->f_name;?><br><?=$cer->insert_at;?></td>
										<td><?=$user_info[$cer->update_by]->f_name;?><br><?=$cer->last_update;?></td>
										<td><?php echo (($cer->send_by > 0)?$user_info[$cer->send_by]->f_name.'<br>'.$cer->send_at:'');?></td>
										<td id="certificate-<?= $cer->id; ?>">
										<?php if(in_array('4',$other_action)){ ?>
											<?= ($cer->status == 'A')?'<a href="#" data-id="'.$cer->id.'" data-status="'.$cer->status.'" class="change-status badge badge-primary">SEND</a>':'<a href="#" data-id="'.$cer->id.'" data-status="'.$cer->status.'" class="change-status badge badge-danger">Resend</a>'; ?>
										<?php } ?>
										</td>
                                        <td>
										<?php if(in_array('2',$other_action)){ ?>
											<a href="#" class="edit-certificate" data-id="<?=$cer->id;?>" data-heading="<?=$cer->heading;?>" data-ribbon="<?=$cer->ribbon;?>" data-paragraph="<?=$cer->paragraph;?>" data-title="<?=$cer->title;?>" data-from_date="<?=$cer->from_date;?>" data-to_date="<?=$cer->to_date;?>" data-email="<?=$cer->email_id;?>" data-serial="<?=$cer->serial_no;?>" data-sign1="<?=$cer->sign1_id;?>" data-sign2="<?=$cer->sign2_id;?>" data-toggle="modal" data-target="#editCertificate"><i class="ti-pencil-alt" aria-hidden="true"></i></a>
										<?php } ?>
										</td>
										<td>
										<?php if(in_array('3',$other_action)){ ?>
											<a href="#" onclick="window.open('<?=base_url("certificate/view/".$cer->id);?>', 'MsgWindow', 'width=1024,height=540');"><i class="ti-eye" aria-hidden="true"></i></a>
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

<div class="modal fade" id="editCertificate" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Certificate</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12 attach-details">
						<form class="form-submit" method="post" action="<?= site_url('certificate/update_certificate')?>">
							<div class="row">
								<div class="col-md-6 col-sm-12 form-group" >
									<label>Serial No</label>
									<input type="text" name="edt_serial" class="form-control" placeholder="Serial Number">
								</div>
								<div class="col-md-6 col-sm-12 form-group" >
									<label>Heading</label>
									<input type="text" name="edt_heading" class="form-control" placeholder="Title">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group" >
									<label>Ribbon Text</label>
									<input type="text" name="edt_ribbon" class="form-control" placeholder="Message">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group" >
									<label>Certificate Message With Student Name</label>
									<input type="text" name="edt_paragraph" class="form-control" placeholder="Message">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group" >
									<label>Title</label>
									<input type="text" name="edt_title" class="form-control" placeholder="Title">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12 form-group" >
									<label>From Date</label>
									<input type="text" name="edt_from_date" id="datepicker1" class="form-control" placeholder="YYYY-MM-DD">
								</div>
								<div class="col-md-6 col-sm-12 form-group" >
									<label>To Date</label>
									<input type="text" name="edt_to_date" id="datepicker2" class="form-control" placeholder="YYYY-MM-DD">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12 form-group" >
									<label>Left Signature</label>
									<select name="edt_sign1" class="form-control">
										<?php foreach($signature as $sign){ ?>
											<option value="<?= $sign->id; ?>"><?= $sign->name; ?>-<?= $sign->designation; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-md-6 col-sm-12 form-group" >
									<label>Right Signature</label>
									<select name="edt_sign2" class="form-control">
										<?php foreach($signature as $sign){ ?>
											<option value="<?= $sign->id; ?>"><?= $sign->name; ?>-<?= $sign->designation; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group" >
									<label>Email</label>
									<input type="text" name="edt_email" class="form-control" placeholder="Email ID">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group">
									<input type="hidden" name="certificate_id" value="">
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
<!--End Add Home Slide-->
<div class="modal fade" id="addCertificate" role="dialog">
	<div class="modal-dialog modal-lg modal-full">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Certificate</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12 attach-details">
						<form class="form-submit" method="post" action="<?= site_url('certificate/add_certificate')?>">
							<div class="row">
								<div class="col-md-6 col-sm-12 form-group" >
									<label>Serial No</label>
									<input type="text" name="serial" class="form-control" placeholder="Serial Number">
								</div>
								<div class="col-md-6 col-sm-12 form-group" >
									<label>Heading</label>
									<input type="text" name="heading" class="form-control" placeholder="Title">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group" >
									<label>Ribbon Text</label>
									<input type="text" name="ribbon" class="form-control" placeholder="Message">
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group" >
									<label>Certificate Message With Student Name</label>
									<input type="text" name="paragraph" class="form-control" placeholder="Message">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group" >
									<label>Title</label>
									<input type="text" name="title" class="form-control" placeholder="Title">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12 form-group" >
									<label>From Date</label>
									<input type="text" name="from_date" id="datepicker3" class="form-control" placeholder="YYYY-MM-DD">
								</div>
								<div class="col-md-6 col-sm-12 form-group" >
									<label>To Date</label>
									<input type="text" name="to_date" id="datepicker4" class="form-control" placeholder="YYYY-MM-DD">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12 form-group" >
									<label>Left Signature</label>
									<select name="sign1" class="form-control">
										<?php foreach($signature as $sign){ ?>
											<option value="<?= $sign->id; ?>"><?= $sign->name; ?>-<?= $sign->designation; ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-md-6 col-sm-12 form-group" >
									<label>Right Signature</label>
									<select name="sign2" class="form-control">
										<?php foreach($signature as $sign){ ?>
											<option value="<?= $sign->id; ?>"><?= $sign->name; ?>-<?= $sign->designation; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group" >
									<label>Email</label>
									<input type="text" name="email" class="form-control" placeholder="Email ID">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group">
									<button type="submit" class="btn btn-success" style="width: 100%;"> <span class="btn-val">Add Certificate</span></button>
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
						<form class="form-submit" method="post" action="<?= site_url('certificate/upload_certificate')?>" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-6 col-sm-12 form-group" >
									<label>File (.csv)</label>
									<input type="file" name="file" class="form-control" placeholder="Certificate">
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 form-group">
									<button type="submit" class="btn btn-success" style="width: 100%;"> 
										<span class="btn-val">Upload Certificate</span>
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
            $( "#datepicker1,#datepicker2,#datepicker3,#datepicker4" ).datepicker({
				dateFormat: 'yy-mm-dd',
                changeYear: true,
                changeMonth: true
            });
			
			$('.edit-certificate').on('click',function(){
				var heading = $(this).data('heading');
				var ribbon = $(this).data('ribbon');
				var paragraph = $(this).data('paragraph');
				var title = $(this).data('title');
				var from_date = $(this).data('from_date');
				var to_date = $(this).data('to_date');
				var serial = $(this).data('serial');
				var sign1 = $(this).data('sign1');
				var sign2 = $(this).data('sign2');
				var email = $(this).data('email');
				var id = $(this).data('id');
			
				$('input[name=edt_serial]').attr('value',serial);
				$('input[name=edt_heading]').attr('value',heading);
				$('input[name=edt_ribbon]').attr('value',ribbon);
				$('input[name=edt_paragraph]').attr('value',paragraph);
				$('input[name=edt_title]').attr('value',title);
				$('input[name=edt_from_date]').attr('value',from_date);
				$('input[name=edt_to_date]').attr('value',to_date);
				$('select[name=edt_sign1]').find('option[value="'+sign1+'"]').attr('selected','selected');
				$('select[name=edt_sign2]').find('option[value="'+sign2+'"]').attr('selected','selected');
				$('input[name=edt_email]').attr('value',email);
				$('input[name=certificate_id]').attr('value',id);
			});
			
			$('.change-status').on('click', function(){
				var item = $(this).data('id');
				var status = $(this).data('status');
				if(item != "" && status != "")
				{
					$("#certificate-"+item).html("<img src='<?= base_url('assets'); ?>/images/loader.gif' style='width: 40px;'>");
					$.ajax({
						type: "POST",
						url: "<?= site_url('certificate/send_certificate_email'); ?>",
						data: {status:status,id:item},
						dataType: 'json',
						cache: false,
						success: function(result){
							if(result.success == true){
								if(result.alert1){
									alert(result.alert1);
									location.reload();
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