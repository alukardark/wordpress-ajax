<?php
/**
 * barcode functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package barcode
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'barcode_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function barcode_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on barcode, use a find and replace
		 * to change 'barcode' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'barcode', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'barcode' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'barcode_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'barcode_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function barcode_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'barcode_content_width', 640 );
}
add_action( 'after_setup_theme', 'barcode_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function barcode_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'barcode' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'barcode' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'barcode_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function barcode_scripts() {
	wp_enqueue_style( 'barcode-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'barcode-style', 'rtl', 'replace' );



//    wp_enqueue_script('jquery');
    wp_enqueue_script( 'jquery.min.js', get_template_directory_uri() . '/libs/jquery/dist/jquery.min.js');
    wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/libs/@fancyapps/fancybox/dist/jquery.fancybox.min.js');
    wp_enqueue_script( 'bodymovin', get_template_directory_uri() . '/libs/bodymovin/build/player/bodymovin.min.js');
    wp_enqueue_script( 'js.cookie', get_template_directory_uri() . '/libs/js-cookie/src/js.cookie.js');
    wp_enqueue_script( 'sidebar-sticky', get_template_directory_uri() . '/js/sidebar-sticky.js');
    wp_enqueue_script( 'waves-effect', get_template_directory_uri() . '/js/waves-effect.js');

    wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/js/TiltHoverEffects/imagesloaded.pkgd.min.js');
    wp_enqueue_script( 'anime', get_template_directory_uri() . '/js/TiltHoverEffects/anime.min.js');
    wp_enqueue_script( 'main', get_template_directory_uri() . '/js/TiltHoverEffects/main.js');







    wp_enqueue_script( 'barcode-script', get_template_directory_uri() . '/js/common.js');

    $wnm_custom = array( 'stylesheet_directory_uri' => get_stylesheet_directory_uri() );
    wp_localize_script( 'barcode-script', 'directory_uri', $wnm_custom );


	wp_enqueue_script( 'barcode-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'barcode_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}



add_image_size( 'menu-min', 380, 500 , true );
add_image_size( 'interior', 335, 265 , true );
add_image_size( 'news', 520, 320 , true );



/** Register post type*/
function register_post_type_menu() {
    $labels = array(
        'name' => 'Продукты',
        'singular_name' => 'Продукты', // админ панель Добавить->Функцию
        'add_new' => 'Добавить продукт',
        'add_new_item' => 'Добавить новый продукт',
        'edit_item' => 'Редактировать продукты',
        'new_item' => 'Новый продукт',
        'all_items' => 'Все продукты',
        'view_item' => 'Просмотр продукта',
        'search_items' => 'Искать продукты',
        'not_found' =>  'Продуктов не найдено.',
        'not_found_in_trash' => 'В корзине нет продуктов.',
        'menu_name' => 'Продукты' // ссылка в меню в админке
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
//        'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
//        'publicly_queryable' => true,  // you should be able to query it
        'show_ui' => true, // показывать интерфейс в админке
        'has_archive' => true,
        'taxonomies' => array('category'),
        //'menu_icon' => get_stylesheet_directory_uri() .'/img/function_icon.png', // иконка в меню
        'menu_icon' => 'dashicons-products', // иконка в меню
        'menu_position' => 30, // порядок в меню
        'supports' => array( 'title')
    );
    register_post_type('menu', $args);
}

add_action( 'init', 'register_post_type_menu' ); // Использовать функцию только внутри хука init

function register_post_type_news() {
    $labels = array(
        'name' => 'Новости и акции',
        'singular_name' => 'Новости и акции', // админ панель Добавить->Функцию
        'add_new' => 'Добавить новости и акции',
        'add_new_item' => 'Добавить новые новости и акции',
        'edit_item' => 'Редактировать новости и акции',
        'new_item' => 'Новая новость и акция',
        'all_items' => 'Все новости и акции',
        'view_item' => 'Просмотр новости и акции',
        'search_items' => 'Искать новости и акции',
        'not_found' =>  'Новостей и акций не найдено.',
        'not_found_in_trash' => 'В корзине нет новостей и акций.',
        'menu_name' => 'Новости и акции' // ссылка в меню в админке
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
//        'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
//        'publicly_queryable' => true,  // you should be able to query it
        'show_ui' => true, // показывать интерфейс в админке
        'has_archive' => true,
        'taxonomies' => array('category'),
        //'menu_icon' => get_stylesheet_directory_uri() .'/img/function_icon.png', // иконка в меню
        'menu_icon' => 'dashicons-excerpt-view', // иконка в меню
        'menu_position' => 30, // порядок в меню
        'supports' => array( 'title', 'editor' , 'thumbnail')
    );
    register_post_type('news', $args);
}

add_action( 'init', 'register_post_type_news' ); // Использовать функцию только внутри хука init



function register_post_type_settings() {
    $labels = array(
        'name' => 'Настройки сайта и&nbsp;прочее',
        'singular_name' => 'Настройки сайта и&nbsp;прочее', // админ панель Добавить->Функцию
        'add_new' => 'Добавить настройки',
        'add_new_item' => 'Добавить новые настройки',
        'edit_item' => 'Редактировать настройки',
        'new_item' => 'Новые настройки',
        'all_items' => 'Все настройки',
        'view_item' => 'Просмотр настроек',
        'search_items' => 'Искать настройки',
        'not_found' =>  'Настроек не найдено.',
        'not_found_in_trash' => 'В корзине нет Настроек.',
        'menu_name' => 'Настройки сайта и&nbsp;прочее' // ссылка в меню в админке
    );
    $args = array(
        'exclude_from_search' => true,
        'labels' => $labels,
        'public' => true,
        'show_ui' => true, // показывать интерфейс в админке
        'has_archive' => true,
        //'menu_icon' => get_stylesheet_directory_uri() .'/img/function_icon.png', // иконка в меню
        'menu_icon' => 'dashicons-wordpress-alt', // иконка в меню
        'menu_position' => 29 // порядок в меню
    ,'supports' => array( '' )
    );
    register_post_type('settings', $args);
}

add_action( 'init', 'register_post_type_settings' ); // Использовать функцию только внутри хука init







add_filter( 'site_transient_update_plugins', 'filter_plugin_updates' );
function filter_plugin_updates( $value ) {
    unset( $value->response['advanced-custom-fields-pro/acf.php'] );
    unset( $value->response['ajax-load-more/ajax-load-more.php'] );
    return $value;
}


add_filter ( 'wpcf7_autop_or_not' , '__return_false' );
add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
    $content = str_replace('<br />', '', $content);
    return $content;
});




add_filter('admin_footer', 'screen_test');
function screen_test(){
    $screen = get_current_screen();
    if($screen->base == 'flamingo_page_flamingo_inbound') {
        ?>
        <script>
            if(document.querySelector('table.message-fields tr:first-of-type td:nth-of-type(2) p')){
                var str = document.querySelector('table.message-fields tr:first-of-type td:nth-of-type(2) p');
                newText = str.textContent.replace(/\|/g, '<br>');
                str.innerHTML = newText;
                console.log('!');
            }

        </script>
        <?php
    }
}


function edit_admin_menus() {
    global $menu;
    global $submenu;

    if($menu[26][0] == 'Flamingo'){
        $menu[26][0] = 'Страница заказов';
    }
}
add_action( 'admin_menu', 'edit_admin_menus' );