			</div>
		</div>
		<div id="loading_bar" style="display:none">
			<img border="0" src="{$domain}/public/images/loading.gif"><br>
			loading...
		</div>

        <div id="changePassword" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                        <h3>Thay đổi mật khẩu</h3>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-left">
                            <label class="label_name">Mật khẩu cũ</label>
                            <div class="input_name">
                                <input id="ch_pass_old" class="form-control change-password" type="password" name="" value="">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-left">
                            <label class="label_name">Mật khẩu mới</label>
                            <div class="input_name">
                                <input id="ch_pass_new" class="form-control change-password" type="password" name="" value="">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-left">
                            <label class="label_name">Nhập lại mật khẩu mới</label>
                            <div class="input_name">
                                <input id="ch_pass_confirm" class="form-control change-password" type="password" name="" value="">
                            </div>
                        </div>
                        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">Huỷ</button>
                        <button id="btn_confirm_change_password" class="btn">Xác nhận</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal_alert_dialog" class="modal fade modalAlert" tabindex="-1" role="dialog" aria-hidden="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <span class="close" data-dismiss="modal" aria-label="Close">x</span>
                        <h3>Thông báo</h3>
                        <p id="message_alert"></p>
                        <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">OK</button>
                    </div>
                </div>
            </div>
        </div>

        {if isset($str_permission)}
        <input class="hide" disabled value="{$str_permission}" gid="{$str_gid}" id="str_permission"/>
        {/if}
        {if $m != 'user' || ( $m == 'user' && $act != 'product' && $act != 'notification' ) }
		<div class="{if $m == 'user'}copyright_login{else}copyright{/if}">Copyright © 2018 <a href="/" title="BlockReal">BlockReal</a>, All rights reserved</div>
        {/if}
        <script type="text/javascript" src="{$domain}/public/js/jquery.nicescroll.min.js?{$version}"></script>
		<script type="text/javascript" src="{$domain}/public/js/main.js?{$version}"></script>
		<script type="text/javascript" src="{$domain}/public/js/{$m}_{$act}.js?{$version}"></script>
	</body>
</html>