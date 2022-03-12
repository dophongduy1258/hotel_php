<ul class="nav nav-tabs nav-storing storing4">
    <li id="tab_setting_general" class="active"><a data-toggle="tab" href="#setting_general">Cài đặt cơ bản</a></li>
    <li id="tab_setting_bank" class=""><a data-toggle="tab" href="#setting_bank">Cài đặt phí giao dịch</a></li>
</ul>
<div class="content-pr bg-white">
    <div class="tab-content">
        <div id="setting_general" class="wrap-table-detail tab-pane active fade in">
            <div class="row">
                {foreach from=$setting item=item}
                    <div class="col-sm-6 col-xs-12 row-min-height">
                        {if $item.datatype == 'checkbox'}
                            <div class="input_name input_name_checkbox" style="margin-top:35px;">
                                <label class="label_name"><input disabled type="{$item.datatype}" {if $item.datatype == 'checkbox'}{if $item.value == '1'}checked=""{/if}{/if} placeholder="{$item.title}" varname="{$item.varname}" value="{$item.value}" class="ace form-control option-list-all" type="{$item.datatype}" name="" value=""><span class="lbl {if $item.value == '1'}active{/if}"></span>{$item.title}</label>
                            </div>
                        {else}
                           <label class="label_name">{$item.title}</label>
                            <div class="input_name">
                                <input disabled type="{$item.datatype}" {if $item.datatype == 'checkbox'}{if $item.value == '1'}checked=""{/if}{/if} placeholder="{$item.title}" varname="{$item.varname}" value="{$item.value}" class="form-control option-list-all" type="{$item.datatype}" name="" value="">
                            </div>
                        {/if}
                    </div>
                {/foreach}
                <br>
                <div class="col-sm-12 col-xs-12 ">
                    <div class="text-right">
                        <button id="btn_update" class="btn btn-update">Cập nhật</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="setting_bank" class="wrap-table-detail tab-pane fade">
            <div class="row">

                {foreach from=$fees item=item}
                <div class="col-sm-4 col-xs-4 col-xs-12 item_settingbank" fees-id="{$item.id}">
                    <h2 class="title">{$item.name}</h2>
                    <ul>
                        <li>
                            <label class="field_check">
                                <input fees-id="{$item.id}" name="{$item.id}{$item.type}" id="amount_status_{$item.id}" class="ace fees-by-amount fees-setting"  {if $item.amount_status == 1}checked{/if} name="withdraw" type="radio">
                                <span class="lbl"></span>Theo số tiền
                            </label>
                            <input id="amount_value_{$item.id}" class="fees-setting number-format" type="text" value="{$item.amount_value|number_format:0:'.':','}">
                        </li>
                        <li>
                            <label class="field_check">
                                <input fees-id="{$item.id}" name="{$item.id}{$item.type}" id="percent_status_{$item.id}"  class="ace fees-by-percent fees-setting" {if $item.percent_status == 1}checked{/if} name="withdraw" type="radio">
                                <span class="lbl"></span>Theo phần trăm
                            </label>
                            <input maxlength="5" id="percent_value_{$item.id}" class="fees-setting number-format" type="text" value="{$item.percent_value|number_format:2:'.':','}" placeholder="1%">
                        </li>
                        <li>
                            <label class="field_check">
                                <input fees-id="{$item.id}" name="{$item.id}{$item.type}" id="script_status_{$item.id}" class="ace fees-by-script fees-setting" {if $item.script_status == 1}checked{/if} name="withdraw" type="radio">
                                <span class="lbl"></span>Script
                            </label>
                            <img src="{$domain}/public/images/upload.png" width="26" style="margin-left:30px;margin-top:6px">
                        </li>
                    </ul>
                </div>
                {/foreach}

                {* <div class="col-sm-4 col-xs-4 col-xs-12 item_settingbank">
                    <h2 class="title">Phí chuyển khoản</h2>
                    <ul>
                        <li>
                            <label class="field_check">
                                <input class="ace" name="transfer" type="radio" checked>
                                <span class="lbl"></span>Theo số tiền
                            </label>
                            <input type="text" value="11,000">
                        </li>
                        <li>
                            <label class="field_check">
                                <input class="ace" name="transfer" type="radio">
                                <span class="lbl"></span>Theo phần trăm
                            </label>
                            <input type="text" value="1%">
                        </li>
                        <li>
                            <label class="field_check">
                                <input class="ace" name="transfer" type="radio">
                                <span class="lbl"></span>Script
                            </label>
                            <img src="{$domain}/public/images/upload.png" width="26" style="margin-left:30px;margin-top:6px">
                        </li>
                    </ul>
                </div>

                <div class="col-sm-4 col-xs-4 col-xs-12 item_settingbank">
                    <h2 class="title">Phí chuyển nhượng</h2>
                    <ul>
                        <li>
                            <label class="field_check">
                                <input class="ace" name="assign" type="radio" checked>
                                <span class="lbl"></span>Theo số tiền
                            </label>
                            <input type="text" value="11,000">
                        </li>
                        <li>
                            <label class="field_check">
                                <input class="ace" name="assign" type="radio">
                                <span class="lbl"></span>Theo phần trăm
                            </label>
                            <input type="text" value="1%">
                        </li>
                        <li>
                            <label class="field_check">
                                <input class="ace" name="assign" type="radio">
                                <span class="lbl"></span>Script
                            </label>
                            <img src="{$domain}/public/images/upload.png" width="26" style="margin-left:30px;margin-top:6px">
                        </li>
                    </ul>
                </div> *}

            </div>
        </div>
    </div>
</div>
