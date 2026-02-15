<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @package Arorms
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<div class="comments-header mb-8">
			<h2 class="comments-title text-2xl font-bold text-gray-900 mb-4">
				<?php
				$arorms_comment_count = get_comments_number();
				if ( '1' === $arorms_comment_count ) {
					printf(
						/* translators: 1: title. */
						esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'arorms' ),
						'<span>' . wp_kses_post( get_the_title() ) . '</span>'
					);
				} else {
					printf( 
						/* translators: 1: comment count number, 2: title. */
						esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $arorms_comment_count, 'comments title', 'arorms' ) ),
						number_format_i18n( $arorms_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						'<span>' . wp_kses_post( get_the_title() ) . '</span>'
					);
				}
				?>
			</h2>

			<?php the_comments_navigation(); ?>
		</div><!-- .comments-header -->

		<ol class="comment-list space-y-6">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size' => 60,
					'callback'   => 'arorms_comment_callback',
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments mt-8 p-4 bg-yellow-50 text-yellow-800 rounded-lg"><?php esc_html_e( 'Comments are closed.', 'arorms' ); ?></p>
		<?php endif; ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
	comment_form(
		array(
			'title_reply'        => __( 'Leave a Comment', 'arorms' ),
			'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title text-xl font-bold text-gray-900 mb-6">',
			'title_reply_after'  => '</h3>',
			'comment_notes_before' => '<p class="comment-notes mb-4 text-gray-600">' . __( 'Your email address will not be published. Required fields are marked *', 'arorms' ) . '</p>',
			'comment_field'      => '<div class="comment-form-comment mb-6">
				<label for="comment" class="block text-sm font-medium text-gray-700 mb-2">' . _x( 'Comment *', 'noun', 'arorms' ) . '</label>
				<textarea id="comment" name="comment" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" rows="6" required></textarea>
			</div>',
			'fields'             => array(
				'author' => '<div class="comment-form-author mb-6">
					<label for="author" class="block text-sm font-medium text-gray-700 mb-2">' . __( 'Name *', 'arorms' ) . '</label>
					<input id="author" name="author" type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required />
				</div>',
				'email'  => '<div class="comment-form-email mb-6">
					<label for="email" class="block text-sm font-medium text-gray-700 mb-2">' . __( 'Email *', 'arorms' ) . '</label>
					<input id="email" name="email" type="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" required />
				</div>',
				'url'    => '<div class="comment-form-url mb-6">
					<label for="url" class="block text-sm font-medium text-gray-700 mb-2">' . __( 'Website', 'arorms' ) . '</label>
					<input id="url" name="url" type="url" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" />
				</div>',
			),
			'class_submit'       => 'submit bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors cursor-pointer',
			'label_submit'       => __( 'Post Comment', 'arorms' ),
			'class_form'         => 'comment-form bg-white p-6 rounded-lg shadow-md',
		)
	);
	?>
</div><!-- #comments -->

<?php
/**
 * Custom comment callback function
 */
function arorms_comment_callback( $comment, $args, $depth ) {
	$tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
	?>
	<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $args['has_children'] ? 'parent' : '', $comment ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body bg-white p-6 rounded-lg shadow-sm">
			<footer class="comment-meta flex items-start gap-4 mb-4">
				<div class="comment-author vcard flex-shrink-0">
					<?php
					if ( 0 != $args['avatar_size'] ) {
						echo get_avatar( $comment, $args['avatar_size'], '', '', array( 'class' => 'rounded-full' ) );
					}
					?>
				</div><!-- .comment-author -->

				<div class="comment-metadata flex-1">
					<div class="flex flex-wrap items-center gap-2 mb-2">
						<?php
						printf(
							'<b class="fn text-gray-900 font-semibold">%s</b>',
							get_comment_author_link( $comment )
						);
						?>
						
						<a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>" class="comment-time text-gray-500 text-sm">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php
								printf(
									/* translators: 1: comment date, 2: comment time */
									__( '%1$s at %2$s', 'arorms' ),
									get_comment_date( '', $comment ),
									get_comment_time()
								);
								?>
							</time>
						</a>
						
						<?php edit_comment_link( __( 'Edit', 'arorms' ), '<span class="edit-link text-blue-600 hover:text-blue-700 text-sm">', '</span>' ); ?>
					</div>

					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation text-yellow-600 text-sm italic"><?php _e( 'Your comment is awaiting moderation.', 'arorms' ); ?></p>
					<?php endif; ?>
				</div><!-- .comment-metadata -->
			</footer><!-- .comment-meta -->

			<div class="comment-content prose text-gray-800 mb-4">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<div class="comment-actions">
				<?php
				comment_reply_link(
					array_merge(
						$args,
						array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<div class="reply text-sm">',
							'after'     => '</div>',
							'reply_text' => '<span class="text-blue-600 hover:text-blue-700 font-medium">' . __( 'Reply', 'arorms' ) . '</span>',
						)
					)
				);
				?>
			</div><!-- .comment-actions -->
		</article><!-- .comment-body -->
	<?php
}