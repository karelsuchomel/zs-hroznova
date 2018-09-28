<?php get_header();?>

	<!-- info card -->
	<?php require_once('template-parts/front-page/info-card.php'); ?>

	<div id="content" class="clear-both">

		<!-- Listing posts -->
		<div id="tab-switcher" class="clear-both">
			<div id="posts" class="tab-button opened">Příspěvky</div>
			<div id="agenda" class="tab-button">Nadcházející akce</div>
			<div class="tab-divider"></div>
		</div>

		<div id="posts-wrap" class="size-medium">
			<div class="single-page-of-posts">

		<?php 
		define('__ROOT__', dirname(__FILE__) ); 
		require_once( __ROOT__ . "/inc/time-since-posted.php" );
		$currentTime = time();
		?>

		<!-- Start the loop -->
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php get_template_part('template-parts/post/content', get_post_format()); ?>
				
		<?php endwhile; ?>

			</div>
		<div id="load-more-wrap">
			<?php //echo paginate_links(); ?>
			<button id="fetch-older-posts-button">Načíst starší</button>
		</div>
		</div>

		<script type="text/javascript">
			el = document.getElementById("fetch-older-posts-button");

			function renderNewPost(postData) {
				var newPostHTML = "<article id=\"" + postData.id + "\" class=\"post-wrap clear-both\"><a class=\"link-overlay\" href=\"";
				newPostHTML += postData.link;
				newPostHTML += "\" rel=\"bookmark\"></a>";

				if(postData._links['wp:featuredmedia']) {

					newPostHTML += "<img src=\"" + postData._embedded['wp:featuredmedia'][0].media_details.sizes.thumbnail.source_url + "\" class=\"attachment-post-thumbnail size-post-thumbnail wp-post-image\">";
				}

				newPostHTML += "<h2>" + postData.title.rendered + "</h2>";

				newPostHTML += "</article>";

				console.log("new post added: " + newPostHTML);

				return newPostHTML;
			}

			function renderNewPageOfPosts(posts) {
				//console.log(posts);

				let newPageHTML = "<div class=\"single-page-of-posts\">";

				for (var i = 0; i < posts.length; i++) 
				{
					newPageHTML += renderNewPost(posts[i]);
				}	

				newPageHTML += "</div>";

				const postsPagesWrapEl = document.getElementById("posts-wrap");
				postsPagesWrapEl.innerHTML += newPageHTML;

				console.log("got to the end!");
			}

			function fetchOlderPosts()
			{
				fetch('http://192.168.1.190/zs-hroznova/wp-json/wp/v2/posts?_embed')
				.then(function(response) {
					return response.json();
				})
				.then(function(responseJSON) {
					renderNewPageOfPosts(responseJSON);
				});

			}

			el.addEventListener("click", fetchOlderPosts);
		</script>
		
		<?php else : ?>
		<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<!-- Stop the loop -->
		<?php endif; ?>

		<!-- List agenda -->
		<?php require_once('template-parts/front-page/agenda-list.php') ?>

<?php get_footer();?>
