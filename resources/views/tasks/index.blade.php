@extends('layouts.table')
@section('content')

    <form action="{{ url('/delete-all/tasks') }}" method="POST">
        @csrf
        <div class="content-wrapper">
            <div class="container-fluid">
                <!-- Breadcrumb-->
                <div class="row pt-2 pb-2">
                    <div class="col-sm-9">
                        <h4 class="page-title">Data Tables</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javaScript:void();">Trang chủ</a></li>
                            <li class="breadcrumb-item"><a href="javaScript:void();">Bảng</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dữ liệu bảng</li>
                        </ol>
                    </div>
                    <div class="col-sm-3">
                        <div class="btn-group float-sm-right">
                            <button type="submit" class="btn btn-facebook waves-effect waves-light"><i
                                    class="fa fa-minus mr-1"></i>Xóa Mục Chọn</button>
                            <a role="button" href="{{ url('/create/task') }}"
                                class="btn btn-light waves-effect waves-light"><i class="fa fa-plus mr-1"></i>
                                Tạo</a>
                        </div>
                    </div>
                </div>
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
                <!-- End Breadcrumb-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><i class="fa fa-table"></i> Bảng Dữ Liệu Nhiệm Vụ</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" class="select-all"></th>
                                                <th>#</th>
                                                <th>Tiêu Đề</th>
                                                <th>Giá</th>
                                                <th>Mức Độ</th>
                                                <th>Trạng Thái</th>
                                                <th>Tình Trạng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tasks as $key => $task)
                                                <tr>
                                                    <td><input type="checkbox" name="task_id[]" value="{{ $task['id'] }}">
                                                    </td>
                                                    <td>{{ ++$key }}</td>
                                                    <td>
                                                        {{$task['title']}}
                                                    </td>
                                                    <td>{{ $task['price'] }}</td>
                                                    <td>
                                                        @if ($task['level']==1)
                                                            Dễ
                                                        @elseif ($task['level']==2)
                                                            Trung Bình
                                                        @elseif ($task['level']==3)
                                                            Khó
                                                        @else
                                                            Cực Khó
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($task['status'] == 1)
                                                            <a href="javascript:void(0)" style="color: green"
                                                                id="status-{{ $task['id'] }}"
                                                                data-id="{{ $task['id'] }}" class="status"
                                                                data-name="App\Models\Task">Active</a>
                                                        @else
                                                            <a href="javascript:void(0)" style="color: red"
                                                                id="status-{{ $task['id'] }}"
                                                                data-id="{{ $task['id'] }}" class="status"
                                                                data-name="App\Models\Task">Inactive</a>
                                                        @endif
                                                    </td>
                                                    <td style="font-size: 20px">
                                                        <center>
                                                            @if($task['select']==1)
                                                            <a href="{{ url('/question_answer/task/' . $task['id']) }}"
                                                                style="color: blue;" title="Tạo Câu Hỏi Cho Nhiệm Vụ"><i
                                                                    class="fa fa-eye"></i></a>&nbsp;&nbsp;&nbsp;@endif
                                                            <a href="{{ url('/edit/task/' . $task['id']) }}"
                                                                style="color: green" title="Chỉnh Sửa Nhiệm Vụ"><i
                                                                    class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
                                                            <a href="{{ url('/delete/task/' . $task['id']) }}"
                                                                style="color: red" title="Xóa Nhiệm Vụ"><i
                                                                    class="fa fa-trash"></i></a>
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
