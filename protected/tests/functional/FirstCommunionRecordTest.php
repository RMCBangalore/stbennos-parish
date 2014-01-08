<?php
#
# This file is part of St. Benno's Parish Software
#
# St. Benno's Parish Software - software to manage tomorrow's parish
# Copyright (C) 2013  Redemptorist Media Center
#
# St. Benno's Parish Software is free software: you can redistribute it
# and/or modify it under the terms of the GNU General Public License as
# published by the Free Software Foundation, either version 3 of the
# License, or (at your option) any later version.
#
# St. Benno's Parish Software is distributed in the hope that it will
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

	public function testCreate()
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
		}
	}
}

?>
