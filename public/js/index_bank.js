var thisPage = {};

thisPage.global_id_delete = '';

$(function () {

    $("#btn_confirm_delete").click(function(){
        thisPage.delete();
    })

    $("#btn_add_bank").click(function(){
        $("#bank-name").val('');
        $("#bank-code").val('');
        $("#bank-account").val('');
        $("#bank-account-name").val('');
        $("#bank-url").val('');
        $("#addModal").modal("show");
    })

    $("#btn_add").click(function () {
        thisPage.funcsAdd();
    })

    thisPage.filter();

})

$("body").on("click", "button.btn_update_bank", function(){
    let _bank_id = $(this).attr("bank-id");
    if ($("#btn_update_bank_" + _bank_id).html() == 'Xong') {
        $(".bank-list-" + _bank_id).prop("disabled", true);
        thisPage.funcsSave(_bank_id);
        $("#btn_update_bank_" + _bank_id).html("Cập nhật");
    } else {
        $(".bank-list-" + _bank_id).prop("disabled", false);
        $("#btn_update_bank_" + _bank_id).html("Xong");
    }
})

$("body").on("click", "button.btn-danger.delete", function(){
    let _bank_id = $(this).attr("bank-id");
    thisPage.modalDelete( _bank_id );
})

thisPage.modalDelete = ( _id ) => {
    $("#delete_bank").html( $("#bank-name-"+_id).val() );
    $("#deleteModal").modal("show");
    thisPage.global_id_delete = _id;
}

thisPage.filter = () => {
    _doAjaxNod('POST', '', 'bank', 'idx', 'filter', true, (res) => {
        thisPage.render(res.data );
    })
}

thisPage.render = (_l)=>{
    let h = '';
    _l.forEach(function(item){
        h += `<div class="col-sm-6 col-xs-12">
                <div class="col-sm-12 col-xs-12 bg-white bank-holder">
                    <div class="holder-suggested1">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <label class="label_name">Tên Ngân Hàng</label>
                                <div class="input_name">
                                    <input id="bank-name-${item.id}" disabled placeholder="${item.bank_name}" bank-id="${item.id}" value="${item.bank_name}" class="form-control bank-name bank-list-all  bank-list-${item.id}" type="text">
                                </div>
                            </div>

                            <div class="col-sm-12 col-xs-12">
                                <label class="label_name">Mã Ngân Hàng</label>
                                <div class="input_name">
                                    <input id="bank-code-${item.id}" disabled placeholder="${item.bank_code}" bank-id="${item.id}" value="${item.bank_code}" class="form-control bank-list-all  bank-list-${item.id}" type="text">
                                </div>
                            </div>

                            <div class="col-sm-12 col-xs-12">
                                <label class="label_name">Tài Khoản Ngân Hàng</label>
                                <div class="input_name">
                                    <input id="bank-account-${item.id}" disabled placeholder="${item.bank_account}" bank-id="${item.id}" value="${item.bank_account}" class="form-control bank-list-all  bank-list-${item.id}" type="text">
                                </div>
                            </div>

                            <div class="col-sm-12 col-xs-12">
                                <label class="label_name">Tên Tài Khoản Ngân Hàng</label>
                                <div class="input_name">
                                    <input id="bank-account-name-${item.id}" disabled placeholder="${item.bank_account_name}" bank-id="${item.id}" value="${item.bank_account_name}" class="form-control bank-list-all  bank-list-${item.id}" type="text">
                                </div>
                            </div>
                            
                            <div class="col-sm-12 col-xs-12">
                                <label class="label_name">Link logo Ngân Hàng</label>
                                <div class="input_name">
                                    <input id="bank-url-${item.id}" disabled placeholder="${item.url}" bank-id="${item.id}" value="${item.url}" class="form-control bank-list-all  bank-list-${item.id}" type="text">
                                </div>
                            </div>

                        </div>
                    </div>
                    
                    <div class="col-sm-12 col-xs-12 margin-b-30">
                        <div class="text-right">
                            <button bank-id="${item.id}" class="btn btn-danger delete btn-update">Xóa</button>
                            <button id="btn_update_bank_${item.id}"  bank-id="${item.id}" class="btn btn_update_bank btn-update">Cập nhật</button>
                        </div>
                    </div>
                    
                </div>
            </div>`;
    })
    
    $("#tpl_list").html( h );
    return true;
}

thisPage.delete = () => {
    let data = new FormData();
    data.append('id', thisPage.global_id_delete );
    _doAjaxNod('POST', data, 'bank', 'idx', 'delete', true, (res) => {
        $("#deleteModal").modal("hide");
        thisPage.render(res.data );
    })
}

thisPage.funcsSave = ( _id ) => {
    
    let _data = [];
    let item                = {};

    item.id                 = _id;
    item.bank_name          = $("#bank-name-"+_id).val();
    item.bank_code          = $("#bank-code-"+_id).val();
    item.bank_account       = $("#bank-account-"+_id).val();
    item.bank_account_name  = $("#bank-account-name-"+_id).val();
    item.url                = $("#bank-url-"+_id).val();

    _data.push( item );

    let data = new FormData();
    data.append('data', JSON.stringify(_data));
    _doAjaxNod('POST', data, 'bank', 'idx', 'save', true, (res) => {
    })

}

thisPage.funcsAdd = () => {
    
    let item                = {};

    item.bank_name          = $("#bank-name").val();
    item.bank_code          = $("#bank-code").val();
    item.bank_account       = $("#bank-account").val();
    item.bank_account_name  = $("#bank-account-name").val();
    item.url                = $("#bank-url").val();

    let data = new FormData();
    data.append('data', JSON.stringify(item));
    _doAjaxNod('POST', data, 'bank', 'idx', 'add', true, (res) => {
        $("#addModal").modal("hide");
        thisPage.render(res.data );
        
    })

}