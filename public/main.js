$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.select-all').click(function(){
        if(this.checked==true){
            $('input[type="checkbox"]').prop('checked', true);
        }else{
            $('input[type="checkbox"]').prop('checked', false);
        }
    });
    $('.create-question').click(function(){
        $('#new-question').append(
            `<div class="newcreate">
                <div class="row">
                    <div class="col-11">
                        <label>Câu Trả Lời</label>
                        <input type="text" required name="answer[]" class="form-control">
                    </div>
                    <div class="col-1">
                        <a href="javascript:void(0)" style="position: relative;top:40%" class="minus-question"><i class="fa fa-3x fa-minus-circle"></i></a>
                    </div>
                </div>
                <hr>
            </div>`
        );
        $('.minus-question').click(function(){
            $(this).closest('.newcreate').remove();
        });
    });

    $('#value_password').keyup(function(){
        var password=$(this).val();
        $.ajax({
            url:'/check-password',
            type:"POST",
            data:{
                password:password
            },
            success:function(resp){
                if(resp['status']==1){
                    $('#check_password').html(`
                        <span style="color:green">Password Correct</span>
                    `);
                }else{
                    $('#check_password').html(`
                        <span style="color:red">Password Incorrect</span>
                    `);
                }
            },
            error:function(){
                alert('ERROR');
            }
        })
    });
    $('.status').click(function(){
        var text=$(this).text();
        var id=$(this).data('id');
        var name=$(this).data('name');
        $.ajax({
            url:'/change-status',
            type:'POST',
            data:{
                text:text,
                id:id,
                name:name
            },
            success:function(resp){
                if(resp['status']==0){
                    $('#status-'+id).html(
                        `<a style="color:red">Inactive</a>`
                    );
                }else{
                    $('#status-'+id).html(
                        `<a style="color:green">Active</a>`
                    );
                }
            },
            error:function(){
                alert('ERROR');
            }
        })
    });

    $('.select-link-question').change(function(){
        var value=$(this).val();
        // alert(value);
        count=1;
        if(value==0){
            // $('.grade').css('display', 'block');
            $('#link').html(`
                <label>Link</label>
                <input type="text" name="link" required class="form-control">
                <hr>
                <label>Bước 1</label>
                <input type="text" name="step[]" required value="Tìm kiếm và cài đặt" class="form-control">
                <hr>
                <label>Bước 2</label>
                <input type="text" name="step[]" required value="Chơi game trong vòng 10 ngày" class="form-control">
                <hr>
                <label>Tiêu đề hướng dẫn</label>
                <input type="text" name="title_game" required class="form-control">
                <hr>
                <label>Ảnh game cần tải</label>
                <input type="file" name="image_game" onchange="loadfile1(event)" class="form-control" required>
                <div id="preview1"></div>
                <hr>
                <div id="new">
                    <div class="newcreate">
                        <div class="row">
                            <div class="col-6">
                                <label>Mã `+count+`</label>
                                <input type="text" required name="code[]" class="form-control">
                            </div>
                            <div class="col-5">
                                <label>Mức điểm</label>
                                <input type="number" min="1" required name="point[]" class="form-control">
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
                <div class="col-6">
                    <label>Mã `+count+`</label>
                    <input type="text" required name="code[]" class="form-control">
                </div>
                <div class="col-5">
                                <label>Mức điểm</label>
                                <input type="number" required name="point[]" class="form-control">
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
    });
    $('.send-money').click(function(){
        var user_id=$(this).data('id');
        $.ajax({
            url:'get-money',
            type:'POST',
            data:{
                user_id:user_id
            },
            success:function(resp){
                if(resp['status']==1){
                    $('#user-'+user_id).html('<img src="loading.gif" width="50px" height="20px" />');
                    setTimeout(function () {
                        // $('#user-'+user_id).css('display', 'none');
                        $('#money-'+user_id).html('<center>'+resp['new_money']+"<span style='color: pink'> VNĐ</span></center>");
                        $('#user-'+user_id).html(
                            `Phê
                            Duyệt Tiền`
                        );
                    }, 3000);
                    // $('#user-'+user_id).css('display', 'show');
                }
            },error:function(error){
                alert(error);
            }
        })
    });
});
var loadfile = function (event) {
    $('#preview').html('');
    for(let i=0; i<event.target.files.length; ++i){
        var image = document.createElement('img');
        image.src = URL.createObjectURL(event.target.files[i]);
        image.width = "100";
        image.height="100";
        document.querySelector("#preview").appendChild(image);
    }
};
var loadfile1 = function (event) {
    $('#preview1').html('');
    for(let i=0; i<event.target.files.length; ++i){
        var image = document.createElement('img');
        image.src = URL.createObjectURL(event.target.files[i]);
        image.width = "100";
        image.height="100";
        document.querySelector("#preview1").appendChild(image);
    }
};
$(document).on("change", ".file_multi_video", function(evt) {
    var $source = $('#video_here');
    $source[0].src = URL.createObjectURL(this.files[0]);
    $source.parent()[0].load();
  });
  $(document).on("change", ".file_multi_video1", function(evt) {
    var $source = $('#video_here1');
    $source[0].src = URL.createObjectURL(this.files[0]);
    $source.parent()[0].load();
  });
