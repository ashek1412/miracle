<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;


/**
 * Setup My Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function docly_child_theme_setup() {
    load_child_theme_textdomain( 'docly-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'docly_child_theme_setup' );


// BEGIN ENQUEUE PARENT ACTION
if ( !function_exists( 'docly_child_thm_parent_css' ) ):
    function docly_child_thm_parent_css() {
        wp_enqueue_style (
            'docly-child-parent-root',
            trailingslashit ( get_template_directory_uri() ) . 'style.css'
        );
    }
endif;
add_action( 'wp_enqueue_scripts', 'docly_child_thm_parent_css', 10 );

// END ENQUEUE PARENT ACTION



/**
 * This snippet adds metadata of &quot;employee&quot; post to search index
 */ 
add_filter('wpfts_index_post', function($index, $post)
{ 
    global $wpdb, $wpfts_core;

    // Basic tokens 
    /* 
     * This piece of code was commented out intentionally to display things
     * which was already done before in the caller code
    $index['post_title'] = $post->post_title;
    $index['post_content'] = strip_tags($post->post_content);
    */
    if ($post->post_type == 'post' || $post->post_type == 'page' ) {

        $data = array();
        //Single and simple ACF fields

        //Protection Plan
        $data[] = get_post_meta($post->ID, 'protection_plan_title', true);
        $data[] = get_post_meta($post->ID, 'newsletter_library_title', true);

        //Marketing :: Page
        $data[] = get_post_meta($post->ID, 'current_code_title', true);
        $data[] = get_post_meta($post->ID, 'ad_creative_templates_title', true);
        $data[] = get_post_meta($post->ID, 'order_title', true);
        $data[] = get_post_meta($post->ID, 'drop_date_title', true);
        $data[] = get_post_meta($post->ID, 'mailer_creative_templates_title', true);

        //Resorces :: PPC Page
        //Resorces :: Consultant Page
        $data[] = get_post_meta($post->ID, 'block_title_1', true);
        $data[] = get_post_meta($post->ID, 'block_title_2', true);
        $data[] = get_post_meta($post->ID, 'block_title_3', true);
        $data[] = get_post_meta($post->ID, 'block_title_4', true);
        $data[] = get_post_meta($post->ID, 'block_title_5', true);
        $data[] = get_post_meta($post->ID, 'block_title_6', true);
        $data[] = get_post_meta($post->ID, 'block_title_7', true);
        $data[] = get_post_meta($post->ID, 'block_title_8', true);
        $data[] = get_post_meta($post->ID, 'block_title_9', true);
        $data[] = get_post_meta($post->ID, 'block_title_10', true);
        $data[] = get_post_meta($post->ID, 'block_title_11', true);
        $data[] = get_post_meta($post->ID, 'block_title_12', true);

        //Resorces :: Consultant Page
        $data[] = get_post_meta($post->ID, 'block_title_1', true);
        $data[] = get_post_meta($post->ID, 'block_title_2', true);
        $data[] = get_post_meta($post->ID, 'block_title_2', true);

        //Store Information :: Home  Office
        $data[] = get_post_meta($post->ID, 'store_directory_title', true);
        $data[] = get_post_meta($post->ID, 'store_directory_address', true);

        //Resorces :: MEMSI Page
        $data[] = get_post_meta($post->ID, 'forms_title', true);
        $data[] = get_post_meta($post->ID, 'contact_information_title', true);

        //Record Book :: Page
        $data[] = get_post_meta($post->ID, 'title_1', true);
        $data[] = get_post_meta($post->ID, 'title_2', true);
        $data[] = get_post_meta($post->ID, 'title_3', true);
        $data[] = get_post_meta($post->ID, 'title_4', true);

        // $data[] = get_post_meta($post->ID, 'address', true);
        // $data[] = get_post_meta($post->ID, 'phone', true); 
        // $data[] = get_post_meta($post->ID, 'name', true);
        // $data[] = get_post_meta($post->ID, 'file', true);
        // $data[] = get_post_meta($post->ID, 'function', true);
        // $data[] = get_post_meta($post->ID, 'pdf', true);
        // $data[] = get_post_meta($post->ID, 'documents', true);
        // $data[] = get_post_meta($post->ID, 'file', true);


        $index['miracle_data'] = implode(' ', $data);

        //Repeater Fields with files
        $pdfs = array();

        //Protection plan repeater 1
        if( have_rows('plan_document_list',$post->ID) ) :                                    
            while( have_rows('plan_document_list',$post->ID) ): the_row();

                $pdfs[] = get_sub_field('name', $post->ID);

                $url = get_sub_field('pdf', $post->ID);
                if (strlen($url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }
            endwhile;
        endif;

        //Protection plan repeater 2
        if( have_rows('plan_newsletter_list',$post->ID) ) :                                    
            while( have_rows('plan_newsletter_list',$post->ID) ): the_row();

                $pdfs[] = get_sub_field('year_of_news_letter', $post->ID);
                
                if( have_rows('newsletter_documents_list',$post->ID) ) :                                    
                    while( have_rows('newsletter_documents_list',$post->ID) ): the_row();

                        $pdfs[] = get_sub_field('month', $post->ID);
                        
                        $url = get_sub_field('pdf', $post->ID);
                        if (strlen($url) > 0) {
                            require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                            $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);

                            $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                        }
                    endwhile;
                endif;
            endwhile;
        endif;

        //Marketing :: Page Repeater 1
        if( have_rows('current_code_list',$post->ID) ) :                                    
            while( have_rows('current_code_list',$post->ID) ): the_row();

                $pdfs[] = get_sub_field('name', $post->ID);
                $pdfs[] = get_sub_field('value', $post->ID);

            endwhile;
        endif;

        //Marketing :: Page Repeater 2
        if( have_rows('ad_creative_templates_list',$post->ID) ) :                                    
            while( have_rows('ad_creative_templates_list',$post->ID) ): the_row();

                $pdfs[] = get_sub_field('name', $post->ID);

                $url = get_sub_field('pdf', $post->ID);
                if (strlen($url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }
            endwhile;
        endif;

        //Marketing :: Page Order List Repeater 3 2021 
        if( have_rows('order_list_2021',$post->ID) ) :                                    
            while( have_rows('order_list_2021',$post->ID) ): the_row();

                $pdfs[] = get_sub_field('month', $post->ID);
                
                $url = get_sub_field('pdf', $post->ID);
                if (strlen($url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }
            endwhile;
        endif;

        //Marketing :: Page Order List Repeater 3 2020 
        if( have_rows('order_list_2020',$post->ID) ) :                                    
            while( have_rows('order_list_2020',$post->ID) ): the_row();

                $pdfs[] = get_sub_field('month', $post->ID);
                
                $url = get_sub_field('pdf', $post->ID);
                if (strlen($url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }
            endwhile;
        endif;

        //Marketing :: Page Order List Repeater 3 2019 
        if( have_rows('order_list_2019',$post->ID) ) :                                    
            while( have_rows('order_list_2019',$post->ID) ): the_row();

                $pdfs[] = get_sub_field('month', $post->ID);
                
                $url = get_sub_field('pdf', $post->ID);
                if (strlen($url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }
            endwhile;
        endif;

        //Marketing :: Page Order List Repeater 3 2018 
        if( have_rows('order_list_2018',$post->ID) ) :                                    
            while( have_rows('order_list_2018',$post->ID) ): the_row();

                $pdfs[] = get_sub_field('month', $post->ID);
                
                $url = get_sub_field('pdf', $post->ID);
                if (strlen($url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }
            endwhile;
        endif;

        //Marketing :: Page Order List Repeater 3 2017 
        if( have_rows('order_list_2017',$post->ID) ) :                                    
            while( have_rows('order_list_2017',$post->ID) ): the_row();

                $pdfs[] = get_sub_field('month', $post->ID);
                
                $url = get_sub_field('pdf', $post->ID);
                if (strlen($url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }
            endwhile;
        endif;

        //Marketing :: Page 4 Drop Date
        if( have_rows('drop_date_list',$post->ID) ) :                                    
            while( have_rows('drop_date_list',$post->ID) ): the_row();

                $pdfs[] = get_sub_field('name', $post->ID);
                $pdfs[] = get_sub_field('value', $post->ID);

            endwhile;
        endif;

        //Marketing :: Page 5 Mailer Creative Templates
        if( have_rows('creative_template_list',$post->ID) ) :                                    
            while( have_rows('creative_template_list',$post->ID) ): the_row();

                $pdfs[] = get_sub_field('name', $post->ID);
                
                $url = get_sub_field('pdf', $post->ID);
                if (strlen($url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }
            endwhile;
        endif;

        //Resorces :: PPC Page >> 1 : Scripts
        if( have_rows('documents_list_1',$post->ID) ) :                                    
            while( have_rows('documents_list_1',$post->ID) ): the_row();

                $pdfs[] = get_sub_field('name', $post->ID);
                
                $url = get_sub_field('pdf', $post->ID);
                if (strlen($url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }
                
                $doc_url = get_sub_field('document', $post->ID);
                if (strlen($doc_url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($doc_url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }
            endwhile;
        endif;

        //Resorces :: PPC Page >> 2 : Miracle Ear Foundation
        if( have_rows('documents_list_2',$post->ID) ) :                                    
            while( have_rows('documents_list_2',$post->ID) ): the_row();

                $pdfs[] = get_sub_field('name', $post->ID);
                
                $url = get_sub_field('pdf', $post->ID);
                if (strlen($url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }

                $doc_url = get_sub_field('document', $post->ID);
                if (strlen($doc_url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($doc_url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }
            endwhile;
        endif;

        //Resorces :: PPC Page >> 3 : HIPAA
        if( have_rows('documents_list_3',$post->ID) ) :                                    
            while( have_rows('documents_list_3',$post->ID) ): the_row();

                $pdfs[] = get_sub_field('name', $post->ID);
                
                $url = get_sub_field('pdf', $post->ID);
                if (strlen($url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }

                $doc_url = get_sub_field('document', $post->ID);
                if (strlen($doc_url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($doc_url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }

            endwhile;
        endif;

        //Resorces :: PPC Page >> 4 : Insurance
        if( have_rows('documents_list_4',$post->ID) ) :                                    
            while( have_rows('documents_list_4',$post->ID) ): the_row();

                $pdfs[] = get_sub_field('name', $post->ID);
                
                $url = get_sub_field('pdf', $post->ID);
                if (strlen($url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }

                $doc_url = get_sub_field('document', $post->ID);
                if (strlen($doc_url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($doc_url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }

            endwhile;
        endif;

        //Resorces :: PPC Page >> 5 : Financing
        if( have_rows('documents_list_5',$post->ID) ) :                                    
            while( have_rows('documents_list_5',$post->ID) ): the_row();

                $pdfs[] = get_sub_field('name', $post->ID);
                
                $url = get_sub_field('pdf', $post->ID);
                if (strlen($url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }

                $doc_url = get_sub_field('document', $post->ID);
                if (strlen($doc_url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($doc_url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }

            endwhile;
        endif;

        //Resorces :: PPC Page >> 6 : Patient Information
        if( have_rows('documents_list_6',$post->ID) ) :                                    
            while( have_rows('documents_list_6',$post->ID) ): the_row();

                $pdfs[] = get_sub_field('name', $post->ID);
                
                $url = get_sub_field('pdf', $post->ID);
                if (strlen($url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }

                $doc_url = get_sub_field('document', $post->ID);
                if (strlen($doc_url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($doc_url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }

            endwhile;
        endif;

        //Resorces :: PPC Page >> 7 : Quick Links
        if( have_rows('documents_list_7',$post->ID) ) :                                    
            while( have_rows('documents_list_7',$post->ID) ): the_row();
                $pdfs[] = get_sub_field('name', $post->ID);
                $pdfs[] = get_sub_field('link', $post->ID);
                
                $doc_url = get_sub_field('document', $post->ID);
                if (strlen($doc_url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($doc_url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }

            endwhile;
        endif;

        //Resorces :: PPC Page >> 8 : Loss and Damage/Replacement Claim Forms
        // L&D Forms-Idaho
        if( have_rows('documents_list_8_1',$post->ID) ) :                                    
            while( have_rows('documents_list_8_1',$post->ID) ): the_row();
                $pdfs[] = get_sub_field('name', $post->ID);

                $url = get_sub_field('pdf', $post->ID);
                if (strlen($url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';
                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);
                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }

            endwhile;
        endif;

        // L&D Forms-Washington
        if( have_rows('documents_list_8_2',$post->ID) ) :                                    
            while( have_rows('documents_list_8_2',$post->ID) ): the_row();
                $pdfs[] = get_sub_field('name', $post->ID);

                $url = get_sub_field('pdf', $post->ID);
                if (strlen($url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';
                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);
                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }

            endwhile;
        endif;

        // L&D Forms-Seattle
        if( have_rows('documents_list_8_3',$post->ID) ) :                                    
            while( have_rows('documents_list_8_3',$post->ID) ): the_row();
                $pdfs[] = get_sub_field('name', $post->ID);

                $url = get_sub_field('pdf', $post->ID);
                if (strlen($url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';
                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);
                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }

            endwhile;
        endif;

        // L&D Forms-Oregon
        if( have_rows('documents_list_8_4',$post->ID) ) :                                    
            while( have_rows('documents_list_8_4',$post->ID) ): the_row();
                $pdfs[] = get_sub_field('name', $post->ID);

                $url = get_sub_field('pdf', $post->ID);
                if (strlen($url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';
                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);
                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }

            endwhile;
        endif;

        // L&D Forms-California
        if( have_rows('documents_list_8_5',$post->ID) ) :                                    
            while( have_rows('documents_list_8_5',$post->ID) ): the_row();
                $pdfs[] = get_sub_field('name', $post->ID);

                $url = get_sub_field('pdf', $post->ID);
                if (strlen($url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';
                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);
                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }

            endwhile;
        endif;

        // L&D Forms-Hawaii
        if( have_rows('documents_list_8_6',$post->ID) ) :                                    
            while( have_rows('documents_list_8_6',$post->ID) ): the_row();
                $pdfs[] = get_sub_field('name', $post->ID);

                $url = get_sub_field('pdf', $post->ID);
                if (strlen($url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';
                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);
                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }

            endwhile;
        endif;

        //Resorces :: PPC Page >> 9 : New Patient Documents
        if( have_rows('documents_list_9',$post->ID) ) :                                    
            while( have_rows('documents_list_9',$post->ID) ): the_row();
                $pdfs[] = get_sub_field('name', $post->ID);

                $url = get_sub_field('pdf', $post->ID);
                if (strlen($url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';
                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);
                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }

                $doc_url = get_sub_field('document', $post->ID);
                if (strlen($doc_url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($doc_url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }

            endwhile;
        endif;

        //Resorces :: PPC Page >> 10 : Sycle.net Workbooks and Activity Guide
        if( have_rows('documents_list_10',$post->ID) ) :                                    
            while( have_rows('documents_list_10',$post->ID) ): the_row();
                $pdfs[] = get_sub_field('name', $post->ID);

                $url = get_sub_field('pdf', $post->ID);
                if (strlen($url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';
                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);
                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }

                $doc_url = get_sub_field('document', $post->ID);
                if (strlen($doc_url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($doc_url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }

            endwhile;
        endif;

        //Resorces :: PPC Page >> 11 : NPS
        if( have_rows('documents_list_11',$post->ID) ) :                                    
            while( have_rows('documents_list_11',$post->ID) ): the_row();
                $pdfs[] = get_sub_field('name', $post->ID);

                $url = get_sub_field('pdf', $post->ID);
                if (strlen($url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';
                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);
                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }

            endwhile;
        endif;

        //Resorces :: PPC Page >> 12 : Yodel
        if( have_rows('documents_list_12',$post->ID) ) :                                    
            while( have_rows('documents_list_12',$post->ID) ): the_row();
                $pdfs[] = get_sub_field('name', $post->ID);

                $url = get_sub_field('document', $post->ID);
                if (strlen($url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';
                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);
                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }

            endwhile;
        endif;

        //Resorces :: Consultant Page :: 10 :: Insurance
        if( have_rows('documents_list_8',$post->ID) ) :                                    
            while( have_rows('documents_list_8',$post->ID) ): the_row();
                $pdfs[] = get_sub_field('name', $post->ID);

                $doc_url = get_sub_field('document', $post->ID);
                if (strlen($doc_url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($doc_url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }

            endwhile;
        endif;

        //Store Information :: Home  Office
        if( have_rows('store_directory_list',$post->ID) ) :                                    
            while( have_rows('store_directory_list',$post->ID) ): the_row();
                $pdfs[] = get_sub_field('office', $post->ID);
                $pdfs[] = get_sub_field('hours', $post->ID);
                $pdfs[] = get_sub_field('employee', $post->ID);
                $pdfs[] = get_sub_field('phone_', $post->ID);
                $pdfs[] = get_sub_field('address', $post->ID);
                $pdfs[] = get_sub_field('employee_name', $post->ID);
                $pdfs[] = get_sub_field('email', $post->ID);
                $pdfs[] = get_sub_field('ext', $post->ID);
                $pdfs[] = get_sub_field('position', $post->ID);
                $pdfs[] = get_sub_field('help_with_specific_issues', $post->ID);
            endwhile;
        endif;

        //Store Information :: Home  Office
        if( have_rows('form_document_list',$post->ID) ) :                                    
            while( have_rows('form_document_list',$post->ID) ): the_row();
                $pdfs[] = get_sub_field('name', $post->ID);

                $doc_url = get_sub_field('pdf_document', $post->ID);
                if (strlen($doc_url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($doc_url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }

            endwhile;
        endif;

        if( have_rows('contact_document_list',$post->ID) ) :                                    
            while( have_rows('contact_document_list',$post->ID) ): the_row();
                $pdfs[] = get_sub_field('name', $post->ID);

                $doc_url = get_sub_field('pdf_document', $post->ID);
                if (strlen($doc_url) > 0) {
                    require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

                    $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($doc_url, true);

                    $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
                }
                
            endwhile;
        endif;

        // Record Book :: Page >> Best Months :: 1
        if( have_rows('month_data',$post->ID) ) :                                    
            while( have_rows('month_data',$post->ID) ): the_row();
                $pdfs[] = get_sub_field('rank', $post->ID);
                $pdfs[] = get_sub_field('amount', $post->ID);
                $pdfs[] = get_sub_field('store_name', $post->ID);
                $pdfs[] = get_sub_field('month-year', $post->ID);
                $pdfs[] = get_sub_field('employee', $post->ID);
            endwhile;
        endif;

        // Record Book :: Page >> Best Year :: 2
        if( have_rows('year_data',$post->ID) ) :                                    
            while( have_rows('year_data',$post->ID) ): the_row();
                $pdfs[] = get_sub_field('rank', $post->ID);
                $pdfs[] = get_sub_field('amount', $post->ID);
                $pdfs[] = get_sub_field('year', $post->ID);
                $pdfs[] = get_sub_field('employee', $post->ID);
                $pdfs[] = get_sub_field('store_name', $post->ID);
            endwhile;
        endif;

        // Record Book :: Page >> Best Consultants :: 3
        if( have_rows('consultants_data',$post->ID) ) :                                    
            while( have_rows('consultants_data',$post->ID) ): the_row();
                $pdfs[] = get_sub_field('year', $post->ID);
                $pdfs[] = get_sub_field('rank', $post->ID);
                $pdfs[] = get_sub_field('amount', $post->ID);
                $pdfs[] = get_sub_field('employee', $post->ID);
            endwhile;
        endif;

        // Record Book :: Page >> consultants_data
        if( have_rows('open_house_events_data',$post->ID) ) :                                    
            while( have_rows('open_house_events_data',$post->ID) ): the_row();
                $pdfs[] = get_sub_field('rank', $post->ID);
                $pdfs[] = get_sub_field('store_name', $post->ID);
                $pdfs[] = get_sub_field('employee', $post->ID);
                $pdfs[] = get_sub_field('month-year', $post->ID);
                $pdfs[] = get_sub_field('amount', $post->ID);
            endwhile;
        endif;

        // //Repeater Fields with files
        // if( have_rows('documents',$post->ID) ) :                                    
        //     while( have_rows('documents',$post->ID) ): the_row();

        //         $pdfs[] = get_sub_field('name', $post->ID);

        //         $url = get_sub_field('file', $post->ID);
        //         if (strlen($url) > 0) {
        //             require_once $wpfts_core->root_dir.'/includes/wpfts_utils.class.php';

        //             $ret = WPFTS_Utils::GetCachedFileContent_ByLocalLink($url, true);

        //             $pdfs[] = isset($ret['post_content']) ? trim($ret['post_content']) : '';
        //         }
        //     endwhile;
        // endif;


        if (count($pdfs) > 0) {
            $index['pdfs'] = implode(' ', $pdfs);
        }

    } 
    return $index; 
}, 3, 2);