var thisPage            = {};

thisPage.tpl            = $("#tpl");
thisPage.globalDeleteID            = '';

$(function(){

    $("#btn_confirm_delete").click(function(){
        thisPage.funcsDelete( thisPage.globalDeleteID );
    })

    thisPage.funcsFilter();

})

$('body').on('click', 'img.img_delete', function (e) {
    let _id = $(this).attr("suggested-id");
    thisPage.globalDeleteID = _id;
    $("#deleteModal").modal("show");
});

thisPage.funcsDelete = ( _id ) => {
    let data = new FormData();
    data.append('id', _id);
    _doAjaxNod('POST', data, 'suggested', 'idx', 'delete', true, (res) => {
        $("#holder-suggested-"+_id ).remove();
        thisPage.globalDeleteID = '';
        $("#deleteModal").modal("hide");
        alert_void("Đã xóa thành công", 1);
    })
}

thisPage.funcsFilter =  ()=>{
    let data = new FormData();
    _doAjaxNod( 'POST', data, 'suggested', 'idx', 'filter', true, (res)=>{
        let _html = thisPage.funcsTPL(res.data);
        thisPage.tpl.html(_html );
    })
}

thisPage.funcsTPL = (l) => {
    let _html = '';
    if( l ){
        l.forEach(function(item){
            let _img = '';

            if (item.images && item.images != '' ){
                let images = item.images.split(";");
                if ( images.length > 0 ){
                    images.forEach(function(it){
                        if (it != '' ){
                            _img += `<a class="col-md-3 img">
                                        <img src="${it}" class="img-responsive img">
                                    </a>`;
                        }
                    })
                }
            }

            _html += `<div class="col-sm-6 col-xs-12" id="holder-suggested-${item.id}">

                        <div class="col-sm-12 col-xs-12 holder-suggested">
                            <div class="col-sm-12 col-xs-12">
                                <b>#${item.id}</b>
                                <img suggested-id="${item.id}" src="${domain}/public/images/delete.png" alt="" width="24" class="suggested img_delete">
                            </div>

                            <div class="col-sm-12 col-xs-12">
                                <label class="label_name">Thời gian đề xuất</label>
                                <div class="input_name">
                                    ${date_format_full(item.created_at)}
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <label class="label_name">Người đề suất</label>
                                <div class="input_name">
                                    ${item.fullname}
                                </div>
                            </div>

                            <div class="col-sm-12 col-xs-12">
                                <label class="label_name">Địa chỉ BĐS</label>
                                <div class="input_name">
                                    ${item.address}
                                </div>
                            </div>

                            <div class="col-sm-12 col-xs-12">
                                <label class="label_name">Giá đề xuất bán</label>
                                <div class="input_name">
                                    ${number_format( item.price, 0, '.', ',' )}
                                </div>
                            </div>

                            <div class="col-sm-12 col-xs-12">
                                <label class="label_name">Điện thoại liên hệ</label>
                                <div class="input_name">
                                    ${item.mobile}
                                </div>
                            </div>

                            <div class="col-sm-12 col-xs-12">
                                <label class="label_name">Tỉnh/ Thành</label>
                                <div class="input_name">
                                    ${item.province_name}
                                </div>
                            </div>
                            
                            <div class="col-sm-12 col-xs-12">
                                <label class="label_name">Ghi chú</label>
                                <div class="input_name">
                                    ${item.description}
                                </div>
                            </div>

                            <div class="col-sm-12 col-xs-12">
                            <div class="avatar_thumbs row">
                                    ${_img}
                                </div>
                            </div>
                        </div>
                        
                    </div>`;
        })
    }

    return _html;
}
