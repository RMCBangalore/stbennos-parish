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

class MassBookingTest extends WebTestCase
{
	protected $captureScreenshotOnFailure = TRUE;
	protected $screenshotPath = '/home/hacker/public_html/screenshots';
	protected $screenshotUrl = 'http://localhost/~hacker/screenshots';

	public $fixtures = array(
		'masses' => 'MassSchedule'
	);

	public function testCreate()
	{
		$this->loginAs('pastor', 'pastor');
		$mbs = array(
			array(
				'mass_dt' => '02/03/2014',
				'mass_id' => 1,
				'booked_by' => 'Agnes Selvarani',
				'type' => 'R.I.P',
				'intention' => 'Maria Selvarani'
			),
			array(
				'mass_dt' => '03/03/2014',
				'mass_id' => 8,
				'booked_by' => 'Adrian Browne',
				'type' => 'Thanksgiving',
				'intention' => 'finding a good job'
			),
			array(
				'mass_dt' => '26/03/2014',
				'mass_id' => 12,
				'booked_by' => 'Sheldon Cooper',
				'type' => 'Anniversary',
				'intention' => 'Mark and Sally Cooper'
			),
		);
		foreach($mbs as $mb) {
			$this->open('massBooking/create');
			foreach($mb as $key => $value) {
				$loc = "name=MassBooking[$key]";
				$this->assertElementPresent($loc);
				if (preg_match('/^(?:mass_id|type)$/', $key)) {
					$this->select("name=MassBooking[$key]", "value=$value");
				} else {
					$this->type("name=MassBooking[$key]", $value);
				}
			}
			$this->clickAndWait("//input[@value='Create']");

			/* Should now be at view page */
			foreach($mb as $value) {
				if ($value) {
					$this->assertTextPresent($value);
				}
			}
		}
	}

}

?>
