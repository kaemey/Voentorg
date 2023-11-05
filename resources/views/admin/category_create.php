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
							
                            <form action="/category/create" method="POST">
                                Title<br>
                                <input type="text" name="title"><br>
                                Image<br>
                                <input type="text" name="image"><br><br>
                                <input type="submit" class="btn btn-primary" value="Создать">
                            </form><br>
                            <a href="/admin/product" class="btn btn-warning">Создать продукт</a><br><br>
							
						</div>
						
					</div>
					
				</div>
			
		</div>
		
	</div>
</div>