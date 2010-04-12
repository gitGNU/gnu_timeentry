<?php
/*
    Copyright 2010 David Sterry, Sterry IT, LLC

    This file is part of Time Entry for phpBMS.

    Time Entry is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Time Entry is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Time Entry.  If not, see <http://www.gnu.org/licenses/>.
*/

class timeentryUpdate{

    function updateSettings($variables){

	if(!isset($variables["timeentry_billingincrement"]))
		$variables["timeentry_billingincrement"] = 15;
	if(!isset($variables["timeentry_roundingfunction"]))
		$variables["timeentry_roundingfunction"] = 'round';
	if(!isset($variables["timeentry_minimumonsite"]))
		$variables["timeentry_minimumonsite"] = 60;
	if(!isset($variables["timeentry_minimumremote"]))
		$variables["timeentry_minimumremote"] = 15;
	if(!isset($variables["timeentry_minimumphone"]))
		$variables["timeentry_minimumphone"] = 15;
	if(!isset($variables["timeentry_minimumemail"]))
		$variables["timeentry_minimumemail"] = 15;

        return $variables;
    }//end function

}//end class


class timeentryDisplay{

		function getFields($therecord){

			global $db;

			$theinput = new inputField("timeentry_billingincrement",$therecord["timeentry_billingincrement"],"billing increment");
			$fields[] = $theinput;

			$theinput = new inputBasicList("timeentry_roundingfunction",$therecord["timeentry_roundingfunction"],
					array("round"=>"round","ceiling"=>"ceiling","floor"=>"floor"),"time rounding function");
			$fields[] = $theinput;
			
			$theinput = new inputField("timeentry_minimumonsite",$therecord["timeentry_minimumonsite"],"minimum onsite time");
			$fields[] = $theinput;

			$theinput = new inputField("timeentry_minimumremote",$therecord["timeentry_minimumremote"],"minimum remote time");
			$fields[] = $theinput;

			$theinput = new inputField("timeentry_minimumphone",$therecord["timeentry_minimumphone"],"minimum phone time");
			$fields[] = $theinput;

			$theinput = new inputField("timeentry_minimumemail",$therecord["timeentry_minimumemail"],"minimum email time");
			$fields[] = $theinput;

			return $fields;
		}//end method --getFields--

		function display($theform,$therecord){
?>
<div class="moduleTab" title="Time Entry">
<fieldset>
	<legend>Main</legend>

	<p>
		<span class="notes">
			The following settings affect how an hourly(not flat-fee) time entry is converted into an invoice lineitem. Different minimum times can be set for onsite, remote, phone and email.
		</span>
	</p>

	<p>
		<?php echo $theform->showField("timeentry_billingincrement");?>
		<br/>
		<span class="notes">
			In minutes.
		</span>
	</p>
	<p>
		<?php echo $theform->showField("timeentry_roundingfunction");?>
		<br/>
		<span class="notes">
			Round returns the nearest billing increment, cieling rounds up, and floor rounds down. For a 68 minute appointment with a 15 minute billing increment: round returns 75 minutes, cieling 75 minutes, and floor 60 minutes.
		</span>
	</p>
	<p>
		<?php echo $theform->showField("timeentry_minimumonsite");?>
	</p>
	<p>
		<?php echo $theform->showField("timeentry_minimumremote");?>
	</p>
	<p>
		<?php echo $theform->showField("timeentry_minimumphone");?>
	</p>
	<p>
		<?php echo $theform->showField("timeentry_minimumphone");?>
	</p>

    </fieldset>
    <p class="updateButtonP"><button type="button" class="Buttons UpdateButtons">save</button></p>
</div>

<?php
		}//end method
	}//end class
?>
