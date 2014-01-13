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
class ImageSizeValidator extends CValidator {
	public $maxWidth = 600;
	public $maxHeight = 450;
	public function validateAttribute($object, $attribute) {
        $class = get_class($object);
        $files = $_FILES[$class];
        $filename = $files['name'][$attribute];
        if (isset($filename) and '' != $filename) {
            $tmp_path = $files['tmp_name'][$attribute];
            if (isset($tmp_path) and '' != $tmp_path) {
                list($width, $height) = getimagesize($tmp_path);
                if ($width > $this->maxWidth or $height > $this->maxHeight) {
                    $this->addError($object, $attribute, "Uploaded image should not be larger than {$this->maxWidth}x{$this->maxHeight} pixels");
                }
            }
        }
	}	
}
?>
