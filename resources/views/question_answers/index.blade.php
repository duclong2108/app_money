@extends('layouts.table')
@section('content')
    <form action="{{ url('/delete-all/question_answers') }}" method="POST">
        @csrf
        <div class="content-wrapper">
            <div class="container-fluid">
                <!-- Breadcrumb-->
                <div class="row pt-2 pb-2">
                    <div class="col-sm-9">
                        <h4 class="page-title">Data Tables</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javaScript:void();">Trang Chủ</a></li>
                            <li class="breadcrumb-item"><a href="javaScript:void();">Bảng</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dữ Liệu Bảng</li>
                        </ol>
                    </div>
                    <div class="col-sm-3">
                        <div class="btn-group float-sm-right">
                            <button type="submit" class="btn btn-facebook waves-effect waves-light"><i
                                    class="fa fa-minus mr-1"></i>Xóa Mục Chọn</button>
                            <a role="button" href="{{ url('/create/question_answer/task/'.$id) }}"
                                class="btn btn-light waves-effect waves-light"><i class="fa fa-plus mr-1"></i>
                                Tạo</a>
                        </div>
                    </div>
                </div>
                <!-- End Breadcrumb-->
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

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><i class="fa fa-table"></i> Dữ Liệu Bảng Câu Hỏi</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" class="select-all"></th>
                                                <th>#</th>
                                                <th>Câu Hỏi</th>
                                                <th>Trạng Thái</th>
                                                <th>Tình Trạng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($question_answers as $key => $question_answer)
                                                <tr>
                                                    <td><input type="checkbox" name="question_answer_id[]" value="{{$question_answer['id']}}"></td>
                                                    <td>{{ ++$key }}</td>
                                                    <td>{{ $question_answer['question'] }}</td>
                                                    <td>
                                                        @if ($question_answer['status'] == 1)
                                                            <a href="javascript:void(0)" style="color: green" id="status-{{$question_answer['id']}}" data-id="{{$question_answer['id']}}" class="status" data-name="App\Models\QuestionAnswer">Active</a>
                                                        @else
                                                            <a href="javascript:void(0)" style="color: red" id="status-{{$question_answer['id']}}" data-id="{{$question_answer['id']}}" class="status" data-name="App\Models\QuestionAnswer">Inactive</a>
                                                        @endif
                                                    </td>
                                                    <td style="font-size: 20px">
                                                        <center>
                                                            <a href="{{ url('/edit/question_answer/' . $question_answer['id'].'/task/'.$id) }}"
                                                                style="color: green" title="Cập Nhật Câu Hỏi Và Câu Trả Lời"><i
                                                                    class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
                                                            <a href="{{ url('/delete/question_answer/' . $question_answer['id']) }}"
                                                                style="color: red" title="Xóa Câu Hỏi Và Câu Trả Lời"><i class="fa fa-trash"></i></a>
                                                        </center>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Row-->
                <!--start overlay-->
                <div class="overlay"></div>
                <!--end overlay-->
            </div>
            <!-- End container-fluid-->

        </div>
    </form>
@endsection
