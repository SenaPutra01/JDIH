@extends('frontend.index')

@section('banner')
	<div class="hero">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-7">
					<div class="intro-wrap">
						<h1 class="mb-5"><span class="d-block">Cari Produk Hukum</span> Seperti <span class="typed-words"></span></h1>

						<div class="row">
							<div class="col-12">
								<form class="form">
									<div class="row mb-2">
										<div class="col-sm-12 col-md-6 mb-3 mb-lg-0 col-lg-4">
											<select name="" id="" class="form-control custom-select">
												<option value="">Produk Hukum</option>
												<option value="">Peraturan Daerah</option>
												<option value="">Peraturan Walikota</option>
												<option value="">Keputusan Walikota</option>
												<option value="">Surat Edaran</option>
											</select>
										</div>
										<div class="col-sm-12 col-md-6 mb-3 mb-lg-0 col-lg-5">
											<input type="text" class="form-control" name="daterange">
										</div>
										<div class="col-sm-12 col-md-6 mb-3 mb-lg-0 col-lg-3">
											<input type="submit" class="btn btn-primary btn-block" value="Search">
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-5">
					<div class="slides">
						<img src="frontend/images/hero-slider-1.jpg" alt="Image" class="img-fluid active">
						<img src="frontend/images/hero-slider-2.jpg" alt="Image" class="img-fluid">
						<img src="frontend/images/hero-slider-3.jpg" alt="Image" class="img-fluid">
						<img src="frontend/images/hero-slider-4.jpg" alt="Image" class="img-fluid">
						<img src="frontend/images/hero-slider-5.jpg" alt="Image" class="img-fluid">
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('content')
	<div class="untree_co-section">
		<div class="container">
			<div class="row mb-5 justify-content-center">
				<div class="col-lg-6 text-center">
					<h2 class="section-title text-center mb-3">Produk Hukum Terbaru</h2>
					<p>Kota Tangerang Selatan</p>
				</div>
			</div>
			<div class="row align-items-stretch">
				{{-- <div class="col-lg-4 order-lg-1">
					<div class="h-100">
						<div class="frame h-100">
							<div class="feature-img-bg h-100" style="background-image: url('frontend/images/hero-slider-1.jpg');"></div>
						</div>
					</div>
				</div> --}}

				@foreach ($produk_hukum as $item)
					@foreach ($nama_peraturan as $np)
					@if ($item->id_jenis == $np->id_jenis && $item->id_jenis_sub == $np->id_jenis_sub)
					<div class="col-6 col-sm-6 col-lg-4 feature-1-wrap d-md-flex flex-md-column order-lg-1" >
						<div class="feature-1 d-md-flex">
							<div class="align-self-center" style="height: 250px">
								<span><i class="fa fa-calendar"></i> {{ $item->tgl_penetapan }}</span>
								<span class="float-right"><i class="fa fa-download"></i> {{ $item->count_download }}</span>
								<br><br>
								{{-- <span class="flaticon-house display-4 text-primary"></span> --}}
								<h3>{{ $np->name }}</h3>
								<h3>No. {{ $item->no_produk_hukum }} Tahun {{ $item->tahun_pembuatan }}</h3>
								<p class="mb-0">Tentang {{ $item->tentang }}</p>
							</div>
						</div>
						{{-- <div class="feature-1 ">
							<div class="align-self-center">
								<span class="flaticon-restaurant display-4 text-primary"></span>
								<h3>Restaurants & Cafe</h3>
								<p class="mb-0">Even the all-powerful Pointing has no control about the blind texts.</p>
							</div>
						</div> --}}
					</div>
					@endif
					@endforeach
				@endforeach
				{{-- <div class="col-6 col-sm-6 col-lg-4 feature-1-wrap d-md-flex flex-md-column order-lg-3" >
					<div class="feature-1 d-md-flex">
						<div class="align-self-center">
							<span class="flaticon-mail display-4 text-primary"></span>
							<h3>Easy to Connect</h3>
							<p class="mb-0">Even the all-powerful Pointing has no control about the blind texts.</p>
						</div>
					</div>
					<div class="feature-1 d-md-flex">
						<div class="align-self-center">
							<span class="flaticon-phone-call display-4 text-primary"></span>
							<h3>24/7 Support</h3>
							<p class="mb-0">Even the all-powerful Pointing has no control about the blind texts.</p>
						</div>
					</div>
				</div> --}}
			</div>
		</div>
	</div>
	<div class="untree_co-section count-numbers py-5">
		<div class="container">
			<div class="row text-center">
				<div class="col-6 col-sm-6 col-md-6 col-lg-3">
					<div class="counter-wrap">
						<div class="counter">
							<span class="" data-number="{{ $perda }}">0</span>
						</div>
						<span class="caption">Peraturan Daerah</span>
					</div>
				</div>
				<div class="col-6 col-sm-6 col-md-6 col-lg-3">
					<div class="counter-wrap">
						<div class="counter">
							<span class="" data-number="{{ $perwal }}">0</span>
						</div>
						<span class="caption">Peraturan Wali Kota</span>
					</div>
				</div>
				<div class="col-6 col-sm-6 col-md-6 col-lg-3">
					<div class="counter-wrap">
						<div class="counter">
							<span class="" data-number="{{ $kepwal }}">0</span>
						</div>
						<span class="caption">Keputusan Wali Kota</span>
					</div>
				</div>
				<div class="col-6 col-sm-6 col-md-6 col-lg-3">
					<div class="counter-wrap">
						<div class="counter">
							<span class="" data-number="{{ $se }}">0</span>
						</div>
						<span class="caption">Surat Edaran Wali Kota</span>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="untree_co-section">
		<div class="container">
			<div class="row justify-content-center text-center mb-5">
				<div class="col-lg-6">
					<h2 class="section-title text-center mb-3">Berita Terkini</h2>
					<p>Deskripsi.</p>
				</div>
			</div>
			<div class="row">
				@foreach ($berita as $news)
					<div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
						<div class="media-1">
							<img src="{{ url('https://jdih.tangerangselatankota.go.id/resources/images/gallery/'.$news->image_display) }}" alt="Image" class="img-fluid">
							<span class="d-flex align-items-center loc mb-2">
								{{-- <span class="icon-room mr-3"></span> --}}
								<span>{{ $news->created_at }} | Dilihat {{ $news->hits_count }} kali</span>
							</span>
							<div class="d-flex align-items-center">
								<div>
									<h3><a href="#">{{ $news->title }}</a></h3>
									<button class="btn btn-primary btn-sm mb-4">Baca Selengkapnya</button>
									{{-- <div class="price ml-auto">
										<span>$520.00</span>
									</div> --}}
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
	
	<div class="py-5 cta-section">
		<div class="container">
			<div class="row text-center">
				<div class="col-md-12">
					<h2 class="mb-2 text-white">Kanal Opini</h2>
					<p class="mb-4 lead text-white text-white-opacity">Sampaikan opini anda kepada kami untuk JDIH yang lebih baik.</p>
					<p class="mb-0"><a href="#" class="btn btn-outline-white text-white btn-md font-weight-bold">Kirim Opini</a></p>
				</div>
			</div>
		</div>
	</div>

	<div class="untree_co-section testimonial-section mt-5">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-7 text-center">
					<h2 class="section-title text-center mb-5">Testimoni</h2>

					<div class="owl-single owl-carousel no-nav">
						@foreach ($opini as $item)
							<div class="testimonial mx-auto">
								{{-- <figure class="img-wrap">
									<img src="frontend/images/person_2.jpg" alt="Image" class="img-fluid">
								</figure> --}}
								<h3>{{ $item->subject }}</h3>
								<blockquote>
									<p>&ldquo;{{ $item->comment }}&rdquo;</p>
								</blockquote>
								<h3 class="name">{{ $item->name }}</h3>
							</div>
						@endforeach
					</div>

				</div>
			</div>
		</div>
	</div>
@endsection

@section('footer')
	<div class="site-footer">
		<div class="inner first">
			<div class="container">
				<div class="row">
					@foreach ($footer as $item)
						<div class="col-md-6 col-lg-4">
							<div class="widget">
								<h3 class="heading">{{ $item->kiri_judul }}</h3>
								<p align="justify">{{ $item->kiri_deskripsi }}</p>
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
								<h3 class="heading">{{ $item->kanan_judul }}</h3>
								<ul class="list-unstyled quick-info links">
									<li class="email"><a href="#">{{ $item->kanan_email }}</a></li>
									<li class="phone"><a href="#">{{ $item->kanan_telepon }}</a></li>
									<li class="address"><a href="#">{{ $item->kanan_alamat }}</a></li>
								</ul>
							</div>
						</div>
					@endforeach
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
@endsection