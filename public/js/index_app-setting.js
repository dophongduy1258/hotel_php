var thisPage = {};

thisPage.global_id_delete = '';

$(function () {

    $("#btn_confirm_delete").click(function () {
        thisPage.delete();
    })

    $("#btn_add_app_setting").click(function () {
        $("#app-setting-title").val('');
        $("#app-setting-link").val('');
        $("#app-setting-img").val('');
        $("#addModal").modal("show");
    })

    $("#btn_add").click(function () {
        thisPage.funcsAdd();
    })

    thisPage.filter();

})

$("body").on("click", "button.btn_update_app_setting", function () {
    let _app_setting_id = $(this).attr("app-setting-id");
    if ($("#btn_update_app_setting_" + _app_setting_id).html() == 'Xong') {
        $(".app-setting-list-" + _app_setting_id).prop("disabled", true);
        thisPage.funcsSave(_app_setting_id);
        $("#btn_update_app_setting_" + _app_setting_id).html("Cập nhật");
    } else {
        $(".app-setting-list-" + _app_setting_id).prop("disabled", false);
        $("#btn_update_app_setting_" + _app_setting_id).html("Xong");
    }
})

$("body").on("click", "button.btn-danger.delete", function () {
    let _app_setting_id = $(this).attr("app-setting-id");
    thisPage.modalDelete(_app_setting_id);
})

thisPage.modalDelete = (_id) => {
    $("#delete_app_setting").html($("#app-setting-title-" + _id).val());
    $("#deleteModal").modal("show");
    thisPage.global_id_delete = _id;
}

thisPage.filter = () => {
    _doAjaxNod('POST', '', 'app_setting', 'idx', 'filter', true, (res) => {
        thisPage.render(res.data);
    })
}

thisPage.render = (_l) => {
    let h = '';
    _l.forEach(function (item) {
        h += `<div class="col-sm-6 col-xs-12">
                <div class="col-sm-12 col-xs-12 bg-white bank-holder">
                    <div class="holder-suggested1">
                        <div class="row">

                            <div class="col-sm-12 col-xs-12 top-10 text-right">
                                <div class="input_name">
                                    <label>
                                        Đặt hình ảnh trung tâm
                                        <input id="center-icon-${item.id}" ${item.is_center_icon == 1 ? 'checked':''} app-setting-id="${item.id}" class="form-control ace app-setting-is-center-icon" type="checkbox">
                                        <span class="lbl"></span>
                                    </label>
                                </div>
                            </div>
 
                            <div class="col-sm-12 col-xs-12">
                                <label class="label_name">Tiêu đề</label>
                                <div class="input_name">
                                    <input maxlength="100" id="app-setting-title-${item.id}" disabled placeholder="${item.title}" app-setting-id="${item.id}" value="${item.title}" class="form-control app-setting-title app-setting-list-all  app-setting-list-${item.id}" type="text">
                                </div>
                            </div>

                            <div class="col-sm-12 col-xs-12">
                                <label class="label_name">Liên kết</label>
                                <div class="input_name">
                                    <input id="app-setting-link-${item.id}" disabled placeholder="${item.link}" app-setting-id="${item.id}" value="${item.link}" class="form-control app-setting-list-all  app-setting-list-${item.id}" type="text">
                                </div>
                            </div>

                            <div class="col-sm-12 col-xs-12">
                                <label class="label_name">Ảnh đại diện</label>
                                <div class="input_name">
                                    <input id="app-setting-img-${item.id}" disabled placeholder="${item.img}" app-setting-id="${item.id}" value="${item.img}" class="form-control app-setting-list-all  app-setting-list-${item.id}" type="text">
                                </div>
                            </div>

                            <div class="col-sm-12 col-xs-12">
                                <div class="input_name">
                                    <label class="label_name">
                                        <input id="app-setting-is_hidden-${item.id}" disabled placeholder="${item.img}" app-setting-id="${item.id}" value="${item.is_hidden}" ${item.is_hidden == '1' ? 'checked':''} class="ace  app-setting-list-all  app-setting-list-${item.id}" type="checkbox">
                                        <span class="lbl"></span>Ẩn chức năng này
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                    <div class="margin-b-30">
                        <div class="text-left">
                            <button app-setting-id="${item.id}" onclick="thisPage.top(${item.id})" class="btn btn-default top btn-update">Lên Đầu</button>
                            <button app-setting-id="${item.id}" class="btn btn-danger delete btn-update">Xóa</button>
                            <button id="btn_update_app_setting_${item.id}"  app-setting-id="${item.id}" class="btn btn_update_app_setting btn-update">Cập nhật</button>
                        </div>
                    </div>
                    
                </div>
            </div>`;
    })

    $("#tpl_list").html(h);
    return true;
}

thisPage.delete = () => {
    let data = new FormData();
    data.append('id', thisPage.global_id_delete);
    _doAjaxNod('POST', data, 'app_setting', 'idx', 'delete', true, (res) => {
        $("#deleteModal").modal("hide");
        thisPage.render(res.data);
    })
}

thisPage.funcsSave = (_id) => {

    let _data = [];
    let item = {};

    item.id = _id;
    item.title = $("#app-setting-title-" + _id).val();
    item.link = $("#app-setting-link-" + _id).val();
    item.img = $("#app-setting-img-" + _id).val();
    item.is_hidden = $("#app-setting-is_hidden-" + _id).is(":checked") ? 1:0;
    _data.push(item);

    let data = new FormData();
    data.append('data', JSON.stringify(_data));
    _doAjaxNod('POST', data, 'app_setting', 'idx', 'save', true, (res) => {
    })

}

thisPage.top = (_id) => {

    let _data = [];
    let item = {};

    let data = new FormData();
    data.append('id', _id);
    _doAjaxNod('POST', data, 'app_setting', 'idx', 'top', true, (res) => {
        thisPage.render(res.data);
    })

}

thisPage.funcsAdd = () => {

    let item = {};
    item.title = $("#app-setting-title").val();
    item.link = $("#app-setting-link").val();
    item.img = $("#app-setting-img").val();
    item.is_hidden = 0;

    let data = new FormData();
    data.append('data', JSON.stringify(item));
    _doAjaxNod('POST', data, 'app_setting', 'idx', 'add', true, (res) => {
        $("#addModal").modal("hide");
        thisPage.render(res.data);
    })

}

//BEGIN setup main icon
$(function(){
    $("#btn_center_icon_no").click(function(){
        $("#center-icon-"+thisPage.globalIDIsCenterIcon).prop("checked", false);
    });

    $("#btn_center_icon_yes").click(function(){
       thisPage.updateCenterIcon();
    });
})
thisPage.globalIDIsCenterIcon = '';
$("body").on("click", ".app-setting-is-center-icon", function () {
    setTimeout(()=>{
        if( $(this).is(":checked") ){
            let _app_setting_id = $(this).attr("app-setting-id");
            thisPage.globalIDIsCenterIcon = _app_setting_id;
            $("#isCenterIconModal").modal("show");
        }else{
            $(this).prop("checked", true);
        }
    }, 50)
})

thisPage.updateCenterIcon = () => {
    let data = new FormData();
    data.append('id', thisPage.globalIDIsCenterIcon);
    _doAjaxNod('POST', data, 'app_setting', 'idx', 'update_center_icon', true, (res) => {
        $(".app-setting-is-center-icon").prop("checked", false);
        $("#center-icon-"+thisPage.globalIDIsCenterIcon).prop("checked", true);
        thisPage.globalIDIsCenterIcon = '';
        $("#isCenterIconModal").modal("hide");
    })
}
//END setup main icon