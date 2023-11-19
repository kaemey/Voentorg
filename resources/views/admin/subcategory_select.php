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
							<a href="/adminPanel" class="btn btn-warning">Назад</a><br><br>
                            <?php foreach($subcategories as $subcategory){ ?>
								<h3><?=$subcategory['subcategory_title']?></h3>
								<a class="btn btn-primary" href="/admin/subcategory/edit/<?=$subcategory['subcategory_id']?>">Редактировать</a>
                            <?php } ?>
							
						</div>
						
					</div>
					
				</div>
			
		</div>
		
	</div>
</div>