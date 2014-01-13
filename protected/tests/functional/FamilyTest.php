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

class FamilyTest extends WebTestCase
{
	protected $captureScreenshotOnFailure = TRUE;
	protected $screenshotPath = '/home/hacker/public_html/screenshots';
	protected $screenshotUrl = 'http://localhost/~hacker/screenshots';

	public $fixtures = array(
		'families' => 'Families',
		'people' => 'People',
	);

	public function testView()
	{
		$this->loginAs('pastor', 'pastor');
		$this->open('family/1');
		$this->assertTextPresent('Husband');
		$this->assertTextPresent('Wife');
		for($i = 1; $i <= 2; ++$i) {
			$this->assertTextPresent("Child $i");
		}
	}

	public function testCreate()
	{
		$this->loginAs('pastor', 'pastor');
		$this->open('family/create');
		$family = array(
			'fid' => 'A3',
			'addr_nm' => '38',
			'addr_stt' => '2nd Cross',
			'addr_area' => 'Lingarajpuram',
			'addr_pin' => '560084',
			'phone' => '25803827',
			'mobile' => '',
			'email' => '',
			'zone' => '1',
			'bpl_card' => '0',
			'marriage_church' => 'St Francis Xavier Cathedral, Bangalore',
			'marriage_date' => '21/08/1985',
			'marriage_type' => '1',
			'marriage_status' => '1',
			'monthly_income' => '2',
			'reg_date' => '11/03/1999',
		);
		foreach($family as $key => $value) {
			if (preg_match('/^(?:zone|bpl_card|marriage_(?:type|status)|monthly_income)$/', $key)) {
				$this->select("name=Families[$key]", "value=$value");
			} else {
				$this->type("name=Families[$key]", $value);
			}
		}
		$this->clickAndWait("//input[@value='Create']");
		$this->assertTextPresent('Husband');
		$people = array(
			array(
				'fname' =>	'John',
				'lname' =>	'Solomon',
				'sex' =>	1,
				'domicile_status' =>	1,
				'dob' =>	'02/11/1961',
				'education' =>	3,
				'profession' =>	'HR',
				'occupation' =>	'HR Manager',
				'mobile' =>	'',
				'lang_pri' =>	1,
				'lang_lit' =>	1,
				'lang_edu' =>	1,
				'rite' =>	'',
				'baptism_dt' =>	'14/11/1961',
				'baptism_church' =>	'Francis Xavier Cathedral',
				'baptism_place' =>	'Bangalore',
				'god_parents' =>	'Mark & Mercy Matthew',
				'first_comm_dt' =>	'29/03/1969',
				'confirmation_dt' =>	'24/07/1972',
				'marriage_dt' =>	'21/08/1985',
				'cemetery_church' =>	'',
				'role' =>	'husband',
				'special_skill' =>	'',
			),
			array(
				'fname' =>	'Celine',
				'lname' =>	'Solomon',
				'sex' =>	2,
				'domicile_status' =>	1,
				'dob' =>	'26/01/1964',
				'education' =>	3,
				'profession' =>	'Banking',
				'occupation' =>	'Banker',
				'mobile' =>	'',
				'lang_pri' =>	1,
				'lang_lit' =>	1,
				'lang_edu' =>	1,
				'rite' =>	'',
				'baptism_dt' =>	'02/02/1964',
				'baptism_church' =>	'Francis Xavier Cathedral',
				'baptism_place' =>	'Bangalore',
				'god_parents' =>	'ToDo',
				'first_comm_dt' =>	'17/02/1970',
				'confirmation_dt' =>	'19/07/1976',
				'marriage_dt' =>	'21/08/1985',
				'cemetery_church' =>	'',
				'role' =>	'wife',
				'special_skill' =>	'',
			),
			null,
			null,
			array(
				'fname' =>	'Santiago',
				'lname' =>	'Solomon',
				'sex' =>	1,
				'domicile_status' =>	1,
				'dob' =>	'16/05/1987',
				'education' =>	3,
				'profession' =>	'',
				'occupation' =>	'',
				'mobile' =>	8287356731,
				'lang_pri' =>	1,
				'lang_lit' =>	1,
				'lang_edu' =>	1,
				'rite' =>	'',
				'baptism_dt' =>	'25/05/1987',
				'baptism_church' =>	'Holy Ghost Church',
				'baptism_place' =>	'Bangalore',
				'god_parents' =>	'ToDo',
				'cemetery_church' =>	'',
				'role' =>	'child',
				'special_skill' =>	'',
			),
			array(
				'fname' =>	'Mary',
				'lname' =>	'Solomon',
				'sex' =>	2,
				'domicile_status' =>	1,
				'dob' =>	'16/05/1987',
				'education' =>	3,
				'profession' =>	'',
				'occupation' =>	'',
				'mobile' =>	'',
				'lang_pri' =>	1,
				'lang_lit' =>	1,
				'lang_edu' =>	1,
				'rite' =>	'',
				'baptism_dt' =>	'25/05/1987',
				'baptism_church' =>	'Holy Ghost Church',
				'baptism_place' =>	'Bangalore',
				'god_parents' =>	'ToDo',
				'marriage_dt' =>	'05/09/2013',
				'cemetery_church' =>	'',
				'role' =>	'child',
				'special_skill' =>	'',
			),
			array(
				'fname' =>	'Mark',
				'lname' =>	'Solomon',
				'sex' =>	1,
				'domicile_status' =>	1,
				'dob' =>	'14/09/1989',
				'education' =>	3,
				'profession' =>	'',
				'occupation' =>	'',
				'mobile' =>	'',
				'lang_pri' =>	1,
				'lang_lit' =>	1,
				'lang_edu' =>	1,
				'rite' =>	'',
				'baptism_dt' =>	'27/09/1989',
				'baptism_church' =>	'St Rocks',
				'baptism_place' =>	'Bangalore',
				'god_parents' =>	'ToDo',
				'first_comm_dt' =>	'24/06/2001',
				'confirmation_dt' =>	'22/08/2008',
				'cemetery_church' =>	'',
				'role' =>	'child',
				'special_skill' =>	'',
			),
		);
		$rc = array();
		$members = array();
		foreach($people as $member) {
			if (!isset($member)) {
				$this->clickAndWait("link=Skip");
				continue;
			}
			$role = $member['role'];
			unset($member['role']);
			if (preg_match('/^(?:child|dependent)$/',$role)) {
				if (!isset($rc[$role])) {
					$rc[$role] = 0;
				} else {
					$rc[$role]++;
				}
				$members[ucfirst($role) . " " . ($rc[$role] + 1)] = $member;
				$role = $role . "][" . $rc[$role];
			} else {
				$members[ucfirst($role)] = $member;
			}
			$this->assertElementPresent("name=People[$role][fname]");
			foreach($member as $key => $value) {
				$fld = "name=People[$role][$key]";
				if (preg_match('/^(?:sex|domicile_status|education|lang_(?:pri|lit|edu))$/', $key)) {
					$this->select($fld, "value=$value");
				} else {
					$this->type($fld, $value);
				}
			}
			$this->clickAndWait("//input[@value='Save']");
		}

		/* Should now be at view page */
		$this->assertTextPresent($family['reg_date']);
		$this->assertTextPresent($family['fid']);
		$this->assertTextPresent($family['addr_nm']);
		$this->assertTextPresent($family['addr_stt']);
		$this->assertTextPresent($family['addr_area']);
		$this->assertTextPresent($family['addr_pin']);
		$this->assertTextPresent($family['phone']);
		$this->assertTextPresent($family['marriage_church']);
		$this->assertTextPresent($family['marriage_date']);
		$this->_testMember('Husband', $members['Husband']);
		$this->_testMember('Wife', $members['Wife']);
		for($i = 1; $i <= 3; ++$i) {
			$tab = "Child $i";
			$this->_testMember($tab, $members[$tab]);
		}
		$this->_testMoreChildren();
	}

	protected function _testMember($role, $member)
	{
		$this->assertTextPresent($role);
		$this->click("link=$role");
		$this->assertTextPresent($member['dob']);
		$this->assertTextPresent($member['baptism_dt']);
		if (isset($member['marriage_dt'])) {
			$this->assertTextPresent($member['marriage_dt']);
		}
		$url = $this->getLocation();
		$this->clickAndWait("link=" . $member['fname'] . ' ' . $member['lname'] . ': #*');
		foreach(array('mobile', 'profession', 'occupation', 'baptism_church', 'baptism_place', 'god_parents', 'cemetery_church') as $fld) {
			if (isset($member[$fld]) and $member[$fld]) {
				$this->assertTextPresent($member[$fld]);
			}
		}
		foreach(array('lang_pri', 'lang_lit', 'lang_edu') as $fld) {
			if (isset($member[$fld])) {
				$val = FieldNames::value('languages', $member[$fld]);
				$this->assertTextPresent($val);
			}
		}
		$this->open($url);
	}

	public function _testMoreChildren()
	{
		$this->clickAndWait("link=More Children");

		$more_children = array(
			array(
				'fname' =>	'Susanna',
				'lname' =>	'Solomon',
				'sex' =>	2,
				'domicile_status' =>	1,
				'dob' =>	'25/12/1991',
				'education' =>	3,
				'profession' =>	'',
				'occupation' =>	'',
				'mobile' =>	9284752343,
				'lang_pri' =>	1,
				'lang_lit' =>	1,
				'lang_edu' =>	1,
				'rite' =>	'',
				'baptism_dt' =>	'01/01/1992',
				'baptism_church' =>	'St. Mary\'s Basilica',
				'baptism_place' =>	'Bangalore',
				'god_parents' =>	'ToDo',
				'first_comm_dt' =>	'14/11/2003',
				'confirmation_dt' =>	'24/07/2007',
				'cemetery_church' =>	'',
			),
			array(
				'fname' =>	'Sunitha',
				'lname' =>	'Solomon',
				'sex' =>	2,
				'domicile_status' =>	1,
				'dob' =>	'14/04/1993',
				'education' =>	2,
				'profession' =>	'',
				'occupation' =>	'',
				'mobile' =>	9938248722,
				'lang_pri' =>	1,
				'lang_lit' =>	1,
				'lang_edu' =>	1,
				'rite' =>	'',
				'baptism_dt' =>	'27/04/1993',
				'baptism_church' =>	'St. Patrick\'s Church',
				'baptism_place' =>	'Bangalore',
				'god_parents' =>	'ToDo',
				'first_comm_dt' =>	'14/09/2003',
				'confirmation_dt' =>	'24/07/2007',
				'cemetery_church' =>	'',
			),
			array(
				'fname' =>	'Sally',
				'lname' =>	'Solomon',
				'sex' =>	2,
				'domicile_status' =>	1,
				'dob' =>	'15/09/1995',
				'education' =>	2,
				'profession' =>	'',
				'occupation' =>	'',
				'mobile' =>	'',
				'lang_pri' =>	1,
				'lang_lit' =>	1,
				'lang_edu' =>	1,
				'rite' =>	'',
				'baptism_dt' =>	'26/09/1995',
				'baptism_church' =>	'Resurrection Church',
				'baptism_place' =>	'Bangalore',
				'god_parents' =>	'ToDo',
				'cemetery_church' =>	'',
			),
		);

		$i = 0;
		foreach($more_children as $member) {
			$role = "child][$i";
			foreach($member as $key => $value) {
				$fld = "name=People[$role][$key]";
				if (preg_match('/^(?:sex|domicile_status|education|lang_(?:pri|lit|edu))$/', $key)) {
					$this->select($fld, "value=$value");
				} else {
					$this->type($fld, $value);
				}
			}
			++$i;
			$this->click("link=Child " . ($i+4));
		}
		$this->clickAndWait("//input[@value='Save']");
		$this->clickAndWait("link=View Family");
		for($i = 0; $i < count($more_children); ++$i) {
			$this->_testMember("Child " . ($i+4), $more_children[$i]);
		}
	}
}

?>
