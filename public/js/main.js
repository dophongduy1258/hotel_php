$('.sidebar ul').css('height', $(window).height() - 70);
$(window).resize(function(){
    $('.sidebar ul').css('height', $(window).height() - 70);
});
$(".sidebar ul").niceScroll();
$('body').on('click', '.tooger-menu', function (e) {
    $('.sidebar').toggleClass('sidebar-1');
    $('#page-wrapper').toggleClass('page-wrapper-1');
});
$('body').on('click', '.menu-m > .icon-menu', function (e) {
    $('.sidebar').toggleClass('sidebar-2');
    $('.overlay-menu').toggle();
});
$('body').on('click', '.overlay-menu', function (e) {
    $('.sidebar').toggleClass('sidebar-2');
    $('.overlay-menu').toggle();
});
// $('body').on('click', '.code_real', function(e) {
//     $(this).parents('.wrap-table-detail').find('.table-detail').toggle();
//     $(this).parents('.wrap-table-detail').find('.infomation_code').toggle();
//     $(this).parents('.wrap-table-detail').find('.search-order').toggle();
// });
// $('body').on('click', '.infomation_code > i, button.btn-close-infomation_code', function(e) {
//     $(this).parents('.wrap-table-detail').find('.table-detail').toggle();
//     $(this).parents('.wrap-table-detail').find('.infomation_code').toggle();
//     $(this).parents('.wrap-table-detail').find('.search-order').toggle();
// });
// $('body').on('click', '.profile_real', function(e) {
//     $(this).parents('.wrap-table-detail').find('.table-detail').toggle();
//     $(this).parents('.wrap-table-detail').find('.infomation_profile').toggle();
// });
// $('body').on('click', '.infomation_profile > i', function(e) {
//     $(this).parents('.wrap-table-detail').find('.table-detail').toggle();
//     $(this).parents('.wrap-table-detail').find('.infomation_profile').toggle();
// });
$('body').on('click', '.img_edit', function (e) {
    $(this).parents('tr').toggleClass('table_edit');
});
$('body').on('click', '.img_done', function (e) {
    $(this).parents('tr').toggleClass('table_edit');
});
$('body').on('click', '.category_real .item .title > span', function (e) {
    $(this).parents('.item').toggleClass('active');
    if ($(this).parents('.item').find('.sub').css('display') == 'block') {
        $(this).parents('.item').find('.sub').slideUp(300);
        $(this).parents('.item').removeClass('active');
        $('.category_real .item').removeClass('active1');
    } else {
        $('.category_real .item .sub').slideUp(300);
        $(this).parents('.item').find('.sub').slideToggle(300);
        $('.category_real .item').removeClass('active');
        $(this).parents('.item').addClass('active');
        $('.category_real .item').removeClass('active1');
    }
});
$('body').on('click', '.category_real .item .title input', function (e) {
    $('.category_real .item').removeClass('active1');
    $(this).parents('.item').toggleClass('active1');
});
//$(".sidebar").niceScroll({
//cursorcolor:"#ddd",
//});

// $('body').on('click', '.add_staff_group', function(e) {
//     $(this).parents('.wrap-table-detail').find('.table-detail').toggle();
//     $(this).parents('.wrap-table-detail').find('.infomation_add_staff').toggle();
//     $(this).parents('.wrap-table-detail').find('.search-order').toggle();
// });
// $('body').on('click', '.infomation_add_staff > i', function(e) {
//     $(this).parents('.wrap-table-detail').find('.table-detail').toggle();
//     $(this).parents('.wrap-table-detail').find('.infomation_add_staff').toggle();
//     $(this).parents('.wrap-table-detail').find('.search-order').toggle();
// });

// $('body').on('click', '.add_notification', function(e) {
//     $(this).parents('.wrap-table-detail').find('.notification').toggle();
//     $(this).parents('.wrap-table-detail').find('.addNotification').toggle();
// });
// $('body').on('click', '.close_noti', function(e) {
//     $(this).parents('.wrap-table-detail').find('.notification').toggle();
//     $(this).parents('.wrap-table-detail').find('.addNotification').toggle();
// });
$('body').on('click', '.add_contact', function (e) {
    $(this).parents('.input_name').find('.sub').toggle();
    $('.overlay_newnoti').toggle();
});
$('body').on('click', '.overlay_newnoti', function (e) {
    //$(".input_name .sub").toggle();
    //$('.overlay_newnoti').toggle();
});
// $('body').on('click', '.close_sub_addContact', function(e) {
//     $(this).parents('.input_name').find('.sub').toggle();
// });
$('body').on('click', '.wrap_sub_all > li > span', function (e) {
    $(this).parent().toggleClass('active');
    if ($(this).parent().find('.sub_all').css('display') == 'block') {
        $(this).parent().find('.sub_all').slideUp(300);
        $(this).parent().removeClass('active');
    } else {
        $('.wrap_sub_all > li .sub_all').slideUp(300);
        $(this).parent().find('.sub_all').slideToggle(300);
        $('.wrap_sub_all > li').removeClass('active');
        $(this).parent().addClass('active');
    }
});
