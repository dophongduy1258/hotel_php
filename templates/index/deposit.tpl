
<div class="search-order">
    <form autocomplete="off" action="return:javascript:;">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <input id="txt_searching" type="text" name="" placeholder="Tìm kiếm theo tên nhà đầu tư/mã sản phẩm" class="">
                <i class="fa fa-search" aria-hidden="true"></i>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-4 pull-right">
                <span id="btn_add_investor" class="add_real hide code_real">Thêm NĐT <img src="{$domain}/public/images/add.png" width="24"></span>
            </div>
        </div>
    </form>
</div>
<div class="content-pr bg-white">
    <div class="wrap-table-detail">
        <div class="table-responsive table-detail table-0-15">
            <table class="table table-bg-no">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th>Ngày</th>
                        <th>Mã NĐT</th>
                        <th>Tên nhà đầu tư</th>
                        <th>Tên sản phẩm</th>
                        <th>Mức cọc/Mua</th>
                        <th>Ghi chú</th>
                        <th width="120px">@</th>
                    </tr>
                </thead>
                <tbody id="tpl_list">
                    <tr>
                        <td>1</td>
                        <td>
                            <span class="dt-span">-</span>
                        </td>
                        <td>
                            <span class="dt-span">-</span>
                        </td>
                        <td>
                            <span class="dt-span">-</span>
                        </td>
                        <td>-</td>
                        <td>-</td>
                        <td>
                            <img src="{$domain}/public/images/reset.png" alt="" width="24" class="img_reset" data-toggle="modal" data-target="#resetProfile">
                            <img src="{$domain}/public/images/edit.png" alt="" width="24" class="img_edit">
                            <img src="{$domain}/public/images/done.png" alt="" width="24" class="img_done">
                            <img src="{$domain}/public/images/delete.png" alt="" width="24" class="img_delete">
                        </td>
                    </tr>
                    {* <tr>
                        <td>1</td>
                        <td class="code_real">ĐT005</td>
                        <td>
                            <span class="dt-span">Tân Đẹp Trai Vãi</span>
                            <input type="text" name="" value="Nguyễn Thành Tân" class="dt-select">
                        </td>
                        <td>
                            <span class="dt-span">tannt2103@gmail.com</span>
                            <input type="text" name="" value="tannt2103@gmail.com" class="dt-select">
                        </td>
                        <td>
                            <span class="dt-span">0976674647</span>
                            <input type="text" name="" value="0976674647" class="dt-select">
                        </td>
                        <td>21/03/1989</td>
                        <td>
                            <img src="{$domain}/public/images/reset.png" alt="" width="24" class="img_reset" data-toggle="modal" data-target="#resetProfile">
                            <img src="{$domain}/public/images/edit.png" alt="" width="24" class="img_edit">
                            <img src="{$domain}/public/images/done.png" alt="" width="24" class="img_done">
                            <img src="{$domain}/public/images/delete.png" alt="" width="24" class="img_delete">
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td class="code_real">BĐ005</td>
                        <td>
                            <span class="dt-span">Tân Bá Đạo Vãi</span>
                            <input type="text" name="" value="Nguyễn Thành Tân" class="dt-select">
                        </td>
                        <td>
                            <span class="dt-span">tannt2103@gmail.com</span>
                            <input type="text" name="" value="tannt2103@gmail.com" class="dt-select">
                        </td>
                        <td>
                            <span class="dt-span">0976674647</span>
                            <input type="text" name="" value="0976674647" class="dt-select">
                        </td>
                        <td>21/03/1989</td>
                        <td>
                            <img src="{$domain}/public/images/reset.png" alt="" width="24" class="img_reset" data-toggle="modal" data-target="#resetProfile">
                            <img src="{$domain}/public/images/edit.png" alt="" width="24" class="img_edit">
                            <img src="{$domain}/public/images/done.png" alt="" width="24" class="img_done">
                            <img src="{$domain}/public/images/delete.png" alt="" width="24" class="img_delete">
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td class="code_real">QB005</td>
                        <td>
                            <span class="dt-span">Tân Quá Bá Vãi</span>
                            <input type="text" name="" value="Nguyễn Thành Tân" class="dt-select">
                        </td>
                        <td>
                            <span class="dt-span">tannt2103@gmail.com</span>
                            <input type="text" name="" value="tannt2103@gmail.com" class="dt-select">
                        </td>
                        <td>
                            <span class="dt-span">0976674647</span>
                            <input type="text" name="" value="0976674647" class="dt-select">
                        </td>
                        <td>21/03/1989</td>
                        <td>
                            <img src="{$domain}/public/images/reset.png" alt="" width="24" class="img_reset" data-toggle="modal" data-target="#resetProfile">
                            <img src="{$domain}/public/images/edit.png" alt="" width="24" class="img_edit">
                            <img src="{$domain}/public/images/done.png" alt="" width="24" class="img_done">
                            <img src="{$domain}/public/images/delete.png" alt="" width="24" class="img_delete">
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td class="code_real">ĐC005</td>
                        <td>
                            <span class="dt-span">Tân Đại Ca Vãi</span>
                            <input type="text" name="" value="Nguyễn Thành Tân" class="dt-select">
                        </td>
                        <td>
                            <span class="dt-span">tannt2103@gmail.com</span>
                            <input type="text" name="" value="tannt2103@gmail.com" class="dt-select">
                        </td>
                        <td>
                            <span class="dt-span">0976674647</span>
                            <input type="text" name="" value="0976674647" class="dt-select">
                        </td>
                        <td>21/03/1989</td>
                        <td>
                            <img src="{$domain}/public/images/reset.png" alt="" width="24" class="img_reset" data-toggle="modal" data-target="#resetProfile">
                            <img src="{$domain}/public/images/edit.png" alt="" width="24" class="img_edit">
                            <img src="{$domain}/public/images/done.png" alt="" width="24" class="img_done">
                            <img src="{$domain}/public/images/delete.png" alt="" width="24" class="img_delete">
                        </td>
                    </tr> *}
                </tbody>
            </table>
        </div>
        <div id="hd_page_html" class="col-lg-12 col-md-12 top10">
            <div id="page_html" class="col-lg-12 col-md-12 top10">
            </div>
            <input id="current_page" class="hidden" value="1" >
        </div>
    </div>
</div>

<div id="modal_done" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                <h3>Thông báo</h3>
                <p>Xác nhận hoàn tất xử lý giao dịch:  #<b class="txt_id">zzzz</b></p>
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                <button id="btn_confirm_done" class="btn">Hoàn tất</button>
            </div>
        </div>
    </div>
</div>

<div id="modal_refund" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                <h3>Thông báo</h3>
                <p>Xác nhận hoàn tiền cọc của giao dịch: #<b class="txt_id">zzzz</b></p>
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                <button id="btn_confirm_refund" class="btn">Hoàn tất</button>
            </div>
        </div>
    </div>
</div>

<div id="modal_delete" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                <h3>Thông báo</h3>
                <p>Xác nhận xóa giao dịch mà không thực hiện hoàn tiền: #<b class="txt_id">zzzz</b></p>
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                <button id="btn_confirm_delete" class="btn">Hoàn tất</button>
            </div>
        </div>
    </div>
</div>