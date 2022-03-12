<div class="overlay_newnoti"></div>
<div class="content-pr bg-white">
    <div class="wrap-table-detail">
        <div class="notification">
            {if $str_gid == 1 || $str_permission|strpos:":notificationsave:" !== false }
            <span class="icon_noti add_notification">Soạn thông báo <img src="{$domain}/public/images/notification.png" width="30"></span>
            {/if}
            <div class="row">
                <div class="col-md-5 col-sm-5 col-xs-12 notification-left">
                    <ul class="item" id="list_notification">
                        {* <li>
                            <div class="iframe">
                                <h3>Thông báo nhận lợi nhuận từ căn hộ Sunrice City Quận 7</h3>
                                <span class="date">12/10/2018</span>
                                <img src="{$domain}/public/images/delete.png" width="24" class="img_delete_noti" data-toggle="modal" data-target="#deleteNotification">
                            </div>
                        </li> *}
                    </ul>
                </div>
                <div class="col-md-7 col-sm-7 col-xs-12 notification-right">
                    <div class="content-noti" id="tpl_content">
                        {* <span class="date">10:00 AM 21/02/2018</span>
                        <h2 class="form"><span>Admin</span> admin@blockreal.vn</h2>
                        <h2 class="to"><span>To:</span> tannt2103@gmail.com;ndtabc@gmail.com;blockup@gmail.com</h2>
                        <h3 class="title">Thông báo về những điểm nhấn nổi bật về dự án Bất Động Sản từ những nhà đầu tư thiên thần</h3>
                        <div class="content">
                            <p>Kính chào Quý Nhà đầu tư,</p>
                            <p>Ban Quản trị dự án BLOCKREAL trân trọng thông báo chia lợi tức đợt I đã được thực hiện theo kế hoạch.</p>
                            <p>Thời gian trả lợi tức đợt I: từ <b>21/09/2018</b> đến <b>25/09/2018</b></p>
                            <p>Tỷ lệ lợi tức: <b>1 BRS = 50 VNDC</b></p>
                            <p>&nbsp;</p>
                            <p>Cảm ơn Quý Nhà đầu tư đã ủng hộ dự án BLOCKREAL trong thời gian qua và dự án đang được triển khai kinh doanh theo đúng kế hoạch phát triển.</p>
                            <p>Kính mời Quý vị kết nối với cộng đồng BLOCKREAL tại Facebook để cập nhật các thông tin sớm nhất và trao đổi cùng các Nhà điều hành về dự án BLOCKREAL.</p>
                            <p>Trân trọng, </p>
                            <p>BLOCKREAL</p>
                        </div> *}
                    </div>
                </div>
            </div>
        </div>

        <div class="addNotification">
            <span class="icon_noti send_notification">Send <img src="{$domain}/public/images/send.png" width="30"></span>
            <span class="close_noti">x</span>
            <div class="wrap-editor">
                <div class="input_name">
                    <label class="label_name">To:</label>
                    <input id="inp_to" class="form-control" type="text" name="" value="">
                    
                    <span class="add_contact">Add Contact @</span>
                    <div class="sub">
                        <span class="close_sub_addContact">Đóng</span>
                        <div class="search-order">
                            <input id="inp_searching" type="text" name="" placeholder="Tìm kiếm theo mã BĐS/user">
                            <button class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                        <div class="sub-left">
                            <ul class="nav nav-tabs">
                                <li id="tab_all_investors" class="active"><a data-toggle="tab" href="#all_investors">Tất cả nhà đầu tư</a></li>
                                <li id="tab_all_products" ><a data-toggle="tab" href="#code_real">Mã BĐS</a></li>
                            </ul>
                        </div>
                        <div class="sub-right tab-content">
                            <div id="all_investors" class="tab-pane active fade in">
                                <ul class="wrap_sub_all">
                                    <li>
                                        <label><input id="ck_all_investor" class="ace" type="checkbox"><span class="lbl"></span>Tất cả nhà đầu tư</label>
                                        <span class="down"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                                        <span class="up"><i class="fa fa-angle-up" aria-hidden="true"></i></span>
                                        <ul class="sub_all" id="list_investor_all">
                                            {* <li><label><input class="ace" type="checkbox"><span class="lbl"></span>tannt2103@gmail.com</label></li>
                                            <li><label><input class="ace" type="checkbox"><span class="lbl"></span>thanhtan@gmail.com</label></li>
                                            <li><label><input class="ace" type="checkbox"><span class="lbl"></span>tannguyen@gmail.com</label></li>
                                            <li><label><input class="ace" type="checkbox"><span class="lbl"></span>abc@gmail.com</label></li>
                                            <li><label><input class="ace" type="checkbox"><span class="lbl"></span>ndt@gmail.com</label></li> *}
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div id="code_real" class="tab-pane fade">
                                <ul class="wrap_sub_all" id="list_investor_by">
                                    {* <li>
                                        <label><input class="ace" type="checkbox"><span class="lbl"></span>GV005</label>
                                        <span class="down"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                                        <span class="up"><i class="fa fa-angle-up" aria-hidden="true"></i></span>
                                        <ul class="sub_all">
                                            <li><label><input class="ace" type="checkbox"><span class="lbl"></span>tannt2103@gmail.com</label></li>
                                            <li><label><input class="ace" type="checkbox"><span class="lbl"></span>thanhtan@gmail.com</label></li>
                                            <li><label><input class="ace" type="checkbox"><span class="lbl"></span>tannguyen@gmail.com</label></li>
                                            <li><label><input class="ace" type="checkbox"><span class="lbl"></span>abc@gmail.com</label></li>
                                            <li><label><input class="ace" type="checkbox"><span class="lbl"></span>ndt@gmail.com</label></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <label><input class="ace" type="checkbox"><span class="lbl"></span>BT001</label>
                                        <span class="down"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                                        <span class="up"><i class="fa fa-angle-up" aria-hidden="true"></i></span>
                                        <ul class="sub_all">
                                            <li><label><input class="ace" type="checkbox"><span class="lbl"></span>tannt2103@gmail.com</label></li>
                                            <li><label><input class="ace" type="checkbox"><span class="lbl"></span>thanhtan@gmail.com</label></li>
                                            <li><label><input class="ace" type="checkbox"><span class="lbl"></span>tannguyen@gmail.com</label></li>
                                            <li><label><input class="ace" type="checkbox"><span class="lbl"></span>abc@gmail.com</label></li>
                                            <li><label><input class="ace" type="checkbox"><span class="lbl"></span>ndt@gmail.com</label></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <label><input class="ace" type="checkbox"><span class="lbl"></span>TD001</label>
                                        <span class="down"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                                        <span class="up"><i class="fa fa-angle-up" aria-hidden="true"></i></span>
                                        <ul class="sub_all">
                                            <li><label><input class="ace" type="checkbox"><span class="lbl"></span>tannt2103@gmail.com</label></li>
                                            <li><label><input class="ace" type="checkbox"><span class="lbl"></span>thanhtan@gmail.com</label></li>
                                            <li><label><input class="ace" type="checkbox"><span class="lbl"></span>tannguyen@gmail.com</label></li>
                                            <li><label><input class="ace" type="checkbox"><span class="lbl"></span>abc@gmail.com</label></li>
                                            <li><label><input class="ace" type="checkbox"><span class="lbl"></span>ndt@gmail.com</label></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <label><input class="ace" type="checkbox"><span class="lbl"></span>BT001</label>
                                        <span class="down"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                                        <span class="up"><i class="fa fa-angle-up" aria-hidden="true"></i></span>
                                        <ul class="sub_all">
                                            <li><label><input class="ace" type="checkbox"><span class="lbl"></span>tannt2103@gmail.com</label></li>
                                            <li><label><input class="ace" type="checkbox"><span class="lbl"></span>thanhtan@gmail.com</label></li>
                                            <li><label><input class="ace" type="checkbox"><span class="lbl"></span>tannguyen@gmail.com</label></li>
                                            <li><label><input class="ace" type="checkbox"><span class="lbl"></span>abc@gmail.com</label></li>
                                            <li><label><input class="ace" type="checkbox"><span class="lbl"></span>ndt@gmail.com</label></li>
                                        </ul>
                                    </li> *}
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="input_name input_name_b">
                    <label class="label_name">Subject:</label>
                    <input id="inp_subject" class="form-control" type="text" name="" value="Thông báo nhận lợi nhuận từ căn hộ Sunrice City Quận 7">
                </div>
                <textarea id="editor" name="infomation" style="min-height: 200px;"></textarea>
            </div>
            <script src="{$domain}/public/ckeditor/ckeditor.js"></script>
            <script src="{$domain}/public/ckeditor/samples/js/sample.js"></script>
            <script>
                initSample();
            </script>
        </div>

        <div id="deleteNotification" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                        <h3>Thông báo</h3>
                        <p>Bạn có chắc xoá thông báo <b id="modal_subject">-</b> không?</p>
                        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                        <button id="btn_delete_notification" class="btn">Đồng ý</button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>