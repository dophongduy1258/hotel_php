let thisPage = {};

// Show form deposit
thisPage.toggleInfomationTransactionDeposit = ( _is_show )=>{
   
    if( _is_show == 1 ){
        $(".content-form").hide();
        $(".infomation_transaction_deposit").show();
    }else{
        $(".content-form").hide();
        $(".status_transaction").show();
        $(".table-detail").show();
        $(".search-order").show();
    }

    thisPage.dSearching.val('');
    thisPage.dName.val('');
    thisPage.dName.attr('username', "");
    thisPage.dName.attr('user_id', "");
    thisPage.dBalance.val('');
    thisPage.dMobile.val('');
    thisPage.dEmail.val('');
    thisPage.dValue.val('');
    thisPage.dBRS.val('');
    thisPage.dVND.val('');
    thisPage.dVNDC.val('');
    thisPage.dVSG.val('');
    thisPage.dNote.val('');
}
$('body').on('click', '.btn_deposit', function (e) {
    thisPage.toggleInfomationTransactionDeposit( 1 );
});
$('body').on('click', '.infomation_transaction_deposit .fa.fa-angle-left, .btn-close-infomation_transaction.deposit.cancel', function (e) {
    thisPage.toggleInfomationTransactionDeposit( 0 );
});

//Show deposit bill
thisPage.toggleTransactionPayNowDeposit = ( _is_show )=>{

    if ( _is_show == 1 ) {
        $(".content-form").hide();
        $(".infomation_transaction_deposit_bill").show();
    } else {
        $(".content-form").hide();
        $(".status_transaction").show();
        $(".table-detail").show();
        $(".search-order").show();
    }

}
$('body').on('click', '.infomation_transaction_deposit_bill .fa.fa-angle-left,#deposit-printing,#d_btn_ok', function (e) {
    thisPage.toggleTransactionPayNowDeposit( 0 );
});

// show withdraw form
thisPage.toggleInfomationTransactionWithdraw = ( _is_show ) => {

    if (_is_show == 1) {
        $(".content-form").hide();
        $(".infomation_transaction_withdraw").show();
    } else {
        $(".content-form").hide();
        $(".status_transaction").show();
        $(".table-detail").show();
        $(".search-order").show();
    }

    thisPage.wSearching.val('');
    thisPage.wName.val('');
    thisPage.wName.attr('username', "");
    thisPage.wName.attr('user_id', "");
    thisPage.wBalance.val('');
    thisPage.wMobile.val('');
    thisPage.wEmail.val('');
    thisPage.wValue.val('');
    thisPage.wBRS.val('');
    thisPage.wVND.val('');
    thisPage.wVNDC.val('');
    thisPage.wVSG.val('');
    thisPage.wNote.val('');
}
$('body').on('click', '.btn_withdraw', function (e) {
    thisPage.toggleInfomationTransactionWithdraw( 1 );
});
$('body').on('click', '.infomation_transaction_withdraw .fa.fa-angle-left, .btn-close-infomation_transaction.withdraw.cancel', function (e) {
    thisPage.toggleInfomationTransactionWithdraw( 0 );
});

// show detail withdraw bill
thisPage.toggleTransactionPayNowWithdraw = ( _is_show ) => {
    if ( _is_show == 1 ) {
        $(".content-form").hide();
        $(".infomation_transaction_withdraw_bill").show();
    } else {
        $(".content-form").hide();
        $(".status_transaction").show();
        $(".table-detail").show();
        $(".search-order").show();
    }
}
$('body').on('click', '.infomation_transaction_withdraw_bill .fa.fa-angle-left, #w_btn_ok, .withdraw-printing.cancel', function (e) {
    thisPage.toggleTransactionPayNowWithdraw( 0 );
});

thisPage.slDeposit          = $("#slDeposit");
thisPage.txtSearching       = $("#txt_searching");
thisPage.from               = $("#from");
thisPage.to                 = $("#to");
thisPage.tplListTransaction = $("#tpl_list_transaction");
thisPage.totalTransactions  = $("#total_transactions");
thisPage.noTransactions     = $("#no_transactions");

thisPage.dSearching         = $("#d_searching");
thisPage.dName              = $("#d_name");
thisPage.dBalance           = $("#d_balance");
thisPage.dBRS               = $("#d_brs");
thisPage.dVND               = $("#d_vnd");
thisPage.dVNDC              = $("#d_vndc");
thisPage.dVSG               = $("#d_vsg");
thisPage.dMobile            = $("#d_mobile");
thisPage.dEmail             = $("#d_email");
thisPage.dValue             = $("#d_value");
thisPage.dNote              = $("#d_note");
thisPage.dBtn               = $("#d_btn");

thisPage.dTransactionID     = $("#d_transaction_id");
thisPage.dDate              = $("#d_date");
thisPage.dAmount            = $("#d_amount");
thisPage.dInfo              = $("#d_info");
thisPage.dMemo              = $("#d_memo");
thisPage.dBtnOK             = $("#d_btn_ok");

thisPage.wSearching         = $("#w_searching");
thisPage.wName              = $("#w_name");
thisPage.wBalance           = $("#w_balance");
thisPage.wBRS               = $("#w_brs");
thisPage.wVND               = $("#w_vnd");
thisPage.wVNDC              = $("#w_vndc");
thisPage.wVSG               = $("#w_vsg");
thisPage.wMobile            = $("#w_mobile");
thisPage.wEmail             = $("#w_email");
thisPage.wValue             = $("#w_value");
thisPage.wNote              = $("#w_note");
thisPage.wBtn               = $("#w_btn");

thisPage.wTransactionID     = $("#w_transaction_id");
thisPage.wDate              = $("#w_date");
thisPage.wAmount            = $("#w_amount");
thisPage.wInfo              = $("#w_info");
thisPage.wMemo              = $("#w_memo");
thisPage.wBtnOK             = $("#w_btn_ok");

$(function(){

    thisPage.from.datepicker();
    thisPage.to.datepicker();

    thisPage.txtSearching.keyup(function(){
        thisPage.funcsFilter();
    })

    $("#from, #to").change(function(){
        thisPage.funcsFilter();
    })

    $("#slDeposit").change(function(){
        thisPage.funcsFilter();
    })

    thisPage.funcsFilter();

    thisPage.wBtn.click(function(){
        thisPage.funcsWithDraw();
    })

    thisPage.dBtn.click(function () {
        thisPage.funcsDeposit();
    })

})

thisPage.dSearching.autocomplete({
    minLength: 1,
    option: 'appendTo',
    source: function (request, response) {

        var keyword = thisPage.dSearching.val();

        let data = new FormData();
        data.append('keyword', keyword);
        _doAjaxNod('POST', data, 'transaction', 'idx', 'search_investor', false, (res) => {
            response($.map(res.data, function (el) {
                return {
                    label: el.fullname + ' (' + el.username + ')',
                    fullname: el.fullname,
                    user_id: el.id,
                    mobile: el.mobile,
                    email: el.email,
                    value: '',
                    username: el.username
                };
            }));
        });

    },
    select: function (e, ui) {

        //add items
        setTimeout(() => {
            thisPage.dName.val(ui.item.fullname);
            thisPage.dName.attr("username", ui.item.username);
            thisPage.dName.attr("user_id", ui.item.user_id);
            thisPage.dEmail.val(ui.item.email);
            thisPage.dMobile.val(ui.item.mobile);
            thisPage.dSearching.val("");
        }, 300);

        thisPage.funcsDetailInvestor(ui.item.username, 1 );
    }
});

thisPage.wSearching.autocomplete({
    minLength: 1,
    option: 'appendTo',
    source: function (request, response) {

        var keyword = thisPage.wSearching.val();

        let data = new FormData();
        data.append('keyword', keyword);
        _doAjaxNod('POST', data, 'transaction', 'idx', 'search_investor', false, (res) => {
            response($.map(res.data, function (el) {
                return {
                    label: el.fullname + ' (' + el.username + ')',
                    fullname: el.fullname,
                    user_id: el.id,
                    email: el.email,
                    mobile: el.mobile,
                    value: '',
                    username: el.username
                };
            }));
        });

    },
    select: function (e, ui) {

        //add items
        setTimeout(() => {
            thisPage.wName.val(ui.item.fullname);
            thisPage.wName.attr("username", ui.item.username);
            thisPage.wName.attr("user_id", ui.item.user_id);
            thisPage.wEmail.val(ui.item.email);
            thisPage.wMobile.val(ui.item.mobile);
            thisPage.wSearching.val("");
        }, 300);

        thisPage.funcsDetailInvestor( ui.item.username, 0 );
    }
});

thisPage.funcsDetailInvestor = (_username, _is_deposit) => {
    let data = new FormData();
    data.append('username', _username);
    _doAjaxNod('POST', data, 'transaction', 'idx', 'detail_investor', true, (res) => {
        if (_is_deposit == 1 ){
            thisPage.dBalance.val( number_format(res.data.VND, 0, '.', ',') );
            // thisPage.dBRS.val( number_format(res.data.BRS, 0, '.', ',') );
            // thisPage.dVND.val( number_format(res.data.VND, 0, '.', ',') );
            // thisPage.dVNDC.val( number_format(res.data.VNDC, 0, '.', ',') );
            // thisPage.dVSG.val( number_format(res.data.VSG, 0, '.', ',') );
        }else{
            thisPage.wBalance.val( number_format(res.data.VND, 0, '.', ',') );
            // thisPage.wBRS.val( number_format(res.data.BRS, 0, '.', ',') );
            // thisPage.wVND.val( number_format(res.data.VND, 0, '.', ',') );
            // thisPage.wVNDC.val( number_format(res.data.VNDC, 0, '.', ',') );
            // thisPage.wVSG.val( number_format(res.data.VSG, 0, '.', ',') );
        }
    });
}

thisPage.funcsWithDraw = (password, email) => {

    let _username   = thisPage.wName.attr("username");
    let _user_id    = thisPage.wName.attr("user_id");
    let _fullname   = thisPage.wName.val();
    let _password   = password;
    let _email      = email;
    let _amount     = thisPage.wValue.val();
    let _description     = thisPage.wNote.val();
    _amount = SplitNumber2( _amount );

    let _balance   = "";
    // let _type   = "";

    // if($("#radio_wVSG").is(":checked")){
    //     _balance = thisPage.wVSG.val();
    //     _type = "wVSG";
    // }else if($("#radio_wVND").is(":checked")){
    //     _balance = thisPage.wVND.val();
    //     _type = "wVNDC";
    // }else if($("#radio_wVNDC").is(":checked")){
    //     _balance = thisPage.wVNDC.val();
    //     _type = "wVND";
    // }else if($("#radio_wBRS").is(":checked")){
    //     _balance = thisPage.wBRS.val();
    //     _type = "wBRS";
    // }

    _balance = SplitNumber2(_balance );

    if( _username == '' ){
        alert_dialog("Vui lòng chọn nhà đầu tư để rút tiền");
    } else if ( parseInt(_amount) < 1) {
        alert_dialog("Vui lòng nhập số tiền hợp lệ.");
    } else if (parseInt(_amount) > parseInt(_balance) ) {
        alert_dialog( "Số dư hiện tại chỉ còn: "+ number_format( _balance, 0, '.', ',') );
    }else if( _description == '' ){
        alert_dialog("Vui lòng nhập nội dung");
    }else if( _password == '' ){
        alert_dialog("Vui lòng nhập mật khẩu");
    }else{
        let data = new FormData();
        data.append('username', _username);
        data.append('user_id', _user_id);
        data.append('fullname', _fullname );
        data.append('amount', _amount );
        // data.append('type', _type );
        data.append('description', _description);
        data.append('password', _password );
        data.append('email', _email );
        _doAjaxNod('POST', data, 'transaction', 'withdraw', 'add', true, (res) => {
            thisPage.funcsFilter();

            thisPage.wTransactionID.html(res.data.id);
            thisPage.wDate.html(date_format_full(res.data.created_at));
            thisPage.wAmount.html(number_format(res.data.amount, 0, '.', ','));
            let _info = `<span class="form-control">
                            ${res.data.related_name}
                            <span>${thisPage.wMobile.val()}</span>
                        </span>`;
            thisPage.wInfo.html(_info);
            thisPage.wMemo.val(res.data.description);

            $("#checkPass").modal("hide");
            thisPage.toggleTransactionPayNowWithdraw( 1 );        
        })
    }

}

thisPage.funcsDeposit = (password, email) => {

    let _username   = thisPage.dName.attr("username");
    let _user_id    = thisPage.dName.attr("user_id");
    let _fullname   = thisPage.dName.val();
    let _password   = password;
    let _email      = email;
    let _mobile     = thisPage.dMobile.val();
    let _amount     = thisPage.dValue.val();
    let _description     = thisPage.dNote.val();
    _amount         = SplitNumber2(_amount);

    // let _type   = "";

    // if($("#radio_dBRS").is(":checked")){
    //     _type = "dBRS";
    // }else if($("#radio_dVND").is(":checked")){
    //     _type = "dVND";
    // }else if($("#radio_dVNDC").is(":checked")){
    //     _type = "dVNDC";
    // }else if($("#radio_dVSG").is(":checked")){
    //     _type = "dVSG";
    // }

    if (_username == '') {
        alert_dialog("Vui lòng chọn nhà đầu tư để rút tiền");
    } else if ( parseInt(_amount) < 1) {
        alert_dialog("Vui lòng nhập số tiền hợp lệ.");
    }else if( _description == '' ){
        alert_dialog("Vui lòng nhập nội dung");
    }else if( _password == '' ){
        alert_dialog("Vui lòng nhập mật khẩu");
    } else {
        let data = new FormData();

        data.append('username', _username );
        data.append('user_id', _user_id );
        data.append('fullname', _fullname );
        data.append('amount', _amount );
        // data.append('type', _type );
        data.append('description', _description);
        data.append('password', _password );
        data.append('email', _email );
        _doAjaxNod('POST', data, 'transaction', 'deposit', 'add', true, (res) => {
            thisPage.funcsFilter();
            
            thisPage.dTransactionID.html( res.data.id );
            thisPage.dDate.html( date_format_full(res.data.created_at) );
            thisPage.dAmount.html( number_format(res.data.amount, 0, '.', ',') );
            let _info = `<span class="form-control">
                            ${res.data.related_name}
                            <span>${_mobile}</span>
                        </span>`;
            thisPage.dInfo.html( _info );
            thisPage.dMemo.val( res.data.description );

            $("#checkPass").modal("hide");
            thisPage.toggleTransactionPayNowDeposit( 1 );          
        })
    }

}

thisPage.funcsFilter = ()=>{
    
    let data = new FormData();
    data.append('keyword', thisPage.txtSearching.val() );
    data.append('from', thisPage.from.val());
    data.append('to', thisPage.to.val());
    data.append('is_deposit', thisPage.slDeposit.val());
    _doAjaxNod('POST', data, 'transaction', 'idx', 'filter', true, (res)=>{
        thisPage.tplListTransaction.html( thisPage.funcsTPL( res.data.lItems ) );
        thisPage.totalTransactions.html(number_format(res.data.sum, 0, '.', ','))
        thisPage.noTransactions.html(number_format(res.data.records, 0, '.', ','));
    })

}

thisPage.funcsTPL = (l)=>{
    let _html = '';
    let i = 1;
    if( l ){
        l.forEach( (item) => {
            _html += `<tr>
                        <td>${item.id}</td>
                        <td>
                            <span class="dt-span">${date_format_full(item.created_at)}</span>
                        </td>
                        <td>
                            <span class="dt-span">${item.related_name}</span>
                        </td>
                        <td>
                            <span class="dt-span">${number_format( item.amount, 0, '.', ',' )}</span>
                        </td>
                        <td>
                            <span class="dt-span">${number_format(item.fee, 0, '.', ',')}</span>
                        </td>
                        <td>
                            <span class="dt-span">${number_format( (parseInt(item.amount) + parseInt(item.fee)), 0, '.', ',')}</span>
                        </td>
                        <td>
                            <span class="dt-span">${item.description}</span>
                        </td>
                        <td>
                            <span class="dt-span">${item.create_by_admin}</span>
                        </td>
                        <td class="text-left">
                            ${ parseInt(item.is_deposit) == 1 ? '<span class="dt-span user_deposit">Nạp tiền</span>':'<span class="dt-span user_withdraw">Rút tiền</span>'}
                        </td>
                    </tr>`;
        });
    }
    return _html;
}