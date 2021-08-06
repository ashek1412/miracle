<?php
   /**
    * Template Name: Protection Plan
    */
   
   get_header();
   
   $opt = get_option('docly_opt');
   $padding = "";
   
   $is_forum_btm_c2a = isset($opt['is_forum_btm_c2a']) ? $opt['is_forum_btm_c2a'] : '1';
   $wrap_class = 'page_wrapper';
   if ( class_exists('bbPress') ) {
       $wrap_class .= is_post_type_archive('forum') || is_post_type_archive('topic') || is_singular('forum') ? ' forum-page-content' : '';
   }
   
   while ( have_posts() ) : the_post();
       ?>
<div class="sec_pad <?php echo esc_attr($wrap_class) ?>">
   <div class="container">
      <?php
         // echo "test";
         // exit;
         the_content();
         wp_link_pages(array(
             'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'docly' ) . '</span>',
             'after'       => '</div>',
             'link_before' => '<span>',
             'link_after'  => '</span>',
             'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'docly' ) . ' </span>%',
             'separator'   => '<span class="screen-reader-text">, </span>',
         ));
         ?>
      <?php
         // If comments are open or we have at least one comment, load up the comment template.
         if ( comments_open() || get_comments_number() ) :
             comments_template();
         endif;
         ?> 
      <!--Protection Plan Doc Modal -->
      <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-body">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                  <div id="content_elements" class="protection-plan-form details_cont ent recently_added">
                     <?php 
                        $protection_plan_title = get_field( "protection_plan_title", get_the_ID());
                        if ($protection_plan_title) {
                            $title_1 = $protection_plan_title; 
                        } else {
                            $title_1 = "PROTECTION PLAN DOCUMENTS";
                        }
                        ?>
                     <h4 class="c_head"><?php echo $title_1 ?></h4>
                     <div class="document-list">
                        <ul class="list-unstyled article_list tag_list">
                           <?php
                              if( have_rows('plan_document_list',get_the_ID()) ) :                                    
                                while( have_rows('plan_document_list',get_the_ID()) ): the_row();
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
      <!--Protection Plan News Letter Modal -->
      <div class="modal fade" id="newsletterModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-body">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
                  <div id="content_elements" class="protection-plan-newsletter details_cont ent recently_added">
                    <?php 
                        $newsletter_library_title = get_field( "newsletter_library_title", get_the_ID());
                        if ($newsletter_library_title) {
                            $title_2 = $newsletter_library_title; 
                        } else {
                            $title_2 = "PROTECTION PLAN NEWS LETTERS";
                        }
                        ?>
                     <h4 class="c_head"><?php echo $title_2 ?></h4>
                     <div class="container">
                        <div class="row">
                           <div class="col-sm-3">
                              <ul class="nav nav-tabs tabs-left" role="tablist">
                                 <?php
                                    $count = 1;
                                        if( have_rows('plan_newsletter_list',get_the_ID()) ) :                                    
                                        while( have_rows('plan_newsletter_list',get_the_ID()) ): the_row();
                                    
                                            $year_of_news_letter = get_sub_field('year_of_news_letter', get_the_ID());
                                            if ($count == 1)
                                            {
                                                $active = "active";
                                            } else {
                                                $active = "";
                                            }
                                            ?>
                                 <li class="<?php echo $active ?>" role="presentation"><a role="tab" href="#news<?php echo chop($year_of_news_letter," NEWSLETTERS"); ?>" aria-controls="home" data-toggle="tab"><?php echo chop($year_of_news_letter," NEWSLETTERS");  ?></a></li>
                                 <?php 
                                    $count++;                               
                                    endwhile;
                                    endif;
                                    ?>
                              </ul>
                           </div>
                           <div class="col-sm-9">
                              <div class="tab-content">
                                 <?php
                                    $count = 1;
                                        if( have_rows('plan_newsletter_list',get_the_ID()) ) :                                    
                                        while( have_rows('plan_newsletter_list',get_the_ID()) ): the_row();
                                    
                                            $year_of_news_letter = get_sub_field('year_of_news_letter', get_the_ID());
                                            if ($count == 1) {
                                                $active = "active";
                                            } else {
                                                $active = "";
                                            }
                                            ?>
                                 <div id="news<?php echo chop($year_of_news_letter," NEWSLETTERS"); ?>" class="tab-pane <?php echo $active ?>" role="tabpanel">
                                    <h6><?php echo $year_of_news_letter ?></h6>
                                    <div class="row">
                                       <?php
                                          $count = 1;
                                          if( have_rows('newsletter_documents_list',get_the_ID()) ) :                                    
                                            while( have_rows('newsletter_documents_list',get_the_ID()) ): the_row();
                                              $month = get_sub_field('month', get_the_ID());
                                              $pdf = get_sub_field('pdf', get_the_ID());
                                            
                                            if ($count%6 == 1)
                                                {  
                                                     echo '<div class="col-md-6">';
                                                     echo '<ul class="list-unstyled article_list tag_list">';
                                                }
                                                ?>
                                       <li class="page_item page-item-4307 wd-state-closed">
                                          <a href="<?php echo $pdf; ?>" target="_blank" rel="noopener"><?php echo $month; ?></a>
                                       </li>
                                       <?php
                                          if ($count%6 == 0)
                                          {
                                              echo "</ul></div>";
                                          }
                                          $count++;
                                           ?>
                                       <?php 
                                          endwhile;
                                          endif;
                                          if ($count%6 != 1) echo "</ul></div>";
                                          ?>
                                    </div>
                                 </div>
                                 <?php 
                                    $count++;                               
                                    endwhile;
                                    endif;
                                    ?>
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
<?php
   endwhile; // End of the loop.
   
   if ( is_post_type_archive( array('forum', 'topic') ) ) {
       if ( $is_forum_btm_c2a == '1' ) {
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
</script>
<?php
get_footer();