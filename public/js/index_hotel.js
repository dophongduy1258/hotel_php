$("body").on("click", ".staff.img_reset", function (e) {
  let _id = $(this).attr("user-id");
  $("#staff_reset_noti").html($("#list-user-" + _id).html());
  $("#resetPassword").modal("show");
  thisPage.globalResetUserID = _id;
});

var thisPage = {};
// hotel
thisPage.globalEditHotelID = "";
thisPage.globalDeleteHotelID = "";
thisPage.hotelName = $("#hotel_name");
thisPage.hotelDescription = $("#hotel_description");
thisPage.hotelAddress = $("#hotel_address");
thisPage.staffBTNCreateHotel = $("#btn_create_hotel");
thisPage.hotelList = $("#tpl_list_hotels");
thisPage.hotelCategoryHotel = $("#staff_sl_category_hotel");
thisPage.searchSlCategoryHotel = $("#search_sl_category_hotel");

thisPage.staffListUsers = $("#tpl_list_users");

$(function () {
  thisPage.searchSlCategoryHotel.change(function () {
    thisPage.funcsFilterHotel();
  });

  // HOTEL
  thisPage.funcsFilterHotel();

  // mở form thêm mới khách sạn
  $(".add_real.code_real").click(function () {
    thisPage.funcsToggleCreateHotelForm();
    thisPage.emptyFormCreateHotel();
    // thisPage.funcsLoadPermissionDefault();
  });

  // xử lý sự kiện save  : thêm hoặc update thông tin hotel
  thisPage.staffBTNCreateHotel.click(function () {
    thisPage.funcsSaveHotel();
  });

  $(
    ".infomation_table.infomation_code i, button.btn-close-infomation_code"
  ).click(function () {
    thisPage.funcsToggleCreateHotelForm();
  });

  $("#modal_delete_btn").click(function () {
    thisPage.funcsDeleteHotel();
  });
});

thisPage.funcsTPLCreate = (l) => {
  let _html = "";
  l.forEach(function (item) {
    _html += `<li class="list-gid">
                    <input ${
                      item.id == 1 ? 'style="opacity:0.8;" disabled' : ""
                    } id="gid-name-${item.id}" gid="${
      item.id
    }" class="gid-name" value="${item.name}" title="${item.name}"/>
                    <img gid="${item.id}" ${
      item.id == 1 ? 'style="opacity:0.4;"' : 'class="gid-delete"'
    } src="${domain}/public/images/delete.png" alt="" width="24">
                </li>`;
  });
  return _html;
};

//  XỬ LÝ SỰ KIỆN JS DOM của HOTEL

$("body").on("click", ".staff.img_edit_hotel", function (e) {
  let _id = $(this).attr("hotel-id");
  thisPage.funcsLoadDetailHotel(_id);
});

$("body").on("click", ".staff.img_delete", function (e) {
  let _id = $(this).attr("hotel-id");
  $("#staff_delete_noti").html($("#list-user-" + _id).html());
  $("#deleteHotel").modal("show");
  thisPage.globalDeleteHotelID = _id;
});

thisPage.funcsFilterHotel = () => {
  var data = new FormData();
  data.append("idxKey", thisPage.searchSlCategoryHotel.val());
  _doAjaxNod("POST", data, "hotel", "idx", "get_all", false, (res) => {
    let _html = thisPage.funcsCreateTPLFilterHotel(res.data);
    thisPage.hotelList.html(_html);
  });
};

thisPage.funcsCreateTPLFilterHotel = (lItems) => {
  let _html = "";
  let i = 1;

  let edit_permission = check_permission(":staffsave:");
  let delete_permission = check_permission(":staffdelete:");
  lItems.forEach(function (item) {
    _html += ` <tr>
                    <td>${i++}</td>
                    <td>
                        <span id="${item.hotel_id}" class="dt-span">${
      item.hotel_name
    }</span>
                        <input type="text" name="" value="${
                          item.hotel_name
                        }" class="dt-select">
                    </td>
                    <td>
                        <span class="dt-span">${item.description}</span>
                        <input type="text" name="" value="${
                          item.description
                        }" class="dt-select">
                    </td>
                    <td>
                    <span class="dt-span">${item.address}</span>
                    <select id="staff_sl_gid" class="dt-select">
                    
                    </select>
                    </td>
                    <td>
                        <span class="dt-span">${item.name}</span>
                        <input type="text" name="" value="${
                          item.name
                        }" class="dt-select">
                    </td>
                    <td>
                    <img src="${domain}/public/images/edit.png" alt="" hotel-id="${
      item.hotel_id
    }" width="24" class="staff img_edit_hotel">
                    <img src="${domain}/public/images/delete.png" alt="" hotel-id="${
      item.hotel_id
    }" width="24" class="staff img_delete">
                       
                    </td>
                </tr>`;
  });
  return _html;
};

//  XỬ LÝ THAO TÁC MỞ FORM  : THÊM , UPDATE

thisPage.funcsToggleCreateHotelForm = () => {
  $(".table-detail").toggle();
  $(".infomation_code").toggle();
  $(".search-order").toggle();
};

//  SHOW FORM UPDATE
thisPage.funcsLoadDetailHotel = (_id) => {
  let data = new FormData();
  data.append("hotel_id", _id);
  _doAjaxNod("POST", data, "hotel", "idx", "detail_hotel", true, (res) => {
    thisPage.globalEditHotelID = res.data.hotel_id;
    thisPage.hotelName.val(res.data.hotel_name);
    thisPage.hotelDescription.val(res.data.description);
    thisPage.hotelAddress.val(res.data.address);
    thisPage.hotelCategoryHotel.val(res.data.category_id);
    // thisPage.staffAddress.val( res.data.address );
    // thisPage.staffPassword.val( '' );
    // thisPage.staffSLGid.val( res.data.gid );
    // thisPage.funcsTemplatePermission( res.data.permission );
    thisPage.funcsToggleCreateHotelForm();
  });
};

thisPage.emptyFormCreateHotel = () => {
  thisPage.hotelName.val("");
  thisPage.hotelDescription.val("");
  thisPage.hotelAddress.val("");
  thisPage.globalEditHotelID = "";
  thisPage.hotelCategoryHotel.val(1);
};

thisPage.funcsSaveHotel = () => {
  let _hotel_name = thisPage.hotelName.val();
  let _hotel_description = thisPage.hotelDescription.val();
  let _hotel_address = thisPage.hotelAddress.val();
  let _hotel_category = thisPage.hotelCategoryHotel.val();

  //   let _search_sl_category_hotel = thisPage.searchSlCategoryHotel.val();

  if (_hotel_name == "") {
    alert_dialog("Vui lòng nhập tên khách sạn");
  } else if (_hotel_description == "") {
    alert_dialog("Vui lòng nhập mô tả về khách sạn");
  } else if (_hotel_address == "") {
    alert_dialog("Vui lòng nhập địa chỉ khách sạn");
  } else {
    let data = new FormData();

    data.append("hotel_id", thisPage.globalEditHotelID);
    data.append("hotel_name", _hotel_name);
    data.append("address", _hotel_address);
    data.append("description", _hotel_description);
    data.append("category_id", _hotel_category);

    _doAjaxNod("POST", data, "hotel", "save", "save_hotel", true, (res) => {
      thisPage.globalEditHotelID = "";
      thisPage.funcsFilterHotel();
      thisPage.funcsToggleCreateHotelForm();
    });
  }
};

thisPage.funcsDeleteHotel = () => {
  let data = new FormData();
  data.append("hotel_id", thisPage.globalDeleteHotelID);

  _doAjaxNod("POST", data, "hotel", "delete", "delete_hotel", true, () => {
    thisPage.globalDeleteHotelID = "";
    thisPage.funcsFilterHotel();

    $("#deleteHotel").modal("hide");
  });
};
