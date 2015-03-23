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

	  	jQuery('#top-menu').click(function() {
	    	jQuery('.menu').slideToggle(300);
	    });
	    jQuery('.menu-item').mouseover(function() {
	    	var category = jQuery(jQuery(this)).text();
	    	if(category !== 'Submit') {
	    		jQuery('.drop-down-' + category).css('display', 'inline-block');
	    	}
	    });
	    jQuery('.menu-item').mouseleave(function() {
	    	var category = jQuery(jQuery(this)).text();
	    	if(!jQuery('.drop-down-' + category).is(':hover')) {
	    		jQuery('.drop-down-' + category).css('display', 'none');
	    	}
	    });
	    jQuery('.drop-down').mouseleave(function() {
	    	var category = jQuery(jQuery(this)).attr('class').split(' ')[0]
	    	console.log(jQuery(this));
	    	jQuery(jQuery(this)).css('display', 'none');
	    });
		});
		function position() {
			jQuery('.tonyBox').each(function() {
				var i = jQuery(this).attr('index');
				jQuery(this).css('left', (i - featured) * window.innerWidth);
			});
		}
		jQuery(window).resize(function() {
			jQuery('#menu-main').removeAttr("style");
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
								<a href="<?php echo home_url(); ?>"><img src="<?php echo $mts_options['mts_logo']; ?>" alt="<?php bloginfo( 'name' ); ?>" <?php //echo $attr; ?> style="height: 200px!important;"></a>
							</h1><!-- END #logo -->
					<?php } else { ?>
						  <h2 id="logo" class="image-logo">
								<?php list($width, $height, $type, $attr) = getimagesize($mts_options['mts_logo']); ?>
								<a href="<?php echo home_url(); ?>"><img src="<?php echo $mts_options['mts_logo']; ?>" alt="<?php bloginfo( 'name' ); ?>" <?php //echo $attr; ?> style="height: 200px!important;"></a>
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

		<div class="secondary-navigation tonynav">
			<nav id="navigation" >
        <a href="" class="tonynav" id="top-menu" onclick="return false;">Menu</a>
				<?php if ( has_nav_menu( 'primary-menu' ) ) { ?>
					<?php
						$walker = new mts_Walker;
						echo wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu', 'container' => '', 'walker' => $walker, 'echo' => false ) ); 
					?>
				<?php } else { ?>
					<ul class="menu">
						<?php wp_list_categories('title_li='); ?>
					</ul>
				<?php } ?>
			</nav>
		</div>

		<style>
			.drop-down {
			  display: none;
			  padding: 10px;
			  width: 100%;
			  background: #eee;
			}

			.navbar-post {
				width: 19%;
				height: 150px;
				box-sizing: border-box;
				display: inline-block;
				background: transparent no-repeat center center;
				background-size: cover;
				position: relative;
			}
			.navbar-post-black {
				background: rgba(0, 0, 0, 0.3);
				width: 100%;
				height: 100%;
				transition: 0.2s all ease-in-out;
			}
			.navbar-post-black:hover {
				background: rgba(0, 0, 0, 0.8);
			}
			.navbar-post-title {
				position: absolute;
				left: 10px;
				right: 10px;
				bottom: 10px;
				font-family: "League Gothic", "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
				font-size: 30px;
				color: #fff;
				line-height: 1.2em;
			}
		</style>
		<?php
			$categories = get_categories(array('parent' => 0));

			foreach ($categories as $category) {
				if($category->name == 'Uncategorized') continue;
		?>
			<div class="drop-down-<?php echo $category->name?> drop-down">
				<?php
					$ddposts = get_posts(array(
						'posts_per_page'   => 5,
						'offset'           => 0,
						'category_name'    => $category->slug,
						'suppress_filters' => true 
					));
					foreach ($ddposts as $post) {
						setup_postdata($post);
						$thumbnail = array_shift(wp_get_attachment_image_src(
							get_post_thumbnail_id($post->ID), 'medium'
						));
				?>
						<a href="<?php the_permalink(); ?>">
							<div class="navbar-post"
									 style="background-image: url('<?php echo $thumbnail; ?>');">
								<div class="navbar-post-black">
									<div class="navbar-post-title"><?php the_title(); ?></div>
								</div>
							</div>
						</a>
				<?php
						wp_reset_postdata();
					}
				?>
			</div>
		<?php
			}
		?>

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
											<?php the_post_thumbnail('full',array('title' => '')); ?>
										<?php } else { ?>
											<div class="featured-thumbnail">
												<img src="<?php echo get_template_directory_uri(); ?>/images/full.png" class="attachment-featured wp-post-image" alt="<?php the_title(); ?>">
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
