<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="description" content="<?php bloginfo('description'); ?>" />
		<title><?php
		if(is_home()) {
			bloginfo('title');
			echo (" | "); bloginfo('description');
		}
		elseif(is_category()) {
			single_cat_title();
			echo (" | ");
			bloginfo("title");
		}
		elseif(is_single() || is_page()) {
			single_post_title();
			echo (" | ");
			bloginfo("title");
		}
		elseif(is_404()) {
			echo ("頁面未找到!");
			echo (" | ");
			bloginfo("title");
		}
		else {
			wp_title(”,true);
		}
		?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/reset.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/suit.css" type="text/css" media="screen" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/javascript/jquery.min.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/javascript/all.js"></script>
		<!--[if lt IE 8]>
			<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/fix/ie-older.css" type="text/css" media="screen" />
		<![endif]-->
		<!--[if lt IE 9]>
			<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/fix/ie.css" type="text/css" media="screen" />
		<![endif]-->
		<?php wp_head(); ?>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/javascript/comments-ajax.js"></script>
		<?php echo get_option('cupcake_headCode'); ?>
	</head>
	<body>
		<div class="mainWrapp">
			<div class="topWrapp">
				<div class="headerWrapp">
					<div class="logo">
						<p class="title"><a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('title'); ?>"><?php bloginfo('title'); ?></a></p>
						<p class="description"><?php bloginfo('description'); ?></p>
					</div>
					<div class="sns">
						<p>
<a href="http://weibo.com/lslisheng" target="_blank" class="snsa"><img src="http://2.lishengblog1.sinaapp.com/wp-content/themes/Cupcake/images/sns_weibo.png" class="sns"></a>
<a href="https://github.com/lishengzxc" target="_blank" class="snsa"><img src="http://2.lishengblog1.sinaapp.com/wp-content/themes/Cupcake/images/sns_github.png" class="sns"></a>
<a href="http://codepen.io/lishengzxc/" target="_blank" class="snsa"><img src="http://2.lishengblog1.sinaapp.com/wp-content/themes/Cupcake/images/apple-touch-icon-57x57.png" class="sns"></a>
</p>
						<?php if(get_option('cupcake_facebookSwitch')) : ?><a class="facebook" title="<?php _e('Facebook', 'cake') ?>" target="_blank" href="<?php echo get_option('cupcake_facebook'); ?>"></a><?php endif; ?>
						<?php if(get_option('cupcake_gplusSwitch')) : ?><a class="gplus" title="<?php _e('Google+', 'cake') ?>" target="_blank" href="<?php echo get_option('cupcake_gplus'); ?>"></a><?php endif; ?>
						<?php if(get_option('cupcake_twitterSwitch')) : ?><a class="twitter" title="<?php _e('Twitter', 'cake') ?>" target="_blank" href="<?php echo get_option('cupcake_twitter'); ?>"></a><?php endif; ?>
						<?php if(get_option('cupcake_pinterestSwitch')) : ?><a class="pinterest" title="<?php _e('Pinterest', 'cake') ?>" target="_blank" href="<?php echo get_option('cupcake_pinterest'); ?>"></a><?php endif; ?>
						<?php if(get_option('cupcake_linkedinSwitch')) : ?><a class="linkedin" title="<?php _e('Linkedin', 'cake') ?>" target="_blank" href="<?php echo get_option('cupcake_linkedin'); ?>"></a><?php endif; ?>
						<?php if(get_option('cupcake_weiboSwitch')) : ?><a class="weibo" title="<?php _e('新浪微博', 'cake') ?>" target="_blank" href="<?php echo get_option('cupcake_weibo'); ?>"></a><?php endif; ?>
						<?php if(get_option('cupcake_renrenSwitch')) : ?><a class="renren" title="<?php _e('人人網', 'cake') ?>" target="_blank" href="<?php echo get_option('cupcake_renren'); ?>"></a><?php endif; ?>
						<!-- <a class="rss" title="<?php _e('訂閱本站', 'cake') ?>" href="<?php bloginfo('rss2_url'); ?>"></a> -->
					</div>
				</div>
				<div class="navbarWrapp">
					<div class="menuWrapp">
					<div class="menuWrapp">
						<div class="menuItemMobile">
							<a class="mobileToggle" href="#"></a>
							<div class="item">
								<a <?php if(is_home() || is_single()) : ?>class="current" <?php endif; ?>href="<?php bloginfo('url'); ?>" title="<?php _e('返回到首頁', 'cake'); ?>">首頁</a>
									<?php
										wp_nav_menu(array(
											'theme_location' => 'main-menu'
										));
									?>
							</div>
						</div>
						<div class="menuItem">
						<a <?php if(is_home() || is_single()) : ?>class="current" <?php endif; ?>href="<?php bloginfo('url'); ?>" title="<?php _e('返回到首頁', 'cake'); ?>">首頁</a>
							<?php
								wp_nav_menu(array(
									'theme_location' => 'main-menu'
								));
							?>
						</div>
						<div class="searchWrapp">
							<?php get_search_form(); ?>
							<a class="closeSearch" href="#"></a>
						</div>
					</div>
				</div>
			</div>