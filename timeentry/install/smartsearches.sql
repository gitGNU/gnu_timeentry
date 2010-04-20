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
INSERT INTO `smartsearches` (`uuid`, `name`, `fromclause`, `valuefield`, `displayfield`, `secondaryfield`, `classfield`, `searchfields`, `filterclause`, `rolefield`, `tabledefid`, `moduleid`, `createdby`, `creationdate`, `modifiedby`, `modifieddate`) VALUES('smrt:cf924769-f7f2-4633-beef-4451f328b057', 'Pick Service', 'products', '`products`.`uuid`', 'CONCAT(products.partnumber,IF(products.partname != '''',  CONCAT('' :: '',products.partname),''''),'' :: $'',products.unitprice)', 'products.type', '''''', 'products.partnumber, products.partname, products.unitprice', 'products.inactive = 0 AND products.status = ''In Stock'' AND products.type = ''Service''', NULL, 'tbld:7a9e87ed-d165-c4a4-d9b9-0a4adc3c5a34', 'mod:0abacca0-7378-0ece-8129-9185f7d1273c', 2, NOW(), 2, NOW());
