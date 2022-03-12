<div class="search-order">
    <form autocomplete="off" action="return:javascript:;">
        <div class="row">
            {* <div class="col-md-6 col-sm-12 col-xs-12">
            <label class="label_name">Loại khách sạn</label>
            <select id="search_sl_category_hotel" class="choose_cate form-control" >
                {foreach from=$lCategory item=item}
                    <option value="{$item.category_id}">{$item.name}</option>
                {/foreach}
            </select>
            </div> *}
            <div class="col-md-6 col-sm-12 col-xs-12">
                <label class="label_name">Loại khách sạn</label>
                <select id="search_sl_status" class="choose_cate form-control" >
                    <option value="">Chọn khách sạn</option>
                    <option value="0">Chưa xử lý</option>
                    <option value="1">Đã xử lý</option>    
                    {* {foreach from=$filterByHotel item=item}
                        <option value="{$item.hotel_id}">{$item.hotel_name}</option>
                    {/foreach} *}
                </select>
            </div>
            
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <label class="name">Hoặc lọc theo</label>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <input id="from" type="text" name="" placeholder="Từ ngày">
                        <img src="{$domain}/public/images/date.png" width="30" class="icon-date">
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <input id="to" type="text" name="" placeholder="Đến ngày">
                        <img src="{$domain}/public/images/date.png" width="30" class="icon-date">
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-4">
                {if $str_gid == 1 || $str_permission|strpos:":staffsave:" !== false }
                <span class="add_real code_real">Đặt phòng <img src="{$domain}/public/images/add_user.png" width="24"></span>
                {/if}
            </div>
        </div>
   </form>
</div>
<div class="content-pr bg-white">
    <div class="wrap-table-detail">
        <!--BEGIN main infomation-->
        <div class="table-responsive table-detail table-0-15">
            <table class="table table-bg-no">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Phòng</th>
                        <th>Giá phòng</th>
                        <th>Trạng thái đơn</th>
                        <th>Thanh toán</th>
                        <th>Ngày nhận phòng</th>
                        <th>Ngày trả phòng</th>
                        <th>Tổng</th>
                        <th width="112">@</th>
                    </tr>
                </thead>
                <tbody id="tpl_list_bookings">
                   
                </tbody>
            </table>
        </div>

        <div class="infomation_table infomation_code">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <div class="row">
               
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="label_name">Tên khách hàng</label>
                    <div class="input_name">
                        <input id="customer_name" placeholder="" class="form-control" type="text" value="">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Cmnd</label>
                    <div class="input_name">
                        <input id="cmnd" class="form-control" type="text" name="" value="">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="label_name">Sđt</label>
                    <div class="input_name">
                        <input id="phone_number" placeholder="" class="form-control"type="text" value="">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="label_name">Email</label>
                    <div class="input_name">
                        <input id="email" placeholder="" class="form-control"type="email" value="">
                    </div>
                </div>



                {* <div class="col-md-6 col-sm-6 col-xs-12" >
                    <div class="col-md-6">
                        <span>Ngày nhận phòng</span>    
                    </div>
                    
                    <div class="col-md-6">
                        <input id="date_check_in" type="text" name="" placeholder="Ngày nhận">
                        <img src="{$domain}/public/images/date.png" width="30" class="icon-date">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12" >
                    <div class="col-md-6">
                        <span>Ngày trả phòng</span>    
                    </div>
                    
                    <div class="col-md-6">
                        <input id="date_check_out" type="text" name="" placeholder="Ngày nhận">
                        <img src="{$domain}/public/images/date.png" width="30" class="icon-date">
                    </div>
                </div> *}


                <div class="col-md-3 col-sm-6 col-xs-12">
                    {* <label class="label_name">Chọn phòng</label> *}
                    <div class="input_name">
                        <button id="btn-show-room" >Chọn phòng</button>
                        {* <input id="email" placeholder="" class="form-control"type="email" value=""> *}
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Chọn khách sạn</label>
                    <select id="booking_sl_hotel" class="choose_cate form-control" >
                        {foreach from=$lHotel item=item}
                            <option value="{$item.hotel_id}">{$item.hotel_name}</option>
                        {/foreach}
                    </select>
                </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
            <label class="label_name">Trạng thái đơn</label>
            <select id="booking_sl_status_form" class="choose_cate form-control" >
                {foreach from=$lBookingStatus item=item}
                    <option class="" value="{$item.booking_status_id}">{$item.title}</option>    
                {/foreach}
            </select>
        </div>
            <div id="lst_input_room"></div>
            {* <div class="col-md-6 col-sm-6 col-xs-12">
                <label class="label_name">Tổng tiền</label>
                <div class="input_name">
                    <input id="total" readonly placeholder="" class="form-control"type="text" value="">
                </div>
            </div> *}
            {* <div class="col-md-6 col-sm-6 col-xs-12">
                <label class="label_name">Chọn thời gian lấy phòng</label>
                <div class="input_name">
                    <input id="date_get_room" placeholder="" class="form-control"type="datetime-local" value="">
                </div>
            </div> *}
        
        {* <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="from" type="text" name="" placeholder="Từ ngày">
            <img src="{$domain}/public/images/date.png" width="30" class="icon-date">
        </div> *}


        </div>
        
        <div class="text-right">
            <button class="btn btn-close-infomation_code cancel">Huỷ</button>
            <button id="btn_create_booking" class="btn">Lưu</button>
        </div>
    </div>

    
        <div class="rooms_table">
            <div class="row">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <label class="name">Chọn ngày nhận và ngày trả phòng</label>
                </div>
                <div class="col-md-2 col-sm-6 col-xs-6">
                    <input id="date_check_in" type="text" name="" placeholder="Từ ngày">
                    <img src="{$domain}/public/images/date.png" width="30" class="icon-date">
                </div>
                <div class="col-md-2 col-sm-6 col-xs-6">
                    <input id="date_check_out" type="text" name="" placeholder="Đến ngày">
                    <img src="{$domain}/public/images/date.png" width="30" class="icon-date">
                </div>
                
                <div class="col-md-1 col-sm-6 col-xs-6">
                    <select id="slBed" class="choose_cate form-control" >
                        <option class="" value="">Chọn giường</option>
                        <option class="" value="0">Giường đơn</option>
                        <option class="" value="1">Giường đôi</option>
                    </select>
                </div>
                <div class="col-md-1 col-sm-6 col-xs-6">
                    <button id="btn_filter">Lọc</button>
                </div>
            </div>
            <div class="row " id="lst_room_empty">
                        {* <h2 id="alert_fill_condition" class="">Vui lòng nhập thông tin để lọc phòng !</h2> *}
                {* <div class="col-md-3 col-sm-6 col-xs-12">
                    <div id="room_id" aria-disabled="true" value="" class="room-card room_empty">
                        <h3>A02</h3>
                        <button> chọn phòng</button>
                    </div>
                </div> *}
                {* {foreach from=$lstRoom item=item}
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div id="room_id" aria-disabled="true" value="{$item.room_id}" class="room-card room_empty">
                            <h3>{$item.room_number}</h3>
                            <h3>{$item.price}</h3>
                            <h4>{$item.status}</h4>
                        </div>
                    </div>
                {/foreach} *}
                {* <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="room-card room_full" aria-readonly="true">
                        <h3>A02</h3>
                        <h4>Hết phòng</h4>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="room-card room_full">
                        <h3>A02</h3>
                        <h4>Hết phòng</h4>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="room-card room_empty">
                        <h3>A02</h3>
                        <h4>Còn trống</h4>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="room-card room_full">
                        <h3>A02</h3>
                        <h4>Hết phòng</h4>
                    </div>
                </div> *}

            </div>
            <button class="btn-cancel-room-table">Hủy</button>
        </div>

        

        <div id="deleteBooking" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                        <h3>Thông báo</h3>
                        <p>Bạn có chắc muốn xóa đơn đặt phòng này <b id="staff_delete_noti"></b> không?</p>
                        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                        <button id="modal_delete_btn" class="btn">Đồng ý</button>
                    </div>
                </div>
            </div>
        </div>

        
        <div id="cancelBooking" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                        <h3>Thông báo</h3>
                        <p>Bạn có chắc muốn hủy đơn đặt phòng này <b id="staff_delete_noti"></b> không?</p>
                        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                        <button id="modal_cancel_btn" class="btn">Đồng ý</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>