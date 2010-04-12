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
        include("../bms/include/invoices.php");
        include("../bms/include/clients.php");


	#get client from selected record
	$idsArray = $_SESSION["timeentryids"];
	$querystatement = "
	    SELECT
		timeentries.clientid
	    FROM
		timeentries
	    WHERE
		timeentries.id = '$idsArray[0]'
		";

	$queryresult = $db->query($querystatement);
	$therecord = $db->fetchArray($queryresult);
	$theclientid = $therecord['clientid']; 

	#pull timeentries for that clientid
	$querystatement = "
	    SELECT
		timeentries.uuid,
		timeentries.clientid, 
		timeentries.type,
		timeentries.location,
		timeentries.equipmentdelivered,
		timeentries.equipmentprice,
		clients.firstname, 
		clients.lastname, 
		clients.company,
		clients.type as clienttype,	
		timeentries.startdate,
		concat(timeentries.startdate,' ',timeentries.starttime) as stime,
		concat(timeentries.enddate,' ',timeentries.endtime) as etime,
	        timeentries.productid,
		products.partname,
		products.unitprice,
	        60*".TIMEENTRY_BILLINGINCREMENT."*".TIMEENTRY_ROUNDINGFUNCTION."((
			unix_timestamp(
				concat(timeentries.enddate,' ',timeentries.endtime)
			) - unix_timestamp(
				concat(timeentries.startdate,' ',timeentries.starttime)
			))/60/".TIMEENTRY_BILLINGINCREMENT.")/60/60 as hours
	    FROM
	        (timeentries INNER JOIN clients ON timeentries.clientid = clients.uuid)
	        INNER JOIN products ON timeentries.productid = products.uuid
	    WHERE
	        timeentries.clientid= '$theclientid'
		AND timeentries.invoiceid = 0
		AND products.type = 'Service'
	    ORDER BY
		timeentries.startdate ASC, timeentries.starttime ASC
	        ";

	$queryresult = $db->query($querystatement);

	#get the first timeentries record
	$thetimeentry = $db->fetchArray($queryresult);
	$clientid = $thetimeentry['clientid'];

	$thetotal = 0; 
	$itemnum = 0;
	$thelist = '[';
	do {
		$thehours = $thetimeentry['hours'];
		switch($thetimeentry['location']){
			case "onsite":
				if($thehours*60 < TIMEENTRY_MINIMUMONSITE)
					$thehours = TIMEENTRY_MINIMUMONSITE/60;
				break;
			case "remote":
				if($thehours*60 < TIMEENTRY_MINIMUMREMOTE)
					$thehours = TIMEENTRY_MINIMUMREMOTE/60;
				break;
			case "phone":
				if($thehours*60 < TIMEENTRY_MINIMUMPHONE)
					$thehours = TIMEENTRY_MINIMUMPHONE/60;
				break;
			case "email":
				if($thehours*60 < TIMEENTRY_MINIMUMEMAIL)
					$thehours = TIMEENTRY_MINIMUMEMAIL/60;
				break;
		}

		$items[$itemnum]['uuid'] = $thetimeentry['uuid'];
		$items[$itemnum]['productid'] = $thetimeentry['productid'];
		$items[$itemnum]['memo'] = $thetimeentry['startdate']." ".$thetimeentry['location'];
		$items[$itemnum]['taxable'] = 0;
		$items[$itemnum]['unitweight'] = 0;
		$items[$itemnum]['unitcost'] = 0;
		$items[$itemnum]['unitprice'] = $thetimeentry['unitprice'];
		$items[$itemnum]['quantity'] = $thehours;
		$itemnum++;

		$thelist .=  '{' .
	              '"productid" : "' . $thetimeentry['productid'] . '",' .
	              '"memo" : "' . $thetimeentry['startdate']." ".$thetimeentry['location']  . '",' .
	              '"taxable" : 0,' .
	              '"unitweight" : 0,' .
	              '"unitcost" : 0,' .
	              '"unitprice" : ' . $thetimeentry['unitprice'] . ',' .
        	      '"quantity" : ' . $thehours .
	              '},';

		$thetotal += $thehours*$thetimeentry['unitprice'];

		if( $thetimeentry['equipmentdelivered'] != '' ) {

			$items[$itemnum]['uuid'] = $thetimeentry['uuid'];
			$items[$itemnum]['productid'] = 'prod:454e27b2-cf9e-47da-15dc-5e20eeb1be4d';
			$items[$itemnum]['memo'] = $thetimeentry['equipmentdelivered'];
			$items[$itemnum]['taxable'] = 0;
			$items[$itemnum]['unitweight'] = 0;
			$items[$itemnum]['unitcost'] = 0;
			$items[$itemnum]['unitprice'] = $thetimeentry['equipmentprice'];
			$items[$itemnum]['quantity'] = 1;
			$itemnum++;


			$thelist .=  '{' .
				'"productid" : "prod:454e27b2-cf9e-47da-15dc-5e20eeb1be4d",' .
		                '"memo" : "' . $thetimeentry['equipmentdelivered']  . '",' .
		                '"taxable" : 0,' .
		                '"unitweight" : 0,' .
		                '"unitcost" : 0,' .
		                '"unitprice" : ' . $thetimeentry['equipmentprice'] . ',' .
		                '"quantity" : 1'.
		                '},';

			$thetotal += $thetimeentry['equipmentprice'];
	
		}

	} while($thetimeentry = $db->fetchArray($queryresult));

	$thelist = preg_replace("/,$/",'',$thelist);
	$thelist .= ']';

	# instantiate and fill out invoice
	$thetable = new invoices($db,"tbld:62fe599d-c18f-3674-9e54-b62c2d6b1883");
	
	$variables = $thetable->getDefaults();

	$variables['orderdate'] = date('m/d/Y');
	$variables['ccnumber_old'] = '';
	$variables['ccexpiration_old'] = '';
	$variables['ccverification_old'] = '';
	$variables['accountnumber_old'] = '';
	$variables['routingnumber_old'] = '';
	$variables['totaltni'] = $variables['totalti']	= $variables['amountdue'] = $thetotal;
	$variables['clientid'] = $theclientid;
	$variables['clienttype'] = $thetimeentry['clienttype']; 

        $theclient = new clients($db,"tbld:6d290174-8b73-e199-fe6c-bcf3d4b61083");
	$clientinfo = $theclient->getRecord($theclientid,true);

        $variables['address1'] = $clientinfo['address1'];
        $variables['address2'] = $clientinfo['address2'];
        $variables['city'] = $clientinfo['city'];
        $variables['state'] = $clientinfo['state'];
        $variables['postalcode'] = $clientinfo['postalcode'];
        $variables['country'] = $clientinfo['country'];
        #$variables[''] = $clientinfo[''];

	$variables = $thetable->prepareVariables($variables);
        $errorArray = $thetable->verifyVariables($variables);
	$newid = $thetable->insertRecord($variables);  

	# instantiate and fill out lineitems
	$thetable->lineitems = new lineitems($db,$newid);

	# attach lineitems to invoice
	$thetable->lineitems->set($items);

	# mark timeentries as invoiced by setting the invoiceid
	$querystatement = "	
	    UPDATE 
		timeentries
	    SET 
		invoiceid = '$newid'
	    WHERE
		invoiceid = 0 and clientid = '$theclientid';
		";

	$queryresult = $db->query($querystatement);

	header("location:".APP_PATH."modules/bms/invoices_addedit.php?id=".$newid);

?>
