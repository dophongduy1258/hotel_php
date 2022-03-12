var thisPage = {};
thisPage.globalEditServiceID = "";
thisPage.globalDeleteServiceID = "";
thisPage.globalCancelServiceID = "";
thisPage.globalInfoServiceID = "";
thisPage.bookingCustomerName = $("#customer_name");
thisPage.bookingCmnd = $("#cmnd");
thisPage.bookingPhoneNumber = $("#phone_number");
thisPage.bookingEmail = $("#email");
thisPage.bookingStatus = $("#status");
thisPage.bookingTotal = $("#total");
thisPage.bookingNumberOfMember = $("#number_of_member"); // số lượng người sẽ ở
thisPage.bookingStayOfNight = $("#stay_of_night"); // số đêm muốn ở tại khách sạn
thisPage.bookingDateGetRoom = $("#date_get_room"); // ngày đến nhận phòng
thisPage.bookingBTNCreate = $("#btn_create_booking");
thisPage.bookingList = $("#tpl_list_bookings");
thisPage.slHotel = $("#booking_sl_hotel");
thisPage.slRoom = $("#booking_sl_room");
thisPage.slStatusForm = $("#booking_sl_status_form");
thisPage.bookingPrice = $("#price");
thisPage.searchSLByStatus = $("#search_sl_status");
thisPage.from = $("#from");
thisPage.to = $("#to");
thisPage.description = $("#description");

thisPage.date_check_in = $("#date_check_in");
thisPage.date_check_out = $("#date_check_out");
thisPage.slBed = $("#slBed");
thisPage.btnFilter = $("#btn_filter");

thisPage.total_no_format = "";
thisPage.price_no_format = "";
thisPage.roomId = "";

let get_date_check_in = "";
let get_date_check_out = "";
let room_id = "";
let is_room_choosen = false;

$(function () {
  // thisPage.staffTXTSearching.keyup(function(){
  //     thisPage.funcsFilterUser();
  // })

  thisPage.from.datepicker();
  thisPage.to.datepicker();

  thisPage.date_check_in.datepicker();
  thisPage.date_check_out.datepicker();

  thisPage.searchSLByStatus.change(() => {
    thisPage.funcsGetBooking();
  });

  thisPage.btnFilter.click(() => {
    thisPage.functionFilterRoom();
  });

  //   khi option selected hotel và room thay đổi
  thisPage.slHotel.change(() => {
    thisPage.funcsSLHotel();
  });

  thisPage.slRoom.change(() => {
    thisPage.funcsSLRoom();
  });

  // render html list booking
  thisPage.funcsGetBooking();

  // mở form thêm mới khách sạn
  $(".add_real.code_real").click(function () {
    thisPage.funcsToggleCreateBookingForm();
    thisPage.emptyFormCreateBooking();
    thisPage.funcsSLHotel();
    thisPage.funcsEnabled();
    // thisPage.funcsLoadPermissionDefault();
  });

  // btn xử lý sự kiện save  : thêm hoặc update thông tin booking
  thisPage.bookingBTNCreate.click(function () {
    thisPage.funcsSaveBooking();
  });

  $("#btn-show-room").click(function () {
    thisPage.funcsToggleShowRoom();
  });

  $(".btn-cancel-room-table").click(() => thisPage.funcsToggleShowRoom());

  $(
    ".infomation_table.infomation_code i, button.btn-close-infomation_code"
  ).click(function () {
    thisPage.funcsToggleCreateBookingForm();
  });

  $("#modal_delete_btn").click(function () {
    thisPage.funcsDeleteBooking();
  });

  $("#modal_cancel_btn").click(function () {
    thisPage.funcsCancelBooking();
  });
});

$("body").on("click", "#btn_book_room", function () {
  let room_id = $(this).attr("room_id");
  get_date_check_in = thisPage.date_check_in.val(); // 01/02/2022
  get_date_check_out = thisPage.date_check_out.val();

  let data = new FormData();
  data.append("room_id", room_id);
  _doAjaxNod("POST", data, "room", "idx", "detail_room", true, (res) => {
    thisPage.funcsToggleShowRoom();
    thisPage.price_no_format = res.data.price;
    // console.log(res.data);
    is_room_choosen = true;
    bed = res.data.bed;
    let date = get_date_check_out.slice(0, 2) - get_date_check_in.slice(0, 2);
    thisPage.total_no_format = date * res.data.price;
    let _html = thisPage.renderInputRoom(res.data, thisPage.total_no_format);
    $("#lst_input_room").html(_html);
  });
});

thisPage.renderInputRoom = (item, total) => {
  let bed = Number(item.bed) == 0 ? "Giường đơn" : "Giường đôi";
  thisPage.roomId = item.room_id;
  let _html = `
  <div id="wrap_input_room">
  <div class="col-md-3 col-sm-6 col-xs-12">
  <label class="label_name">Phòng</label>
  <div class="input_name" >
      <input room_id=${
        item.room_id
      } readonly placeholder="" class="form-control"type="text" value=${
    item.room_number
  }>
  </div>
</div>

<div class="col-md-3 col-sm-6 col-xs-12">
<label class="label_name">Giá tiền</label>
<div class="input_name" id="wrap_price">
<input id="price" readonly placeholder="" class="form-control"type="text" value=${new Intl.NumberFormat(
    "vi",
    {
      style: "currency",
      currency: "VND",
    }
  ).format(item.price)}>
</div>
</div>



<div class="col-md-1 col-sm-6 col-xs-12">
<label class="label_name">Số thành viên</label>
<div class="input_name">
  <input id="number_of_member" readonly placeholder="" class="form-control"type="text" value=${
    item.number_of_member
  }>
</div>
</div>

<div class="col-md-2 col-sm-6 col-xs-12">
<label class="label_name">Loại giường</label>
<div class="input_name">
  <input id="bed" readonly placeholder="" class="form-control"type="text" value="${bed}">
</div>
</div>


<div class="col-md-3 col-sm-6 col-xs-12">
<label class="label_name">Ngày nhận phòng</label>
<div class="input_name" id="wrap_price">
<input id="check_in" readonly placeholder="" class="form-control"type="text" value=${get_date_check_in}>
</div>
</div>

<div class="col-md-3 col-sm-6 col-xs-12">
<label class="label_name">Ngày trả phòng</label>
<div class="input_name" id="wrap_price">
<input id="check_out" readonly placeholder="" class="form-control"type="text" value=${get_date_check_out}>
</div>
</div>
<div class="col-md-6 col-sm-6 col-xs-12">
<label class="label_name">Tổng tiền</label>
<div class="input_name">
<input id="total" readonly placeholder="" class="form-control"type="text" value=${new Intl.NumberFormat(
    "vi",
    {
      style: "currency",
      currency: "VND",
    }
  ).format(total)}>
</div>
</div>
  </div>
`;

  return _html;
};

// hàm xử lý lọc phòng còn trống theo ngày và loại giường
thisPage.functionFilterRoom = () => {
  // console.log(thisPage.date_check_in.val());
  // console.log(Date.parse(thisPage.date_check_out.val()));
  if (thisPage.date_check_in.val() == "") {
    alert_dialog("Vui lòng chọn ngày nhận phòng");
  } else if (thisPage.date_check_out.val() == "") {
    alert_dialog("Vui lòng chọn ngày trả phòng");
  } else {
    let data = new FormData();
    data.append("date_check_in", thisPage.date_check_in.val());
    data.append("date_check_out", thisPage.date_check_out.val());
    data.append("slBed", thisPage.slBed.val());
    _doAjaxNod("POST", data, "booking", "idx", "filter_room", true, (res) => {
      // console.log(res.data);
      let _html = thisPage.renderHtmlRoomEmpty(res.data);

      $("#lst_room_empty").html(_html);
      $("#alert_fill_condition").addClass("hide_alert");
      thisPage.btnBookRoom = $("#btn_book_room");
    });
  }
};

thisPage.renderHtmlRoomEmpty = (lItems) => {
  let _html = "";
  lItems.forEach((item) => {
    _html += `<div class="col-md-3 col-sm-6 col-xs-12">
                <div id="room_id" aria-disabled="true" value="" class="room-card room_empty">
                    <h3>${item.room_number}</h3>
                    <button id="btn_book_room" room_id=${item.room_id} > chọn phòng</button>
                </div>
            </div>`;
  });
  return _html;
};

// Xử lý option chọn hotel để option room xổ ra tương ứng
thisPage.funcsSLHotel = () => {
  let data = new FormData();
  data.append("hotel_id", thisPage.slHotel.val());
  //   data.append("room_id", thisPage.slRoom.val());
  _doAjaxNod("POST", data, "booking", "idx", "handle_sl_hotel", true, (res) => {
    let _html = thisPage.funcsRenderOptionRoom(res.data);
    thisPage.slRoom.html(_html);
  });
};

// khi người dùng chọn phòng thì sẽ hiển thị giá tiền của phòng đó
thisPage.funcsSLRoom = () => {
  let data = new FormData();
  //   alert("slroom");

  data.append("room_id", thisPage.slRoom.val());
  //   data.append("number_of_member", thisPage.bookingNumberOfMember.val());
  _doAjaxNod("POST", data, "booking", "idx", "handle_sl_room", true, (res) => {
    let _html = thisPage.funcsRenderPrice(res.data);
    $("#wrap_price").html(_html);
    // thisPage.bookingPrice = $("#price");
    // $("#price").setAttribute("value", res.data.price);
  });
};
// render html input price
thisPage.funcsRenderPrice = (items) => {
  thisPage.price_no_format = items.price;
  let _html = `
    <input id="price" readonly placeholder="" class="form-control"type="text" value="${new Intl.NumberFormat(
      "vi",
      {
        style: "currency",
        currency: "VND",
      }
    ).format(items.price)}">
  `;
  return _html;
};

thisPage.funcsRenderOptionRoom = (lItems) => {
  let _html = "<option value=''>Chọn phòng</option>";
  lItems.forEach(function (item) {
    _html += `
            <option value="${item.room_id}">${item.room_number}</option>
        `;
  });
  return _html;
};

//update permission
$("body").on("click", "input.group-create", function (e) {
  thisPage.funcsSaveGIDPermission();
});

$("body").on("click", ".staff.img_edit_booking", function (e) {
  let _booking_id = $(this).attr("booking-id");
  let _room_id = $(this).attr("room-id");
  thisPage.funcsLoadDetailBooking(_booking_id, _room_id);
  thisPage.funcsEnabled();
});

$("body").on("click", ".staff.img_delete", function (e) {
  let _id = $(this).attr("booking-id");
  $("#staff_delete_noti").html($("#list-user-" + _id).html());
  $("#deleteBooking").modal("show");
  thisPage.globalDeleteBookingID = _id;
});

$("body").on("click", ".staff.img_cancel", function (e) {
  let _id = $(this).attr("booking-id");
  $("#cancelBooking").modal("show");
  thisPage.globalCancelBookingID = _id;
});

$("body").on("click", ".staff.img_info", function (e) {
  let _id = $(this).attr("booking-id");
  // $("#cancelBooking").modal("show");
  thisPage.globalInfoBookingID = _id;
  var data = new FormData();
  data.append("booking_id", _id);
  _doAjaxNod("POST", data, "booking", "idx", "detail_booking", true, (res) => {
    thisPage.funcsToggleCreateBookingForm();
    thisPage.globalEditBookingID = res.data.booking_id;
    thisPage.slStatusForm.val(res.data.booking_status_id);
    thisPage.bookingCustomerName.val(res.data.customer_name);
    thisPage.bookingCmnd.val(res.data.cmnd);
    thisPage.bookingPhoneNumber.val(res.data.phone_number);
    thisPage.bookingEmail.val(res.data.email);

    get_date_check_in = date_format("d/m/Y", res.data.date_checkin);
    get_date_check_out = date_format("d/m/Y", res.data.date_checkout);
    let _html = thisPage.renderInputRoom(res.data, res.data.total);
    $("#lst_input_room").html(_html);
    thisPage.funcsDisabled();
  });
});

thisPage.funcsDisabled = () => {
  thisPage.bookingCustomerName.attr("readonly", "readonly");
  thisPage.bookingCmnd.attr("readonly", "readonly");
  thisPage.bookingPhoneNumber.attr("readonly", "readonly");
  thisPage.bookingEmail.attr("readonly", "readonly");
  thisPage.slStatusForm.attr("disabled", true);
  thisPage.bookingBTNCreate.attr("disabled", true);
  $("#btn-show-room").attr("disabled", true);
};

thisPage.funcsEnabled = () => {
  thisPage.bookingCustomerName.attr("readonly", false);
  thisPage.bookingCmnd.attr("readonly", false);
  thisPage.bookingPhoneNumber.attr("readonly", false);
  thisPage.bookingEmail.attr("readonly", false);
  thisPage.slStatusForm.attr("disabled", false);
  thisPage.bookingBTNCreate.attr("disabled", false);
  $("#btn-show-room").attr("disabled", false);
};

thisPage.funcsGetBooking = () => {
  var data = new FormData();
  data.append("idxStatus", thisPage.searchSLByStatus.val());
  //   alert(thisPage.searchSLByStatus.val());
  _doAjaxNod("POST", data, "booking", "idx", "get_all", true, (res) => {
    let _html = thisPage.funcsCreateTPLGetBooking(res.data);
    thisPage.bookingList.html(_html);
  });
};

// render list html của booking
thisPage.funcsCreateTPLGetBooking = (lItems) => {
  let _html = "";
  let i = 1;
  // <td>
  //                       <span class="dt-span">${item.cmnd}</span>
  //                       <input type="text" name="" value="${
  //                         item.cmnd
  //                       }" class="dt-select">
  //                   </td>
  //                   <td>
  //                       <span class="dt-span">${item.phone_number}</span>
  //                       <input type="text" name="" value="${
  //                         item.phone_number
  //                       }" class="dt-select">
  //                   </td>
  //                   <td>
  //                       <span class="dt-span">${item.email}</span>
  //                       <input type="text" name="" value="${
  //                         item.email
  //                       }" class="dt-select">
  //                   </td>

  // <td>
  //                       <span class="dt-span">${item.hotel_name}</span>
  //                       <input type="text" name="" value="${
  //                         item.hotel_name
  //                       }" class="dt-select">
  //                   </td>
  // console.log(lItems);

  lItems.forEach(function (item) {
    _html += ` <tr >
                    <td>${i++}</td>
                    <td>
                        <span id="${item.booking_id}" class="dt-span">${
      item.customer_name
    }</span>
                        <input type="text" name="" value="${
                          item.customer_name
                        }" class="dt-select">
                    </td>
                    <td>
                        <span class="dt-span">${item.phone_number}</span>
                        <input type="text" name="" value="${
                          item.phone_number
                        }" class="dt-select">
                    </td>
                    
                    <td>
                        <span class="dt-span">${item.room_number}</span>
                        <input type="text" name="" value="${
                          item.room_number
                        }" class="dt-select">
                    </td>
                    <td>
                        <span class="dt-span">${new Intl.NumberFormat("vi", {
                          style: "currency",
                          currency: "VND",
                        }).format(item.price)}</span>
                        <input type="text" name="" value="${
                          item.price
                        }" class="dt-select">
                    </td>
                    <td>
                        <span class="dt-span">${
                          item.title == 0 ? "Đang chờ xử lý" : "Đã xử lý"
                        }</span>
                        <input type="text" name="" value="${
                          item.title
                        }" class="dt-select">
                    </td>
                    <td>
                        <span class="dt-span">${
                          item.is_payment == 0
                            ? "Chưa thanh toán"
                            : "Đã thanh toán"
                        }</span>
                        <input type="text" name="" value="${
                          item.is_payment
                        }" class="dt-select">
                    </td>
                    <td>
                        <span class="dt-span">${date_format(
                          "d/m/Y",
                          item.date_checkin
                        )}</span>
                        <input type="text" name="" value="${
                          item.date_checkin
                        }" class="dt-select">
                    </td>
                    
                    <td>
                        <span class="dt-span">${date_format(
                          "d/m/Y",
                          item.date_checkout
                        )}</span>
                        <input type="text" name="" value="${
                          item.date_checkout
                        }" class="dt-select">
                    </td>
                    
                    
                    <td>
                        <span class="dt-span">${new Intl.NumberFormat("vi", {
                          style: "currency",
                          currency: "VND",
                        }).format(item.total)}</span>
                        <input type="text" name="" value="${
                          item.total
                        }" class="dt-select">
                    </td>
                   
                    // === 1 ? 'Phòng đã được đặt' : 'Phòng trống'
                    <td>
                    ${
                      item.booking_status_id == 3 || item.booking_status_id == 6
                        ? `<img src="${domain}/public/images/info.png" alt="" booking-id="${item.booking_id}" width="24" class="staff img_info">`
                        : `<img src="${domain}/public/images/edit.png" alt="" room-id="${item.room_id}" booking-id="${item.booking_id}" width="24" class="staff img_edit_booking">
                        <img src="${domain}/public/images/delete.png" alt="" booking-id="${item.booking_id}" width="24" class="staff img_delete">
                        <img src="${domain}/public/images/cancel.png" alt="" booking-id="${item.booking_id}" width="24" class="staff img_cancel">
                  
                        `
                    }
                    </td>
                </tr>`;
  });
  return _html;
};

//  XỬ LÝ THAO TÁC MỞ FORM  : THÊM , UPDATE

thisPage.funcsToggleCreateBookingForm = () => {
  $(".table-detail").toggle();
  $(".infomation_code").toggle();
  $(".search-order").toggle();

  thisPage.bookingBTNCreate.attr("disabled", false);
};

thisPage.funcsToggleShowRoom = () => {
  $(".rooms_table").toggle(); // đóng mở bảng chọn phòng
  $(".infomation_code").toggle(); // đóng mở bảng điền thông tin khách hàng
};

thisPage.funcsCloseShowRoom = () => {
  $(".rooms_table").toggle();
  $(".infomation_code").toggle();
};

//  SHOW FORM UPDATE

thisPage.funcsLoadDetailBooking = (_booking_id, _room_id) => {
  let data = new FormData();
  data.append("booking_id", _booking_id);
  data.append("room_id", _room_id);
  _doAjaxNod("POST", data, "booking", "idx", "detail_booking", true, (res) => {
    console.log(res.data);
    thisPage.globalEditBookingID = res.data.booking_id;
    thisPage.slStatusForm.val(res.data.booking_status_id);
    thisPage.bookingCustomerName.val(res.data.customer_name);
    thisPage.bookingCmnd.val(res.data.cmnd);
    thisPage.bookingPhoneNumber.val(res.data.phone_number);
    thisPage.bookingEmail.val(res.data.email);

    is_room_choosen = true;

    get_date_check_in = date_format("d/m/Y", res.data.date_checkin);
    get_date_check_out = date_format("d/m/Y", res.data.date_checkout);
    thisPage.price_no_format = res.data.price;
    thisPage.total_no_format = res.data.total;
    let _html = thisPage.renderInputRoom(res.data, res.data.total);
    $("#lst_input_room").html(_html);
    thisPage.funcsToggleCreateBookingForm();
  });
};
thisPage.funcsRenderSLRoom = (items) => {
  let _html = `<option value="${items.room_id}">${items.room_number}</option>`;

  return _html;
};

thisPage.emptyFormCreateBooking = () => {
  thisPage.bookingCustomerName.val("");
  thisPage.bookingCmnd.val("");
  thisPage.bookingPhoneNumber.val("");
  thisPage.bookingEmail.val("");

  thisPage.slStatusForm.val("");

  $("#wrap_input_room").remove();
  thisPage.date_check_in.val("");
  thisPage.date_check_out.val("");
  thisPage.slBed.val("");
  let _html = `<h2 id="alert_fill_condition" class="">Vui lòng nhập thông tin để lọc phòng !</h2>`;
  $("#lst_room_empty").html(_html);

  thisPage.globalEditBookingID = "";
  thisPage.bookingStatus.prop("checked", false);
};

thisPage.funcsSaveBooking = () => {
  let _booking_customer_name = thisPage.bookingCustomerName.val();
  let _booking_cmnd = thisPage.bookingCmnd.val();
  let _booking_phone_number = thisPage.bookingPhoneNumber.val();
  let _booking_email = thisPage.bookingEmail.val();
  let slHotel = thisPage.slHotel.val();
  let slStatusForm = thisPage.slStatusForm.val();
  let price_no_format = thisPage.price_no_format;
  let _booking_number_of_member = thisPage.bookingNumberOfMember.val();
  let total_no_format = thisPage.total_no_format;

  if (_booking_customer_name == "") {
    alert_dialog("Vui lòng nhập tên khách hàng");
  } else if (_booking_cmnd == "") {
    alert_dialog("Vui lòng nhập chứng minh thư");
  } else if (_booking_phone_number == "") {
    alert_dialog("Vui lòng nhập số điện thoại");
  } else if (_booking_email == "") {
    alert_dialog("Vui lòng nhập email");
  } else if (_booking_number_of_member == "") {
    alert_dialog("Vui lòng nhập số lượng thành viên");
  } else if (is_room_choosen == false) {
    alert_dialog("Vui lòng chọn phòng");
  } else {
    let data = new FormData();
    data.append("booking_id", thisPage.globalEditBookingID);
    data.append("customer_name", _booking_customer_name);
    data.append("cmnd", _booking_cmnd);
    data.append("phone_number", _booking_phone_number);
    data.append("email", _booking_email);
    data.append("hotel_id", slHotel);
    data.append("room_id", thisPage.roomId);
    data.append("price", price_no_format);
    data.append("booking_status_id", slStatusForm);
    data.append("is_payment", 0);
    data.append("total", total_no_format);
    data.append("date_checkin", get_date_check_in);
    data.append("date_checkout", get_date_check_out);
    _doAjaxNod("POST", data, "booking", "save", "save_booking", true, (res) => {
      thisPage.globalEditBookingID = "";
      thisPage.funcsGetBooking();
      thisPage.funcsToggleCreateBookingForm();
      thisPage.total_no_format = ""; // set lại giá trị rỗng cho total
      thisPage.price_no_format = ""; // set lại giá trị rỗng cho price
      get_date_check_in = "";
      get_date_check_out = "";
      is_room_choosen = false; // set lại trạng thái phòng chưa được chọn
    });
  }
};

thisPage.funcsDeleteBooking = () => {
  let data = new FormData();
  data.append("booking_id", thisPage.globalDeleteBookingID);

  _doAjaxNod("POST", data, "booking", "delete", "delete_booking", true, () => {
    thisPage.globalDeleteBookingID = "";
    thisPage.funcsGetBooking();

    $("#deleteBooking").modal("hide");
  });
};

thisPage.funcsCancelBooking = () => {
  let data = new FormData();

  data.append("booking_id", thisPage.globalCancelBookingID);

  _doAjaxNod(
    "POST",
    data,
    "booking",
    "cancel",
    "cancel_booking",
    true,
    (res) => {
      thisPage.globalCancelBookingID = "";
      thisPage.funcsGetBooking();
      $("#cancelBooking").modal("hide");
    }
  );
};
