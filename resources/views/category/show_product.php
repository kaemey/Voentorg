<?php
	use App\RMVC\Route\Route;
	if (!isset($product)) Route::redirect('/home');
	$image = $product['product_image'];
	$title = $product['product_title'];
	$description = $product['description'];
	$colors = null;
	
	if($product['colors']){
		$colors = explode(",", $product['colors']);
	}
?>

<div class="container">

	<div class="row">
		
		<div class="col-md-12" style="background-color: #f0f0f0">
			
				<div class="container-fluid">
				
					<div class="row">
						<div class="col-md-12 line_full">
							<?php if (count($subcategories)>0) { ?>
								<?=$subcategories[0]['category_title']?>				
							<?php } else { ?>
								<?=$product['category_title']?>
							<?php } ?>
						</div>
					</div>
					
					<div class="row">
					
						<div class="col-md-9">
						
							<div class="container-fluid" style="min-height: 700px">
								<div class='row product mt-1'>
									<div class='col-md-12 col-sm-12 col-xl-3 text-center'>
										<img src='<?=$url.$image?>'>
									</div>
									<div class='col-md-12 col-sm-12 col-xl-9 text-center'>
										<p><?=$title?></p>
										<?php if($colors){ ?>
											<?php for ($i = 1; $i <= count($colors); $i++) {?>
												<div @click='selectColor(<?=$i?>)' id='selectColor<?=$i?>' class='selectColor' style='background-color: #<?=$colors[$i]?>'></div>
											<?php } ?>
										<?php } ?>
										<div class='products_count'>
											<button @click='subtract_products_count'>-</button><input type='text' :value='products_count'><button  @click='add_products_count'>+</button><br><br>
										</div>
										<button @click='add_to_cart(<?=json_encode($product)?>)' class='btn btn-primary'>Добавить в корзину</button>
													
									</div>
								
									<div class='row mt-5'>
										<h4><?=$description?></h4>
									</div>	
								</div>																
							</div>
							
						</div>

						<div class="col-md-3">
						
							<div class="container-fluid">
							
								<div class="row">
									<li class="right_menu_li ">
										<a href="#" class="right_menu_a">Профиль</a>
									</li>
									<li class="right_menu_li ">
										<a href="#" class="right_menu_a">Мои заказы</i></a>
									</li>
									<li class="right_menu_li ">
										<a href="#" class="right_menu_a">Учетная запись</a>
									</li>
									<li class="right_menu_li ">
										<a href="#" class="right_menu_a">Профиль доставки</a>
									</li>
								</div>
								
								<div class="row" style="background-color: #616C41; color: white; font-size: 24px; text-align: center; font-weight: bold;">
									<div>КАТАЛОГ</div>
								</div>

								<div class="row categories_right" style="margin-top: 4%;">
									<ul>
										
									<?php foreach ($categories as $category){ ?>
										<?php if($ctg_id == $category['id']){ ?>
											<li>
												<a href="/category/<?=$category['id']?>/" style="color: blue; font-size: 20px; text-decoration: none; font-weight: bold;"><?=$category['category_title']?></a>
											</li>			
											<?php if($ctg_id == $category['id']){ ?>	
												<ul style="margin-top: 3%;">
													<?php foreach ($subcategories as $subcat){ ?>
														<li>
															<a href="/subcategory/<?=$category['id']?>/<?=$subcat['subcategory_id']?>"><?=$subcat['subcategory_title']?></a>
														</li>	
													<?php } ?>	
												</ul>
											<?php } ?>									
										<?php } else { ?>
											<li>
												<a href="/category/<?=$category['id']?>/"><?=$category['category_title']?></a>
											</li>
										<?php } ?>	
									<?php } ?>

									</ul>
								</div>
								
							</div>
							
						</div>
						
					</div>
					
				</div>
			
		</div>
		
	</div>
</div>