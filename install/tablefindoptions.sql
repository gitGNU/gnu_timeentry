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
INSERT INTO `tablefindoptions` (`tabledefid`, `name`, `search`, `displayorder`, `roleid`) VALUES('tbld:26b04a81-35b5-5c64-8500-c25cb80653a6', 'Time Entries - Not Billed', 'timeentries.invoiceid = 0', 0, '');
INSERT INTO `tablefindoptions` (`tabledefid`, `name`, `search`, `displayorder`, `roleid`) VALUES('tbld:26b04a81-35b5-5c64-8500-c25cb80653a6', 'Time Entries - Billed', 'timeentries.invoiceid != 0', 1, '');
INSERT INTO `tablefindoptions` (`tabledefid`, `name`, `search`, `displayorder`, `roleid`) VALUES('tbld:26b04a81-35b5-5c64-8500-c25cb80653a6', 'Time Entries - All', '1', 2, '');
