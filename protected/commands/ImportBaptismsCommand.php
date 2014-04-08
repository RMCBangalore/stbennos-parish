<?php

function dateconv($dt) {
	preg_match('/(\d{4})[-\/](\d\d?)[-\/](\d\d?)/', $dt, $m);
	if (count($m) < 3) throw new Exception("Not a valid date format: $dt");
	$res = sprintf("%02d/%02d/%04d", $m[3], $m[2], $m[1]);
#	$res = sprintf("%04d-%02d-%02d", $m[1], $m[2], $m[3]);
	return $res;
}

class ImportBaptismsCommand extends CConsoleCommand
{
	public function actionIndex($file) {
		$rfile = preg_replace('/\.csv$/', '-rej.csv', $file);
		if (($rej_fh = fopen($rfile, 'w')) === FALSE) {
			echo "File $rfile cannot be opened in write mode. Do you have write permissions?";
			echo "Printing rejected records to STDOUT";
			$rej_fh = STDOUT;
		}
		if (($fh = fopen($file, 'r')) !== FALSE) {
			$proc = false;
			$rej = 0;
			$num = 0;
			while (($data = fgetcsv($fh, 1000)) !== FALSE) {
				if ($proc) {
					++$num;
					try {
						$rec = new BaptismRecord;
						$rec->name = $data[0];
						$dob = dateconv($data[1]);
						$rec->dob = $dob;
						$rec->baptism_dt = dateconv($data[2]);
						$rec->baptism_place = $data[3];
						if (preg_match('/^m/i', $data[4])) {
							$rec->sex = 1;
						} else {
							$rec->sex = 2;
						}
						$rec->residence = $data[5];
						$rec->mother_tongue = $data[6];
						$rec->fathers_name = $data[7];
						$rec->mothers_name = $data[8];
						$rec->godfathers_name = $data[9];
						$rec->godmothers_name = $data[10];
						$rec->minister = $data[11];
						if (!$rec->save()) {
							fputcsv($rej_fh, $data);
							++$rej;
						}
					}
					catch (Exception $e) {
						echo "Caught exception Record #$num: " . $e->getMessage() . ". Saved to rejects file\n";
						fputcsv($rej_fh, $data);
						++$rej;
					}
				} else {
					$proc = true;
				}
			}
		}
		fclose($fh);
		echo "Import complete. Total records: $num, success: " . ($num - $rej) . ", rejected: $rej.\nRejects saved to: $rfile\n";
	}
}

