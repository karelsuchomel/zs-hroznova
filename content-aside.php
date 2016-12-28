<div class="post-wrap clear-both aside">
	<div class="basic-info-wrap">
		<p>
			<?php echo get_the_content(); ?>
			<small class="update-info">
				<?php the_author_posts_link(); ?> &#8226; <?php the_time('F j'); ?>
			</small>
		</p>
	</div>
</div>