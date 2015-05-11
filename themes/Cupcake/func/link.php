<div class="contentWrapp">
	<div class="postWrapp">
		<?php
			if (have_posts()):
				while (have_posts()):the_post();
		?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="title">
				<?php if(is_home() || is_category() || is_archive()) : ?>
					<?php the_title('<a href="'.esc_url(get_permalink()).'" rel="bookmark">','</a>'); ?>
				<?php else: ?>
					<?php the_title('<a rel="bookmark">','</a>'); ?>
				<?php endif; ?>
			</div>
			<?php if(has_post_thumbnail()) : ?> 
			<div class="thumb">
				<?php if(is_home() || is_category() || is_archive()) : ?>
					<a href="<?php the_permalink('') ?>" title="<?php _e('閱讀', 'cake') ?> <?php the_title(); ?> <?php _e('全文內容', 'cake') ?>""><?php the_post_thumbnail(); ?></a>
				<?php else: ?>
					<?php the_post_thumbnail(); ?>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<div class="information">
				<span class="date"><?php the_time('d-m-Y') ?></span>
				<span class="dot">•</span>
				<?php if(!is_page()) : ?>
				<span class="category"><?php the_category(); ?></span>
				<span class="dot">•</span>
				<?php endif; ?>
				<span class="comments"><?php comments_number(__('0 則迴響', 'cake'),__('1 則迴響', 'cake'),__('% 則迴響', 'cake')); ?></span>
			</div>
			<div class="postEntry">
				<div class="wrapp">
					<?php if (function_exists(blogroll)) blogroll();?>
				</div>
			</div>
			<div class="bottom">
				<?php if(!is_page() && has_tag()) : ?>
				<span class="tags<?php if(is_single()) : ?> single<?php endif; ?>">
				<?php foreach(get_the_tags() as $tag): ?>
					<a href="<?php echo get_tag_link($tag->term_id); ?>">#<?php echo $tag -> name; ?></a>
				<?php endforeach; ?>
				</span>
				<?php endif; ?>
				<?php if(is_home() || is_category() || is_archive()) : ?>
				<span class="readMore"><a class="readMoreLink" href="<?php the_permalink('') ?>" title="<?php _e('閱讀', 'cake') ?> <?php the_title(); ?> <?php _e('全文內容', 'cake') ?>"><?php _e('閱讀全文 >>', 'cake') ?></a></span>
				<?php endif; ?>
			</div>
		</div>
		<?php
				endwhile;
			else:
			endif;
		?>
		<?php if(is_home()) : ?><div class="pageNavigatorWrapp"><?php pageNavigator(); ?></div><?php endif; ?>
		<?php if(is_single() || is_page()) : ?><?php comments_template(); ?><?php endif ?>
	</div>
	<div class="sidebarWrapp">
		<?php get_sidebar(''); ?>
	</div>
</div>