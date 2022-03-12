//@global Paramater
var domain          = window.location.protocol + "//" + window.location.host + '';
var url_domain      = window.location.protocol + "//" + window.location.host + '';
var apiKey          = '0123kSKmsdfrtl234sd';

$.ajaxSetup({ 'global': true });

$(document).ajaxStart(function () {
    $("#loading_bar").show();
});

$(document).ajaxComplete(function () {
    $("#loading_bar").hide();
});

// var configFirebase = {
//     apiKey: "AIzaSyBY3O90ItPd9saDn4HjhZid5Aivi15xoos",
//     authDomain: "test-local-pos-fnb.firebaseapp.com",
//     databaseURL: "https://test-local-pos-fnb.firebaseio.com",
//     projectId: "test-local-pos-fnb",
//     storageBucket: "test-local-pos-fnb.appspot.com",
//     messagingSenderId: "660580489089"
// };
// var configFirebase = {
// 	apiKey: "AIzaSyDtZEapkG7-ZbZgz9y1RiuQKgERzIJlcHc",
// 	authDomain: "bepnhaxuquang-314fd.firebaseapp.com",
// 	databaseURL: "https://bepnhaxuquang-314fd.firebaseio.com",
// 	projectId: "bepnhaxuquang-314fd",
// 	storageBucket: "bepnhaxuquang-314fd.appspot.com",
// 	messagingSenderId: "304093278342"
// };

// firebase.initializeApp(configFirebase);

$(function () {

    // window.onerror = function (message, url, lineNumber, columnNo, error) {
    //     console.error(message, url, lineNumber, columnNo, error, 'window.onerror');
    //     return;
    // };

    // var oldConsoleError = console.error;
    // console.error = function (message, url, lineNumber, columnNo, error, note) {
    //     //save error and send to server for example.
    //     if (typeof firebase !== "undefined" && firebase.apps.length !== 0) {
    //         let obj = {};
    //         let strdate = new Date();
    //         obj.key_command = 'tracking_log';
    //         obj.store = 'khong_khai_bao';//shop_id
    //         obj.function = note ? note : 'console.error';//
    //         obj.username = getCookie("username");
    //         obj.action = 'khong_khai_bao';//click;double click
    //         obj.system_at = zeroFill(strdate.getDate(), 2) + '/' + zeroFill((strdate.getMonth() + 1), 2) + '/' + strdate.getFullYear() + ' ' + zeroFill(strdate.getHours(), 2) + ':' + zeroFill(strdate.getMinutes(), 2) + ':' + zeroFill(strdate.getSeconds(), 2) + ':' + zeroFill(strdate.getMilliseconds(), 3);
    //         obj.note = 'Error From Compiler, not controll by coder';
    //         obj.location = window.location.href;
    //         obj.browserinfo = _getBrowserName();
    //         obj.data = JSON.stringify({ message, url, lineNumber, columnNo, error });
    //         firebase.database().ref('poshp/' + global_db_pos + '/DataByShopID/1/command').push(obj);
    //     }
    //     oldConsoleError(message, url, lineNumber, columnNo, error);
    //     return;
    // };
    
    // $(".input-number-touch").TouchSpin({
    //     step: 1,
    //     decimals: 2,
    //     min: -1000000000,
    //     max: 1000000000,
    //     forcestepdivisibility: "none",
    // });

    // $(".inp-no-touch-min1").TouchSpin({
    //     step: 1,
    //     decimals: 2,
    //     min: 0,
    //     max: 1000000000,
    //     forcestepdivisibility: "none",
    // });

    $("input.number-format").blur(function () {
        var value = $(this).val();
        var number = SplitNumber2(value);
        if (isNumber(number)) {
            $(this).val(number_format(number, 0, '.', ','));
        }
    });

    $("input.number-format-decimal").blur(function () {
        var value = $(this).val();
        var number = SplitNumber2(value);
        if (isNumberDecimal(number)) {
            let nu = number_format(number, 2, '.', ',');
            if( nu.substring(nu.length - 3, nu.length) == '.00' )
                nu = number_format(number, 0, '.', ',');
            $(this).val(nu);
        }
    });

    // setTrackingLogSystem('view_page', 'accessed', document.title);

    $("#btn_confirm_change_password").click(function(){
        change_password();
    })

    $('body').on('focus', 'input', function (e) {
        $(this).select();
    })
    
});

function check_permission( _str_to_check ){
    let _str_permission = $("#str_permission").val()+'';
    let _gid            = $("#str_permission").attr("gid")+'';
    // printLog( _str_permission );
    // printLog( _str_permission.indexOf( _str_to_check ) );
    if (_str_permission.indexOf(_str_to_check) > -1 || _gid == '1'  )
        return true;
    return false;
}

$(window).resize(function () {

    var wheight = $(window).height();
    if (wheight > 690) {
        wheight = (wheight - 690) / 2;
        if (wheight < 50) {
            $("#main-container").css("margin-top", wheight);
        } else {
            $("#main-container").css("margin-top", 50);
        }
    }

});

// function setTrackingLogSystem(_module, _action, _note) {
//     if (typeof firebase !== "undefined" && firebase.apps.length !== 0) {
//         let obj = {};
//         let strdate = new Date();
//         obj.key_command = 'tracking_log';
//         obj.store = 'default';//shop_id
//         obj.function = _module ? _module : 'Lỗi Tracking Log System không khai báo module.';//
//         obj.username = getCookie("username");
//         obj.action = _action ? _action : 'khong_khai_bao';//click;double click
//         obj.system_at = zeroFill(strdate.getDate(), 2) + '/' + zeroFill((strdate.getMonth() + 1), 2) + '/' + strdate.getFullYear() + ' ' + zeroFill(strdate.getHours(), 2) + ':' + zeroFill(strdate.getMinutes(), 2) + ':' + zeroFill(strdate.getSeconds(), 2) + ':' + zeroFill(strdate.getMilliseconds(), 3);
//         obj.note = _note ? _note : 'Error From Compiler, not defined by coder';
//         obj.location = window.location.href;
//         obj.browserinfo = _getBrowserName();
//         obj.data = JSON.stringify({ _module, _action, _note });
//         firebase.database().ref('poshp/' + global_db_pos + '/DataByShopID/1/command').push(obj);
//     }
// }
/*
- author: wildCat√
- type_: POST or GET
- data_: var data = new FormData(); data.append('a', value_a);
- url_: url to api
- global_: true or false
*/
function _doAjax(type_, data_, m_, act_, global_, doSomeThing) {
    $.ajax({
        type: type_,
        url: domain + '/ajax/?apikey=' + apiKey + '&m=' + m_ + '&act=' + act_,//
        data: data_,
        processData: false,
        contentType: false,
        async: true,
        cache: false,
        global: global_,
        success: function (response) {
            var kq = response.split("##");
            if (kq.length == 2) {
                var obj = $.parseJSON(kq['1']);
                if (obj.status == 200)
                    doSomeThing(obj);//success response data from server
                else if (obj.status == 401)
                    alert_dialog(obj.message);//require login
                else if (obj.status == 403)//error message
                    alert_dialog(obj.message);
                else
                    alert_dialog(obj.message);
            } else {
                alert_dialog(response);
            }
        }
    });
    printLog('doAjax ...');
    return;
}

function _doAjaxNod(type_, data_, m_, act_, nod_, global_, doSomeThing) {
    $.ajax({
        type: type_,
        url: domain + '/ajax/?apikey=' + apiKey + '&m=' + m_ + '&act=' + act_ + '&nod=' + nod_,//
        data: data_,
        processData: false,
        contentType: false,
        async: true,
        cache: false,
        global: global_,
        success: function (response) {
            var kq = response.split("##");
            if (kq.length == 2) {
                var obj = $.parseJSON(kq['1']);
                if (obj.status == 200)
                    doSomeThing(obj);//success response data from server
                else if (obj.status == 401)
                    alert_dialog(obj.message);//require login
                else if (obj.status == 403)//error message
                    alert_dialog(obj.message);
                else
                    alert_dialog(obj.message);
            } else {
                alert_dialog(response);
            }
        }
    });
    printLog('doAjax ...');
    return;
}

function zeroFill(n, p, c) {
    var pad_char = typeof c !== 'undefined' ? c : '0';
    var pad = new Array(1 + p).join(pad_char);
    var str = (pad + n).slice(-pad.length) + "";
    return str;
}

jQuery(function ($) {
    if (lang.flag == 'vi') {
        $.datepicker.regional['vi'] = {
            closeText: 'Đóng',
            prevText: '&#x3c;Trước',
            nextText: 'Tiếp&#x3e;',
            currentText: 'Hôm nay',
            monthNames: ['Tháng Một', 'Tháng Hai', 'Tháng Ba', 'Tháng Tư', 'Tháng Năm', 'Tháng Sáu',
                'Tháng Bảy', 'Tháng Tám', 'Tháng Chín', 'Tháng Mười', 'Th.Mười Một', 'Th.Mười Hai'],
            monthNamesShort: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6',
                'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            dayNames: ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'],
            dayNamesShort: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
            dayNamesMin: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
            weekHeader: 'Tu',
            dateFormat: 'dd/mm/yy',
            firstDay: 0,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['vi']);
    } else {

        $.datepicker.regional['en'] = {
            dateFormat: 'dd/mm/yy',
            firstDay: 0,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''
        };
        $.datepicker.setDefaults($.datepicker.regional['en']);

    }
});

//searching in str has key_math return true
function test_string_match(str, key_math) {
    key_math += '';
    str += '';
    var patt = new RegExp(key_math.toLowerCase());
    return patt.test(str.toLowerCase());
}

//cat dau cham
function SplitNumber(number) {
    var rt = str_replace('.', '', number);
    var kq = str_replace(',', '', rt);
    return parseInt(kq) + 0;
}

function SplitNumber2(number) {
    //var rt = str_replace('.','',number);
    var kq = str_replace(',', '', number);
    return kq;
}

function str_replace(search, replace, subject, count) {
    // http://kevin.vanzonneveld.net
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Gabriel Paderni
    // +   improved by: Philip Peterson
    // +   improved by: Simon Willison (http://simonwillison.net)
    // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +   bugfixed by: Anton Ongson
    // +      input by: Onno Marsman
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +    tweaked by: Onno Marsman
    // +      input by: Brett Zamir (http://brett-zamir.me)
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   input by: Oleg Eremeev
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   bugfixed by: Oleg Eremeev
    // %          note 1: The count parameter must be passed as a string in order
    // %          note 1:  to find a global variable in which the result will be given
    // *     example 1: str_replace(' ', '.', 'Kevin van Zonneveld');
    // *     returns 1: 'Kevin.van.Zonneveld'
    // *     example 2: str_replace(['{name}', 'l'], ['hello', 'm'], '{name}, lars');
    // *     returns 2: 'hemmo, mars'

    var i = 0, j = 0, temp = '', repl = '', sl = 0, fl = 0,
        f = [].concat(search),
        r = [].concat(replace),
        s = subject,
        ra = r instanceof Array, sa = s instanceof Array;
    s = [].concat(s);
    if (count) {
        this.window[count] = 0;
    }

    for (i = 0, sl = s.length; i < sl; i++) {
        if (s[i] === '') {
            continue;
        }
        for (j = 0, fl = f.length; j < fl; j++) {
            temp = s[i] + '';
            repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
            s[i] = (temp).split(f[j]).join(repl);
            if (count && s[i] !== temp) {
                this.window[count] += (temp.length - s[i].length) / f[j].length;
            }
        }
    }
    return sa ? s : s[0];
}

function number_format(number, decimals, dec_point, thousands_sep) {
    // Formats a number with grouped thousands
    //
    // version: 906.1806
    // discuss at: http://phpjs.org/functions/number_format
    // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +     bugfix by: Michael White (http://getsprink.com)
    // +     bugfix by: Benjamin Lupton
    // +     bugfix by: Allan Jensen (http://www.winternet.no)
    // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +     bugfix by: Howard Yeend
    // +    revised by: Luke Smith (http://lucassmith.name)
    // +     bugfix by: Diogo Resende
    // +     bugfix by: Rival
    // +     input by: Kheang Hok Chin (http://www.distantia.ca/)
    // +     improved by: davook
    // +     improved by: Brett Zamir (http://brett-zamir.me)
    // +     input by: Jay Klehr
    // +     improved by: Brett Zamir (http://brett-zamir.me)
    // +     input by: Amir Habibi (http://www.residence-mixte.com/)
    // +     bugfix by: Brett Zamir (http://brett-zamir.me)
    // *     example 1: number_format(1234.56);
    // *     returns 1: '1,235'
    // *     example 2: number_format(1234.56, 2, ',', ' ');
    // *     returns 2: '1 234,56'
    // *     example 3: number_format(1234.5678, 2, '.', '');
    // *     returns 3: '1234.57'
    // *     example 4: number_format(67, 2, ',', '.');
    // *     returns 4: '67,00'
    // *     example 5: number_format(1000);
    // *     returns 5: '1,000'
    // *     example 6: number_format(67.311, 2);
    // *     returns 6: '67.31'
    // *     example 7: number_format(1000.55, 1);
    // *     returns 7: '1,000.6'
    // *     example 8: number_format(67000, 5, ',', '.');
    // *     returns 8: '67.000,00000'
    // *     example 9: number_format(0.9, 0);
    // *     returns 9: '1'
    // *     example 10: number_format('1.20', 2);
    // *     returns 10: '1.20'
    // *     example 11: number_format('1.20', 4);
    // *     returns 11: '1.2000'
    // *     example 12: number_format('1.2000', 3);
    // *     returns 12: '1.200'
    var n = number, prec = decimals;

    var toFixedFix = function (n, prec) {
        var k = Math.pow(10, prec);
        return (Math.round(n * k) / k).toString();
    };

    n = !isFinite(+n) ? 0 : +n;
    prec = !isFinite(+prec) ? 0 : Math.abs(prec);
    var sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep;
    var dec = (typeof dec_point === 'undefined') ? '.' : dec_point;

    var s = (prec > 0) ? toFixedFix(n, prec) : toFixedFix(Math.round(n), prec); //fix for IE parseFloat(0.55).toFixed(0) = 0;

    var abs = toFixedFix(Math.abs(n), prec);
    var _, i;

    if (abs >= 1000) {
        _ = abs.split(/\D/);
        i = _[0].length % 3 || 3;

        _[0] = s.slice(0, i + (n < 0)) +
            _[0].slice(i).replace(/(\d{3})/g, sep + '$1');
        s = _.join(dec);
    } else {
        s = s.replace('.', dec);
    }

    var decPos = s.indexOf(dec);
    if (prec >= 1 && decPos !== -1 && (s.length - decPos - 1) < prec) {
        s += new Array(prec - (s.length - decPos - 1)).join(0) + '0';
    }
    else if (prec >= 1 && decPos === -1) {
        s += dec + new Array(prec).join(0) + '0';
    }
    return s;
}
function input_number(input_id) {

    var value = $(input_id).val();
    var number = SplitNumber2(value);

    if (isNumber(number)) {
        $(input_id).css('color', 'black');
        $(input_id).val(number_format(number, setup.decimal, '.', ','));
    } else {
        $(input_id).css('color', 'red');
    }
}

function input_number_abs(input_id) {

    var value = $(input_id).val();
    var number = SplitNumber2(value);

    if (isNumber(number)) {
        number = Math.abs(parseFloat(number));
        $(input_id).css('color', 'black');
        $(input_id).val(number_format(number, setup.decimal, '.', ','));
    } else {
        $(input_id).css('color', 'red');
    }
}

function input_number_decimal(input_id) {
    var value = $(input_id).val();
    var number = SplitNumber2(value);

    if (isNumber(number)) {
        $(input_id).css('color', 'black');
        $(input_id).val(number_format(number, setup.decimal, '.', ','));
    } else {
        $(input_id).css('color', 'red');
    }
}

function input_number2(input_id) {
    var value = $(input_id).val();
    var number = SplitNumber2(value);

    if (isNumber(number)) {
        $(input_id).val(number_format(number, setup.decimal, '.', ','));
    }
}

function isNumber(value) {
    var reg = new RegExp("^[0-9]+$|.");
    return reg.test(value);
}

function isNumberDecimal(value) {
    var reg = new RegExp("^[0-9]+$|.");
    return reg.test(value);
}

function isEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}

function change_password() {

    let _old = $("#ch_pass_old").val();
    let _new = $("#ch_pass_new").val();
    let _cf = $("#ch_pass_confirm").val();

    if ( _old == "" ){
        alert_dialog("Vui lòng nhập mật khẩu cũ.");
    } else if ( _new == "" ) {
        alert_dialog("Vui lòng nhập mật khẩu mới.");
    } else if ( _cf == "") {
        alert_dialog("Vui lòng nhập lại mật khẩu mới.");
    } else if ( _cf != _new ) {
        alert_dialog("Xác nhận mật khẩu mới chưa trùng khớp.");
    }else{
        let data = new FormData();
        data.append("old", _old);
        data.append("new", _new);
        _doAjaxNod('POST', data, 'user', 'idx', 'change_password', true, function(){
            $("input.change-password").val("");
            $("#changePassword").modal("hide");
        })
    }
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function createCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    }
    else var expires = "";
    document.cookie = name + "=" + value + expires + "; path=/";
    return;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}

function check_all(id_check, class_check) {
    if ($(id_check).is(":checked")) {
        $(class_check).each(function () {
            $(this).prop('checked', true);
        });
    } else {
        $(class_check).each(function () {
            $(this).prop('checked', false);
        });
    }
}

function alert_dialog(message) {

    $("#message_alert").html(message);
    $("#modal_alert_dialog").modal("show");

    // BootstrapDialog.show({
    //     title: lang.jstt_noti,
    //     message: message,
    //     buttons: [{
    //         label: 'OK',
    //         cssClass: 'btn-default btn-width',
    //         action: function (dialogItself) {
    //             dialogItself.close();
    //         }
    //     }]
    // });
    return false;
}

function alert_void( _message, _success ) {
    let _id = parseInt(Math.random()*100000000);
    var html = '';
    if ( _success == 1 )
        html = `<div id="alert_${_id}" style="display:none" class="alert alert-success fade in alert-dismissible alert_auto_remove alert_auto_remove">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        <img product-id="9" src="${domain}/public/images/done.png" alt="" width="24" class="img_edit">
                        ${_message}
                    </div>`;
    else
        html = `<div id="alert_${_id}" style="display:none" class="alert alert-danger fade in alert-dismissible alert_auto_remove alert_auto_remove">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        <img product-id="9" src="${domain}/public/images/error.png" alt="" width="24" class="img_edit">
                        ${_message}
                    </div>`;
    
    $("body").prepend(html);
    $("#alert_" + _id).show();
    setTimeout(function () {
        $("#alert_" + _id).hide();
    }, 7200)
    setTimeout(function(){
        $("#alert_" + _id).remove();
    }, 8000)
    return false;
}

function zeroPad(num, places) {
    var zero = places - num.toString().length + 1;
    return Array(+(zero > 0 && zero)).join("0") + num;
}

function click_file(id) {
    $("#" + id).click();
}

function printLog(str) {
    console.log(str);
    return;
}

$.getURLParam = function (name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results == null) {
        return null;
    }
    else {
        return results[1] || 0;
    }
}

$.setURLParam = (param, paramVal) => {
    var url = "?orderID=";
    var TheAnchor = null;
    var newAdditionalURL = "";
    var tempArray = url.split("?");
    var baseURL = tempArray[0];
    var additionalURL = tempArray[1];
    var temp = "";

    if (additionalURL) {
        var tmpAnchor = additionalURL.split("#");
        var TheParams = tmpAnchor[0];
        TheAnchor = tmpAnchor[1];
        if (TheAnchor)
            additionalURL = TheParams;

        tempArray = additionalURL.split("&");

        for (var i = 0; i < tempArray.length; i++) {
            if (tempArray[i].split('=')[0] != param) {
                newAdditionalURL += temp + tempArray[i];
                temp = "&";
            }
        }
    }
    else {
        var tmpAnchor = baseURL.split("#");
        var TheParams = tmpAnchor[0];
        TheAnchor = tmpAnchor[1];

        if (TheParams)
            baseURL = TheParams;
    }

    if (TheAnchor)
        paramVal += "#" + TheAnchor;

    var rows_txt = temp + "" + param + "=" + paramVal;
    window.history.pushState('page', 'Title', baseURL + "?" + newAdditionalURL + rows_txt);
}

Date.prototype.customFormat = function (formatString) {
    var YYYY, YY, MMMM, MMM, MM, M, DDDD, DDD, DD, D, hhh, hh, h, mm, m, ss, s, ampm, AMPM, dMod, th;
    var dateObject = this;
    YY = ((YYYY = dateObject.getFullYear()) + "").slice(-2);
    MM = (M = dateObject.getMonth() + 1) < 10 ? ('0' + M) : M;
    MMM = (MMMM = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"][M - 1]).substring(0, 3);
    DD = (D = dateObject.getDate()) < 10 ? ('0' + D) : D;
    DDD = (DDDD = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"][dateObject.getDay()]).substring(0, 3);
    th = (D >= 10 && D <= 20) ? 'th' : ((dMod = D % 10) == 1) ? 'st' : (dMod == 2) ? 'nd' : (dMod == 3) ? 'rd' : 'th';
    formatString = formatString.replace("#YYYY#", YYYY).replace("#YY#", YY).replace("#MMMM#", MMMM).replace("#MMM#", MMM).replace("#MM#", MM).replace("#M#", M).replace("#DDDD#", DDDD).replace("#DDD#", DDD).replace("#DD#", DD).replace("#D#", D).replace("#th#", th);

    h = (hhh = dateObject.getHours());
    if (h == 0) h = 24;
    if (h > 12) h -= 12;
    hh = h < 10 ? ('0' + h) : h;
    AMPM = (ampm = hhh < 12 ? 'am' : 'pm').toUpperCase();
    mm = (m = dateObject.getMinutes()) < 10 ? ('0' + m) : m;
    ss = (s = dateObject.getSeconds()) < 10 ? ('0' + s) : s;
    return formatString.replace("#hhh#", hhh).replace("#hh#", hh).replace("#h#", h).replace("#mm#", mm).replace("#m#", m).replace("#ss#", ss).replace("#s#", s).replace("#ampm#", ampm).replace("#AMPM#", AMPM);
};

function _getBrowserName() {
    var nVer = navigator.appVersion;
    var nAgt = navigator.userAgent;
    var browserName = navigator.appName;
    var fullVersion = '' + parseFloat(navigator.appVersion);
    var majorVersion = parseInt(navigator.appVersion, 10);
    var nameOffset, verOffset, ix;

    // In Opera, the true version is after "Opera" or after "Version"
    if ((verOffset = nAgt.indexOf("Opera")) != -1) {
        browserName = "Opera";
        fullVersion = nAgt.substring(verOffset + 6);
        if ((verOffset = nAgt.indexOf("Version")) != -1)
            fullVersion = nAgt.substring(verOffset + 8);
    }
    // In MSIE, the true version is after "MSIE" in userAgent
    else if ((verOffset = nAgt.indexOf("MSIE")) != -1) {
        browserName = "Microsoft Internet Explorer";
        fullVersion = nAgt.substring(verOffset + 5);
    }
    // In Chrome, the true version is after "Chrome" 
    else if ((verOffset = nAgt.indexOf("Chrome")) != -1) {
        browserName = "Chrome";
        fullVersion = nAgt.substring(verOffset + 7);
    }
    // In Safari, the true version is after "Safari" or after "Version" 
    else if ((verOffset = nAgt.indexOf("Safari")) != -1) {
        browserName = "Safari";
        fullVersion = nAgt.substring(verOffset + 7);
        if ((verOffset = nAgt.indexOf("Version")) != -1)
            fullVersion = nAgt.substring(verOffset + 8);
    }
    // In Firefox, the true version is after "Firefox" 
    else if ((verOffset = nAgt.indexOf("Firefox")) != -1) {
        browserName = "Firefox";
        fullVersion = nAgt.substring(verOffset + 8);
    }
    // In most other browsers, "name/version" is at the end of userAgent 
    else if ((nameOffset = nAgt.lastIndexOf(' ') + 1) <
        (verOffset = nAgt.lastIndexOf('/'))) {
        browserName = nAgt.substring(nameOffset, verOffset);
        fullVersion = nAgt.substring(verOffset + 1);
        if (browserName.toLowerCase() == browserName.toUpperCase()) {
            browserName = navigator.appName;
        }
    }

    // trim the fullVersion string at semicolon/space if present
    // if ((ix=fullVersion.indexOf(";"))!=-1)
    //    fullVersion=fullVersion.substring(0,ix);
    // if ((ix=fullVersion.indexOf(" "))!=-1)
    //    fullVersion=fullVersion.substring(0,ix);

    // majorVersion = parseInt(''+fullVersion,10);
    // if (isNaN(majorVersion)) {
    //  fullVersion  = ''+parseFloat(navigator.appVersion); 
    //  majorVersion = parseInt(navigator.appVersion,10);
    // }

    // document.write(''
    //  +'Browser name  = '+browserName+'<br>'
    //  +'Full version  = '+fullVersion+'<br>'
    //  +'Major version = '+majorVersion+'<br>'
    //  +'navigator.appName = '+navigator.appName+'<br>'
    //  +'navigator.userAgent = '+navigator.userAgent+'<br>'
    // )

    return browserName;
}

function _getOSName() {
    var OSName = "Unknown OS";
    if (navigator.appVersion.indexOf("Win") != -1) OSName = "Windows";
    if (navigator.appVersion.indexOf("Mac") != -1) OSName = "MacOS";
    if (navigator.appVersion.indexOf("X11") != -1) OSName = "UNIX";
    if (navigator.appVersion.indexOf("Linux") != -1) OSName = "Linux";
    return OSName;
}

function isExistSpecialCharacter(_testString) {
    var pattern = new RegExp(/[`\!@#$%^&*^~<>,"']/);
    return pattern.test(_testString);
}

function isOnlyNumberAndCharacter(_testString) {
    var pattern = new RegExp(/^[a-zA-Z0-9]+$/i);
    return pattern.test(_testString);
}

function isOnlyNumber(_testString) {
    var pattern = new RegExp(/^[0-9]+$/i);
    return pattern.test(_testString);
}

function _downloadTheLink(_link) {
    if (_getBrowserName() != 'Firefox') {
        $('#downloadFrame').remove(); // This shouldn't fail if frame doesn't exist
        $('body').append('<iframe id="downloadFrame" src="' + _link + '" style="display:none"></iframe>');
    } else {
        BootstrapDialog.show({
            title: lang.jstt_noti,
            message: lang.jslb_click2down + ': <a class="color_blue" download="" href="' + _link + '">' + lang.jslb_click2downlink + '</a>',
            buttons: [{
                label: 'OK',
                cssClass: 'btn btn-default btn-width',
                action: function (dialogItself) {
                    dialogItself.close();
                }
            }]
        });
    }
}

// function date_format(times) {
//     var strdate = new Date(times * 1000);
//     //dd/mm/YYY HH:mm:ss
//     return zeroFill(strdate.getDate(), 2) + '/' + zeroFill((strdate.getMonth() + 1), 2) + '/' + strdate.getFullYear();
// }

function date_format_full(times) {
    var strdate = new Date(times * 1000);
    //dd/mm/YYY HH:mm:ss
    return zeroFill(strdate.getHours(), 2) + ':' + zeroFill(strdate.getMinutes(), 2) + ' ' + zeroFill(strdate.getDate(), 2) + '/' + zeroFill((strdate.getMonth() + 1), 2) + '/' + strdate.getFullYear();
}

function date_format(_type, times) {
    var strdate = new Date(times * 1000);

    if (_type == 'd/m')
        return zeroFill(strdate.getDate(), 2) + '/' + zeroFill((strdate.getMonth() + 1), 2);
    else if (_type == 'd/m/Y')
        return zeroFill(strdate.getDate(), 2) + '/' + zeroFill((strdate.getMonth() + 1), 2) + '/' + strdate.getFullYear();
    else if (_type == 'Y')
        return strdate.getFullYear();
    else if (_type == 'm/Y')
        return zeroFill((strdate.getMonth() + 1), 2) + '/' + strdate.getFullYear();
    else if (_type == 'd/m/y')
        return zeroFill(strdate.getDate(), 2) + '/' + zeroFill((strdate.getMonth() + 1), 2) + '/' + strdate.getFullYear().toString().substring(2, 4);
    else if (_type == 'd/m/Y H:i')
        return zeroFill(strdate.getDate(), 2) + '/' + zeroFill((strdate.getMonth() + 1), 2) + '/' + strdate.getFullYear() + ' &nbsp;' + zeroFill(strdate.getHours(), 2) + ':' + zeroFill(strdate.getMinutes(), 2);
    else if (_type == 'd/m/Y H:i:s')
        return zeroFill(strdate.getDate(), 2) + '/' + zeroFill((strdate.getMonth() + 1), 2) + '/' + strdate.getFullYear() + ' &nbsp;' + zeroFill(strdate.getHours(), 2) + ':' + zeroFill(strdate.getMinutes(), 2) + ':' + zeroFill(strdate.getSeconds(), 2);
    else if (_type == 'd/m/y H:i')
        return zeroFill(strdate.getDate(), 2) + '/' + zeroFill((strdate.getMonth() + 1), 2) + '/' + strdate.getFullYear().toString().substring(2, 4) + ' &nbsp;' + zeroFill(strdate.getHours(), 2) + ':' + zeroFill(strdate.getMinutes(), 2);
    else if (_type == 'd/m/y H:i:s')
        return zeroFill(strdate.getDate(), 2) + '/' + zeroFill((strdate.getMonth() + 1), 2) + '/' + strdate.getFullYear().toString().substring(2, 4) + ' &nbsp;' + zeroFill(strdate.getHours(), 2) + ':' + zeroFill(strdate.getMinutes(), 2) + ':' + zeroFill(strdate.getSeconds(), 2);
    return '-';
}