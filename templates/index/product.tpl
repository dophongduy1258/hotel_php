
<ul class="nav nav-tabs nav-storing">
    <li id="tab_list_real" class="active"><a data-toggle="tab" href="#list_real">Danh sách BĐS</a></li>
    {if $str_gid == 1 || $str_permission|strpos:":productprovince:" !== false }
    <li id="tab_category_real"><a data-toggle="tab" href="#category_real">Danh mục BĐS</a></li>
    {/if}
</ul>
<div class="content-pr bg-white">
    <div class="tab-content">
        
        <div id="category_real" class="tab-pane  fade">
            <h2 class="title-cate">Danh mục</h2>
            <div class="category_real">

                {foreach from=$lProvince item=foo}
                <div id="list-province-{$foo.id}" class="item">
                    <div class="wrap-title">
                        <div class="title">
                            <input class="province-name" province-id="{$foo.id}" id="province-{$foo.id}" type="text" name="" value="{$foo.name}" title="{$foo.name}">
                            <span class="down"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                            <span class="up"><i class="fa fa-angle-up" aria-hidden="true"></i></span>
                        </div>
                        <img class="province-delete" province-id="{$foo.id}" src="{$domain}/public/images/delete.png" alt="" width="24" >
                    </div>
                    <ul class="sub">
                        {foreach from=$foo.lCity item=item}
                        <li id="list-city-{$item.id}">
                            <input id="city-name-{$item.id}" city-id="{$item.id}" class="city-name" type="text" name="" value="{$item.name}" title="{$item.name}">
                            <img class="city-delete" city-id="{$item.id}" src="{$domain}/public/images/delete.png" alt="" width="24">
                        </li>
                        {/foreach}
                       
                        <li id="list-city-add-province-{$foo.id}"><input id="city-add-province-{$foo.id}" province-id="{$foo.id}" class="city-add-province" placeholder="Thêm quận/ huyện" type="text" name="" value=""><img class="city-add" province-id="{$foo.id}" src="{$domain}/public/images/done.png" alt="" width="24"></li>
                    </ul>
                </div>
                {/foreach}

                <div id="province-item-add" class="item">
                    <div class="wrap-title">
                        <div class="title">
                            <input id="add-new-province" type="text" placeholder="Thêm tỉnh/ thành" name="" value="">
                        </div>
                        <img id="save-new-province" src="{$domain}/public/images/done.png" alt="" width="24">
                    </div>
                </div>
            </div>

            <div id="deleteProvince" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                            <h3>Thông báo</h3>
                            <p>Bạn có chắc xoá <b id="modal_province_delete_name"></b> không?</p>
                            <p>Lưu ý: Các quận/ huyện sẽ bị xoá theo</p>
                            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                            <button id="btn_province_delete" class="btn">Đồng ý</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="deleteCity" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                            <h3>Thông báo</h3>
                            <p>Bạn có chắc xoá <b id="modal_city_delete_name"></b> không?</p>
                            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                            <button id="btn_city_delete" class="btn">Đồng ý</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div id="list_real" class="wrap-table-detail active tab-pane fade in">
            <div id="search_order" class="search-order">
                <form autocomplete="off" action="return:javascript:;">
                    <div class="row">
                        <div class="col-md-4 col-sm-12 col-xs-12">
                            <input id="txt_searching" type="text" name="" placeholder="Tìm theo tên/ mã BĐS" class="hasDatepicker">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 nopadding">
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select id="filter_province">
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select id="filter_city">
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <select id="filter_status">
                                    <option value="">Tất cả BĐS</option>
                                    <option value="0">BĐS chưa bán</option>
                                    <option value="1">BĐS đã bán</option>
                                </select>
                            </div>
                        </div>
                        {if $str_gid == 1 || $str_permission|strpos:":productadd:" !== false }
                        <div class="col-md-2 col-sm-6 col-xs-4">
                            <span id="btn_add_real" class="add_real code_real">Thêm BĐS <img src="{$domain}/public/images/add.png" width="24"></span>
                        </div>
                        {/if}
                    </div>
                </form>
            </div>

            <div id="table_detail" class="table-responsive table-detail table-0-15">
                <table class="table table-bg-no">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th style="min-width:110px">Mã BĐS</th>
                            <th>Tên BĐS</th>
                            <th style="min-width:115px;">Danh mục</th>
                            <th>Giá vốn</th>
                            <th>Chi phí</th>
                            <th>Giá bán</th>
                            <th>Trạng thái</th>
                            <th width="110">@</th>
                        </tr>
                    </thead>
                    <tbody id="tpl_list_real">
                        {* <tr>
                            <td>1</td>
                            <td class="code_real">QT005</td>
                            <td>Căn hộ 4 phòng ngủ Q5</td>
                            <td>
                                <span class="dt-span">Quận 5</span>
                                <select class="dt-select selectpicker">
                                    <option value="1">Quận 5</option>
                                    <optgroup label="ABC Test" data-subtext="optgroup subtext">
                                        <option value="1">Phường 12</option>
                                        <option value="1">Phường 15</option>
                                        <option value="1">Phường 18</option>
                                    </optgroup>
                                    <option>Gò Vấp</option>
                                    <option>Bình Thạnh</option>
                                </select>
                            </td>
                            <td>
                                <span class="dt-span">1,000,000,000</span>
                                <input type="text" name="" value="1,000,000,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">50,000,000</span>
                                <input type="text" name="" value="50,000,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">1,050,000,000</span>
                                <input type="text" name="" value="1,050,000,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">Đang chờ bán</span>
                                <select class="dt-select">
                                    <option>Đang chờ bán</option>
                                    <option>Đã bán</option>
                                </select>
                            </td>
                            <td>
                                <img src="{$domain}/public/images/edit.png" alt="" width="24" class="img_edit">
                                <img src="{$domain}/public/images/done.png" alt="" width="24" class="img_done">
                                <img src="{$domain}/public/images/delete.png" alt="" width="24" class="img_delete">
                            </td>
                        </tr> *}
                        {* <tr>
                            <td>1</td>
                            <td class="code_real">BC005</td>
                            <td>Căn hộ 4 phòng ngủ Q5</td>
                            <td>
                                <span class="dt-span">Quận 5</span>
                                <select class="dt-select selectpicker">
                                    <option value="1">Quận 5</option>
                                    <optgroup label="ABC Test" data-subtext="optgroup subtext">
                                        <option value="1">Phường 12</option>
                                        <option value="1">Phường 15</option>
                                        <option value="1">Phường 18</option>
                                    </optgroup>
                                    <option>Gò Vấp</option>
                                    <option>Bình Thạnh</option>
                                </select>
                            </td>
                            <td>
                                <span class="dt-span">1,000,000,000</span>
                                <input type="text" name="" value="1,000,000,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">50,000,000</span>
                                <input type="text" name="" value="50,000,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">1,050,000,000</span>
                                <input type="text" name="" value="1,050,000,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">Đang chờ bán</span>
                                <select class="dt-select">
                                    <option>Đang chờ bán</option>
                                    <option>Đã bán</option>
                                </select>
                            </td>
                            <td>
                                <img src="{$domain}/public/images/edit.png" alt="" width="24" class="img_edit">
                                <img src="{$domain}/public/images/done.png" alt="" width="24" class="img_done">
                                <img src="{$domain}/public/images/delete.png" alt="" width="24" class="img_delete">
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td class="code_real">Q1001</td>
                            <td>Căn hộ 4 phòng ngủ Q5</td>
                            <td>
                                <span class="dt-span">Quận 5</span>
                                <select class="dt-select selectpicker">
                                    <option value="1">Quận 5</option>
                                    <optgroup label="ABC Test" data-subtext="optgroup subtext">
                                        <option value="1">Phường 12</option>
                                        <option value="1">Phường 15</option>
                                        <option value="1">Phường 18</option>
                                    </optgroup>
                                    <option>Gò Vấp</option>
                                    <option>Bình Thạnh</option>
                                </select>
                            </td>
                            <td>
                                <span class="dt-span">1,000,000,000</span>
                                <input type="text" name="" value="1,000,000,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">50,000,000</span>
                                <input type="text" name="" value="50,000,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">1,050,000,000</span>
                                <input type="text" name="" value="1,050,000,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">Đang chờ bán</span>
                                <select class="dt-select">
                                    <option>Đang chờ bán</option>
                                    <option>Đã bán</option>
                                </select>
                            </td>
                            <td>
                                <img src="{$domain}/public/images/edit.png" alt="" width="24" class="img_edit">
                                <img src="{$domain}/public/images/done.png" alt="" width="24" class="img_done">
                                <img src="{$domain}/public/images/delete.png" alt="" width="24" class="img_delete">
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td class="code_real">BT004</td>
                            <td>Căn hộ 4 phòng ngủ Q5</td>
                            <td>
                                <span class="dt-span">Quận 5</span>
                                <select class="dt-select selectpicker">
                                    <option value="1">Quận 5</option>
                                    <optgroup label="ABC Test" data-subtext="optgroup subtext">
                                        <option value="1">Phường 12</option>
                                        <option value="1">Phường 15</option>
                                        <option value="1">Phường 18</option>
                                    </optgroup>
                                    <option>Gò Vấp</option>
                                    <option>Bình Thạnh</option>
                                </select>
                            </td>
                            <td>
                                <span class="dt-span">1,000,000,000</span>
                                <input type="text" name="" value="1,000,000,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">50,000,000</span>
                                <input type="text" name="" value="50,000,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">1,050,000,000</span>
                                <input type="text" name="" value="1,050,000,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">Đang chờ bán</span>
                                <select class="dt-select">
                                    <option>Đang chờ bán</option>
                                    <option>Đã bán</option>
                                </select>
                            </td>
                            <td>
                                <img src="{$domain}/public/images/edit.png" alt="" width="24" class="img_edit">
                                <img src="{$domain}/public/images/done.png" alt="" width="24" class="img_done">
                                <img src="{$domain}/public/images/delete.png" alt="" width="24" class="img_delete">
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td class="code_real">GV004</td>
                            <td>Căn hộ 4 phòng ngủ Q5</td>
                            <td>
                                <span class="dt-span">Quận 5</span>
                                <select class="dt-select selectpicker">
                                    <option value="1">Quận 5</option>
                                    <optgroup label="ABC Test" data-subtext="optgroup subtext">
                                        <option value="1">Phường 12</option>
                                        <option value="1">Phường 15</option>
                                        <option value="1">Phường 18</option>
                                    </optgroup>
                                    <option>Gò Vấp</option>
                                    <option>Bình Thạnh</option>
                                </select>
                            </td>
                            <td>
                                <span class="dt-span">1,000,000,000</span>
                                <input type="text" name="" value="1,000,000,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">50,000,000</span>
                                <input type="text" name="" value="50,000,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">1,050,000,000</span>
                                <input type="text" name="" value="1,050,000,000" class="dt-select">
                            </td>
                            <td>
                                <span class="dt-span">Đang chờ bán</span>
                                <select class="dt-select">
                                    <option>Đang chờ bán</option>
                                    <option>Đã bán</option>
                                </select>
                            </td>
                            <td>
                                <img src="{$domain}/public/images/edit.png" alt="" width="24" class="img_edit">
                                <img src="{$domain}/public/images/done.png" alt="" width="24" class="img_done">
                                <img src="{$domain}/public/images/delete.png" alt="" width="24" class="img_delete">
                            </td>
                        </tr> *}
                    </tbody>
                </table>
            </div>

            <div id="table_detail_product" class="infomation_table infomation_code">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Mã Bất động sản</label>
                        <div class="input_name">
                            <input id="inp_code" class="form-control" type="text" name="" value="">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="label_name">Tiêu đề</label>
                        <div class="input_name">
                            <input  id="inp_title" placeholder="" class="form-control" type="text" value="">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Danh mục</label>
                        <select id="sl_city" class="choose_cate selectpicker show-tick form-control">
                            {* <option value="1">Quận 7</option>
                            <optgroup label="ABC Test" data-subtext="optgroup subtext">
                                <option value="1">Test Sub</option>
                            </optgroup> *}
                        </select> 
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Số suất chào bán</label>
                        <div class="input_name">
                            <input id="inp_slots_total" class="form-control number-format" type="text" name="" value="">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Giá trị 1 suất</label>
                        <div class="input_name">
                            <input id="inp_price" class="form-control number-format" type="text" name="" value="">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Số suất đã bán</label>
                        <div class="input_name">
                            <input id="inp_slots_sold" class="form-control number-format" type="text" name="" value="">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Trạng thái</label>
                        <div class="input_name">
                            <select id="sl_status" class="choose_cate form-control">
                                <option value="0">Đang chờ bán</option>
                                <option value="1">Đã bán xong</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Giá vốn</label>
                        <div class="input_name">
                            <input id="inp_root_price" disabled class="form-control number-format" type="text" name="" value="">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Giá bán ra</label>
                        <div class="input_name">
                            <input id="inp_price_sold" class="form-control number-format" type="text" name="" value="">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Tài khoản nhận tiền</label>
                        <div class="input_name">
                            <select id="inp_receive_fund_account" class="choose_cate form-control">
                                {$opt_build_code}
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12 hide">
                        <label class="label_name">&nbsp;</label>
                        <div class="input_name text-center">
                            <label class="field_check">
                                <input fees-id="1" name="1withdraw" id="inp_is_hidden" class="ace fees-by-script fees-setting" checked="" type="checkbox">
                                <span class="lbl"></span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="clear"></div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <label class="label_name">Chi phí</label>
                        <div class="input_name">
                            <input id="inp_fee_total" disabled class="form-control number-format" type="text" name="" value="">
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-12 col-xs-12">
                        <div class="row hide">
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <label class="label_name_1">Trong đó:</label>
                            </div>
                            <div class="col-md-2 col-sm-5 col-xs-12">
                                <label class="label_name">Phí trước bạ</label>
                                <div class="input_name">
                                    <input id="fee_detail_1" class="form-control number-format fee-fields" label="Phí trước bạ" type="text" name="" value="">
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-5 col-xs-12">
                                <label class="label_name">Luật sư</label>
                                <div class="input_name">
                                    <input id="fee_detail_2" class="form-control number-format fee-fields" label="Luật sư" type="text" name="" value="">
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12 show-991"></div>
                            <div class="col-md-2 col-sm-5 col-xs-12">
                                <label class="label_name">Thuế đất</label>
                                <div class="input_name">
                                    <input id="fee_detail_3" class="form-control number-format fee-fields" label="Thuế đất" type="text" name="" value="">
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-5 col-xs-12">
                                <label class="label_name">Môi giới</label>
                                <div class="input_name">
                                    <input id="fee_detail_4" class="form-control number-format fee-fields" label="Môi giới" type="text" name="" value="">
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-5 col-xs-12">
                                <label class="label_name">Chi phí khác</label>
                                <div class="input_name">
                                    <input id="fee_detail_5" class="form-control number-format fee-fields" label="Chi phí khác" type="text" name="" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <label class="label_name_1 label_append" style="margin-top: 16px;cursor: pointer;">Thêm chi phí <img src="{$domain}/public/images/add.png" width="24" style="margin-left: 5px;"></label>
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-12">
                                <div class="append_cost">
                                    <div class='row'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label class="label_name">Mô tả</label>
                        <div class="input_name">
                            <textarea id="editor"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="row"><div class="col-md-12"><label class="label_name">Hình ảnh sản phẩm</label></div></div>
                    <div class="avatar_thumbs create-product row">
                        <a id="hold_img_show" class="col-md-2"><img class="img-responsive" src="{$domain}/public/images/plus-sign.png" style="opacity:0.3;cursor:pointer;" ></a>
                        {* <a class="col-md-2 img"><img src="{$domain}/public/images/product.jpg" class="img-responsive img"><i class="delete">x</i></a> *}
                    </div>
                    <input class="hide" hide id="file_uploading" type="file" name="files" value="" accept="image/x-png,image/gif,image/jpeg" />
                </div>
                <div class="text-right"><button class="btn btn-close-infomation_code cancel">Huỷ</button><button id="btn_modify_product" class="btn">Lưu</button></div>
            </div>

            <!--LIST INVESTORs in product-->
            <div id="table_list_investor" class="infomation_table infomation_investors table_investment">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
                <div class="row">
                    <div class="col-md-10 col-sm-9 col-xs-12">
                        <b style="padding-top: 1px;display: inline-block;font-weight: 400;margin-bottom: 20px;color: #666;font-size: 18px;" id="tpl_product_name" class="tpl_product_name">Bất động sản ABC</b>
                        {if $str_gid == 1 || $str_permission|strpos:":productROI:" !== false }
                        <a id="btn_roi" href="javascript:;" class="btn btn-success btn-roi">Chia lãi</a>
                        {/if}
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-12">
                         {if $str_gid == 1 || $str_permission|strpos:":productproduct_history:" !== false }
                        <span id="add_export_buy" class="add_real code_real">Tạo xuất mua <img src="{$domain}/public/images/add.png" width="24"></span>
                        {/if}
                    </div>
                    <div class="nopadding">
                        <table class="table table-bg-no">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nhà đầu tư</th>
                                    <th>Ngày mua</th>
                                    <th>Đã mua(suất)</th>
                                    <th>Giá trị</th>
                                    <th>Lợi nhuận</th>
                                    <th>Tiền phải trả</th>
                                    <th width="100">@</th>
                                </tr>
                            </thead>
                            <tbody id="tpl_list_investor">
                                {* <tr>
                                    <td>1</td>
                                    <td>Lê Ngọc Huân</td>
                                    <td>
                                        10/10/2018
                                    </td>
                                    <td>
                                        <span class="dt-span">5</span>
                                    </td>
                                    <td>
                                        <span class="dt-span">50,000,000</span>
                                    </td>
                                    <td>
                                        13.033,300
                                    </td>
                                    <td>
                                        13.033,300
                                    </td>
                                    <td>
                                        <img src="{$domain}/public/images/edit.png" alt="" width="24" class="img_edit_investment">
                                        <img src="{$domain}/public/images/done.png" alt="" style="opacity:0.2;" width="24" class="img_done_investment hide">
                                        <img src="{$domain}/public/images/delete.png" alt="" style="opacity:0.2;" width="24" class="img_delete_investment">
                                    </td>
                                </tr> *}
                            </body>
                        </table>
                        <div class="text-right"><button class="btn btn-close-infomation_investors cancel">OK</button></div>
                    </div>
                    
                </div>
            </div>

            <!--BEGIN Refund or add product transaction bought-->
            <div id="table_refund" class="col-sm-12 col-xs-12 infomation_table table_investment_edit" style='display: none;'>
                <i class="fa fa-angle-left" aria-hidden="true"></i>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <b class="tpl_product_name" style="padding-top: 1px;display: inline-block;font-weight: 400;margin-bottom: 20px;color: #666;font-size: 18px;">-</b>
                        <p id="tpl_refund_holder"><b style="padding-top: 0px;display: inline-block;font-weight: 400;margin-bottom: 0px;color: #73C59F;font-size: 18px;text-transform: uppercase;">Refund</b></p>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <label class="label_name">Nhà đầu tư</label>
                        <div class="input_name">
                            <input id="inp_product_history_name" class="form-control" type="text" name="" value="Nguyễn Thành Tân">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <label class="label_name">Số xuất đã mua</label>
                        <div class="input_name">
                            <input disabled id="inp_product_history_bought" class="form-control" type="text" name="" value="50">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <label class="label_name">Giá trị</label>
                        <div class="input_name">
                            <input disabled id="inp_product_history_bought_value" placeholder="" class="form-control" type="text" value="5.000.000">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <label class="label_name">Số dư (VNĐ)</label>
                        <div class="input_name">
                            <input disabled id="inp_product_history_balance" class="form-control" type="text" name="" value="90.000.000">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <label id="inp_product_history_amount_label" class="label_name">Số xuất muốn Refund</label>
                        <div class="input_name">
                            <input id="inp_product_history_amount" class="form-control" type="text" name="" value="5">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <label class="label_name">Tương đương (VNĐ)</label>
                        <div class="input_name">
                            <input disabled id="inp_product_history_value" class="form-control" type="text" name="" value="25.000.000">
                        </div>
                    </div>
                    <div class="text-right"><button class="btn btn-close-investment_edit cancel">Huỷ</button><button id="btn_product_history_excute" class="btn">OK</button></div>
                </div>
            </div>
            <!--END Refund or add product transaction bought-->

            <div id="deleteProduct" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                            <h3>Thông báo</h3>
                            <p>Bạn có chắc xoá <b id="modal_product_delete_name"></b> không?</p>
                            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                            <button id="btn_product_delete" class="btn">Đồng ý</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="topProduct" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                            <h3>Thông báo</h3>
                            <p>Xác nhận đặt sản phẩm: <b id="modal_product_top_name"></b> lên đầu danh sách?</p>
                            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                            <button id="btn_product_top" class="btn">Đồng ý</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="cloneProduct" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                            <h3>Thông báo</h3>
                            <p>Xác nhận sao chép sản phẩm thành một sản phẩm mới:</p>
                            <p><b id="modal_product_clone_name"></b></p>
                            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                            <button id="btn_product_clone" class="btn">Đồng ý</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="hiddenProduct" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                            <h3>Thông báo</h3>
                            <p id="modal_product_hidden_msg">-</p>
                            <p><b id="modal_product_hidden_name"></b></p>
                            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                            <button id="btn_product_hidden" class="btn">Đồng ý</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="ROIProduct" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                            <h3>Xác nhận</h3>
                            <p>Vui lòng nhập mật khẩu xác nhận chia lãi cho bất động sản này</p>
                            <p><input id="ROI_password" class="form-control" value="" type="password" /> </p>
                            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                            <button id="btn_product_roi" class="btn">Chia lãi</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="deleteProductHistory" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                            <h3>Thông báo</h3>
                            <p>Bạn có chắc xoá <span id="modal_product_history_delete"></span> không?</p>
                            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                            <button id="btn_product_history_delete" class="btn">Đồng ý</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div class="clear"></div>
</div>

<link href="{$domain}/public/upload/upload_temp.css?{$version}" rel="stylesheet">
<script src="{$domain}/public/upload/uploadfunction.js?{$version}"></script>
<script src="{$domain}/public/upload/jquery.fileupload.js?"></script>
<script src="{$domain}/public/upload/jquery.iframe-transport.js?"></script>

<script src="{$domain}/public/ckeditor/ckeditor.js"></script>
<script src="{$domain}/public/ckeditor/samples/js/sample.js"></script>
<script>
    initSample();
</script>