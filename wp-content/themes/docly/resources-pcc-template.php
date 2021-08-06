<?php
/**
 * Template Name: Resources PCC Page
 */

get_header();

?>
<style type="text/css">
#resorceCodeModal6 .document-section .document-list ul li,
#resorceCodeModal8 .document-section .document-list .lossanddamage ul li {
    width: 49%;
    display: inline-block;
}    
#resorceCodeModal8 .document-section .document-list ul.tabs-left {
    margin-top: 40px;
}    
#resorceCodeModal8 .document-section .document-list ul.tabs-left li a::before {
    display: none;
}    
</style>

<?php

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
                                $block_title_1 = get_field( "block_title_1", get_the_ID());
                                if ($block_title_1) {
                                    $title_1 = $block_title_1; 
                                } else {
                                    $title_1 = "Scripts";
                                }
                                ?>
                                <h4 class="c_head"><?php echo $title_1 ?></h4> 
                                <div class="document-list">
                                    <ul class="list-unstyled article_list tag_list">
                                        <?php
                                        if( have_rows('documents_list_1',get_the_ID()) ) :                                    
                                          while( have_rows('documents_list_1',get_the_ID()) ): the_row();
                                            $name = get_sub_field('name', get_the_ID());
                                            $pdf = get_sub_field('pdf', get_the_ID());
                                            ?>
                                            <li class="page_item page-item-2746 wd-state-closed">
                                                <a href="<?php echo $pdf ?>" target="_blank"><?php echo $name ?></a>
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
                                $block_title_2 = get_field( "block_title_2", get_the_ID());
                                if ($block_title_2) {
                                    $title_2 = $block_title_2; 
                                } else {
                                    $title_2 = "Miracle Ear Foundation";
                                }
                                ?>
                                <h4 class="c_head"><?php echo $title_2 ?></h4> 
                                <div class="document-list">
                                    <ul class="list-unstyled article_list tag_list">
                                        <?php
                                        if( have_rows('documents_list_2',get_the_ID()) ) :                                    
                                          while( have_rows('documents_list_2',get_the_ID()) ): the_row();
                                            $name = get_sub_field('name', get_the_ID());
                                            $pdf = get_sub_field('pdf', get_the_ID());
                                            ?>
                                            <li class="page_item page-item-2746 wd-state-closed">
                                                <a href="<?php echo $pdf ?>" target="_blank"><?php echo $name ?></a>
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
                                <?php 
                                $block_title_3 = get_field( "block_title_3", get_the_ID());
                                if ($block_title_3) {
                                    $title_3 = $block_title_3; 
                                } else {
                                    $title_3 = "HIPAA";
                                }
                                ?>
                                <h4 class="c_head"><?php echo $title_3 ?></h4> 
                                <div class="document-list">
                                    <ul class="list-unstyled article_list tag_list">
                                        <?php
                                        if( have_rows('documents_list_3',get_the_ID()) ) :                                    
                                          while( have_rows('documents_list_3',get_the_ID()) ): the_row();
                                            $name = get_sub_field('name', get_the_ID());
                                            $pdf = get_sub_field('pdf', get_the_ID());
                                            ?>
                                            <li class="page_item page-item-2746 wd-state-closed">
                                                <a href="<?php echo $pdf ?>" target="_blank"><?php echo $name ?></a>
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

            <!-- Resource Modal 4 -->
            <div class="modal fade" id="resorceCodeModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <div class="document-section"> 
                                <?php 
                                $block_title_4 = get_field( "block_title_4", get_the_ID());
                                if ($block_title_4) {
                                    $title_4 = $block_title_4; 
                                } else {
                                    $title_4 = "Insurance";
                                }
                                ?>
                                <h4 class="c_head"><?php echo $title_41 ?></h4> 
                                <div class="document-list">
                                    <ul class="list-unstyled article_list tag_list">
                                        <?php
                                        if( have_rows('documents_list_4',get_the_ID()) ) :                                    
                                          while( have_rows('documents_list_4',get_the_ID()) ): the_row();
                                            $name = get_sub_field('name', get_the_ID());
                                            $pdf = get_sub_field('pdf', get_the_ID());
                                            ?>
                                            <li class="page_item page-item-2746 wd-state-closed">
                                                <a href="<?php echo $pdf ?>" target="_blank"><?php echo $name ?></a>
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

            <!-- Resource Modal 5 -->
            <div class="modal fade" id="resorceCodeModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <div class="document-section">
                                <?php 
                                $block_title_5 = get_field( "block_title_5", get_the_ID());
                                if ($block_title_5) {
                                    $title_5 = $block_title_5; 
                                } else {
                                    $title_5 = "Financing";
                                }
                                ?>
                                <h4 class="c_head"><?php echo $title_5 ?></h4> 
                                <div class="document-list">
                                    <ul class="list-unstyled article_list tag_list">
                                        <?php
                                        if( have_rows('documents_list_5',get_the_ID()) ) :                                    
                                          while( have_rows('documents_list_5',get_the_ID()) ): the_row();
                                            $name = get_sub_field('name', get_the_ID());
                                            $pdf = get_sub_field('pdf', get_the_ID());
                                            ?>
                                            <li class="page_item page-item-2746 wd-state-closed">
                                                <a href="<?php echo $pdf ?>" target="_blank"><?php echo $name ?></a>
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

            <!-- Resource Modal 6-->
            <div class="modal fade" id="resorceCodeModal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <div class="document-section">
                                <?php 
                                $block_title_6 = get_field( "block_title_6", get_the_ID());
                                if ($block_title_6) {
                                    $title_6 = $block_title_6; 
                                } else {
                                    $title_6 = "Patient Information";
                                }
                                ?>
                                <h4 class="c_head"><?php echo $title_6 ?></h4> 
                                <div class="document-list">
                                    <ul class="list-unstyled article_list tag_list">
                                        <?php
                                        if( have_rows('documents_list_6',get_the_ID()) ) :                                    
                                          while( have_rows('documents_list_6',get_the_ID()) ): the_row();
                                            $name = get_sub_field('name', get_the_ID());
                                            $pdf = get_sub_field('pdf', get_the_ID());
                                            ?>
                                            <li class="page_item page-item-2746 wd-state-closed">
                                                <a href="<?php echo $pdf ?>" target="_blank"><?php echo $name ?></a>
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

            <!-- Resource Modal 7 -->
            <div class="modal fade" id="resorceCodeModal7" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <div class="document-section">
                                <?php 
                                $block_title_7 = get_field( "block_title_7", get_the_ID());
                                if ($block_title_7) {
                                    $title_7 = $block_title_7; 
                                } else {
                                    $title_7 = "Quick Links";
                                }
                                ?>
                                <h4 class="c_head"><?php echo $title_7 ?></h4> 
                                <div class="document-list">
                                    <ul class="list-unstyled article_list tag_list">
                                        <?php
                                        if( have_rows('documents_list_7',get_the_ID()) ) :                                    
                                          while( have_rows('documents_list_7',get_the_ID()) ): the_row();
                                            $name = get_sub_field('name', get_the_ID());
                                            $link = get_sub_field('link', get_the_ID());
                                            ?>
                                            <li class="page_item page-item-2746 wd-state-closed">
                                                <a href="<?php echo $link ?>" target="_blank"><?php echo $name ?></a>
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

            <!-- Resource Modal 8 -->
            <div class="modal fade" id="resorceCodeModal8" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <div class="document-section">
                                <h4 class="c_head">Loss and Damage/Replacement Claim Forms</h4>
                                <div class="document-list">
                                  <div class="row">
                                      <div class="col-sm-4">
                                          <ul class="nav nav-tabs tabs-left" role="tablist">
                                              <li class="active" role="presentation"><a role="tab" href="#news2017" aria-controls="home" data-toggle="tab" class="active" aria-selected="true">L&D Forms-Idaho</a></li>
                                              <li role="presentation"><a role="tab" href="#news2016" aria-controls="profile" data-toggle="tab" class="" aria-selected="false">L&D Forms-Washington</a></li>
                                              <li role="presentation"><a role="tab" href="#news2015" aria-controls="messages" data-toggle="tab" class="" aria-selected="false">L&D Forms-Seattle</a></li>
                                              <li role="presentation"><a role="tab" href="#news2014" aria-controls="settings" data-toggle="tab" class="" aria-selected="false">L&D Forms-Oregon</a></li>
                                              <li role="presentation"><a role="tab" href="#news2013" aria-controls="settings" data-toggle="tab" class="" aria-selected="false">L&D Forms-California</a></li>
                                              <li role="presentation"><a role="tab" href="#news2012" aria-controls="settings" data-toggle="tab" class="" aria-selected="false">L&D Forms-Hawaii</a></li>
                                          </ul>
                                      </div>
                                      <div class="col-sm-8 lossanddamage">
                                          <div class="tab-content">
                                                <div id="news2017" class="tab-pane active" role="tabpanel">
                                                    <h6>L&D Forms-Idaho</h6> 
                                                    <div class="document-list">
                                                        <ul class="list-unstyled  tag_list">
                                                            <?php
                                                            if( have_rows('documents_list_8_1',get_the_ID()) ) :                                    
                                                              while( have_rows('documents_list_8_1',get_the_ID()) ): the_row();
                                                                $name = get_sub_field('name', get_the_ID());
                                                                $pdf = get_sub_field('pdf', get_the_ID());
                                                                ?>
                                                                <li class="page_item page-item-2746 wd-state-closed">
                                                                    <a href="<?php echo $pdf ?>" target="_blank"><?php echo $name ?></a>
                                                                </li>
                                                                  <?php                                   
                                                              endwhile;
                                                            endif;
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div id="news2016" class="tab-pane" role="tabpanel">
                                                    <h6>L&D Forms-Washington</h6>
                                                    <div class="document-list">
                                                        <ul class="list-unstyled  tag_list">
                                                            <?php
                                                            if( have_rows('documents_list_8_2',get_the_ID()) ) :                                    
                                                              while( have_rows('documents_list_8_2',get_the_ID()) ): the_row();
                                                                $name = get_sub_field('name', get_the_ID());
                                                                $pdf = get_sub_field('pdf', get_the_ID());
                                                                ?>
                                                                <li class="page_item page-item-2746 wd-state-closed">
                                                                    <a href="<?php echo $pdf ?>" target="_blank"><?php echo $name ?></a>
                                                                </li>
                                                                  <?php                                   
                                                              endwhile;
                                                            endif;
                                                          ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div id="news2015" class="tab-pane" role="tabpanel">
                                                    <h6>L&D Forms-Seattle</h6>
                                                    <div class="document-list">
                                                        <ul class="list-unstyled  tag_list">
                                                        <?php
                                                        if( have_rows('documents_list_8_3',get_the_ID()) ) :                                    
                                                          while( have_rows('documents_list_8_3',get_the_ID()) ): the_row();
                                                            $name = get_sub_field('name', get_the_ID());
                                                            $pdf = get_sub_field('pdf', get_the_ID());
                                                            ?>
                                                            <li class="page_item page-item-2746 wd-state-closed">
                                                                <a href="<?php echo $pdf ?>" target="_blank"><?php echo $name ?></a>
                                                            </li>
                                                              <?php                                   
                                                          endwhile;
                                                        endif;
                                                          ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div id="news2014" class="tab-pane" role="tabpanel">
                                                    <h6>L&D Forms-Oregon</h6>
                                                    <div class="document-list">
                                                        <ul class="list-unstyled  tag_list">
                                                            <?php
                                                            if( have_rows('documents_list_8_4',get_the_ID()) ) :                                    
                                                              while( have_rows('documents_list_8_4',get_the_ID()) ): the_row();
                                                                $name = get_sub_field('name', get_the_ID());
                                                                $pdf = get_sub_field('pdf', get_the_ID());
                                                                ?>
                                                                <li class="page_item page-item-2746 wd-state-closed">
                                                                    <a href="<?php echo $pdf ?>" target="_blank"><?php echo $name ?></a>
                                                                </li>
                                                                  <?php                                   
                                                              endwhile;
                                                            endif;
                                                          ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div id="news2013" class="tab-pane" role="tabpanel">
                                                    <h6>L&D Forms-California</h6>
                                                    <div class="document-list">
                                                        <ul class="list-unstyled  tag_list">
                                                            <?php
                                                            if( have_rows('documents_list_8_5',get_the_ID()) ) :                                    
                                                              while( have_rows('documents_list_8_5',get_the_ID()) ): the_row();
                                                                $name = get_sub_field('name', get_the_ID());
                                                                $pdf = get_sub_field('pdf', get_the_ID());
                                                                ?>
                                                                <li class="page_item page-item-2746 wd-state-closed">
                                                                    <a href="<?php echo $pdf ?>" target="_blank"><?php echo $name ?></a>
                                                                </li>
                                                                  <?php                                   
                                                              endwhile;
                                                            endif;
                                                          ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div id="news2012" class="tab-pane" role="tabpanel">
                                                    <h6>L&D Forms-Hawaii</h6>
                                                    <div class="document-list">
                                                        <ul class="list-unstyled  tag_list">
                                                        <?php
                                                        if( have_rows('documents_list_8_6',get_the_ID()) ) :                                    
                                                          while( have_rows('documents_list_8_6',get_the_ID()) ): the_row();
                                                            $name = get_sub_field('name', get_the_ID());
                                                            $pdf = get_sub_field('pdf', get_the_ID());
                                                            ?>
                                                            <li class="page_item page-item-2746 wd-state-closed">
                                                                <a href="<?php echo $pdf ?>" target="_blank"><?php echo $name ?></a>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

            <!-- Resource Modal 9 -->
            <div class="modal fade" id="resorceCodeModal9" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <div class="document-section">
                                <?php 
                                $block_title_9 = get_field( "block_title_9", get_the_ID());
                                if ($block_title_9) {
                                    $title_9 = $block_title_9; 
                                } else {
                                    $title_9 = "New Patient Documents";
                                }
                                ?>
                                <h4 class="c_head"><?php echo $title_9 ?></h4> 
                                <div class="document-list">
                                    <ul class="list-unstyled article_list tag_list">
                                        <?php
                                        if( have_rows('documents_list_9',get_the_ID()) ) :                                    
                                          while( have_rows('documents_list_9',get_the_ID()) ): the_row();
                                            $name = get_sub_field('name', get_the_ID());
                                            $pdf = get_sub_field('pdf', get_the_ID());
                                            ?>
                                            <li class="page_item page-item-2746 wd-state-closed">
                                                <a href="<?php echo $pdf ?>" target="_blank"><?php echo $name ?></a>
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

            <!-- Resource Modal 10 -->
            <div class="modal fade" id="resorceCodeModal10" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <div class="document-section">
                                <?php 
                                $block_title_10 = get_field( "block_title_10", get_the_ID());
                                if ($block_title_10) {
                                    $title_10 = $block_title_10; 
                                } else {
                                    $title_10 = "Sycle.net Workbooks and Activity Guide";
                                }
                                ?>
                                <h4 class="c_head"><?php echo $title_10 ?></h4> 
                                <div class="document-list">
                                    <ul class="list-unstyled article_list tag_list">
                                        <?php
                                        if( have_rows('documents_list_10',get_the_ID()) ) :                                    
                                          while( have_rows('documents_list_10',get_the_ID()) ): the_row();
                                            $name = get_sub_field('name', get_the_ID());
                                            $pdf = get_sub_field('pdf', get_the_ID());
                                            ?>
                                            <li class="page_item page-item-2746 wd-state-closed">
                                                <a href="<?php echo $pdf ?>" target="_blank"><?php echo $name ?></a>
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

            <!-- Resource Modal 11 -->
            <div class="modal fade" id="resorceCodeModal11" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <div class="document-section">
                                <?php 
                                $block_title_11 = get_field( "block_title_11", get_the_ID());
                                if ($block_title_11) {
                                    $title_11 = $block_title_11; 
                                } else {
                                    $title_11 = "Sycle.net Workbooks and Activity Guide";
                                }
                                ?>
                                <h4 class="c_head"><?php echo $title_11 ?></h4> 
                                <div class="document-list">
                                    <ul class="list-unstyled article_list tag_list">
                                        <?php
                                        if( have_rows('documents_list_11',get_the_ID()) ) :                                    
                                          while( have_rows('documents_list_11',get_the_ID()) ): the_row();
                                            $name = get_sub_field('name', get_the_ID());
                                            $pdf = get_sub_field('pdf', get_the_ID());
                                            ?>
                                            <li class="page_item page-item-2746 wd-state-closed">
                                                <a href="<?php echo $pdf ?>" target="_blank"><?php echo $name ?></a>
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

            <!-- Resource Modal 12 -->
            <div class="modal fade" id="resorceCodeModal12" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <div class="document-section">
                                <?php 
                                $block_title_12 = get_field( "block_title_12", get_the_ID());
                                if ($block_title_12) {
                                    $title_12 = $block_title_12; 
                                } else {
                                    $title_12 = "Sycle.net Workbooks and Activity Guide";
                                }
                                ?>
                                <h4 class="c_head"><?php echo $title_12 ?></h4> 
                                <div class="document-list">
                                    <ul class="list-unstyled article_list tag_list">
                                        <?php
                                        if( have_rows('documents_list_12',get_the_ID()) ) :                                    
                                          while( have_rows('documents_list_12',get_the_ID()) ): the_row();
                                            $name = get_sub_field('name', get_the_ID());
                                            $document = get_sub_field('document', get_the_ID());
                                            ?>
                                            <li class="page_item page-item-2746 wd-state-closed">
                                                <a href="<?php echo $document ?>" target="_blank"><?php echo $name ?></a>
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

            <!-- Resource Modal 13 -->
            <div class="modal fade" id="resorceCodeModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                            <div class="document-section">
                                <h4 class="c_head">Model name</h4>
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
<script type="text/javascript">
    jQuery(".protection-plan-newsletter .title-button .add_new_btn").click(function() {
  
  var lable = jQuery(".btn").text().trim();

  if(lable == "Close") {
    jQuery(".btn").text("Add Newsletter");
    jQuery(".addNewsletterForm").hide();
  }
  else {
     jQuery(".btn").text("Close");
     jQuery(".addNewsletterForm").show();
  }
    
  });

    /*$(".btn").click(function() {
  $(".myText").toggle();  
});*/

// OR

// jQuery(".btnhttp://staging.miracle-earnw.com/wp-content/uploads/2021/02/Aprils-Newsletter2020-1.pdfaa").click(function() {
  
//    var lable = jQuery(".btnhttp://staging.miracle-earnw.com/wp-content/uploads/2021/02/Aprils-Newsletter2020-1.pdfaa").text().trim();

//    if(lable == "Hide") {
//     jQuery(".btnhttp://staging.miracle-earnw.com/wp-content/uploads/2021/02/Aprils-Newsletter2020-1.pdfaa").text("Show");
//      jQuery(".myTexthttp://staging.miracle-earnw.com/wp-content/uploads/2021/02/Aprils-Newsletter2020-1.pdfaa").hide();
//    }
//    else {
//      jQuery(".btnhttp://staging.miracle-earnw.com/wp-content/uploads/2021/02/Aprils-Newsletter2020-1.pdfaa").text("Hide");
//      jQuery(".myTexthttp://staging.miracle-earnw.com/wp-content/uploads/2021/02/Aprils-Newsletter2020-1.pdfaa").show();
//    }
    
//   });




</script>
<?php
get_footer();