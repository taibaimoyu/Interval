<?php
public function getInterval($dateStart,$dateEnd,$type){
	
		$dateStart  = $period_date_from;
		$dateEnd    = $period_date_to;
		$t = array();
		$firstInterval = true;
		$interval = array();
		while (strtotime($dateStart)-strtotime($dateEnd) <= 0) {
	
			switch ($type) {
				case 'day':
					$t['title'] = $dateStart;
					$t['start'] = date(('Y-m-d H:i:s'),strtotime($dateStart));
					$t['end'] = date(('Y-m-d 23:59:59'),strtotime($dateStart));
					$dateStart = date('Y-m-d',strtotime('+1 day',strtotime($dateStart)));
					break;
				case 'month':
					$t['title'] =  $dateStart;
					$t['start'] = ($firstInterval) ? $dateStart
					: date('Y-m-01 00:00:00',strtotime($dateStart));
	
					$lastInterval = (strtotime(date('Y-m',strtotime($dateStart)))-strtotime(date('Y-m',strtotime($dateEnd))) == 0);
	
					$t['end'] = ($lastInterval) ? date('Y-m-d 23:59:59',strtotime($dateEnd))
					:date('Y-m-t 23:59:59',strtotime($dateStart));
	
					$dateStart = date('Y-m-01',strtotime('+1 month',strtotime($dateStart)));
	
					$firstInterval = false;
					break;
				case 'year':
					$t['title'] =  date('Y',strtotime($dateStart));
					$t['start'] = ($firstInterval) ? date('Y-m-d 00:00:00',strtotime($dateStart))
					: date('Y-01-01 00:00:00',strtotime($dateStart));
	
					$lastInterval = (strtotime(date('Y',strtotime($dateStart)))-strtotime(date('Y',strtotime($dateEnd))) == 0);
	
					$t['end'] = ($lastInterval) ? date('Y-m-d 23:59:59',strtotime($dateEnd))
					: date('Y-12-31 23:59:59',strtotime($dateStart));
					$dateStart = date('Y-01-01',strtotime('+1 year',strtotime($dateStart)));
	
					$firstInterval = false;
					break;
			}
			$interval[$t['title']] = $t;
		}
		return $interval;
	}

?>