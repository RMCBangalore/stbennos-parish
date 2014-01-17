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

class FirstCommunionRecordTest extends WebTestCase
{
	protected $captureScreenshotOnFailure = TRUE;
	protected $screenshotPath = '/home/hacker/public_html/screenshots';
	protected $screenshotUrl = 'http://localhost/~hacker/screenshots';

	public $fixtures = array(
		'families' => 'Families',
		'people' => 'People',
		'first_communions' => 'FirstCommunionRecord',
	);

	public function testCreateNonParishioner()
	{
		$this->loginAs('pastor', 'pastor');
		$comms = array(
			array(
				'name' => 'Anjali Jose',
				'communion_dt' => '14/08/2011',
			),
			array(
				'name' => 'Brendan Grover',
				'communion_dt' => '11/08/1999'
			),
		);
		foreach($comms as $comm) {
			$this->open('firstCommunionRecords/create');
			foreach($comm as $key => $value) {
				$this->type("name=FirstCommunionRecord[$key]", $value);
			}
			$this->clickAndWait("//input[@value='Create']");
			foreach($comm as $key => $value) {
				$this->assertTextPresent($value);
			}
			$this->clickAndWait("//input[@value='Create Certificate']");
			foreach($comm as $key => $value) {
				$this->assertTextPresent($value);
			}
			$this->assertTextPresent(date_format(new DateTime(), 'd/m/Y'));
			$this->assertElementPresent("link=Download Certificate");
		}
	}

	public function testCreateParishioner()
	{
		$this->loginAs('pastor', 'pastor');
		$comms = array(
			array(
				'name' => 'Chris',
				'communion_dt' => '21/09/2012',
			),
		);
		foreach($comms as $comm) {
			$this->open('firstCommunionRecords/create');
			$this->click("css=#member_search > img");
			sleep(2);
			$this->type("id=key", $comm['name']);
			$this->click('css=#find_match > input[name="yt0"]');
			sleep(1);
			$this->click("id=yw0_c0_0");
			sleep(1);
			$this->click("id=submitMatch");
			sleep(1);
			#unset($comm['name']);
			$this->type("name=FirstCommunionRecord[communion_dt]", $comm['communion_dt']);
			$this->clickAndWait("//input[@value='Create']");
			foreach($comm as $key => $value) {
				$this->assertTextPresent($value);
			}
			$this->clickAndWait("//input[@value='Create Certificate']");
			foreach($comm as $key => $value) {
				$this->assertTextPresent($value);
			}
			$this->assertTextPresent(date_format(new DateTime(), 'd/m/Y'));
			$this->assertElementPresent("link=Download Certificate");
		}
	}
}

?>
