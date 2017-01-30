<div class="post-wrap clear-both aside">
	<h2>
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
			<?php the_title(); ?>
		</a>
	</h2>
	<div class="basic-info-wrap">
		<p>
			<?php the_time('F jS, Y'); ?> &#8226; <?php the_author_posts_link(); ?>
			<br>
			<?php echo get_the_content(); ?>
		</p>
	</div>
</div>