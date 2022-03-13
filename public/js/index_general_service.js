var thisPage = {};
thisPage.globalEditBookingID = "";
thisPage.globalDeleteBookingID = "";
thisPage.globalCancelBookingID = "";
thisPage.globalInfoBookingID = "";
// thisPage.bookingCustomerName = $("#customer_name");
// thisPage.bookingCmnd = $("#cmnd");
// thisPage.bookingPhoneNumber = $("#phone_number");
// thisPage.bookingEmail = $("#email");
// thisPage.bookingStatus = $("#status");
// thisPage.bookingTotal = $("#total");
// thisPage.bookingNumberOfMember = $("#number_of_member"); // số lượng người sẽ ở
// thisPage.bookingStayOfNight = $("#stay_of_night"); // số đêm muốn ở tại khách sạn
// thisPage.bookingDateGetRoom = $("#date_get_room"); // ngày đến nhận phòng
thisPage.slHotel = $("#booking_sl_hotel");
thisPage.slRoom = $("#booking_sl_room");
thisPage.slStatusForm = $("#booking_sl_status_form");
// thisPage.bookingPrice = $("#price");
thisPage.from = $("#from");
thisPage.to = $("#to");
thisPage.description = $("#description");
thisPage.quantity = $("#quantity");
thisPage.price = $("#price");

thisPage.date_check_in = $("#date_check_in");
thisPage.date_check_out = $("#date_check_out");
thisPage.slBed = $("#slBed");
thisPage.btnFilter = $("#btn_filter");

thisPage.filterByTime = $("#filter_by_time");
thisPage.bookedServiceBTNCreate = $("#btn_create_booked_service");
thisPage.lstHistoryBookedService = $("#tpl_history_booked_service");
thisPage.lstRoomBookedToday = $("#tpl_room_booked_today");
thisPage.total_no_format = "";
thisPage.price_no_format = "";
thisPage.into_money = "";
thisPage.roomId = "";
thisPage.bookingId = 0;

let is_booked_service = false;
let is_edit_service = false;
// let get_date_check_in = "";
// let get_date_check_out = "";
// let room_id = "";
// let is_room_choosen = false;
let cart = [];

$(function () {
  // thisPage.staffTXTSearching.keyup(function(){
  //     thisPage.funcsFilterUser();
  // })

  thisPage.from.datepicker();
  thisPage.to.datepicker();
  thisPage.from.change(() => {
    console.log(thisPage.from.val());
  });

  thisPage.date_check_in.datepicker();
  thisPage.date_check_out.datepicker();

  // thisPage.filterByTime.change(() => {
  //   thisPage.funcsGetBooking();
  // });

  thisPage.filterByTime.change(() => {
    thisPage.funcsGet_LstGeneralService(thisPage.filterByTime.val());
  });

  thisPage.btnFilter.click(() => {
    thisPage.functionFilterRoom();
  });

  //   khi người dùng chọn phòng thì reload data dịch vụ đang đặt được lên
  $("#slBookingId").change(() => {
    thisPage.bookingId = $("#slBookingId").val();
    thisPage.getLstServiceBooked(thisPage.bookingId);
  });

  // render html lịch sử các dịch vụ đã đặt
  thisPage.funcsGet_history_booked_service();

  thisPage.funcsGet_room_booked_today();

  // render select room
  thisPage.createTPLSelectRoom();

  // render html tất cả các dịch vụ mà khách đang đặt
  //   thisPage.getLstServiceBooked();

  // mở form thêm mới khách sạn
  $(".add_real.code_real").click(function () {
    thisPage.funcsToggleCreateOrderServiceForm();
    // thisPage.emptyFormCreateOrderService();
    $("#slBookingId").val(0); // set lại giá trị về mậc định là 0

    // dấu hiệu để nhận biết là đang mở ở phần thêm dịch vụ để load các service
    // đang được đặt mang trạng thái tạm ghi
    is_booked_service = true;
    is_edit_service = false;

    thisPage.getLstServiceBooked(); // reload lại data về 0

    // lấy ra tất cả các dịch vụ mà phòng này đang trong quá trình đặt
    // thisPage.funcsLoadPermissionDefault();
  });

  // btn xử lý sự kiện save  : thêm hoặc update thông tin booking
  thisPage.bookedServiceBTNCreate.click(function () {
    thisPage.funcsOrderService();
  });

  // mở bảng chọn dịch vụ
  $("#btn-open-service").click(function () {
    // console.log($("#slBookingId").val());
    // if ($("#slBookingId").val() == 0) {
    //   alert_dialog("Vui lòng chọn phòng");
    // } else {
    //   thisPage.bookingId = $("#slBookingId").val();
    // }
    thisPage.funcsToggleShowService();
  });

  $(".btn-cancel-service-table").click(() => {
    // thisPage.bookingId = $("#slBookingId").val();
    // thisPage.funcsToggleShowService(); // đóng bảng chọn dịch vụ
    // thisPage.getLstServiceBooked(thisPage.bookingId);
    //  ddang lam toi day
  });

  $(
    ".infomation_table.infomation_code i, button.btn-close-infomation_code"
  ).click(function () {
    thisPage.funcsToggleCreateOrderServiceForm();
    // thisPage.funcsGet_LstGeneralService();
    is_booked_service = false;
    is_edit_service = false;
  });

  $("#modal_delete_btn").click(function () {
    thisPage.funcsDeleteBooking();
  });

  $("#modal_cancel_btn").click(function () {
    thisPage.funcsCancelBooking();
  });
});

$("body").on("click", "#btn_del_service_booked", function () {
  //   console.log($(this).attr("general_service_id"));
  let data = new FormData();
  data.append("general_service_id", $(this).attr("general_service_id"));
  _doAjaxNod(
    "POST",
    data,
    "general_service",
    "delete",
    "delete_service_booked",
    true,
    (res) => {
      thisPage.getLstServiceBooked();
    }
  );
});

$("body").on("click", ".staff.img_edit_service_booked", function (e) {
  let _booking_id = $(this).attr("booking_id");
  is_booked_service = true;
  // is_edit_service = true;
  let storage = localStorage.getItem("lItems");
  if (storage) {
    cart = JSON.parse(storage);
  }
  //   thisPage.funcsLoadDetailServiceBooked(_booking_id);
  // thisPage.getLstServiceBooked(_booking_id);
  thisPage.funcsToggleCreateOrderServiceForm();
  // thisPage.createTPLSelectRoom(_booking_id);
  let _html = `<h2 id="booking_id">${_booking_id}</h2>`;
  $("#wrap_booking_title").html(_html);
  let _html_service_booked = thisPage.renderHtmlServiceBooked(cart);
  $("#lst_service_booked").html(_html_service_booked);
});

thisPage.createTPLSelectRoom = (_booking_id) => {
  _doAjaxNod(
    "POST",
    "",
    "general_service",
    "idx",
    "get_lst_room_booked",
    true,
    (res) => {
      // console.log(res.data);
      let _html = thisPage.renderHtmlSelectRoom(_booking_id);
      $("#wrap_title_room").html(_html);
    }
  );
};

thisPage.renderHtmlSelectRoom = () => {
  let _html = "...";

  // lItem.foreach((item) => {
  //   _html += `
  //         <h2>A02</h2>
  //       `;
  // });

  return _html;
};

// xử lý giảm số lượng
$("body").on("click", ".btn_decrease_quantity", function () {
  //   console.log($("#quantity").val());
  let general_service_id = $(this).attr("general_service_id");
  thisPage.funcsHandelQuantity(-1, general_service_id);
});

// xử lý tăng số lượng
$("body").on("click", ".btn_increase_quantity", function () {
  let general_service_id = $(this).attr("general_service_id");
  //   thisPage.funcsIncrease();
  thisPage.funcsHandelQuantity(1, general_service_id);
});

$("body").on("change", "#note", function () {
  let general_service_id = $(this).attr("general_service_id");
  thisPage.funcsHandelNote($(this).val(), general_service_id);
});

$("body").on("click", ".btn_choose_service", function () {
  let new_item = {
    service_id: $(this).val(),
    name: $(this).attr("name"),
    price: $(this).attr("price"),
    quantity: 1,
    status: $(this).attr("status"),
    note: $(this).attr("note"),
    into_money: $(this).attr("price"),
  };

  let storage = localStorage.getItem("lItems");

  if (storage != null) {
    cart = JSON.parse(storage);
  }

  let item = cart.find((i) => i.service_id == $(this).val());

  if (item) {
    item.quantity += 1;
    item.into_money = item.price * item.quantity;
  } else {
    cart.push(new_item);
  }
  localStorage.setItem("lItems", JSON.stringify(cart));
});

thisPage.funcsHandelNote = (note, general_service_id) => {
  let data = new FormData();
  data.append("id", general_service_id);
  data.append("note", note);
  _doAjaxNod(
    "POST",
    data,
    "general_service",
    "idx",
    "handel_note",
    true,
    (res) => {
      let _html = thisPage.renderHtmlServiceBooked(res.data);
      $("#lst_service_booked").html(_html);
    }
  );
};

// cập nhật lại số lượng và thành tiền của món đang được điều chỉnh
thisPage.funcsHandelQuantity = (condition, general_service_id) => {
  //   console.log($(".btn_quantity").attr("service_id"));
  let data = new FormData();
  data.append("id", general_service_id);
  data.append("condition", condition);
  _doAjaxNod(
    "POST",
    data,
    "general_service",
    "idx",
    "handel_quantity",
    true,
    (res) => {
      let _html = thisPage.renderHtmlServiceBooked(res.data);
      $("#lst_service_booked").html(_html);
    }
  );
};

//  lấy tất cả các dịch vụ đang được đặt
thisPage.getLstServiceBooked = (_booking_id) => {
  let booked_serivce = "";
  let edit_serivce = "";

  if (is_booked_service == true) {
    booked_serivce = 1;
    edit_serivce = 0;
  } else {
    booked_serivce = 0;
    edit_serivce = 1;
  }

  let data = new FormData();
  data.append("booking_id", _booking_id);
  //   data.append("booking_id", 22);
  data.append("is_booked_service", booked_serivce);
  data.append("is_edit_service", edit_serivce);
  _doAjaxNod(
    "POST",
    data,
    "general_service",
    "idx",
    "get_all_service_booked",
    true,
    (res) => {
      // if (is_edit_service == true) {
      //   $(".btn_quantity").addClass("hide_content");
      // }
      let _html_service_booked = thisPage.renderHtmlServiceBooked(res.data);
      // let _html_select_status = thisPage.renderHtmlSelectStatus(res.data);
      $("#lst_service_booked").html(_html_service_booked);
      $(".btn_quantity").attr("disabled", true);
    }
  );
};

thisPage.getLstStatus = () => {};

thisPage.renderHtmlSelectStatus = () => {
  let _html = "";
  // lItem.forEach((item) => {
  _html += `
        <select>
          <option value="0">ádasf</option>
          <option value="1">bbb</option>
          <option value="2">ssss</option>
        </select>
    `;
  // });

  return _html;
};

thisPage.renderHtmlServiceBooked = (lItem) => {
  let _html = "";
  let i = 1;
  //     <td id="booking_status_id">` + thisPage.renderHtmlSelectStatus();
  // _html += `</td>
  lItem.forEach((item) => {
    _html += `
        <tr>
            <td>${i++}</td>
            <td id="name" >${item.name}</td>
            <td id="price">${item.price} đ</td>
            <td class="td_quanlity">
                <button class="btn_decrease_quantity btn_quantity" general_service_id="${
                  item.id
                }" >-</button>
                <p id="quantity" value="${item.quantity}">${item.quantity}</p>
                <button class="btn_increase_quantity btn_quantity " general_service_id="${
                  item.id
                }">+</button>
            </td>
            <td>
                <input id="note" general_service_id="${
                  item.id
                }" type="text" value="${item.note}"/>
            </td>

            <td id="total">${item.total} đ</td>
            <td>44,000 đ</td>
            <td>
            ${
              is_booked_service == true
                ? `<button
                    id="btn_del_service_booked"
                    general_service_id="${item.id}"
                  >
                    X
                  </button>`
                : ``
            }
              </td>
        </tr>
        `;
  });

  return _html;
};

//update permission
$("body").on("click", "input.group-create", function (e) {
  thisPage.funcsSaveGIDPermission();
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
    thisPage.funcsToggleCreateOrderServiceForm();
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
  //   thisPage.bookingCustomerName.attr("readonly", "readonly");
  //   thisPage.bookingCmnd.attr("readonly", "readonly");
  //   thisPage.bookingPhoneNumber.attr("readonly", "readonly");
  //   thisPage.bookingEmail.attr("readonly", "readonly");
  //   thisPage.slStatusForm.attr("disabled", true);
  //   thisPage.bookedServiceBTNCreate.attr("disabled", true);
  //   $("#btn-show-room").attr("disabled", true);
};

thisPage.funcsEnabled = () => {
  //   thisPage.bookingCustomerName.attr("readonly", false);
  //   thisPage.bookingCmnd.attr("readonly", false);
  //   thisPage.bookingPhoneNumber.attr("readonly", false);
  //   thisPage.bookingEmail.attr("readonly", false);
  //   thisPage.slStatusForm.attr("disabled", false);
  //   thisPage.bookedServiceBTNCreate.attr("disabled", false);
  //   $("#btn-show-room").attr("disabled", false);
};

thisPage.funcsGet_history_booked_service = (valFilterByItem = "") => {
  // hiển thị lịch sử lịch đặt dịch vụ

  // alert("s");
  var data = new FormData();
  data.append("valFilterbyTime", valFilterByItem);
  //   alert(thisPage.searchSLByStatus.val());
  _doAjaxNod(
    "POST",
    data,
    "general_service",
    "idx",
    "history_booked_service",
    true,
    (res) => {
      let _html = thisPage.funcsCreateTPL_lstHistoryBookedService(res.data);
      thisPage.lstHistoryBookedService.html(_html);
      console.log(res.data);
      console.log("history booked");
    }
  );
};

// render list html của booking
thisPage.funcsCreateTPL_lstHistoryBookedService = (lItems) => {
  let _html = "";
  let i = 1;

  lItems.forEach(function (item) {
    _html += ` <tr >
                    <td>${i++}</td>
                    <td>
                        <span class="dt-span">${item.booking_id}</span>
                        <input type="text" name="" value="${
                          item.booking_id
                        }" class="dt-select">
                    </td>
                    <td>
                        <span class="dt-span">${item.room_number}</span>
                        <input type="text" name="" value="${
                          item.room_number
                        }" class="dt-select">
                    </td>
                    <td>
                        <span class="dt-span">${item.customer_name}</span>
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
                        <span class="dt-span">${date_format(
                          "d/m/Y",
                          item.create_at
                        )}</span>
                        <input type="text" name="" value="${
                          item.create_at
                        }" class="dt-select">
                    </td>
                    <td>
                    <img src="${domain}/public/images/edit.png" alt="" booking_id="${
      item.booking_id
    }" width="24" class="staff img_info">
                    </td>
                </tr>`;
  });
  return _html;
};

thisPage.funcsGet_room_booked_today = (valFilterByItem = "") => {
  // hiển thị lịch sử lịch đặt dịch vụ

  // alert("s");
  var data = new FormData();
  data.append("valFilterbyTime", valFilterByItem);
  //   alert(thisPage.searchSLByStatus.val());
  _doAjaxNod(
    "POST",
    data,
    "general_service",
    "idx",
    "room_booked_today",
    true,
    (res) => {
      let _html = thisPage.funcsCreateTPL_lstRoomBookedToday(res.data);
      thisPage.lstRoomBookedToday.html(_html);
    }
  );
};

// render list html của booking
thisPage.funcsCreateTPL_lstRoomBookedToday = (lItems) => {
  let _html = "";
  let i = 1;

  lItems.forEach(function (item) {
    _html += ` <tr >
                    <td>${i++}</td>
                    <td>
                        <span class="dt-span">${item.booking_id}</span>
                        <input type="text" name="" value="${
                          item.booking_id
                        }" class="dt-select">
                    </td>
                    <td>
                        <span class="dt-span">${item.room_number}</span>
                        <input type="text" name="" value="${
                          item.room_number
                        }" class="dt-select">
                    </td>
                    <td>
                        <span class="dt-span">${item.customer_name}</span>
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
                        <span class="dt-span">${item.email}</span>
                        <input type="text" name="" value="${
                          item.email
                        }" class="dt-select">
                    </td>
                    <td>
                        <span class="dt-span">${date_format(
                          "d/m/Y",
                          item.create_at
                        )}</span>
                        <input type="text" name="" value="${
                          item.create_at
                        }" class="dt-select">
                    </td>
                    <td>
                    <img src="${domain}/public/images/edit.png" alt="" booking_id="${
      item.booking_id
    }" width="24" class="staff img_edit_service_booked">
                    </td>
                </tr>`;
  });
  return _html;
};

//  XỬ LÝ THAO TÁC MỞ FORM  : THÊM , UPDATE

thisPage.funcsToggleCreateOrderServiceForm = () => {
  $(".table-detail").toggle();
  $(".infomation_room_booked_today").toggle();
  // $(".search-order").toggle();

  //   thisPage.bookedServiceBTNCreate.attr("disabled", false);
};

thisPage.funcsToggleShowService = () => {
  $(".service_table").toggle(); // đóng mở bảng chọn dịch vụ
  $(".infomation_room_booked_today").toggle(); // đóng giỏ hàng
};

// thisPage.funcsCloseShowRoom = () => {
//   $(".rooms_table").toggle();
//   $(".infomation_code").toggle();
// };

//  SHOW FORM UPDATE

thisPage.funcsLoadDetailServiceBooked = (_booking_id) => {
  thisPage.getLstServiceBooked();
  thisPage.funcsToggleCreateOrderServiceForm();
  //   let _html = thisPage.htmlTitleEdit(1, 2);
  //   $("#wrap_header_form").html(_html);
  //   console.log($("#slBookingId").val());
  //   let data = new FormData();
  //   data.append("booking_id", _booking_id);
  //   _doAjaxNod(
  //     "POST",
  //     data,
  //     "general_service",
  //     "idx",
  //     "get_all_service_booked",
  //     true,
  //     (res) => {
  //       console.log(res.data);
  //       $("#slBookingId").val(res.data.booking_id);
  //       //   $("#slBookingId").attr("disabled", true);
  //       //     thisPage.globalEditBookingID = res.data.booking_id;
  //       //     thisPage.slStatusForm.val(res.data.booking_status_id);
  //       //     thisPage.bookingCustomerName.val(res.data.customer_name);
  //       //     thisPage.bookingCmnd.val(res.data.cmnd);
  //       //     thisPage.bookingPhoneNumber.val(res.data.phone_number);
  //       //     thisPage.bookingEmail.val(res.data.email);

  //       //     is_room_choosen = true;

  //       //     get_date_check_in = date_format("d/m/Y", res.data.date_checkin);
  //       //     get_date_check_out = date_format("d/m/Y", res.data.date_checkout);
  //       //     thisPage.price_no_format = res.data.price;
  //       //     thisPage.total_no_format = res.data.total;
  //       //     let _html = thisPage.renderInputRoom(res.data, res.data.total);
  //       //     $("#lst_input_room").html(_html);
  //       //     thisPage.funcsToggleCreateOrderServiceForm();
  //     }
  //   );
};
thisPage.htmlTitleEdit = (room_number, booking_id) => {
  let _html = ` <div id="room_title">
                    <h2>booking id</h2>
                    <h2>room number</h2>
                </div>`;

  return _html;
};

thisPage.emptyFormCreateOrderService = () => {
  thisPage.bookingId = 0;
};

thisPage.funcsOrderService = () => {
  // is_booked_service
  // is_edit_service
  //   let condition;
  //   if (is_booked_service == true) {
  //     condition = "is_booked_service" + is_booked_service;
  //   } else if (is_edit_service == true) {
  //     condition = "is_edit_service" + is_edit_service;
  //   }
  //   console.log(condition);
  let data = new FormData();
  data.append("booking_id", $("#slBookingId").val());
  data.append("is_booked_service", is_booked_service);
  data.append("is_edit_service", is_edit_service);
  _doAjaxNod(
    "POST",
    data,
    "general_service",
    "save",
    "save_order_service",
    true,
    () => {
      thisPage.funcsToggleCreateOrderServiceForm();
      thisPage.funcsGet_LstGeneralService();
      // thisPage.globalDeleteBookingID = "";
      // thisPage.funcsGetBooking();
      // $("#deleteBooking").modal("hide");
    }
  );
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
