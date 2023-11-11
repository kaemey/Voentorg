<div class="container">

	<div class="row">
		
		<div class="col-xl-12">
			
				<div class="container-fluid">
				
					<div class="row">
						<div class="col-xl-12 line_full">
							КАТАЛОГ
						</div>
					</div>
					
					<div class="row">
					
					<div class="col-md-9">
						
						<div class="container-fluid">
							<div class='row'>";

								<?php for ($i = 0; $i < count($categories); $i++){ ?>
									<?php if ($i % 3 == 0) { ?>
										</div><div class='row'>
									<?php } ?>
									<div class='col-xl-4 col-md-6 col-sm-12 catalog_item'>
										<a href='<?=$url?>category/<?=$categories[$i]['id']?>'><img src='<?=$url.$categories[$i]['category_image']?>' alt='catalog_chapter'></a>
										<p><?=$categories[$i]['category_title']?></p>
									</div>
								<?php } ?>
								
							</div>
						</div>
						
					</div>

						<div class="col-xl-3 col-md-12 text-center">
						
							<div class="container-fluid">
							
								<div class="row">
									<p style="font-size: 24px; font-weight: bold;">Наши соцсети:</p>
									<div class="col-xl-6">
										<a href="youtube.com"><img src="images/youtube.png" alt="youtube" height="64"></a>
									</div>
									<div class="col-xl-6">
									<a href="youtube.com"><img src="images/vk.png" alt="VK" height="64"></a>
									</div>
								</div>
								
								<div class="row">
									<p style="font-size: 24px; font-weight: bold; margin-top: 3%;">Наши новости:</p>
									
									<div class="col-xl-12 news_label">
										<a href="#">Новость №1</a>
									</div>
									
									<div class="col-xl-12 news_label">
										<a href="#">Новость №2</a>
									</div>
									
									<div class="col-xl-12 news_label">
										<a href="#">Новость №3</a>
									</div>
									
									<div class="col-xl-12 news_label">
										<a href="#">Все новости</a>
									</div>

								</div>
								
							</div>
							
						</div>
						
					</div>
					
				</div>
			
		</div>
		
	</div>
</div>