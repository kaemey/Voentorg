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
                        Страница создания продукта
						</div>
					</div>
					
					<div class="row">
					
						<div class="col-md-4" style="height: 700px;">
							
                            <form action="/product" method="POST" id="product_create">
                                Заголовок<br>
                                <input type="text" name="title" value="<?=$product['title']?>"><br>
                                Цена<br>
                                <input type="text" name="price" value="<?=$product['price']?>"><br>
                                Путь к изображению<br>
                                <input type="text" name="image" value="<?=$product['image']?>"><br>
                                Описание<br>
                                <textarea name="description" style="width: 100%; height: 10rem"> value="<?=$product['description']?>"</textarea><br>
                                Категория<br>
                                <select name="category_id" @change="updateSubctgs(cat_id)" v-model="cat_id">
                                    <option value='0' disabled>Выбери категорию</option>

                                    <?php foreach($categories as $category){ ?>
                                            <option value='<?=$category['id']?>'><?=$category['category_title']?></option>
                                    <?php } ?>
                                    
                                </select><br><br>
                                Податегория<br>
                                <select name="subcategory_id">
                                    <option v-for="subcategory in subcategories" :value='subcategory.subcategory_id'>{{subcategory.subcategory_title}}</option>
                                </select><br><br>
                                Цвета<br>
                                <input type="text" name="colors" value="<?=$product['color']?>"><br><br>
                                <input type="submit" class="btn btn-primary" value="Редактировать">
                            </form><br>
                            <a href="/admin/category/" class="btn btn-warning">Создать категорию</a><br><br>
							
						</div>
						
					</div>
					
				</div>
			
		</div>
		
	</div>
</div>