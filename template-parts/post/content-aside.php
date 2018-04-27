<article class="post-wrap clear-both aside">
	<h2>
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
			<?php the_title(); ?>
		</a>
	</h2>
	<div class="basic-info-wrap">
		<div class="post-details-wrap">
			<span>
				<?php
					$postedTime = get_post_time('U', false, $post->ID ,false);
					global $currentTime;
					$timeDifference = $currentTime - $postedTime;
					echo timeSinceSimply( $timeDifference );
				?>
			</span>
		</div>
	</div>
</article>