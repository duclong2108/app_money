@extends('layouts.table')
@section('content')
    <form action="{{ url('/delete-all/apps') }}" method="POST">
        @csrf
        <div class="content-wrapper">
            <div class="container-fluid">
                <!-- Breadcrumb-->
                <div class="row pt-2 pb-2">
                    <div class="col-sm-9">
                        <h4 class="page-title">Dữ Liệu Bảng</h4>
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
                            <a role="button" href="{{ url('/create/app') }}"
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><i class="fa fa-table"></i> Dữ Liệu Bảng Ứng Dụng</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" class="select-all"></th>
                                                <th>#</th>
                                                <th>App ID IOS</th>
                                                <th>App ID Android</th>
                                                <th>Game</th>
                                                <th>Package Name</th>
                                                <th>Tình Trạng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($apps as $key => $app)
                                                <tr>
                                                    <td><input type="checkbox" name="app_id[]" value="{{$app['id']}}"></td>
                                                    <td>{{ ++$key }}</td>
                                                    <td>
                                                        {{ $app['ios_app_id'] }}
                                                    </td>
                                                    <td>{{ $app['android_app_id'] }}</td>
                                                    <td>{{ $app['game'] }}</td>
                                                    <td>
                                                        {{$app['package_name']}}
                                                    </td>
                                                    <td style="font-size: 20px">
                                                        <center>
                                                            <a href="{{ url('/edit/app/' . $app['id']) }}"
                                                                style="color: green" title="Điều Chỉnh Ứng Dụng"><i
                                                                    class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
                                                            <a href="{{ url('/delete/app/' . $app['id']) }}"
                                                                style="color: red" title="Xóa Ứng Dụng"><i class="fa fa-trash"></i></a>
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
