<?php
use App\RMVC\Route\Route;

if (!isset($_SESSION['login']))
	Route::redirect('/login');
?>

<div class="container" id="order_success">

	<div class="row">

		<div class="col-md-12" style="background-color: #f0f0f0">

			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12 line_full">
						ПОДТВЕРЖДЕНИЕ ЗАКАЗА
					</div>
				</div>

				<div class="row">

					<div class="col-md-12 text-center" style="height: 400px;">

						<h2>Ваш заказ №
							<?= $order_id ?> успешно принят,
						</h2>
						<h2>ожидайте звонка менеджера!</h2>

					</div>

				</div>

			</div>

		</div>

	</div>
</div>

<script type="text/javascript">
	setCookie('ProductsCount', 0, { path: "/", expires: Date.now() + 7 * 24 * 60 * 60 * 1000 });
	for (var i = 1; i <= getCookie('ProductsCount'); i++) {
		deleteCookie('product' + i)
	}
</script>