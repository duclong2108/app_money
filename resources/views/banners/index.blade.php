@extends('layouts.table')
@section('content')
    {{-- <form action="{{ url('/delete-all/banners') }}" method="POST">
        @csrf --}}
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
                            {{-- <button type="submit" class="btn btn-facebook waves-effect waves-light"><i
                                    class="fa fa-minus mr-1"></i>Delete All</button> --}}
                            <a role="button" href="javascript:void(0)" data-toggle="modal"
                                data-target="#exampleModalCenterCreate" class="btn btn-light waves-effect waves-light"><i
                                    class="fa fa-plus mr-1"></i>
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
                <div class="modal fade" id="exampleModalCenterCreate" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form action="{{ url('/create/banner') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Tạo Ảnh Bìa</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Ảnh</label>
                                        <input type="file" onchange="loadfile(event)" class="form-control"
                                            id="recipient-name" name="image" required>
                                        <div id="preview"></div>

                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Link</label>
                                        <input type="text" class="form-control" required name="link">
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <!-- End Breadcrumb-->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><i class="fa fa-table"></i> Dữ Liệu Bảng Ảnh Bìa</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" class="select-all"></th>
                                                <th>#</th>
                                                <th>Ảnh</th>
                                                <th>Trạng Thái</th>
                                                <th>Tình Trạng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($banners as $key => $banner)
                                                <tr>
                                                    <td><input type="checkbox" name="banner_id[]"
                                                            value="{{ $banner['id'] }}"></td>
                                                    <td>{{ ++$key }}</td>
                                                    <td>
                                                        <img src="{{ $banner['image'] }}" width="100px" height="100px">
                                                    </td>
                                                    <td>
                                                        @if ($banner['status'] == 1)
                                                            <a href="javascript:void(0)" style="color: green" id="status-{{$banner['id']}}" data-id="{{$banner['id']}}" class="status" data-name="App\Models\Banner">Active</a>
                                                        @else
                                                            <a href="javascript:void(0)" style="color: red" id="status-{{$banner['id']}}" data-id="{{$banner['id']}}" class="status" data-name="App\Models\Banner">Inactive</a>
                                                        @endif
                                                    </td>
                                                    <td style="font-size: 20px">
                                                        <center>
                                                            <a href="{{ url('/edit/banner/' . $banner['id']) }}"
                                                                style="color: green" title="Điều Chỉnh Ảnh Bìa" data-toggle="modal"
                                                                data-target="#exampleModalCenterEdit{{ $banner['id'] }}"><i
                                                                    class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
                                                            <a href="{{ url('/delete/banner/' . $banner['id']) }}"
                                                                style="color: red" title="Xóa Ảnh Bìa" class="delete"><i
                                                                    class="fa fa-trash"></i></a>
                                                        </center>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="exampleModalCenterEdit{{ $banner['id'] }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <form action="{{ url('/edit/banner/' . $banner['id']) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalCenterTitle">
                                                                        Điều Chỉnh Ảnh Bìa</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="recipient-name"
                                                                            class="col-form-label">Ảnh</label>
                                                                        <input type="file" onchange="loadfile(event)"
                                                                            class="form-control" id="recipient-name" data-id="{{$banner['id']}}"
                                                                            name="image">
                                                                        <div id="preview{{$banner['id']}}">
                                                                            @if(!empty($banner['image']))
                                                                            <img src="{{ $banner['image'] }}" height="100px" width="100px">
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="recipient-name" class="col-form-label">Link</label>
                                                                        <input type="text" class="form-control" required name="link" value="{{$banner['link']}}">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Xóa</button>
                                                                    <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
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
    {{-- </form> --}}
@endsection
