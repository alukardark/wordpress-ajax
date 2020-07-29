<?php get_header(); ?>


<?php
$all_categories = get_categories(['hide_empty' => 0]);
$category_link_array = array();
foreach ($all_categories as $single_cat) {
    $category_link_array[] = '<a href="' . get_category_link($single_cat->term_id) . '">' . $single_cat->name . '</a>';
}
echo implode(',', $category_link_array);

?>


<?php
$query = get_posts([
    'post_type' => 'menu',
    'cat' => 3,
    'posts_per_page' => '-1',
    'meta_query' => [
        [
            'key' => 'menu-type',
            'value' => 'osnovnoye'
        ]
    ]
]);

foreach ($query as $post) {
    setup_postdata($post);

    echo '<h2>';
    the_title();
    echo get_field('menu-price');
    echo '</h2>';
}

wp_reset_postdata();



?>
<form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
    <?
    if( $terms = get_terms( 'category', 'orderby=name&hide_empty=1&exclude=1' ) ) :
        echo '<select name="categoryfilter"><option>Выберите категорию...</option>';
        foreach ($terms as $term) :
            echo '<option value="' . $term->term_id . '">' . $term->name . '</option>';
        endforeach;
        echo '</select>';
    endif;
    ?>

        <label><input type="checkbox" name="menu-img-min" /> Только с миниатюрой</label>

        <button>Применить фильтр</button>
        <input type="hidden" name="action" value="myfilter">
    </form>
    <div id="response"></div>

<?
//
//$query = new WP_Query([
//    'post_type'  => 'menu',
//
//    'cat' => 3,
//    'posts_per_page'  => '-1',
//    'meta_query' =>  [
//        [
//            'key' => 'menu-type',
//            'value' => 'osnovnoye'
//        ]
//    ]
//]);
//
//
//
//
//if($query->have_posts()):
//    while($query->have_posts()):
//        $query->the_post();
//        echo '<h2>'; the_title(); echo '</h2>';
//    endwhile;
//    wp_reset_postdata();
//endif;
//
//?>


<?php
//// указываем категорию 9 и выключаем разбиение на страницы (пагинацию)
//$query = new WP_Query(   array( 'post_type' => 'menu', 'cat' => 3));
//if( $query->have_posts() ){
//    while( $query->have_posts() ){
//        $query->the_post();
//        ?>
    <!--        <h2><a href="--><?php //the_permalink(); ?><!--">--><?php //the_title(); ?><!--</a></h2>-->
    <!--        --><?php //the_content(); ?>
    <!--        --><?php
//    }
//    wp_reset_postdata(); // сбрасываем переменную $post
//}
//else
//    echo 'Записей нет.';
//?>


    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>




    <div class="news menu" style="position: relative;">
        <div class="container cont-pad">

            <div class="cont-breadcrumbs"><?php if (function_exists('bcn_display')) {
                    bcn_display();
                } ?></div>

            <div class="col-md-12"><h1>Меню</h1></div>
            <ul class="news-list">
                <?php
                global $query_string;

                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $custom_query = new WP_Query(array('post_type' => 'menu', 'paged' => $paged, 'cat' => 3));

                if ($custom_query->have_posts()) : while ($custom_query->have_posts()) : $custom_query->the_post(); ?>

                    <li class="news-unit">


                        <? the_title(); ?>
                        <br>
                        <!--                            --><?php //print_r(esc_url( get_permalink() ) ); ?>
                        <!--                            <br>-->
                        <!--                            --><?php //echo get_field('menu-img-min')['sizes']['menu-min']; ?>
                        <!--                            <br>-->
                        <!--                            --><?php //echo get_field('menu-img-big'); ?>
                        <!--                            <br>-->
                        <!--                            --><?php //echo get_field('menu-desc'); ?>
                        <!--                            <br>-->
                        <!--                            --><?php //echo get_field('menu-attr'); ?>
                        <!--                            <br>-->
                        <!--                            --><?php //echo get_field('menu-weight'); ?>
                        <!--                            <br>-->
                        <!--                            --><?php //echo get_field('menu-price'); ?>
                        <!--                            <br>-->
                        <!--                            --><?php //echo get_field('menu-type'); ?>

                    </li>

                <?php endwhile; endif; ?>

            </ul>
        </div>
    </div>
    </div>



<!--<!--    category = "salaty"-->-->
<?// echo do_shortcode('[ajax_load_more
//id = "your_id"
//post_type = "menu"
//loading_style = "infinite skype"
//scroll_distance = "-100"
//
//meta_relation = "AND"
//meta_key = "menu-type"
//meta_value = "osnovnoye"
//meta_compare = "IN"
//meta_type = "CHAR"
//]'); ?>


    <ul class="alm-filter-nav">
        <li><a href="#" data-repeater="default-3" data-category="" data-meta-key="menu-type" data-meta-value="osnovnoye" data-meta-compare="IN" data-meta-type="CHAR" data-meta_relation="AND" class="active">osnovnoye</a></li>
        <li><a href="#" data-repeater="default-4" data-category="" data-meta-key="menu-type" data-meta-value="aktsionnoye" data-meta-compare="IN" data-meta-type="CHAR" data-meta_relation="AND">aktsionnoye</a></li>

        <li><a href="#" data-repeater="default-1" data-category="salaty" data-meta_relation="AND"  >salaty</a></li>
        <li><a href="#" data-repeater="default-2" data-category="supy" data-meta_relation="AND"    >supy</a></li>


    </ul>

<?php
echo do_shortcode('
[ajax_load_more
repeater="default"
post_type="menu"
posts_per_page="5"

loading_style = "infinite skype"
scroll_distance = "-100"

meta_key="menu-type"
meta_value="osnovnoye"
meta_compare="IN"
meta_type="CHAR"
meta_relation = "AND"
]
');
?>






<?php
get_footer();
