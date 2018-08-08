<article class="post-wrap clear-both aside">
	<a class="link-overlay" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
	</a>
	<h2 class="aside-headline">
		<?php the_title(); ?>
		|
		<span class="one-line-excerpt">
			<?php
			$loaded_content = strip_shortcodes( get_the_content('') );
			echo wp_trim_words( $loaded_content, 12, '' ); 
			?>
		</span>
	</h2>
	<div class="basic-info-wrap">
		<div class="post-details-wrap">
			<span>
				<?php
					$postedTime = get_post_time('U', false, $post->ID ,false);
					global $currentTime;
					$timeDifference = $currentTime - $postedTime;
					echo timeSincePosted( $timeDifference );
				?>
			</span>
		</div>
	</div>
</article>