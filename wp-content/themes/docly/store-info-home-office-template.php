<?php
/**
 * Template Name: Store Information Home Office Page
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
                        <h4 class="c_head" style="margin-bottom: 10px;">Health Services Corporate Office Staff</h4>
                        <p style="text-align: center; margin-bottom: 30px;">10557 W Carlton Bay Dr Ste 201 Garden City ID 83714</p>
                        <div class="document-list">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col" style="width: 170px;">Employee Name</th>
                                  <th scope="col" style="width: 270px;">Email</th>
                                  <th scope="col">Ext</th>
                                  <th scope="col">Position</th>
                                  <th scope="col">Help with Specific Issues</th>
                                </tr>
                              </thead>
                                <tbody>
                                 <?php
                                    if( have_rows('store_directory_list',get_the_ID()) ) {                                        
                                      while( have_rows('store_directory_list',get_the_ID()) ): the_row();
                                      $employee_name = get_sub_field('employee_name', get_the_ID());
                                      $email = get_sub_field('email', get_the_ID());
                                      $ext = get_sub_field('ext', get_the_ID());
                                      $position = get_sub_field('position', get_the_ID());
                                      $help_with_specific_issues = get_sub_field('help_with_specific_issues', get_the_ID());
                                      ?>
                                      <tr>
                                        <th scope="row"><?php echo $employee_name; ?></th>
                                        <td><?php echo $email; ?></td>
                                        <td><?php echo $ext; ?></td>
                                        <td><?php echo $position; ?></td>
                                        <td><?php echo $help_with_specific_issues; ?></td>
                                      </tr>
                                      <?php 
                                      endwhile;
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