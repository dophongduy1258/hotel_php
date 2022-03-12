var thisPage = {};

thisPage.txt_searching      = $("#txt_searching");
thisPage.btn_mngt_level     = $("#btn_mngt_level");
thisPage.tpl_list           = $("#tpl_list");
thisPage.page_html          = $("#page_html");
thisPage.current_page       = $("#current_page");
thisPage.holder_info        = $("#holder_info");

thisPage.txt_fullname       = $("#txt_fullname");
thisPage.txt_parent         = $("#txt_parent");
thisPage.txt_commission     = $("#txt_commission");

thisPage.globalUsername     = '';

$(function(){

    $(".tab_list_level").click(function(){
        setTimeout(() => {
            thisPage.current_page.val(1);
            thisPage.filter();
        }, 150);
    })

    $(".holder_info_closing").click(function(){
        thisPage.globalUsername = '';
        $(".tab-record-total").html('-');
        thisPage.tpl_list.html(`<tr><td colspan="6">Chưa có thông tin</td></tr>`);
        $("#holder_info").hide();
    })

    thisPage.txt_parent.click(function(){
        let parent = $(this).attr("parent");
        if ( parent && parent != '' && parent != null ){
            thisPage.get_detail( parent );
        }
    })

    $("#btn_mngt_level").click(function(){
        $(".list-holder-content").hide();
        $(".infomation_group_level").show();
    })

    $(".infomation_mgt_level_back").click(function(){
        $(".list-holder-content").hide();
        $(".info-commission-tree").show();
    })

    thisPage.sum_commission();

})

$("body").on("click", ".view-detail-user", function(){
    thisPage.get_detail( $(this).attr("username") );
})

$("body").on("blur", "input.level-commission", function(){
    setTimeout(()=>{
        thisPage.update_commission( $(this).attr("level-id"), $(this).val() );
    },200)
})

thisPage.txt_searching.autocomplete({
    minLength: 1,
    option: 'appendTo',
    source: function (request, response) {
        var keyword = thisPage.txt_searching.val();
        let data = new FormData();
        data.append('keyword', keyword);
        _doAjaxNod('POST', data, 'mlm', 'idx', 'searching', true, (res) => {
            response($.map(res.data, function (el) {
                return {
                    label: el.fullname + ' (' + el.username + ')',
                    fullname: el.fullname,
                    parent: el.parent,
                    parent_fullname: el.parent_fullname,
                    commission: el.commission,
                    value: '',
                    username: el.username
                };
            }));
        });

    },
    select: function (e, ui) {
        //add items
        setTimeout(() => {
            // thisPage.inpPHName.attr("username", ui.item.username);
            thisPage.globalUsername = ui.item.username;

            thisPage.txt_fullname.html( ui.item.fullname );
            thisPage.txt_parent.html( ui.item.parent_fullname );
            thisPage.txt_parent.attr( "parent", ui.item.parent );
            thisPage.txt_commission.html( number_format(ui.item.commission, 0, '.', ',') );

            $("#holder_info").show();
            thisPage.txt_searching.val('');

            thisPage.filter();
        }, 150);
    }
});

function paging_ajax3( _page ){
    thisPage.current_page.val( _page );
    thisPage.filter();
}

thisPage.filter  = ()=>{
    if (thisPage.globalUsername  != '' ){
        let _level_id = 1;

        $(".tab_list_level").each(function(){
            if ( $(this).hasClass('active') && _level_id != '' )
                _level_id = $(this).attr("level-id");
        })

        let data = new FormData();
        data.append('username', thisPage.globalUsername );
        data.append('level_id', _level_id );
        data.append('page', thisPage.current_page.val() );
        _doAjaxNod('POST', data, 'mlm', 'idx', 'filter', true, function(res){
            thisPage.tpl_list.html( thisPage.render( res.data.lItems ) );
            thisPage.page_html.html( res.data.page_html );
            res.data.lTotal.forEach(function(ite){
                $("#tab-record-total-" + ite.id).html(number_format(ite.total, 0, '.', ','));
            })

            $(".list-holder-content").hide();
            $(".info-commission-tree").show();
            
        })
    }else{
        alert_dialog("Vui lòng chọn người cần xem.");
    }
}

thisPage.render = (lLevel)=>{
    let _html = '';
    let i = 1;

    if( lLevel.length > 0 )
        lLevel.forEach(function(item){
            _html += `<tr>
                        <td>${i++}</td>
                        <td>${item.fullname}</td>
                        <td>${item.email}</td>
                        <td>${item.mobile}</td>
                        <td>${number_format(item.commission, 0, '.', ',')}</td>
                        <td>
                            <img username="${item.username}" title="Xem chi tiết" level-id="${item.id}" src="${domain}/public/images/nohidden.png" alt="" width="24" class="product img_edit_product view-detail-user">
                        </td>
                    </tr>`;
        })
    else
        _html +=`<tr>
                    <td colspan="6">Chưa có thông tin</td>
                </tr>`;
    
    return _html;
}

thisPage.get_detail = (_username) => {

    let data = new FormData();
    data.append('username', _username);
    _doAjaxNod('POST', data, 'mlm', 'idx', 'get_detail', true, function (res) {
        thisPage.globalUsername = res.data.username;

        thisPage.txt_fullname.html(res.data.fullname);
        thisPage.txt_parent.html(res.data.parent_fullname);
        thisPage.txt_parent.attr("parent", res.data.parent);
        thisPage.txt_commission.html(number_format(res.data.commission, 0, '.', ','));
        $("#holder_info").show();

        thisPage.filter();
    })
}

thisPage.update_commission = ( _level_id, _commission ) => {
    _commission = SplitNumber2( _commission );
    _commission = parseFloat( _commission );
    if( _commission < 0 || _commission > 100 ){
        alert_dialog("Mức hoa hồng không đúng, phải lớn hơn không và nhỏ hơn 100");
    }else{
        let data = new FormData();
        data.append('level_id', _level_id);
        data.append('commission', _commission);
        _doAjaxNod('POST', data, 'mlm', 'commission', 'update', true, function (res) {
           alert_void("Đã cập nhật xong", 1);
           thisPage.sum_commission();
        })
    }
}

thisPage.sum_commission = ()=>{
    let total = 0;
    $("input.level-commission").each(function(){
        let val = $(this).val();
        val = parseFloat( val );
        total+= val;
    })
    $("#total_commission").html( number_format( total, 2, '.', ',') );
}


thisPage.globalUsernameCommisison   = '';
thisPage.globalUsernameChangeParent = '';

$(function(){
    
    $("#btn_delivery_commission").click(function(){
        $("#deliveryCommission").modal("show");
        thisPage.resetInfoSearchingModal();
        thisPage.globalUsernameCommisison = '';
    })

    $("#btn_change_parent").click(function () {
        if( thisPage.globalUsername != '' ){
            $("#changeParent").modal("show");
            thisPage.resetInfoSearchingModal();
            thisPage.globalUsernameChangeParent = '';
        }
    })

    $(".commission_parent_select").click(function(){
        let _username = $(this).attr('username');
        if(_username && _username != '' ){
            thisPage.getDetailByUsername(_username);
            thisPage.globalUsernameCommisison = _username;
        }
    })

    $(".change_parent_select").click(function () {
        let _username = $(this).attr('username');
        if ( _username && _username != '' ) {
            thisPage.getDetailByUsername(_username);
            thisPage.globalUsernameChangeParent = _username;
        }
    })

    $("#btn_commission_confirm").click(function(){
        thisPage.deliveryCommission();
    })

    $("#btn_new_parent_confirm").click(function () {
        thisPage.changeParent();
    })

})

thisPage.deliveryCommission = ()=>{

    let amount = $("#amount").val();
    let note = $("#note").val();
    let amount_int = SplitNumber2(amount);
    amount_int = parseInt( amount_int );

    if( thisPage.globalUsernameCommisison == '' ){
        alert_dialog("Không xác định được người tạo ra hoa hồng. Vui lòng chọn tạo ra hoa hồng.");
    }else if ( amount == '' || amount_int < 0 ){
        alert_dialog("Vui lòng nhập số tiền hoa hồng.");
    }else{
        let data = new FormData();
        data.append('username', thisPage.globalUsernameCommisison );
        data.append('amount', amount);
        data.append('note', note);
        _doAjaxNod('POST', data, 'mlm', 'delivery_commission', 'delivery', true, (res) => {
            alert_void("Đã cập nhật hoa hồng thành công", 1);
            $("#deliveryCommission").modal("hide");
            thisPage.globalUsernameCommisison = '';
        });
    }

}

thisPage.changeParent = () => {

    if (thisPage.globalUsernameChangeParent == '') {
        alert_dialog("Không xác định được người giới thiệu mới cần thay đổi. Vui lòng chọn lại.");
    } else {
        let data = new FormData();
        data.append('username', thisPage.globalUsername);
        data.append('new_parent', thisPage.globalUsernameChangeParent);
        _doAjaxNod('POST', data, 'mlm', 'idx', 'change_parent', true, (res) => {
            alert_void("Đã thay đổi người giới thiệu thành công", 1);
            $("#changeParent").modal("hide");
            thisPage.globalUsernameChangeParent = '';
        });
    }

}

$("#commission_searching").autocomplete({
    minLength: 1,
    option: 'appendTo',
    source: function (request, response) {
        var keyword = $("#commission_searching").val();
        let data = new FormData();
        data.append('keyword', keyword);
        _doAjaxNod('POST', data, 'mlm', 'idx', 'searching', true, (res) => {
            response($.map(res.data, function (el) {
                return {
                    label: el.fullname + ' (' + el.username + ')',
                    fullname: el.fullname,
                    parent: el.parent,
                    parent_fullname: el.parent_fullname,
                    commission: el.commission,
                    value: '',
                    username: el.username
                };
            }));
        });
    },
    select: function (e, ui) {
        //add items
        setTimeout(() => {
            $("#commission_searching").val('');
            thisPage.getDetailByUsername( ui.item.username );
            thisPage.globalUsernameCommisison = ui.item.username;
        }, 150);
    }
});

$("#parent_searching").autocomplete({
    minLength: 1,
    option: 'appendTo',
    source: function (request, response) {
        var keyword = $("#parent_searching").val();
        let data = new FormData();
        data.append('keyword', keyword);
        _doAjaxNod('POST', data, 'mlm', 'idx', 'searching', true, (res) => {
            response($.map(res.data, function (el) {
                return {
                    label: el.fullname + ' (' + el.username + ')',
                    fullname: el.fullname,
                    parent: el.parent,
                    parent_fullname: el.parent_fullname,
                    commission: el.commission,
                    value: '',
                    username: el.username
                };
            }));
        });
    },
    select: function (e, ui) {
        //add items
        setTimeout(() => {
            $("#parent_searching").val('');
            thisPage.getDetailByUsername(ui.item.username);
            thisPage.globalUsernameChangeParent = ui.item.username;
        }, 150);
    }
});

//get detail with parent info
thisPage.getDetailByUsername = (_username) => {
    let data = new FormData();
    data.append('username', _username);
    _doAjaxNod('POST', data, 'mlm', 'idx', 'get_detail_by', true, function (res) {
        thisPage.showInfoSearchingModal(res.data);
    })
}

thisPage.showInfoSearchingModal = (d)=>{
    $(".txt_name").html( d.name );
    $(".txt_mobile").html( d.mobile +'/ '+d.email );
    if( d.parent_name != '' ){
        $(".txt_parent_name").html( d.parent_name );
        $(".txt_parent_mobile").html(d.parent_mobile + '/ ' + d.parent_email );
    }else{
        $(".txt_parent_name").html('-');
        $(".txt_parent_mobile").html('-/-');
    }
    $(".commission_parent_select").attr('username', d.parent_username);
    $(".change_parent_select").attr('username', d.parent_username);
}

thisPage.resetInfoSearchingModal = () => {
    $(".txt_name").html('-');
    $(".txt_mobile").html('-/-');
    $(".txt_parent_name").html('-');
    $(".txt_parent_mobile").html('-/-');
    $(".commission_parent_select").attr('username', '');
    $(".change_parent_select").attr('username', '');
}

/*
- BEGIN COMMISSION HISTORY
*/
thisPage.commission_from        = $("#commission_from");
thisPage.commission_to          = $("#commission_to");
thisPage.commission_tpl_list    = $("#commission_tpl_list");
thisPage.commisison_current_page = $("#commisison_current_page");
thisPage.commisison_page_html   = $("#commisison_page_html");
thisPage.btn_commission_history = $("#btn_commission_history");
thisPage.show_commission_history = $("#show_commission_history");

$(function(){
    thisPage.commission_from.datepicker();
    thisPage.commission_to.datepicker();

    thisPage.btn_commission_history.click(function(){
        thisPage.commisison_current_page.val(1);
        thisPage.commissionHistory();
    })

    thisPage.show_commission_history.click(function(){
        $(".list-holder-content").hide();
        $(".info-commission-history").show();
        thisPage.commissionHistory();
    })

})

function paging_ajax2(_page) {
    thisPage.commisison_current_page.val(_page);
    thisPage.commissionHistory();
}

thisPage.commissionHistory = () => {

    let data = new FormData();
    data.append('from', thisPage.commission_from.val());
    data.append('to', thisPage.commission_to.val());
    data.append('page', thisPage.commisison_current_page.val());
    _doAjaxNod('POST', data, 'mlm', 'delivery_commission', 'commission_history', true, function (res) {
        thisPage.commission_tpl_list.html(thisPage.renderCommissionHistory(res.data.lItems));
        thisPage.commisison_page_html.html(res.data.page_html);
        $(".list-holder-content").hide();
        $(".info-commission-history").show();
    })

}

thisPage.historyDetail = ( _id ) => {

    let data = new FormData();
    data.append('id', _id);
    _doAjaxNod('POST', data, 'mlm', 'delivery_commission', 'commission_history_list', true, function (res) {

        //info showing
        $("#ch_fullname").html($("#ch_fullname_"+_id).html() );
        $("#ch_total").html($("#ch_total_"+_id).html() );
        $("#ch_total_delivered").html($("#ch_total_delivered_"+_id).html() );
        $("#ch_created_at").html($("#ch_created_at_"+_id).html() );
        $("#ch_note").html($("#ch_note_"+_id).html() );

        $("#history_tpl_list").html( thisPage.renderCommissionHistoryList(res.data ) );
        $("#historyCommission").modal("show");
    })

}

$("body").on("click", "img.view-detail-commission-history", function () {
    setTimeout(() => {
        thisPage.historyDetail($(this).attr("item-id"));
    }, 50)
})

thisPage.renderCommissionHistory = (l) => {
    let _html = '';
    let i = 1;

    if (l.length > 0)
        l.forEach(function (item) {
            _html += `<tr>
                        <td source="${item.source}">${item.id}</td>
                        <td id="ch_fullname_${item.id}">${item.fullname}</td>
                        <td id="ch_total_${item.id}">${number_format(item.amount, 0, '.', ',')}</td>
                        <td id="ch_total_delivered_${item.id}">${number_format(item.total_delivered, 0, '.', ',')}</td>
                        <td id="ch_created_by_${item.id}">${item.created_by_fullname}</td>
                        <td id="ch_created_at_${item.id}">${date_format("d/m/y H:i", item.created_at)}</td>
                        <td id="ch_note_${item.id}">${item.note}</td>
                        <td>
                            <img title="Xem chi tiết" item-id="${item.id}" src="${domain}/public/images/nohidden.png" alt="" width="24" class="product img_edit_product view-detail-commission-history">
                        </td>
                    </tr>`;
        })
    else
        _html += `<tr>
                    <td colspan="6">Chưa có thông tin</td>
                </tr>`;

    return _html;
}

thisPage.renderCommissionHistoryList = (l) => {
    let _html = '';
    let i = 1;

    if (l.length > 0)
        l.forEach(function (item) {
            _html += `<tr>
                        <td source="${item.source}">${i}. #${item.id}</td>
                        <td>${item.fullname}</td>
                        <td>${number_format(item.commission, 0, '.', ',')}</td>
                        <td>${item.mlm_level_name}</td>
                    </tr>`;
        })
    else
        _html += `<tr>
                    <td colspan="6">Chưa có thông tin</td>
                </tr>`;

    return _html;
}


/*
- BEGIN COMMISSION HISTORY
*/