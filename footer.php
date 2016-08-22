	<div class="footer">
		<div id="footer-shadow"></div>
		<footer class="container clearfix">
			
			<?php 
			$args = array(
				'theme_location'  => 'footer-right',
				'menu_class'      => 'footer-links right',
			);
			wp_nav_menu( $args ); 
			 ?>
			<a href="<?php echo home_url(); ?>" class="footer-heart">
				<i class="fa fa-heart" aria-hidden="true"></i>
			</a>
			<?php 
			$args = array(
				'theme_location'  => 'footer-left',
				'menu_class'      => 'footer-links',
				'items_wrap' => '<ul id = "%1$s" class = "%2$s"><li><p class="footer-inner">'.get_bloginfo('name').' - <i class="fa fa-copyright" aria-hidden="true"></i> '.date('Y'). '</p></li>%3$s</ul>',
			);
			wp_nav_menu( $args ); 
			 ?>
		</footer>
	</div>
	<?php wp_footer(); ?>
	</div>
	</body>
</html>