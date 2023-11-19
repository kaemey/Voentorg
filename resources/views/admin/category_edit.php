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
						
						<form action="/admin/category/edit/<?= $category['id'] ?>" method="POST">
							Title<br>
							<input type="text" name="title" value="<?= $category['category_title'] ?>"><br>
							Image<br>
							<input type="text" name="image" value="<?= $category['category_image'] ?>"><br><br>
							<select multiple class="select" name="subcategories[]">
								<?php foreach($allSubcategories as $subcategory) { ?>
									<option <?=in_array($subcategory['subcategory_id'], $mySubcategoriesIds) ? "selected" : "" ?> value="<?=$subcategory['subcategory_id']?>"><?=$subcategory['subcategory_title']?></option>
								<?php } ?>
							</select><br><br>
							<input type="submit" class="btn btn-primary" value="Отредактировать">
						</form><br>
						<form action="/admin/category/delete/<?= $category['id'] ?>" method="POST">
							<input type="submit" class="btn btn-danger" value="Удалить категорию">
						</form><br>
						<a href="/admin/category/edit" class="btn btn-warning">Назад</a><br><br>

					</div>

				</div>

			</div>

		</div>

	</div>
</div>