<?php if(is_dynamic_sidebar()) dynamic_sidebar('left-sidebar');?>
<?php if(get_option('cupcake_linksTool')) : ?>
<li id="linksCC" class="widget widget_linksCC">
	<div class="titleWrapp">
		<div class="title"><?php _e('友情連結', 'cake'); ?></div>
	</div>
	<ul>
		<?php if (function_exists(blogroll)) blogroll();?>
	</ul>
</li>
<?php endif; ?>