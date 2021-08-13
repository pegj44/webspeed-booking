<form method="post" action="">
	<label>
		Event Title <br>
		<input type="text" name="event-title">		
	</label>
	<br>
	<label>
		Description<br>
		<textarea name="event-description"></textarea>
	</label>
	<br>
	<?php wp_nonce_field('add-event', 'wp-bookings-add-event') ?>
	<input type="submit" value="Add Event">
</form>