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

CREATE TABLE `timeentries` (
  `id` int(11) NOT NULL auto_increment,
  `uuid` varchar(64) NOT NULL,
  `clientid` varchar(64) default NULL,
  `salesmanagerid` varchar(64) default NULL,
  `invoiceid` int(11) NOT NULL default '0',
  `startdate` date NOT NULL,
  `starttime` time NOT NULL default '00:00:00',
  `enddate` date NOT NULL,
  `endtime` time NOT NULL default '00:00:00',
  `productid` varchar(64) default NULL,
  `unitprice` double default NULL,
  `type` enum('flat','hourly') NOT NULL default 'hourly',
  `location` enum('onsite','remote','phone','email') NOT NULL default 'onsite',
  `notes` text,
  `equipmentdelivered` varchar(128) default NULL,
  `equipmentprice` double default NULL,
  `parking` double default NULL,
  `travel` double default NULL,
  `createdby` int(11) NOT NULL default '0',
  `creationdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `modifiedby` int(11) default NULL,
  `modifieddate` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `custom1` double default NULL,
  `custom2` double default NULL,
  `custom3` datetime default NULL,
  `custom4` datetime default NULL,
  `custom5` varchar(255) default NULL,
  `custom6` varchar(255) default NULL,
  `custom7` tinyint(1) default NULL,
  `custom8` tinyint(1) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uuid` (`uuid`)
) ENGINE=InnoDB;
