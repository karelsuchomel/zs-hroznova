<article class="post-wrap clear-both">
	<a class="link-overlay" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
	</a>
	<h2>
		<?php the_title(); ?>
	</h2>
	
	<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail(); ?>
	<?php endif; ?>

	<div class="basic-info-wrap">
		<div class="post-details-wrap">
			<span>
				<?php
					// $dateString = get_the_time('j. F Y');
					// echo strtolower($dateString);
					$postedTime = get_post_time('U', false, $post->ID ,false);
					global $currentTime;
					$timeDifference = $currentTime - $postedTime;
					echo timeSincePosted( $timeDifference );
				?>
				<!-- &#8226; --> 
			</span>

			<!-- categories -->
			<?php //the_category(); ?>

		</div>

		<?php 
		$loaded_content = strip_shortcodes( get_the_content('') );
		echo wp_trim_words( $loaded_content, 10, '...' ); 
		?>
	</div>
</article>