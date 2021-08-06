<?php
/**
 * Template Name: Store Information Page
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
            <div class="row">
                <div class="col-md-12">
                    <div class="document-section">
                      <?php 
                      $directory_title = get_field( "directory_title", get_the_ID());
                      $store_directory_address = get_field( "store_directory_address", get_the_ID());
                      if ($directory_title) {
                        $title= $directory_title; 
                      } else {
                        $title= "Store Directory";
                      }
                      ?>
                        <h4 class="c_head"><?php echo $title ?> </h4>
                        <p><?php echo $store_directory_address; ?></p>
                        <div class="document-list">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">Office</th>
                                  <th scope="col">Hours</th>
                                  <th scope="col">Employee</th>
                                  <th scope="col">Position</th>
                                  <th scope="col">Ext</th>
                                  <th scope="col">Phone #</th>
                                  <th scope="col">Email</th>
                                  <th scope="col">Addres</th>
                                </tr>
                              </thead>
                                <tbody>
                                 <?php
                                    if( have_rows('store_directory_list',get_the_ID()) ) {                                        
                                      while( have_rows('store_directory_list',get_the_ID()) ): the_row();
                                      $office = get_sub_field('office', get_the_ID());
                                      $hours = get_sub_field('hours', get_the_ID());
                                      $employee = get_sub_field('employee', get_the_ID());
                                      $position = get_sub_field('position', get_the_ID());
                                      $ext = get_sub_field('ext', get_the_ID());
                                      $phone_ = get_sub_field('phone_', get_the_ID());
                                      $email = get_sub_field('email', get_the_ID());
                                      $address = get_sub_field('address', get_the_ID());
                                      ?>
                                      <tr>
                                        <th scope="row"><?php echo $office; ?></th>
                                        <td><?php echo $hours; ?></td>
                                        <td><?php echo $employee; ?></td>
                                        <td><?php echo $position; ?></td>
                                        <td><?php echo $ext; ?></td>
                                        <td><?php echo $phone_; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td><?php echo $address; ?></td>
                                      </tr>
                                      <?php 
                                      endwhile;
                                  } else { ?>
                                    
                                  <tr>
                                    <th scope="row">name</th>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">name</th>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">name</th>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">name</th>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">name</th>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                    <td>name 2</td>
                                  </tr>
                                    <?php

                                  }
                                 ?>
                                  
                                </tbody>
                              </table>
                        </div>                         
                    </div>
                </div>
            </div>

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