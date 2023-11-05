<?php
    use App\RMVC\Route\Route;
    if (isset($_SESSION['login']))  Route::redirect('/home');
?>

<div class="container">

	<div class="row">
		
		<div class="col-md-12" style="background-color: #f0f0f0">
			
				<div class="container-fluid">
				
					<div class="row">
						<div class="col-md-12 line_full">
							АВТОРИЗАЦИЯ
						</div>
					</div>
					
					<div class="row">
					
						<div class="col-md-4" style="height: 700px;">
							
							<!-- <p style="font-size: 24px">Авторизироваться с помощью:</p>
							
							<ul class="ul_icons">
								<li><a href="#" class="vk_icon"></a></li>
								<li><a href="#" class="yandex_icon"></a></li>
							</ul>				 -->
							
							<form class="auth_form" action="/user/login" method="POST">
								Логин<br>
								<input type="text" name="login" value="123456789"><br>
								Пароль<br>
								<input type="password" name="password" value="123456789"><br>
								<input type="checkbox" name="remember_auth" style="width: 32px; transform:scale(2.0); margin: 3%;">Запомнить меня
								<input type="submit" class="btn btn-primary" value="Войти"><br><br>
							</form>
							<?php if(isset($_SESSION['loginError']))  echo $_SESSION['loginError']; ?>
							<a href="/reg" class="btn btn-warning" style="font-size: 20px; width: 70%;">Регистрация</a><br><br>
							<a href="#" style="font-size: 24px; color: black;">Забыли пароль?</a><br><br>
							
						</div>
						
					</div>
					
				</div>
			
		</div>
		
	</div>
</div>
