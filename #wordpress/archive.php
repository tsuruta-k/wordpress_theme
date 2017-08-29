<?php get_header(); ?>

<div class="context-dark">
	<section class="breadcrumb-modern rd-parallax bg-gray-darkest">
		<div data-speed="0.2" data-type="media" data-url="<?php echo get_template_directory_uri(); ?>/images/background-04-1920x750.jpg" class="rd-parallax-layer"></div>
		<div data-speed="0" data-type="html" class="rd-parallax-layer">
			<div class="shell section-top-98 section-bottom-34 section-md-bottom-66 section-md-98 section-lg-top-190 section-lg-bottom-41">
				<h2 class="reveal-md-block offset-top-30"><span class="big">記事一覧</span></h2>
			</div>
		</div>
	</section>
</div>

<section class="section-66 bg-lilac">
	<div class="shell">
		<div class="range range-xs-center">

			<?php
				$paged = (int) get_query_var('paged');
				$args=array(
					'post_type' => 'post',
					'paged' => $paged,
					'orderby' => 'post_date',
					'order' => 'DESC',
					'post_status' => 'publish',
					'posts_per_page' => '10'
				);
				$the_query = new WP_Query($args);
				if ( $the_query->have_posts() ) :
				 while ( $the_query->have_posts() ) : $the_query->the_post();
				?>
				<div class="cell-sm-10 cell-md-6 offset-top-30">
					<!-- Post Boxed--><a href="<?php the_permalink(); ?>" class="reveal-block">
						<div class="post post-boxed">
							<!-- Post media-->
							<header class="post-media">
								<?php if (has_post_thumbnail()) : ?>
									<?php the_post_thumbnail('full'); ?>
								<?php else : ?>
									<img src="http://placehold.jp/570x321.png" alt="" class="img-responsive center-block">
								<?php endif ; ?>
								<!-- <img width="570" height="321" src="<?php //echo get_template_directory_uri(); ?>/images/post-01-570x321.jpg" alt="" class="img-responsive"/> -->
							</header>
							<!-- Post content-->
							<section class="post-content text-left">
								<div class="post-tags group-xs"><span class="label-custom label-lg-custom label-success text-regular text-italic text-capitalize">
								<?php
								 $cat = get_the_category();
								 $cat = $cat[0];
								 echo get_cat_name($cat->term_id);
								?>
							 </span>
								</div>
								<div class="post-body">
									<!-- Post Title-->
									<div class="post-title">
										<h4><?php the_title(); ?></h4>
									</div>
									<!-- <div class="post-meta small">
										<ul class="list-inline list-inline-sm p">
											<li class="text-italic text-middle">by&nbsp;<span>院長</span></li>
											<li><span class="text-middle icon-xxs mdi mdi-clock"></span>
												<time datetime="2016-01-01" class="text-italic text-middle">2 日前</time>
											</li>
										</ul>
									</div> -->
								</div>
							</section>
						</div></a>
				</div>
				<?php endwhile; endif; ?>

				<div class="cell-sm-10 offset-top-30">
					<?php
					if ($the_query->max_num_pages > 1) {
					 echo paginate_links(array(
					 'base' => get_pagenum_link(1) . '%_%',
					 'format' => 'page/%#%/',
					 'current' => max(1, $paged),
					 'total' => $the_query->max_num_pages
					 ));
					}
					?>
				</div>

		</div>
	</div>
</section>

<?php get_footer(); ?>
