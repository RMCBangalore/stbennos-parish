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

class FamiliesTest extends CDbTestCase
{
	public $fixtures = array(
		'families' => 'Families',
		'people' => 'People',
	);

	public function testSave()
	{
		$family = new Families;
		$family->setAttributes(array(
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
			'photo' => 'DSC_1428.jpg',
			'reg_date' => '11/03/1999',
			'disabled' => '0',
		), false);
		$this->assertTrue($family->save(false));
		$family = Families::model()->findByPk($family->id);
		$this->assertTrue($family instanceOf Families);
		$this->assertEquals($family->fid, 'A3');
		$this->assertEquals($family->addr_nm, '38');
		$this->searchIt();
	}

	public function testFindByFid()
	{
		$family = Families::model()->findByAttributes(array('fid' => 'A1'));
		$this->assertTrue($family instanceOf Families);
		$this->assertEquals($family->addr_nm, '67, Terroy');
		$this->assertEquals($family->phone, '25805730');
		$this->assertEquals($family->husband_id, 1);
		$this->assertEquals($family->head_name, 'Robert Monteiro');
	}

	public function searchIt()
	{
		$family = new Families;
		$family->setAttributes(array(
			'reg_yrs' => 15
		));
		$dp = $family->search();
		$dp->setPagination(false);
		$di = new CDataProviderIterator($dp);
		$fids = array();
		foreach($di as $record) {
			$fids[] = $record->fid;
		}
		$this->assertEquals($fids, array('A1', 'A3'));
	}
}

?>
