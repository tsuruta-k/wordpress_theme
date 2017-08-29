<?php get_header(); ?>

			<?php if( have_posts() ): while( have_posts() ): the_post(); ?>
				<?php
					$category = get_the_category();
					$cat_name = $category[0]->cat_name;
				?>

				<div class="main">
					<div class="container">
						<div class="row">
							<div class="w670">
								<div class="col-xs-12">
									<h2 class="mgt40"><img src="<?php echo get_template_directory_uri(); ?>/img/top/sub_title.png" alt="" class="img-responsive center-block"></h2>
									<h3 class="single_h3"><?php echo $cat_name; ?></h3>
									<p class="text-center">
										<span class=""><?php the_time('Y-m-d'); ?></span>
									</p>
									<h4 class="text-center fs22"><?php the_title(); ?></h4>
									<?php if (has_post_thumbnail()) : ?>
										<?php the_post_thumbnail('full', array( 'class' => 'img-responsive center-block' )); ?>
									<?php else : ?>
										<img src="http://placehold.jp/570x321.png" alt="" class="img-responsive center-block">
									<?php endif ; ?>
									<div class="center_768 mgt40"><?php the_content(); ?></div>

									<?php if ( get_previous_post() || get_next_post() ) { ?>
										<p class="text-center mgt20">
											<?php previous_post_link( '%link', '&laquo; 前のページ' ); ?>&emsp;&emsp;
											<?php next_post_link( '%link', '次のページ &raquo;' ); ?>
										</p>
									<?php } ?>

									<p class="text-center mgt20">
										<a href="<?php e_home(); ?>" class="btn bg_mouse white bold">TOPへ戻る</a>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>

				<?php endwhile; endif; ?>



<?php get_footer(); ?>
