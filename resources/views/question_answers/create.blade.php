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
                        <li class="breadcrumb-item active" aria-current="page">Tạo Câu Hỏi Và Câu Trả Lời</li>
                    </ol>
                </div>

            </div>
            <!-- End Breadcrumb-->
            <form action="{{url('/create/question_answer/task/'.$id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header text-uppercase">Dữ Liệu Câu Hỏi Và Câu Trả Lời</div>
                            <div class="card-body">
                                <label>Câu Hỏi</label>
                                <input type="text" required name="question" class="form-control" required>
                                <hr>
                                <div class="row">
                                    <div class="col-11">
                                        <label>Câu Trả Lời</label>
                                        <input type="text" required name="answer[]" class="form-control" required>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-11">
                                        <label>Câu Trả Lời</label>
                                        <input type="text" required name="answer[]" class="form-control" required>
                                    </div>
                                    <div class="col-1">
                                        <a href="javascript:void(0)" style="position: relative;top:40%" class="create-question"><i class="fa fa-3x fa-plus-circle"></i></a>
                                    </div>
                                </div>
                                <hr>
                                <div id="new-question">

                                </div>
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
