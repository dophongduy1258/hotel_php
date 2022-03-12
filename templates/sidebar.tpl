<div class="sidebar sidebar-1111">
    <div class="top-left-logo">
        <span class="click-menu tooger-menu pull-left"><img src="{$domain}/public/images/menu.png" class="img-responsive" alt="#" width="24"></span>
        <a href="{$domain}"><img src="{$domain}/public/images/logo-menu.png" class="img-responsive"></a>
    </div>
    <ul class="nav">
        {if $str_gid == 1 || $str_permission|strpos:":indexreport:" !== false }
        <li {if $m == 'index' && $act == 'home'}class="active"{/if}><a href="{$domain}/?act=home"><img src="{$domain}/public/images/icon_report.png" alt="#"><span>Trang chủ</span></a></li>
        {/if}
        {if $str_gid == 1 || $str_permission|strpos:":indexreport:" !== false }
        <li {if $m == 'index' && $act == 'hotel'}class="active"{/if}><a href="{$domain}/?act=hotel"><img src="{$domain}/public/images/icon_report.png" alt="#"><span>Khách sạn</span></a></li>
        {/if}
        {if $str_gid == 1 || $str_permission|strpos:":indexreport:" !== false }
        <li {if $m == 'index' && $act == 'category'}class="active"{/if}><a href="{$domain}/?act=category"><img src="{$domain}/public/images/icon_report.png" alt="#"><span>Loại khách sạn</span></a></li>
        {/if}
        {if $str_gid == 1 || $str_permission|strpos:":indexreport:" !== false }
        <li {if $m == 'index' && $act == 'room'}class="active"{/if}><a href="{$domain}/?act=room"><img src="{$domain}/public/images/icon_report.png" alt="#"><span>Quản lý phòng</span></a></li>
        {/if}
        
        {if $str_gid == 1 || $str_permission|strpos:":indexreport:" !== false }
        <li {if $m == 'index' && $act == 'booking'}class="active"{/if}><a href="{$domain}/?act=booking"><img src="{$domain}/public/images/icon_report.png" alt="#"><span>Quản lý đặt phòng</span></a></li>
        {/if}
        
        {if $str_gid == 1 || $str_permission|strpos:":indexreport:" !== false }
        <li {if $m == 'index' && $act == 'general_service'}class="active"{/if}><a href="{$domain}/?act=general_service"><img src="{$domain}/public/images/icon_report.png" alt="#"><span>Dịch vụ chung</span></a></li>
        {/if}
        {if $str_gid == 1 || $str_permission|strpos:":indexreport:" !== false }
        <li {if $m == 'index' && $act == 'service'}class="active"{/if}><a href="{$domain}/?act=service"><img src="{$domain}/public/images/icon_report.png" alt="#"><span>Dịch vụ </span></a></li>
        {/if}
        {if $str_gid == 1 || $str_permission|strpos:":indexreport:" !== false }
        <li {if $m == 'index' && $act == 'report'}class="active"{/if}><a href="{$domain}/?act=report"><img src="{$domain}/public/images/icon_report.png" alt="#"><span>Báo cáo</span></a></li>
        {/if}

        {if $str_gid == 1 || $str_permission|strpos:":indexproduct:" !== false }
        <li {if $m == 'index' && $act == 'product'}class="active"{/if}><a href="{$domain}/?act=product"><img src="{$domain}/public/images/icon_product.png" alt="#"><span>Quản lý sản phẩm</span></a></li>
        {/if}

        {* {if $str_gid == 1 || $str_permission|strpos:":indexinvestor:" !== false }
        <li {if $m == 'index' && $act == 'investor'}class="active"{/if}><a href="{$domain}/?act=investor"><img src="{$domain}/public/images/icon_investor.png" alt="#"><span>Quản lý nhà đầu tư</span></a></li>
        {/if} *}

        {if $str_gid == 1 || $str_permission|strpos:":indexstaff:" !== false }
        <li {if $m == 'index' && $act == 'staff'}class="active"{/if}><a href="{$domain}/?act=staff"><img src="{$domain}/public/images/icon_staff.png" alt="#"><span>Tài khoản quản trị</span></a></li>
        {/if}

        {if $str_gid == 1 || $str_permission|strpos:":transactionidx:" !== false }
        <li {if $m == 'index' && $act == 'transaction'}class="active"{/if}><a href="{$domain}/?act=transaction"><img src="{$domain}/public/images/transaction.png" alt="#"><span>Quản lý giao dịch</span></a></li>
        {/if}

        {* {if $str_gid == 1 || $str_permission|strpos:":transactionidx:" !== false }
        <li {if $m == 'index' && $act == 'transactiondetails'}class="active"{/if}><a href="{$domain}/?act=transactiondetails"><img src="{$domain}/public/images/transaction.png" alt="#"><span>Chi tiết  giao dịch</span></a></li>
        {/if} *}

        {* {if $str_gid == 1 || $str_permission|strpos:":depositidx:" !== false }
        <li {if $m == 'index' && $act == 'deposit'}class="active"{/if}><a href="{$domain}/?act=deposit"><img src="{$domain}/public/images/transaction.png" alt="#"><span>Quản lý cọc</span></a></li>
        {/if} *}

        {* {if $str_gid == 1 || $str_permission|strpos:":transferidx:" !== false }
        <li {if $m == 'index' && $act == 'transfer'}class="active"{/if}><a href="{$domain}/?act=transfer"><img src="{$domain}/public/images/transfer.png" alt="#"><span>Quản lý chuyển nhượng</span></a></li>
        {/if} *}

        {* {if $str_gid == 1 || $str_permission|strpos:":bank_changeidx:" !== false }
        <li {if $m == 'index' && $act == 'bank-change'}class="active"{/if}><a href="{$domain}/?act=bank-change"><img src="{$domain}/public/images/transfer.png" alt="#"><span>Thay đổi số dư ngân hàng</span></a></li>
        {/if} *}

        {if $setup.is_self_selling == 1 || $setup.is_self_selling_without_login == 1}
            {if $str_gid == 1 || $str_permission|strpos:":sellingidx:" !== false }
            <li {if $m == 'index' && $act == 'selling'}class="active"{/if}><a href="{$domain}/?act=selling"><img src="{$domain}/public/images/selling.png" alt="#"><span>Sản phẩm đăng bán</span></a></li>
            {/if}
        {/if}
        
        {if $str_gid == 1 || $str_permission|strpos:":indexstaff:" !== false }
        <li {if $m == 'index' && $act == 'listing'}class="active"{/if} class="hide"><a href="{$domain}/?act=listing"><img src="{$domain}/public/images/listing.png" alt="#"><span>Listing Management</span></a></li>
        {/if}

        {* {if $str_gid == 1 || $str_permission|strpos:":indexnotification:" !== false }
        <li {if $m == 'index' && $act == 'notification'}class="active"{/if}><a href="{$domain}/?act=notification"><img src="{$domain}/public/images/icon_notification.png" alt="#"><span>Thông báo</span></a></li>
        {/if} *}
        
        {* {if $str_gid == 1 || $str_permission|strpos:":indexbank:" !== false }
        <li {if $m == 'index' && $act == 'bank'}class="active"{/if}><a href="{$domain}/?act=bank"><img src="{$domain}/public/images/icon_bank.png" alt="#"><span>Danh sách ngân hàng</span></a></li>
        {/if} *}

        {* {if $str_gid == 1 || $str_permission|strpos:":indexapp-setting:" !== false }
        <li {if $m == 'index' && $act == 'app-setting'}class="active"{/if}><a href="{$domain}/?act=app-setting"><img src="{$domain}/public/images/icon_app_setting.png" alt="#"><span>Trang chủ APP</span></a></li>
        {/if} *}

        {if $str_gid == 1 || $str_permission|strpos:":indexsuggested:" !== false }
        <li {if $m == 'index' && $act == 'suggested'}class="active"{/if}><a href="{$domain}/?act=suggested"><img src="{$domain}/public/images/icon_suggest.png" alt="#"><span>Đề xuất BĐS</span></a></li>
        {/if}

        {if $str_gid == 1 || $str_permission|strpos:":indexmlm:" !== false }
        <li {if $m == 'index' && $act == 'mlm'}class="active"{/if}><a href="{$domain}/?act=mlm"><img src="{$domain}/public/images/icon_mlm.png" alt="#"><span>Quản lý hoa hồng</span></a></li>
        {/if}
        
        {* {if $str_gid == 1 || $str_permission|strpos:":indexsetting:" !== false }
        <li {if $m == 'index' && $act == 'setting'}class="active"{/if}><a href="{$domain}/?act=setting"><img src="{$domain}/public/images/icon_settings.png" alt="#"><span>Cài đặt</span></a></li>
        {/if} *}

    </ul>
</div>