<?php
	if (isset($_GET['comments'])) {
		if (have_posts()): while (have_posts()): the_post();
			comments_template();
		endwhile; endif;
	}
	else if (isset($_GET['postcomment'])) {
		if (have_posts()): while (have_posts()): the_post();
			comments_template('/postcomment.php');
		endwhile; endif;
	}
	else {
		get_header();
?>
		<div id="contentwap">
			
			<?php if (have_posts()): while (have_posts()): the_post(); ?>
			
			<div id="infoblock">
			
				<h2><?php the_title(); ?></h2>
			
			</div>
			
			<div class="post">
				<?php the_content(); ?>
				<?php wp_link_pages('before=<p>&after=</p>&next_or_number=number&pagelink=Page %'); ?>
			</div>
			
			<div id="postfoot">
				<p><?php the_time('jS M y') ?>. Posted in <?php the_category(', ') ?>.</p>
			</div>
			
			<div id="comments">
				<div id="respond">
					<p><a href="#" title="comments">View</a> or <a href="#" title="postcomment">Post</a> Comments.</p>
				</div>
			</div>
			
			<script>
			     $(document).ready(function(){
				 	$('#respond a').click(function() {
				 				    var comment_type = $(this).attr("title");
				 					$(".content").hide("fast");
										$.ajax({
										method: "get",url: "<?php the_permalink().mopr_check_permalink(); ?>" + comment_type,
	                            		beforeSend: function(){$("#loading").show("fast");},
	                            		complete: function(){ $("#loading").hide("fast");},
										success: function(html){				
										        $(".comments").html(html);
										        $(".comments").slideDown("slow");
								 }
							 });
			         });
				 });
			</script>
			
			<div id="loading"></div>
			<div class="comments"></div>
			
			<?php endwhile; else: ?>
			
			<div id="infoblock">
				<h2>Page Not Found</h2>
			</div>
			
			<div class="post">
				<p>Sorry, The page you are looking for cannot be found!</p>
			</div>
			
			<?php endif; ?>

		</div>
		
	<?php get_footer(); ?>
<?php
	}
?>