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

if(class_exists("phpbmsTable")){
	class timeentries extends phpbmsTable{

		function showClientType($uuid){

			if($uuid){

				$querystatement="
					SELECT
						type
					FROM
						clients
					WHERE
						`uuid`='".mysql_real_escape_string($uuid)."'
				";

				$therecord = $this->db->fetchArray($this->db->query($querystatement));

			} else {

				$therecord["type"] = "client";

			}//endif id

			?><input type="hidden" id="clienttype" name="clienttype"  <?php echo 'value="'.$therecord["type"].'"'?> /><?php

		}//end method


		// CLASS OVERRIDES ===================================================================

		function getDefaults(){
			$therecord = parent::getDefaults();

			$therecord["salesmanagerid"]=$_SESSION['userinfo']['uuid'];

			return $therecord;
		}


		function prepareVariables($variables){

			return $variables;
		}


		function updateRecord($variables, $modifiedby = NULL, $useUuid = false){

			$variables = $this->prepareVariables($variables);

			return parent::updateRecord($variables, $modifiedby, $useUuid);
		}


		function insertRecord($variables, $createdby = NULL, $overrideID = false, $replace = false, $useUuid = false){

			$variables = $this->prepareVariables($variables);

			return parent::insertRecord($variables, $createdby, $overrideID, $replace, $useUuid);
		}//end method

	}//end class
}//end if

if(class_exists("searchFunctions")){
	class timeentriesSearchFunctions extends searchFunctions{

		function createInvoice(){

			//passed variable is array timeentries, first one will be used
			// to select then client and their billable timeentries
			$whereclause = $this->buildWhereClause();

                        $_SESSION["timeentryids"]= $this->idsArray;
                        goURL("modules/timeentry/createinvoice.php");

			return $message;
		}//end method

	}//end class
}//end if
?>
