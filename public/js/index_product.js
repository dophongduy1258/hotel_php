var thisPage = {};

thisPage.txtSearching = $("#txt_searching");
thisPage.filterProvince = $("#filter_province");
thisPage.filterCity = $("#filter_city");
thisPage.filterStatus = $("#filter_status");
thisPage.tplListReal = $("#tpl_list_real");

thisPage.inpCode = $("#inp_code");
thisPage.inpTitle = $("#inp_title");
thisPage.slCity = $("#sl_city");
thisPage.inpSlotsTotal = $("#inp_slots_total");
thisPage.inpPrice = $("#inp_price");
thisPage.inpSlotsSold = $("#inp_slots_sold");
thisPage.slStatus = $("#sl_status");
thisPage.inpRootPrice = $("#inp_root_price");
thisPage.inpPriceSold = $("#inp_price_sold");
thisPage.inpReceiveFundAccount = $("#inp_receive_fund_account");
thisPage.inpReceiveFundFullname = $("#inp_receive_fund_fullname");
thisPage.inpFeeTotal = $("#inp_fee_total");
thisPage.inpDescription = CKEDITOR.instances.editor;
thisPage.globalProductID = "";

thisPage.globalProductDeleteID = "";
thisPage.globalProducTopID = "";
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
    thisPage.funcsRealTop(thisPage.globalProducTopID);
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

  //n??t th??m t???nh/ th??nh: c??? ?????nh
  thisPage.btnAddNewProvince.click(function () {
    thisPage.funcsProvinceAdd();
  });

  //N??t x??a t???nh/ th??nh: c??? ?????nh
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

// End Update New
$("body").on("click", ".code_real.investors", function (e) {
  let _product_id = $(this).attr("product-id");
  let _status = $(this).attr("status");
  if (_status == "1") {
    $("#btn_roi").show();
  } else {
    $("#btn_roi").hide();
  }
  $(".tpl_product_name").html($("#product-" + _product_id).html());
  thisPage.funcsListInvestor(_product_id);
});

thisPage.funcsListInvestor = (_product_id) => {
  let data = new FormData();
  data.append("product_id", _product_id);
  _doAjaxNod("POST", data, "product", "idx", "list_investor", true, (res) => {
    let _html = "";
    let l = res.data;
    let i = 1;

    let _total_slots = 0;
    let _total_root = 0;
    let _total_ROI = 0;
    let _total_total = 0;

    if (l) {
      let permission_edit = check_permission(":productproduct_history:");
      // let permission_delete   = check_permission(":productproduct_history:");
      l.forEach(function (it) {
        if (it.status != "-1") {
          _html += `<tr>
                            <td>${i++}</td>
                            <td id="item-fullname-${it.id}">${it.fullname}</td>
                            <td>
                                ${date_format_full(it.created_at)}
                            </td>
                            <td>
                                <span id="item-slots-${
                                  it.id
                                }" class="dt-span">${it.slots}</span>
                            </td>
                            <td>
                                <span class="dt-span">${number_format(
                                  parseInt(it.slots) * parseInt(it.price),
                                  0,
                                  ".",
                                  ","
                                )}</span>
                            </td>
                            <td>
                                ${number_format(
                                  parseInt(it.slots) *
                                    parseInt(it.price) *
                                    parseFloat(it.ROI),
                                  0,
                                  ".",
                                  ","
                                )}
                            </td>
                            <td>
                                ${number_format(
                                  parseInt(it.slots) *
                                    parseInt(it.price) *
                                    parseFloat(it.ROI) +
                                    parseInt(it.slots) * parseInt(it.price),
                                  0,
                                  ".",
                                  ","
                                )}
                            </td>
                            <td>
                                ${
                                  permission_edit
                                    ? `<img item-id="${it.id}" src="${domain}/public/images/edit.png" alt="" width="24" class="img_edit_investment excute" style="margin-right:2px;">`
                                    : ""
                                }
                                ${
                                  permission_edit
                                    ? `<img item-id="${it.id}" src="${domain}/public/images/delete.png" alt="" style="margin-right:2px;" width="24" class="img_delete_investment excute">`
                                    : ""
                                }
                            </td>
                        </tr>`;

          _total_slots += parseInt(it.slots);
          _total_root += parseInt(it.slots) * parseInt(it.price);
          _total_ROI +=
            parseInt(it.slots) * parseInt(it.price) * parseFloat(it.ROI);
          _total_total +=
            parseInt(it.slots) * parseInt(it.price) * parseFloat(it.ROI) +
            parseInt(it.slots) * parseInt(it.price);
        } else {
          _html += `<tr title="???? h???y v?? tr??? l???i ti???n cho nh?? ?????u t??" class="refunded">
                                <td>${i++}</td>
                                <td>${it.fullname}</td>
                                <td>${date_format_full(it.created_at)}</td>
                                <td><span class="dt-span">${
                                  it.slots
                                }</span></td>
                                <td><span class="dt-span">${number_format(
                                  parseInt(it.slots) * parseInt(it.price),
                                  0,
                                  ".",
                                  ","
                                )}</span></td>
                                <td>${number_format(
                                  parseInt(it.slots) *
                                    parseInt(it.price) *
                                    parseFloat(it.ROI),
                                  0,
                                  ".",
                                  ","
                                )}</td>
                                <td>${number_format(
                                  parseInt(it.slots) *
                                    parseInt(it.price) *
                                    parseFloat(it.ROI) +
                                    parseInt(it.slots) * parseInt(it.price),
                                  0,
                                  ".",
                                  ","
                                )}</td>
                                <td>
                                    <img src="${domain}/public/images/refund.png" alt="" style="margin-right:2px;display:none;" width="16" class="img_refund_investment">
                                    ${
                                      permission_edit
                                        ? `<img src="${domain}/public/images/delete.png" alt="" style="opacity:0.2;margin-right:2px;" width="24" class="img_delete_investment">`
                                        : ""
                                    }
                                </td>
                            </tr>`;
        }
      });
    }

    _html =
      `<tr>
                            <td></td>
                            <td><b class="color-red">T???ng c???ng</b></td>
                            <td></td>
                            <td><b class="color-red">${number_format(
                              _total_slots,
                              0,
                              ".",
                              ","
                            )}</b></td>
                            <td><b class="color-red">${number_format(
                              _total_root,
                              0,
                              ".",
                              ","
                            )}</b></td>
                            <td><b class="color-red">${number_format(
                              _total_ROI,
                              0,
                              ".",
                              ","
                            )}</b></td>
                            <td><b class="color-red">${number_format(
                              _total_total,
                              0,
                              ".",
                              ","
                            )}</b></td>
                            <td></td>
                        </tr>` + _html;

    $("#tpl_list_investor").html(_html);

    thisPage.funcsToggleInvestor();

    thisPage.globalProductIDROI = _product_id;
  });
};

thisPage.funcsToggleInvestor = () => {
  if (!$("#table_list_investor").is(":visible")) {
    $("#search_order").hide();
    $("#table_detail").hide();
    $("#table_detail_product").hide();
    $("#table_list_investor").show();
    $("#table_refund").hide();
  } else {
    $("#search_order").show();
    $("#table_detail").show();
    $("#table_detail_product").hide();
    $("#table_list_investor").hide();
    $("#table_refund").hide();
  }
};

$("body").on("click", "img.product.img_top_product", function (e) {
  let _product_id = $(this).attr("product-id");
  $("#topProduct").modal("show");
  $("#modal_product_top_name").html($("#product-" + _product_id).html());
  thisPage.globalProducTopID = _product_id;
});

$("body").on("click", "img.product.img_edit_product", function (e) {
  let _product_id = $(this).attr("product-id");
  if (_product_id) thisPage.funcsRealDetail(_product_id);
});

$("body").on("click", "i.delete", function (e) {
  $(this).parent().remove();
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
    _is_hidden == "0" ? "???n s???n ph???m sau" : "Hi???n th??? s???n ph???m sau:"
  );
  $("#modal_product_hidden_name").html($("#product-" + _product_id).html());
  thisPage.globalProductHiddenID = _product_id;
});

thisPage.emptyFormCreate = () => {
  thisPage.inpCode.val("");
  thisPage.inpTitle.val("");
  thisPage.inpSlotsTotal.val("");
  thisPage.inpPrice.val("");
  thisPage.inpSlotsSold.val("");
  thisPage.slStatus.val("0");
  thisPage.inpRootPrice.val("");
  thisPage.inpPriceSold.val("");
  thisPage.inpFeeTotal.val("");
  thisPage.inpDescription.setData("");
  // thisPage.inpReceiveFundAccount.val('');
  // thisPage.inpReceiveFundFullname.val('');
  thisPage.globalProductID = "";
  $(".fee-items").remove();
};

//load init
thisPage.funcsInit = () => {
  _doAjaxNod("POST", "", "product", "idx", "initial", true, (res) => {
    thisPage.filterProvince.html(res.data.opt_province);
    thisPage.slCity.html(res.data.opt_full_city);
    thisPage.funcsLoadCity();
  });
};

//filter
thisPage.funcsFilter = () => {
  let data = new FormData();
  data.append("keyword", thisPage.txtSearching.val());
  data.append("province_id", thisPage.filterProvince.val());
  data.append("city_id", thisPage.filterCity.val());
  data.append("status", thisPage.filterStatus.val());
  _doAjaxNod("POST", data, "product", "idx", "filter", true, (res) => {
    let _html = thisPage.funcsTPLListReal(res.data);
    thisPage.tplListReal.html(_html);
  });
};

//Save real
thisPage.funcsRealSave = () => {
  let _code = thisPage.inpCode.val();
  let _title = thisPage.inpTitle.val();
  let _city_id = thisPage.slCity.val();
  let _slots_total = SplitNumber2(thisPage.inpSlotsTotal.val());
  let _price = SplitNumber2(thisPage.inpPrice.val());
  let _slots_sold = SplitNumber2(thisPage.inpSlotsSold.val());
  let _status = thisPage.slStatus.val();
  // let _code            = thisPage.inpRootPrice.val();
  let _price_sold = SplitNumber2(thisPage.inpPriceSold.val());
  let _fee_total = SplitNumber2(thisPage.inpFeeTotal.val());
  let _description = thisPage.inpDescription.getData();
  let _receive_fund_account = thisPage.inpReceiveFundAccount.val();
  let _receive_fund_fullname = $(
    "#inp_receive_fund_account option:selected"
  ).text();

  if (_code == "") {
    alert_dialog("Vui l??ng nh???p m??");
  } else if (_title == "") {
    alert_dialog("Vui l??ng nh???p ti??u ?????");
  } else if (_slots_total == "" || !isNumber(_slots_total)) {
    alert_dialog("Vui l??ng nh???p s??? l?????ng su???t l?? s??? nguy??n");
  } else if (_price == "" || !isNumber(_price)) {
    alert_dialog("Vui l??ng nh???p gi?? l?? s??? nguy??n");
  } else if (_price_sold == "" || !isNumber(_price_sold)) {
    alert_dialog("Vui l??ng nh???p gi?? b??n l?? s??? nguy??n");
  } else if (
    !_receive_fund_account ||
    null == _receive_fund_account ||
    _receive_fund_account == ""
  ) {
    alert_dialog("Vui l??ng nh???p t??i kho???n nh???n ti???n");
  } else {
    let _images = "";
    $(".avatar_thumbs img.img-responsive.img").each(function () {
      _images += $(this).attr("src") + ";";
    });

    let fee_detail = [];
    let i = 1;
    $("input.fee-fields").each(function () {
      let _it = {};
      _it.id = i++;
      let _val = SplitNumber2($(this).val());
      let _temp_id = $(this).attr("lable-id");
      let _name = $("#fee-label-" + _temp_id).val();
      if (_val != "" && isNumber(_val)) {
        _it.name = _name;
        _it.price = _val;
        fee_detail.push(_it);
      }
    });

    let data = new FormData();
    data.append("id", thisPage.globalProductID);
    data.append("code", _code);
    data.append("title", _title);
    data.append("city_id", _city_id);
    data.append("slots_total", _slots_total);
    data.append("price", _price);
    data.append("slots_sold", _slots_sold);
    data.append("status", _status);
    data.append("price_sold", _price_sold);
    data.append("receive_fund_account", _receive_fund_account);
    data.append("receive_fund_fullname", _receive_fund_fullname);
    data.append("fee_total", _fee_total);
    data.append("description", _description);
    data.append("images", _images);
    data.append("fee_detail", JSON.stringify(fee_detail));
    let _type_action = thisPage.globalProductID != "" ? "edit" : "add";
    _doAjaxNod(
      "POST",
      data,
      "product",
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
  _doAjaxNod("POST", data, "product", "idx", "top", true, (res) => {
    thisPage.funcsFilter();
    $("#topProduct").modal("hide");
  });
};

//Get Detail real
thisPage.funcsRealDetail = (_product_id) => {
  let data = new FormData();
  data.append("product_id", _product_id);
  _doAjaxNod("POST", data, "product", "idx", "detail", true, (res) => {
    //show the product to edit
    let d = res.data;

    thisPage.slCity.val(d.city_id);
    thisPage.inpCode.val(d.code);
    thisPage.inpTitle.val(d.title);
    thisPage.inpSlotsTotal.val(number_format(d.slots_total, 0, ".", ","));
    thisPage.inpPrice.val(number_format(d.price, 0, ".", ","));
    thisPage.inpSlotsSold.val(number_format(d.slots_sold, 0, ".", ","));
    thisPage.slStatus.val(d.status);
    thisPage.inpRootPrice.val(
      number_format(parseInt(d.slots_total) * parseInt(d.price), 0, ".", ",")
    );
    thisPage.inpPriceSold.val(number_format(d.price_sold, 0, ".", ","));
    thisPage.inpFeeTotal.val(number_format(d.fee_total, 0, ".", ","));
    thisPage.inpDescription.setData(d.description);
    thisPage.inpReceiveFundAccount.val(d.receive_fund_account);
    // thisPage.inpReceiveFundFullname.val(d.receive_fund_fullname);
    $(".avatar_thumbs img.img-responsive.img").parent().remove();

    let img = d.images;
    let _h_img = "";
    if (img && img.length > 0) {
      img.forEach(function (it) {
        if (it && it != "")
          _h_img += `<a class="col-md-2 img"><img src="${it}" class="img-responsive img"><i class="delete">x</i><i title="?????t l??m ???nh ?????i di???n" class="main-pic"><img src="${domain}/public/images/up.png"/></i></a>`;
      });
      $("#hold_img_show").after(_h_img);
    }

    $(".fee-items").remove();
    let fee_detail = JSON.parse(d.fee_detail);
    let _html_fee = ``;
    fee_detail.forEach(function (ii) {
      _html_fee += `<div class='col-md-6 col-sm-6 col-xs-12 fee-items'>
                                <div class='row relative'>
                                    <div class='col-md-6 col-sm-6 col-xs-12'>
                                        <input id="fee-label-${
                                          ii.id
                                        }" class='form-control label_name1' type='text' placeholder='T??n chi ph??' value="${
        ii.name
      }"></label>
                                    </div>
                                    <div class='col-md-6 col-sm-6 col-xs-12'>
                                        <div class='input_name input_name1'>
                                            <input class='form-control number-format fee-fields' lable-id="${
                                              ii.id
                                            }" type='text' name='' placeholder='Gi?? tr???' value="${number_format(
        ii.price,
        0,
        ".",
        ","
      )}">
                                        </div>
                                    </div>
                                    <label class='label_name_delete' style='margin-top: 16px;cursor: pointer;'>
                                        <img src='${domain}/public/images/delete.png' class="btn-fee-delete" width='24' style='margin-top: 16px;cursor: pointer;position: absolute;top: 2px;right: 0px;'>
                                    </label>
                                </div>
                            </div>`;
    });
    $(".append_cost > .row").html(_html_fee);

    thisPage.funcsToggleProductForm();
    thisPage.globalProductID = res.data.id;
  });
};

//Delete real
thisPage.funcsRealDelete = (_id) => {
  let data = new FormData();
  data.append("id", _id);
  _doAjaxNod("POST", data, "product", "delete", "delete", false, (res) => {
    thisPage.funcsFilter();
    $("#deleteProduct").modal("hide");
  });
};

//clone
thisPage.funcsRealClone = (_id) => {
  let data = new FormData();
  data.append("id", _id);
  _doAjaxNod("POST", data, "product", "clone", "clone", false, (res) => {
    thisPage.funcsFilter();
    $("#cloneProduct").modal("hide");
  });
};

//hidden
thisPage.funcsRealHidden = (_id) => {
  let data = new FormData();
  data.append("id", _id);
  _doAjaxNod("POST", data, "product", "hidden", "hidden", false, (res) => {
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
    let permission_edit = check_permission(":productedit:");
    let permission_delete = check_permission(":productdelete:");
    let permission_clone = check_permission(":productclone:");
    let permission_hidden = check_permission(":producthidden:");

    let i = 1;
    l.forEach(function (item) {
      _html += ` <tr>
                        <td>
                        <img title="?????t s???n ph???m l??n ?????u" product-id="${
                          item.id
                        }" src="${domain}/public/images/toparrow.png" alt="" width="24" class="product img_top_product">
                        ${i++}
                        </td>
                        <td class="code_real investors" product-id="${
                          item.id
                        }" status="${item.status}">
                            ${
                              item.status == 1
                                ? `<strike>${item.code}</strike>`
                                : item.code
                            }
                        </td>
                        <td id="product-${item.id}">${item.title}</td>
                        <td>
                            <span class="dt-span">${item.province_name}</span>
                        </td>
                        <td>
                            <span class="dt-span">${number_format(
                              item.price * item.slots_total,
                              0,
                              ".",
                              ","
                            )}</span>
                        </td>
                        <td>
                            <span class="dt-span">${number_format(
                              item.fee_total,
                              0,
                              ".",
                              ","
                            )}</span>
                        </td>
                        <td>
                            <span class="dt-span">${number_format(
                              item.price_sold,
                              0,
                              ".",
                              ","
                            )}</span>
                        </td>
                        <td width="110">
                            <span class="dt-span"><img src="${domain}/public/images/${
        item.status == 0 ? "waiting.png" : "sold.png"
      }" alt="" width="24">${
        item.status == 0 ? "Ch??? b??n" : '<font color="56BA47">???? b??n</font>'
      }</span>
                        </td>
                        <td class="table-product-icon">
                            ${
                              permission_edit
                                ? `<img title="C???p nh???t s???n ph???m" product-id="${item.id}" src="${domain}/public/images/edit.png" alt="" width="24" class="product img_edit_product">`
                                : ""
                            }
                            <img product-id="${
                              item.id
                            }" title="" src="${domain}/public/images/done.png" alt="" width="24" class="product img_done">
                            ${
                              permission_delete
                                ? `<img title="X??a s???n ph???m" product-id="${item.id}" src="${domain}/public/images/delete.png" alt="" width="24" class="product img_delete">`
                                : ""
                            }
                            ${
                              permission_clone
                                ? `<img title="Sao ch??p s???n ph???m" product-id="${item.id}" src="${domain}/public/images/clone.png" alt="" width="24" class="product img-icon-clone">`
                                : ""
                            }
                            ${
                              permission_hidden
                                ? item.is_hidden == "1"
                                  ? `<img is_hidden="${item.is_hidden}" title="Hi???n th??? s???n ph???m" product-id="${item.id}" src="${domain}/public/images/hidden.png" alt="" width="24" class="product img-icon-hidden">`
                                  : `<img title="???n s???n ph???m" is_hidden="${item.is_hidden}" product-id="${item.id}" src="${domain}/public/images/nohidden.png" alt="" width="24" class="product img-icon-hidden">`
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
                                <li id="list-city-add-province-${item.id}" ><input class="city-add-province" province-id="${item.id}" id="city-add-province-${item.id}" placeholder="Th??m qu???n/ huy???n" type="text" name="" value=""><img class="city-add" province-id="${item.id}" src="${domain}/public/images/done.png" alt="" width="24"></li>
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
      alert_dialog("T??n t???nh/ th??nh kh??ng ???????c b??? tr???ng.");
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
          alert_void("???? l??u t???nh/ th??nh th??nh c??ng.", 1);
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
      alert_dialog("T??n qu???n/ huy???n kh??ng ???????c b??? tr???ng.");
    } else {
      let data = new FormData();
      data.append("id", _city_id);
      data.append("name", _name);
      _doAjaxNod("POST", data, "product", "city", "city_save", false, (res) => {
        alert_void("???? l??u qu???n/ huy???n th??nh c??ng.", 1);
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
    alert_dialog("Vui l??ng nh???p m???t kh???u x??c nh???p");
  }
};

/*
- BEGIN Fee function
*/
$("body").on("click", "img.btn-fee-delete", function (e) {
  $(this).parent().parent().parent().remove();
  thisPage.funcsCalTotalFee();
});

$("body").on("blur", "input.number-format.fee-fields", function (e) {
  thisPage.funcsCalTotalFee();

  let value = $(this).val();
  let number = SplitNumber2(value);
  if (isNumber(number)) {
    $(this).val(number_format(number, 0, ".", ","));
  }
});

$(".label_append").click(function () {
  let _id = parseInt(Math.random() * 100000000);

  $(
    ".append_cost > .row"
  ).append(`<div class='col-md-6 col-sm-6 col-xs-12 fee-items'>
                                    <div class='row relative'>
                                        <div class='col-md-6 col-sm-6 col-xs-12'>
                                            <input id="fee-label-${_id}" class='form-control label_name1' type='text' placeholder='T??n chi ph??'></label>
                                        </div>
                                        <div class='col-md-6 col-sm-6 col-xs-12'>
                                            <div class='input_name input_name1'>
                                                <input class='form-control number-format fee-fields' lable-id="${_id}" type='text' name='' placeholder='Gi?? tr???'>
                                            </div>
                                        </div>
                                        <label class='label_name_delete' style='margin-top: 16px;cursor: pointer;'>
                                            <img src='${domain}/public/images/delete.png' class="btn-fee-delete" width='24' style='margin-top: 16px;cursor: pointer;position: absolute;top: 2px;right: 0px;'>
                                        </label>
                                    </div>
                                </div>`);
});

thisPage.funcsCalTotalFee = () => {
  let _total = 0;
  $("input.number-format.fee-fields").each(function () {
    let _val = SplitNumber2($(this).val());
    if (_val != "" && isNumber(_val)) {
      _total += parseInt(_val);
    }
  });
  thisPage.inpFeeTotal.val(number_format(_total, 0, ".", ","));
};

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
  $("#modal_product_history_delete").html(_slots + " su???t c???a " + _fullname);
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
      //th??m
      thisPage.funcsAddProductHistory();
    } else {
      //edit
      let _amount = thisPage.inpPHAmount.val();
      if (_amount == "") _amount = "0";
      _amount = parseInt(SplitNumber2(_amount));

      let _bought = thisPage.inpPHBought.val();
      _bought = parseInt(SplitNumber2(_bought));

      if (_amount == 0) {
        alert_dialog("Vui l??ng nh???p s??? su???t mu???n tr??? l???i ti???n");
      } else if (_amount > _bought || _amount < 1) {
        alert_dialog("S??? l?????ng su???t tr??? ph???i nh??? h??n s??? su???t hi???n ??ang c??.");
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
  $("#inp_product_history_amount_label").html("S??? su???t c???n t???o");
  if (_is_refund == 1) {
    $("#tpl_refund_holder").show();
    $("#inp_product_history_amount_label").html("S??? su???t mu???n refund");
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
      //c???n tr??? v??? balance t???ng c???a acc admin
      // s??? l?????ng su???t ??ang c??n l???i c???a user n??y
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
      // s??? l?????ng su???t ??ang c??n l???i c???a user n??y
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
      //chuy???n record th??nh h???y to??n b??? ho???c h???y 1 ph???n; ?????i v???i tr?????ng h???p h???y 1 ph???n, t???o record h???y v???i s??? l?????ng ???? ch???n v???i th??ng tin t??? record ch??nh

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
    alert_dialog("Vui l??ng ch???n nh?? ?????u t??");
  } else if (_amount == 0) {
    alert_dialog("Vui l??ng nh???p s??? su???t mu???n tr??? l???i ti???n");
  } else if (_balance < _total) {
    alert_dialog("S??? d?? kh??ng ????? th???c hi???n giao d???ch");
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
