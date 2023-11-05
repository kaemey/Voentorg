<div class="container">

	<div class="row">
		
		<div class="col-md-12" style="background-color: #f0f0f0">
			
				<div class="container-fluid">
				
					<div class="row">
						<div class="col-md-12 line_full">
							<?php if (isset($products)) echo $products[0]['category_title']; ?>
						</div>
					</div>
					
					<div class="row">
					
						<div class="col-md-9">
						
							<div class="container-fluid">

								<?php
									if (isset($products)){
										echo "<div class='row'>";
										for ($i = 0; $i < count($products); $i++){
											if($i % 3 == 0) echo "</div><div class='row'>";
											echo "
											<div class='col-md-4 catalog_chapter'>
												<a href='/product/".$products[$i]['category_id']."/".$products[$i]['subcategory_id']."/".$products[$i]['product_id']."'>
													<img src='".$url.$products[$i]['product_image']."' alt='catalog_chapter'>
													<p>".$products[$i]['product_title']."</p>
												</a>
											</div>
											";
										}
										echo "</div>";
									}
								?>
								
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
										
											<?php
												foreach ($categories as $category){

													if($ctg_id == $category['id']){
														echo '
														<li>
															<a href="/category/'.$category['id'].'/" style="color: blue; font-size: 20px; text-decoration: none; font-weight: bold;">'.$category['category_title'].'</a>
														</li>
														';		

														if(isset($subcategories)){
															echo '<ul style="margin-top: 3%;">';
															foreach($subcategories as $subcat){
																echo '
																	<li>
																		<a href="/subcategory/'.$category['id'].'/'.$subcat['subcategory_id'].'">'.$subcat['subcategory_title'].'</a>
																	</li>												
																';
															}
															echo '</ul>';
														}	
																								
													}
													else{
														echo '
														<li>
															<a href="/category/'.$category['id'].'/">'.$category['category_title'].'</a>
														</li>
														';
													}
		
												}
											?>

									</ul>
								</div>
								
							</div>
							
						</div>
						
					</div>
					
				</div>
			
		</div>
		
	</div>
</div>