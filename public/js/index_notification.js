var thisPage        = {};

thisPage.listNotification       = $("#list_notification");
thisPage.tplContent             = $("#tpl_content");
thisPage.globalID               = '';

thisPage.inpTo                 = $("#inp_to");
thisPage.inpSubject            = $("#inp_subject");
thisPage.inpContent            = $("#editor");

$(function(){

    $("#btn_delete_notification").click(function(){
        thisPage.funcsDelete();
    })

    $('.add_notification, .close_noti').click(function(){
        thisPage.funcsToggle();
        thisPage.funcsEmptyForm();
    })

    $(".send_notification").click(function(){
        thisPage.funcsSave();
    })

    thisPage.funcsFilter();

    thisPage.funcsInitial();

    $("#ck_all_investor").click(function(){
       $(".list_investor_all").prop("checked", $(this).is(":checked"));
    })

    $(".close_sub_addContact").click(function(){

        $(".input_name .sub").toggle();
        $('.overlay_newnoti').toggle();
        let _to = '';
        if( $("#tab_all_investors").hasClass("active") ){
            $(".list_investor_all").each(function(){
                if( $(this).is(":checked") )
                    _to += $(this).val()+';';
            })
        }else{
            $(".list_investor_by_product").each(function () {
                if ($(this).is(":checked"))
                    _to += $(this).val() + ';';
            })
        }
        _to = _to.split(';');
        _to = [...new Set(_to)];

        thisPage.inpTo.val(_to.join(';'));
        $(".list_investor_by_product").prop("checked", false);
        $(".list_investor_all").prop("checked", false);
        $(".list_by_product").prop("checked", false);

    })

})

thisPage.funcsFilter = () => {
    let data = new FormData();
    data.append('page', 1);
    _doAjaxNod('POST', data, 'notification', 'idx', 'filter', true, (res) => {
        let _html = thisPage.funcsTPL( res.data );
        thisPage.listNotification.html( _html );
    })
}

thisPage.funcsTPL = ( l ) => {
    let _html = '';
    if (l) {
        let permission = check_permission(":staffreset_password:");
        l.forEach(function (item) {
            _html += `<li>
                        <div class="iframe notification-detail" notification-id="${item.id}">
                            <h3  notification-id="${item.id}" id="subject-${item.id}">${item.subject}</h3>
                            <span class="date">${date_format_full(item.created_at)}</span>
                            ${ permission ? `<img src="${domain}/public/images/delete.png" width="24" class="img_delete_noti" notification-id="${item.id}">`:''}
                        </div>
                    </li>`;
        })
    }
    return _html;
}

$('body').on('click', 'div.notification-detail', function (e) {
    let _notification_id = $(this).attr("notification-id");
    thisPage.funcsDetail(_notification_id );
});

thisPage.funcsDetail = ( _id ) => {
    let data = new FormData();
    data.append('id', _id);
    _doAjaxNod('POST', data, 'notification', 'idx', 'detail', true, (res) => {
        let d =     res.data;
        let _html = `<span class="date">${date_format_full(d.created_at)}</span>
                    <h2 class="form"><span> ${d.created_by_name}</span></h2>
                    <h2 class="to"><span>To:</span> ${d.to}</h2>
                    <h3 class="title">${d.subject}</h3>
                    <div class="content">
                        ${d.content}
                    </div>`;
        thisPage.tplContent.html( _html );
    })
}

thisPage.funcsSave = () => {
    let _to             = thisPage.inpTo.val();
    let _subject        = thisPage.inpSubject.val();
    let _content        = CKEDITOR.instances.editor.getData();

    if( _to == '' ){
        alert_dialog("Vui lòng nhập thông tin người nhận");
    } else if ( _subject == '' ){
        alert_dialog("Vui lòng nhập tiêu đề");
    }else if( _content == '' ){
        alert_dialog("Vui lòng nhập nội dung tin nhắn");
    }else{
        let data = new FormData();
        data.append('to', _to);
        data.append('subject', _subject);
        data.append('content', _content);
        _doAjaxNod('POST', data, 'notification', 'save', 'save', true, (res) => {
            thisPage.funcsToggle();
            thisPage.funcsFilter();
        })
    }
}

thisPage.funcsToggle = ()=>{
    $('.notification').toggle();
    $('.addNotification').toggle();
}

thisPage.funcsEmptyForm = () => {
    thisPage.inpTo.val('');
    thisPage.inpSubject.val('');
    // thisPage.inpContent.val('');
    CKEDITOR.instances.editor.setData('');
}

$('body').on('click', 'img.img_delete_noti', function (e) {
    let _notification_id = $(this).attr("notification-id");
    thisPage.globalID = _notification_id;
    $("#modal_subject").html( $("#subject-"+_notification_id).html() );
    $("#deleteNotification").modal("show");
});

thisPage.funcsDelete = ()=>{
    let data = new FormData();
    data.append('id', thisPage.globalID );
    _doAjaxNod('POST', data, 'notification', 'delete', 'delete', true, (res) => {
        thisPage.globalID = '';
        $("#deleteNotification").modal("hide");
        thisPage.funcsFilter();
    })
}

thisPage.funcsInitial = () => {
    let data = new FormData();
    _doAjaxNod('POST', '', 'notification', 'idx', 'initial', true, (res) => {
        thisPage.funcsTPLInitial(res.data.list_all, res.data.list_by_product );
    })
}

thisPage.funcsTPLInitial = (la, lp) => {
    if (la ){
        //list all investor
        let _html_la = '';
        la.forEach(function(a){
            _html_la += `<li><label><input class="ace list_investor_all" type="checkbox" value="${a.username}"><span class="lbl"></span>${a.fullname} (${a.username})</label></li>`;
        })
        $("#list_investor_all").html( _html_la );
    }

    if ( lp ) {
        //list all investor
        let _html_lp = '';
        lp.forEach(function (p) {

            let _pss = '';
            p.list_investor.forEach(function (ps) {
                _pss += `<li><label><input class="ace list_investor_by_product list_by_product_${p.code}" type="checkbox" value="${ps.username}"><span class="lbl"></span>${ps.fullname} (${ps.username})</label></li>`
            })

            _html_lp += `<li>
                            <label><input class="ace list_by_product" type="checkbox" value="${p.code}"><span class="lbl"></span>${p.code}</label>
                            <span class="down"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                            <span class="up"><i class="fa fa-angle-up" aria-hidden="true"></i></span>
                            <ul class="sub_all">${_pss}</ul>
                        </li>`;
        })
        $("#list_investor_by").html(_html_lp);
    }
}

$('body').on('click', 'input.list_by_product', function (e) {
    let _code = $(this).val();
    $(".list_by_product_" + _code).prop("checked", $(this).is(":checked"));
});


thisPage.funcsSearching = () => {
    let data = new FormData();
    _doAjaxNod('POST', '', 'notification', 'idx', 'searching', true, (res) => {
        // let d = res.data;
        // let _html = `<span class="date">${date_format("d/m/Y",d.created_at)}</span>
        //             <h2 class="form"><span> ${d.created_by}</span></h2>
        //             <h2 class="to"><span>To:</span> ${d.to}</h2>
        //             <h3 class="title">${d.subject}</h3>
        //             <div class="content">
        //                 ${d.content}
        //             </div>`;
        // thisPage.tplContent.html(_html);
    })
}