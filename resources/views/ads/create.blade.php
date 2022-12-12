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
                        <li class="breadcrumb-item active" aria-current="page">Tạo Quảng Cáo</li>
                    </ol>
                </div>

            </div>
            <!-- End Breadcrumb-->
            <form action="{{url('/create/ads')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header text-uppercase">Dữ Liệu Quảng Cáo</div>
                            <div class="card-body">
                                <label>Tiêu Đề</label>
                                <input type="text" required name="title" class="form-control">
                                <hr>
                                <label>Link</label>
                                <input type="text" required name="link" class="form-control">
                                <hr>
                                <label>Màu</label>
                                <input type="color" required name="color" class="form-control">
                                <hr>
                                <label>Ảnh</label>
                                <input  name="image" onchange="loadfile(event)" required type="file" class="form-control">
                                <div id="preview"></div>
                                <hr>
                                <label>Mô Tả</label>
                                <input type="text" required name="description" class="form-control">
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
