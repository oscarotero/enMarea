<?php 
$social = new SocialLinks\Page([
    'url' => $this->url('news'),
    'title' => 'Actualidade',
    'text' => 'En Marea, a alternativa de cambio en Galicia. Coñece a Luís Villares, o futuro presidente da Xunta',
    'image' => $this->asset('img/img-rrss.png'),
    'twitterUser' => '@en_marea',
]);
?>

<?= $this->layout('layouts/default', ['menu' => 'news', 'social' => $social]) ?>

<?php $this->start('extra-head') ?>
<link rel="stylesheet" type="text/css" href="<?= $this->asset('css/pages/news.css') ?>">
<link rel="alternate" type="application/rss+xml" title="RSS" href="<?= $this->url('news-rss') ?>">
<?php $this->stop(); ?>

<header class="page-header">
	<h1>Actualidade</h1>
	<p>O cambio día a día</p>
</header>

<ul class="newList">
	<?php
    foreach ($news as $new) {
        $this->insert('partials/news/list', ['new' => $new]);
    }
    ?>
</ul>

<nav class="page-navigation">
<?php if ($nextPage): ?>
	<a href="<?= $this->url('news').'?p='.$nextPage ?>" class="button">
		Novas anteriores
	</a>
</nav>
<?php endif ?>