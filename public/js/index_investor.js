var thisPage = {};

thisPage.txtSearching       = $("#txt_searching");
thisPage.tplList            = $("#tpl_list");
thisPage.page_html          = $("#page_html");
thisPage.current_page       = 1;
thisPage.globalID           = '';

$(function(){

    thisPage.txtSearching.keyup(function(){
        thisPage.current_page = 1;
        thisPage.funcsFilter();
    })

    thisPage.funcsFilter();

    $("#btn_confirm_reset_password").click(function(){
        thisPage.funcsResetPassword();
    })

    $("#btn_modify_investor").click(function(){
        thisPage.funcsSave();
    })
    $("#btn_sync_client").click(function(){
        thisPage.funcsSync();
    })
    
})

thisPage.funcsSync = () => {
    _doAjaxNod('POST', '', 'investor', 'idx', 'sync', true, (res) => {
        thisPage.funcsFilter();
    })
}

function paging_ajax3(_page) {
    thisPage.current_page = _page;
    thisPage.funcsFilter();
}

thisPage.funcsFilter = () => {
    let data = new FormData();
    data.append('keyword', thisPage.txtSearching.val());
    data.append('page', thisPage.current_page);
    _doAjaxNod('POST', data, 'investor', 'idx', 'filter', true, (res) => {
        let _html = thisPage.funcsTPL(res.data.l);
        thisPage.tplList.html(_html);
        thisPage.page_html.html(res.data.page_html);
    })
}

thisPage.funcsResetPassword = () => {
    let data = new FormData();
    data.append('id', thisPage.globalID);
    _doAjaxNod('POST', data, 'investor', 'password_reset', 'reset', true, (res) => {
        $("#resetPassword").modal("hide");
        alert_void("Mật khẩu mới đã được gửi thành công!", 1);
    })
}

thisPage.funcsTPL = (l) => {
    let _html = '';
    if ( l ) {
        let i = 1;
        l.forEach(function (item) {
            _html += `<tr>
                        <td class='img_edit_investor' investor-id="${item.id}">${i++}</td>
                        <td class='img_edit_investor' investor-id="${item.id}">${item.username}</td>
                        <td class='img_edit_investor' investor-id="${item.id}">
                            <span class="dt-span">${item.fullname}</span>
                        </td>
                        <td class='img_edit_investor' investor-id="${item.id}">
                            <span class="dt-span">${item.email}</span>
                        </td>
                        <td class='img_edit_investor' investor-id="${item.id}">
                            <span class="dt-span">${item.mobile}</span>
                        </td>
                        <td class='img_edit_investor' investor-id="${item.id}">${date_format("d/m/Y",item.joined_at)}</td>
                        <td>
                            <img src="${domain}/public/images/reset.png" alt="" width="24" investor-id="${item.id}" class="img_reset_investor">
                            <img src="${domain}/public/images/edit.png" alt="" width="24" investor-id="${item.id}" class="img_edit_investor" style="margin-left: 4px !important;">
                            <img style="opacity:0.2" src="${domain}/public/images/delete.png" alt="" width="24" class="img_delete_investor" style="margin-left: 4px !important;">
                        </td>
                    </tr>`;
        })
    }
    return _html;
}

$('body').on('click', '.img_reset_investor', function (e) {
    let _id = $(this).attr("investor-id");
    thisPage.globalID = _id;
    $("#resetPassword").modal("show");
});

// update edit investor
$('body').on('click', '.img_edit_investor', function(e) {
    thisPage.toggleForm();

    let _id = $(this).attr("investor-id");
    if( _id && _id != "" )
        thisPage.funcsDetail( _id );
});

$('body').on('click', '.infomation_investor > i, .btn-close-infomation_code.cancel', function(e) {
    thisPage.toggleForm();
});
$('body').on('click', '#btn_add_investor', function(e) {
    thisPage.emptyForm();
    thisPage.toggleForm();
    alert('ádsa');
});
thisPage.toggleForm = ()=>{
    $('.infomation_investor').toggle();
    $('.table-detail').toggle();
    $('.search-order').toggle();
}

thisPage.emptyForm = () =>{
    thisPage.globalIDEdit = '';
    thisPage.username.val('');
    thisPage.name.val('');
    thisPage.email.val('');
    thisPage.mobilePhone.val('');
    thisPage.activate.val('1');
    thisPage.diachi.val('');
    thisPage.bankaccnum.val('');
    thisPage.beneficiary.val('');
    thisPage.bankname.val('');
    thisPage.branch.val('');
}
/*
- Detail Investor
*/
thisPage.username       = $("#username");
thisPage.name           = $("#name");
thisPage.email          = $("#email");
thisPage.mobilePhone    = $("#mobilePhone");
thisPage.activate       = $("#activate");
thisPage.diachi         = $("#diachi");
thisPage.bankaccnum     = $("#bankaccnum");
thisPage.beneficiary    = $("#beneficiary");
thisPage.bankname       = $("#bankname");
thisPage.branch         = $("#branch");
thisPage.globalIDEdit   = '';

thisPage.funcsDetail = ( _id ) => {
    let data = new FormData();
    data.append('id', _id);
    _doAjaxNod('POST', data, 'investor', 'idx', 'detail', true, (res) => {
        thisPage.globalIDEdit = res.data.id;
        thisPage.username.val(res.data.username );
        thisPage.name.val( res.data.fullname );
        thisPage.email.val( res.data.email );
        thisPage.mobilePhone.val( res.data.mobile );
        thisPage.activate.val( res.data.activate );
        thisPage.diachi.val( res.data.diachi );
        thisPage.bankaccnum.val( res.data.bankaccnum );
        thisPage.beneficiary.val( res.data.beneficiary );
        thisPage.bankname.val( res.data.bankname );
        thisPage.branch.val( res.data.branch );
    })
}

thisPage.funcsSave = () => {

    let _username           = thisPage.username.val();
    let _name               = thisPage.name.val();
    let _email              = thisPage.email.val();
    let _mobilePhone        = thisPage.mobilePhone.val();
    let _activate           = thisPage.activate.val();
    let _diachi             = thisPage.diachi.val();
    let _bankaccnum         = thisPage.bankaccnum.val();
    let _beneficiary        = thisPage.beneficiary.val();
    let _bankname           = thisPage.bankname.val();
    let _branch             = thisPage.branch.val();

    if ( _username == '' || _username.length < 5 ){
        alert_dialog("Mã nhà đầu tư tối thiểu 5 ký tự");
    } else if ( _name == '' || _name.length < 5 ){
        alert_dialog("Mã nhà đầu tư tối thiểu 5 ký tự");
    }else{

        let data = new FormData();
        data.append('id', thisPage.globalIDEdit );
        data.append('username', _username );
        data.append('name', _name );
        data.append('email', _email );
        data.append('mobilePhone', _mobilePhone );
        data.append('activate', _activate );
        data.append('diachi', _diachi );
        data.append('bankaccnum', _bankaccnum );
        data.append('beneficiary', _beneficiary );
        data.append('bankname', _bankname );
        data.append('branch', _branch );
        _doAjaxNod('POST', data, 'investor', 'save', 'save', true, (res) => {
            thisPage.globalIDEdit = '';
            thisPage.toggleForm();
        })
        
    }
}