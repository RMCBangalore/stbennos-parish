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

	public function testCreate()
	{
		$this->loginAs('pastor', 'pastor');
		$banns = array(
			array(
				'groom_name' => 'Ronald Cornelius',
				'groom_parish' => 'St. John the Evangelist',
				'groom_parent' => 'Gerson Cornelius',
				'bride_name' => 'Sally Victor',
				'bride_parish' => 'Resurrection',
				'bride_parent' => 'Brendon Victor',
				'banns_dt1' => '05/01/2014',
				'banns_dt2' => '12/01/2014',
				'banns_dt3' => '19/01/2014',
			),
			array(
				'groom_name' => 'Luigi',
				'bride_name' => 'Nicole',
				'banns_dt1' => '09/02/2014',
				'banns_dt2' => '16/02/2014',
				'banns_dt3' => '23/02/2014',
			),
			array(
				'groom_name' => 'Gennaro',
				'bride_name' => 'Marceline Platska',
				'bride_parish' => 'Resurrection',
				'bride_parent' => 'Augustine Platska',
				'banns_dt1' => '09/02/2014',
				'banns_dt2' => '16/02/2014',
				'banns_dt3' => '23/02/2014',
			),
			array(
				'groom_name' => 'Ignace Toppo',
				'groom_parish' => 'Infant Jesus',
				'groom_parent' => 'Raguel Toppo',
				'bride_name' => 'Celine',
				'banns_dt1' => '09/02/2014',
				'banns_dt2' => '16/02/2014',
				'banns_dt3' => '23/02/2014',
			)
		);

		foreach($banns as $bann) {
			$this->open('bannsRecords/create');
			if (!isset($bann['groom_parish'])) {
				$this->click("css=#groom_search > img");
				sleep(2);
				$this->type("id=key", $bann['groom_name']);
				$this->click('css=#find_match > input[name="yt0"]');
				sleep(1);
				$this->click("id=yw0_c0_0");
				sleep(1);
				$this->click("id=submitMatch");
				sleep(1);
				unset($bann['groom_name']);
			}
			if (!isset($bann['bride_parish'])) {
				$this->click("css=#bride_search > img");
				sleep(2);
				$this->type("id=key", $bann['bride_name']);
				$this->click('css=#find_match > input[name="yt0"]');
				sleep(1);
				$this->click("id=yw0_c0_0");
				sleep(1);
				$this->click("id=submitMatch");
				sleep(1);
				unset($bann['bride_name']);
			}
			foreach($bann as $key => $value) {
				if (preg_match('/^sex$/', $key)) {
					$this->select("name=BannsRecord[$key]", "value=$value");
				} else {
					$this->type("name=BannsRecord[$key]", $value);
				}
			}
			$this->clickAndWait("//input[@value='Create']");
			foreach($bann as $key => $value) {
				if (preg_match('/^sex$/', $key)) {
					$this->assertTextPresent(FieldNames::value('sex', $value));
				} else {
					$this->assertTextPresent($value);
				}
			}
			if (isset($bann['groom_parish']) xor isset($bann['bride_parish'])) {
				$this->clickAndWait("link=Create Request Letter");
				foreach($bann as $key => $value) {
					$this->assertTextPresent($value);
				}
				$this->clickAndWait("link=View Record");
				foreach($bann as $key => $value) {
					$this->assertTextPresent($value);
				}
				$this->clickAndWait("link=Create Response Letter");
				foreach($bann as $key => $value) {
					$this->assertTextPresent($value);
				}
				$this->clickAndWait("link=View Record");
				foreach($bann as $key => $value) {
					$this->assertTextPresent($value);
				}
				$this->clickAndWait("link=Create No Impediment Letter");
				foreach($bann as $key => $value) {
					$this->assertTextPresent($value);
				}
				$this->clickAndWait("link=View Record");
				foreach($bann as $key => $value) {
					$this->assertTextPresent($value);
				}
			}
		}
	}
}

?>
