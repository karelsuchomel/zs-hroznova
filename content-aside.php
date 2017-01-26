<div class="post-wrap clear-both aside">
	<div class="basic-info-wrap">
		<h2>
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
		<p>
			<?php echo get_the_content(); ?>
			<small class="update-info">
				<?php the_author_posts_link(); ?> &#8226; <?php the_time('F j'); ?>
			</small>
		</p>
	</div>
</div>