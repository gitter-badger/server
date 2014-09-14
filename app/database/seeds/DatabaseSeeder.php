<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');

		User::create(array(
			'username' => 'Matthias',
			'email' => 'matthias@phototresor.org',
			'password' => Hash::make('PhotoTresor'),
			'name_first' => 'Matthias',
			'name_last' => 'Loibl',
			'active' => true
		));

		Photo::create(array(
			'id' => '1',
			'file_name' => '28.jpg',
			'file_size' => '41044',
			'file_mime_type' => 'image/jpeg',
			'file_sha1' => 'c02c99ac35c3b6f9c698ad093dd61148f0f7bce4',
			'width' => '800',
			'height' => '600',
			'user_id' => '1',
			'captured_at' => '2007-08-04 02:22:04'
		));
		Photo::create(array(
			'id' => '2',
			'file_name' => 'HPIM1541.JPG',
			'file_size' => '2053950',
			'file_mime_type' => 'image/jpeg',
			'file_sha1' => '6cef2ab8a66ed404a0c8c1c57028afcf7fb77b0d',
			'width' => '3088',
			'height' => '2320',
			'user_id' => '1',
			'captured_at' => '2008-12-24 11:29:21'
		));
		Photo::create(array(
			'id' => '3',
			'file_name' => 'HPIM2997.JPG',
			'file_size' => '1929730',
			'file_mime_type' => 'image/jpeg',
			'file_sha1' => 'd0ec4095a35089f3650b0249270851096382f7d7',
			'width' => '3088',
			'height' => '2320',
			'user_id' => '1',
			'captured_at' => '2010-06-14 14:53:32'
		));
		Photo::create(array(
			'id' => '4',
			'file_name' => 'img_0171.jpg',
			'file_size' => '1823465',
			'file_mime_type' => 'image/jpeg',
			'file_sha1' => '9067826aa3f2aa41542574ecd6bd1b1124d64c18',
			'width' => '4752',
			'height' => '3168',
			'user_id' => '1',
			'captured_at' => '2009-09-27 15:15:45'
		));
		Photo::create(array(
			'id' => '5',
			'file_name' => 'p1120151.jpg',
			'file_size' => '364808',
			'file_mime_type' => 'image/jpeg',
			'file_sha1' => 'df367369e8525c36def65980c997ecb721f2f7f9',
			'width' => '1280',
			'height' => '960',
			'user_id' => '1',
			'captured_at' => '2011-12-03 12:28:01'
		));

	}

}
