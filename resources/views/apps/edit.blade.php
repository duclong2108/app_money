@extends('layouts.create_edit')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumb-->
            <div class="row pt-2 pb-2">
                <div class="col-sm-9">
                    <h4 class="page-title">Điều Chỉnh</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javaScript:void();">Trang Chủ</a></li>
                        <li class="breadcrumb-item"><a href="javaScript:void();">Cấu Hình</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Điều Chỉnh Ứng Dụng</li>
                    </ol>
                </div>

            </div>
            <!-- End Breadcrumb-->
            <form action="{{url('/edit/app/'.$app['id'])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header text-uppercase">Dữ Liệu Ứng Dụng</div>
                            <div class="card-body">
                                <label>Android App ID</label>
                                <input type="text" value="{{$app['android_app_id']}}" required name="android_app_id" class="form-control">
                                <hr>
                                <label>IOS App ID</label>
                                <input type="text" required name="ios_app_id" value="{{$app['ios_app_id']}}" class="form-control">
                                <hr>
                                <label>Game</label>
                                <input type="text" required name="game" class="form-control" value="{{$app['game']}}">
                                <hr>
                                <label>Package Name</label>
                                <input type="text" required name="package_name" class="form-control" value="{{$app['package_name']}}">
                                <hr>
                                <label>Android Ads Interstitial</label>
                                <input type="text" required name="android_ads_interstitial" class="form-control" value="{{$app['android_ads_interstitial']}}">
                                <hr>
                                <label>IOS Ads Interstitial</label>
                                <input type="text" required name="ios_ads_interstitial" class="form-control" value="{{$app['ios_ads_interstitial']}}">
                                <hr>
                                <label>Android Ads Video Reward</label>
                                <input  name="android_ads_video_reward" type="text" required class="form-control " value="{{$app['android_ads_video_reward']}}">
                                {{-- <video width="100%" height="240" controls>
                                    <source src="{{$app['android_ads_video_reward']}}" id="video_here">
                                  </video> --}}
                                <hr>
                                <label>IOS Ads Video Reward</label>
                                <input  name="ios_ads_video_reward" type="text" required class="form-control " value="{{$app['ios_ads_video_reward']}}">
                                {{-- <video width="100%" height="240" controls>
                                    <source src="{{$app['ios_ads_video_reward']}}" id="video_here1">
                                  </video> --}}
                                <hr>
                                <label>Android Ads Banner</label>
                                <input  name="android_ads_banner" onchange="loadfile(event)"  type="file" class="form-control">
                                <div id="preview">
                                    <input type="image" src="{{$app['android_ads_banner']}}" width="100px" height="100px">
                                </div>
                                <hr>
                                <label>IOS Ads Banner</label>
                                <input  name="ios_ads_banner" onchange="loadfile1(event)" type="file" class="form-control">
                                <div id="preview1">
                                    <input type="image" src="{{$app['ios_ads_banner']}}" width="100px" height="100px">
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-gradient-primary">Cập Nhật</button>
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
