<?php $currenturl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>
<!DOCTYPE html>
<html lang="fr-BE" class="no-js">

    <head>
	    <meta charset="<?php bloginfo( 'charset' ); ?>">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <title><?= wp_get_document_title(); ?></title>
        <script>
            document.querySelector('html').classList.remove('no-js');
        </script>
        <link rel="stylesheet" href="<?php ec_asset('css/styles.css');?>">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="Un vaste parcours artistique citoyen, mis sur pied par les artistes eux-mêmes et les associations du quartier, va être organisé, pour la quatrième fois en septembre 2018 : Saint Léon’ART!">
        <meta name="author" content="Eric Closquet">
        <meta name="keywords" content="Province de Liège, Art, Artiste, Saint Léonard, Lencreuse, Parcours artistique">
        <link rel="shortcut icon" href="<?php ec_asset('../favicon.png');?>">
        <style>
            <?php ec_the_cta_style( 129, '.intro-cta__info-list', '/', 'image_de_fond');?>
        </style>
        
        <?php wp_head(); ?>
    </head>

    <body itemscope itemtype="http://schema.org/NGO" class="h-card <?= $post->post_name??'' ?>" <?php //body_class(); ?>>
        <header class="top-bar" role="banner">
                <h1 class="site-title <?php //if( have_posts() ) echo 'visually-hidden' ?>" role="heading" aria-level="1" >
                    <a class="site-title__link" href="http://<?= $_SERVER['HTTP_HOST'] ?>">
                        Saint Léon&rsquo;Art
                    </a>
                </h1>
            <a class="u-url site-logo-link" href="http://<?= $_SERVER['HTTP_HOST'] ?>">
                <img itemprop="logo" class="u-logo" src="<?php ec_asset( 'images/site-logo.svg' ); ?>" alt="Logo Saint Léon'art" width="24" height="27" title="Saint Léon'art">
            </a>
            <meta itemprop="url" content="http://<?= $_SERVER['HTTP_HOST'] ?>">
            <nav aria-labelledby="main-nav__title" role="navigation" class="main-nav">
                <h2 id="main-nav__title" role="heading" aria-level="2" class="visually-hidden">
                    Menu Principal
                </h2>
                <a href="javascript:void(0);" class="burger-link" id="burgerMenuLink" title="Menu">
                    <svg version="1.2" baseProfile="tiny" id="Calque_1" xmlns:x="&ns_extend;" xmlns:i="&ns_ai;" xmlns:graph="&ns_graphs;"
                         xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 60 51"
                         xml:space="preserve">
        <metadata>
            <sfw  xmlns="&ns_sfw;">
                <slices></slices>
                <sliceSourceBounds  bottomLeftOrigin="true" height="51" width="48" x="0" y="-51"></sliceSourceBounds>
            </sfw>
        </metadata>
                        <line fill="none" stroke="#ffffff" stroke-width="11" stroke-miterlimit="10" x1="0" y1="5.5" x2="60" y2="5.5"/>
                        <line fill="none" stroke="#ffffff" stroke-width="11" stroke-miterlimit="10" x1="0" y1="25.5" x2="60" y2="25.5"/>
                        <line fill="none" stroke="#ffffff" stroke-width="11" stroke-miterlimit="10" x1="0" y1="45.5" x2="60" y2="45.5"/>
    </svg>
                </a>
                <ul class="main-nav__links-list" id="myTopNav">
                    <li class="main-nav__item">
                        <a href="/" class="main-nav__link<?php echo ($_SERVER['REQUEST_URI'] == '/') ? ' main-nav__link--current-page' : '' ;?>">Accueil</a>
                    </li>
			        <?php foreach (ec_get_nav_items('header') as $item): ?>
                        <li class="main-nav__item<?= $item->children ? ' main-nav__item--parent' : '' ?>">
                            <a href="<?php echo $item->link;?>" class="main-nav__link<?php echo ($currenturl == $item->link) ? ' main-nav__link--current-page' : '' ;?>"><?php echo $item->label;?></a>
					        <?php if($item->children):?>
                                <ul class="main-nav__sub-links-list">
							        <?php foreach($item->children as $sub):?>
                                        <li class="main-nav__item main-nav__sub-links-list__item">
                                            <a href="<?php echo $sub->link;?>" class="main-nav__link<?php echo ($currenturl == $sub->link) ? ' main-nav__link--current-page' : '' ;?>"><?php echo $sub->label;?></a>
                                        </li>
							        <?php endforeach;?>
                                </ul>
					        <?php endif;?>
                        </li>
			        <?php endforeach; ?>
                </ul>
            </nav>
        </header>
        <main role="main" id="main">