<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">

    <a class="brand-logo" href="{{url('/dashboard')}}">
        <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        <h5 class="logo-text">Trang chủ quản trị</h5>
        <div class="close-btn"><i class="zmdi zmdi-close"></i></div>
    </a>

    <ul class="metismenu" id="menu">
        <li>
            <a class="has-arrow"  href="javascript:void();">
                <div class="parent-icon"><i class="zmdi zmdi-view-dashboard"></i></div>
                <div class="menu-title">Trang chủ</div>
            </a>
            <ul>
                <li><a href="{{ url('/users') }}"><i class="zmdi zmdi-dot-circle-alt"></i> Người dùng</a></li>
                <li><a href="{{ url('/award-every-day') }}"><i class="zmdi zmdi-dot-circle-alt"></i> Phần thưởng mỗi ngày</a></li>
                <li><a href="{{ url('/award-share') }}"><i class="zmdi zmdi-dot-circle-alt"></i> Phần thưởng giới thiệu</a></li>

            </ul>
        </li>



        <li>
            <a class="has-arrow" href="javascript:void();">
                <div class="parent-icon"> <i class='zmdi zmdi-card-travel'></i></div>
                <div class="menu-title">Nhiệm vụ</div>
            </a>
            <ul>
                <li><a href="{{ url('/tasks') }}"><i class="zmdi zmdi-dot-circle-alt"></i> Danh mục</a></li>
                <li><a href="{{ url('/create/task') }}"><i class="zmdi zmdi-dot-circle-alt"></i> Tạo</a></li>

            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:void();">
                <div class="parent-icon"> <i class='zmdi zmdi-layers'></i></div>
                <div class="menu-title">Ảnh bìa</div>
            </a>
            <ul>
                <li><a href="{{ url('/banners') }}"><i class="zmdi zmdi-dot-circle-alt"></i> Danh mục</a></li>

            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:void();">
                <div class="parent-icon"> <i class='zmdi zmdi-widgets'></i></div>
                <div class="menu-title">Quảng Cáo</div>
            </a>
            <ul>
                <li><a href="{{ url('/adss') }}"><i class="zmdi zmdi-dot-circle-alt"></i>Danh mục</a></li>
                <li><a href="{{ url('/create/ads') }}"><i class="zmdi zmdi-dot-circle-alt"></i> Tạo</a></li>
            </ul>
        </li>
        <li>
            <a href="{{url('/privacy-policy')}}">
                <div class="parent-icon"> <i class='zmdi zmdi-collection-folder-image'></i></div>
                <div class="menu-title">Chính Sách Bảo Mật</div>
            </a>
        </li>
        <li>
            <a href="{{url('/rules')}}">
                <div class="parent-icon"> <i class='zmdi zmdi-collection-folder-image'></i></div>
                <div class="menu-title">Điều Khoản Chính Sách</div>
            </a>
        </li>
        <li>
            <a href="{{url('/question')}}">
                <div class="parent-icon"> <i class='zmdi zmdi-collection-folder-image'></i></div>
                <div class="menu-title">Câu Hỏi</div>
            </a>
        </li>
        <li>
            <a href="{{url('/feedback')}}">
                <div class="parent-icon"> <i class='zmdi zmdi-collection-folder-image'></i></div>
                <div class="menu-title">Phản Hồi</div>
            </a>
        </li>
        <li>
            <a class="has-arrow" href="javascript:void();">
                <div class="parent-icon"> <i class='zmdi zmdi-widgets'></i></div>
                <div class="menu-title">Quản Lý Ads</div>
            </a>
            <ul>
                <li><a href="{{ url('/apps') }}"><i class="zmdi zmdi-dot-circle-alt"></i>Danh mục</a></li>
                <li><a href="{{ url('/create/app') }}"><i class="zmdi zmdi-dot-circle-alt"></i> Tạo</a></li>
            </ul>
        </li>
    </ul>

</div>
