<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
        <title>Form Login :: JDIH</title>
        
        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    </head>
    <body class="bg-gradient-primary">

        <div class="container">
    
            <!-- Outer Row -->
            <div class="row justify-content-center">
    
                <div class="col-xl-10 col-lg-12 col-md-9">
    
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-6">
                                    <div class="p-4" style="min-height: 600px">
                                        <div class="text-center pt-4">
                                            <a href="{{ route('home') }}"><img src="{{ asset('img/logoPemerintah.png') }}" alt="logo" class="mb-2" /></a>
                                            <h1 class="h5 text-gray-900 mb-2">Selamat Datang<br/>Di JDIH Dev</h1>
                                        </div>
                                        <form class="user" id="form" method="POST" action="{{ route('login.submit') }}" style="padding:20px 30px 20px 30px">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" name="username" class="form-control form-control-user @error('username') is-invalid @enderror" autocomplete="off" placeholder="Username" id="username" value="{{ old('username') }}">
                                                @error('username')
                                                <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror" autocomplete="off" placeholder="Password" id="password" value="{{ old('password') }}">
                                                @error('password')
                                                <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" name="remember" class="custom-control-input" id="customCheck">
                                                    <label class="custom-control-label" for="customCheck">Ingat Saya</label>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Sign In
                                            </button>
                                            <p class="mt-3 mb-1 text-xs">Dengan melanjutkan, Anda memahami dan menyetujui penggunaan Kami atas informasi yang Anda sampaikan sesuai dengan ketentuan Kebijakan Privasi.</p>
                                            {{-- <a href="#" class="text-xs">Lupa kata sandi? Klik disini</a> --}}

                                            @error('user') 
                                            <div class="alert alert-danger mt-2 mb-0 text-xs">{{ $message }}</div>
                                            @enderror
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                </div>
    
            </div>
    
        </div>
    
        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
        <!-- Core plugin JavaScript-->
        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    
        <!-- Custom scripts for all pages-->
        <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    
    </body>
</html>