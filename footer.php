		<div class="footer">
			<footer class="container">
				<ul class="footer-links right">
					<li><p><a href="//codrips.com"><?php _e("Activity","palette"); ?></a></p></li>
					<li><p><a href="//codrips.com"><?php _e("Archive","palette"); ?></a></p></li>
					<li><p><a href="//codrips.com"><?php _e("About","palette"); ?></a></p></li>
				</ul>
				<a href="<?php echo home_url(); ?>" class="footer-heart">
					<i class="fa fa-heart" aria-hidden="true"></i>
				</a>
				<ul class="footer-links">
					<li><p class="footer-inner"><?php bloginfo('name'); ?> - <i class="fa fa-copyright" aria-hidden="true"></i> <?php echo date('Y') ?></p></li>
					<li><p><a href="//codrips.com"><?php _e("Theme","palette"); ?></a></p></li>
					<li>
						<!-- <i class="fa fa-creative-commons" aria-hidden="true"></i> -->
						<p><?php _e("License","palette"); ?></a></p>
					</li>
				</ul>
			</footer>
		</div>
	<?php wp_footer(); ?>
	</div>
	</body>
</html>