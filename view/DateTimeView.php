<?php

class DateTimeView
{
	public function Show()
	{
		date_default_timezone_set('Europe/Stockholm');
		
		//To get 1st, 2nd, 3rd on date.
		$day = date('jS');
		
		//To get digital time display
		$time = date('H:i:s');
		
		$date = getdate();
		$timeString = "$date[weekday], the $day of $date[month] $date[year], The time is $time"; //$date[hours]:$date[minutes]:$date[seconds]";
		return '<p>' . $timeString . '</p>';
	}
}