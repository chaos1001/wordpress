<div id="search_main" class="block">
    <h2>Search</h2>
    
    <form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
        <fieldset id="search" class="grup">
			<input type="text" class="text" name="s" id="s"  value="Enter keywords..." onfocus="if (this.value == 'Enter keywords...') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Enter keywords...';}" />
			<input id="button" type="submit" value="Search" class="submit" name="submit" />
		</fieldset>
    </form>
</div>
