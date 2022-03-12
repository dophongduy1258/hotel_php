// $('body').on('click', '.staff.img_reset', function (e) {
//     let _id    = $(this).attr("user-id");
//     $("#staff_reset_noti").html($("#list-user-"+_id).html());
//     $("#resetPassword").modal("show");
//     thisPage.globalResetUserID = _id;
// });

var thisPage = {};
thisPage.globalEditRoomID = "";
thisPage.globalDeleteRoomID = "";
thisPage.globalDeleteImgRoomID = "";
thisPage.lstImgSrc = "";
thisPage.imgSrc = "";
thisPage.roomNumber = $("#number_room");
thisPage.roomPrice = $("#price");
thisPage.roomNumberOfMember = $("#number_of_member");
thisPage.roomSize = $("#size_room");
thisPage.slCategory = $("#sl_category");
thisPage.slBed = $("#sl_bed");
thisPage.slHotel = $("#sl_hotel");
thisPage.roomBreakfast = $("#breakfast");
thisPage.roomWifi = $("#wifi");
thisPage.roomRefund = $("#refund");
thisPage.roomReschedule = $("#reschedule");
thisPage.roomDescription = $("#description");
thisPage.roomBTNCreate = $("#btn_create_room");
thisPage.roomList = $("#tpl_list_room");
let benefits = "";

$(function () {
  // thisPage.staffTXTSearching.keyup(function(){
  //     thisPage.funcsFilterUser();
  // })

  uploadFile("#file_uploading", "#hold_img_show");
  $("#hold_img_show").click(() => $("#file_uploading").click());

  $("#btn_reset_password").click(function () {
    thisPage.funcsResetPasswordStaff();
  });

  // render html list room
  thisPage.funcsGetRoom();

  // mở form thêm mới khách sạn
  $(".add_real.code_real").click(function () {
    thisPage.funcsToggleCreateRoomForm();
    thisPage.emptyFormCreateRoom();

    // xóa tất cả các ảnh đã được thêm mới trước đó  khi muốn thêm mới 1 product mới
    $("img.img-responsive.img").parent().remove();
  });

  // btn xử lý sự kiện save  : thêm hoặc update thông tin hotel
  thisPage.roomBTNCreate.click(function () {
    thisPage.funcsSaveRoom();
  });

  $(
    ".infomation_table.infomation_code i, button.btn-close-infomation_code"
  ).click(function () {
    thisPage.funcsToggleCreateRoomForm();
    // $("img.img-responsive.img").parent().remove();
  });

  $("#modal_delete_btn").click(function () {
    thisPage.funcsDeleteRoom();
  });

  $("#modal_delete_img_btn").click(function () {
    thisPage.funcsDeleteRoomImg();
  });
});
//  update benefit
$("body").on("click", "input.group-create", (e) => {
  thisPage.funcsSaveBenefit();
  // thisPage.funcsSaveBenefit();
});

// thisPage.hotelCategoryHotel = $('#staff_sl_category_hotel');

// mở modal delete ảnh
$("body").on("click", ".avatar_lst img", function (e) {
  let _img_id = $(this).attr("avatar_id");
  let _img_src = $(this).attr("src");
  thisPage.globalDeleteImgRoomID = _img_id;
  thisPage.imgSrc = _img_src;
  $("#deleteImg").modal("show");
});

$("body").on("click", "i.delete", function (e) {
  $(this).parent().remove();
});

$("body").on("click", ".staff.img_edit_room", function (e) {
  let _room_id = $(this).attr("room-id");
  thisPage.funcsLoadDetailRoom(_room_id);
});

$("body").on("click", ".staff.img_delete", function (e) {
  let _room_id = $(this).attr("room-id");
  $("#staff_delete_noti").html($("#list-user-" + _room_id).html());
  $("#deleteRoom").modal("show");
  thisPage.globalDeleteRoomID = _room_id;
});

// $("body").on("click", ".lst_img_delete", function (e) {
//   console.log($(".avatar_id").attr("lst_img_id"));
//   console.log($(".avatar_id").attr("src"));
// });

thisPage.funcsGetRoom = () => {
  // var data = new FormData();
  // data.append('keyword', thisPage.staffTXTSearching.val() )
  _doAjaxNod("POST", "", "room", "idx", "get_all", false, (res) => {
    let _html = thisPage.funcsCreateTPLGetRoom(res.data);
    thisPage.roomList.html(_html);
  });
};

thisPage.funcsCreateTPLGetRoom = (lItems) => {
  let _html = "";
  let i = 1;

  let edit_permission = check_permission(":staffsave:");
  let delete_permission = check_permission(":staffdelete:");
  lItems.forEach(function (item) {
    _html += ` <tr>
                    <td>${i++}</td>
                    <td>
                        <span id="${item.room_id}" class="dt-span">${
      item.room_number
    }</span>
                        <input type="text" name="" value="${
                          item.room_number
                        }" class="dt-select">
                    </td>
                    <td>
                        <span class="dt-span">${item.hotel_name}</span>
                        <input type="text" name="" value="${
                          item.price
                        }" class="dt-select">
                    </td>
                    <td>
                        <span class="dt-span">${item.description}</span>
                        <input type="text" name="" value="${
                          item.description
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
                    // === 1 ? 'Phòng đã được đặt' : 'Phòng trống'
                    <td>
                        <span class="dt-span">${
                          item.status == 1 ? "Phòng đã được đặt" : "Phòng trống"
                        }</span>
                        <input type="text" name="" value="${
                          item.status
                        }" class="dt-select">
                    </td>
                    <td>
                    <img src="${domain}/public/images/edit.png" alt="" room-id="${
      item.room_id
    }" width="24" class="staff img_edit_room">
                    <img src="${domain}/public/images/delete.png" alt="" room-id="${
      item.room_id
    }" width="24" class="staff img_delete">
                       
                    </td>
                </tr>`;
  });
  return _html;
};

//  XỬ LÝ THAO TÁC MỞ FORM  : THÊM , UPDATE

thisPage.funcsToggleCreateRoomForm = () => {
  $(".table-detail").toggle();
  $(".infomation_code").toggle();
  $(".search-order").toggle();
  $("input.group-create").prop("checked", false);
  // $("img.img-responsive.img").parent().remove();
};

//  SHOW FORM UPDATE
thisPage.funcsLoadDetailRoom = (_id) => {
  let data = new FormData();
  data.append("room_id", _id);
  _doAjaxNod("POST", data, "room", "idx", "detail_room", true, (res) => {
    thisPage.globalEditRoomID = res.data.room_id;
    thisPage.roomNumber.val(res.data.room_number);
    thisPage.roomPrice.val(res.data.price);
    thisPage.roomDescription.val(res.data.description);
    // thisPage.slRoom.val(res.data.hotel_id);
    thisPage.funcsToggleCreateRoomForm();

    // set list string ảnh vào biến tạm thời
    thisPage.lstImgSrc = res.data.img_rooms;
    // <a class="col-md-2 img"><img src="${file.name}" class="img-responsive img"><i class="delete">x</i></a>
    // alert(res.data.img_rooms);
    let _html_img_room = "";

    if (res.data.img_rooms == null || res.data.img_rooms == "") {
      return;
    } else {
      let limg = res.data.img_rooms.split(";");
      limg.forEach((item) => {
        if (item == "") {
          return;
        } else {
          _html_img_room += `
          <a class="col-md-2 img"><img avatar_id="${res.data.room_id}" src="${item}" class="img-responsive img"></a>
        `;
        }
      });
    }
    // alert(limg);

    $(".avatar_lst").html(_html_img_room);
    l = res.data.benefit_room.split(";");
    l.forEach((item) => {
      // kiểm tra item có phải là số không, nếu đúng lấy id của từng input  + thêm item là group và gán properties bằng true
      if (isNumber(item)) $("#group-create-" + item).prop("checked", true);
    });
  });
};

thisPage.emptyFormCreateRoom = () => {
  thisPage.roomNumber.val("");
  thisPage.roomPrice.val("");
  thisPage.roomDescription.val("");
  thisPage.globalEditRoomID = "";
  benefits = "";
  $("input.group-create").prop("checked", false);
};

thisPage.funcsSaveRoom = () => {
  // gọi hàm xử lý benefit khi người dùng checked, kết quả trả về 1;2;...

  let _benefit = thisPage.funcsSaveBenefit();
  // alert($("#date_get_room").val());
  // console.log(new Date().getTime("2022-02-04T15:46"));
  let _room_number = thisPage.roomNumber.val();
  let _room_price = thisPage.roomPrice.val();
  let _room_NoM = thisPage.roomNumberOfMember.val();
  let _room_size = thisPage.roomSize.val();
  let slCategory = thisPage.slCategory.val();
  let slBed = thisPage.slBed.val();
  let slHotel = thisPage.slHotel.val();
  let _room_breakfast = thisPage.roomBreakfast.is(":checked");
  let _room_wifi = thisPage.roomWifi.is(":checked");
  let _room_refund = thisPage.roomRefund.is(":checked");
  let _room_reschedule = thisPage.roomReschedule.is(":checked");
  let _room_description = thisPage.roomDescription.val();

  let _images_new = "";

  $(".avatar_thumbs img.img-responsive.img").each(function () {
    _images_new += $(this).attr("src") + ";";
  });

  let _images_old = "";

  $(".avatar_lst img.img-responsive.img").each(function () {
    _images_old += $(this).attr("src") + ";";
  });

  let _images = _images_old + _images_new;
  if (_room_number == "") {
    alert_dialog("Vui lòng nhập mã phòng");
  } else if (_room_price == "") {
    alert_dialog("Vui lòng nhập giá phòng");
  } else if (_room_description == "") {
    alert_dialog("Vui lòng nhập mô tả phòng");
  } else {
    let data = new FormData();
    data.append("room_id", thisPage.globalEditRoomID);
    data.append("room_number", _room_number);
    data.append("price", _room_price);
    data.append("benefit_room", benefits); // tham chiếu đến biến benefits được gán giá trị ở hàm funcsSaveBenefit
    data.append("img_rooms", _images);
    data.append("number_of_member", _room_NoM);
    data.append("size_room", _room_size);
    data.append("category_room_id", slCategory);
    data.append("bed", slBed);
    data.append("description", _room_description);
    data.append("breakfast", _room_breakfast);
    data.append("wifi", _room_wifi);
    data.append("refund", _room_refund);
    data.append("reschedule", _room_reschedule);
    data.append("hotel_id", slHotel);
    _doAjaxNod("POST", data, "room", "save", "save_room", true, (res) => {
      thisPage.globalEditRoomID = "";
      thisPage.funcsGetRoom();
      thisPage.funcsToggleCreateRoomForm();
      $("input.group-create").prop("checked", false); // set lại check về trạng thái ban đầu
      // set lại giá trị rỗng cho benefits sau khi đã lưu
      benefits = "";
    });
  }
};

thisPage.funcsDeleteRoom = () => {
  let data = new FormData();
  data.append("room_id", thisPage.globalDeleteRoomID);

  _doAjaxNod("POST", data, "room", "delete", "delete_room", true, () => {
    thisPage.globalDeleteRoomID = "";
    thisPage.funcsGetRoom();

    $("#deleteRoom").modal("hide");
  });
};

thisPage.funcsDeleteRoomImg = () => {
  let _img = thisPage.lstImgSrc.replace(thisPage.imgSrc + ";", "");

  let data = new FormData();
  data.append("room_id", thisPage.globalDeleteImgRoomID);
  data.append("img_rooms", _img);
  _doAjaxNod("POST", data, "room", "delete", "delete_img", true, (res) => {
    thisPage.globalDeleteImgRoomID = "";
    thisPage.imgSrc = ""; // dùng để lấy src_img muốn xóa
    thisPage.lstImgSrc = ""; // chứa tất cả src img , dùng để replace ảnh đã chọn và trả về 1 lst src img mới
    // thisPage.funcsGetRoom();
    $("#deleteImg").modal("hide");
  });
};

thisPage.funcsSaveBenefit = () => {
  let _benefit = "";

  $("input.group-create").each(function () {
    // kiểm tra từng input xem những cái nào đã được check để cộng dồn
    if ($(this).is(":checked")) _benefit += $(this).val() + ";";
  });

  // gán giá trị lấy được vào 1 biến benefits chứa chuỗi rỗng
  benefits = _benefit;
};
