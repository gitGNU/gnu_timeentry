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

$theModule = new installModuleAjax($this->db, $this->phpbmsSession, "../modules/timeentry/install/");
$theModule->tables = array(
			"menu",
			"modules",
			"products",
			"settings",
			"smartsearches",
			"tablecolumns",
			"tabledefs",
			"tablefindoptions",
			"tablegroupings",
			"tableoptions",
			"tablesearchablefields"
			);
