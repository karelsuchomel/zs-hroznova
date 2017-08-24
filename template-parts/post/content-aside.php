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
					$dateString = get_the_time('j. F, Y');
					echo strtolower($dateString);
				?>
				 &#8226; 
			</span>
			<?php the_category(); ?>
		</div>
		<?php echo get_the_content(); ?>
	</div>
</article>