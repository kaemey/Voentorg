<?php
use App\RMVC\Route\Route;

if (!isset($_SESSION['login']))
	Route::redirect('/login');
?>

<div class="container">

	<div class="row">

		<div class="col-md-12" style="background-color: #f0f0f0">

			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12 line_full">
						ОФОРМЛЕНИЕ ЗАКАЗА
					</div>
				</div>

				<div class="row">

					<div class="col-md-4 do_order" style="height: 700px;">

						<div class="orders_list" v-for="pos in cart_products">
							{{ pos.title }} : {{ pos.count }} шт.
						</div>

						<form action="/do_order" method="POST">
							<input type="hidden" name="products" :value="parsed_products.toString()">
							<input type="submit" class="btn btn-primary" value="Заказать"><br><br>
						</form>

						<button @click.prevent="clear_cart" class="btn btn-danger">Очистить корзину</button>

					</div>

				</div>

			</div>

		</div>

	</div>
</div>