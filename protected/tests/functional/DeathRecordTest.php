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

class DeathRecordTest extends WebTestCase
{
	protected $captureScreenshotOnFailure = TRUE;
	protected $screenshotPath = '/home/hacker/public_html/screenshots';
	protected $screenshotUrl = 'http://localhost/~hacker/screenshots';

	public $fixtures = array(
		'families' => 'Families',
		'people' => 'People',
		'deaths' => 'DeathRecord',
	);

	public function testCreate()
	{
		$this->loginAs('pastor', 'pastor');
		$deaths = array(
			array(
				'death_dt' => '12/12/2013',
				'cause' => 'Old age',
				'fname' => 'Simon',
				'lname' => 'Malone',
				'age' => 89,
				'profession' => 'Blacksmith',
				'buried_dt' => '14/12/2013',
				'minister' => 'Fr. John Rose',
				'burial_place' => 'Kalpalli cemetery',
				'residence' => 'Bangalore',
				'community' => 'Bengali',
				'parents_relatives' => 'Jacqueline Malone',
				'sacrament' => 'Viaticum'
			),
			array(
				'death_dt' => '04/01/2014',
				'cause' => 'Old age',
				'fname' => 'Carl',
				'profession' => 'Artisan',
				'buried_dt' => '10/01/2014',
				'minister' => 'Fr. Lee Roche',
				'burial_place' => 'Kalpalli cemetery',
				'residence' => 'Lazar Road',
				'community' => 'Anglo Indian',
				'parents_relatives' => 'Wendy Lazar',
				'sacrament' => 'Confession'
			)
		);
		foreach($deaths as $death) {
			$this->open('deathRecords/create');
			if (!isset($death['lname'])) {
				$this->click("css=#member_search > img");
				sleep(2);
				$this->type("id=key", $death['fname']);
				$this->click('css=#find_match > input[name="yt0"]');
				sleep(1);
				$this->click("id=yw0_c0_0");
				sleep(1);
				$this->click("id=submitMatch");
				sleep(1);
				unset($death['fname']);
			}
			foreach($death as $key => $value) {
				if (preg_match('/^sacrament$/', $key)) {
					$this->select("name=DeathRecord[$key]", "value=$value");
				} else {
					$this->type("name=DeathRecord[$key]", $value);
				}
			}
			$this->clickAndWait("//input[@value='Create']");
			foreach($death as $key => $value) {
				$this->assertTextPresent($value);
			}
			$this->clickAndWait("//input[@value='Create Certificate']");
			foreach($death as $key => $value) {
				$this->assertTextPresent($value);
			}
			$this->assertTextPresent(date_format(new DateTime(), 'd/m/Y'));
			$this->assertElementPresent("link=Download Certificate");
		}
	}
}

?>
