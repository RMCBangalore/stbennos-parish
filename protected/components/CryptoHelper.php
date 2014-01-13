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

class CryptoHelper extends CComponent {

	/**
	 * Generate a random salt in the crypt(3) standard Blowfish format.
	 *
	 * @param int $cost Cost parameter from 4 to 31.
	 *
	 * @throws Exception on invalid cost parameter.
	 * @return string A Blowfish hash salt for use in PHP's crypt()
	 */

	public static function blowfishSalt($cost = 13)                                                                 
	{                                                                                                 
		if (!is_numeric($cost) || $cost < 4 || $cost > 31) {                                          
			throw new Exception("cost parameter must be between 4 and 31");                           
		}                                                                                             
		$rand = array();                                                                              
		for ($i = 0; $i < 8; $i += 1) {                                                               
			$rand[] = pack('S', mt_rand(0, 0xffff));                                                  
		}                                                                                             
		$rand[] = substr(microtime(), 2, 6);                                                          
		$rand = sha1(implode('', $rand), true);                                                       
		$salt = '$2a$' . sprintf('%02d', $cost) . '$';                                                
		$salt .= strtr(substr(base64_encode($rand), 0, 22), array('+' => '.'));                       
		return $salt;                                                                                 
	}  
}
