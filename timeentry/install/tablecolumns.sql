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
INSERT INTO `tablecolumns` (`tabledefid`, `name`, `column`, `align`, `footerquery`, `displayorder`, `sortorder`, `wrap`, `size`, `format`, `roleid`) VALUES('tbld:26b04a81-35b5-5c64-8500-c25cb80653a6', 'date', 'timeentries.startdate', 'left', '', 0, '', 0, '', 'date', '');
INSERT INTO `tablecolumns` (`tabledefid`, `name`, `column`, `align`, `footerquery`, `displayorder`, `sortorder`, `wrap`, `size`, `format`, `roleid`) VALUES('tbld:26b04a81-35b5-5c64-8500-c25cb80653a6', 'client', 'concat(clients.lastname,", ",clients.firstname,IF(clients.company != '''',concat('' - '',clients.company),''''))', 'left', '', 1, '', 0, '', NULL, '');
INSERT INTO `tablecolumns` (`tabledefid`, `name`, `column`, `align`, `footerquery`, `displayorder`, `sortorder`, `wrap`, `size`, `format`, `roleid`) VALUES('tbld:26b04a81-35b5-5c64-8500-c25cb80653a6', 'notes', 'if(length(notes)>100,concat(left(notes,100),''...''),notes)', 'left', '', 3, '', 0, '', NULL, '');
INSERT INTO `tablecolumns` (`tabledefid`, `name`, `column`, `align`, `footerquery`, `displayorder`, `sortorder`, `wrap`, `size`, `format`, `roleid`) VALUES('tbld:26b04a81-35b5-5c64-8500-c25cb80653a6', 'hours', 'TIME_FORMAT(TIMEDIFF(concat(timeentries.enddate, '' '', timeentries.endtime),\r\nconcat(timeentries.startdate, '' '',timeentries.starttime)),''%k:%i'')', 'right', '', 4, '', 0, '', NULL, '');
INSERT INTO `tablecolumns` (`tabledefid`, `name`, `column`, `align`, `footerquery`, `displayorder`, `sortorder`, `wrap`, `size`, `format`, `roleid`) VALUES('tbld:26b04a81-35b5-5c64-8500-c25cb80653a6', 'location', 'timeentries.location', 'left', '', 2, '', 0, '', NULL, '');
