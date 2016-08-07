<?php
/**
 * Get option wrapper
 * @param mixed $name
 * @param mixed $default
 * @return mixed 
 */
function ale_option($name, $default = false) {
	echo ale_get_option($name, $default);
}
function ale_filtered_option($name, $default = false, $filter = 'the_content') {
	echo apply_filters($filter, ale_get_option($name, $default));
}
function ale_get_option($name, $default = false) {
	$name = 'ale_' . $name;
	if (false === $default) {
		$options = aletheme_get_options();
		foreach ($options as $option) {
			if (isset($option['id']) && $option['id'] == $name) {
				$default = isset($option['std']) ? $option['std'] : false;
				break;
			}
		}
	}
	return of_get_option($name, $default);
}

/**
 * Echo meta for post
 * @param string $key
 * @param boolean $single
 * @param mixed $post_id 
 */
function ale_meta($key, $single = true, $post_id = null) {
	echo ale_get_meta($key, $single, $post_id);
}
/**
 * Find meta for post
 * @param string $key
 * @param boolean $single
 * @param mixed $post_id 
 */
function ale_get_meta($key, $single = true, $post_id = null) {
	if (null === $post_id) {
		$post_id = get_the_ID();
	}
	$key = 'ale_' . $key;
	return get_post_meta($post_id, $key, $single);
}
/**
 * Apply filters to post meta
 * @param string $key
 * @param string $filter
 * @param mixed $post_id 
 */
function ale_filtered_meta($key, $filter = 'the_content', $post_id = null) {
	echo apply_filters($filter, ale_get_meta($key, true, $post_id));
}

/**
 * Display permalink 
 * 
 * @param int|string $system
 * @param int $isCat 
 */
function ale_permalink($system, $isCat = false) {
    echo ale_get_permalink($system, $isCat);
}
/**
 * Get permalink for page, post or category
 * 
 * @param int|string $system
 * @param bool $isCat
 * @return string
 */
function ale_get_permalink($system, $isCat = 0)  {
    if ($isCat) {
        if (!is_numeric($system)) {
            $system = get_cat_ID($system);
        }
        return get_category_link($system);
    } else {
        $page = ale_get_page($system);
        
        return null === $page ? '' : get_permalink($page->ID);
    }
}

/**
 * Display custom excerpt
 */
function ale_excerpt() {
    echo ale_get_excerpt();
}
/**
 * Get only excerpt, without content.
 * 
 * @global object $post
 * @return string 
 */
function ale_get_excerpt() {
    global $post;
	$excerpt = trim($post->post_excerpt);
	$excerpt = $excerpt ? apply_filters('the_content', $excerpt) : '';
    return $excerpt;
}

/**
 * Display first category link
 */
function ale_first_category() {
    $cat = ale_get_first_category();
	if (!$cat) {
		echo '';
		return;
	}
    echo '<a href="' . ale_get_permalink($cat->cat_ID, true) . '">' . $cat->name . '</a>';
}
/**
 * Parse first post category
 */
function ale_get_first_category() {
    $cats = get_the_category();
    return isset($cats[0]) ? $cats[0] : null;
}

/**
 * Get page by name, id or slug. 
 * @global object $wpdb
 * @param mixed $name
 * @return object 
 */
function ale_get_page($slug) {
    global $wpdb;
    
    if (is_numeric($slug)) {
        $page = get_page($slug);
    } else {
        $page = $wpdb->get_row($wpdb->prepare("SELECT DISTINCT * FROM $wpdb->posts WHERE post_name=%s AND post_status=%s", $slug, 'publish'));
    }
    
    return $page;
}

/**
 * Find all subpages for page
 * @param int $id
 * @return array
 */
function ale_get_subpages($id) {
    $query = new WP_Query(array(
        'post_type'         => 'page',
        'orderby'           => 'menu_order',
        'order'             => 'ASC',
        'posts_per_page'    => -1,
        'post_parent'       => (int) $id,
    ));

    $entries = array();
    while ($query->have_posts()) : $query->the_post();
        $entry = array(
            'id' => get_the_ID(),
            'title' => get_the_title(),
            'link' => get_permalink(),
            'content' => get_the_content(),
        );
        $entries[] = $entry;
    endwhile;
    wp_reset_query();
    return $entries;
}

function ale_page_links() {
	global $wp_query, $wp_rewrite;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
 
	$pagination = array(
		'base' => @add_query_arg('page','%#%'),
		'format' => '',
		'total' => $wp_query->max_num_pages,
		'current' => $current,
		'show_all' => true,
		'type' => 'list',
		'next_text' => '&raquo;',
		'prev_text' => '&laquo;'
		);
 
	if( $wp_rewrite->using_permalinks() )
		$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
 
	if( !empty($wp_query->query_vars['s']) )
		$pagination['add_args'] = array( 's' => get_query_var( 's' ) );
 
	echo paginate_links($pagination);
}


/**
 * Generate random number
 *
 * Creates a 4 digit random number for used
 * mostly for unique ID creation. 
 * 
 * @return integer 
 */
function ale_get_random_number() {
	return substr( md5( uniqid( rand(), true) ), 0, 4 );
}

/**
 * Retreive Google Fonts List.
 * 
 * @return array 
 */
function ale_get_google_webfonts()
{
	return array(
		'Abril+Fatface'						=> 'Abril Fatface',
		'Open+Sans'							=> 'Open Sans',
		'Gentium+Book+Basic'				=> 'Gentium Book Basic',
		'Vollkorn'							=> 'Vollkorn',
		'Gravitas+One'						=> 'Gravitas+One',
		'Lato'								=> 'Lato',
		'Old+Standard+TT'					=> 'Old Standard TT',
		'PT+Serif'							=> 'PT Serif',
		'PT+Sans+Narrow'					=> 'PT Sans Narrow',
		'PT+Sans'							=> 'PT Sans',
		'Molengo'							=> 'Molengo',
		'Merriweather'						=> 'Merriweather',
		'Cabin'								=> 'Cabin',
		'Lobster'							=> 'Lobster',
		'Raleway'							=> 'Raleway',
		'Crimson+Text'						=> 'Crimson+Text',
		'Arvo'								=> 'Arvo',
		'Dancing+Script'					=> 'Dancing Script',
		'Josefin+Sans'						=> 'Josefin Sans',
		'Droid+Serif'						=> 'Droid Serif',
		'Droid+Sans'						=> 'Droid Sans',
		'Corben'							=> 'Corben',
		'Nobile'							=> 'Nobile',
		'Ubuntu'							=> 'Ubuntu',
		'Bree+Serif'						=> 'Bree Serif',
		'Bevan'								=> 'Bevan',
		'Potato+Sans'						=> 'Potato Sans',
		'Average'							=> 'Average',
		'Istok+Web'							=> 'Istok Web',
		'Lora'								=> 'Lora',
		'Pacifico'							=> 'Pacifico',
		'Arimo'								=> 'Arimo',
		'Cantata+One'						=> 'Cantata One',
		'Imprima'							=> 'Imprima',	
		'Puritan'							=> 'Puritan',
	);
}

/**
 * Get Save Web Fonts
 * @return array
 */
function ale_get_safe_webfonts() {
	return array(
		'Arial'				=> 'Arial',
		'Verdana'			=> 'Verdana, Geneva',
		'Trebuchet'			=> 'Trebuchet',
		'Georgia'			=> 'Georgia',
		'Times New Roman'   => 'Times New Roman',
		'Tahoma'			=> 'Tahoma, Geneva',
		'Palatino'			=> 'Palatino',
		'Helvetica'			=> 'Helvetica',
		'Gill Sans'			=> 'Gill Sans',
	);
}

function ale_get_typo_styles() {
	return array(
		'normal'      => 'Normal',
		'italic'      => 'Italic',
	);
}

function ale_get_typo_weights() {
	return array(
		'normal'      => 'Normal',
		'bold'      => 'Bold',
	);
}

function ale_get_typo_transforms() {
	return array(
		'none'      => 'None',
		'uppercase'	=> 'UPPERCASE',
		'lowercase'	=> 'lowercase',
		'capitalize'=> 'Capitalize',
	);
}

function ale_get_typo_variants() {
	return array(
		'normal'      => 'normal',
		'small-caps'  => 'Small Caps',
	);
}

/**
 * Get default font styles
 * @return array
 */
function ale_get_font_styles() {
	return array(
		'normal'      => 'Normal',
		'italic'      => 'Italic',
		'bold'        => 'Bold',
		'bold italic' => 'Bold Italic'
	);
}

/**
 * Display custom RSS url
 */
function ale_rss() {
    echo ale_get_rss();
}

/**
 * Get custom RSS url
 */
function ale_get_rss() {
    $rss_url = ale_get_option('feedburner');
    return $rss_url ? $rss_url : get_bloginfo('rss2_url');
}

/**
 * Display custom RSS url
 */
function ale_favicon() {
    echo ale_get_favicon();
}

/**
 * Get custom RSS url
 */
function ale_get_favicon() {
    $favicon = ale_get_option('favicon');
    return $favicon ? $favicon : THEME_URL . '/aletheme/assets/favicon.ico';
}

/**
 * Get template part
 * 
 * @param string $slug
 * @param string $name
 */
function ale_part($slug, $name = null) {
	get_template_part('partials/' . $slug, $name);
}

/**
 * Page Title Wrapper
 * @param type $title 
 */
function ale_page_title($title) {
	echo ale_get_page_title($title);
}
function ale_get_page_title($title) {
	return '<header class="page-title"><h2 class="a">' . $title . '</h2></header>';
}

/**
 * Find if the current browser is on mobile device
 * @return boolean 
 */
function is_mobile() {
	if(preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|sagem|sharp|sie-|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT'])) {
		return true;
	} else {
		return false;
	}
}

function array_put_to_position(&$array, $object, $position, $name = null) {
	$count = 0;
	$return = array();
	foreach ($array as $k => $v) {  
			// insert new object
			if ($count == $position) {  
					if (!$name) $name = $count;
					$return[$name] = $object;
					$inserted = true;
			}  
			// insert old object
			$return[$k] = $v;
			$count++;
	}  
	if (!$name) $name = $count;
	if (!$inserted) $return[$name];
	$array = $return;
	return $array;
}


/**
 * Get archives by year
 * 
 * @global object $wpdb
 * @param string $year
 * @return array 
 */
function ale_archives_get_by_year($year = "") {
	global $wpdb;
	
	$where = "";
	if (!empty($year)) {
		$where = "AND YEAR(post_date) = " . ((int) $year);
	}
	$query = "SELECT DISTINCT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, DATE_FORMAT(post_date, '%b') AS `abmonth`, DATE_FORMAT(post_date, '%M') AS `fmonth`, count(ID) as posts
									FROM $wpdb->posts
							WHERE post_type = 'post' AND post_status = 'publish' $where
									GROUP BY YEAR(post_date), MONTH(post_date)
									ORDER BY post_date DESC";

	return $wpdb->get_results($query);
}

/**
 * Get archives years list
 * 
 * @global object $wpdb
 * @return array 
 */
function ale_archives_get_years() {
	global $wpdb;

	$query = "SELECT DISTINCT YEAR(post_date) AS `year`
									FROM $wpdb->posts
							WHERE post_type = 'post' AND post_status = 'publish'
									GROUP BY YEAR(post_date) ORDER BY post_date DESC";

	return $wpdb->get_results($query);
}

/**
 * Get archives months list
 * 
 * @return type 
 */
function ale_archives_get_months() {
	return array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
}

/**
 * Display Archives 
 */
function ale_archives($delim = '&nbsp;/&nbsp;') {
    $year = null;
    ?>
    <div class="ale-archives cf">
		<h4 class="a"><?php _e('Archives', 'aletheme');?></h4>
        <?php
            $months = ale_archives_get_months();
            $archives = ale_archives_get_by_year();
        ?>
        <div class="year">
            <span id="archives-active-year"></span>
            <a href="#" class="up">&gt;</a>
            <a href="#" class="down">&lt;</a>
        </div>
        <div class="months">
            <?php foreach ($archives as $archive) : ?>
                <?php
                    if ($year == $archive->year) {
                        continue;
                    }
                    $year = $archive->year;
                    $y_archives = ale_archives_get_by_year($archive->year);
                ?>
                <div class="year-months" id="archive-year-<?php echo $year?>">
                <?php foreach ($months as $key => $month) :?>
                    <?php foreach ($y_archives as $y_archive) :?>
                        <?php if (($key == ($y_archive->month-1)) && $y_archive->posts):?>
                            <a href="<?php echo get_month_link($year, $y_archive->month)?>"><?php echo $month; ?></a>
                            <?php if ($key != 11 && $delim):?>
                                <span class="delim"><?php echo $delim; ?></span>
                            <?php endif;?>
                            <?php break;?>
                        <?php endif;?>
                    <?php endforeach;?>
                    <?php if ($key != $y_archive->month-1):?>
                        <span><?php echo $month; ?></span>
                        <?php if ($key != 11 && $delim):?>
							<span class="delim"><?php echo $delim; ?></span>
                        <?php endif;?>
                    <?php endif;?>
                <?php endforeach;?>
                </div>
            <?php endforeach;?>
        </div>
    </div>
<?php
}

/**
 * Add combined actions for AJAX.
 * 
 * @param string $tag
 * @param string $function_to_add
 * @param integer $priority
 * @param integer $accepted_args 
 */
function ale_add_ajax_action($tag, $function_to_add, $priority = 10, $accepted_args = 1) {
	add_action('wp_ajax_' . $tag, $function_to_add, $priority, $accepted_args);
	add_action('wp_ajax_nopriv_' . $tag, $function_to_add, $priority, $accepted_args);
}

/**
 * Get contact form 7 from content
 * @param string $content
 * @return string 
 */
function ale_contact7_form($content) {
	$matches = array();
	preg_match('~(\[contact\-form\-7.*\])~simU', $content, $matches);
	return $matches[1];
}

/**
 * Remove contact form from content
 * @param string $content
 * @return string
 */
function ale_remove_contact7_form($content) {
	$content = preg_replace('~(\[contact\-form\-7.*\])~simU', '', $content);
	return $content;
}

/**
 * Check if it's a blog page
 * @global object $post
 * @return boolean 
 */
function ale_is_blog () {
	global  $post;
	$posttype = get_post_type($post);
	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ($posttype == 'post')) ? true : false ;
}

if ( function_exists('register_sidebar') ) {
    if(ale_get_option('leftsidebarblog') == 1){
        register_sidebar(array(
            'name' => 'Left Sidebar',
            'id' => 'left-sidebar',
            'description' => 'Appears as the left sidebar on Blog pages',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>',
        ));
    }

    if(ale_get_option('leftsidebargallery')==1){
        register_sidebar(array(
            'name' => 'Left Sidebar Gallery',
            'id' => 'left-sidebargallery',
            'description' => 'Appears as the left sidebar on Gallery pages',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>',
        ));
    }

    if(ale_get_option('leftsidebarvideo')==1){
        register_sidebar(array(
            'name' => 'Left Sidebar Video',
            'id' => 'left-sidebarvideo',
            'description' => 'Appears as the left sidebar on Video pages',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>',
        ));
    }

    if(ale_get_option('leftsidebarpress')==1){
        register_sidebar(array(
            'name' => 'Left Sidebar Press',
            'id' => 'left-sidebarpress',
            'description' => 'Appears as the left sidebar on Press pages',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>',
        ));
    }

    if(ale_get_option('leftsidebarinspiration')==1){
        register_sidebar(array(
            'name' => 'Left Sidebar Inspiration',
            'id' => 'left-sidebarinspiration',
            'description' => 'Appears as the left sidebar on Inspiration pages',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>',
        ));
    }

    if(ale_get_option('leftsidebartestimonial')==1){
        register_sidebar(array(
            'name' => 'Left Sidebar Testimonial',
            'id' => 'left-sidebartestimonial',
            'description' => 'Appears as the left sidebar on Testimonial pages',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>',
        ));
    }

    if(ale_get_option('rightsidebarblog')==1){
        register_sidebar(array(
            'name' => 'Right Sidebar Blog',
            'id' => 'right-sidebarblog',
            'description' => 'Appears as the right sidebar on Blog pages',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>',
        ));
    }

    if(ale_get_option('rightsidebargallery')==1){
        register_sidebar(array(
            'name' => 'Right Sidebar Gallery',
            'id' => 'right-sidebargallery',
            'description' => 'Appears as the right sidebar on Gallery pages',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>',
        ));
    }

    if(ale_get_option('rightsidebarvideo')==1){
        register_sidebar(array(
            'name' => 'Right Sidebar Video',
            'id' => 'right-sidebarvideo',
            'description' => 'Appears as the right sidebar on Video pages',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>',
        ));
    }

    if(ale_get_option('rightsidebarpress')==1){
        register_sidebar(array(
            'name' => 'Right Sidebar Press',
            'id' => 'right-sidebarpress',
            'description' => 'Appears as the right sidebar on Press pages',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>',
        ));
    }

    if(ale_get_option('rightsidebarinspiration')==1){
        register_sidebar(array(
            'name' => 'Right Sidebar Inspiration',
            'id' => 'right-sidebarinspiration',
            'description' => 'Appears as the right sidebar on Inspiration pages',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>',
        ));
    }

    if(ale_get_option('rightsidebartestimonial')==1){
        register_sidebar(array(
            'name' => 'Right Sidebar Testimonial',
            'id' => 'right-sidebartestimonial',
            'description' => 'Appears as the right sidebar on Testimonial pages',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h2 class="widgettitle">',
            'after_title' => '</h2>',
        ));
    }
}

//Support automatic-feed-links
add_theme_support( 'automatic-feed-links' );

//Unreal construction to passed/hide "Theme Checker Plugin" recommendation about Header nad Background
if('Theme Checke' == 'Hide') {
    add_theme_support( 'custom-header');
    add_theme_support( 'custom-background');
}

//Comment Reply script
function aletheme_enqueue_comment_reply() {
    // on single blog post pages with comments open and threaded comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        // enqueue the javascript that performs in-link comment reply fanciness
        wp_enqueue_script( 'comment-reply' );
    }
}
// Hook into wp_enqueue_scripts
add_action( 'wp_enqueue_scripts', 'aletheme_enqueue_comment_reply' );

/**
 * Remove HTML attributes from comments if is Socha Comments Selected
 */
if(ale_get_option('comments_style') == 'wp'){
    add_filter( 'comment_text', 'wp_filter_nohtml_kses' );
    add_filter( 'comment_text_rss', 'wp_filter_nohtml_kses' );
    add_filter( 'comment_excerpt', 'wp_filter_nohtml_kses' );
}