<?php
use App\RMVC\Route\Route;
use App\Http\Controllers\UserController;

if (!isset($_SESSION['login']))
	Route::redirect('/home');
UserController::checkAdmin();

?>
<div class="container">

	<div class="row">

		<div class="col-md-12" style="background-color: #f0f0f0">

			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12 line_full">
						Страница редактирования категории
					</div>
				</div>

				<div class="row">

					<div class="col-md-4" style="height: 700px;">
						
						<form action="/admin/subcategory/edit/<?= $subcategory['subcategory_id'] ?>" method="POST">
							Title<br>
							<input type="text" name="subcategory_title" value="<?= $subcategory['subcategory_title'] ?>"><br>
							Image<br>
							<input type="text" name="subcategory_image" value="<?= $subcategory['subcategory_image'] ?>"><br><br>	
							<input type="submit" class="btn btn-primary" value="Отредактировать">
						</form><br>
						<form action="/admin/subcategory/delete/<?= $subcategory['subcategory_id'] ?>" method="POST">
							<input type="submit" class="btn btn-danger" value="Удалить подкатегорию">
						</form><br>
						<a href="/admin/subcategory/edit" class="btn btn-warning">Назад</a><br><br>

					</div>

				</div>

			</div>

		</div>

	</div>
</div>