var thisPage = {};

thisPage.txt_searching = $("#txt_searching");
thisPage.tplList = $("#tpl_list");
thisPage.page_html = $("#page_html");
thisPage.current_page = 1;

$(function () {

    thisPage.funcsFilter();

    $("#btn_view").click(function(){
        thisPage.current_page = 1;
        thisPage.funcsFilter();
    })
    $("#txt_searching").keyup(function(){
        thisPage.current_page = 1;
        thisPage.funcsFilter();
    })

})

function paging_this(_page) {
    thisPage.current_page = _page;
    thisPage.funcsFilter();
}

thisPage.funcsFilter = () => {
    let data = new FormData();
    data.append('keyword', thisPage.txt_searching.val());
    data.append('page', thisPage.current_page);
    _doAjaxNod('POST', data, 'bank_change', 'idx', 'filter', true, (res) => {
        let _html = thisPage.funcsTPL(res.data.l);
        thisPage.tplList.html(_html);
        thisPage.page_html.html(res.data.page_html);
    })
}

thisPage.funcsTPL = (l) => {

    let _html = '';
    if (l) {
        let i = 1;
        l.forEach(function (item) {
            _html += `<tr>
                        <td>${i++}</td>
                        <td>${date_format("d/m/Y H:i", item.created_at)}</td>
                        <td>${item.sender}</td>
                        <td>${item.content}</td>
                    </tr>`;
        })
    }
    return _html;
}
