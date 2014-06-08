<section class="container">
	<div class="map">
		<iframe style="width: 100%; height: 100%;" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?t=m&amp;sll=56.6452464,23.7108401&amp;sspn=0.0045304,0.0109864&amp;q=Sarmas+iela+4&amp;ie=UTF8&amp;hq=&amp;hnear=Sarmas+iela+4,+Jelgava,+LV-3001,+Latvia&amp;z=16&amp;ll=56.645246,23.71084&amp;output=embed"></iframe>
	</div>
	<div id="contact_info">
			
			<?php
				foreach ($data as $contactArray)
				{
					if (is_admin())
					{
						print('<div class="contacts"><form action="'.site_url('contacts/updateContactsInfo').'/'.$contactArray['id'].'" method="post"><textarea rows="4" cols="20" name="text">'.$contactArray['text'].'</textarea>');
						print('<button type="submit">Saglabāt izmaiņas</button></form></div>');
					}
					else
					{
						print('<div class="contacts">'.$contactArray['text'].'</div>');
					}
				}
			?>
		
	</div>
</section>