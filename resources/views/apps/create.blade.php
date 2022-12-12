@extends('layouts.create_edit')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumb-->
            <div class="row pt-2 pb-2">
                <div class="col-sm-9">
                    <h4 class="page-title">Tạo</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javaScript:void();">Trang Chủ</a></li>
                        <li class="breadcrumb-item"><a href="javaScript:void();">Cấu Hình</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tạo Ứng Dụng</li>
                    </ol>
                </div>

            </div>
            <!-- End Breadcrumb-->
            <form action="{{url('/create/app')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header text-uppercase">Dữ Liệu Ứng Dụng</div>
                            <div class="card-body">
                                <label>Android App ID</label>
                                <input type="text" required name="android_app_id" class="form-control">
                                <hr>
                                <label>IOS App ID</label>
                                <input type="text" required name="ios_app_id" class="form-control">
                                <hr>
                                <label>Game</label>
                                <input type="text" required name="game" class="form-control">
                                <hr>
                                <label>Package Name</label>
                                <input type="text" required name="package_name" class="form-control">
                                <hr>
                                <label>Android Ads Interstitial</label>
                                <input type="text" required name="android_ads_interstitial" class="form-control">
                                <hr>
                                <label>IOS Ads Interstitial</label>
                                <input type="text" required name="ios_ads_interstitial" class="form-control">
                                <hr>
                                <label>Android Ads Video Reward</label>
                                <input  name="android_ads_video_reward" required type="text" class="form-control">
                                {{-- <video width="100%" height="240" controls>
                                    <source src="" id="video_here">
                                  </video> --}}
                                <hr>
                                <label>IOS Ads Video Reward</label>
                                <input  name="ios_ads_video_reward" type="text" required  class="form-control">
                                {{-- <video width="100%" height="240" controls>
                                    <source src="" id="video_here1">
                                  </video> --}}
                                <hr>
                                <label>Android Ads Banner</label>
                                <input  name="android_ads_banner" required onchange="loadfile(event)"  type="file" class="form-control">
                                <div id="preview"></div>
                                <hr>
                                <label>IOS Ads Banner</label>
                                <input  name="ios_ads_banner" onchange="loadfile1(event)" required type="file" class="form-control">
                                <div id="preview1"></div>
                                <hr>
                                <button type="submit" class="btn btn-gradient-primary">Tạo</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Row-->
                <!--End Row-->


            </form>


            <!--End Row-->



            <!--End Row-->
            <!--start overlay-->
            <div class="overlay"></div>
            <!--end overlay-->
        </div>
        <!-- End container-fluid-->

    </div>
@endsection
