<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard : CFT LMS</title>
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/fevicon.png'); ?>">
    <!-- Styles -->
    <link href="<?= base_url('assets'); ?>/css/lib/chartist/chartist.min.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/lib/themify-icons.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="<?= base_url('assets'); ?>/css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="<?= base_url('assets'); ?>/css/lib/weather-icons.css" rel="stylesheet" />
    <link href="<?= base_url('assets'); ?>/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/lib/unix.css" rel="stylesheet">
    <link href="<?= base_url('assets'); ?>/css/style.css" rel="stylesheet">
</head>

<body>
<?php
   // $myv = $this->curd_model->count_where('visitors', array('create_by'=>$this->session->userdata('callco_hr')));
   // $allv = $this->curd_model->count_where('visitors', array('1'=>1));
?>
    <?php include('common/side.php'); ?>
    <!-- /# sidebar -->

    <?php include('common/header.php'); ?>
    
    
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
							    <h1>Hello <?= $session['f_name']; ?>, <span>Welcome Here</span></h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li class="active">Home</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="stat-widget-eight">
                                    <div class="stat-header">
                                        <div class="header-title pull-left">Student Registration</div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="stat-content">
                                        <div class="pull-left">
                                            <i class="ti-arrow-up color-success"></i>
                                            <span class="stat-digit"> <?=$count['student'];?></span>
                                        </div>
                                        <div class="pull-right">
                                            
                                            <span class="progress-stats">100%</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-primary w-100" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                            <span class="sr-only">100% Candidate</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="stat-widget-eight">
                                    <div class="stat-header">
                                        <div class="header-title pull-left">Join Us</div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="stat-content">
                                        <div class="pull-left">
                                            <i class="ti-arrow-up color-success"></i>
                                            <span class="stat-digit"> <?=$count['join_us'];?></span>
                                        </div>
                                        <div class="pull-right">
                                            <span class="progress-stats">23%</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-success w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                            <span class="sr-only">25% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="stat-widget-eight">
                                    <div class="stat-header">
                                        <div class="header-title pull-left">Contact Us</div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="stat-content">
                                        <div class="pull-left">
                                            <i class="ti-arrow-up color-danger"></i>
                                            <span class="stat-digit"> <?=$count['contact'];?> </span>
                                        </div>
                                        <div class="pull-right">
                                            <span class="progress-stats"></span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-warning w-70" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                            <span class="sr-only">70% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card alert">
                                        <div class="card-body" style="height:350px; overflow:auto;">
                                            <h4>Contact Form</h4>
                                            <hr>
                                            <table class="table f-s-11 table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Name/Phone</th>
                                                        <th>Insert-At</th>
                                                        <th>Email</th>
                                                        <th>Purpose</th>
                                                         <th>View</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($contact)){ foreach($contact as $cnt){ ?>
                                                    <tr>
                                                        <td><?= $cnt->name; ?> <?= $cnt->contact; ?></td>
                                                        <td><?= date('H:i:s', strtotime($cnt->insert_time)); ?></td>
                                                        <td><?= $cnt->email_id; ?></td>
                                                        <td><?= $cnt->purpose; ?></td>
                                                        <td>
															<a class="badge badge-success" href="<?= site_url("form/contact"); ?>"><i class="ti ti-eye"></i></a>
														</td>
                                                    </tr>
                                                    <?php } } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card alert">
                                        <div class="card-body" style="height:350px; overflow:auto;">
                                            <h4>Registration Form</h4>
                                            <hr>
                                            <table class="table f-s-11 table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Mobile</th>
                                                        <th>Email</th>
                                                        <th>Program</th>
                                                        <th>Details</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($registration)){ foreach($registration as $reg){ ?>
                                                    <tr>
                                                        <td><?= $reg->name; ?> </td>
                                                        <td><?= $reg->contact; ?></td>
                                                        <td><?= $reg->email_id; ?></td>
                                                        <td><h6><?= $reg->program; ?></h6></td>
                                                        <td><a class="badge badge-success" href="<?= site_url("form/registration"); ?>"><i class="ti ti-eye"></i></a></td>
                                                    </tr>
                                                    <?php } }  ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                        
                    </div>
                    
                    
                    
                    <!-- /# row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="footer">
                                <p>This dashboard was generated on <span id="date-time"></span> <a href="#" class="page-refresh">Refresh Dashboard</a></p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <div id="search">
        <button type="button" class="close">×</button>
        <form>
            <input type="search" value="" placeholder="type keyword(s) here" />
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
    <script src="<?= base_url('assets/'); ?>/js/lib/jquery.min.js"></script>
    <!-- jquery vendor -->
    <script src="<?= base_url('assets/'); ?>/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="<?= base_url('assets/'); ?>/js/lib/menubar/sidebar.js"></script>
    <script src="<?= base_url('assets/'); ?>/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="<?= base_url('assets/'); ?>/js/lib/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/'); ?>/js/scripts.js"></script>
</body>
</html>