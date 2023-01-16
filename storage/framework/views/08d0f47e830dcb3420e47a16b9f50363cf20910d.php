<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Diskominfo-Zha">
	<link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6e/Lambang_Kota_Tangerang_Selatan.svg/1228px-Lambang_Kota_Tangerang_Selatan.svg.png">

	<meta name="description" content="" />
	<meta name="keywords" content="jdih, tangsel" />

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Source+Serif+Pro:wght@400;700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="css/frontend/bootstrap.min.css">
	<link rel="stylesheet" href="css/frontend/owl.carousel.min.css">
	<link rel="stylesheet" href="css/frontend/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/frontend/jquery.fancybox.min.css">
	<link rel="stylesheet" href="fonts/icomoon/style.css">
	<link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
	<link rel="stylesheet" href="css/frontend/daterangepicker.css">
	<link rel="stylesheet" href="css/frontend/aos.css">
	<link rel="stylesheet" href="css/frontend/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<title>JDIH Kota Tangerang Selatan</title>
</head>

<body>
	<div class="site-mobile-menu site-navbar-target">
		<div class="site-mobile-menu-header">
			<div class="site-mobile-menu-close">
				<span class="icofont-close js-menu-toggle"></span>
			</div>
		</div>
		<div class="site-mobile-menu-body"></div>
	</div>

	<nav class="site-nav">
		<div class="container">
			<div class="site-navigation">
				<a href="<?php echo e(route('home')); ?>" class="logo m-0">JDIH <span class="text-primary">.</span></a>
				<ul class="js-clone-nav d-none d-lg-inline-block text-left site-menu float-right">
					<?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li <?php if($item->has_submenu == 1): ?> class="has-children" <?php endif; ?>>
							<a href=<?php if($item->link != "#"): ?> <?php echo e(route($item->link)); ?> <?php else: ?> <?php echo e($item->link); ?> <?php endif; ?>><?php echo e($item->nama_menu); ?></a>
							<?php if($item->has_submenu == 1): ?>
								<ul class="dropdown">
									<?php $__currentLoopData = $submenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php if($item->id == $item_sub->id_menu): ?>
										<li <?php if($item_sub->has_submenu == 1): ?> class="has-children" <?php endif; ?>>
											<a href="<?php echo e($item_sub->link); ?>"><?php echo e($item_sub->nama_submenu); ?></a>
											<?php if($item->has_submenu == 1): ?>
											<ul class="dropdown">
												<?php $__currentLoopData = $sub_submenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_sub_sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<?php if($item_sub->id == $item_sub_sub->id_submenu): ?>
													<li><a href="<?php echo e($item_sub_sub->link); ?>"><?php echo e($item_sub_sub->nama_submenu); ?></a></li>
												<?php endif; ?>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</ul>
											<?php endif; ?>
										</li>
									<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>
							<?php endif; ?>
						</li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<li><a href="<?php echo e(route('login')); ?>">Login</a></li>
				</ul>
				<a href="#" class="burger ml-auto float-right site-menu-toggle js-menu-toggle d-inline-block d-lg-none light" data-toggle="collapse" data-target="#main-navbar">
					<span></span>
				</a>
			</div>
		</div>
	</nav>

	<?php echo $__env->yieldContent('banner'); ?>
	<?php echo $__env->yieldContent('content'); ?>
	<?php echo $__env->yieldContent('footer'); ?>

	<div id="overlayer"></div>
	<div class="loader">
		<div class="spinner-border" role="status">
			<span class="sr-only">Loading...</span>
		</div>
	</div>

	<script src="js/frontend/jquery-3.4.1.min.js"></script>
	<script src="js/frontend/popper.min.js"></script>
	<script src="js/frontend/bootstrap.min.js"></script>
	<script src="js/frontend/owl.carousel.min.js"></script>
	<script src="js/frontend/jquery.animateNumber.min.js"></script>
	<script src="js/frontend/jquery.waypoints.min.js"></script>
	<script src="js/frontend/jquery.fancybox.min.js"></script>
	<script src="js/frontend/aos.js"></script>
	<script src="js/frontend/moment.min.js"></script>
	<script src="js/frontend/daterangepicker.js"></script>

	<script src="js/frontend/typed.js"></script>
	<script>
		$(function() {
			var slides = $('.slides'),
			images = slides.find('img');

			images.each(function(i) {
				$(this).attr('data-id', i + 1);
			})

			var typed = new Typed('.typed-words', {
				strings: ["Peraturan Daerah.","Peraturan Walikota.","Keputusan Walikota.","Surat Edaran."],
				typeSpeed: 80,
				backSpeed: 80,
				backDelay: 4000,
				startDelay: 1000,
				loop: true,
				showCursor: true,
				preStringTyped: (arrayPos, self) => {
					arrayPos++;
					console.log(arrayPos);
					$('.slides img').removeClass('active');
					$('.slides img[data-id="'+arrayPos+'"]').addClass('active');
				}

			});
		})
	</script>

	<script src="js/frontend/custom.js"></script>

</body>

</html>
<?php /**PATH C:\Users\ASUS\Downloads\kominfo.jdih-main\resources\views/frontend/index.blade.php ENDPATH**/ ?>