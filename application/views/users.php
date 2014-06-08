<section class="container transparentBg">
	<?php if (is_admin() || is_superAdmin()) : ?>
		<table id='users_table'>
			<tr>
				<th>Id</th>
				<th>E-pasts</th>
				<th>Tiesības</th>
				<th>Darbības</th>
			</tr>
			<?php foreach($users as $id => $user) : ?>
			<tr>
			<form name='user_edit' method='post'>
					<td><?php print($user['id']); ?></td>
					<td><?php print($user['email']); ?></td>
					<td>
						<select name='permissions_index'>
							<option value='1' method='post' <?php if ($user['permissions_index'] == 1){print('selected');} ?> >Lietotājs</option>
							<option value='2' method='post' <?php if ($user['permissions_index'] == 2){print('selected');} ?>>Administrators</option>
						</select>
					</td>
					<td>
						<button type='submit' onclick="<?php print(site_url('users/updateUserInfo').'/'.$user['id']) ?>">Saglabāt</button>
						<a href='<?=site_url('users/deleteUser').'/'.$user['id']; ?>'>
							<button type='button'>Dzēst</button>
						</a>
					</td>
				</form>
			</tr>
			<?php endforeach; ?>
		</table>
	<?php endif; ?>
</section>