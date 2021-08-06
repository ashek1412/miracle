<?php
/**
 * Template Name: Record Books Page
 */

get_header();
?>

<style>
.sec_padding_50 {
    padding: 50px 0;
  }
  .document-section {
    box-shadow: 0px 4px 8px 0px rgba(4, 73, 89, 0.050980392156862744);
    transition: background 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;
    padding: 30px 30px 22px 30px;
  }
  .document-section:hover {
    box-shadow: 0px 30px 40px 0px rgba(4, 73, 89, 0.0784313725490196);
  }
  .document-section h3 {
    margin: 0px 0px 20px 0px;
  }
  .document-section{
    margin-bottom: 50px;
  }
  .document-section .document-list ul li a::before {display: none}
  .document-section .document-list .tabs-left > li {
    margin-right: -1px;
    width: 100%;
    }
  .document-section .document-list .nav.tabs-left {
    margin-top: 45px;
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
    <div class="sec_padding_50 <?php echo esc_attr($wrap_class) ?>">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="document-section">
                      <?php 
                      $title_1 = get_field( "title_1", get_the_ID());
                      if ($title_1) {
                        $title= $title_1; 
                      } else {
                        $title= "Store Directory";
                      }
                      ?>
                        <h3 class="elementor-heading-title elementor-size-default"><?php echo $title ?> </h3>
                        <div class="document-list">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">Rank</th>
                                  <th scope="col">Amount</th>
                                  <th scope="col">Store Name</th>
                                  <th scope="col">Month-Year</th>
                                  <th scope="col">Employee</th>
                                </tr>
                              </thead>
                                <tbody>
                                 <?php
                                    if( have_rows('month_data',get_the_ID()) ) :                                    
                                      while( have_rows('month_data',get_the_ID()) ): the_row();
                                        $rank = get_sub_field('rank', get_the_ID());
                                        $amount = get_sub_field('amount', get_the_ID());
                                        $store_name = get_sub_field('store_name', get_the_ID());
                                        $position = get_sub_field('position', get_the_ID());
                                        $month_year = get_sub_field('month-year', get_the_ID());
                                        $employee = get_sub_field('employee', get_the_ID());
                                      ?>
                                      <tr>
                                        <th scope="row"><?php echo $rank; ?></th>
                                        <td><?php echo $amount; ?></td>
                                        <td><?php echo $store_name; ?></td>
                                        <td><?php echo $month_year; ?></td>
                                        <td><?php echo $employee; ?></td>
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
                <div class="col-md-6">
                    <div class="document-section">
                      <?php 
                      $title_2 = get_field( "title_2", get_the_ID()); 
                      ?>
                       <h3 class="elementor-heading-title elementor-size-default"><?php echo $title_2 ?> </h3>
                        <div class="document-list">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">Rank</th>
                                  <th scope="col">Amount</th>
                                  <th scope="col">Year</th>
                                  <th scope="col">Employee</th>
                                  <th scope="col">Store Name</th>
                                </tr>
                              </thead>
                                <tbody>
                                 <?php
                                    if( have_rows('year_data',get_the_ID()) ) :                                    
                                      while( have_rows('year_data',get_the_ID()) ): the_row();
                                        $rank = get_sub_field('rank', get_the_ID());
                                        $amount = get_sub_field('amount', get_the_ID());
                                        $store_name = get_sub_field('store_name', get_the_ID()); 
                                        $year = get_sub_field('year', get_the_ID());
                                        $employee = get_sub_field('employee', get_the_ID());
                                      ?>
                                      <tr>
                                        <th scope="row"><?php echo $rank; ?></th>
                                        <td><?php echo $amount; ?></td>
                                        <td><?php echo $year; ?></td>
                                        <td><?php echo $employee; ?></td>
                                        <td><?php echo $store_name; ?></td>
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
                <div class="col-md-6">
                    <div class="document-section">
                      <?php 
                      $title_3 = get_field( "title_3", get_the_ID()); 
                      ?>
                      <?php
                                  if( have_rows('consultants_data',get_the_ID()) ) :                                    
                                    while( have_rows('consultants_data',get_the_ID()) ): the_row();
                                      $rank = get_sub_field('rank', get_the_ID());
                                      $amount = get_sub_field('amount', get_the_ID());
                                      $store_name = get_sub_field('store_name', get_the_ID());
                                      $position = get_sub_field('position', get_the_ID());
                                      $month_year = get_sub_field('month-year', get_the_ID());
                                      $employee = get_sub_field('employee', get_the_ID());
                                    ?> 
                                    <?php 
                                    endwhile;
                               endif;
                               ?> 
                        <h3 class="elementor-heading-title elementor-size-default"><?php echo $title_3 ?> </h3>
                        <div class="document-list">
                          <div class="row">
                      <div class="col-sm-3">
                          <ul class="nav nav-tabs tabs-left" role="tablist">
                              <li class="active" role="presentation"><a role="tab" href="#news2017" aria-controls="home" data-toggle="tab" class="active" aria-selected="true">2017</a></li>
                              <li role="presentation"><a role="tab" href="#news2016" aria-controls="profile" data-toggle="tab" class="" aria-selected="false">2016</a></li>
                              <li role="presentation"><a role="tab" href="#news2015" aria-controls="messages" data-toggle="tab" class="" aria-selected="false">2015</a></li>
                              <li role="presentation"><a role="tab" href="#news2014" aria-controls="settings" data-toggle="tab" class="" aria-selected="false">2014</a></li>
                              <li role="presentation"><a role="tab" href="#news2013" aria-controls="settings" data-toggle="tab" class="" aria-selected="false">2013</a></li>
                          </ul>
                      </div>
                    <div class="col-sm-9">
                        <div class="tab-content">
                            <div id="news2017" class="tab-pane active" role="tabpanel">
                                <h6>2017 Consultants</h6>
                                 <table class="table">
                                  <thead>
                                    <tr>
                                      <th scope="col">Rank</th> 
                                      <th scope="col">Amount</th> 
                                      <th scope="col">Employee</th> 
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>1st Place</td>
                                      <td>$1,043,727</td>
                                      <td>Dina Travis</td>
                                    </tr>
                                    <tr>
                                      <td>2nd Place</td>
                                      <td>$1,028,001</td>
                                      <td>Rory Conrad</td>
                                    </tr>
                                    <tr>
                                      <td>3rd Place</td>
                                      <td>$896,813 </td>
                                      <td>Jeff Howell</td>
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
                            <div id="news2016" class="tab-pane" role="tabpanel">
                                <h6>2016 Consultants </h6>
                                <div class="row">
                                     <table class="table">
                                      <thead>
                                        <tr>
                                          <th scope="col">Rank</th> 
                                          <th scope="col">Amount</th> 
                                          <th scope="col">Employee</th> 
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td>1st Place</td>
                                          <td>$1,175,009</td>
                                          <td>Chase Brown</td>
                                        </tr>
                                        <tr>
                                          <td>2nd Place</td>
                                          <td>$1,106,155</td>
                                          <td>Jim Navarra</td>
                                        </tr>
                                        <tr>
                                          <td>3rd Place</td>
                                          <td>$1,012,288</td>
                                          <td>Spencer Brown</td>
                                        </tr>
                                      </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="news2015" class="tab-pane" role="tabpanel">
                                <h6>2015 Consultants </h6>
                                 <table class="table">
                                  <thead>
                                    <tr>
                                      <th scope="col">Rank</th> 
                                      <th scope="col">Amount</th> 
                                      <th scope="col">Employee</th> 
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>1st Place</td>
                                      <td>$1,262,088</td>
                                      <td>Jim Navarra</td>
                                    </tr>
                                    <tr>
                                      <td>2nd Place</td>
                                      <td>$1,112,931</td>
                                      <td>Aaron Pratt</td>
                                    </tr>
                                    <tr>
                                      <td>3rd Place</td>
                                      <td>$1,037,813</td>
                                      <td>Leona Byrd</td>
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
                            <div id="news2014" class="tab-pane" role="tabpanel">
                                <h6>2014 Consultants </h6>
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th scope="col">Rank</th> 
                                      <th scope="col">Amount</th> 
                                      <th scope="col">Employee</th> 
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>1st Place</td>
                                      <td>$810,412</td>
                                      <td>Joe Herbert</td>
                                    </tr>
                                    <tr>
                                      <td>2nd Place</td>
                                      <td>$805,783</td>
                                      <td>Susan Sims</td>
                                    </tr>
                                    <tr>
                                      <td>3rd Place</td>
                                      <td>$789,346</td>
                                      <td>Jim Navarra</td>
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
                            <div id="news2013" class="tab-pane" role="tabpanel">
                                <h6>2013 Consultants </h6>
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th scope="col">Rank</th> 
                                      <th scope="col">Amount</th> 
                                      <th scope="col">Employee</th> 
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <td>1st Place</td>
                                      <td>$927,297</td>
                                      <td>Jim Navarra</td>
                                    </tr>
                                    <tr>
                                      <td>2nd Place</td>
                                      <td>$803,096</td>
                                      <td>Anne Riley</td>
                                    </tr>
                                    <tr>
                                      <td>3rd Place</td>
                                      <td>$660,679</td>
                                      <td>Joe Herbert</td>
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> 

                        </div>                         
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="document-section">
                      <?php 
                      $title_4 = get_field( "title_4", get_the_ID());
                      
                      ?>
                         <h3 class="elementor-heading-title elementor-size-default"><?php echo $title_4 ?> </h3>
                        <div class="document-list">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">Rank</th>
                                  <th scope="col">Store Name</th>
                                  <th scope="col">Employee</th>
                                  <th scope="col">Month-Year</th>
                                  <th scope="col">Amount</th>
                                </tr>
                              </thead>
                                <tbody>
                                 <?php
                                    if( have_rows('open_house_events_data',get_the_ID()) ) :                                    
                                      while( have_rows('open_house_events_data',get_the_ID()) ): the_row();
                                        $rank = get_sub_field('rank', get_the_ID());
                                        $amount = get_sub_field('amount', get_the_ID());
                                        $store_name = get_sub_field('store_name', get_the_ID());
                                        $month_year = get_sub_field('month-year', get_the_ID());
                                        $employee = get_sub_field('employee', get_the_ID());
                                      ?>
                                      <tr>
                                        <th scope="row"><?php echo $rank; ?></th>
                                        <td><?php echo $store_name; ?></td>
                                        <td><?php echo $employee; ?></td>
                                        <td><?php echo $month_year; ?></td>
                                        <td><?php echo $amount; ?></td>
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

            <?php
                // the_content();
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