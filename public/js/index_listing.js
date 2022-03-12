$('body').on('click', '.fa-click-listing', function (e) {
    $(this).parents('.table_listing').find('tbody').toggleClass('table_listing_toggle');
});