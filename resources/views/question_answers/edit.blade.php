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
                        <li class="breadcrumb-item active" aria-current="page">Điều Chỉnh Câu Hỏi Và Câu Trả Lời</li>
                    </ol>
                </div>

            </div>
            <!-- End Breadcrumb-->
            <form action="{{ url('/edit/question_answer/' . $question_answer_id . '/task/' . $task_id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header text-uppercase">Dữ Liệu Câu Hỏi Và Câu Trả Lời</div>
                            <div class="card-body">
                                <label>Câu Hỏi</label>
                                <input type="text" required name="question" class="form-control"
                                    value="{{ $question_answer['question'] }}">
                                <hr>
                                {{-- <div class="row">
                                    <div class="col-11">
                                        <label>Answer</label>
                                        <input type="text" required name="answer[]" class="form-control">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-11">
                                        <label>Answer</label>
                                        <input type="text" required name="answer[]" class="form-control">
                                    </div>
                                    <div class="col-1">
                                        <a href="javascript:void(0)" style="position: relative;top:40%" class="create-question"><i class="fa fa-3x fa-plus-circle"></i></a>
                                    </div>
                                </div>
                                <hr> --}}
                                @foreach (explode('|||', $question_answer['answer']) as $key => $answer)
                                    @if ($key == 0)
                                        <div class="row">
                                            <div class="col-11">
                                                <label>Câu Trả Lời</label>
                                                <input type="text" required name="answer[]" class="form-control"
                                                    value="{{ $answer }}">
                                            </div>
                                        </div>
                                        <hr>
                                    @elseif($key==1)
                                        <div class="row">
                                            <div class="col-11">
                                                <label>Câu Trả Lời</label>
                                                <input type="text" required name="answer[]" class="form-control"
                                                    value="{{ $answer }}">
                                            </div>
                                            <div class="col-1">
                                                <a href="javascript:void(0)" style="position: relative;top:40%"
                                                    class="create-question"><i class="fa fa-3x fa-plus-circle"></i></a>
                                            </div>
                                        </div>
                                        <hr>
                                    @elseif($key>1)
                                        <div class="pastcreate">
                                            <div class="row">
                                                <div class="col-11">
                                                    <label>Câu Trả Lời</label>
                                                    <input type="text" required name="answer[]" class="form-control" value="{{$answer}}">
                                                </div>
                                                <div class="col-1">
                                                    <a href="javascript:void(0)" style="position: relative;top:40%"
                                                        class="minus-question"><i class="fa fa-3x fa-minus-circle"></i></a>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    @endif
                                @endforeach
                                <div id="new-question">

                                </div>
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
@push('scripts')
    <script>
        $(document).ready(function(){
            $('.minus-question').click(function(){
                $(this).closest('.pastcreate').remove();
            });
        });
    </script>
@endpush
