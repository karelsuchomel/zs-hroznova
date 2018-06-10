<?php

function timeSincePosted ( $timeDifference)
{
	// if post younger than 24 hours -> display hours
	if ( $timeDifference < 86400 ) {
		$hours = floor($timeDifference / 3600);
		if ( $hours <= 1 ) {
			return "před hodinou";	
		} else {
			return "před " . $hours . " hodinami";
		}
		
	// if post younger than 7 days -> display days
	} else if ( $timeDifference < 604800 ) {
		$days = floor($timeDifference / 86400);
		if ( $days <= 1 ) {
			return "včera";	
		} else {
			return "před " . $days . " dny";
		}

	// if post younger than 30 days -> display weeks
	} else if ( $timeDifference < 2592000) {
		$weeks = floor($timeDifference / 604800);
		if ( $weeks <= 1 ) {
			return "před týdnem";	
		} else {
			return "před " . $weeks . " týdny";
		}

	// if post younger than 12 months -> display months
	} else if ( $timeDifference < 31557600) {
		$months = floor($timeDifference / 2592000);
		if ( $months <= 1 ) {
			return "před měsícem";	
		} else {
			return "před " . $months . " měsíci";
		}

	// if the post is older than a year
	} else {
		$years = floor($timeDifference / 31557600);
		if ( $years <= 1 ) {
			return "před rokem";	
		} else if ( $years < 5 ) {
			return "před " . $years . " roky";
		} else {
			return "před " . $years . " lety";
		}
	}
}