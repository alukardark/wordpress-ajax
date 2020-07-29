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












/** AJAX*/
function true_filter_function(){
    $query = [
        'post_type'  => 'menu',
//        'cat' => 3,
        'orderby' => 'date',
        'order'	=> $_POST['date'],
        'posts_per_page'  => '-1',

        'meta_query' =>  [
            'relation'=>'AND',
            [
                'key' => 'menu-type',
                'value' => 'osnovnoye'
            ],
            [
//                'key' => 'menu-img-min',
//                'value' => '', //The value of the field.
//                'compare' => '!=', //Conditional statement used on the value.
            ]
        ]
    ];

    // для таксономий
    if( isset( $_POST['categoryfilter'] ) )
        $query['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field' => 'id',
                'terms' => $_POST['categoryfilter']
            )
        );

    // создаём массив $args['meta_query'] если указана хотя бы одна цена или отмечен чекбокс
    if( ( isset( $_POST['menu-img-min'] ) ) ){
//        $query['meta_query'] = array( 'relation'=>'AND' );
    }


//    // условие 1: цена больше $_POST['cena_min']
//    if( isset( $_POST['cena_min'] ) )
//        $args['meta_query'][] = array(
//            'key' => 'cena',
//            'value' => $_POST['cena_min'],
//            'type' => 'numeric',
//            'compare' => '>'
//        );
//
//    // условие 2: цена меньше $_POST['cena_max']
//    if( isset( $_POST['cena_max'] ) )
//        $args['meta_query'][] = array(
//            'key' => 'cena',
//            'value' => $_POST['cena_max'],
//            'type' => 'numeric',
//            'compare' => '<'
//        );






    // условие 3: миниатюра имеется
    if( isset( $_POST['menu-img-min'] ) ){
        $query['meta_query'][] =  [
            'key' => 'menu-img-min',
            'value' => '', //The value of the field.
            'compare' => '!=', //Conditional statement used on the value.
        ];

    }


    $query = new WP_Query($query);


    if($query->have_posts()):
        while($query->have_posts()):
            $query->the_post();
            echo '<h2>'; the_title(); echo '</h2>';
        endwhile;
        wp_reset_postdata();
    endif;







    die();
}


add_action('wp_ajax_myfilter', 'true_filter_function');
add_action('wp_ajax_nopriv_myfilter', 'true_filter_function');












