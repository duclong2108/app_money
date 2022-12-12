@extends('layouts.table')
@section('content')

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
                        <div class="card-header"><i class="fa fa-table"></i> Bảng Dữ Liệu Người Dùng</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" class="select-all"></th>
                                            <th>Mã Máy</th>
                                            <th>Email</th>
                                            <th>Tiền</th>
                                            <th>Trạng Thái</th>
                                            <th>Tình Trạng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <td><input type="checkbox" name="user_id[]" value="{{ $user['id'] }}">
                                                </td>
                                                <td>{{ $user['token'] }}</td>
                                                <td>
                                                    @if (empty($user['email']))
                                                        Chưa Có Email
                                                    @else
                                                        {{ $user['email'] }}
                                                    @endif
                                                </td>
                                                <td id="money-{{ $user['id'] }}"><center>{{ $user['money'] }} <span style="color: pink">VNĐ</span></center></td>

                                                <td>
                                                    @if ($user['status'] == 1)
                                                        <a href="javascript:void(0)" style="color: green"
                                                            id="status-{{ $user['id'] }}" data-id="{{ $user['id'] }}"
                                                            class="status" data-name="App\Models\User">Active</a>
                                                    @else
                                                        <a href="javascript:void(0)" style="color: red"
                                                            id="status-{{ $user['id'] }}" data-id="{{ $user['id'] }}"
                                                            class="status" data-name="App\Models\User">Inactive</a>
                                                    @endif
                                                </td>
                                                <td style="font-size: 20px">
                                                    <center>
                                                        <a role="button" id="user-{{ $user['id'] }}"
                                                            href="javascript:void(0)" @if($user['money']<5000||empty($user['email'])) class="btn btn-success" @elseif($user['money']>=5000&&!empty($user['email'])) class="btn btn-success send-money" @endif
                                                            style="border-radius: 10px" data-id="{{ $user['id'] }}">Phê
                                                            Duyệt Tiền</a>
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
@endsection
