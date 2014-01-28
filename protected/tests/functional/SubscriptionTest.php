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

class SubscriptionTest extends WebTestCase
{
	protected $captureScreenshotOnFailure = TRUE;
	protected $screenshotPath = '/home/hacker/public_html/screenshots';
	protected $screenshotUrl = 'http://localhost/~hacker/screenshots';

	public $fixtures = array(
		'families' => 'Families',
		'people' => 'People',
		'subscriptions' => 'Subscription',
	);

	public function testCreate()
	{
		$this->loginAs('pastor', 'pastor');
		$sub = array(
			'family' => 1,
			'paid_by' => 'Terence Monteiro',
			'till' => 50,
			'amount' => 10000
		);
		$this->open('subscription/create');
		$this->click('css=#family-search > img');
		sleep(2);
		$this->type("id=key", $sub['family']);
		$this->click('css=#find_match > input[name="yt0"]');
		sleep(1);
		$this->click("id=yw0_c0_0");
		sleep(1);
		$this->click("id=submitMatch");
		sleep(1);
		$this->type('name=Subscription[paid_by]', $sub['paid_by']);
		$this->select('name=Subscription[till]', "value=" . $sub['till']);
		$this->type('name=Subscription[amount]', $sub['amount']);
		$this->clickAndWait("//input[@value='Create']");
		$this->assertTextPresent('#' . $sub['family']);
		$this->assertTextPresent($sub['paid_by']);
		$this->assertTextPresent($sub['amount']);
	}
}

?>
