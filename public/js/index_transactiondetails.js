var thisPage = {};

thisPage.txtSearching       = $("#txt_searching");
thisPage.tplList            = $("#tpl_list");
thisPage.tplVND          = $("#tpl_vnd");
thisPage.tplVNDC            = $("#tpl_vndc");
thisPage.tplBRS           = $("#tpl_brs");
thisPage.tplVSG          = $("#tpl_vsg");
thisPage.page_html          = $("#page_html");
thisPage.current_page       = 1;
thisPage.globalID           = '';
thisPage.dVND           = $("#d_vnd");
thisPage.dVNDC          = $("#d_vndc");
thisPage.dBRS          = $("#d_brs");
thisPage.dVSG          = $("#d_vsg");
thisPage.id         = $("#id");

$(function(){

    thisPage.txtSearching.keyup(function(){
        thisPage.current_page = 1;
        thisPage.funcsFilter();
    })

    thisPage.funcsFilter();

    $("#tab_dpoint").click(function () {
        $("#current_page_vnd").val(1);
        thisPage.funcsFitlerPoint('vnd', thisPage.id.val());
    })
    $("#tab_dgh").click(function () {
        $("#current_page_vndc").val(1);
        thisPage.funcsFitlerPoint('vndc', thisPage.id.val());
    })
    $("#tab_dss").click(function () {
        $("#current_page_brs").val(1);
        thisPage.funcsFitlerPoint('brs', thisPage.id.val());
    })
    $("#tab_dss").click(function () {
        $("#current_page_vsg").val(1);
        thisPage.funcsFitlerPoint('vsg', thisPage.id.val());
    })
    $("#btn_sync_client").click(function(){
        thisPage.funcsSync();
    })
})

thisPage.funcsSync = () => {
    _doAjaxNod('POST', '', 'investor', 'idx', 'sync_point', true, (res) => {
        thisPage.funcsFilter();
    })
}

function paging_ajax3( _page ){
    thisPage.current_page = _page;
    thisPage.funcsFilter();
}

function paging_dpoint( _page ){
    $("#current_page_vnd").val( _page );
    thisPage.funcsFitlerPoint('vnd', thisPage.id.val());
}
function paging_dgh( _page ){
    $("#current_page_vndc").val( _page );
    thisPage.funcsFitlerPoint('vndc', thisPage.id.val());
}
function paging_dss( _page ){
    $("#current_page_brs").val( _page );
    thisPage.funcsFitlerPoint('brs', thisPage.id.val());
}
function paging_dss( _page ){
    $("#current_page_vsg").val( _page );
    thisPage.funcsFitlerPoint('vsg', thisPage.id.val());
}

thisPage.funcsFilter = () => {
    let data = new FormData();
    data.append('keyword', thisPage.txtSearching.val());
    data.append('page', thisPage.current_page);
    _doAjaxNod('POST', data, 'investor', 'idx', 'filter_sort_point', true, (res) => {
        let _html = thisPage.funcsTPL(res.data.l);
        thisPage.tplList.html(_html);
        thisPage.page_html.html(res.data.page_html);
    })
}

thisPage.funcsTPL = (l) => {
    let _html = '';
    if ( l ) {
        let i = 1;
        l.forEach(function (item) {
            _html += `<tr>
                        <td class='investor_transaction' investor-id="${item.id}">${i++}</td>
                        <td class='investor_transaction' investor-id="${item.id}">
                            <span class="dt-span">${item.username == null?"":item.username}</span>
                        </td>
                        <td class='investor_transaction' investor-id="${item.id}">
                            <span class="dt-span">${item.fullname == null?"":item.fullname}</span>
                        </td>
                        <td class='investor_transaction' investor-id="${item.id}">
                            <span class="dt-span">${item.email == null?"":item.email}</span>
                        </td>
                        <td class='investor_transaction' investor-id="${item.id}">
                            <span class="dt-span">${item.mobile == null?"":item.mobile}</span>
                        </td>
                        <td class='investor_transaction' investor-id="${item.id}">
                            <span class="dt-span">${number_format(item.VND, 0, '.', ',')}</span>
                        </td>
                        <td class='investor_transaction' investor-id="${item.id}">
                            <span class="dt-span">${number_format(item.VNDC, 0, '.', ',')}</span>
                        </td>
                        <td class='investor_transaction' investor-id="${item.id}">
                            <span class="dt-span">${number_format(item.BRS, 0, '.', ',')}</span>
                        </td>
                        <td class='investor_transaction' investor-id="${item.id}">
                            <span class="dt-span">${number_format(item.VSG, 0, '.', ',')}</span>
                        </td>
                        <td class='img_edit_investor icon-activate' investor-id="${item.id}"><img width='30%' src="${domain}/public/images/${item.activate}.png"/></td>
                        </tr>`;
        })
    }
    return _html;
}

thisPage.reloadFilter = () =>{
    
    if ($("#tab_vnd").hasClass("active")){
        $("#current_page_vnd").val(1);
        thisPage.funcsFitlerPoint('vnd', thisPage.id.val());
    }else if ($("#tab_vndc").hasClass("active")){
        $("#current_page_vndc").val(1);
        thisPage.funcsFitlerPoint('vndc', thisPage.id.val());
    } else if ($("#tab_brs").hasClass("active")){
        $("#current_page_brs").val(1);
        thisPage.funcsFitlerPoint('dss', thisPage.id.val());
    }else if ($("#tab_vsg").hasClass("brs")){
        $("#current_page_vsg").val(1);
        thisPage.funcsFitlerPoint('vsg', thisPage.id.val());
    }
}

thisPage.funcsFitlerPoint = (_type, _id) => {

    let data = new FormData();

    data.append('id', _id);//withdraw
    data.append('type', _type);//withdraw
    data.append('page', $("#current_page_"+_type ).val());//withdraw|deposit
    _doAjaxNod('POST', data, 'transaction', _type, 'filter', true, (res) => {
        let _htmls = thisPage.funcsTPLPoint(res.data);
        if(_type=="vnd"){
            thisPage.tplVND.html(_htmls);
        }else if(_type=="vndc"){
            thisPage.tplVNDC.html(_htmls);
        }else if(_type=="brs"){
            thisPage.tplBRS.html(_htmls);
        }else if(_type=="vsg"){
            thisPage.tplVSG.html(_htmls);
        }
    })

}

thisPage.funcsTPLPoint = (l) => {
    let _htmls = '';
    if ( l ) {
        let i = 1;
        l.forEach(function (item) {
            _htmls += `<tr>
                                <td>${i++}</td>
                                <td>${item.relatedKind == "system"? item.relatedKind : item.relatedUser.shortDisplay}</td>
                                <td>${item.relatedKind == "system"? item.relatedKind : item.relatedUser.display}</td>
                                <td>${item.description == null ? '' : item.description}</td>
                                <td style="color: ${item.amount < 0 ? 'red' : 'green'}">${number_format(item.amount, 0, '.', ',')}</td>
                                <td>${date_format("d/m/Y", item.day)}</td>
                            </tr>`;
        })
    }
    return _htmls;
}

$('body').on('click', '.investor_transaction', function(e) {
    let _id = $(this).attr("investor-id");
    if( _id && _id != "" )
        thisPage.funcsDetailInvestor( _id );
        thisPage.globalID = _id;
        thisPage.funcsFitlerPoint('vnd', thisPage.globalID);
});

$('body').on('click', '.infomation_investor > i', function(e) {
    thisPage.toggleForm();
});
thisPage.toggleForm = ()=>{
    $('.infomation_investor').toggle();
    $('.search-order').toggle();
    $('.table-detail').toggle();
}

thisPage.funcsDetailInvestor = (_id) => {
    let data = new FormData();
    data.append('id', _id);
    _doAjaxNod('POST', data, 'transaction', 'idx', 'dpoint_investor', true, (res) => {
        thisPage.dVND.val( number_format(res.data.VND, 0, '.', ',') );
        thisPage.dVNDC.val( number_format(res.data.VNDC, 0, '.', ',') );
        thisPage.dBRS.val( number_format(res.data.BRS, 0, '.', ',') );
        thisPage.dVSG.val( number_format(res.data.VSG, 0, '.', ',') );
        thisPage.id.val(_id);
        thisPage.toggleForm();
    });
}

