<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>


<div class="wrapper">
    <div class="wrapper-content">
        <div class="header header--black">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="header__wrap">
                            <div class="header__nav-wrap">
                                <a href="/" class="header__logo"></a>
                                <ul class="header__nav">
                                    <li><a href="/menu/">Меню</a></li>
                                    <li><a href="/about/">О баре</a></li>
                                    <li><a href="/news/">Новости и акции</a></li>
                                    <li><a href="/delivery/">Условия доставки</a></li>
                                    <li><a href="/contacts/">Как нас найти</a></li>
                                </ul>
                            </div>
                            <div class="header__btns">
                                <a href="tel:<?=get_field('settings-tel', 94)?>" class="header__tel"><?=get_field('settings-tel', 94)?></a>

                                <a href="/basket/" class="header__basket"><span class="cur-basket">0</span>&nbsp;руб.
                                    <i class="btn-default waves-effect waves-light"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

