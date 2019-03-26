<!DOCTYPE HTML>
<html>
	<head>
		<title>Future Imperfect</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="./../../template/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="/">Future Imperfect</a></h1>
						<nav class="links">
							<ul>
								<li><a href="/">Главная</a></li>
								<li><a href="/catalog">Темы</a></li>
								<li><a href="/about">Об авторе</a></li>
								<li><a href="/contacts">Контакты</a></li>
							</ul>
						</nav>
						<? if (User::isGuest()): ?> 
							<nav class="login">
								<ul>
									<li><a href="/user/login">Вход</a></li>
									<li><a href="/user/register">Регистрация</a></li>
								</ul>
							</nav>
						<? else: ?>
							<div class="user">
								<span class="user-name"><? $user = User::getUserById($_SESSION['user']); echo $user['name']; ?></span>
								<div class="user-menu">
									<span class="user-menu__item"><? echo $user['name']; ?></span>
									<a href="/cabinet/edit" class="user-menu__item">Профиль</a>
									<? if (User::isAdmin()): ?>
										<a href="/admin" class="user-menu__item">Админка</a>
									<? endif; ?>
									<a href="/user/logout" class="user-menu__item">Выход</a>
								</div>
							</div>
						<? endif; ?>
					</header>

					</section>