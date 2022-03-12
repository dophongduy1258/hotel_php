<nav class="navbar navbar-static-top">
    <div class="pull-left report"><a title="{$title}">{$title}</a></div>
    <div class="menu-m">
        <img src="{$domain}/public/images/menu-m.png" class="icon-menu" alt="#" width="24">
        <a href="/"><img src="{$domain}/public/images/logo.png" class="img-responsive"></a>
        <div class="overlay-menu"></div>
    </div>
    <ul class="nav-admin">
        <li role="presentation" class="dropdown">
             <a href="#" class="dropdown-toggle profile-pic" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><img src="{$domain}/public/images/user_profile.png" alt="user-img" width="36" class="img-circle">&nbsp;&nbsp;<span>{$session.fullname}</span>&nbsp;&nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i></a>
            <ul class="dropdown-menu sub-menu">
                <li data-toggle="modal" data-target="#changePassword"><a href="javascript:;" ><img src="{$domain}/public/images/change_pw.png">Thay đổi mật khẩu</a>
                </li>
                <li><a href="{$domain}/logout.php"><img src="{$domain}/public/images/logout.png">Thoát</a></li>
            </ul>
        </li>
    </ul>
</nav>