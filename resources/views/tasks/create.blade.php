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
                        <li class="breadcrumb-item active" aria-current="page">Tạo Nhiệm Vụ</li>
                    </ol>
                </div>

            </div>
            <!-- End Breadcrumb-->
            <form action="{{ url('/create/task') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header text-uppercase">Các Dữ Liệu Nhiệm Vụ</div>
                            <div class="card-body">
                                <label>Tiêu Đề</label>
                                <input type="text" name="title" required class="form-control">
                                <hr>
                                <label>Giá</label>
                                <input type="number" required min="0" name="price" class="form-control">
                                <hr>
                                
                                <label>Lựa Chọn Link Hoặc Câu Hỏi</label>
                                <select class="form-control select-link-question" name="select" required>
                                    <option value="1">Câu Hỏi</option>
                                    <option value="0">Link</option>
                                </select>
                                <hr>
                                <div id="link">
                                    
                                </div>
                                {{-- <label>Link</label>
                                <input type="text" name="link" class="form-control">
                                <hr> --}}
                                <!-- <div class="grade" style="display: none;">
                                <label>Điểm</label>
                                <select name="grade[]" required class="form-control js-example-tags" multiple>
                                </select>
                                <hr>
                                </div> -->
                                <label>Ảnh</label>
                                <input name="image" onchange="loadfile(event)" type="file" class="form-control">
                                <div id="preview"></div>
                                <hr>
                                <label>Mô Tả</label>
                                <textarea id="summernoteEditor" name="description">
                                    </textarea>
                                <hr>
                                <label>Mức Độ</label>
                                <select class="form-control" name="level" required>
                                    <option value="1" selected>Dễ</option>
                                    <option value="2">Trung Bình</option>
                                    <option value="3">Khó</option>
                                    <option value="4">Cực Khó</option>
                                </select>
                                <hr>
                                <label>Đánh Giá</label>
                                <input id="input-id" type="hidden" name="rating" class="rating form-control" data-size="lg">
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
{{-- @push('scripts')
    <script>
        $('.select-link-question').change(function(){
        var value=$(this).val();
        // alert(value);
        count=1;
        if(value==0){
            $('#link').html(`
                <label>Link</label>
                <input type="text" name="link" required class="form-control">
                <hr>
                
                <div id="new">
                <div class="newcreate">
                <div class="row">
                    <div class="col-11">
                        <label>Bước `+count+`</label>
                        <input type="text" required name="step[]" class="form-control">
                    </div>
                    <div class="col-1">
                        <a href="javascript:void(0)" style="position: relative;top:40%" class="plus-step"><i class="fa fa-3x fa-plus-circle"></i></a>
                    </div>
                </div>
                <hr>
                </div>
            </div>
            `);
            $('.plus-step').click(function(){
                ++count;
                $('#new').append(`
                <div class="newcreate">
                <div class="row">
                <div class="col-11">
                    <label>Bước `+count+`</label>
                    <input type="text" required name="step[]" class="form-control">
                </div>
                <div class="col-1">
                    <a href="javascript:void(0)" style="position: relative;top:40%" class="minus-step"><i class="fa fa-3x fa-minus-circle"></i></a>
                </div>
            </div>
            <hr>
            </div>
                `);
                $('.minus-step').click(function(){
                    --count;
                    if(count<1){
                        count=1;
                    }
                    $(this).closest('.newcreate').remove();
                })
            });
        }else{
            $('#link').html(``);
        }
    })
    </script>
@endpush --}}
