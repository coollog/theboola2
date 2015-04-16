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

<style>
  #bottom {
    box-sizing: border-box;
    background: #cdcdcb;
    border-top: 4px solid #b4b2b3;
    padding: 40px;
    margin-top: 100px;
    text-align: center;
  }
  .bottomcenter {
    display: inline-block;
    position: relative;
    text-align: left;
  }
  .bottomlogo {
    width: 200px; height: 100px;
    background: url('<?php echo $mts_options['mts_footer_logo']; ?>') no-repeat center center;
    background-size: contain;
    display: inline-block;
  }
  .bottomsep {
    width: 1px;
    height: 100px;
    background: #b0b0ae;
    margin: 0 20px;
    display: inline-block;
  }
  .bottomtext {
    color: #444;
    padding-top: 20px;
    padding-right: 20px;
    font-size: 0.75em;
    line-height: 1.1em;
    display: inline-block;
    vertical-align: top;
  }
  uppercase {
    text-transform: uppercase;
  }
  .bottomlinks {
    padding-top: 20px;
    display: inline-block;
    vertical-align: top;
  }
  .bottomlink {
    min-width: 120px;
    padding: 10px;
    margin: 0 10px;
    text-transform: uppercase;
    color: #444;
    border: 1px solid #444;
    display: inline-block;
    font-size: 0.9em;
    text-align: center;
  }
  .bottomlink:hover {
    opacity: 0.5;
  }
  .bottomlinksubscribe {
    border-color: #2c36ed;
    color: #2c36ed;
  }
</style>
<div id="bottom">
  <div class="bottomcenter">
    <div class="bottomlogo"></div>
    <div class="bottomsep"></div>
    <div class="bottomtext">
      <uppercase>Copyright (C) 2015</uppercase>
      <br />
      The Boola
      <br /><br />
      Web design by Michelle Chan
      <br />
      Web development by Qingyang Chen and Tony Jiang
    </div>
    <div class="bottomlinks">
      <a href=""><div class="bottomlink bottomlinksubscribe">Subscribe</div></a>
      <a href="/about"><div class="bottomlink">About</div></a>
      <a href="/contact"><div class="bottomlink">Contact</div></a>
    </div>
  </div>
</div>
<?php wp_footer(); ?>
</div><!--.main-container-->
</body>
</html>