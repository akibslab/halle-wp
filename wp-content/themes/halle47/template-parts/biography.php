<?php
$author_data = get_the_author_meta('description', get_query_var('author'));
$author_info = get_the_author_meta('halle_write_by');
$facebook_url = get_the_author_meta('halle_facebook');
$twitter_url = get_the_author_meta('halle_twitter');
$linkedin_url = get_the_author_meta('halle_linkedin');
$instagram_url = get_the_author_meta('halle_instagram');
$halle_url = get_the_author_meta('halle_youtube');
$halle_write_by = get_the_author_meta('halle_write_by');
$author_bio_avatar_size = 180;
if ($author_data != '') :
?>


    <div class="post-author blog__author-3 d-sm-flex grey-bg mb-90">
        <div class="post-author__thumb blog__author-thumb-3 mr-20">
            <a href="<?php print esc_url(get_author_posts_url(get_the_author_meta('ID'))) ?>">
                <?php print get_avatar(get_the_author_meta('user_email'), $author_bio_avatar_size, '', '', ['class' => 'media-object img-circle']); ?>
            </a>
        </div>

        <div class="post-author__content blog__author-content">
            <h4><a href="<?php print esc_url(get_author_posts_url(get_the_author_meta('ID'))) ?>">
                </a></h4>

            <?php if (!empty($author_info)) : ?>
                <span><?php print esc_html($author_info); ?></span>
            <?php endif; ?>

            <p><?php the_author_meta('description'); ?></p>
        </div>
    </div>

<?php endif; ?>