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

class BannsRecordTest extends WebTestCase
{
	protected $captureScreenshotOnFailure = TRUE;
	protected $screenshotPath = '/home/hacker/public_html/screenshots';
	protected $screenshotUrl = 'http://localhost/~hacker/screenshots';

	public $fixtures = array(
		'families' => 'Families',
		'people' => 'People',
		'banns' => 'BannsRecord',
	);

	public function testCreateNonParishioner()
	{
		$this->loginAs('pastor', 'pastor');
		$baps = array(
			array(
				'groom_name' => 'Ronald Cornelius',
				'groom_parish' => 'Gerson Cornelius',
				'groom_parent' => 'St. John the Evangelist',
				'bride_name' => 'Sally Victor',
				'bride_parish' => 'Resurrection',
				'bride_parent' => 'Brendon Victor',
				'banns_dt1' => '05/01/2014',
				'banns_dt2' => '12/01/2014',
				'banns_dt3' => '19/01/2014',
			),
		);
		foreach($baps as $bap) {
			$this->open('bannsRecords/create');
			foreach($bap as $key => $value) {
				if (preg_match('/^sex$/', $key)) {
					$this->select("name=BannsRecord[$key]", "value=$value");
				} else {
					$this->type("name=BannsRecord[$key]", $value);
				}
			}
			$this->clickAndWait("//input[@value='Create']");
			foreach($bap as $key => $value) {
				if (preg_match('/^sex$/', $key)) {
					$this->assertTextPresent(FieldNames::value('sex', $value));
				} else {
					$this->assertTextPresent($value);
				}
			}
		}
	}
}

?>
