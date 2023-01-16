<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="JDIH website">
    <meta name="author" content="Zhafran-Diskominfo">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="icon" href="<?php echo e(asset('img/favicon.png')); ?>" type="image/x-icon">
    <title><?php echo e(isset($title) ? $title : 'Halaman'); ?> :: JDIH</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo e(asset('vendor/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?php echo e(asset('vendor/datatables/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('vendor/_datatables/buttons.dataTables.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendor/fancybox/jquery.fancybox.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendor/calendar/css/pignose.calendar.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendor/select2/select2.min.css')); ?>">

    <!-- Custom styles for this template-->
    <link href="<?php echo e(asset('css/sb-admin-2.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/mystyle.css')); ?>" rel="stylesheet">
</head>

<body id="page-top">
    <?php $user = Auth::user(); ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo e(route('dashboard')); ?>">
                <div class="sidebar-brand-icon">
                    <img src="<?php echo e(asset('img/logoPemerintah.png')); ?>" alt="logo" width="60%"/>
                </div>
                <div class="sidebar-brand-text mx-3">JDIH</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php echo e(URL::current() != route('dashboard') ? '' : 'active'); ?>">
                <a class="nav-link" href="<?php echo e(route('dashboard')); ?>"><i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <?php if($user->instansiname != "" && $user->id_group == 7): ?>
                <!-- Heading -->
                <div class="sidebar-heading">Pengajuan</div>

                <li class="nav-item <?php echo e(URL::current() != route('pengajuan.create') ? '' : 'active'); ?>">
                    <a class="nav-link" href="<?php echo e(route('pengajuan.create')); ?>"><i class="fas fa-fw fa-plus"></i><span>Buat</span></a>
                </li>

                <li class="nav-item <?php echo e(URL::current() != route('pengajuan.index') ? '' : 'active'); ?>">
                    <a class="nav-link" href="<?php echo e(route('pengajuan.index')); ?>"><i class="fas fa-fw fa-history"></i><span>Riwayat</span></a>
                </li>
            <?php endif; ?>

            <?php if($user->id_group == 1): ?>
                <!-- Heading -->
                <div class="sidebar-heading">Portal Web</div>

                <li class="nav-item <?php echo e(URL::current() != route('menu.index') ? '' : 'active'); ?>">
                    <a class="nav-link" href="<?php echo e(route('menu.index')); ?>"><i class="fas fa-fw fa-bars"></i><span>Menu</span></a>
                </li>
                <li class="nav-item <?php echo e(URL::current() != route('halaman.index') ? '' : 'active'); ?>">
                    <a class="nav-link" href="<?php echo e(route('halaman.index')); ?>"><i class="fas fa-fw fa-file"></i><span>Halaman</span></a>
                </li>
                <li class="nav-item <?php echo e(URL::current() != route('berita.index') ? '' : 'active'); ?>">
                    <a class="nav-link" href="<?php echo e(route('berita.index')); ?>"><i class="fas fa-fw fa-newspaper"></i><span>Berita</span></a>
                </li>
                <li class="nav-item <?php echo e(URL::current() != route('footer.index') ? '' : 'active'); ?>">
                    <a class="nav-link" href="<?php echo e(route('footer.edit',1)); ?>"><i class="fas fa-fw fa-copyright"></i><span>Footer</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">Laporan</div>

                <li class="nav-item <?php echo e(URL::current() != route('report') ? '' : 'active'); ?>">
                    <a class="nav-link" href="<?php echo e(route('report')); ?>"><i class="fas fa-fw fa-book"></i><span>Laporan</span></a>
                </li>
            <?php endif; ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow-sm">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <?php if($user->instansiname != ''): ?>
                            <label class="small"><b>PD:</b>&nbsp; <?php echo e(Illuminate\Support\Str::limit($user->instansiname, 50)); ?></label>
                            <?php endif; ?>
                            
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        

                        <!-- Nav Item - Messages -->
                        

                        

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo e($user->first_name.' '.$user->last_name); ?></span>
                                <img class="img-profile rounded-circle" src="<?php echo e(asset('img/undraw_profile.svg')); ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="modal" data-target="#logoutModal" title="Logout">
                                <i class="fas fa-sign-out-alt fa-fw text-danger"></i>
                            </a>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="alert alert-warning position-absolute" style="z-index: 9; display:none; top: 10px; left: 40%;" id="loading">Sedang mengambil data.</div>
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; JDIH Development 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Logout</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" di bawah ini jika Anda siap untuk mengakhiri sesi Anda saat ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <a href="<?php echo e(route('logout')); ?>" class="btn btn-primary" onclick="event.preventDefault(); this.closest('form').submit();">
                            <div class="pt-1">Logout</div>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo e(asset('vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo e(asset('vendor/jquery-easing/jquery.easing.min.js')); ?>"></script>

    <script src="<?php echo e(asset('vendor/validate/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/fancybox/jquery.fancybox.min.js')); ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo e(asset('js/sb-admin-2.min.js')); ?>"></script>

    <!-- Page level plugins -->
    <script src="<?php echo e(asset('vendor/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/calendar/js/pignose.calendar.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/select2/select2.min.js')); ?>"></script>

    <script src="<?php echo e(asset('vendor/_datatables/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/_datatables/buttons.bootstrap4.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/_datatables/buttons.html5.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/_datatables/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/_datatables/vfs_fonts.js')); ?>"></script>
    <script src="<?php echo e(asset('vendor/_datatables/jszip.min.js')); ?>"></script>


    <script type="text/javascript">
        var APP_URL = <?php echo json_encode(url('/').'/'); ?>;
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html><?php /**PATH C:\Users\ASUS\Downloads\kominfo.jdih-main\resources\views/layouts/app.blade.php ENDPATH**/ ?>