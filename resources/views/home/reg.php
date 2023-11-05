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
							РЕГИСТРАЦИЯ
						</div>
					</div>
					
					<div class="row">
					
						<div class="col-md-6" style="height: 700px;">		
							
							<form class="reg_form" action="/user/reg" method="POST">
								Имя<br>
								<input type="text" name="first_name"><br>
								Фамилия<br>
								<input type="text" name="second_name"><br>
								* Логин<br>
								<input type="text" name="login"><br>
								* Email<br>
								<input type="text" name="email"><br>
								* Пароль<br>
								<input type="password" name="password"><br>
								* Подтвердите пароль<br>
								<input type="password" name="repassword"><br>
								<input type="checkbox" name="confirm" style="width: 32px; transform:scale(2.0); margin: 3%;">
								Даю свое согласие на обработку моих персональных данных<br>
								<input type="submit" class="btn btn-primary" value="Зарегистрироваться"><br><br>
							</form>
							
							<a href="#" style="font-size: 24px; color: black;">Забыли пароль?</a><br><br>
							<?php if(isset($_SESSION['regerror'])) echo $_SESSION['regerror']; ?>
						</div>
						
					</div>
					
				</div>
			
		</div>
		
	</div>
</div>