
		<div class="footer">

			<footer class="container">
				
				<ul class="footer-links right">
					<li>
						<p><a href="//codrips.com"><?php _e("Activity","palette"); ?></a></p>
					</li>
					<li>
						<p><a href="//codrips.com"><?php _e("Archive","palette"); ?></a></p>
					</li>
					<li>
						<p><a href="//codrips.com"><?php _e("About","palette"); ?></a></p>
					</li>
				</ul>
				<a href="<?php echo home_url(); ?>" class="footer-heart">
					<i class="fa fa-heart" aria-hidden="true"></i>
				</a>
				<ul class="footer-links">
					<li><p class="footer-inner"><?php bloginfo('name'); ?> - &copy; <?php echo date('Y') ?></p></li>
					<li>
						<p><a href="//codrips.com"><?php _e("Theme","palette"); ?></a></p>
					</li>
					<li>
						<p><a href="//codrips.com"><?php _e("License","palette"); ?></a></p>
					</li>
				</ul>
			</footer>
		</div>
	<!-- make sure this is the last line -->
	<?php wp_footer(); ?>
	</div>
	</body>
</html>