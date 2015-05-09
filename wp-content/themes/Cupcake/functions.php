<?php
	//多國語言
	load_theme_textdomain('cake', TEMPLATEPATH . '/languages');
	//選單註冊
	if(function_exists('register_nav_menus')) {
		register_nav_menus (
			array (
				'main-menu' => __('頂部選單', 'cake'),
			)
		);
	}
	
	//特色圖片
	add_theme_support('post-thumbnails');

	add_action('get_header', 'remove_admin_login_header'); 
	function remove_admin_login_header() { 
		remove_action('wp_head','_admin_bar_bump_cb'); }
	
	//分頁
	function pageNavigator() {
		global $paged, $wp_query;
		
		if (!$max_page) {
			$max_page = $wp_query->max_num_pages;
		}
		if($paged == '') {
			$paged = '1';
			if($paged != $max_page) {
				echo "<a class='Previous UnActive' title='" . __('上一頁', 'cake') . "'>" . __('« 上一頁', 'cake') . "</a>";
				echo "<span class='PageCount'>" . $paged . "/" . $max_page . "</span>";
				echo "<a href='" . get_pagenum_link(2) . "' class='Next' title='" . __('下一頁', 'cake') . "'>" . __('下一頁 »', 'cake') . "</a>";
			}else {
				echo "<a class='Previous UnActive' title='" . __('上一頁', 'cake') . "'>" . __('« 上一頁', 'cake') . "</a>";
				echo "<span class='PageCount'>" . $paged . "/" . $max_page . "</span>";
				echo "<a class='Next UnActive' title='" . __('下一頁', 'cake') . "'>" . __('下一頁 »', 'cake') . "</a>";
			}
		}else {
			if($paged != $max_page) {
				echo "<a href='" . get_pagenum_link($paged-1) . "' class='Previous' title='" . __('上一頁', 'cake') . "'>" . __('« 上一頁', 'cake') . "</a>";
				echo "<span class='PageCount'>" . $paged . "/" . $max_page . "</span>";
				echo "<a href='" . get_pagenum_link($paged+1) . "' class='Next' title='" . __('下一頁', 'cake') . "'>" . __('下一頁 »', 'cake') . "</a>";
			}else {
				echo "<a href='" . get_pagenum_link($paged-1) . "' class='Previous' title='" . __('上一頁', 'cake') . "'>" . __('« 上一頁', 'cake') . "</a>";
				echo "<span class='PageCount'>" . $paged . "/" . $max_page . "</span>";
				echo "<a class='Next UnActive' title='" . __('下一頁', 'cake') . "'>" . __('下一頁 »', 'cake') . "</a>";
			}
		}
	}
	
	//註冊小工具
	register_sidebar(array(
	  'name' => __('小工具欄位', 'cake'),
	  'id' => 'left-sidebar',
	  'description' => __('來自 WordPress 的小工具', 'cake'),
	  'before_title' => '<div class="titleWrapp"><div class="title">',
	  'after_title' => '</div></div>'
	));
	
	
	//迴響樣式定義
	function cupcakeComment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :cupcake
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<p><?php _e( 'Pingback:', 'cake' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __('(編輯)', 'cake'), '<span class="editLink">', '</span>'); ?></p>
		<?php
				break;
			default :
			global $post;
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>" >
			<div class="single">
			<div class="left"><?php echo get_avatar($comment,48); ?></div>
			<div class="right">
				<span class="information">
					<label class="author"><?php echo get_comment_author_link(); ?></label>
					<label class="date"><?php comment_date('Y-m-d H:i'); ?></label>
					<label class="reply"><?php comment_reply_link( array_merge( $args, array( 'reply_text' => __('回覆', 'cake'), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></label>
				</span>
				<div class="entry"><?php echo substr(apply_filters('comment_text', $comment -> comment_content), 0, -5) ?></div>
			</div>
			</div>
		<?php
			break;
		endswitch;
	}
	
	//友情連結
	function blogroll(){
		$blogroll_setting =  get_option('cupcake_blogroll');
		if($blogroll_setting){
			$blogrolls = explode("\n", $blogroll_setting);
			foreach ($blogrolls as $blogroll) {
				$blogroll = explode("|", $blogroll );
				echo '<li>';
				echo '<a href="'.esc_attr(trim($blogroll[0])).'">'.trim($blogroll[1]).'</a> ('.trim($blogroll[2]).')';
				echo '</li>';
			}
		}
	}
	
	//主題設定
	add_action('admin_menu', 'cupcake_page');
	function cupcake_page (){
		if ( count($_POST) > 0 && isset($_POST['cupcake_settings']) ){
			$options = array ('linksTool','headCode','footerCode','facebook','facebookSwitch','gplus','gplusSwitch','twitter','twitterSwitch','pinterest','pinterestSwitch','weibo','weiboSwitch','renren','renrenSwitch','linkedin','linkedinSwitch','blogroll');
			foreach ( $options as $opt ){
				delete_option ( 'cupcake_'.$opt, $_POST[$opt] );
				add_option ( 'cupcake_'.$opt, $_POST[$opt] );	
			}
		}
		add_theme_page(__('主題設定', 'cake'), __('主題設定', 'cake'), 'edit_themes', basename(__FILE__), 'cupcake_settings');
	}
	function cupcake_settings(){
?>
	<style>
		#wrap #top a {margin-right: 10px; padding: 5px 8px; background-color: #E0E0E0; color: #2EA2CC; text-decoration: none; }
		#wrap #top a:hover {background-color: #2EA2CC; color: #FFF; }
		#wrap #top a.current {background-color: #2EA2CC; color: #FFF; }
		#wrap #top {padding: 20px 0; }
		#wrap #bottom .blk {display: none; }
		#wrap #bottom .gen-set {display: block}
	</style>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/javascript/jquery.min.js"></script>
	<script type="text/javascript">
		function showSet($className) {
			$classNew = '.' + $className;
			$($classNew).siblings('.rel').removeClass('current');
			$($classNew).addClass('current');
			$('#bottom .blk').css({'display' : 'none'});
			$('#bottom ' + $classNew).css({'display' : 'block'});
		}
	</script>
	<div id="wrap">
		<div id="top">
			<a href="javascript:showSet('gen-set')" class="gen-set rel current"><?php _e('基本設定', 'cake'); ?></a>
			<a href="javascript:showSet('code-set')" class="code-set rel"><?php _e('統計代碼', 'cake'); ?></a>
			<a href="javascript:showSet('sns-set')" class="sns-set rel"><?php _e('社群網站鏈結', 'cake'); ?></a>
			<a href="javascript:showSet('links-set')" class="links-set rel"><?php _e('友情鏈結', 'cake'); ?></a>
		</div>
		<div id="bottom">
		<form method="post" action="">
			<div class="gen-set blk">
				<h2><?php _e('基本設定', 'cake'); ?></h2>
				<fieldset class="block">
					<p><input type="checkbox" name="linksTool" id="linksTool" value="on" <?php if (get_option('cupcake_linksTool')) : ?>checked="checked"<?php endif; ?>><?php _e('啓用友情連結側邊欄小工具', 'cake'); ?></input></p>
				</fieldset>
				<input type="submit" name="Submit" class="button-primary" value="<?php _e('保存', 'cake'); ?>" />
				<input type="hidden" name="cupcake_settings" value="save" style="display:none;" />
			</div>
			<div class="code-set blk">
				<h2><?php _e('統計代碼', 'cake'); ?></h2>
				<fieldset class="block">
					<p><label class="left"><?php _e('向<code>head</code>裡添加代碼' ,'cake'); ?><label><textarea id="headCode" name="headCode" cols="35" rows="6"><?php echo get_option('cupcake_headCode'); ?></textarea></p>
					<p><label class="left"><?php _e('向<code>footer</code>裡添加代碼' ,'cake'); ?><label><textarea id="footerCode" name="footerCode"  cols="35" rows="6"><?php echo get_option('cupcake_footerCode'); ?></textarea></p>
				</fieldset>
				<input type="submit" name="Submit" class="button-primary" value="<?php _e('保存', 'cake'); ?>" />
				<input type="hidden" name="cupcake_settings" value="save" style="display:none;" />
			</div>
			<div class="sns-set blk">
				<h2><?php _e('社群網站鏈結', 'cake'); ?></h2>
				<fieldset class="block">
					<p><label class="left"><?php _e('Facebook (包含 http://)', 'cake'); ?></label><input type="text" name="facebook" id="facebook" value="<?php echo get_option('cupcake_facebook'); ?>"/><input type="checkbox" name="facebookSwitch" id="facebookSwitch" value="on" <?php if (get_option('cupcake_facebookSwitch')) : ?>checked="checked"<?php endif; ?>><?php _e('啓用', 'cupcake'); ?></input></p>
					<p><label class="left"><?php _e('Google+ (包含 http://)', 'cake'); ?></label><input type="text" name="gplus" id="gplus" value="<?php echo get_option('cupcake_gplus'); ?>"/><input type="checkbox" name="gplusSwitch" id="gplusSwitch" value="on" <?php if (get_option('cupcake_gplusSwitch')) : ?>checked="checked"<?php endif; ?>><?php _e('啓用', 'cupcake'); ?></input></p>
					<p><label class="left"><?php _e('Twitter (包含 http://)', 'cake'); ?></label><input type="text" name="twitter" id="twitter" value="<?php echo get_option('cupcake_twitter'); ?>"/><input type="checkbox" name="twitterSwitch" id="twitterSwitch" value="on" <?php if (get_option('cupcake_twitterSwitch')) : ?>checked="checked"<?php endif; ?>><?php _e('啓用', 'cupcake'); ?></input></p>
					<p><label class="left"><?php _e('Pinteres (包含 http://)', 'cake'); ?></label><input type="text" name="pinterest" id="pinterest" value="<?php echo get_option('cupcake_pinterest'); ?>"/><input type="checkbox" name="pinterestSwitch" id="pinterestSwitch" value="on" <?php if (get_option('cupcake_pinterestSwitch')) : ?>checked="checked"<?php endif; ?>><?php _e('啓用', 'cupcake'); ?></input></p>
					<p><label class="left"><?php _e('新浪微博 (包含 http://)', 'cake'); ?></label><input type="text" name="weibo" id="weibo" value="<?php echo get_option('cupcake_weibo'); ?>"/><input type="checkbox" name="weiboSwitch" id="weiboSwitch" value="on" <?php if (get_option('cupcake_weiboSwitch')) : ?>checked="checked"<?php endif; ?>><?php _e('啓用', 'cupcake'); ?></input></p>
					<p><label class="left"><?php _e('人人網 (包含 http://)', 'cake'); ?></label><input type="text" name="renren" id="renren" value="<?php echo get_option('cupcake_renren'); ?>"/><input type="checkbox" name="renrenSwitch" id="renrenSwitch" value="on" <?php if (get_option('cupcake_renrenSwitch')) : ?>checked="checked"<?php endif; ?>><?php _e('啓用', 'cupcake'); ?></input></p>
					<p><label class="left"><?php _e('Linkedin (包含 http://)', 'cake'); ?></label><input type="text" name="linkedin" id="linkedin" value="<?php echo get_option('cupcake_linkedin'); ?>"/><input type="checkbox" name="linkedinSwitch" id="linkedinSwitch" value="on" <?php if (get_option('cupcake_linkedinSwitch')) : ?>checked="checked"<?php endif; ?>><?php _e('啓用', 'cake'); ?></input></p>
				</fieldset>
				<input type="submit" name="Submit" class="button-primary" value="保存" />
				<input type="hidden" name="cupcake_settings" value="save" style="display:none;" />
			</div>
			<div class="links-set blk">
				<h2><?php _e('友情鏈結', 'cake'); ?></h2>
				<p><textarea name="blogroll" rows="10" cols="50" id="blogroll" class="large-text code"><?php echo get_option('cupcake_blogroll'); ?></textarea></p>
				<p><label><code><?php _e('格式: 鏈結 | 名稱 | 簡介', 'cake'); ?></code></label></p>
				<input type="submit" name="Submit" class="button-primary" value="<?php _e('保存', 'cake'); ?>" />
				<input type="hidden" name="cupcake_settings" value="save" style="display:none;" />
			</div>
			</form>
		</div>
	</div>
<?php }; ?>