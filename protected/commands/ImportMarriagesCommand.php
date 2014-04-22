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

class ImportMarriagesCommand extends CConsoleCommand
{
	public function actionIndex($file) {
		$rfile = preg_replace('/\.csv$/', '-rej.csv', $file);
		if (($fh = fopen($file, 'r')) !== FALSE) {
			$proc = false;
			$rej = 0;
			$num = 0;
			while (($data = fgetcsv($fh, 1000)) !== FALSE) {
				if ($proc) {
					++$num;
					try {
						$rec = new MarriageRecord;
						$col = 0;
						$rec->marriage_dt = FormatHelper::dateConv($data[$col++]);
						$rec->groom_name = $data[$col++];
						$rec->groom_dob = FormatHelper::dateConv($data[$col++]);
						try {
							$rec->groom_baptism_dt = FormatHelper::dateConv($data[$col++]);
						} catch (Exception $e) {}
						$rec->groom_status = FieldNames::find_value('marital_status', $data[$col++]);
						$rec->groom_rank_prof = $data[$col++];
						$rec->groom_fathers_name = $data[$col++];
						$rec->groom_mothers_name = $data[$col++];
						$rec->groom_residence = $data[$col++];
						$rec->bride_name = $data[$col++];
						$rec->bride_dob = FormatHelper::dateConv($data[$col++]);
						try {
							$rec->bride_baptism_dt = FormatHelper::dateConv($data[$col++]);
						} catch (Exception $e) {}
						$rec->bride_status = FieldNames::find_value('marital_status', $data[$col++]);
						$rec->bride_rank_prof = $data[$col++];
						$rec->bride_fathers_name = $data[$col++];
						$rec->bride_mothers_name = $data[$col++];
						$rec->bride_residence = $data[$col++];
						$rec->marriage_type = FieldNames::find_value('marriage_type', $data[$col++]);
						$rec->banns_licence = $data[$col++];
						$rec->minister = $data[$col++];
						$rec->witness1 = $data[$col++];
						$rec->witness2 = $data[$col++];
						$rec->remarks = $data[$col++];
						if (!$rec->save()) {
							throw new Exception("Unable to save record");
						}
					}
					catch (Exception $e) {
						if (1 == ++$rej) {
							if (($rej_fh = fopen($rfile, 'w')) === FALSE) {
								echo "File $rfile cannot be opened in write mode. Do you have write permissions?";
								echo "Printing rejected records to STDOUT";
								$rej_fh = STDOUT;
							}
							fputcsv($rej_fh, $hdr);
						}
						echo "Caught exception Record #$num: " . $e->getMessage() . ". Saved to rejects file\n";
						fputcsv($rej_fh, $data);
					}
				} else {
					$proc = true;
					$hdr = $data;
				}
			}
		}
		fclose($fh);
		echo "Import complete. Total records: $num, success: " . ($num - $rej);
		if (isset($rej_fh)) {
			fclose($rej_fh);
			echo ", rejected: $rej.\nRejects saved to: $rfile";
		}
		echo ".\n";
	}
}

