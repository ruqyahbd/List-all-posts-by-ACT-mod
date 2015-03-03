<?php

function ACT_shortcode_helper() {
?>

<div id="ACT_main_body" >
	
	
	<div id="form_container">
	
		<h1><a>List Posts by Author, nested Categories and Titles</a></h1>
		<form id="form_978810" class="appnitro"  method="post" action="">
					<div class="form_description">
			<h2>List Posts by Author, nested Categories and Titles</h2>
			<p>Automatic shortcode generator</p>
		</div>	
		<div id="first_col" style="width: 60%; float:left; display:inline;">
							
			<ul >
			
					<li id="li_2" >
		<label class="description" for="element_2">Select what list(s) to show: </label>
		<span>
			<input id="element_2_1" name="element_2_1" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_2_1">Categories</label>
<input id="element_2_2" name="element_2_2" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_2_2">Authors</label>
<input id="element_2_3" name="element_2_3" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_2_3">Titles</label>

		</span><p class="guidelines" id="guide_2"><small>Selecting more than one choice will include a selector dropdown box in your page. </small></p> 
		</li>		<li id="li_4" >
		<label class="description" for="element_4">Is this a single user site? </label>
		<span>
			<input id="element_4_1" name="element_4" class="element radio" type="radio" value="1" />
<label class="choice" for="element_4_1">Yes</label>
<input id="element_4_2" name="element_4" class="element radio" type="radio" value="2" checked="checked"/>
<label class="choice" for="element_4_2">No</label>

		</span><p class="guidelines" id="guide_4"><small>This option is for websites with a single author (or when you don't want to show the authors). It removes grouping by Authors and any author name. </small></p> 
		</li>		<li id="li_5" >
		<label class="description" for="element_5">Include admin's posts? </label>
		<span>
			<input id="element_5_1" name="element_5" class="element radio" type="radio" value="1" />
<label class="choice" for="element_5_1">Yes</label>
<input id="element_5_2" name="element_5" class="element radio" type="radio" value="2" checked="checked"/>
<label class="choice" for="element_5_2">No</label>

		</span> 
		</li>		<li class="section_break">
			<label class="description">Limit number of posts to max:</label>
			<p>Limit the number of posts in the lists, including only<br /> a certain number of the most recent posts.<br />This is achieved separately for the 3 lists.</p>
		</li>		<li id="li_3" >
		<label class="description" for="element_3">Categories (0 means no limit) </label>
		<div>
			<input id="element_3" name="element_3" class="element text small" type="text" maxlength="255" value="0"/> 
		</div><p class="guidelines" id="guide_3"><small>Limit the Categories list to only the "x" most recent for every category</small></p> 
		</li>		<li id="li_7" >
		<label class="description" for="element_7">Authors (0 means no limit) </label>
		<div>
			<input id="element_7" name="element_7" class="element text small" type="text" maxlength="255" value="0"/> 
		</div><p class="guidelines" id="guide_7"><small>Limit the Authors list to only the "x" most recent for every author</small></p> 
		</li>		<li id="li_8" >
		<label class="description" for="element_8">Titles (0 means no limit) </label>
		<div>
			<input id="element_8" name="element_8" class="element text small" type="text" maxlength="255" value="0"/> 
		</div><p class="guidelines" id="guide_8"><small>Limit the Titles list to only "x" most recent ones.</small></p> 
		</li>		<li id="li_9" >
		</div>
		<div id="second_col" style="float:left; width:39%; display:inline">
		<label class="description" for="element_9">Categories to EXCLUDE <br />(posts in selected Categories won't be listed) </label>
		<span>
			<input id="element_9_1" name="element_9_1" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_9_1">First option</label>

		</span><p class="guidelines" id="guide_9"><small>Exclude posts from selected Categories</small></p> 
		</li>
		</div>
			
					<li class="buttons" style="clear:both">
			    <input type="hidden" name="form_id" value="978810" />
			    
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
			</ul>
		</form>	
		
	</div>
	
	</div>
<?php
}

