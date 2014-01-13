<?php
#
# This file is part of Alive Parish Software
#
# Alive Parish - software to manage tomorrow's parish
# Copyright (C) 2013  Redemptorist Media Center
#
# Alive Parish Software is free software: you can redistribute it
# and/or modify it under the terms of the GNU General Public License as
# published by the Free Software Foundation, either version 3 of the
# License, or (at your option) any later version.
#
# Alive Parish Software is distributed in the hope that it will
# be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
# of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#

class SiteTest extends WebTestCase
{
	protected $captureScreenshotOnFailure = TRUE;
	protected $screenshotPath = '/home/hacker/public_html/screenshots';
	protected $screenshotUrl = 'http://localhost/~hacker/screenshots';

/*	public function testContact()
	{
		$this->open('?r=site/contact');
		$this->assertTextPresent('Contact Us');
		$this->assertElementPresent('name=ContactForm[name]');

		$this->type('name=ContactForm[name]','tester');
		$this->type('name=ContactForm[email]','tester@example.com');
		$this->type('name=ContactForm[subject]','test subject');
		$this->click("//input[@value='Submit']");
		$this->waitForTextPresent('Body cannot be blank.');
	}
*/
	public function testLoginLogout()
	{
		$this->open('');
		// ensure the user is logged out
		if($this->isTextPresent('Logout'))
			$this->clickAndWait('link=Logout (*)');

		foreach(array('staff', 'pastor') as $uname) {
			// test login process, including validation
			$this->clickAndWait('link=Login');
			$this->assertElementPresent('name=LoginForm[username]');
			$this->type('name=LoginForm[username]',$uname);
			$this->click("//input[@value='Login']");
			$this->waitForTextPresent('Password cannot be blank.');
			$this->type('name=LoginForm[password]',$uname);
			$this->clickAndWait("//input[@value='Login']");
			$this->assertTextNotPresent('Password cannot be blank.');
			$this->assertTextPresent('Logout');

			// test logout process
			$this->assertTextNotPresent('Login');
			$this->clickAndWait("link=Logout ($uname)");
			$this->assertTextPresent('Login');
		}
	}
}
