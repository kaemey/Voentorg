<?php
use App\RMVC\Route\Route;
use App\Http\Controllers\UserController;

if (!isset($_SESSION['login']))
	Route::redirect('/home');

UserController::checkAdmin();

?>

<div class="container">

	<div class="row">

		<div class="col-md-12">

			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12 line_full">
						ADMIN PANEL
					</div>
				</div>

				<div class="row">

					<div class="col-md-2" style="border-right: 2px solid;">

						<h3 style="border-bottom: 2px solid; padding-bottom: 5%;">Предыдущие заказы:</h3>

					</div>

					<div class="col-md-7" style="border-right: 2px solid;">

						<h2 class="text-center" style="border-bottom: 2px solid; padding-bottom: 5%;">Новые заказы:
						</h2>

						<?php foreach ($orders as $order) { ?>
							<div class='order'>
								<h4 style='color: green'>Заказ №
									<?= $order->id ?>:
								</h4>
								<?php foreach ($order->products as $product) { ?>
									<h5>Товар: <?= $product->content['product_title'] ?>, количество: <?= $product->count ?></h5>
								<?php } ?>
								<h4>Пользователь:</h4> 
								<h5>ФИО: <?php echo $order->user->second_name .' '.$order->user->first_name?>, телефон: <?= $order->user->phone ?></h5>

								<?php if (isset($order->user->city)) { ?>
									<h5>город: <?= $order->user->city ?></h5>
								<?php } ?>

								<?php if (isset($order->user->address)) { ?>
									<h5>город: <?= $order->user->adress ?></h5>
								<?php } ?>

								<p><a href="/admin/order/<?=$order->id?>" class="btn btn-primary">Редактировать</a></p>
							</div>
						<?php } ?>

					</div>

					<div class="col-md-3 text-center func_buttons" style="height: 700px;">
						<h4 class="text-center">Пользователи</h4>
						<div>

							<a href="/admin/user/add" class="btn btn-primary">Добавить пользователя</a><br>
							<a href="/admin/user/edit/" class="btn btn-warning">Редактировать пользователя</a><br>
							<a href="/admin/user/repass/" class="btn btn-danger">Сбросить пароль пользователю</a><br>

						</div>
						<h4 class="text-center">Товары</h4>
						<div>

							<a href="/admin/product/add" class="btn btn-primary">Добавить товар</a><br>
							<a href="/admin/product/edit/" class="btn btn-warning">Редактировать товар</a><br>

						</div>
						<h4 class="text-center">Категории</h4>
						<div>

							<a href="/admin/category/add" class="btn btn-primary">Добавить категорию</a><br>
							<a href="/admin/category/edit/" class="btn btn-warning">Редактировать категорию</a><br>

						</div>
					</div>

				</div>

			</div>

		</div>

	</div>
</div>