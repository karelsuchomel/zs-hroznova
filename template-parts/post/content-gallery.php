<div class="post-wrap clear-both gallery">
	<h2>
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
			<?php the_title(); ?>
		</a>
	</h2>

	<div class="basic-info-wrap">
		<p>
			<div class="gallery-date-author-info">
				<?php the_time('F jS, Y'); ?> &#8226; <?php the_author_posts_link(); ?>
			</div>
				<?php the_content(); ?>
		</p>
	</div>
</div>