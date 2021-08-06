<?php
/**
 * Template Name: Resources MEMSI Page
 */

get_header();

$opt = get_option('docly_opt');
$padding = "";

$is_forum_btm_c2a = isset($opt['is_forum_btm_c2a']) ? $opt['is_forum_btm_c2a'] : '1';
$wrap_class = 'page_wrapper';
if (class_exists('bbPress'))
{
    $wrap_class .= is_post_type_archive('forum') || is_post_type_archive('topic') || is_singular('forum') ? ' forum-page-content' : '';
}

while (have_posts()):
    the_post();
    ?>
    <div class="sec_pad <?php echo esc_attr($wrap_class) ?>">
        <div class="container">
            <?php
                the_content();
                wp_link_pages(array(
                    'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'docly') . '</span>',
                    'after' => '</div>',
                    'link_before' => '<span>',
                    'link_after' => '</span>',
                    'pagelink' => '<span class="screen-reader-text">' . esc_html__('Page', 'docly') . ' </span>%',
                    'separator' => '<span class="screen-reader-text">, </span>',
                ));
                ?>
                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()):
                    comments_template();
                endif;
            ?> 
                           
            <!-- Resource Modal 1 -->
            <div class="modal fade" id="resorceCodeModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <div class="document-section">
                                <?php 
                                $forms_title = get_field( "forms_title", get_the_ID());
                                if ($forms_title) {
                                    $title_1 = $forms_title; 
                                } else {
                                    $title_1 = "Forms";
                                }
                                ?>
                                <h4 class="c_head"><?php echo $title_1 ?></h4> 
                                <div class="document-list">
                                    <ul class="list-unstyled article_list tag_list">
                                        <?php
                                        if( have_rows('form_document_list',get_the_ID()) ) :                                    
                                          while( have_rows('form_document_list',get_the_ID()) ): the_row();
                                            $name = get_sub_field('name', get_the_ID());
                                            $pdf_document = get_sub_field('pdf_document', get_the_ID());
                                            ?>
                                            <li class="page_item page-item-2746 wd-state-closed">
                                                <a href="<?php echo $pdf_document ?>" target="_blank"><?php echo $name ?></a>
                                            </li>
                                              <?php                                   
                                          endwhile;
                                        endif;
                                      ?>
                                    </ul>  
                                </div>                        
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

            <!-- Resource Modal 2 -->
            <div class="modal fade" id="resorceCodeModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <div class="document-section">
                                <?php 
                                $contact_information_title = get_field( "contact_information_title", get_the_ID());
                                if ($contact_information_title) {
                                    $title_2 = $contact_information_title; 
                                } else {
                                    $title_2 = "Contact Information";
                                }
                                ?>
                                <h4 class="c_head"><?php echo $title_2 ?></h4> 
                                <div class="document-list">
                                    <ul class="list-unstyled article_list tag_list">
                                        <?php
                                        if( have_rows('contact_document_list',get_the_ID()) ) :                                    
                                          while( have_rows('contact_document_list',get_the_ID()) ): the_row();
                                            $name = get_sub_field('name', get_the_ID());
                                            $document_pdf = get_sub_field('document_pdf', get_the_ID());
                                            ?>
                                            <li class="page_item page-item-2746 wd-state-closed">
                                                <a href="<?php echo $document_pdf ?>" target="_blank"><?php echo $name ?></a>
                                            </li>
                                              <?php                                   
                                          endwhile;
                                        endif;
                                      ?>
                                    </ul>  
                                </div>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resource Modal 3 -->
            <div class="modal fade" id="resorceCodeModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <div class="document-section">
                                <h4 class="c_head">HIPAA</h4>
                                <div class="document-list">
                                    <ul class="list-unstyled article_list tag_list">
                                        <li class="page_item page-item-2746 wd-state-closed">
                                            <a href="aaaaaaa" target="_blank">Name</a>
                                        </li>
                                        <li class="page_item page-item-2746 wd-state-closed">
                                            <a href="aaaaaaa" target="_blank">Name</a>
                                        </li>
                                        <li class="page_item page-item-2746 wd-state-closed">
                                            <a href="aaaaaaa" target="_blank">Name</a>
                                        </li>
                                        <li class="page_item page-item-2746 wd-state-closed">
                                            <a href="aaaaaaa" target="_blank">Name</a>
                                        </li>
                                        <li class="page_item page-item-2746 wd-state-closed">
                                            <a href="aaaaaaa" target="_blank">Name</a>
                                        </li>
                                        <li class="page_item page-item-2746 wd-state-closed">
                                            <a href="aaaaaaa" target="_blank">Name</a>
                                        </li>
                                    </ul>  
                                </div>                         
                            </div>
                        </div>
                    </div>
                </div>
            </div>  

            <!-- Resource Modal 4 -->
            <div class="modal fade" id="resorceCodeModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <div class="document-section">
                                <h4 class="c_head">Insurance</h4>
                                <div class="document-list">
                                    <ul class="list-unstyled article_list tag_list">
                                        <li class="page_item page-item-2746 wd-state-closed">
                                            <a href="aaaaaaa" target="_blank">Name</a>
                                        </li>
                                        <li class="page_item page-item-2746 wd-state-closed">
                                            <a href="aaaaaaa" target="_blank">Name</a>
                                        </li>
                                        <li class="page_item page-item-2746 wd-state-closed">
                                            <a href="aaaaaaa" target="_blank">Name</a>
                                        </li>
                                        <li class="page_item page-item-2746 wd-state-closed">
                                            <a href="aaaaaaa" target="_blank">Name</a>
                                        </li>
                                        <li class="page_item page-item-2746 wd-state-closed">
                                            <a href="aaaaaaa" target="_blank">Name</a>
                                        </li>
                                        <li class="page_item page-item-2746 wd-state-closed">
                                            <a href="aaaaaaa" target="_blank">Name</a>
                                        </li>
                                    </ul>  
                                </div>                         
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    <?php
endwhile; // End of the loop.
if (is_post_type_archive(array(
    'forum',
    'topic'
)))
{
    if ($is_forum_btm_c2a == '1')
    {
        get_template_part('template-parts/forum/c2a-bottom');
    }
}
?>

<?php
get_footer();