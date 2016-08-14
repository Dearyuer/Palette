<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<span class="input">
		<input class="input-field" type="text" id="s" name="s" placeholder="<?php the_search_query(); ?>">
		<label class="input-label" for="s">
			<span class="input-label-content"></span>
		</label>
	</span>
<input type="submit" id="searchsubmit" value="<?php echo __("Search");?>" />
</form>