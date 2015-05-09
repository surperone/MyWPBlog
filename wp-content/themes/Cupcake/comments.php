<div class="commentsWrapp">
	<div class="respondWrapp">
		<span class="titleWrapp" href="#">
			<a class="title"><?php _e('發表迴響', 'cake'); ?></a>
			<a class="close"></a>
		</span>
		<?php
		$comments_args = array(

			'fields'=> array(
				'author' => '<p class="comment-form-field comment-form-author">' . '<label for="author">' . __('昵稱:', 'cake') . '</label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="13"' . $aria_req . ' /></p>',   
				'email'  => '<p class="comment-form-field comment-form-email"><label for="email">' . __('電郵:', 'cake') . '</label><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="13"' . $aria_req . ' /></p>',   
				'url'    => '<p class="comment-form-field comment-form-url"><label for="url">' . __('連結:', 'cake') . '</label><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="13" /></p>',   
			),
			
				'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',   
				'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',   
				'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',   
				'comment_notes_before' => '',   
				'comment_notes_after'  => '',   
				'id_form'              => 'commentform',   
				'id_submit'            => 'submit',   
				'title_reply'          => '',   
				'title_reply_to'       => '',   
				'cancel_reply_link'    => __( 'Cancel reply' ),    

		 );
			comment_form($comments_args);
		?>
	</div>
	<?php if (post_password_required()) return; ?>
	<div class="commentsList">
		 <?php if($comments): ?>
		 <ol class="comment-list">
			<?php wp_list_comments(array('callback'=>'cupcakeComment','style'=>'ol')); ?>
		 </ol>
		<div class="commentPage">
			<span class="left"><?php previous_comments_link() ?></span>
			<span class="right"><?php next_comments_link() ?></span>
		</div>
		<?php else : ?>
		<div class="noComment">
			<div class="icon"></div>
			<p class="notice"><?php _e('暫無迴響，要來一發嗎？', 'cake');?></p>
		</div>
		<?php endif; ?>
	</div>
</div>