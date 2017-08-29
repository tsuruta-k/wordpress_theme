	<?php get_header(); ?>


			<p><?php the_search_query(); ?> の検索結果</p>




			<?php if ( have_posts() && get_search_query() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>


				<?php endwhile; ?>

		<?php else: ?>
			<p>検索キーワードに該当する記事がございませんでした。<br>カテゴリーやアーカイブから探してみてください。</p>
		<?php endif; ?>

			<div class="pagenate">
				<?php echo paginate_links(); ?>
			</div>



	<?php get_footer(); ?>

