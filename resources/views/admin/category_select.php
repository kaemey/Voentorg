<?php
	use App\RMVC\Route\Route;
	use App\Http\Controllers\UserController;

    if (!isset($_SESSION['login']))  Route::redirect('/home');

	UserController::checkAdmin();

?>
<div class="container">

	<div class="row">
		
		<div class="col-md-12" style="background-color: #f0f0f0">
			
				<div class="container-fluid">
				
					<div class="row">
						<div class="col-md-12 line_full">
                        Страница выбора категории
						</div>
					</div>
					
					<div class="row">
					
						<div class="col-md-12" style="min-height: 700px">
							<a href="/admin" class="btn btn-warning">Назад</a><br><br>
                            <?php foreach($categories as $category){ ?>
								<h3><?=$category['category_title']?></h3>
								<a class="btn btn-primary" href="/admin/category/edit/<?=$category['id']?>">Редактировать</a>
                            <?php } ?>
							
						</div>
						
					</div>
					
				</div>
			
		</div>
		
	</div>
</div>