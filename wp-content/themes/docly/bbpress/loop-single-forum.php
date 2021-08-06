<?php

/**
 * Forums Loop - Single Forum
 *
 * @package bbPress
 * @subpackage Theme
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

?>

<div id="bbp-forum-<?php bbp_forum_id(); ?>" <?php bbp_forum_class('', array('community-post', 'style-two', 'forum-item') ); ?>>

    <?php do_action( 'bbp_theme_before_forum_title' ); ?>

    <div class="col-md-6 post-content">
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="author-avatar forum-icon">
                <?php the_post_thumbnail('full'); ?>
            </div>
        <?php endif; ?>
        <div class="entry-content">
            <h3 class="post-title">
                <a href="<?php bbp_forum_permalink(); ?>"> <?php bbp_forum_title(); ?> </a>
            </h3>
            <p> <?php bbp_forum_content(); ?> </p>
        </div>
    </div>

    <div class="col-md-6 post-meta-wrapper">
        <ul class="forum-titles">
            <li class="forum-topic-count"> <?php bbp_forum_topic_count(); ?> </li>
            <li class="forum-reply-count"> <?php bbp_show_lead_topic() ? bbp_forum_reply_count() : bbp_forum_post_count(); ?> </li>
            <li class="forum-freshness">
                <div class="freshness-box">
                    <div class="freshness-top">
                        <div class="freshness-link">
                            <?php do_action( 'bbp_theme_before_forum_freshness_link' ); ?>
                            <?php bbp_forum_freshness_link(); ?>
                            <?php do_action( 'bbp_theme_after_forum_freshness_link' ); ?>
                        </div>
                    </div>
                    <div class="freshness-btm">
                        <a href="#" title="View Eh Jewel's profile" class="bbp-author-link">
                            <div class="freshness-name">
                                <a href="#" class="bbp-author-link">
                                    <span class="bbp-author-name"> <?php the_author_meta('display_name'); ?> </span>
                                </a>
                            </div>
                            <span class="bbp-author-avatar">
                                <?php echo get_avatar(get_the_author_meta('ID'), 30) ?>
                            </span>
                        </a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>