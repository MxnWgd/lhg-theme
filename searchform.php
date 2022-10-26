<form role="search" method="get" id="searchform" class="searchform" action="<?php echo site_url(); ?>">
	<label class="screen-reader-text" for="s">Suche nach:</label>
	<input type="search" value="<?php echo get_search_query() ?>" name="s" placeholder="Suche..." id="searchInput">
	<input type="submit" id="searchsubmit" value=">">
</form>
