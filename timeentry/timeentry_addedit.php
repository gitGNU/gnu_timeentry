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

	include("../../include/session.php");
	include("include/tables.php");
	include("include/fields.php");

	include("modules/timeentry/include/timeentries.php");


	if(!isset($_GET["backurl"]))
		$backurl = NULL;
	else{
		$backurl = $_GET["backurl"];
		if(isset($_GET["refid"]))
			$backurl .= "?refid=".$_GET["refid"];
	}

	$thetable = new timeentries($db,"tbld:26b04a81-35b5-5c64-8500-c25cb80653a6",$backurl);

	$therecord = $thetable->processAddEditPage();

	if(isset($therecord["phpbmsStatus"]))
		$statusmessage = $therecord["phpbmsStatus"];

	$pageTitle = "Time Entry Form";

	$phpbms->onload[] = "initializePage()";

	$phpbms->cssIncludes[] = "pages/client.css";
	$phpbms->jsIncludes[] = "modules/bms/javascript/client.js";
	$phpbms->jsIncludes[] = "modules/bms/javascript/invoice.js";
	$phpbms->jsIncludes[] = "modules/timeentry/javascript/timeentry.js";

	$theform = new phpbmsForm();

        $theinput = new inputSmartSearch($db, "clientid", "Pick Sales Order Client", $therecord["clientid"], "client", true, 48, 255, false);
        $theform->addField($theinput);

	$theinput = new inputSmartSearch($db, "productid", "Pick Service", $therecord["productid"], 'service', true, 48, 255, false);
	$theform->addField($theinput);
		
	$theinput = new inputSmartSearch($db, "salesmanagerid", "Pick Active User", $therecord["salesmanagerid"], "Consultant");
	$theform->addField($theinput);

	$theinput = new inputDatePicker("startdate",$therecord["startdate"], "start date" ,false, 11, 15, false);
	$theinput->setAttribute("onchange","checkEndDate();");
	$theform->addField($theinput);

	$theinput = new inputTimePicker("starttime",$therecord["starttime"], "start time" ,false,11, 15, false);
	$theinput->setAttribute("onchange","checkEndDate();");
	$theform->addField($theinput);

	$theinput = new inputDatePicker("enddate",$therecord["enddate"], "end date" ,false, 11, 15, false);
	$theinput->setAttribute("onchange","checkEndDate();");
	$theform->addField($theinput);

	$theinput = new inputTimePicker("endtime",$therecord["endtime"], "end time" ,false,11, 15, false);
	$theinput->setAttribute("onchange","checkEndDate();");
	$theform->addField($theinput);

	$theinput = new inputBasicList("location",$therecord["location"],array("onsite"=>"onsite","remote"=>"remote","phone"=>"phone","email"=>"email"), "location");
	$theform->addField($theinput);

	$theinput = new inputBasicList("type",$therecord["type"],array("hourly"=>"hourly","flat"=>"flat"), "hourly/flat");
	$theform->addField($theinput);


	$theinput = new inputField("notes",$therecord["notes"],NULL,false,NULL,25,NULL);
	$theform->addField($theinput);

	$theinput = new inputField("equipmentdelivered",$therecord["equipmentdelivered"],"equipment delivered",false,NULL,48,NULL);
	$theform->addField($theinput);

	$theinput = new inputField("equipmentprice",$therecord["equipmentprice"],"equip. price",false,NULL,10,NULL);
	$theform->addField($theinput);
		
	$theinput = new inputField("parking",$therecord["parking"],"parking",false,NULL,8,NULL);
	$theform->addField($theinput);

	$theinput = new inputField("travel",$therecord["travel"],"travel",false,NULL,8,NULL);
	$theform->addField($theinput);
	
        $theinput = new inputField("invoiceid",$therecord["invoiceid"],"invoiceid",false,NULL,20,NULL);
        $theinput->setAttribute("readonly", "readonly");
        $theinput->setAttribute("class", "uneditable");
	$theform->addField($theinput);

	$thetable->getCustomFieldInfo();
	$theform->prepCustomFields($db, $thetable->customFieldsQueryResult, $therecord);

	$theform->jsMerge();

	include("header.php");

?><div class="bodyline">
	<?php $theform->startForm($pageTitle)?>

	<div id="rightSideDiv">
	<fieldset id="fsAttributes">
		<legend>attributes</legend>
		<p>
			<label for="id">id</label><br />
			<input name="id" id="id" type="text" value="<?php echo $therecord["id"]; ?>" size="5" maxlength="5" readonly="readonly" class="uneditable" />
			<?php $theform->showField("invoiceid");?>
		</p>
	</fieldset>

	<div id="nameDiv">
		<fieldset >
			<legend>sales</legend>

			<div class="fauxP"><?php $theform->showField("salesmanagerid")?></div>

		</fieldset>
        </div>

	</div>

	<div id="leftSideDiv">

		<fieldset>
			<legend><label for="ds-clientid">client</label></legend>
			<div class="fauxP big">

                                <?php $theform->showField("clientid")?>

			</div>
		</fieldset>

		<fieldset>
			<legend><label for="ds-clientid">Service</label></legend>
			<div class="fauxP big">

				<?php $theform->showField("productid");?>
                 	</div>
		</fieldset>

		<fieldset>
			<legend><label for="ds-clientid">info</label></legend>

			<p>
				<table><tr><td><label for="startdate" id="starttext">start</label><br />
				&nbsp;<?php $theform->showField("startdate");?>
				&nbsp;<?php $theform->showField("starttime");?></td>

				<td><label for="enddate" id="endtext">end</label><br />
				&nbsp;<?php $theform->showField("enddate");?>
				&nbsp;<?php $theform->showField("endtime");?></td>
				</tr></table>
			</p>
			<p>
			<table><tr>
			<td><?php $theform->showField("location");?></td>
			<td><?php $theform->showField("type");?></td>
			</tr></table>
			</p>
			<p>
			<table><tr>
			<td><?php $theform->showField("equipmentdelivered");?></td>
			<td><?php $theform->showField("equipmentprice");?></td>
			<td><?php $theform->showField("parking");?></td>
			<td><?php $theform->showField("travel");?></td>
			</tr></table>
			</p>
			
                </fieldset>

		<fieldset>
			<legend><label for="notes">notes</label></legend>
			<p>
			<textarea name="notes" cols="150" rows="20" id="notes"><?php echo $therecord["notes"]?></textarea>
		</fieldset>
                 

		<?php
			$theform->showCustomFields($db, $thetable->customFieldsQueryResult)
		?>

	</div>
	<?php
		$theform->showGeneralInfo($phpbms,$therecord);
		$theform->endForm();
	?>
</div>
<?php include("footer.php");?>
