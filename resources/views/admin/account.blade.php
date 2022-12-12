<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from codervent.com/dashtremev3/pages-user-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Jul 2020 09:42:03 GMT -->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <base href="{{asset('')}}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Dashboard</title>
    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet" />
    {{-- <script src="assets/js/pace.min.js"></script> --}}
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- simplebar CSS-->
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <!-- Bootstrap core CSS-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="assets/css/animate.css" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <!-- Metismenu CSS-->
    <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- Custom Style-->
    <link href="assets/css/app-style.css" rel="stylesheet" />

</head>

<body class="bg-theme bg-theme2">

    <!-- Start wrapper-->
    <div id="wrapper">

        <!--Start sidebar-wrapper-->
        @include('layouts.sidebar')
        <!--End sidebar-wrapper-->

        <!--Start topbar header-->
        @include('layouts.header')
        <!--End topbar header-->

        <div class="clearfix"></div>

        <div class="content-wrapper">
            <div class="container-fluid">
                @if (Session::has('error_message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('error_message') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @elseif(Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('success_message') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <!-- Breadcrumb-->
                <div class="row pt-2 pb-2">
                    <div class="col-sm-9">
                        <h4 class="page-title">Thông Tin Quản Trị</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javaScript:void();">Trang chủ</a></li>
                            <li class="breadcrumb-item"><a href="javaScript:void();">Trang</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Thông Tin Quản Trị</li>
                        </ol>
                    </div>

                </div>
                <!-- End Breadcrumb-->

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card profile-card-2">
                            <div class="card-img-block">
                                <img class="img-fluid" src="assets/images/gallery/31.jpg" alt="Card image cap">
                            </div>
                            <div class="card-body pt-5">
                                <img src="assets/images/avatar.jpg" alt="profile-image" class="profile">
                                <h5 class="card-title">Admin</h5>
                                <p class="card-text">If anyone wants know too much about you then give them a cold answer.</p>
                                <div class="icon-block">
                                    <a href="javascript:void();"><i
                                            class="fa fa-facebook bg-facebook text-white"></i></a>
                                    <a href="javascript:void();"> <i
                                            class="fa fa-twitter bg-twitter text-white"></i></a>
                                    <a href="javascript:void();"> <i
                                            class="fa fa-google-plus bg-google-plus text-white"></i></a>
                                </div>
                            </div>


                        </div>

                    </div>

                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">

                                    <li class="nav-item">
                                        <a href="javascript:void();" data-target="#edit" data-toggle="pill"
                                            class="nav-link"><i class="icon-note"></i> <span
                                                class="hidden-xs">Thay Đổi</span></a>
                                    </li>
                                </ul>
                                <div class=" p-3">


                                    <div class="tab-pane" id="edit">
                                        <form action="{{url('/account')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Tên</label>
                                                <div class="col-lg-9">
                                                    <input class="form-control" type="text" value="{{$admin['name']}}" name="name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                                <div class="col-lg-9">
                                                    <input class="form-control" type="email" value="{{$admin['email']}}" name="email">
                                                </div>
                                            </div>
                                            {{-- <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Image</label>
                                                <div class="col-lg-9">
                                                    <input class="form-control" type="file" name="image">
                                                </div>
                                            </div> --}}


                                            <div class="form-group row">
                                                <label
                                                    class="col-lg-3 col-form-label form-control-label">Mật Khẩu Mới</label>
                                                <div class="col-lg-9">
                                                    <input class="form-control" id="value_password" type="password" name="new_password">
                                                    {{-- <span id="check_password"></span> --}}
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Nhập Lại Mật Khẩu</label>
                                                <div class="col-lg-9">
                                                    <input class="form-control"  type="password" name="confirm_password">
                                                </div>

                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                                <div class="col-lg-9">
                                                    <input type="reset" class="btn btn-secondary" value="Xóa">
                                                    <input type="submit" class="btn btn-primary" value="Lưu thay đổi">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!--start overlay-->
                <div class="overlay"></div>
                <!--end overlay-->
            </div>
            <!-- End container-fluid-->
        </div>
        <!--End content-wrapper-->
        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->

        <!--Start footer-->
        @include('layouts.footer')
        <!--End footer-->

        <!--start color switcher-->

        <!--end color switcher-->

    </div>
    <!--End wrapper-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- simplebar js -->
    <script src="assets/plugins/simplebar/js/simplebar.js"></script>
    <!-- Metismenu js -->
    <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>

    <!-- Custom scripts -->
    <script src="assets/js/app-script.js"></script>
    <script src="main.js"></script>

</body>

<!-- Mirrored from codervent.com/dashtremev3/pages-user-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 29 Jul 2020 09:42:04 GMT -->

</html>
