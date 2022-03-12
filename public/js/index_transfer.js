let thisPage = {};

thisPage.txtSearching       = $("#txt_searching");
thisPage.from               = $("#from");
thisPage.to                 = $("#to");
thisPage.tplListTransaction = $("#tpl_list_transaction");
thisPage.totalRecord        = $("#total_record");
thisPage.totalSum           = $("#total_sum");
thisPage.slStatus           = $("#sl_status");
thisPage.pageHTML           = $("#page_html");
thisPage.currentPage        = $("#current_page");

$(function () {

    thisPage.from.datepicker({maxDate:0});
    thisPage.to.datepicker({ maxDate: 0 });

    thisPage.txtSearching.keyup(function () {
        thisPage.filter();
    })
    
    $("#from, #to").change(function () {
        thisPage.filter();
    })

    thisPage.filter();

})

function paging_ajax3( _page ){
    thisPage.currentPage.val( _page );
    thisPage.filter();
}

thisPage.filter = () => {
    let data = new FormData();

    data.append('keyword', thisPage.txtSearching.val());
    data.append('from', thisPage.from.val());
    data.append('to', thisPage.to.val());
    data.append('status', thisPage.slStatus.val());
    data.append('page', thisPage.currentPage.val() );

    _doAjaxNod('POST', data, 'transfer', 'idx', 'filter', true, (res) => {
        thisPage.tplListTransaction.html(thisPage.render(res.data.lItems));
        thisPage.totalRecord.html(number_format(res.data.total_record, 0, '.', ','))
        thisPage.totalSum.html(number_format(res.data.total_sum, 0, '.', ','));
        thisPage.pageHTML.html( res.data.page_html );
    })

}

thisPage.render = (l) => {
    let _html = '';
    let i = 1;
    if (l) {
        l.forEach((item) => {
            _html += `<tr>
                        <td>${i++}</td>
                        <td>
                            <span class="dt-span">${date_format("d/m/Y", item.created_at)}</span>
                        </td>
                        <td>
                            <span class="dt-span">${item.product_name}</span>
                        </td>
                        <td>
                            <span class="dt-span">${item.from_investor_name}</span>
                            <i class="dt-span">${item.note}</i>
                        </td>
                        <td>
                            <span class="dt-span">${item.to_investor_name}</span>
                        </td>
                        <td>
                            <span class="dt-span">${number_format(item.amount, 0, '.', ',')}</span>
                        </td>
                        <td>
                            <span class="dt-span">${number_format(item.price, 0, '.', ',')}</span>
                        </td>
                        <td>
                            <span class="dt-span">${number_format((parseInt(item.amount) + parseInt(item.price)), 0, '.', ',')}</span>
                        </td>
                        <td>
                            <span class="dt-span">${item.cyclos_note}</span>
                        </td>
                        <td>
                            <span class="dt-span">${item.status == '0' ? 'Pending' : (item.status == '1' ? 'Done' :'Canceled')}</span>
                        </td>
                        <td class="text-left">
                           -
                        </td>
                    </tr>`;
        });
    }
    return _html;
}