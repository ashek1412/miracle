<?php
/**
 * Template Name: Marketing Page
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
                           
             <!-- Marketing Current Code Modal -->
            <div class="modal fade" id="currentCodeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                     <div class="current-cole-list">
                      <?php 
                      $current_code_title = get_field( "current_code_title", get_the_ID());
                      ?>
                        <h4 class="c_head"><?php echo $current_code_title ?></h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                      <th scope="col">Name</th>
                                      <th scope="col">Value</th>
                                      <th scope="col">Name</th>
                                      <th scope="col">Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $count = 1;
                                  if( have_rows('current_code_list',get_the_ID()) ) :                                    
                                    while( have_rows('current_code_list',get_the_ID()) ): the_row();
                                      $name = get_sub_field('name', get_the_ID());
                                      $value = get_sub_field('value', get_the_ID());
                                    
                                    if ($count%2 == 1)
                                        {  
                                             echo "<tr>";
                                        }
                                        ?>
                                        <th scope="row" class="even"><?php echo $name; ?></th>
                                        <td class="even"><?php echo $value; ?></td>
                                        <?php
                                        if ($count%2 == 0)
                                        {
                                            echo "</tr>";
                                        }
                                        $count++;
                                         ?>
                                        <?php 
                                      
                                    endwhile;
                                  endif;
                                  if ($count%2 != 1) echo "</tr>";
                                 ?>
                            </tbody>
                        </table> 
                    </div>
                  </div>
                </div>
              </div>
            </div>  

             <!-- Marketing Ad Creatives Modal -->
            <div class="modal fade" id="adCreativeCodeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="addCreatives">
                          <?php 
                            $ad_creative_templates_title = get_field( "ad_creative_templates_title", get_the_ID());
                            if ($ad_creative_templates_title) {
                              $title2 = $ad_creative_templates_title; 
                            } else {
                              $title2 = "Newspaper Ad Creative Templates";
                            }
                            ?>
                            <h4 class="c_head"><?php echo $title2 ?></h4>
                            <div class="row"> 
                              <div class="col-md-12">
                                <ul class="list-unstyled article_list tag_list">
                                <?php
                                  $count = 1;
                                  if( have_rows('ad_creative_templates_list',get_the_ID()) ) :                                    
                                    while( have_rows('ad_creative_templates_list',get_the_ID()) ): the_row();
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

             <!-- Marketing Order Modal -->
            <div class="modal fade" id="orderCodeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>

                       <div id="content_elements" class="protection-plan-newsletter details_cont ent recently_added">
                        <?php 
                          $order_title = get_field( "order_title", get_the_ID());
                          if ($order_title) {
                            $title3 = $order_title; 
                          } else {
                            $title3 = "Monthly Newspaper Orders";
                          }
                          ?>
                          <h4 class="c_head"><?php echo $title3 ?></h4> 
                          <div class="container">
                            <div class="row">
                              <div class="col-sm-3">
                                <ul class="nav nav-tabs tabs-left" role="tablist">
                                    <li class="active" role="presentation"><a role="tab" href="#news2020" aria-controls="home" data-toggle="tab">2020</a></li>
                                    <li role="presentation"><a role="tab" href="#news2019" aria-controls="profile" data-toggle="tab">2019</a></li>
                                    <li role="presentation"><a role="tab" href="#news2018" aria-controls="messages" data-toggle="tab">2018</a></li>
                                    <li role="presentation"><a role="tab" href="#news2017" aria-controls="settings" data-toggle="tab">2017</a></li>
                                </ul>
                              </div>
                              <div class="col-sm-9">
                                <div class="tab-content">
                                  <div id="news2020" class="tab-pane" role="tabpanel">
                                    <h6>2020 Newspaper Orders</h6>
                                    <div class="row">
                                      <?php
                                      $count = 1;
                                      if( have_rows('order_list_2020',get_the_ID()) ) :                                    
                                        while( have_rows('order_list_2020',get_the_ID()) ): the_row();
                                          $month = get_sub_field('month', get_the_ID());
                                          $pdf = get_sub_field('pdf', get_the_ID());
                                        
                                        if ($count%6 == 1)
                                            {  
                                                 echo '<div class="col-md-6">';
                                                 echo '<ul class="list-unstyled article_list tag_list">';
                                            }
                                            ?>
                                            <li class="page_item page-item-4307 wd-state-closed">
                                              <a href="<?php echo $pdf ?>" target="_blank" rel="noopener"><?php echo $month ?></a>
                                            </li>
                                            <?php
                                            if ($count%6 == 0)
                                            {
                                                echo "</ul>";
                                                echo "</div>";
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
                                  <div id="news2019" class="tab-pane active" role="tabpanel">
                                    <h6>2019 Newspaper Orders</h6>
                                    <div class="row">
                                      <?php
                                      $count = 1;
                                      if( have_rows('order_list_2019',get_the_ID()) ) :                                    
                                        while( have_rows('order_list_2019',get_the_ID()) ): the_row();
                                          $month = get_sub_field('month', get_the_ID());
                                          $pdf = get_sub_field('pdf', get_the_ID());
                                        
                                        if ($count%6 == 1)
                                            {  
                                                 echo '<div class="col-md-6">';
                                                 echo '<ul class="list-unstyled article_list tag_list">';
                                            }
                                            ?>
                                            <li class="page_item page-item-4307 wd-state-closed">
                                              <a href="<?php echo $pdf ?>" target="_blank" rel="noopener"><?php echo $month ?></a>
                                            </li>
                                            <?php
                                            if ($count%6 == 0)
                                            {
                                                echo "</ul>";
                                                echo "</div>";
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
                                  <div id="news2018" class="tab-pane" role="tabpanel">
                                    <h6>2018 Newspaper Orders</h6>
                                    <div class="row">
                                      <?php
                                      $count = 1;
                                      if( have_rows('order_list_2018',get_the_ID()) ) :                                    
                                        while( have_rows('order_list_2018',get_the_ID()) ): the_row();
                                          $month = get_sub_field('month', get_the_ID());
                                          $pdf = get_sub_field('pdf', get_the_ID());
                                        
                                        if ($count%6 == 1)
                                            {  
                                                 echo '<div class="col-md-6">';
                                                 echo '<ul class="list-unstyled article_list tag_list">';
                                            }
                                            ?>
                                            <li class="page_item page-item-4307 wd-state-closed">
                                              <a href="<?php echo $pdf ?>" target="_blank" rel="noopener"><?php echo $month ?></a>
                                            </li>
                                            <?php
                                            if ($count%6 == 0)
                                            {
                                                echo "</ul>";
                                                echo "</div>";
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
                                  <div id="news2017" class="tab-pane" role="tabpanel">
                                    <h6>2017 Newspaper Orders</h6>
                                    <div class="row">
                                      <?php
                                      $count = 1;
                                      if( have_rows('order_list_2017',get_the_ID()) ) :                                    
                                        while( have_rows('order_list_2017',get_the_ID()) ): the_row();
                                          $month = get_sub_field('month', get_the_ID());
                                          $pdf = get_sub_field('pdf', get_the_ID());
                                        
                                        if ($count%6 == 1)
                                            {  
                                                 echo '<div class="col-md-6">';
                                                 echo '<ul class="list-unstyled article_list tag_list">';
                                            }
                                            ?>
                                            <li class="page_item page-item-4307 wd-state-closed">
                                              <a href="<?php echo $pdf ?>" target="_blank" rel="noopener"><?php echo $month ?></a>
                                            </li>
                                            <?php
                                            if ($count%6 == 0)
                                            {
                                                echo "</ul>";
                                                echo "</div>";
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
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div> 

             <!-- Marketing Drop Dates Modal -->
            <div class="modal fade" id="dropDatesCodeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                     <div class="current-cole-list">
                      <?php 
                          $drop_date_title = get_field( "drop_date_title", get_the_ID());
                          if ($drop_date_title) {
                            $title4 = $drop_date_title; 
                          } else {
                            $title4 = "Januaruy 2021 Direct Mailer Drop Dates";
                          }
                          ?>
                      <h4 class="c_head"><?php echo $title4 ?></h4> 
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Name</th>
                              <th scope="col">Value</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                            if( have_rows('drop_date_list',get_the_ID()) ) :                                    
                              while( have_rows('drop_date_list',get_the_ID()) ): the_row();
                                $name = get_sub_field('name', get_the_ID());
                                $value = get_sub_field('value', get_the_ID());
                                  ?>
                                  <tr>
                                    <th scope="row"><?php echo $name ?></th>
                                    <td><?php echo $value ?></td>
                                  </tr>
                                  <?php                                   
                              endwhile;
                            endif;
                          ?>
                        </tbody>
                      </table> 
                    </div>
                  </div>
                </div>
              </div>
            </div>

             <!-- Marketing Mailer Creatives Modal -->
            <div class="modal fade" id="mailerCreativeCodeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                     <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                              <div class="mailerCreativeTemplate">
                                  <?php 
                                  $mailer_creative_templates_title = get_field( "mailer_creative_templates_title", get_the_ID());
                                  if ($mailer_creative_templates_title) {
                                    $title5 = $mailer_creative_templates_title; 
                                  } else {
                                    $title5 = "Mailer Creative Templates";
                                  }
                                  ?>
                                  <h4 class="c_head"><?php echo $title5 ?></h4> 
                                <div class="row">
                                  <div class="col-md-12">
                                    <ul class="list-unstyled article_list tag_list">
                                    <?php
                                      if( have_rows('creative_template_list',get_the_ID()) ) :                                    
                                        while( have_rows('creative_template_list',get_the_ID()) ): the_row();
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