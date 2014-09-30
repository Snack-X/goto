<?php $this->render("templates/header_admin"); ?>

<section class="admin admin-login">
<div class="title">Login</div>

<form class="form" action="/admin/login" method="post">
	<div class="row">
		<div class="cell cell-30"><label class="label" for="id">아이디</label></div>
		<div class="cell cell-70"><input class="input" type="text" name="id" id="id"></div>
	</div>
	<div class="row">
		<div class="cell cell-30"><label class="label" for="password">비밀번호</label></div>
		<div class="cell cell-70"><input class="input" type="password" name="password" id="password"></div>
	</div>

	<button class="button" type="submit">로그인</button>
</form>
</section>

<?php $this->render("templates/footer"); ?>