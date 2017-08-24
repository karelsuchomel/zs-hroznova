<article class="post-wrap clear-both type-image">
	<!-- if there is a features image -->
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
			<?php the_post_thumbnail('medium_large'); ?>
		</a>
	<?php endif; ?>

	<h2>
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
			<?php the_title(); ?>
		</a>
	</h2>
	<div class="basic-info-wrap">
		<div class="post-details-wrap">
			<span>
				<?php
					$dateString = get_the_time('j. F, Y');
					echo strtolower($dateString);
				?>
				 &#8226; 
			</span>
			<?php the_category(); ?>
		</div>
		<?php echo wp_trim_words( get_the_content(''), 10, '...' ); ?>
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
			více
		</a>
	</div>
</article>