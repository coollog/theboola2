<?php if(isset($_GET['test'])) { ?>

<?php
  error_reporting(E_ALL & ~E_STRICT);
  ini_set('display_errors', '1');

	$args = array(
	  'parent' => 0
	 );
	$categories = get_categories($args);
	foreach ($categories as $category) {
		echo '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a><br/>';
	}

	$category = $categories[0];
	$args = array(
		'posts_per_page'   => 5,
		'offset'           => 0,
		'category_name'    => $category->slug,
		'suppress_filters' => true 
	);
	$posts = get_posts($args);
	foreach ($posts as $post) {
		setup_postdata($post);
		$thumbnail = wp_get_attachment_image_src(
			get_post_thumbnail_id($post->ID), 'small'
		);
?>
		<br /><img src="<?php $thumbnail; ?>" /><?php the_title(); ?></a>
<?php
	}
	wp_reset_postdata();
?>

<!DOCTYPE html>
<?php $mts_options = get_option('point'); ?>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<!--[if IE ]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php if ( is_home() ) { ?>
		<meta name="description" content="Yale's first social news outlet for the busy (and not so busy) Yalie-on-the-go. Articles published every Sundays and Thursdays." />
	<?php } ?>
	<?php mts_meta(); ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>

	<script>
		var featured = 0;
		jQuery(function() {
			rotate(featured);
		});

		function rotate(index) {
			$('.featuredpost').each(function() {
				var i = jQuery(this).attr('index'),
						left = (i - index) * 1000;
				jQuery(this).css('left', left.toString() + 'px');
			});

			featured = index;
		}
	</script>
</head>
<body id ="blog" <?php body_class('main'); ?>>
	<div class="main-container">
		<?php if(isset($mts_options['mts_trending_articles'])) { if($mts_options['mts_trending_articles'] == '1' && $mts_options['mts_trending_articles'] != '') { ?>
			<div class="trending-articles">
				<ul>
					<li class="firstlink"><?php _e('Now Trending','mythemeshop'); ?>:</li>
					<?php $i = 1; $my_query = new wp_query( 'cat='.$mts_options['mts_trending_articles_cat'].'&posts_per_page=4&ignore_sticky_posts=1' ); ?>
					<?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
						<li class="trendingPost <?php if($i % 4 == 0){echo 'last';} ?>">
							<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php mts_short_title('...', 24); ?></a>
						</li>                   
					<?php $i++; endwhile; endif;?>
				</ul>
			</div>
		<?php }} ?>
		<header class="main-header">
			<div id="header">
				<?php if ($mts_options['mts_logo'] != '') { ?>
					<?php if( is_front_page() || is_home() || is_404() ) { ?>
							<h1 id="logo" class="image-logo">
                                <?php list($width, $height, $type, $attr) = getimagesize($mts_options['mts_logo']); ?>
								<a href="<?php echo home_url(); ?>"><img src="<?php echo $mts_options['mts_logo']; ?>" alt="<?php bloginfo( 'name' ); ?>" <?php echo $attr; ?>></a>
							</h1><!-- END #logo -->
					<?php } else { ?>
						  <h2 id="logo" class="image-logo">
								<?php list($width, $height, $type, $attr) = getimagesize($mts_options['mts_logo']); ?>
								<a href="<?php echo home_url(); ?>"><img src="<?php echo $mts_options['mts_logo']; ?>" alt="<?php bloginfo( 'name' ); ?>" <?php echo $attr; ?>></a>
							</h2><!-- END #logo -->
					<?php } ?>
				<?php } else { ?>
					<?php if( is_front_page() || is_home() || is_404() ) { ?>
							<h1 id="logo" class="text-logo">
								<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
							</h1><!-- END #logo -->
					<?php } else { ?>
						  <h2 id="logo" class="text-logo">
								<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
							</h2><!-- END #logo -->
					<?php } ?>
				<?php } ?>

				<style>
					.socialmediabuttons {
						position: absolute;
						bottom: 0;
						right: 100px;
					}
					.socialmediabuttons img {
				    width: 50px;
				    height: 50px;
				    transition: 0.2s all ease-in-out;
					}
					.socialmediabuttons img:hover {
						opacity: 0.5;
					}
				</style>
				<div class="socialmediabuttons">
					<a href="https://www.facebook.com/theboolayale"><img src="http://theboola.com/wp-content/uploads/2015/02/pic1.png" /></a>
					<a href="http://www.twitter.com/theboolayale"><img src="http://theboola.com/wp-content/uploads/2015/02/pic2.png" /></a>
					<a href="https://www.linkedin.com/company/5160903"><img src="http://theboola.com/wp-content/uploads/2015/02/pic3.png" /></a>
					<a href="mailto:diane.kim@yale.edu"><img src="http://theboola.com/wp-content/uploads/2015/02/pic4.png" /></a>
				</div>
		</header>
		<div class="secondary-navigation">
				<nav id="navigation" >
					<?php if ( has_nav_menu( 'primary-menu' ) ) { ?>
						<?php $walker = new mts_Walker; wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu', 'container' => '', 'walker' => $walker ) ); ?>
					<?php } else { ?>
						<ul class="menu">
							<?php wp_list_categories('title_li='); ?>
						</ul>
					<?php } ?>
					<a href="#" id="pull"><?php _e('Menu','mythemeshop'); ?></a>
				</nav>
			</div>
		</div>
		<?php if ($mts_options['mts_header_adcode'] != '') { ?>
			<div class="header-bottom-second">
				<?php echo '<div id="header-widget-container">';
				if ($mts_options['mts_header_adcode'] != ''){
					echo '<div class="widget-header">';
					echo $mts_options['mts_header_adcode'];
					echo '</div>';
				}
				?>
				<?php if ($mts_options['mts_posttopleft_adcode'] != ''){ ?>
					<div class="widget-header-bottom-right">
						<div class="textwidget">
							<div class="topad"><?php echo $mts_options['mts_posttopleft_adcode']; ?> </div>
						</div>
					</div> 
				<?php } ?>
		<?php echo '</div></div>'; } ?>
		<?php if(isset($mts_options['mts_featured_slider'])) { if($mts_options['mts_featured_slider'] == '1' && $mts_options['mts_featured_slider'] != '') { ?>
			<?php if(is_home() && !is_paged()) { ?>
				<div class="featuredBox">
					<?php $i = 1;
						// prevent implode error
            if (empty($mts_options['mts_featured_slider_cat']) || !is_array($mts_options['mts_featured_slider_cat'])) {
              $mts_options['mts_featured_slider_cat'] = array('0');
            }
						$slider_cat = implode(",", $mts_options['mts_featured_slider_cat']);
						$my_query = new WP_Query('cat='.$slider_cat.'&posts_per_page=4&ignore_sticky_posts=1'); 
						while ($my_query->have_posts()) : $my_query->the_post(); ?>
						<?php if($i >= 1 and $i <= /*4*/1){ ?> 
							<div class="featuredpost firstpost excerpt" index="<?php echo $i - 1; ?>">
								<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="nofollow" id="first-thumbnail">
									<?php if ( has_post_thumbnail() ) { ?> 
										<?php the_post_thumbnail('bigthumb',array('title' => '')); ?>
									<?php } else { ?>
										<div class="featured-thumbnail">
											<img src="<?php echo get_template_directory_uri(); ?>/images/bigthumb.png" class="attachment-featured wp-post-image" alt="<?php the_title(); ?>">
										</div>
									<?php } ?>
									<p class="featured-excerpt">
										<span class="featured-title"><?php the_title(); ?></span>
										<span class="f-excerpt"><?php echo mts_excerpt(10);?></span>
									</p>
								</a>
							</div><!--.post excerpt-->   
						<?php } ?>
					<?php $i++; endwhile; wp_reset_query(); ?> 
				</div>
			<?php } ?>
		<?php }} ?>
<?php } else { ?>
<!DOCTYPE html>
<?php $mts_options = get_option('point'); ?>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<!--[if IE ]>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php mts_meta(); ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>

	<script>
		var featured = 0;
		var animating = false;
		jQuery(function() {
			jQuery('.tonyBox').each(function() {
				jQuery(this).children().last().css('background-image', 'url(' + jQuery(this).children().first().attr('src') + ')');
			});
			position();

			jQuery('.tonyCircle').click(function() {
	      if(animating) return;
	      animating = true;
	      var clicked = jQuery(this).attr('index');
	      featured = clicked;
	      var cur = jQuery('.circleSelected').attr('index');
	      var delta = (cur - clicked) * window.innerWidth;
	      if(clicked == cur) {
	        animating = false;
	        return;
	      }
	      jQuery('.circleSelected').removeClass('circleSelected');
	      jQuery(this).addClass('circleSelected');
	      jQuery('.tonyBox').each(function() {
	        jQuery(this).css('left', jQuery(this).position().left + delta + 'px');
	      });
	      setTimeout(function(){animating = false;}, 500);
	    });
		});
		function position() {
			jQuery('.tonyBox').each(function() {
				var i = jQuery(this).attr('index');
				jQuery(this).css('left', (i - featured) * window.innerWidth);
			});
		}
		jQuery(window).resize(function() {
  			position();
		});
	</script>
</head>
<body id ="blog" <?php body_class('main'); ?>>
	<div class="main-container">
		<?php if(isset($mts_options['mts_trending_articles'])) { if($mts_options['mts_trending_articles'] == '1' && $mts_options['mts_trending_articles'] != '') { ?>
			<div class="trending-articles">
				<ul>
					<li class="firstlink"><?php _e('Now Trending','mythemeshop'); ?>:</li>
					<?php $i = 1; $my_query = new wp_query( 'cat='.$mts_options['mts_trending_articles_cat'].'&posts_per_page=4&ignore_sticky_posts=1' ); ?>
					<?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
						<li class="trendingPost <?php if($i % 4 == 0){echo 'last';} ?>">
							<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php mts_short_title('...', 24); ?></a>
						</li>                   
					<?php $i++; endwhile; endif;?>
				</ul>
			</div>
		<?php }} ?>
		<header class="main-header">
			<div id="header">
				<?php if ($mts_options['mts_logo'] != '') { ?>
					<?php if( is_front_page() || is_home() || is_404() ) { ?>
							<h1 id="logo" class="image-logo">
                                <?php list($width, $height, $type, $attr) = getimagesize($mts_options['mts_logo']); ?>
								<a href="<?php echo home_url(); ?>"><img src="<?php echo $mts_options['mts_logo']; ?>" alt="<?php bloginfo( 'name' ); ?>" <?php echo $attr; ?>></a>
							</h1><!-- END #logo -->
					<?php } else { ?>
						  <h2 id="logo" class="image-logo">
								<?php list($width, $height, $type, $attr) = getimagesize($mts_options['mts_logo']); ?>
								<a href="<?php echo home_url(); ?>"><img src="<?php echo $mts_options['mts_logo']; ?>" alt="<?php bloginfo( 'name' ); ?>" <?php echo $attr; ?>></a>
							</h2><!-- END #logo -->
					<?php } ?>
				<?php } else { ?>
					<?php if( is_front_page() || is_home() || is_404() ) { ?>
							<h1 id="logo" class="text-logo">
								<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
							</h1><!-- END #logo -->
					<?php } else { ?>
						  <h2 id="logo" class="text-logo">
								<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>
							</h2><!-- END #logo -->
					<?php } ?>
				<?php } ?>

				<style>
					.socialmediabuttons {
						position: absolute;
						bottom: 0;
						right: 100px;
					}
					.socialmediabuttons img {
				    width: 50px;
				    height: 50px;
				    transition: 0.2s all ease-in-out;
					}
					.socialmediabuttons img:hover {
						opacity: 0.5;
					}
				</style>
				<div class="socialmediabuttons">
					<a href="https://www.facebook.com/theboolayale"><img src="http://theboola.com/wp-content/uploads/2015/02/pic1.png" /></a>
					<a href="http://www.twitter.com/theboolayale"><img src="http://theboola.com/wp-content/uploads/2015/02/pic2.png" /></a>
					<a href="https://www.linkedin.com/company/5160903"><img src="http://theboola.com/wp-content/uploads/2015/02/pic3.png" /></a>
					<a href="mailto:diane.kim@yale.edu"><img src="http://theboola.com/wp-content/uploads/2015/02/pic4.png" /></a>
				</div>
		</header>

		<div class="secondary-navigation">
				<nav id="navigation" >
					<?php if ( has_nav_menu( 'primary-menu' ) ) { ?>
						<?php $walker = new mts_Walker; wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu', 'container' => '', 'walker' => $walker ) ); ?>
					<?php } else { ?>
						<ul class="menu">
							<?php wp_list_categories('title_li='); ?>
						</ul>
					<?php } ?>
					<a href="#" id="pull"><?php _e('Menu','mythemeshop'); ?></a>
				</nav>
			</div>
		</div>

		<?php if ($mts_options['mts_header_adcode'] != '') { ?>
			<div class="header-bottom-second">
				<?php echo '<div id="header-widget-container">';
				if ($mts_options['mts_header_adcode'] != ''){
					echo '<div class="widget-header">';
					echo $mts_options['mts_header_adcode'];
					echo '</div>';
				}
				?>
				<?php if ($mts_options['mts_posttopleft_adcode'] != ''){ ?>
					<div class="widget-header-bottom-right">
						<div class="textwidget">
							<div class="topad"><?php echo $mts_options['mts_posttopleft_adcode']; ?> </div>
						</div>
					</div> 
				<?php } ?>
		<?php echo '</div></div>'; } ?>
		<?php if(isset($mts_options['mts_featured_slider'])) { if($mts_options['mts_featured_slider'] == '1' && $mts_options['mts_featured_slider'] != '') { ?>
			<?php if(is_home() && !is_paged()) { ?>
				<div class="featuredBox">
					<?php $i = 1;
						// prevent implode error
            if (empty($mts_options['mts_featured_slider_cat']) || !is_array($mts_options['mts_featured_slider_cat'])) {
              $mts_options['mts_featured_slider_cat'] = array('0');
            }
						$slider_cat = implode(",", $mts_options['mts_featured_slider_cat']);
						$my_query = new WP_Query('cat='.$slider_cat.'&posts_per_page=4&ignore_sticky_posts=1'); 
						while ($my_query->have_posts()) : $my_query->the_post(); ?>
						<?php if($i >= 1 and $i <= 3){ ?> 
							<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="nofollow">
								<div class="tonyBox" index="<?php echo $i - 1; ?>">
									<?php if ( has_post_thumbnail() ) { ?> 
											<?php the_post_thumbnail('bigthumb',array('title' => '')); ?>
										<?php } else { ?>
											<div class="featured-thumbnail">
												<img src="<?php echo get_template_directory_uri(); ?>/images/bigthumb.png" class="attachment-featured wp-post-image" alt="<?php the_title(); ?>">
											</div>
										<?php } ?>
									<div class="tonyImage"></div>
								</div><!--.post excerpt-->   
							</a>
						<?php } ?>
					<?php $i++; endwhile; wp_reset_query(); ?> 
				</div>
				<div class="tonyCircleContainer">
						<div class="tonyCircle circleSelected" index="0"></div>
						<div class="tonyCircle" index="1"></div>
						<div class="tonyCircle" index="2"></div>
					</div>
			<?php } ?>
		<?php }} ?>
<?php } ?>