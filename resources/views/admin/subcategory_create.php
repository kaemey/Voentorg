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
                        Страница создания категории
						</div>
					</div>
					
					<div class="row">
					
						<div class="col-md-4" style="height: 700px;">
							
                            <form action="/admin/subcategory" method="POST">
                                Title<br>
                                <input type="text" name="subcategory_title"><br>
                                Image<br>
                                <input type="text" name="subcategory_image"><br><br>
                                <input type="submit" class="btn btn-primary" value="Создать">
                            </form><br>
							
						</div>
						
					</div>
					
				</div>
			
		</div>
		
	</div>
</div>