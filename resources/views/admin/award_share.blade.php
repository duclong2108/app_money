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
                        <li class="breadcrumb-item active" aria-current="page">Điều Chỉnh Tiền Thưởng Giới Thiệu</li>
                    </ol>
                </div>

            </div>
            <!-- End Breadcrumb-->
            <form action="{{url('/award-share')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header text-uppercase">Dữ Liệu Tiền Thưởng Giới Thiệu</div>
                            <div class="card-body">

                                <label>Số Tiền</label>
                                <input type="number" class="form-control" required name="money" value="{{$share['money']}}">
                                <hr>

                                <button type="submit" class="btn btn-gradient-primary">Cập Nhật</button>
                            </div>
                        </div>
                    </div>
                </div>

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
