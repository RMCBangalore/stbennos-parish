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

/**
 * Change the following URL based on your server configuration
 * Make sure the URL ends with a slash so that we can use relative URLs in test cases
 */
define('TEST_BASE_URL', 'http://parish.holyfamily.in/index-test.php/');

/**
 * The base class for functional test cases.
 * In this class, we set the base URL for the test application.
 * We also provide some common methods to be used by concrete test classes.
 */
class WebTestCase extends CWebTestCase
{
	/**
	 * Sets up before each test method runs.
	 * This mainly sets the base URL for the test application.
	 */
	protected function setUp()
	{
		parent::setUp();
		$tb_url = getenv('TEST_BASE_URL');
		if (!isset($tb_url)) $tb_url = TEST_BASE_URL;
		$this->setBrowserUrl($tb_url);
	}

	protected function loginAs($username, $password)
	{
                $this->open('');
                // ensure the user is logged out
                if($this->isTextPresent('Logout')) {
			if ($this->isTextPresent("Logout ($username)")) {
				return; # already logged in as $username
			} else {
				$this->clickAndWait('link=Logout (*)');
			}
		}

                // test login process, including validation
                $this->clickAndWait('link=Login');
                if ($this->isElementPresent('name=LoginForm[username]')
				and $this->isElementPresent('name=LoginForm[password]')) {
			$this->type('name=LoginForm[username]',$username);
			$this->type('name=LoginForm[password]',$password);
		}
                $this->clickAndWait("//input[@value='Login']");
                $this->assertTextPresent('Logout');
	}
}
