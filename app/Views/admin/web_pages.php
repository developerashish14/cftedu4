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
                                    <li class="active">Pages</li>
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
                                    <h4>Page List</h4>
                                </div>
                                
                                <div class="col-md-6 text-right">
								<?php if(in_array('1',$other_action)){ ?>
									<a class="badge badge-success" href="<?= site_url('web-admin/web_pages/addpage'); ?>" >Add</a>
								<?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table f-s-13">
                                <thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Heading</th>
                                        <th>URL</th>
                                        <th>Form</th>
                                        <th>Last Update</th>
                                        <th>Updated By</th>
                                        <th>Action</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($pages as $pgs){?>
									<tr>
                                        <td>
											<?= $i++; ?>
										</td>
                                        <td><?= $pgs->page_heading; ?></td>
                                        <td><?= $pgs->page_url; ?></td>
                                        <td><?= $pgs->form; ?></td>
                                        <td><?= $pgs->last_update; ?></td>
                                        <td><?= $user_info[$pgs->update_by]->f_name; ?></td>
                                        <td id="page-<?=$pgs->id?>">
										<?php if(in_array('3',$other_action)){ ?>
										<?= ($pgs->status == 'D')?'<a href="#" data-id="'.$pgs->id.'" data-status="'.$pgs->status.'" class="change-status badge badge-primary">ACTIVE</a>':'<a href="#" data-id="'.$pgs->id.'" data-status="'.$pgs->status.'" class="change-status badge badge-danger">DEACTIVE</a>'; ?>
										<?php } ?>
										</td>
                                        <td>
										<?php if(in_array('2',$other_action)){ ?>
											<a class="edit-course badge badge-primary" href="<?= site_url("web-admin/web_pages/editpage/".$pgs->id); ?>" >Edit</a>
										<?php } ?>
										</td>
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
						url: "<?= site_url('web-admin/web_pages/change_page_status'); ?>",
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