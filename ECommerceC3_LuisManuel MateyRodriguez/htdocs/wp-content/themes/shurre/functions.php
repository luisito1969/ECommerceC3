<?php
/**
 * ShUrRe functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ShUrRe
 */

if ( ! function_exists( 'shurre_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function shurre_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on ShUrRe, use a find and replace
		 * to change 'shurre' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'shurre', get_template_directory() . '/languages' );

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
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'shurre' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );


		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'shurre_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'shurre_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function shurre_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'shurre_content_width', 640 );
}
add_action( 'after_setup_theme', 'shurre_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function shurre_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'shurre' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'shurre' ),
		'before_widget' => '<div class="card"><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside></div>',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'shurre_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function shurre_scripts() {
	wp_enqueue_style( 'shurre-style', get_stylesheet_uri() );

	wp_enqueue_script( 'yourthemename-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', false );

	wp_enqueue_script( 'shurre-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'shurre-navigation', get_template_directory_uri() . '/js/material-custom-scripts.js', array(), '20151215', true );

	wp_enqueue_script( 'shurre-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'shurre_scripts' );

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




// Add Material scripts and styles
 if( !is_admin()){

 wp_deregister_script('jquery');
 wp_enqueue_script( 'material-jquery', 'http://code.jquery.com/jquery-2.1.3.min.js', array(), '1.0', false );

 }
 wp_enqueue_style( 'material-style', get_template_directory_uri() . '/css/materialize.css' );
 wp_enqueue_script( 'material-script', get_template_directory_uri() . '/js/materialize.js', array(), '1.0', false );
 wp_enqueue_script( 'material-custom', get_template_directory_uri() . '/js/material-custom-scripts.js', array(), '1.0', false );

 Class My_Recent_Posts_Widget extends WP_Widget_Recent_Posts {

 function widget($args, $instance) {

 extract( $args );

 $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);

 if( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 $number = 10;

 $r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
 if( $r->have_posts() ) :

 echo $before_widget;
 if( $title ) echo $before_title . $title . $after_title; ?>
 <ul class="collection rpwidget">
 <?php while( $r->have_posts() ) : $r->the_post(); ?>
 <li class="collection-item avatar">
 <?php echo get_the_post_thumbnail( $post_id, 'thumbnail', array( 'class' => 'alignleft circle' ) ); ?>
 <span class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></span>
 <p>by <?php the_author(); ?> on <?php echo get_the_date(); ?></p>
 </li>
 <?php endwhile; ?>
 </ul>

 <?php
 echo $after_widget;

 wp_reset_postdata();

 endif;
 }
}
function my_recent_widget_registration() {
  unregister_widget('WP_Widget_Recent_Posts');
  register_widget('My_Recent_Posts_Widget');
}
add_action('widgets_init', 'my_recent_widget_registration');


// Dress up the post navigation

add_filter( 'next_post_link' , 'my_nav_next' , 10, 4);
add_filter( 'previous_post_link' , 'my_nav_previous' , 10, 4);

function my_nav_next($output, $format, $link, $post ) {
 $text = ' previous post';
 $rel = 'prev';

 return sprintf('<a href="%1$s" rel="%3$s" rel="nofollow" class="waves-effect waves-light btn left"><span class="white-text"><i class="mdi-navigation-chevron-left left"></i>%2$s</span></a>' , get_permalink( $post ), $text, $rel );
}

function my_nav_previous($output, $format, $link, $post ) {
 $text = ' next post';
 $rel = 'next';

 return sprintf('<a href="%1$s" rel="%3$s" rel="nofollow" class="waves-effect waves-light btn right"><span class="white-text">%2$s<i class="mdi-navigation-chevron-right right"></i></span></a>' , get_permalink( $post ), $text, $rel );
}



// Custom comment functionality

add_filter('get_avatar','change_avatar_css');

function change_avatar_css($class) {
$class = str_replace("class='avatar", "class='avatar circle left z-depth-1", $class) ;
return $class;
}

add_filter('comment_reply_link', 'materialized_reply_link_class');


function materialized_reply_link_class($class){
	 $class = str_replace("class='comment-reply-link", "class='waves-effect waves-light btn", $class);
	 return $class;
}

function materialized_comment($comment, $args, $depth) {
$GLOBALS['comment'] = $comment;
extract($args, EXTR_SKIP);

if ( 'div' == $args['style'] ) {
$tag = 'div';
$add_below = 'comment';
} else {
$tag = 'li';
$add_below = 'div-comment';
}
?>
<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
<?php if ( 'div' != $args['style'] ) : ?>
<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
<?php endif; ?>
<div class="comment-author vcard">
<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
<?php
/* translators: 1: date, 2: time */
printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), '  ', '' );
?>
</div>
<?php printf( __( '<cite class="fn">%s</cite> <span class="says">wrote:</span>' ), get_comment_author_link() ); ?>
</div>
<?php if ( $comment->comment_approved == '0' ) : ?>
<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
<br />
<?php endif; ?>


<?php comment_text(); ?>

<div class="reply right">
<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
</div>
<?php if ( 'div' != $args['style'] ) : ?>
<div class="clear"></div>
</div>
<?php endif; ?>
<div class="divider"></div>
<?php
}


function shortcode_recientes($atts, $content = null, $code) {

//Uso: [recientes  limite="3" longitud_titulo="50" longitud_desc="50" thumbnail="1" tamano="50"]
//thumbnail="1" muestra imagen destacada. thumbnail="0" no muestra la imagen
    extract(shortcode_atts(array(
        'limite' => 5,
        'longitud_titulo' => 50,
        'longitud_desc' => 80,
        'thumbnail' => false,
        'tamano' => 65

    ), $atts));

    $query = array('showposts' => $limite,  'orderby'=> 'date', 'order'=>'DESC', 'post_status' => 'publish', 'ignore_sticky_posts' => 1);

    $q = new WP_Query($query);
    if ($q->have_posts()) :
    $salida  = '';
    $salida .= '<ul class="listado-recientes">';

    /* comienzo while */
    while ($q->have_posts()) : $q->the_post();
    $salida .= '<li>';
    if ( has_post_thumbnail() && $thumbnail == true):
    $salida .= '<a href="'.get_permalink().'" title="'.sprintf( "Enlace permanente a %s", get_the_title() ).'">';
    $salida .= get_the_post_thumbnail(get_the_id(),array($tamano,$tamano),array('title'=>get_the_title(),'alt'=>get_the_title(),'class'=>'imageborder alignleft'));
    $salida .= '</a>';
    endif;

    $salida .= '<div class="posts_content">';
    $salida .= '<a href="'.get_permalink().'" title="'.sprintf( "Enlace permanente a %s", get_the_title() ).'">';
    $salida .= wp_html_excerpt (get_the_title(), $longitud_titulo );
    $salida .= '</a>';
    $salida .= '<p>';

        /* Calculo las categorías  */

        $categories = get_the_category();
        $separator = ' ';
        $output = '';
        if($categories){
                foreach($categories as $category) {
                        $output .= $category->cat_name.''.$separator;
                }
                $salida .= trim($output, $separator);
        }
    $salida .= '</p>';
        /* Escribo fecha  */
    $salida .= '<p>'.get_the_time().'</p>';

        /* Escribo extracto  */

    $excerpt = get_the_excerpt();
    $salida .= ($excerpt)?'<p>'.wp_html_excerpt($excerpt,$longitud_desc).'...</p>':'';

    $salida .= '</div>';
    $salida .= '</li>';
    endwhile;
    wp_reset_query();
    /* fin while */

    $salida .= '</ul>';
    endif;

    return $salida;

}
add_shortcode('recientes',    'shortcode_recientes');
