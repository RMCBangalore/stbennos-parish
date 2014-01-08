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

class MarriageRecordTest extends WebTestCase
{
	protected $captureScreenshotOnFailure = TRUE;
	protected $screenshotPath = '/home/hacker/public_html/screenshots';
	protected $screenshotUrl = 'http://localhost/~hacker/screenshots';

	public $fixtures = array(
		'families' => 'Families',
		'people' => 'People',
		'marriages' => 'MarriageRecord',
	);

	public function testCreate()
	{
		$this->loginAs('pastor', 'pastor');
		$marriages = array(
			array(
				'groom' => array(
					'groom_name' =>	'Johann Ryder',
					'groom_dob' =>	'05/04/1984',
					'groom_status' =>	1,
					'groom_rank_prof' =>	'Engineer',
					'groom_fathers_name' =>	'Liam Carlsen Ryder',
					'groom_mothers_name' =>	'Audrey Ryder',
					'groom_residence' =>	'Bangalore',
				),
				'bride' => array(
					'bride_name' =>	'Anabel Peron',
					'bride_dob' =>	'13/02/1985',
					'bride_status' =>	1,
					'bride_rank_prof' =>	'Housewife',
					'bride_fathers_name' =>	'Bernard Peron',
					'bride_mothers_name' =>	'Rochelle Peron',
					'bride_residence' =>	'Bangalore',
				),
				'marriage_dt' =>	'15/12/2010',
				'marriage_type' =>	1,
				'banns_licence' =>	'banns',
				'minister' =>	'Fr. Marcion',
				'witness1' =>	'Sam Lopez',
				'witness2' =>	'Gregory Peron',
				'remarks' =>	'',
			),
		);
		foreach($marriages as $marriage) {
			$this->open('marriageRecords/create');
			$groom_details = $marriage['groom'];
			foreach($groom_details as $key => $value) {
				if (preg_match('/^groom_status$/', $key)) {
					$this->select("name=MarriageRecord[$key]", "value=$value");
				} else {
					$this->type("name=MarriageRecord[$key]", $value);
				}
			}
			unset($marriage['groom']);
			$this->click('link=Bride Details');
			$bride_details = $marriage['bride'];
			foreach($bride_details as $key => $value) {
				if (preg_match('/^bride_status$/', $key)) {
					$this->select("name=MarriageRecord[$key]", "value=$value");
				} else {
					$this->type("name=MarriageRecord[$key]", $value);
				}
			}
			unset($marriage['bride']);
			foreach($marriage as $key => $value) {
				if (preg_match('/^(?:marriage_type|banns_licence)$/', $key)) {
					$this->select("name=MarriageRecord[$key]", "value=$value");
				} else {
					$this->type("name=MarriageRecord[$key]", $value);
				}
			}
			$this->clickAndWait("//input[@value='Create']");
			foreach($marriage as $key => $value) {
				if ('banns_licence' == $key) {
					$value = ucfirst($value);
				}
				if (preg_match('/^(?:marriage_type)$/', $key)) {
					$this->assertTextPresent(FieldNames::value('marriage_type', $value));
				} else {
					$this->assertTextPresent($value);
				}
			}
		}
	}
}

?>
