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

						<?php foreach($orders as $order){ ?>
							<?php if($order->status == "Вручен" or $order->status == "Не вручен"){ ?>
								<div class='order'>
									<h5 style='color: green'>Заказ №<?=$order->id?>:</h5>
									<?php foreach($order->products as $product){ ?>
										<h6>Товар: <?=$product->obj['product_title']?>, количество: <?=$product->count?></h6>
									<?php } ?>
									<h6 style='color: orange'>Статус заказа: <?=$order->status?>.</h6>
								</div>
							<?php } ?>
						<?php } ?>

					</div>

					<div class="col-md-7" style="border-right: 2px solid;">

						<h2 class="text-center" style="border-bottom: 2px solid; padding-bottom: 5%;">Текущие заказы:
						</h2>

						<?php foreach($orders as $order){ ?>
							<?php if($order->status !== "Вручен" and $order->status !== "Не вручен"){ ?>
								<div class='order'>
									<h4 style='color: green'>Заказ №<?=$order->id?>:</h4>
									<?php foreach($order->products as $product){ ?>
										<h5>Товар: <?=$product->obj['product_title']?>, количество: <?=$product->count?></h5>
									<?php } ?>
									<h5 style='color: orange'>Статус заказа: <?=$order->status?>.</h5>
								</div>
							<?php } ?>
						<?php } ?>

					</div>

					<div class="col-md-3" style="height: 700px;">
						<h4 class="text-center">Редактировать профиль</h4><br>
						<form class="reg_form text-center">
							Имя<br>
							<input type="text" name="firstname" disabled value="<?= $user['first_name'] ?>"><br>
							Фамилия<br>
							<input type="text" name="secondname" disabled value="<?= $user['second_name'] ?>"><br>
							Город<br>
							<input type="text" name="city" style="width: 100%;" disabled value="<?= $user['city'] ?>"><br>
							Адрес<br>
							<input type="text" name="city" style="width: 100%;" disabled
								value="<?= $user['address'] ?>"><br>
							Email<br>
							<input type="text" name="email" style="width: 80%;" disabled
								value="<?= $user['email'] ?>"><br><br>
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