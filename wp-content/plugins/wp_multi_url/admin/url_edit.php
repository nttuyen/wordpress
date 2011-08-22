<div id="wpbody-content">
	<div>
		<h3><a href="<?php echo site_url().'/wp-admin/options-general.php?page=multi-url-admin'?>">&lt;-- Back</a></h3>
	</div>
	<div class="wrap nosubsub">
		<?php if(!empty(self::$errors)):?>
		<div>
			<h3>Error:</h3>
			<?php foreach(self::$errors as $error):?>
				<h4><?php echo $error?></h4>
			<?php endforeach;?>
		</div>
		<?php endif;?>
		<div id="col-container">
			<div id="col-left">
				<form action="" method="post">
					<input type="hidden" name="page" value="multi-url-admin"/>
					<input type="hidden" name="action" value="update"/>
					<input type="hidden" name="id" value="<?php echo self::$url->id?>"/>
					<table>
						<caption><strong>Update new URL</strong></caption>
						<tr>
							<td>URL: </td>
							<td>
								<input type="text" id="url" name="url" value="<?php echo self::$url->url?>"/>
							</td>
						</tr>
						<tr>
							<td>Choices categories:</td>
							<td>
								<?php foreach (self::$categories as $category):?>
								<input type="checkbox" name="cat[]" value="<?php echo $category->term_id?>" <?php if(in_array($category->term_id, self::$url->cat_ids)) echo 'checked="checked"'?> /><?php echo $category->name?>
								<?php endforeach;?>
							</td>
						</tr>
						<tr>
							<td>Choice theme:</td>
							<td>
								<select id="theme" name="theme">
									<?php foreach(self::$templates as $key => $template):?>
									<option value="<?php echo $key ?>" <?php if(self::$url->theme == $key) echo 'selected="selected"'?> ><?php echo $template['Name']?></option>
									<?php endforeach;?>
								</select>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="submit" value="Update"/>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div id="col-right">
				
			</div>
		</div>
	</div>
</div>
<div class="clear"></div>