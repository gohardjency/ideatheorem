<?php
if ( have_comments() ) :
    // Show the comment pagination.
    $args = array(
        'prev_text' => '&laquo; Previous',
        'next_text' => 'Next &raquo;',
    );
    paginate_comments_links( $args );
?>

    <ol class="comment-list">
        <?php
        wp_list_comments( array(
            'style'      => 'li',
            'short_ping' => true,
            'avatar_size' => 30,
			'depth' => 5,
			'max-depth' => 5,
			'reverse_top_level' => null,
'reverse_children'  => '',
        ) );
        ?>
    </ol>

    <!-- Add the comment pagination again after the comment list -->
    <?php paginate_comments_links( $args ); ?>

<?php
// If comments are closed and there are comments, show a message about comments being closed.
elseif ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    echo '<p class="no-comments">Comments are closed.</p>';
endif;
?>
