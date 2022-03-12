
<div class="logo-login"><a href="{$domain}"><img src="{$domain}/public/images/logo.png" class="img-responsive" alt="#"></a></div>
	<h2 class="title-login">Đăng nhập tài khoản</h2>
	<div class="account-page">
		<div class="from-login">
			<form method="POST" name="" action="{$domain}/?m=user&act=sb_login">
				<div class="form-group">
					<label>Số điện thoại</label>
					<input type="text" name="username" class="form-control" placeholder="Số điện thoại">
				</div>
				<div class="form-group">
					<label>Mật khẩu</label>
					<input type="password" name="password" class="form-control" value="" placeholder="**********">
				</div>
				<button type="submit" class="btn btn_login">Đăng nhập</button>
				<div class="text-right hide"><a href="{$domain}/?m=user&act=forgot_password" class="fogot_pass"><i>Quên mật khẩu?</i></a></div>
			</form>
			<div class="clear"></div>
		</div>
	</div>