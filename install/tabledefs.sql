#
#    Copyright 2010 David Sterry, Sterry IT, LLC
#
#    This file is part of Time Entry for phpBMS.
#
#    Time Entry is free software: you can redistribute it and/or modify
#    it under the terms of the GNU General Public License as published by
#    the Free Software Foundation, either version 3 of the License, or
#    (at your option) any later version.
#
#    Time Entry is distributed in the hope that it will be useful,
#    but WITHOUT ANY WARRANTY; without even the implied warranty of
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#    GNU General Public License for more details.
#
#    You should have received a copy of the GNU General Public License
#    along with Time Entry.  If not, see <http://www.gnu.org/licenses/>.
#
INSERT INTO `tabledefs` (`uuid`, `displayname`, `prefix`, `type`, `moduleid`, `maintable`, `querytable`, `editfile`, `editroleid`, `addfile`, `addroleid`, `importfile`, `importroleid`, `searchroleid`, `advsearchroleid`, `viewsqlroleid`, `deletebutton`, `canpost`, `apiaccessible`, `hascustomfields`, `defaultwhereclause`, `defaultsortorder`, `defaultsearchtype`, `defaultcriteriafindoptions`, `defaultcriteriaselection`, `createdby`, `creationdate`, `modifiedby`, `modifieddate`) VALUES('tbld:26b04a81-35b5-5c64-8500-c25cb80653a6', 'Time Entry', 'tent', 'table', 'mod:0abacca0-7378-0ece-8129-9185f7d1273c', 'timeentries', 'timeentries INNER JOIN clients ON timeentries.clientid=clients.uuid ', 'modules/timeentry/timeentry_addedit.php', NULL, 'modules/timeentry/timeentry_addedit.php', NULL, NULL, 'Admin', NULL, 'Admin', 'Admin', 'delete', 0, 0, 0, 'timeentries.invoiceid = 0', 'timeentries.starttime desc', NULL, NULL, NULL, 2, NOW(), 2, NOW());
