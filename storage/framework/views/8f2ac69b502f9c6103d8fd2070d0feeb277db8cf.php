<?php $__env->startSection('banner'); ?>
	<div class="hero hero-inner">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6 mx-auto text-center">
					<div class="intro-wrap">
						<?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<h1 class="mb-0"><?php echo e($item->judul); ?></h1>
							<p class="text-white"><?php echo e($item->deskripsi); ?></p>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
		  	</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="untree_co-section">
		<div class="container">
			<div class="row mb-5 justify-content-center">
				<div class="col-lg-6 text-center">
				
				<?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<p><?php echo e($item->konten); ?></p>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
	<div class="site-footer">
		<div class="inner first">
			<div class="container">
				<div class="row">
					<?php $__currentLoopData = $footer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="col-md-6 col-lg-4">
							<div class="widget">
								<h3 class="heading"><?php echo e($item->kiri_judul); ?></h3>
								<p align="justify"><?php echo e($item->kiri_deskripsi); ?></p>
							</div>
							<div class="widget">
								<ul class="list-unstyled social">
									<li><a href="#"><span class="icon-twitter"></span></a></li>
									<li><a href="#"><span class="icon-instagram"></span></a></li>
									<li><a href="#"><span class="icon-facebook"></span></a></li>
									<li><a href="#"><span class="icon-linkedin"></span></a></li>
									<li><a href="#"><span class="icon-dribbble"></span></a></li>
									<li><a href="#"><span class="icon-pinterest"></span></a></li>
									<li><a href="#"><span class="icon-apple"></span></a></li>
									<li><a href="#"><span class="icon-google"></span></a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-6 col-lg-2 pl-lg-5">
							<div class="widget">
								<h3 class="heading">Halaman</h3>
								<ul class="links list-unstyled">
									<li><a href="#">Produk Hukum</a></li>
									<li><a href="#">Unduhan</a></li>
									<li><a href="#">FAQ</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-6 col-lg-2">
							<div class="widget">
								<h3 class="heading"><br></h3>
								<ul class="links list-unstyled">
									<li><a href="#">Berita</a></li>
									<li><a href="#">Kirim Opini</a></li>
									<li><a href="#">Kontak</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-6 col-lg-4">
							<div class="widget">
								<h3 class="heading"><?php echo e($item->kanan_judul); ?></h3>
								<ul class="list-unstyled quick-info links">
									<li class="email"><a href="#"><?php echo e($item->kanan_email); ?></a></li>
									<li class="phone"><a href="#"><?php echo e($item->kanan_telepon); ?></a></li>
									<li class="address"><a href="#"><?php echo e($item->kanan_alamat); ?></a></li>
								</ul>
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
		</div>

		<div class="inner dark">
			<div class="container">
				<div class="row text-center">
					<div class="col-md-8 mb-3 mb-md-0 mx-auto">
						<p>
							Copyright &copy;<script>document.write(new Date().getFullYear());</script><br>
							Bagian Hukum Sekretariat Daerah Kota Tangerang Selatan
						</p>
					</div>
					
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macbookpro/Documents/jdih_dev/resources/views/frontend/pages.blade.php ENDPATH**/ ?>