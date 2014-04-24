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

class BaptismRecordTest extends WebTestCase
{
	protected $captureScreenshotOnFailure = TRUE;
	protected $screenshotPath = '/home/hacker/public_html/screenshots';
	protected $screenshotUrl = 'http://localhost/~hacker/screenshots';

	public $fixtures = array(
		'families' => 'Families',
		'people' => 'People',
		'baptisms' => 'BaptismRecord',
	);

	public function testCreateNonParishioner()
	{
		$this->loginAs('pastor', 'pastor');
		$baps = array(
			array(
				'name' => 'Antony Jacob',
				'dob' => '05/12/1985',
				'baptism_dt' => '12/12/1985',
				'baptism_place' => 'Bangalore',
				'sex' => 1,
				'residence' => 'Bangalore',
				'mother_tongue' => 'Kannada',
				'fathers_name' => 'Lambert Jacob',
				'mothers_name' => 'Preethi Jacob',
				'godfathers_name' => 'Oliver Prabhu',
				'godmothers_name' => 'Yvonne Prabhu',
				'minister' => 'Fr. Mark Mascarenhas',
				'confirmation_dt' => '11/10/2002',
				'marriage_dt' => '02/03/2013',
			),
		);
		foreach($baps as $bap) {
			$this->open('baptismRecords/create');
			foreach($bap as $key => $value) {
				if (preg_match('/^sex$/', $key)) {
					$this->select("name=BaptismRecord[$key]", "value=$value");
				} else {
					$this->type("name=BaptismRecord[$key]", $value);
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
			$this->clickAndWait("//input[@value='Create Certificate']");
			foreach($bap as $key => $value) {
				if (preg_match('/^sex$/', $key)) {
					$this->assertTextPresent(FieldNames::value('sex', $value));
				} else {
					$this->assertTextPresent($value);
				}
			}
			$this->assertTextPresent(date_format(new DateTime(), 'd/m/Y'));
			$this->assertElementPresent("link=Download Certificate");
		}
	}

	public function testCreateParishioner()
	{
		$this->loginAs('pastor', 'pastor');
		$baps = array(
			array(
				'name' => 'Subramaniam',
				'baptism_dt' => '11/12/2013',
				'baptism_place' => 'Bangalore',
				'residence' => 'Bangalore',
				'mother_tongue' => 'Kannada',
				'fathers_name' => 'Prashanth Subramaniam',
				'mothers_name' => 'Annapurna Subramaniam',
				'godfathers_name' => 'Nirmal Raj',
				'godmothers_name' => 'Arokia Mary',
				'minister' => 'Fr. Adrian Gomes',
				'confirmation_dt' => '11/12/2013',
				'marriage_dt' => '05/02/2014',
				'remarks' => 'Adult Baptism',
			)
		);
		foreach($baps as $bap) {
			$this->open('baptismRecords/create');
			$this->click("css=#member_search > img");
			sleep(2);
			$this->type("id=key", $bap['name']);
			$this->click('css=#find_match > input[name="yt0"]');
			sleep(1);
			$this->click("id=yw0_c0_0");
			sleep(2);
			$this->click("id=submitMatch");
			sleep(2);
			unset($bap['name']);
			foreach($bap as $key => $value) {
				$this->type("name=BaptismRecord[$key]", $value);
			}
			$this->clickAndWait("//input[@value='Create']");
			foreach($bap as $key => $value) {
				if (preg_match('/^sex$/', $key)) {
					$this->assertTextPresent(FieldNames::value('sex', $value));
				} else {
					$this->assertTextPresent($value);
				}
			}
			$this->clickAndWait("//input[@value='Create Certificate']");
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
