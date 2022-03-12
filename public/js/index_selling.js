var thisPage = {};

thisPage.txtSearching = $("#txt_searching");
thisPage.filterProvince = $("#filter_province");
thisPage.filterCity = $("#filter_city");
thisPage.filterStatus = $("#filter_status");
thisPage.tplListReal = $("#tpl_list_real");

thisPage.code = $("#code");
thisPage.title = $("#title");
thisPage.city_id = $("#city_id");
thisPage.address = $("#address");
thisPage.project_name = $("#project_name");
thisPage.selling_type_root = $("#selling_type_root");
thisPage.selling_type_id = $("#selling_type_id");
thisPage.acreage = $("#acreage");
thisPage.direction_house = $("#direction_house");
thisPage.direction_balcony = $("#direction_balcony");
thisPage.price = $("#price");
thisPage.selling_unit_id = $("#selling_unit_id");
thisPage.no_room = $("#no_room");
thisPage.no_toilet = $("#no_toilet");
thisPage.contact_name = $("#contact_name");
thisPage.contact_mobile = $("#contact_mobile");
thisPage.description = CKEDITOR.instances.editor;
thisPage.globalProductID = "";

thisPage.globalProductDeleteID = "";
thisPage.globalProductTopID = "";
thisPage.globalProductCloneID = "";
thisPage.globalProductHiddenID = "";

thisPage.inpAddNewProvince = $("#add-new-province");
thisPage.btnAddNewProvince = $("#save-new-province");
thisPage.btnProvinceDelete = $("#btn_province_delete");
thisPage.btnCityDelete = $("#btn_city_delete");
thisPage.globalProvinceDeleteID = "";
thisPage.globalCityDeleteID = "";
thisPage.globalProductIDROI = "";

$(function () {
  uploadFile("#file_uploading", "#hold_img_show");

  $("#hold_img_show").click(function () {
    $("#file_uploading").click();
  });

  $("#btn_add_real").click(function () {
    thisPage.funcsToggleProductForm();
    thisPage.emptyFormCreate();
    $(".avatar_thumbs img.img-responsive.img").parent().remove();
  });

  $(
    ".infomation_table.infomation_code i, button.btn-close-infomation_code"
  ).click(function () {
    thisPage.funcsToggleProductForm();
  });

  $(
    ".infomation_table.infomation_investors i, button.btn-close-infomation_investors"
  ).click(function () {
    thisPage.funcsToggleInvestor();
  });

  thisPage.filterProvince.change(function () {
    thisPage.funcsLoadCity();
  });

  $("#txt_searching, #filter_city, #filter_status").change(function () {
    thisPage.funcsFilter();
  });

  $("#tab_list_real").click(function () {
    thisPage.funcsInit();
  });

  $("#btn_product_delete").click(function () {
    thisPage.funcsRealDelete(thisPage.globalProductDeleteID);
  });

  $("#btn_product_top").click(function () {
    thisPage.funcsRealTop(thisPage.globalProductTopID);
  });

  $("#btn_product_clone").click(function () {
    thisPage.funcsRealClone(thisPage.globalProductCloneID);
  });
  $("#btn_product_hidden").click(function () {
    thisPage.funcsRealHidden(thisPage.globalProductHiddenID);
  });

  $("#btn_modify_product").click(function () {
    thisPage.funcsRealSave();
  });

  thisPage.funcsInit();

  $("#inp_slots_total, #inp_price").change(function () {
    let _total = 0;
    let _st = SplitNumber2(thisPage.inpSlotsTotal.val());
    let _pr = SplitNumber2(thisPage.inpPrice.val());
    thisPage.inpRootPrice.val(
      number_format(parseInt(_st) * parseInt(_pr), 0, ".", ",")
    );
  });
  $("#selling_type_root").change(function () {
    thisPage.loadOptionEditForm($(this).val());
  });
  thisPage.loadOptionEditForm(0);

  //nút thêm tỉnh/ thành: cố định
  thisPage.btnAddNewProvince.click(function () {
    thisPage.funcsProvinceAdd();
  });

  //Nút xóa tỉnh/ thành: cố định
  thisPage.btnProvinceDelete.click(function () {
    thisPage.funcsProvinceDelete(thisPage.globalProvinceDeleteID);
  });

  thisPage.btnCityDelete.click(function () {
    thisPage.funcsCityDelete(thisPage.globalCityDeleteID);
  });

  thisPage.inpAddNewProvince.keyup(function (e) {
    if (e.keyCode == 13) thisPage.funcsProvinceAdd();
  });

  $("#btn_roi").click(function () {
    $("#ROIProduct").modal("show");
    $("#ROI_password").val("");
  });
  $("#btn_product_roi").click(function () {
    thisPage.funcsROIDelivery();
  });
});

thisPage.funcsToggleProductForm = () => {
  $(".table-detail").toggle();
  $(".infomation_code").toggle();
  $(".search-order").toggle();
};

$("body").on("click", "img.product.img_edit_product", function (e) {
  let _product_id = $(this).attr("product-id");
  if (_product_id) thisPage.funcsRealDetail(_product_id);
});

$("body").on("click", "i.delete", function (e) {
  $(this).parent().remove();
});

$("body").on("click", "img.product.img_top_product", function (e) {
  let _product_id = $(this).attr("product-id");
  $("#topProduct").modal("show");
  $("#modal_product_top_name").html($("#product-" + _product_id).html());
  thisPage.globalProductTopID = _product_id;
});

$("body").on("click", "img.product.img_delete", function (e) {
  let _product_id = $(this).attr("product-id");
  $("#deleteProduct").modal("show");
  $("#modal_product_delete_name").html($("#product-" + _product_id).html());
  thisPage.globalProductDeleteID = _product_id;
});

$("body").on("click", "img.product.img-icon-clone", function (e) {
  let _product_id = $(this).attr("product-id");
  $("#cloneProduct").modal("show");
  $("#modal_product_clone_name").html($("#product-" + _product_id).html());
  thisPage.globalProductCloneID = _product_id;
});

$("body").on("click", "img.product.img-icon-hidden", function (e) {
  let _product_id = $(this).attr("product-id");
  let _is_hidden = $(this).attr("is_hidden");
  $("#hiddenProduct").modal("show");
  $("#modal_product_hidden_msg").html(
    _is_hidden == "0" ? "Ẩn sản phẩm sau" : "Hiển thị sản phẩm sau:"
  );
  $("#modal_product_hidden_name").html($("#product-" + _product_id).html());
  thisPage.globalProductHiddenID = _product_id;
});

thisPage.emptyFormCreate = () => {
  thisPage.code.val("");
  thisPage.title.val("");
  thisPage.address.val("");
  thisPage.project_name.val("");
  thisPage.acreage.val("");
  thisPage.price.val("");
  thisPage.no_room.val("");
  thisPage.no_toilet.val("");
  thisPage.contact_name.val("");
  thisPage.contact_mobile.val("");
  thisPage.selling_type_root.val("0");
  thisPage.direction_house.val("1");
  thisPage.direction_balcony.val("1");
  thisPage.description.setData("");
  thisPage.loadOptionEditForm(0);
  $(".avatar_thumbs img.img-responsive.img").parent().remove();
  thisPage.globalProductID = "";
  // $(".fee-items").remove();
};

//load init
thisPage.funcsInit = () => {
  _doAjaxNod("POST", "", "selling", "idx", "initial", true, (res) => {
    thisPage.filterProvince.html(res.data.opt_province);
    thisPage.city_id.html(res.data.opt_full_city);
    thisPage.funcsLoadCity();
  });
};

//load init
thisPage.loadOptionEditForm = (_root_id) => {
  // let data = new FormData();
  // data.append('root_id', _id)
  // _doAjaxNod('POST', data, 'selling', 'idx', 'opt', true, (res) => {
  //     thisPage.selling_type_id.html(res.data.opt_selling_type_id);
  //     thisPage.selling_unit_id.html(res.data.opt_selling_unit_id);
  // })
  // let _root_id = $("#selling_type_id").val();
  let _index = "";
  $("#selling_type_id option").hide();
  $("#selling_type_id option").each(function () {
    if (_root_id != "0") {
      if ($(this).attr("root-id") == _root_id) {
        $(this).show();
        if (_index == "") _index = $(this).attr("value");
      }
    } else {
      if ($(this).attr("root-id") == "-1") {
        $(this).show();
        if (_index == "") _index = $(this).attr("value");
      }
    }
  });
  $("#selling_type_id").val(_index);

  _index = "";
  $("#selling_unit_id option").hide();
  $("#selling_unit_id option").each(function () {
    if (_root_id != "0") {
      if ($(this).attr("root-id") == _root_id) {
        $(this).show();
        if (_index == "") _index = $(this).attr("value");
      }
    } else {
      if ($(this).attr("root-id") == "-1") {
        $(this).show();
        if (_index == "") _index = $(this).attr("value");
      }
    }
  });
  $("#selling_unit_id").val(_index);
};

//filter
thisPage.funcsFilter = () => {
  let data = new FormData();
  data.append("keyword", thisPage.txtSearching.val());
  data.append("province_id", thisPage.filterProvince.val());
  data.append("city_id", thisPage.filterCity.val());
  data.append("status", thisPage.filterStatus.val());
  _doAjaxNod("POST", data, "selling", "idx", "filter", true, (res) => {
    let _html = thisPage.funcsTPLListReal(res.data);
    thisPage.tplListReal.html(_html);
  });
};

//Save real
thisPage.funcsRealSave = () => {
  let _code = thisPage.code.val();
  let _title = thisPage.title.val();
  let _city_id = thisPage.city_id.val();
  let _address = thisPage.address.val();
  let _selling_type_root = thisPage.selling_type_root.val();
  let _selling_type_id = thisPage.selling_type_id.val();
  let _project_name = thisPage.project_name.val();
  let _acreage = thisPage.acreage.val();
  let _direction_house = thisPage.direction_house.val();
  let _direction_balcony = thisPage.direction_balcony.val();
  let _price = thisPage.price.val();
  let _selling_unit_id = thisPage.selling_unit_id.val();
  let _no_room = thisPage.no_room.val();
  let _no_toilet = thisPage.no_toilet.val();
  let _contact_name = thisPage.contact_name.val();
  let _contact_mobile = thisPage.contact_mobile.val();
  let _description = thisPage.description.getData();

  if (_code == "") {
    alert_dialog("Vui lòng nhập mã");
  } else if (_title == "") {
    alert_dialog("Vui lòng nhập tiêu đề");
  } else if (_price == "" || !isNumber(_price)) {
    alert_dialog("Vui lòng nhập giá là số nguyên");
  } else if (_contact_mobile == "") {
    alert_dialog("Vui lòng nhập số điện thoại liên hệ");
  } else {
    let _img = "";
    $(".avatar_thumbs img.img-responsive.img").each(function () {
      _img += $(this).attr("src") + ";";
    });

    let data = new FormData();
    data.append("id", thisPage.globalProductID);
    data.append("code", _code);
    data.append("title", _title);
    data.append("city_id", _city_id);
    data.append("address", _address);
    data.append("selling_type_root", _selling_type_root);
    data.append("selling_type_id", _selling_type_id);
    data.append("project_name", _project_name);
    data.append("acreage", _acreage);
    data.append("direction_house", _direction_house);
    data.append("direction_balcony", _direction_balcony);
    data.append("price", _price);
    data.append("selling_unit_id", _selling_unit_id);
    data.append("no_room", _no_room);
    data.append("no_toilet", _no_toilet);
    data.append("contact_name", _contact_name);
    data.append("contact_mobile", _contact_mobile);
    data.append("description", _description);
    data.append("img", _img);
    let _type_action = thisPage.globalProductID != "" ? "edit" : "add";
    _doAjaxNod(
      "POST",
      data,
      "selling",
      _type_action,
      _type_action,
      true,
      (res) => {
        thisPage.funcsFilter();
        thisPage.globalProductID = "";
        thisPage.funcsToggleProductForm();
      }
    );
  }
};

//up product to top of the list in api
thisPage.funcsRealTop = (_product_id) => {
  let data = new FormData();
  data.append("id", _product_id);
  _doAjaxNod("POST", data, "selling", "idx", "top", true, (res) => {
    thisPage.funcsFilter();
    $("#topProduct").modal("hide");
  });
};

//Get Detail real
thisPage.funcsRealDetail = (_product_id) => {
  let data = new FormData();
  data.append("product_id", _product_id);
  _doAjaxNod("POST", data, "selling", "idx", "detail", true, (res) => {
    //show the product to edit
    let d = res.data;

    thisPage.code.val(d.code);
    thisPage.title.val(d.title);
    thisPage.city_id.val(d.city_id);
    thisPage.address.val(d.address);
    thisPage.selling_type_root.val(d.selling_type_root);
    thisPage.loadOptionEditForm(d.selling_type_root);
    thisPage.selling_type_id.val(d.selling_type_id);
    thisPage.project_name.val(d.project_name);
    thisPage.acreage.val(d.acreage);
    thisPage.direction_house.val(d.direction_house);
    thisPage.direction_balcony.val(d.direction_balcony);
    thisPage.price.val(number_format(d.price, 0, ".", ","));
    thisPage.selling_unit_id.val(d.selling_unit_id);
    thisPage.no_room.val(number_format(d.no_room, 0, ".", ","));
    thisPage.no_toilet.val(number_format(d.no_toilet, 0, ".", ","));
    thisPage.contact_name.val(d.contact_name);
    thisPage.contact_mobile.val(d.contact_mobile);
    thisPage.description.setData(d.description);
    $(".avatar_thumbs img.img-responsive.img").parent().remove();

    let img = d.img.split(";");
    let _h_img = "";
    if (img && img.length > 0) {
      img.forEach(function (it) {
        if (it && it != "")
          _h_img += `<a class="col-md-2 img"><img src="${it}" class="img-responsive img"><i class="delete">x</i><i title="Đặt làm ảnh đại diện" class="main-pic"><img src="${domain}/public/images/up.png"/></i></a>`;
      });
      $("#hold_img_show").after(_h_img);
    }

    thisPage.funcsToggleProductForm();
    thisPage.globalProductID = res.data.id;
  });
};

//Delete real
thisPage.funcsRealDelete = (_id) => {
  let data = new FormData();
  data.append("id", _id);
  _doAjaxNod("POST", data, "selling", "delete", "delete", false, (res) => {
    thisPage.funcsFilter();
    $("#deleteProduct").modal("hide");
  });
};

//clone
thisPage.funcsRealClone = (_id) => {
  let data = new FormData();
  data.append("id", _id);
  _doAjaxNod("POST", data, "selling", "clone", "clone", false, (res) => {
    thisPage.funcsFilter();
    $("#cloneProduct").modal("hide");
  });
};

//hidden
thisPage.funcsRealHidden = (_id) => {
  let data = new FormData();
  data.append("id", _id);
  _doAjaxNod("POST", data, "selling", "hidden", "hidden", false, (res) => {
    thisPage.funcsFilter();
    $("#hiddenProduct").modal("hide");
  });
};

thisPage.funcsLoadCity = () => {
  let data = new FormData();
  data.append("province_id", thisPage.filterProvince.val());
  _doAjaxNod("POST", data, "product", "idx", "load_city", true, (res) => {
    thisPage.filterCity.html(res.data.opt_city);
    thisPage.funcsFilter();
  });
};

thisPage.funcsTPLListReal = (l) => {
  let _html = "";
  if (l) {
    let permission_edit = check_permission(":sellingedit:");
    let permission_delete = check_permission(":sellingdelete:");
    let permission_clone = check_permission(":sellingclone:");
    let permission_hidden = check_permission(":sellinghidden:");

    let i = 1;
    l.forEach(function (item) {
      _html += ` <tr>
                        <td>
                            <img title="Đặt sản phẩm lên đầu" product-id="${
                              item.id
                            }" src="${domain}/public/images/toparrow.png" alt="" width="24" class="product img_top_product">
                            ${i++}
                        </td>
                        <td class="code_real investors" product-id="${
                          item.id
                        }" status="${item.status}">${
        item.status == 1 ? `<strike>${item.code}</strike>` : item.code
      }</td>
                        <td id="product-${item.id}">${item.title}</td>
                        <td>
                            <span class="dt-span">${item.province_name}</span>
                        </td>
                        <td>
                            <span class="dt-span">${number_format(
                              item.price,
                              0,
                              ".",
                              ","
                            )}</span>
                        </td>
                        <td>
                            <span class="dt-span">${number_format(
                              item.acreage,
                              0,
                              ".",
                              ","
                            )}</span>
                        </td>
                        <td class="table-product-icon">
                            ${
                              permission_edit
                                ? `<img title="Cập nhật sản phẩm" product-id="${item.id}" src="${domain}/public/images/edit.png" alt="" width="24" class="product img_edit_product">`
                                : ""
                            }
                            <img product-id="${
                              item.id
                            }" title="" src="${domain}/public/images/done.png" alt="" width="24" class="product img_done">
                            ${
                              permission_delete
                                ? `<img title="Xóa sản phẩm" product-id="${item.id}" src="${domain}/public/images/delete.png" alt="" width="24" class="product img_delete">`
                                : ""
                            }
                            ${
                              permission_clone
                                ? `<img title="Sao chép sản phẩm" product-id="${item.id}" src="${domain}/public/images/clone.png" alt="" width="24" class="product img-icon-clone">`
                                : ""
                            }
                            ${
                              permission_hidden
                                ? item.is_hidden == "1"
                                  ? `<img is_hidden="${item.is_hidden}" title="Hiển thị sản phẩm" product-id="${item.id}" src="${domain}/public/images/hidden.png" alt="" width="24" class="product img-icon-hidden">`
                                  : `<img title="Ẩn sản phẩm" is_hidden="${item.is_hidden}" product-id="${item.id}" src="${domain}/public/images/nohidden.png" alt="" width="24" class="product img-icon-hidden">`
                                : ""
                            }
                        </td>
                    </tr>`;
    });
  }
  return _html;
};

/*
- BEGIN Province
*/
$("body").on("blur", "input.province-name", function (e) {
  let _province_id = $(this).attr("province-id");
  thisPage.funcsProvinceSave(_province_id);
});

$("body").on("click", "img.province-delete", function (e) {
  let _province_id = $(this).attr("province-id");
  $("#deleteProvince").modal("show");
  $("#modal_province_delete_name").html($("#province-" + _province_id).val());
  thisPage.globalProvinceDeleteID = _province_id;
});

thisPage.funcsProvinceAdd = () => {
  let _name = thisPage.inpAddNewProvince.val();
  if (_name != "") {
    let data = new FormData();
    data.append("name", _name);
    _doAjaxNod(
      "POST",
      data,
      "product",
      "province",
      "province_add",
      true,
      (res) => {
        thisPage.inpAddNewProvince.val("");
        let item = res.data;
        let _html = `<div id="list-province-${item.id}" class="item">
                            <div class="wrap-title">
                                <div class="title">
                                    <input class="province-name" province-id="${item.id}" id="province-${item.id}" type="text" name="" value="${item.name}" title="${item.name}">
                                    <span class="down"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                                    <span class="up"><i class="fa fa-angle-up" aria-hidden="true"></i></span>
                                </div>
                                <img class="province-delete" province-id="${item.id}" src="${domain}/public/images/delete.png" alt="" width="24" >
                            </div>
                            <ul class="sub">
                                <li id="list-city-add-province-${item.id}" ><input class="city-add-province" province-id="${item.id}" id="city-add-province-${item.id}" placeholder="Thêm quận/ huyện" type="text" name="" value=""><img class="city-add" province-id="${item.id}" src="${domain}/public/images/done.png" alt="" width="24"></li>
                            </ul>
                        </div>`;
        $("#province-item-add").before(_html);
      }
    );
  }
};

thisPage.funcsProvinceSave = (_province_id) => {
  let _name = $("#province-" + _province_id).val();
  let _old = $("#province-" + _province_id).attr("title");
  if (_old != _name) {
    if (_name == "") {
      alert_dialog("Tên tỉnh/ thành không được bỏ trống.");
    } else {
      let data = new FormData();
      data.append("id", _province_id);
      data.append("name", _name);
      _doAjaxNod(
        "POST",
        data,
        "product",
        "province",
        "province_save",
        false,
        (res) => {
          alert_void("Đã lưu tỉnh/ thành thành công.", 1);
          $("#province-" + _province_id).attr("title", _name);
        }
      );
    }
  }
};

thisPage.funcsProvinceDelete = (_province_id) => {
  let data = new FormData();
  data.append("id", thisPage.globalProvinceDeleteID);
  _doAjaxNod(
    "POST",
    data,
    "product",
    "province",
    "province_delete",
    true,
    (res) => {
      $("#list-province-" + _province_id).remove();
      $("#deleteProvince").modal("hide");
    }
  );
};

$("body").on("click", "img.city-add", function (e) {
  let _province_id = $(this).attr("province-id");
  thisPage.funcsCityAdd(_province_id);
});

$("body").on("keyup", "input.city-add-province", function (e) {
  if (e.keyCode == 13) {
    let _province_id = $(this).attr("province-id");
    thisPage.funcsCityAdd(_province_id);
  }
});

$("body").on("blur", "input.city-name", function (e) {
  let _city_id = $(this).attr("city-id");
  thisPage.funcsCitySave(_city_id);
});

$("body").on("click", "img.city-delete", function (e) {
  let _city_id = $(this).attr("city-id");
  $("#deleteCity").modal("show");
  $("#modal_city_delete_name").html($("#city-name-" + _city_id).val());
  thisPage.globalCityDeleteID = _city_id;
});

thisPage.funcsCityAdd = (_province_id) => {
  let _name = $("#city-add-province-" + _province_id).val();
  if (_name != "") {
    let data = new FormData();
    data.append("province_id", _province_id);
    data.append("name", _name);
    _doAjaxNod("POST", data, "product", "city", "city_add", true, (res) => {
      let item = res.data;
      let _html = `<li id="list-city-${item.id}">
                            <input id="city-name-${item.id}" city-id="${item.id}" class="city-name" type="text" name="" value="${item.name}" title="${item.name}">
                            <img class="city-delete" city-id="${item.id}" src="${domain}/public/images/delete.png" alt="" width="24">
                        </li>`;
      $("#list-city-add-province-" + _province_id).before(_html);
      $("#city-add-province-" + _province_id).val("");
    });
  }
};

thisPage.funcsCitySave = (_city_id) => {
  let _name = $("#city-name-" + _city_id).val();
  let _old = $("#city-name-" + _city_id).attr("title");
  if (_name != _old) {
    if (_name == "") {
      alert_dialog("Tên quận/ huyện không được bỏ trống.");
    } else {
      let data = new FormData();
      data.append("id", _city_id);
      data.append("name", _name);
      _doAjaxNod("POST", data, "product", "city", "city_save", false, (res) => {
        alert_void("Đã lưu quận/ huyện thành công.", 1);
        $("#city-name-" + _city_id).attr("title", _name);
      });
    }
  }
};

thisPage.funcsCityDelete = (_city_id) => {
  let data = new FormData();
  data.append("id", thisPage.globalCityDeleteID);
  _doAjaxNod("POST", data, "product", "city", "city_delete", true, (res) => {
    $("#list-city-" + _city_id).remove();
    $("#deleteCity").modal("hide");
  });
};
/*
- END Province
*/

thisPage.funcsROIDelivery = () => {
  let _password = $("#ROI_password").val();

  if (_password != "") {
    let data = new FormData();
    data.append("product_id", thisPage.globalProductIDROI);
    data.append("password", _password);
    _doAjaxNod(
      "POST",
      data,
      "product",
      "ROI",
      "execute_ROI_principal",
      true,
      (res) => {
        thisPage.globalProductIDROI = "";
        $("#ROIProduct").modal("hide");
      }
    );
  } else {
    alert_dialog("Vui lòng nhập mật khẩu xác nhập");
  }
};

/*
- BEGIN Fee function
*/
// $('body').on('click', 'img.btn-fee-delete', function (e) {
//     $(this).parent().parent().parent().remove();
//     thisPage.funcsCalTotalFee();
// });

// $('body').on('blur', 'input.number-format.fee-fields', function (e) {
//     thisPage.funcsCalTotalFee();

//     let value = $(this).val();
//     let number = SplitNumber2(value);
//     if (isNumber(number)) {
//         $(this).val(number_format(number, 0, '.', ','));
//     }

// });

// $(".label_append").click(function () {
//     let _id = parseInt(Math.random() * 100000000);

//     $(".append_cost > .row").append(`<div class='col-md-6 col-sm-6 col-xs-12 fee-items'>
//                                     <div class='row relative'>
//                                         <div class='col-md-6 col-sm-6 col-xs-12'>
//                                             <input id="fee-label-${_id}" class='form-control label_name1' type='text' placeholder='Tên chi phí'></label>
//                                         </div>
//                                         <div class='col-md-6 col-sm-6 col-xs-12'>
//                                             <div class='input_name input_name1'>
//                                                 <input class='form-control number-format fee-fields' lable-id="${_id}" type='text' name='' placeholder='Giá trị'>
//                                             </div>
//                                         </div>
//                                         <label class='label_name_delete' style='margin-top: 16px;cursor: pointer;'>
//                                             <img src='${domain}/public/images/delete.png' class="btn-fee-delete" width='24' style='margin-top: 16px;cursor: pointer;position: absolute;top: 2px;right: 0px;'>
//                                         </label>
//                                     </div>
//                                 </div>`);
// });

// thisPage.funcsCalTotalFee = () => {
//     let _total = 0;
//     $("input.number-format.fee-fields").each(function () {
//         let _val = SplitNumber2($(this).val());
//         if (_val != '' && isNumber(_val)) {
//             _total += parseInt(_val);
//         }
//     })
//     thisPage.inpFeeTotal.val(number_format(_total, 0, '.', ','));
// }

/*
- END Fee function
*/

thisPage.globalProductHistoryID = "";
thisPage.globalPricePerSlots = 0;
//id product dang chinh trong transaction history: thisPage.globalProductIDROI
thisPage.inpPHName = $("#inp_product_history_name");
thisPage.inpPHBought = $("#inp_product_history_bought");
thisPage.inpPHBoughtValue = $("#inp_product_history_bought_value");
thisPage.inpPHBalance = $("#inp_product_history_balance");
thisPage.inpPHAmount = $("#inp_product_history_amount");
thisPage.inpPHValue = $("#inp_product_history_value");
thisPage.btnPHExcute = $("#btn_product_history_excute");

// refund record invesment of the product
$("body").on("click", ".img_edit_investment.excute", function (e) {
  let _product_history_id = $(this).attr("item-id"); //_product_history_id
  thisPage.funcsDetailProductHistory(_product_history_id);
});

$("body").on("click", ".img_delete_investment.excute", function (e) {
  let _product_history_id = $(this).attr("item-id"); //_product_history_id
  // thisPage.funcsDeleteProductHistory(_product_history_id);
  let _fullname = $("#item-fullname-" + _product_history_id).html();
  let _slots = $("#item-slots-" + _product_history_id).html();
  $("#modal_product_history_delete").html(_slots + " suất của " + _fullname);
  $("#deleteProductHistory").modal("show");
  thisPage.globalProductHistoryID = _product_history_id;
});

$("body").on("click", ".table_investment_edit .fa.fa-angle-left", function (e) {
  thisPage.funcsToggleRefund(0);
});

$("body").on("click", "#add_export_buy", function (e) {
  thisPage.inpPHName.val("");
  thisPage.inpPHName.attr("username", "");
  thisPage.inpPHName.prop("disabled", false);
  thisPage.inpPHBought.val("0");
  thisPage.inpPHBoughtValue.val("0");
  thisPage.inpPHBalance.val("0");
  thisPage.inpPHAmount.val("");
  thisPage.inpPHValue.val("0");

  thisPage.funcsToggleRefund(0);
});

$(".btn-close-investment_edit").click(function () {
  thisPage.funcsToggleRefund(0);
});

$(function () {
  $("#btn_product_history_delete").click(function () {
    thisPage.funcsModifyProductHistory(0, 1);
  });

  $("#btn_product_history_excute").click(function () {
    if (thisPage.globalProductHistoryID == "") {
      //thêm
      thisPage.funcsAddProductHistory();
    } else {
      //edit
      let _amount = thisPage.inpPHAmount.val();
      if (_amount == "") _amount = "0";
      _amount = parseInt(SplitNumber2(_amount));

      let _bought = thisPage.inpPHBought.val();
      _bought = parseInt(SplitNumber2(_bought));

      if (_amount == 0) {
        alert_dialog("Vui lòng nhập số suất muốn trả lại tiền");
      } else if (_amount > _bought || _amount < 1) {
        alert_dialog("Số lượng suất trả phải nhỏ hơn số suất hiện đang có.");
      } else thisPage.funcsModifyProductHistory(_amount, 0); //edit
    }
  });

  thisPage.inpPHAmount.change(function () {
    let _slots = $(this).val();
    if (_slots == "") _slots = 0;
    _slots = parseInt(SplitNumber2(_slots));
    let _total = thisPage.globalPricePerSlots * _slots;
    thisPage.inpPHValue.val(number_format(_total, 0, ".", ","));
  });
});

thisPage.inpPHName.autocomplete({
  minLength: 1,
  option: "appendTo",
  source: function (request, response) {
    var keyword = thisPage.inpPHName.val();

    let data = new FormData();
    data.append("keyword", keyword);
    _doAjaxNod(
      "POST",
      data,
      "product",
      "product_history",
      "search_investor",
      true,
      (res) => {
        response(
          $.map(res.data, function (el) {
            return {
              label: el.fullname + " (" + el.username + ")",
              fullname: el.fullname,
              value: "",
              username: el.username,
            };
          })
        );
      }
    );
  },
  select: function (e, ui) {
    //add items
    setTimeout(() => {
      thisPage.inpPHName.val(ui.item.fullname);
      thisPage.inpPHName.attr("username", ui.item.username);
    }, 300);

    thisPage.funcsDetailInvestorProductHistory(ui.item.username);
  },
});

thisPage.funcsToggleRefund = (_is_refund) => {
  $(".table_investment").toggle();
  $(".table_investment_edit").toggle();
  $("#tpl_refund_holder").hide();
  $("#inp_product_history_amount_label").html("Số suất cần tạo");
  if (_is_refund == 1) {
    $("#tpl_refund_holder").show();
    $("#inp_product_history_amount_label").html("Số suất muốn refund");
  }
};

thisPage.funcsDetailProductHistory = (_product_history_id) => {
  let data = new FormData();
  data.append("id", _product_history_id);
  _doAjaxNod(
    "POST",
    data,
    "product",
    "product_history",
    "detail",
    true,
    (res) => {
      //cần trả về balance tổng của acc admin
      // số lượng suất đang còn lại của user này
      thisPage.inpPHName.val(res.data.fullname);
      thisPage.inpPHName.attr("username", res.data.username);
      thisPage.inpPHName.prop("disabled", true);
      thisPage.inpPHBought.val(number_format(res.data.slots, 0, ".", ","));
      thisPage.inpPHBoughtValue.val(number_format(res.data.total, 0, ".", ","));
      thisPage.inpPHBalance.val(number_format(res.data.balance, 0, ".", ","));
      thisPage.inpPHAmount.val("");
      thisPage.inpPHValue.val("0");

      thisPage.globalPricePerSlots = res.data.price;

      thisPage.globalProductHistoryID = _product_history_id;

      thisPage.funcsToggleRefund(1);
    }
  );
};

thisPage.funcsDetailInvestorProductHistory = (_username) => {
  let data = new FormData();
  data.append("product_id", thisPage.globalProductIDROI);
  data.append("username", _username);
  _doAjaxNod(
    "POST",
    data,
    "product",
    "product_history",
    "detail_investor",
    true,
    (res) => {
      // số lượng suất đang còn lại của user này
      thisPage.inpPHName.val(res.data.fullname);
      thisPage.inpPHName.attr("username", res.data.username);
      thisPage.inpPHBought.val(number_format(res.data.slots, 0, ".", ","));
      thisPage.inpPHBoughtValue.val(number_format(res.data.total, 0, ".", ","));
      thisPage.inpPHBalance.val(number_format(res.data.balance, 0, ".", ","));
      thisPage.inpPHAmount.val("");
      thisPage.inpPHValue.val("0");

      thisPage.globalPricePerSlots = res.data.price;
    }
  );
};

thisPage.funcsModifyProductHistory = (_amount, _is_delete) => {
  //_type = 1 refund all; = 0 by amount
  let data = new FormData();
  data.append("id", thisPage.globalProductHistoryID);
  data.append("amount", _amount);
  data.append("is_delete", _is_delete);
  _doAjaxNod(
    "POST",
    data,
    "product",
    "product_history",
    "modify",
    true,
    (res) => {
      //chuyển record thành hủy toàn bộ hoặc hủy 1 phần; đổi với trường hợp hủy 1 phần, tạo record hủy với số lượng đã chọn với thông tin từ record chính

      $("#deleteProductHistory").modal("hide");
      thisPage.funcsListInvestor(thisPage.globalProductIDROI);
      thisPage.globalProductHistoryID = "";
    }
  );
};

thisPage.funcsAddProductHistory = () => {
  let _amount = thisPage.inpPHAmount.val();
  if (_amount == "") _amount = "0";
  _amount = parseInt(SplitNumber2(_amount));
  let _total = thisPage.globalPricePerSlots * _amount;
  let _fullname = thisPage.inpPHName.val();
  let _username = thisPage.inpPHName.attr("username");

  let _balance = thisPage.inpPHBalance.val();
  _balance = parseInt(SplitNumber2(_balance));

  if (_username == "" || _username == null) {
    alert_dialog("Vui lòng chọn nhà đầu tư");
  } else if (_amount == 0) {
    alert_dialog("Vui lòng nhập số suất muốn trả lại tiền");
  } else if (_balance < _total) {
    alert_dialog("Số dư không đủ thực hiện giao dịch");
  } else {
    let data = new FormData();
    data.append("username", _username);
    data.append("fullname", _fullname);
    data.append("amount", _amount);
    data.append("total", _total);
    data.append("product_id", thisPage.globalProductIDROI);
    _doAjaxNod(
      "POST",
      data,
      "product",
      "product_history",
      "new_record",
      true,
      (res) => {
        $("#deleteProductHistory").modal("hide");

        thisPage.funcsToggleRefund(0);

        thisPage.funcsListInvestor(thisPage.globalProductIDROI);
      }
    );
  }
};

$("body").on("click", "i.main-pic", function () {
  let theSelected = $(this).prev().prev();
  let theDefault = $(".avatar_thumbs.row a:nth-child(2) img:nth-child(1)");
  let url = theSelected.attr("src");
  theSelected.attr("src", theDefault.attr("src"));
  theDefault.attr("src", url);
});
