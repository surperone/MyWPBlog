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
					<span> @ <?php the_time('d-m-Y') ?></span>
				<?php else: ?>
					<?php the_title('<a rel="bookmark">','</a>');?>
					<span> @ <?php the_time('d-m-Y') ?></span>
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
			
			<div class="postEntry">

				<div class="wrapp">
				<div class="bottom">
				<?php if(!is_page() && has_tag()) : ?>
				<span class="tags<?php if(is_single()) : ?> single<?php endif; ?>">
				<?php foreach(get_the_tags() as $tag): ?>
					<a href="<?php echo get_tag_link($tag->term_id); ?>">#<?php echo $tag -> name; ?></a>
				<?php endforeach; ?>
				</span>
				<?php endif; ?>
			</div>
					<?php the_content('',FALSE,''); ?>
				</div>
			</div>
			<div class="bottom">
				
				<?php if(is_home() || is_category() || is_archive()) : ?>
				<span class="readMore"><a class="readMoreLink" href="<?php the_permalink('') ?>" title="<?php _e('閱讀', 'cake') ?> <?php the_title(); ?> <?php _e('全文內容', 'cake') ?>"><?php _e('阅读全文', 'cake') ?></a></span>
				<?php endif; ?>
			</div>
		</div>
		<?php
				endwhile;
			else:
		?>
		<div class="post">
			<div class="title">
				<a href="<?php bloginfo('url'); ?>" rel="bookmark" title="<?php _e('返回到首頁', 'cake'); ?>"><?php _e('未找到' ,'cake'); ?></a>
			</div>
			<div class="information">
				<span><?php _e('搜尋結果: ', 'cake'); ?><?php echo $_GET['s']; ?></span>
			</div>
			<div class="postEntry">
				<div class="wrapp"><p><?php _e('找不到您要搜尋的內容，請更改關鍵詞後重新嘗試搜尋' ,'cake'); ?><p></div>
			</div>
			<div class="bottom">
			</div>
		</div>
		<?php
			endif;
		?>
		<?php if(is_home()) : ?><div class="pageNavigatorWrapp"><?php pageNavigator(); ?></div><?php endif; ?>
		<?php if(is_single() || is_page()) : ?><?php comments_template(); ?><?php endif ?>
	</div>
	<div class="sidebarWrapp">
		<?php get_sidebar(''); ?>
	</div>
</div>