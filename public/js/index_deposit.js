var thisPage = {};

thisPage.txtSearching = $("#txt_searching");
thisPage.tplList = $("#tpl_list");
thisPage.pageHtml = $("#page_html");
thisPage.currentPage = $("#current_page");
thisPage.globalID = '';

$(function () {

    thisPage.txtSearching.keyup(function () {
        thisPage.funcsFilter();
    })

    thisPage.funcsFilter();

    $("#btn_confirm_done").click(function () {
        thisPage.funcsDone();
    })

    $("#btn_confirm_refund").click(function () {
        thisPage.funcsRefund();
    })

    $("#btn_confirm_delete").click(function(){
        thisPage.funcsDelete();
    })

})

function paging_ajax3( _page ){
    thisPage.currentPage.val( _page );
    thisPage.funcsFilter();
}

thisPage.funcsFilter = () => {
    let data = new FormData();
    data.append('keyword', thisPage.txtSearching.val());
    data.append('page', thisPage.currentPage.val() );
    _doAjaxNod('POST', data, 'deposit', 'idx', 'filter', true, (res) => {
        let _html = thisPage.funcsTPL( res.data.l );
        thisPage.tplList.html( _html );
        thisPage.pageHtml.html( res.data.page_html );
    })
}

thisPage.funcsDone = () => {
    let data = new FormData();
    data.append('id', thisPage.globalID);
    _doAjaxNod('POST', data, 'deposit', 'done', 'done', true, (res) => {
        $("#modal_done").modal("hide");
        thisPage.funcsFilter();
        thisPage.globalID = '';
    })
}

thisPage.funcsRefund = () => {
    let data = new FormData();
    data.append('id', thisPage.globalID );
    _doAjaxNod('POST', data, 'deposit', 'refund', 'refund', true, (res) => {
        $("#modal_refund").modal("hide");
        thisPage.funcsFilter();
        thisPage.globalID = '';
    })
}

thisPage.funcsDelete = () => {
    let data = new FormData();
    data.append('id', thisPage.globalID);
    _doAjaxNod('POST', data, 'deposit', 'delete', 'delete', true, (res) => {
        $("#modal_delete").modal("hide");
        thisPage.funcsFilter();
        thisPage.globalID = '';
    })
}

thisPage.funcsTPL = (l) => {
    let _html = '';
    if (l) {
        let i = 1;
        l.forEach(function (item) {
            _html += `<tr>
                        <td>#${item.id}</td>
                        <td class='img_edit_investor' record-id="${item.id}">${date_format_full(item.created_at)}</td>
                        <td class='img_edit_investor' record-id="${item.id}">${item.username}</td>
                        <td class='img_edit_investor' record-id="${item.id}">
                            <span class="dt-span">${item.fullname}</span>
                        </td>
                        <td class='img_edit_investor' record-id="${item.id}">
                            <span class="dt-span">${item.name}</span>
                        </td>
                        <td class='img_edit_investor' record-id="${item.id}">
                            <span class="dt-span">${item.value}</span>
                        </td>
                        <td class='img_edit_investor' investor-id="${item.id}">${item.note}</td>
                        <td>
                            <img src="${domain}/public/images/reset.png" alt="" width="24" record-id="${item.id}" class="img_done_process" style="margin-right:0px;">
                            <img src="${domain}/public/images/edit.png" alt="" width="24" record-id="${item.id}" class="img_refund_process" style="margin-left: 4px !important;margin-right:0px;">
                            <img src="${domain}/public/images/delete.png" record-id="${item.id}" alt="" width="24" class="img_delete_process" style="margin-left: 4px !important;margin-right:0px;">
                        </td>
                    </tr>`;
        })
    }
    return _html;
}

$('body').on('click', '.img_done_process', function (e) {
    let _id = $(this).attr("record-id");
    $(".txt_id").html( _id );
    thisPage.globalID = _id;
    $("#modal_done").modal("show");
});

$('body').on('click', '.img_refund_process', function (e) {
    let _id = $(this).attr("record-id");
    $(".txt_id").html( _id );
    thisPage.globalID = _id;
    $("#modal_refund").modal("show");
});

$('body').on('click', '.img_delete_process', function (e) {
    let _id = $(this).attr("record-id");
    $(".txt_id").html( _id );
    thisPage.globalID = _id;
    $("#modal_delete").modal("show");
});

