$("body").on("click", ".staff.img_edit_staff", function (e) {
  let _id = $(this).attr("user-id");
  thisPage.funcsLoadDetailUser(_id);
});

$("body").on("click", ".staff.img_delete", function (e) {
  let _id = $(this).attr("user-id");
  $("#staff_delete_noti").html($("#list-user-" + _id).html());
  $("#deleteStaff").modal("show");
  thisPage.globalDeleteUserID = _id;
});

$("body").on("click", ".staff.img_reset", function (e) {
  let _id = $(this).attr("user-id");
  $("#staff_reset_noti").html($("#list-user-" + _id).html());
  $("#resetPassword").modal("show");
  thisPage.globalResetUserID = _id;
});

var thisPage = {};
thisPage.globalEditUserID = "";
thisPage.globalDeleteUserID = "";
thisPage.globalResetUserID = "";
thisPage.staffTXTSearching = $("#txt_searching");
thisPage.staffFullname = $("#staff_fullname");
thisPage.staffMobile = $("#staff_mobile");
thisPage.staffEmail = $("#staff_email");
thisPage.staffAddress = $("#staff_address");
thisPage.staffPassword = $("#staff_password");
thisPage.staffSLGid = $("#staff_sl_gid");
thisPage.staffBTNCreateUser = $("#btn_create_user");

thisPage.staffListUsers = $("#tpl_list_users");

$(function () {
  thisPage.staffSLGid.change(function () {
    thisPage.funcsLoadPermissionDefault();
  });

  thisPage.funcsFilterUser();

  $(".add_real.code_real").click(function () {
    thisPage.funcsToggleCreateUserForm();
    thisPage.emptyFormCreateUser();
    thisPage.funcsLoadPermissionDefault();
  });

  $(
    ".infomation_table.infomation_code i, button.btn-close-infomation_code"
  ).click(function () {
    thisPage.funcsToggleCreateUserForm();
  });

  thisPage.staffBTNCreateUser.click(function () {
    thisPage.funcsSaveUser();
  });

  thisPage.staffTXTSearching.keyup(function () {
    thisPage.funcsFilterUser();
  });

  $("#modal_delete_btn").click(function () {
    thisPage.funcsDeleteStaff();
  });

  $("#btn_reset_password").click(function () {
    thisPage.funcsResetPasswordStaff();
  });
});

thisPage.funcsToggleCreateUserForm = () => {
  $(".table-detail").toggle();
  $(".infomation_code").toggle();
  $(".search-order").toggle();
};

thisPage.funcsFilterUser = () => {
  var data = new FormData();
  data.append("keyword", thisPage.staffTXTSearching.val());
  _doAjaxNod("POST", data, "staff", "idx", "filter", false, (res) => {
    let _html = thisPage.funcsCreateTPLFilterUser(res.data);
    thisPage.staffListUsers.html(_html);
  });
};

thisPage.funcsCreateTPLFilterUser = (lItems) => {
  let _html = "";
  let i = 1;

  let reset_pass_permission = check_permission(":staffreset_password:");
  let edit_permission = check_permission(":staffsave:");
  let delete_permission = check_permission(":staffdelete:");
  lItems.forEach(function (item) {
    _html += ` <tr>
                    <td>${i++}</td>
                    <td>
                        <span id="list-user-${item.id}" class="dt-span">${
      item.fullname
    }</span>
                        <input type="text" name="" value="${
                          item.fullname
                        }" class="dt-select">
                    </td>
                    <td>
                        <span class="dt-span">${item.email}</span>
                        <input type="text" name="" value="${
                          item.email
                        }" class="dt-select">
                    </td>
                    <td>
                        <span class="dt-span">${item.mobile}</span>
                        <input type="text" name="" value="${
                          item.mobile
                        }" class="dt-select">
                    </td>
                    <td>
                        <span class="dt-span">${item.gid_name}</span>
                        <select id="staff_sl_gid" class="dt-select">
                            
                        </select>
                    </td>
                    <td>
                        ${
                          reset_pass_permission
                            ? `<img src="${domain}/public/images/reset.png" alt="" user-id="${item.id}" width="24" class="staff img_reset">`
                            : ""
                        }
                        ${
                          edit_permission
                            ? `<img src="${domain}/public/images/edit.png" alt="" user-id="${item.id}" width="24" class="staff img_edit_staff">`
                            : ""
                        }
                        <img src="${domain}/public/images/done.png" alt="" user-id="${
      item.id
    }" width="24" class="staff img_done">
                        ${
                          delete_permission
                            ? `<img src="${domain}/public/images/delete.png" alt="" user-id="${item.id}" width="24" class="staff img_delete">`
                            : ""
                        }
                    </td>
                </tr>`;
  });
  return _html;
};

thisPage.funcsLoadDetailUser = (_id) => {
  let data = new FormData();
  data.append("id", _id);
  _doAjaxNod("POST", data, "staff", "idx", "detail_user", true, (res) => {
    thisPage.globalEditUserID = res.data.id;
    thisPage.staffFullname.val(res.data.fullname);
    thisPage.staffMobile.val(res.data.mobile);
    thisPage.staffEmail.val(res.data.email);
    thisPage.staffAddress.val(res.data.address);
    thisPage.staffPassword.val("");
    thisPage.staffSLGid.val(res.data.gid);
    // thisPage.funcsTemplatePermission( res.data.permission );
    thisPage.funcsToggleCreateUserForm();
  });
};

thisPage.funcsLoadPermissionDefault = () => {
  let data = new FormData();
  data.append("gid", thisPage.staffSLGid.val());
  _doAjaxNod(
    "POST",
    data,
    "staff",
    "idx",
    "load_permission_default",
    false,
    (res) => {
      let l = res.data;
      // thisPage.funcsTemplatePermission( l );
    }
  );
};

thisPage.funcsResetPasswordStaff = () => {
  let data = new FormData();
  data.append("id", thisPage.globalResetUserID);
  _doAjaxNod(
    "POST",
    data,
    "staff",
    "reset_password",
    "reset_password",
    false,
    (res) => {
      $("#resetPassword").modal("hide");
    }
  );
};

// thisPage.funcsTemplatePermission = (l)=>{
//     $(".staff-create").prop("checked", false);
//     if ( l ) {
//         l = l.split(';');
//         l.forEach(function (item) {
//             if (isNumber(item))
//                 $("#staff-create-" + item).prop("checked", true);
//         })
//     }
// }

thisPage.funcsSaveUser = () => {
  let _fullname = thisPage.staffFullname.val();
  let _mobile = thisPage.staffMobile.val();
  let _email = thisPage.staffEmail.val();
  let _address = thisPage.staffAddress.val();
  let _password = thisPage.staffPassword.val();
  let _gid = thisPage.staffSLGid.val();
  let _permission = "";

  $(".staff-create").each(function () {
    if ($(this).is(":checked")) _permission += $(this).val() + ";";
  });

  if (_fullname == "") {
    alert_dialog("Vui lòng nhập họ tên");
  } else if (_mobile == "") {
    alert_dialog("Vui lòng nhập số điện thoại");
  } else {
    let data = new FormData();
    data.append("id", thisPage.globalEditUserID);
    data.append("fullname", _fullname);
    data.append("mobile", _mobile);
    data.append("email", _email);
    data.append("address", _address);
    data.append("password", _password);
    data.append("gid", _gid);
    data.append("permission", _permission);
    _doAjaxNod("POST", data, "staff", "save", "save_user", true, (res) => {
      thisPage.funcsToggleCreateUserForm();
      thisPage.globalEditUserID = "";
      thisPage.staffTXTSearching.val("");
      thisPage.funcsFilterUser();
    });
  }
};

thisPage.funcsDeleteStaff = () => {
  let data = new FormData();
  data.append("id", thisPage.globalDeleteUserID);
  _doAjaxNod("POST", data, "staff", "delete", "delete_user", true, (res) => {
    thisPage.globalDeleteUserID = "";
    thisPage.funcsFilterUser();
    $("#deleteStaff").modal("hide");
  });
};

thisPage.emptyFormCreateUser = () => {
  thisPage.staffFullname.val("");
  thisPage.staffMobile.val("");
  thisPage.staffEmail.val("");
  thisPage.staffAddress.val("");
  thisPage.staffPassword.val("");
  thisPage.staffSLGid.val("1");
  thisPage.globalEditUserID = "";
};

/*
- Manament group
*/
$("body").on("click", "img.gid-delete", function (e) {
  let _id = $(this).attr("gid");
  $("#gid_delete_noti").html($("#list-gid-" + _id).html());
  $("#deleteGID").modal("show");
  thisPage.globalDeleteGID = _id;
});

$("body").on("blur", "input.gid-name", function (e) {
  let _gid = $(this).attr("gid");
  let _val = $("#gid-name-" + _gid).val();
  let _old = $("#gid-name-" + _gid).attr("title");
  if (_old != _val) thisPage.funcsEditGID(_gid, _val);
});

//update permission
$("body").on("click", "input.group-create", function (e) {
  thisPage.funcsSaveGIDPermission();
});

// $('body').on('click', '.add_staff_group', function (e) {
//     $('.table-detail').toggle();
//     $('.infomation_add_staff').toggle();
//     $('.search-order').toggle();
// });
// $('body').on('click', '#infomation_gid_mgt', function (e) {
//     $('.table-detail').toggle();
//     $('.infomation_add_staff').toggle();
//     $('.search-order').toggle();
// });

thisPage.globalDeleteGID = "";
thisPage.gidName = $("#gid_name");
thisPage.gidBTNSave = $("#gid_btn_save");
thisPage.gidSLGID = $("#gid_sl_gid");
thisPage.gidTPLListGID = $("#tpl_list_gid");

$(function () {
  thisPage.gidBTNSave.click(function () {
    thisPage.funcsSaveGID();
  });

  thisPage.gidSLGID.change(function () {
    $("#checkallpermission").prop("checked", false);
    thisPage.funcsDetailGIDPermission();
  });

  $("#modal_gid_delete_btn").click(function () {
    thisPage.funcsDeleteGID();
  });

  $("#btn_add_staff_group").click(function () {
    $(".table-detail").hide();
    $(".infomation_group_staff").toggle();
    $(".infomation_code").hide();
    $(".search-order").hide();
  });

  $("#infomation_gid_mgt").click(function () {
    $(".table-detail").show();
    $(".infomation_group_staff").hide();
    $(".infomation_code").hide();
    $(".search-order").show();
  });

  $("#checkallpermission").click(function () {
    if (thisPage.gidSLGID.val() != "1") {
      if ($(this).is(":checked")) {
        $(".ace.group-create").each(function () {
          $(this).prop("checked", true);
        });
      } else {
        $(".ace.group-create").each(function () {
          $(this).prop("checked", false);
        });
      }
      thisPage.funcsSaveGIDPermission();
    }
  });

  thisPage.funcsDetailGIDPermission();
});

//Create gid
thisPage.funcsSaveGID = () => {
  let _name = thisPage.gidName.val();

  if (_name == "") {
    alert_dialog("Vui lòng nhập tên nhóm để tạo mới.");
  } else {
    let data = new FormData();
    data.append("name", _name);
    _doAjaxNod("POST", data, "staff", "gid", "gid_create", true, (res) => {
      thisPage.gidSLGID.html(res.data.opt_gid);
      thisPage.funcsFilterGID();
      thisPage.gidName.val("");
    });
  }
};

//execute delete
thisPage.funcsDeleteGID = () => {
  let data = new FormData();
  data.append("id", thisPage.globalDeleteGID);
  _doAjaxNod("POST", data, "staff", "gid", "gid_delete", true, (res) => {
    thisPage.globalDeleteGID = "";
    thisPage.funcsFilterGID();
    $("#deleteGID").modal("hide");
    thisPage.gidSLGID.html(res.data.opt_gid);
  });
};

//execute save
thisPage.funcsEditGID = (_id, _name) => {
  if (_name == "") {
    alert_dialog("Vui lòng nhập tên nhóm để tạo mới.");
  } else {
    let data = new FormData();
    data.append("id", _id);
    data.append("name", _name);
    _doAjaxNod("POST", data, "staff", "gid", "gid_edit", false, (res) => {
      alert_void("Đã lưu tên nhóm thành công.", 1);
      $("#gid-name-" + _id).attr("title", _name);
    });
  }
};

thisPage.funcsFilterGID = () => {
  _doAjaxNod("POST", "", "staff", "gid", "gid_filter", true, (res) => {
    $(".list-gid").remove();
    let _html = thisPage.funcsTPLCreate(res.data);
    thisPage.gidTPLListGID.before(_html);
  });
};

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

thisPage.funcsSaveGIDPermission = () => {
  let _permission = "";

  $("input.group-create").each(function () {
    if ($(this).is(":checked")) _permission += $(this).val() + ";";
    // alert($(this).is(":checked"));
  });
  let data = new FormData();
  data.append("id", thisPage.gidSLGID.val());
  data.append("permission", _permission);
  // _doAjaxNod(
  //   "POST",
  //   data,
  //   "staff",
  //   "gid",
  //   "gid_save_permission",
  //   false,
  //   (res) => {}
  // );
};

thisPage.funcsDetailGIDPermission = () => {
  let data = new FormData();
  data.append("id", thisPage.gidSLGID.val());
  _doAjaxNod("POST", data, "staff", "idx", "gid_permission", false, (res) => {
    if (thisPage.gidSLGID.val() != "1") {
      $(".group-create").prop("disabled", false);
      $(".group-create").prop("checked", false);
      if (res.data) {
        l = res.data.split(";");
        l.forEach(function (item) {
          if (isNumber(item)) $("#group-create-" + item).prop("checked", true);
        });
      }
    } else {
      $(".group-create").prop("checked", true);
      $(".group-create").prop("disabled", true);
    }
  });
};
