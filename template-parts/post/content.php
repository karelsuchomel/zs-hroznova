<article class="post-wrap clear-both">
	
	<h2>
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
			<?php the_title(); ?>
		</a>
	</h2>
	
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
			<?php the_post_thumbnail(); ?>
		</a>
	<?php endif; ?>

	<div class="basic-info-wrap">
		<p>
			<?php the_time('j. F, Y'); ?> &#8226; <?php the_author_posts_link(); ?>
			<br>

			<?php 
			$loaded_content = strip_shortcodes( get_the_content('') );
			echo wp_trim_words( $loaded_content, 15, '...' ); 
			?>
			
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
				více
			</a>
		</p>
	</div>
</article>