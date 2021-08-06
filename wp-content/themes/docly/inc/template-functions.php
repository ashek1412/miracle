<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package docly
 */

// Search form
function docly_search_form($is_button=true) {
    ?>
    <div class="docly-search">
        <form class="form-wrapper" action="<?php echo esc_url(home_url( '/')); ?>" _lpchecked="1">
            <input type="text" id="search" placeholder="<?php esc_attr_e( 'Search ...', 'docly' ); ?>" name="s">
            <button type="submit" class="btn"><i class="fa fa-search"></i></button>
        </form>
        <?php if ( $is_button==true) { ?>
        <a href="<?php echo esc_url(home_url( '/')); ?>" class="home_btn"> <?php esc_html_e( 'Back to home Page', 'docly' ); ?> </a>
        <?php } ?>
    </div>
    <?php
}

// Get comment count text
function docly_comment_count( $post_id ) {
    $comments_number = get_comments_number($post_id);
    if ( $comments_number == 0) {
        $comment_text = esc_html__( 'No Comments', 'docly' );
    } elseif( $comments_number == 1) {
        $comment_text = esc_html__( '1 Comment', 'docly' );
    } elseif( $comments_number > 1) {
        $comment_text = $comments_number.esc_html__( ' Comments', 'docly' );
    }
    echo esc_html($comment_text);
}

// Get author role
function docly_get_author_role() {
    global $authordata;
    $author_roles = $authordata->roles;
    $author_role = array_shift($author_roles);
    return esc_html($author_role);
}

// Banner Subtitle
function docly_banner_subtitle() {
    $opt = get_option( 'docly_opt' );
    if (is_home() ) {
        $blog_subtitle = !empty($opt['blog_subtitle']) ? $opt['blog_subtitle'] : get_bloginfo( 'description' );
        echo esc_html($blog_subtitle);
    }
    elseif (is_page() || is_single() ) {
        if (has_excerpt() ) {
            while (have_posts() ) {
                the_post();
                echo nl2br(get_the_excerpt(get_the_ID() ));
            }
        }
    }
    elseif ( is_archive() ) {
        echo '';
    }
}

/**
 * Get a specific html tag from content
 * @return a specific HTML tag from the loaded content
 */
function docly_get_html_tag( $tag = 'blockquote', $content = '' ) {
    $dom = new DOMDocument();
    $dom->loadHTML($content);
    $divs = $dom->getElementsByTagName( $tag );
    $i = 0;
    foreach ( $divs as $div ) {
        if ( $i == 1 ) {
            break;
        }
        echo "<h4 class='c_head'>{$div->nodeValue}</h4>";
        ++$i;
    }
}

// Get the page id by page template
function docly_get_page_template_id( $template = 'page-job-apply-form.php' ) {
    $pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => $template
    ));
    foreach ( $pages as $page ) {
        $page_id = $page->ID;
    }
    return $page_id;
}

// Arrow icon left right position
function docly_arrow_left_right() {
    $arrow_icon = is_rtl() ? 'arrow_left' : 'arrow_right';
    echo esc_attr($arrow_icon);
}

/**
 * Decode Saasland
 */
function docly_decode_du( $str ) {
	$str = str_replace('cZ5^9o#!', 'wordpress-theme.spider-themes.net', $str);
	$str = str_replace('aI7!8B4H', 'resources', $str);
	$str = str_replace('^93|3d@', 'https', $str);
	$str = str_replace('t7Cg*^n0', 'docly', $str);
	$str = str_replace('3O7%jfGc', '.zip', $str);
	return urldecode($str);
}