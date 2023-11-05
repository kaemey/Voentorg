<?php
$title="Тестовый сайт";
?>

<!doctype html>
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <title><?=$title?></title>
  <link rel="stylesheet" href="<?=$url?>bootstrap.min.css">
  <link rel="stylesheet" href="<?=$url?>css.css">
</head>
<body id="app">

<script src="<?=$url?>axios.min.js"></script>
<script src="<?=$url?>cookie.js"></script>
<script src="<?=$url?>vue.global.js"></script>
<script src="<?=$url?>bootstrap.bundle.min.js"></script>
<header>
<div class="container">

	<div class="row">
		<div class="col-xl-9 col-md-6 col-sm-1">

		</div>
		
		<div class="col-xl-3 col-md-6 col-sm-11">
			<ul class="login">
				<?php
					if(!isset($_SESSION['login']))echo '
					<li><a href="/login">Войти</a></li>
					<li><a href="/reg">Регистрация</a>
					';
					else echo '
					<li><a href="/profile">Профиль</a></li>
					<li><a href="logout">Выйти</a></li>
					';
				?>
			</ul>
		</div>
		
	</div>
	
	<div class="row">
	
		<div class="col-xl-3 col-md-6">
			<img src="<?=$url?>images/logo.png" alt="logo">
		</div>
		<div class="col-xl-4 col-md-12" style="padding-top: 2%; margin-left: 5%">
			<form class="search">
				<input type="text" name="search_text">
				<button type="submit"><img src="<?=$url?>images/search.png" alt="search"></button>
			</form>
		</div>
		
		<div class="col-xl-3 col-md-6 phone" style="padding-top: 3%">
			<img src="<?=$url?>images/phone.png" width="36" alt="phone"> <a href="tel:880005553535">8 800 555-35-35</a>
		</div>
		
		<div class="col-xl-1 col-md-6 cart" style="padding-top: 3%" @click="display_cart = !display_cart">
			<img src="<?=$url?>images/cart.png" width="36" alt="cart"><div class="cart_count">{{cart_row}}</div><br>
			Корзина
			<div class="show_cart"  @mouseleave="display_cart = false" v-show="display_cart" style="display: none">
				<div v-for="pos in cart_products">
					{{ pos.title }} : {{ pos.count }} шт.
				</div>
				<a href="" class="btn btn-primary cart_order">Заказать</a>
				<button @click.prevent="clear_cart" class="btn btn-danger cart_order">Очистить</button>
			</div>
		</div>

	</div>
	
</div>
</header>

<div class="container text-center header">
	<div class="row menu">
	
		<div class="col-xl-3 col-md-12">		
				<li><a href="/home">Главная</a></li>
		</div>
		<div class="col-xl-3 col-md-12">		
				<div id="catalog">

					<li><a @click.prevent="display_catalog = !display_catalog" href="">Каталог</a><img src="<?=$url?>images/arrow.png" alt="V"></li>

					<div v-show="display_catalog" @mouseleave="display_catalog = false" style="display: none;">			
						<ul class="catalog_header">
							<?php
								foreach($categories as $category){
									echo "<a href='$url".'category/'.$category['id']."'>".$category['category_title']."</a><br>";
								}
							?>
						</ul>
					</div>

				</div>
		</div>
		<div class="col-xl-3 col-md-12">
				<li><a href="#">Контакты</a></li>	
		</div>
		
		<div class="col-xl-3 col-md-12">
				<li><a href="#">Как заказать?</a></li>	
		</div>

	</div>
</div>

<article>
<?php
echo $content;
?>
</article>

<footer>
	<div class="container-fluid" style="background-color: #212529; padding-top: 1%;">

		<div class="row">
			<div class="col-md-2">
			</div>
			<div class="col-md-5 copyright">
				<p>© Copyright 2023 ARS ARMA</p>
			</div>
			<div class="col-md-4">
				<p style="color: white; font-weight: bold; font-size: 24px;">Звоните: 8 800 555-35-35</p>
			</div>
			
		</div>

	</div>
</footer>
<script type="module" src="<?=$url?>scripts.js"></script>
</body>
</html>