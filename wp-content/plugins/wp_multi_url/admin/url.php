<div id="wpbody-content">
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
				<table class="wp-list-table widefat fixed tags">
					<thead>
						<tr>
							<th class="manage-column column-cb check-column" scope="col"><span>URL</span></th>
							<th class="manage-column column-cb check-column" scope="col"><span>Categories</span></th>
							<th class="manage-column column-cb check-column" scope="col"><span>Theme</span></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach (self::$urls as $u):?>
						<tr>
							<td>
								<a href="<?php echo site_url().'/wp-admin/options-general.php?page=multi-url-admin&task=edit&id='.$u->id?>"><?php echo $u->url?></a>
							</td>
							<td>
								&nbsp;
							</td>
							<td>
								<?php echo $u->theme?>
							</td>
						</tr>
						<?php endforeach;?>
					</tbody>
					<tfoot>
					<tr>
						<th style="" class="manage-column column-cb check-column" scope="col">URL</th>
						<th style="" class="manage-column column-cb check-column" scope="col">Categories</th>
						<th style="" class="manage-column column-cb check-column" scope="col">Theme</th>
					</tfoot>
				</table>
				<div style="height: 50px;width: 100%;"></div>
				<form action="" method="post">
					<input type="hidden" name="page" value="multi-url-admin"/>
					<input type="hidden" name="action" value="add"/>
					<table>
						<caption><strong>Add new URL</strong></caption>
						<tr>
							<td>URL: </td>
							<td>
								<input type="text" id="url" name="url" value=""/>
							</td>
						</tr>
						<tr>
							<td>Choices categories:</td>
							<td>
								<?php foreach (self::$categories as $category):?>
								<input type="checkbox" name="cat[]" value="<?php echo $category->term_id?>" /><?php echo $category->name?>
								<?php endforeach;?>
							</td>
						</tr>
						<tr>
							<td>Choice theme:</td>
							<td>
								<select id="theme" name="theme">
									<?php foreach(self::$templates as $key => $template):?>
									<option value="<?php echo $key ?>"><?php echo $template['Name']?></option>
									<?php endforeach;?>
								</select>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input type="submit" value="Add"/>
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