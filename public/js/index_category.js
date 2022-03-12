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

  thisPage.staffTXTSearching.keyup(function () {
    thisPage.funcsFilterUser();
  });

  $("#btn_reset_password").click(function () {
    thisPage.funcsResetPasswordStaff();
  });

  // CATAGORY HOTEL
  thisPage.funcsGetCategoryHotel();

  // mở form thêm mới khách sạn
  $(".add_real.code_real").click(function () {
    thisPage.funcsToggleCreateCategoryForm();
    thisPage.emptyFormCreateCategory();
    thisPage.funcsLoadPermissionDefault();
  });

  // xử lý sự kiện save  : thêm hoặc update thông tin hotel
  thisPage.categoryBTNCreate.click(function () {
    thisPage.funcsSaveCategory();
  });

  $(
    ".infomation_table.infomation_code i, button.btn-close-infomation_code"
  ).click(function () {
    thisPage.funcsToggleCreateCategoryForm();
  });

  $("#modal_delete_btn").click(function () {
    thisPage.funcsDeleteCategory();
  });
});

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

//  XỬ LÝ SỰ KIỆN JS DOM của CATEGORY

// category
thisPage.globalEditCategoryID = "";
thisPage.globalDeleteCategoryID = "";
thisPage.categoryName = $("#name");
thisPage.categoryDescription = $("#description");
thisPage.categoryImage = $("#image");
thisPage.categoryBTNCreate = $("#btn_create_category");
thisPage.categoryList = $("#tpl_list_category_hotel");
// thisPage.hotelCategoryHotel = $('#staff_sl_category_hotel');

$("body").on("click", ".staff.img_edit_category", function (e) {
  let _id = $(this).attr("category-id");
  thisPage.funcsLoadDetailCategory(_id);
});

$("body").on("click", ".staff.img_delete", function (e) {
  let _id = $(this).attr("category-id");
  $("#staff_delete_noti").html($("#list-user-" + _id).html());
  $("#deleteCategory").modal("show");
  thisPage.globalDeleteCategoryID = _id;
});

thisPage.funcsGetCategoryHotel = () => {
  // var data = new FormData();
  // data.append('keyword', thisPage.staffTXTSearching.val() )
  _doAjaxNod("POST", "", "category_hotel", "idx", "get_all", false, (res) => {
    let _html = thisPage.funcsCreateTPLGetCategory(res.data);
    thisPage.categoryList.html(_html);
  });
};

thisPage.funcsCreateTPLGetCategory = (lItems) => {
  let _html = "";
  let i = 1;

  let edit_permission = check_permission(":staffsave:");
  let delete_permission = check_permission(":staffdelete:");
  lItems.forEach(function (item) {
    _html += ` <tr>
                    <td>${i++}</td>
                    <td>
                        <span id="${item.category_id}" class="dt-span">${
      item.name
    }</span>
                        <input type="text" name="" value="${
                          item.name
                        }" class="dt-select">
                    </td>
                    <td>
                        <span class="dt-span">${item.image}</span>
                        <input type="text" name="" value="${
                          item.image
                        }" class="dt-select">
                    </td>
                    
                    <td>
                        <span class="dt-span">${item.description}</span>
                        <input type="text" name="" value="${
                          item.description
                        }" class="dt-select">
                    </td>
                    <td>
                    <img src="${domain}/public/images/edit.png" alt="" category-id="${
      item.category_id
    }" width="24" class="staff img_edit_category">
                    <img src="${domain}/public/images/delete.png" alt="" category-id="${
      item.category_id
    }" width="24" class="staff img_delete">
                       
                    </td>
                </tr>`;
  });
  return _html;
};

//  XỬ LÝ THAO TÁC MỞ FORM  : THÊM , UPDATE

thisPage.funcsToggleCreateCategoryForm = () => {
  $(".table-detail").toggle();
  $(".infomation_code").toggle();
  $(".search-order").toggle();
};

//  SHOW FORM UPDATE
thisPage.funcsLoadDetailCategory = (_id) => {
  let data = new FormData();
  data.append("category_id", _id);
  _doAjaxNod(
    "POST",
    data,
    "category_hotel",
    "idx",
    "detail_category",
    true,
    (res) => {
      thisPage.globalEditCategoryID = res.data.category_id;
      thisPage.categoryName.val(res.data.name);
      thisPage.categoryImage.val(res.data.image);
      thisPage.categoryDescription.val(res.data.description);
      thisPage.funcsToggleCreateCategoryForm();
    }
  );
};

thisPage.emptyFormCreateCategory = () => {
  thisPage.categoryName.val("");
  thisPage.categoryImage.val("");
  thisPage.categoryDescription.val("");
  thisPage.globalEditCategoryID = "";
};

thisPage.funcsSaveCategory = () => {
  let _category_name = thisPage.categoryName.val();
  let _category_image = thisPage.categoryImage.val();
  let _category_description = thisPage.categoryDescription.val();

  if (_category_name == "") {
    alert_dialog("Vui lòng nhập tên loại khách sạn");
  } else if (_category_image == "") {
    alert_dialog("Vui lòng nhập hình ảnh về khách sạn");
  } else if (_category_description == "") {
    alert_dialog("Vui lòng nhập mô tả khách sạn");
  } else {
    let data = new FormData();
    data.append("category_id", thisPage.globalEditCategoryID);
    data.append("name", _category_name);
    data.append("image", _category_image);
    data.append("description", _category_description);

    _doAjaxNod(
      "POST",
      data,
      "category_hotel",
      "save",
      "save_category",
      true,
      (res) => {
        thisPage.globalEditCategoryID = "";
        thisPage.funcsGetCategoryHotel();
        thisPage.funcsToggleCreateCategoryForm();
      }
    );
  }
};

thisPage.funcsDeleteCategory = () => {
  let data = new FormData();
  data.append("category_id", thisPage.globalDeleteCategoryID);

  _doAjaxNod(
    "POST",
    data,
    "category_hotel",
    "delete",
    "delete_category",
    true,
    () => {
      thisPage.globalDeleteCategoryID = "";
      thisPage.funcsGetCategoryHotel();

      $("#deleteCategory").modal("hide");
    }
  );
};
