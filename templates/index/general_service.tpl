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
            <div class="col-md-2 col-sm-12 col-xs-12">
                <label class="label_name">Lọc</label>
                <select id="filter_by_time" class="choose_cate form-control" >
                    <option value="0">....</option>
                    <option value="1">Lịch sử đặt dịch vụ</option>  
                    <option value="2">Lịch đặt phòng hôm nay</option>     
                    {* {foreach from=$filterByHotel item=item}
                        <option value="{$item.hotel_id}">{$item.hotel_name}</option>
                    {/foreach} *}
                </select>
            </div>
            
            {* <div class="col-md-6 col-sm-12 col-xs-12">
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
            </div> *}
            <div class="col-md-3 col-sm-6 col-xs-4">
                <span class="add_real code_real">Đặt dịch vụ <img src="{$domain}/public/images/add_user.png" width="24"></span>
            </div>
        </div>
   </form>
</div>
<ul class="nav nav-tabs nav-storing storing4">
    
    <li id="tab_history_booked_service" class="active"><a data-toggle="tab" href="#history_booked_service">Lịch sử đặt dịch vụ</a></li>


    <li id="tab_room_booked_today"><a data-toggle="tab" href="#room_booked_today">Phòng có lịch đặt hôm nay</a></li>

    <li id="tab_reservation_room"><a data-toggle="tab" href="#reservation_room">Lịch các phòng được đặt trước</a></li>
    
</ul>
<div class="content-pr bg-white">
<div class="tab-content">
    <div id="history_booked_service" class="wrap-table-detail tab-pane active fade in">
        <!--BEGIN main infomation-->
        <div class="table-responsive table-detail table-0-15">
            <table class="table table-bg-no">
                <thead>
                    <tr>
                        <th>#</th>
                        {* <th>Mã đơn</th> *}
                        <th>Mã phiếu đặt phòng</th>
                        <th>Phòng</th>
                        <th>Tên khách hàng</th>
                        <th>SĐT</th>
                        {* <th>Dịch vụ</th> *}
                        {* <th>Giá</th> *}
                        {* <th>Số lượng</th> *}
                        {* <th>Trạng thái dịch vụ</th> *}
                        <th>Ngày đặt</th>
                        {* <th>Tổng tiền</th> *}
                        <th width="112">@</th>
                    </tr>
                </thead>
                <tbody id="tpl_history_booked_service">
                   
                </tbody>
            </table>
        </div>

        {* <div class="infomation_table infomation_code">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <div class="row">

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <label class="label_name">Phòng</label>
                    <div id="wrap_header_form">
                        <select id="slBookingId" class="choose_cate form-control" >
                            <option value="0">Chọn phòng</option>
                            {foreach from=$lRoomBooked item=item}
                                <option value="{$item.booking_id}">{$item.room_number}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div id="wrap_title_room">
                
                    </div>
                </div>

                
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="input_name">
                        <button id="btn-open-service" >Chọn dịch vụ</button>
                    </div>
                </div>

                <div class="col-md-12">
                    <table class="table table-bg-no">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên món</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Chú thích</th>
                                <th>Trạng thái dịch vụ</th>
                                <th>Thành tiền</th>
                                <th>Tổng</th>
                                <th width="112">@</th>
                            </tr>
                        </thead>
                        <tbody id="lst_service_booked">
                        </tbody>
                    </table>
                </div>



            </div>
                
            <div class="text-right">
                <button class="btn btn-close-infomation_code cancel">Huỷ</button>
                <button id="btn_create_booked_service" class="btn">Lưu</button>
            </div>
        </div> *}
    </div>
        {* =======================================   *}

        <div id="room_booked_today" class="tab-pane fade">
            <div class="table-responsive table-detail table-0-15">
                <table class="table table-bg-no">
                    <thead>
                        <tr>
                            <th>#</th>
                            {* <th>Mã đơn</th> *}
                            <th>Mã phiếu đặt phòng</th>
                            <th>Phòng</th>
                            <th>Tên khách hàng</th>
                            <th>SĐT</th>
                            <th>Email</th>
                            {* <th>Dịch vụ</th> *}
                            {* <th>Giá</th> *}
                            {* <th>Số lượng</th> *}
                            {* <th>Trạng thái dịch vụ</th> *}
                            <th>Ngày đặt</th>
                            {* <th>Tổng tiền</th> *}
                            <th width="112">@</th>
                        </tr>
                    </thead>
                    <tbody id="tpl_room_booked_today">
                    
                    </tbody>
                </table>
            </div>

            <div class="infomation_table infomation_room_booked_today">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
                <div class="row">
                    
                    {* <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Phòng</label>
                        <div id="wrap_header_form">
                            <select id="slBookingId" class="choose_cate form-control" >
                                <option value="0">Chọn phòng</option>
                                {foreach from=$lRoomBooked item=item}
                                    <option value="{$item.booking_id}">{$item.room_number}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div> *}
                
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="input_name">
                            <button id="btn-open-service" >Chọn dịch vụ</button>
                        </div>
                    </div>
                    <div id="wrap_booking_title"></div>
                    <div class="col-md-12">
                        <table class="table table-bg-no">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên món</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Chú thích</th>
                                    {* <th>Trạng thái dịch vụ</th> *}
                                    <th>Thành tiền</th>
                                    <th>Tổng</th>
                                    <th width="112">@</th>
                                </tr>
                            </thead>
                            <tbody id="lst_service_booked">
                            </tbody>
                        </table>
                    </div>
                </div>
        
                <div class="text-right">
                    <button class="btn btn-close-infomation_code cancel">Huỷ</button>
                    <button id="btn_create_booked_service" class="btn">Lưu</button>
                </div>
            </div>


            <div class="service_table">
                <div class="row " id="lst_service">
                    <div class="col-md-12 col-sm-6 col-xs-12">
                        <h3>Thức ăn</h3>
                        <ul>
                            {foreach from=$lService item=item}
                                {if $item.group == 1}
                                    <li style="margin-bottom:20px">
                                        <div class="row">
                                            <div class="col-md-2 col-sm-6 col-xs-12">{$item.name}</div>
                                            <div class="col-md-2 col-sm-6 col-xs-12">{$item.price}</div>
                                            <div class="col-md-2 col-sm-6 col-xs-12"><button class="btn_choose_service" name="{$item.name}" status='7' price="{$item.price}" note="" value="{$item.service_id}">Thêm</button></div>
                                        </div>
                                    </li>
                                    
                                {/if}
                            {/foreach}
                        </ul>
                    </div>
                    
                    <div class="col-md-12 col-sm-6 col-xs-12">
                        <h3>Thức uống</h3>
                        <ul>
                        
                        {foreach from=$lService item=item}
                            {if $item.group == 2}
                                <li style="margin-bottom:20px">
                                    <div class="row">
                                        <div class="col-md-2 col-sm-6 col-xs-12">{$item.name}</div>
                                        <div class="col-md-2 col-sm-6 col-xs-12">{$item.price}</div>
                                        <div class="col-md-2 col-sm-6 col-xs-12"><button class="btn_choose_service" name="{$item.name}" status='7' price="{$item.price}" note="" value="{$item.service_id}">Thêm</button></div>
                                    </div>
                                </li>
                                
                            {/if}
                        {/foreach}
                        </ul>
                    </div>
                </div>
                <button class="btn-cancel-service-table">Hủy</button>
            </div>



        </div>

        <div id="reservation_room" class="tab-pane fade">
            <div class="table-responsive table-detail table-0-15">
                <table class="table table-bg-no">
                    <thead>
                        <tr>
                            <th>#</th>
                            {* <th>Mã đơn</th> *}
                            {* <th>Mã phiếu đặt phòng</th>
                            <th>Phòng</th> *}
                            {* <th>Tên khách hàng</th>
                            <th>SĐT</th> *}
                            {* <th>Dịch vụ</th> *}
                            {* <th>Giá</th> *}
                            {* <th>Số lượng</th> *}
                            {* <th>Trạng thái dịch vụ</th> *}
                            <th>Ngày đặt</th>
                            {* <th>Tổng tiền</th> *}
                            <th width="112">@</th>
                        </tr>
                    </thead>
                    <tbody id="tpl_room_booked_today">
                    
                    </tbody>
                </table>
            </div>

            {* <div class="infomation_table infomation_code">
                <i class="fa fa-angle-left" aria-hidden="true"></i>
                <div class="row">

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <label class="label_name">Phòng</label>
                        <div id="wrap_header_form">
                            <select id="slBookingId" class="choose_cate form-control" >
                                <option value="0">Chọn phòng</option>
                                {foreach from=$lRoomBooked item=item}
                                    <option value="{$item.booking_id}">{$item.room_number}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="input_name">
                            <button id="btn-open-service" >Chọn dịch vụ</button>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <table class="table table-bg-no">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên món</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Chú thích</th>
                                    <th>Trạng thái dịch vụ</th>
                                    <th>Thành tiền</th>
                                    <th>Tổng</th>
                                    <th width="112">@</th>
                                </tr>
                            </thead>
                            <tbody id="lst_service_booked">
                            </tbody>
                        </table>
                    </div>
                </div>
        
                <div class="text-right">
                    <button class="btn btn-close-infomation_code cancel">Huỷ</button>
                    <button id="btn_create_booked_service" class="btn">Lưu</button>
                </div>
            </div> *}
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
</div>


