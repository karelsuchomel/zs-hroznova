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
		<div class="post-details-wrap">
			<span>
				<?php
					$dateString = get_the_time('j. F Y');
					echo strtolower($dateString);
				?>
				 &#8226; 
			</span>
			<?php the_category(); ?>
		</div>

		<?php 
		$loaded_content = strip_shortcodes( get_the_content('') );
		echo wp_trim_words( $loaded_content, 10, '...' ); 
		?>
		
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
			více
		</a>
	</div>
</article>