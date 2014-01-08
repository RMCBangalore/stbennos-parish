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

class ConfirmationRecordTest extends WebTestCase
{
	protected $captureScreenshotOnFailure = TRUE;
	protected $screenshotPath = '/home/hacker/public_html/screenshots';
	protected $screenshotUrl = 'http://localhost/~hacker/screenshots';

	public $fixtures = array(
		'families' => 'Families',
		'people' => 'People',
		'confirmations' => 'ConfirmationRecord',
	);

	public function testCreateNonParishioner()
	{
		$this->loginAs('pastor', 'pastor');
		$confs = array(
			array(
				'name' => 'Antony Jacob',
				'church' => 'St. Rocks Church',
				'confirmation_dt' => '04/04/2014',
				'dob' => '05/12/1995',
				'baptism_dt' => '12/12/1995',
				'baptism_place' => 'Bangalore',
				'parents_name' => 'Lambert Jacob',
				'godparent_name' => 'Damien Prince',
				'residence' => 'Bangalore',
				'minister' => 'Fr. Manuel Pimenta'
			),
			array(
				'name' => 'Samuel Davies',
				'church' => 'St. Rocks Church',
				'confirmation_dt' => '11/05/1999',
				'dob' => '11/10/1986',
				'baptism_dt' => '22/10/1986',
				'baptism_place' => 'Bangalore',
				'parents_name' => 'Robert Davies',
				'residence' => 'Bangalore',
				'minister' => 'Fr. Noel Rodricks',
			),
		);
		foreach($confs as $conf) {
			$this->open('confirmationRecords/create');
			foreach($conf as $key => $value) {
				$this->type("name=ConfirmationRecord[$key]", $value);
			}
			$this->clickAndWait("//input[@value='Create']");
			foreach($conf as $key => $value) {
				$this->assertTextPresent($value);
			}
		}
	}
}

?>
