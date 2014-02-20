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

class ParishController extends RController
{
	public $layout = '//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array('rights');
	}

	public function actionProfile()
	{
		$fams = Families::model()->findAll();
		$ppl = People::model()->findAll();
		$baptised = People::model()->getBaptised();
		$confirmed = People::model()->getConfirmed();
		$married = People::model()->getMarried();
		$this->render('profile', array(
			'families'	=> count($fams),
			'members'	=> count($ppl),
			'baptised'	=> count($baptised),
			'confirmed'	=> count($confirmed),
			'married'	=> count($married),
		));
	}

	public function actionSearch()
	{
		$this->forward('/family/search', false);
		$this->forward('/person/search', false);
		$this->forward('/baptismRecords/search', false);
		$this->forward('/confirmationRecords/search', false);
		$this->forward('/firstCommunionRecords/search', false);
		$this->forward('/marriageRecords/search', false);
		$this->forward('/deathRecords/search', false);
		$this->forward('/bannsRecords/search', false);
		$this->forward('/massBooking/search', false);
	}
}
