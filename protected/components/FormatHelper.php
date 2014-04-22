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

class FormatHelper extends CComponent {
	private static function _format_dmY($d, $m, $Y) {
		return sprintf("%02d/%02d/%04d", $d, $m, $Y);
	}

	public static function dateConv($dt) {
		if (preg_match('/(\d{4})[-.\/](\d\d?)[-.\/](\d\d?)/', $dt, $m)) { # Y m d
			return FormatHelper::_format_dmY($m[3], $m[2], $m[1]);
		}
		if (preg_match('/(\d\d?)[-.\/](\d\d?)[-.\/](\d{4})/', $dt, $m)) { # d m Y
			return FormatHelper::_format_dmY($m[1], $m[2], $m[3]);
		}
		if (preg_match('/(\d\d?)[-.\/](\d\d?)[-.\/](\d\d?)/', $dt, $m)) { # d m y
			$Y = ($m[3] > 20) ? 1900 + $m[3] : 2000 + $m[3];
			return FormatHelper::_format_dmY($m[1], $m[2], $Y);
		}
		throw new Exception("Not a valid date format: $dt");
	}
}
