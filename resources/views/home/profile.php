<div class="container">

	<div class="row">
		
		<div class="col-md-12">
			
				<div class="container-fluid">
				
					<div class="row">
						<div class="col-md-12 line_full">
							ПРОФИЛЬ
						</div>
					</div>
					
					<div class="row">
					
						<div class="col-md-2" style="border-right: 2px solid;">
						
							<h3 style="border-bottom: 2px solid; padding-bottom: 5%;">Предыдущие заказы:</h3>
							
							<div class="order">
								<h5 style="color: green">Заказ №123123:</h4>
								<h6>Товар: название товара, количество: 10;</h6>
								<h6>Товар: название товара, количество: 15;</h6>
								<h6 style="color: orange">Статус: Вручено.</h6>
							</div>
							
							<div class="order">
								<h5 style="color: green">Заказ №123123:</h4>
								<h6>Товар: название товара, количество: 10;</h6>
								<h6>Товар: название товара, количество: 15;</h6>
								<h6 style="color: orange">Статус: Не вручено.</h6>
							</div>
							
						</div>
						
						<div class="col-md-7" style="border-right: 2px solid;">
						
							<h2 class="text-center" style="border-bottom: 2px solid; padding-bottom: 5%;">Текущие заказы:</h2>
							
							<div class="order">
								<h4 style="color: green">Заказ №123123:</h4>
								<h5>Товар: название товара, количество: 10;</h5>
								<h5>Товар: название товара, количество: 15;</h5>
								<h5 style="color: orange">Статус заказа: В пути.</h5>
							</div>
							
							<div class="order">
								<h4 style="color: green">Заказ №123123:</h4>
								<h5>Товар: название товара, количество: 10;</h5>
								<h5>Товар: название товара, количество: 15;</h5>
								<h5 style="color: orange">Статус заказа: Сборка.</h5>
							</div>
						
						</div>	
						
						<div class="col-md-3" style="height: 700px;">		
							<h4 class="text-center">Редактировать профиль</h4><br>
							<form class="reg_form text-center">
								Имя<br>
								<input type="text" name="firstname" disabled value="<?=$data['first_name']?>"><br>
								Фамилия<br>
								<input type="text" name="secondname" disabled value="<?=$data['second_name']?>"><br>
								Город<br>
								<input type="text" name="city" style="width: 100%;" disabled value="<?=$data['city']?>"><br>
								Адрес<br>
								<input type="text" name="city" style="width: 100%;" disabled value="<?=$data['address']?>"><br>
								Email<br>
								<input type="text" name="email" style="width: 80%;" disabled value="<?=$data['email']?>"><br><br>
								<input type="submit" class="btn btn-primary" value="Редактировать"><br><br>
								Новый пароль<br>
								<input type="password" name="password"><br>
								Подтверждение пароля<br>
								<input type="password" name="repassword"><br><br>
								<input type="submit" class="btn btn-warning" value="Обновить пароль"><br>
							</form>
							
						</div>
						
					</div>
					
				</div>
			
		</div>
		
	</div>
</div>
