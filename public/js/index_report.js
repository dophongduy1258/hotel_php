var thisPage = {};

thisPage.txtSearching = $("#txt_searching");
thisPage.from = $("#from");
thisPage.to = $("#to");
thisPage.tplHistory = $("#tpl_history");

$(function () {
  thisPage.from.datepicker();
  thisPage.to.datepicker();

  $("#tab_history_inves").click(function () {
    thisPage.funcsFitlerHistory();
  });

  $("#tab_profit_inves").click(function () {
    thisPage.funcsFitlerROI();
  });

  $("#tab_history_recharge").click(function () {
    thisPage.funcsFitlerFunding("deposit");
  });

  $("#tab_history_withdrawal").click(function () {
    thisPage.funcsFitlerFunding("withdraw");
  });

  $("#txt_searching, #from, #to").change(function () {
    thisPage.reloadFilter();
  });

  thisPage.slROIStatus.change(function () {
    thisPage.funcsFitlerROI();
  });

  $("#btn_funding_done").click(function () {
    thisPage.funcsFundingDone();
  });

  $("#btn_funding_cancel").click(function () {
    thisPage.funcsFundingCancel();
  });

  setTimeout(() => {
    if (check_permission(":indexreport:reporthistory:reportdetail_investor:")) {
      thisPage.funcsFitlerHistory();
    } else if (check_permission(":indexreport:reportROI:")) {
      $("#tab_profit_inves").find("a").click();
    } else if (check_permission(":indexreport:reportdeposit:")) {
      $("#tab_history_recharge").find("a").click();
    } else if (check_permission(":indexreport:reportwithdraw:")) {
      $("#tab_history_withdrawal").find("a").click();
    }
  }, 200);
});

thisPage.reloadFilter = () => {
  if ($("#tab_history_inves").hasClass("active")) thisPage.funcsFitlerHistory();
  else if ($("#tab_profit_inves").hasClass("active")) thisPage.funcsFitlerROI();
  else if ($("#tab_history_recharge").hasClass("active"))
    thisPage.funcsFitlerFunding("deposit");
  else if ($("#tab_history_withdrawal").hasClass("active"))
    thisPage.funcsFitlerFunding("withdraw");
};
/*
- BEGIN tab purchased 
*/

/*
- BEGIN get detail Product
*/
$("body").on("click", ".code_real.detail-product", function (e) {
  let _product_id = $(this).attr("product-id");
  thisPage.funcsRealDetail(_product_id);
});

thisPage.inpCode = $("#inp_code");
thisPage.inpTitle = $("#inp_title");
thisPage.slCity = $("#sl_city");
thisPage.inpSlotsTotal = $("#inp_slots_total");
thisPage.inpPrice = $("#inp_price");
thisPage.slStatus = $("#sl_status");
thisPage.inpRootPrice = $("#inp_root_price");
thisPage.inpPriceSold = $("#inp_price_sold");
thisPage.inpReceiveFundAccount = $("#inp_receive_fund_account");
thisPage.inpReceiveFundFullname = $("#inp_receive_fund_fullname");
thisPage.inpFeeTotal = $("#inp_fee_total");
thisPage.inpDescription = $("#inp_description");

$(
  ".infomation_table.infomation_code i, button.btn-close-infomation_code"
).click(function () {
  thisPage.funcsToggleProductForm();
});

thisPage.funcsToggleProductForm = () => {
  $(".table-detail").toggle();
  $(".infomation_code").toggle();
  $(".search-order").toggle();
};

//Get Detail Real: FUNCTION FROM index_product.js copied
thisPage.funcsRealDetail = (_product_id) => {
  let data = new FormData();
  data.append("product_id", _product_id);
  _doAjaxNod("POST", data, "report", "history", "detail", true, (res) => {
    //show the product to edit
    let d = res.data;

    thisPage.inpCode.val(d.code);
    thisPage.inpTitle.val(d.title);
    thisPage.inpSlotsTotal.val(number_format(d.slots_total, 0, ".", ","));
    thisPage.inpPrice.val(number_format(d.price, 0, ".", ","));
    thisPage.slStatus.val(d.status);
    thisPage.inpRootPrice.val(
      number_format(parseInt(d.slots_total) * parseInt(d.price), 0, ".", ",")
    );
    thisPage.inpPriceSold.val(number_format(d.price_sold, 0, ".", ","));
    thisPage.inpFeeTotal.val(number_format(d.fee_total, 0, ".", ","));
    thisPage.inpDescription.val(d.description);
    thisPage.inpReceiveFundAccount.val(d.receive_fund_account);
    thisPage.inpReceiveFundFullname.val(d.receive_fund_fullname);
    $(".avatar_thumbs img.img-responsive.img").parent().remove();

    let img = d.images;
    let _h_img = "";
    if (img && img.length > 0) {
      img.forEach(function (it) {
        if (it && it != "")
          _h_img += `<a class="col-md-2 img"><img src="${it}" class="img-responsive img"><i class="delete">x</i></a>`;
      });
      $("#hold_img_show").after(_h_img);
    }

    $(".fee-fields").val("");
    let fee_detail = JSON.parse(d.fee_detail);
    fee_detail.forEach(function (ii) {
      $("#fee_detail_" + ii.id).val(number_format(ii.price, 0, ".", ","));
    });

    thisPage.funcsToggleProductForm();
  });
};

/*
- END get detail Product
*/

thisPage.funcsFitlerHistory = () => {
  let data = new FormData();
  data.append("keyword", thisPage.txtSearching.val());
  data.append("from", thisPage.from.val());
  data.append("to", thisPage.to.val());

  _doAjaxNod("POST", data, "report", "history", "filter", true, (res) => {
    let _html = thisPage.funcsTPLHistory(res.data);
    thisPage.tplHistory.html(_html);
  });
};

thisPage.funcsTPLHistory = (l) => {
  let _html = "";
  if (l) {
    let i = 1;
    l.forEach(function (item) {
      _html += `<tr>
                            <td>${i++}</td>
                            <td class="code_real detail-product" product-id="${
                              item.product_id
                            }">${item.code}</td>
                            <td>${date_format("d/m/Y", item.purchased_at)}</td>
                            <td class="profile_real detail-product" username="${
                              item.username
                            }">${item.fullname}</td>
                            <td>${item.purchased_slots}</td>
                            <td>${number_format(
                              parseInt(item.purchased_slots) *
                                parseInt(item.price),
                              0,
                              ".",
                              ","
                            )}</td>
                            <td class="text-left"><img src="${domain}/public/images/${
        item.status == 0 ? "waiting.png" : "sold.png"
      }" alt="" width="24">${item.status == 0 ? "Đang chờ bán" : "Đã bán"}</td>
                        </tr>`;
    });
  }
  return _html;
};

thisPage.inpUserProductInvested = $("#inp_user_product_invested");
thisPage.inpUserTotalInvested = $("#inp_user_total_invested");
thisPage.tplUserInvested = $("#tpl_user_invested");

$("body").on("click", ".profile_real.detail-product", function (e) {
  let _username = $(this).attr("username");
  $("#investor_name").html($(this).html());
  thisPage.funcsInvestorDetail(_username);
});

$("body").on("click", ".infomation_profile > i", function (e) {
  thisPage.funcsToggleInvestorForm();
});

thisPage.funcsInvestorDetail = (_username) => {
  let data = new FormData();
  data.append("username", _username);
  _doAjaxNod(
    "POST",
    data,
    "report",
    "history",
    "detail_investor",
    true,
    (res) => {
      //show the product to edit
      let d = res.data;

      thisPage.inpUserProductInvested.val(
        number_format(d.total_product_invested, 0, ".", ",")
      );
      thisPage.inpUserTotalInvested.val(
        number_format(d.total_invested, 0, ".", ",")
      );

      let _html = thisPage.funcsTPLInvested(res.data.list_invested);
      thisPage.tplUserInvested.html(_html);

      thisPage.funcsToggleInvestorForm();
    }
  );
};

thisPage.funcsTPLInvested = (l) => {
  let _html = "";
  if (l) {
    let i = 1;
    l.forEach(function (item) {
      _html += `<tr>
                            <td>${i++}</td>
                            <td>${item.code}</td>
                            <td class="text-left">${item.title}</td>
                            <td>${date_format_full(item.created_at)}</td>
                            <td>${item.slots}</td>
                            <td>${number_format(
                              parseInt(item.slots) * parseInt(item.price),
                              0,
                              ".",
                              ","
                            )}</td>
                            <td class="text-left"><img src="${domain}/public/images/${
        item.pro_status == 0 ? "waiting.png" : "sold.png"
      }" alt="" width="24">${
        item.pro_status == 0 ? "Đang chờ bán" : "Đã bán"
      }</td>
                        </tr>`;
    });
  }
  return _html;
};

thisPage.funcsToggleInvestorForm = () => {
  $(".table-detail").toggle();
  $(".infomation_profile").toggle();
};
/*
- END tab purchased 
*/

/*
- BEGIN tab ROI 
*/
thisPage.slROIStatus = $("#sl_ROI_status");
thisPage.tplROI = $("#tpl_ROI");

thisPage.funcsFitlerROI = () => {
  let data = new FormData();
  data.append("keyword", thisPage.txtSearching.val());
  data.append("from", thisPage.from.val());
  data.append("to", thisPage.to.val());
  data.append("status", thisPage.slROIStatus.val());

  _doAjaxNod("POST", data, "report", "ROI", "filter", true, (res) => {
    let _html = thisPage.funcsTPLROI(res.data);
    thisPage.tplROI.html(_html);
  });
};

thisPage.funcsTPLROI = (l) => {
  let _html = "";
  if (l) {
    let i = 1;
    l.forEach(function (item) {
      _html += `<tr>
                            <td>${i++}</td>
                            <td class="code_real detail-product---" product-id="${
                              item.product_id
                            }">${item.code}</td>
                            <td>${date_format("d/m/Y", item.purchased_at)}</td>
                            <td class="profile_real detail-product---" username="${
                              item.username
                            }">${item.fullname}</td>
                            <td>
                                <span class="dt-span">${number_format(
                                  item.purchased_slots,
                                  0,
                                  ".",
                                  ","
                                )}</span>
                            </td>
                            <td>
                                <span class="dt-span">${number_format(
                                  parseInt(item.purchased_slots) *
                                    parseInt(item.price),
                                  0,
                                  ".",
                                  ","
                                )}</span>
                            </td>
                            <td>
                                <span class="dt-span">${number_format(
                                  parseInt(item.purchased_slots) *
                                    parseInt(item.price * item.ROI),
                                  0,
                                  ".",
                                  ","
                                )}</span>
                            </td>
                            <td>
                                <span class="dt-span">${number_format(
                                  parseInt(item.purchased_slots) *
                                    parseInt(item.price) +
                                    parseInt(item.purchased_slots) *
                                      parseInt(item.price * item.ROI),
                                  0,
                                  ".",
                                  ","
                                )}</span>
                            </td>
                            <td>
                                <img src="${domain}/public/images/${
        item.pro_status == "0" ? "waiting.png" : "sold.png"
      }" alt="" width="24">
                            </td>
                        </tr>`;
    });
  }
  return _html;
};

/*
- END tab ROI 
*/

/*
- BEGIN tab DEPOSIT/WITHDRAW
*/
thisPage.tplDeposit = $("#tpl_deposit");
thisPage.tplWithdraw = $("#tpl_withdraw");
thisPage.globalFundID = "";
thisPage.globalFundType = "";

thisPage.funcsFitlerFunding = (_type) => {
  let data = new FormData();
  data.append("keyword", thisPage.txtSearching.val());
  data.append("from", thisPage.from.val());
  data.append("to", thisPage.to.val());
  data.append("type", _type); //withdraw

  _doAjaxNod("POST", data, "report", _type, "filter", true, (res) => {
    let _html = thisPage.funcsTPLFunding(res.data, _type);
    if (_type == "deposit") thisPage.tplDeposit.html(_html);
    else thisPage.tplWithdraw.html(_html);
  });
};

thisPage.funcsTPLFunding = (l, _type) => {
  let _html = "";
  if (l) {
    let i = 1;

    l.forEach(function (item) {
      let permission = false;
      if (item.type == "deposit")
        permission = check_permission(":reportdeposit_done:");
      else if (item.type == "withdraw")
        permission = check_permission(":reportwithdraw_done:");

      if (_type == "deposit") {
        _html += `<tr class="${item.status == "-1" ? "strike" : ""}">
                        <td>${i++}</td>
                        <td>${date_format_full(item.created_at)}</td>
                        <td id="fund-fullname-${item.id}">${item.fullname}</td>
                        <td id="fund-bank-${item.id}">${item.bank_name}</td>
                        <td id="fund-amount-${item.id}">${number_format(
          item.amount,
          0,
          ".",
          ","
        )}</td>
                        <td id="fund-memo-${item.id}">KYQUY HD${item.id} ${
          item.username
        }</td>
                        <td id="fund-confirm-${item.id}">${
          item.approved_by
        }</td>
                        <td><img class="${
                          item.status == "0"
                            ? permission
                              ? "funding_update_done"
                              : ""
                            : ""
                        }" fund-id="${item.id}" fund-type="${
          item.type
        }" fund-username="${item.username}" src="${domain}/public/images/${
          item.status == "0"
            ? "waiting.png"
            : item.status == "-1"
            ? "cancel.png"
            : "sold.png"
        }" alt="" width="24"></td>
                    </tr>`;
      } else {
        _html += `<tr class="${item.status == "-1" ? "strike" : ""}">
                        <td>${i++}</td>
                        <td>${date_format_full(item.created_at)}</td>
                        <td id="fund-fullname-${item.id}">${item.fullname}</td>
                        <td id="fund-bank-${item.id}">${item.bank_name}</td>
                        <td id="fund-bank-${item.id}">${item.bank_account}</td>
                        <td id="fund-bank-${item.id}">${
          item.bank_account_name
        }</td>
                        <td id="fund-amount-${item.id}">${number_format(
          item.amount,
          0,
          ".",
          ","
        )}</td>
                        <td id="fund-memo-${item.id}">KYQUY HD${item.id} ${
          item.username
        }</td>
                        <td id="fund-confirm-${item.id}">${
          item.approved_by
        }</td>
                        <td><img class="${
                          item.status == "0"
                            ? permission
                              ? "funding_update_done"
                              : ""
                            : ""
                        }" fund-id="${item.id}" fund-type="${
          item.type
        }" fund-username="${item.username}" src="${domain}/public/images/${
          item.status == "0"
            ? "waiting.png"
            : item.status == "-1"
            ? "cancel.png"
            : "sold.png"
        }" alt="" width="24"></td>
                    </tr>`;
      }
    });
  }
  return _html;
};

$("body").on("click", "img.funding_update_done", function (e) {
  let _id = $(this).attr("fund-id");
  let _type = $(this).attr("fund-type");
  let _username = $(this).attr("fund-username");
  thisPage.globalFundType = _type;

  if (_type == "deposit") _type = "Nạp tiền";
  else if (_type == "Rút tiền");

  let _html = `[${_type}] của ${$(
    "#fund-fullname-" + _id
  ).html()} (${_username}) qua ${$("#fund-bank-" + _id).html()}
                số tiền <b class="color-red">${$(
                  "#fund-amount-" + _id
                ).html()}</b> `;

  $("#funding_note").html(_html);
  $("#fundingDone").modal("show");
  thisPage.globalFundID = _id;
});

thisPage.funcsFundingDone = () => {
  let data = new FormData();
  data.append("id", thisPage.globalFundID);

  if (thisPage.globalFundType != "") {
    _doAjaxNod(
      "POST",
      data,
      "report",
      thisPage.globalFundType + "_done",
      "done",
      true,
      (res) => {
        $("#fundingDone").modal("hide");
        thisPage.globalFundID = "";
        thisPage.globalFundType = "";
        thisPage.reloadFilter();
      }
    );
  }
};

thisPage.funcsFundingCancel = () => {
  let data = new FormData();
  data.append("id", thisPage.globalFundID);

  if (thisPage.globalFundType != "") {
    _doAjaxNod(
      "POST",
      data,
      "report",
      thisPage.globalFundType + "_done",
      "cancel",
      true,
      (res) => {
        $("#fundingDone").modal("hide");
        thisPage.globalFundID = "";
        thisPage.globalFundType = "";
        thisPage.reloadFilter();
      }
    );
  }
};

/*
- END tab DEPOSIT/WITHDRAW
*/
