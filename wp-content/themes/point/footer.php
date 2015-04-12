<?php $mts_options = get_option('point'); ?>
</div><!--.content-->
</div><!--#page-->

<footer>
	<?php 
		if(isset($mts_options['mts_featured_carousel'])) { 
			if($mts_options['mts_featured_carousel'] == '1' and
				 $mts_options['mts_featured_carousel'] != '') {
	?>
				<div class="carousel">
					<h3 class="frontTitle">
						<div class="latest">
							<?php
								$first_cat = $mts_options['mts_featured_carousel_cat'];
								echo get_cat_name( $first_cat );
							?>
						</div>
					</h3>
					<?php
						$i = 1;
						$my_query = new wp_query(
							'cat='.$mts_options['mts_featured_carousel_cat'].
							'&posts_per_page=6&ignore_sticky_posts=1'
						);
						while ($my_query->have_posts()) : $my_query->the_post();
					?>
							<div class="excerpt">
								<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="nofollow" id="footer-thumbnail">
									<div>
										<?php the_post_thumbnail('carousel',array('title' => '')); ?>
									</div>
									<p class="footer-title">
										<span class="featured-title"><?php the_title(); ?></span>
									</p>
								</a>
							</div><!--.post excerpt-->                
					<?php
						endwhile; wp_reset_query();
					?> 
				</div>
	<?php 
			}
		}
	?>
</footer><!--footer-->
<div class="copyrights">
	<div class="row" id="copyright-note">
		<?php list($width, $height, $type, $attr) = getimagesize($mts_options['mts_footer_logo']); ?>
		<div class="foot-logo">
			<a href="<?php echo home_url(); ?>" rel="nofollow">
				<img src="<?php echo $mts_options['mts_footer_logo']; ?>" alt="<?php bloginfo( 'name' ); ?>" <?php echo $attr; ?>>
			</a>
		<div class="copyright-left-text">
			Copyright &copy; <?php echo date("Y") ?> <a href="<?php echo home_url(); ?>" title="<?php bloginfo('description'); ?>" rel="nofollow"><?php bloginfo('name'); ?></a>.
		</div>
		<div class="footer-navigation">
			<?php if ( has_nav_menu( 'footer-menu' ) ) { ?>
				<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => 'menu', 'container' => '' ) ); ?>
			<?php } else { ?>
				<ul class="menu">
					<?php wp_list_pages('title_li='); ?>
				</ul>
			<?php } ?>
		</div>
		<div class="top"><a href="#top" class="toplink">&nbsp;</a></div>
	</div>
</div>

<?php wp_footer(); ?>
</div><!--.main-container-->
</body>
</html>