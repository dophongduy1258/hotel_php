
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
                                    <option value="">Tất cả hình thức</option>
                                    {$opt_selling_type}
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
                            <th style="min-width:115px;">Tỉnh/ Thành</th>
                            <th>Giá bán</th>
                            <th>Diện tích</th>
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
                    </tbody>
                </table>
            </div>

            <div id="table_detail_product" class="infomation_table infomation_code">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
                <div class="row">
                <form autocomplete="off" action="return:javascript:;">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Mã Bất động sản</label>
                        <div class="input_name">
                            <input id="code" class="form-control" type="text" name="" value="">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="label_name">Tiêu đề</label>
                        <div class="input_name">
                            <input id="title" placeholder="" class="form-control" type="text" value="">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Danh mục</label>
                        <select id="city_id" class="choose_cate selectpicker show-tick form-control">
                            {* <option value="1">Quận 7</option>
                            <optgroup label="ABC Test" data-subtext="optgroup subtext">
                                <option value="1">Test Sub</option>
                            </optgroup> *}
                        </select> 
                    </div>
                     <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="label_name">Địa chỉ</label>
                        <div class="input_name">
                            <input id="address" class="form-control" type="text" name="" value="">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Hình thức</label>
                        <div class="input_name">
                            <select id="selling_type_root" class="choose_cate selectpicker show-tick form-control">
                                <option value="0">Phân loại</option>
                                {$opt_selling_type}
                        </select> 
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Loại</label>
                        <div class="input_name">
                            <select id="selling_type_id" class="choose_cate selectpicker show-tick form-control">
                                {$opt_selling_type_id}
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Dự án</label>
                        <div class="input_name">
                            <input id="project_name" class="form-control" type="text" name="" value="">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Diện tích</label>
                        <div class="input_name">
                            <input id="acreage" class="form-control number-format" type="text" name="" value="">
                        </div>
                    </div>
                     <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Hướng nhà</label>
                        <div class="input_name">
                            <select id="direction_house" class="choose_cate selectpicker show-tick form-control">
                                {$opt_selling_direction}
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Hướng ban công</label>
                        <div class="input_name">
                            <select id="direction_balcony" class="choose_cate selectpicker show-tick form-control">
                                {$opt_selling_direction}
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Giá bán</label>
                        <div class="input_name">
                            <input id="price" class="form-control number-format" type="text" name="" value="">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Đơn vị bán</label>
                        <div class="input_name">
                            <select id="selling_unit_id" class="choose_cate form-control">
                                {$opt_selling_unit_id}
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Số phòng ngủ</label>
                        <div class="input_name">
                            <input id="no_room" class="form-control number-format" type="text" name="" value="">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Số toilet</label>
                        <div class="input_name">
                            <input id="no_toilet" class="form-control number-format" type="text" name="" value="">
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Tên liên hệ</label>
                        <div class="input_name">
                            <input id="contact_name" class="form-control" type="text" name="" value="">
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Số điện thoại liên hệ</label>
                        <div class="input_name">
                            <input id="contact_mobile" class="form-control" type="text" name="" value="">
                        </div>
                    </div>
                    
                    <div class="clear"></div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label class="label_name">Mô tả</label>
                        <div class="input_name">
                            <textarea id="editor"></textarea>
                        </div>
                    </div>
                
                </form>
                </div>
                <div class="row">
                    <div class="row"><div class="col-md-12"><label class="label_name">Hình ảnh nhà đất</label></div></div>
                    <div class="avatar_thumbs create-product row">
                        <a id="hold_img_show" class="col-md-2"><img src="{$domain}/public/images/plus-sign.png" style="opacity:0.3;cursor:pointer;" class="img-responsive"></a>
                        {* <a class="col-md-2 img"><img src="{$domain}/public/images/product.jpg" class="img-responsive img"><i class="delete">x</i></a> *}
                    </div>
                    <input class="hide" hide id="file_uploading" type="file" name="files" value="" accept="image/x-png,image/gif,image/jpeg" />
                </div>
                <div class="text-right"><button class="btn btn-close-infomation_code cancel">Huỷ</button><button id="btn_modify_product" class="btn">Lưu</button></div>
            </div>

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