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

function checkEndDate(){
	var startdatefield=getObjectFromID("startdate");
	var enddatefield=getObjectFromID("enddate");
	var endtimefield=getObjectFromID("endtime");
	var starttimefield=getObjectFromID("starttime");

	endtimefield.value = endtimefield.value.toUpperCase();
	endtimefield.value = endtimefield.value.toUpperCase();
	if( !endtimefield.value.match(/:/) ) {
		endtimefield.value = endtimefield.value.replace(/(\d+)/,'$1:00');	  
	}
	endtimefield.value = endtimefield.value.replace(/P$/,'PM');
	endtimefield.value = endtimefield.value.replace(/A$/,'AM');
	endtimefield.value = endtimefield.value.replace(/(\d)([a-zA-Z])/,'$1 $2');

	starttimefield.value = starttimefield.value.toUpperCase();
	if( !starttimefield.value.match(/:/) ) {
		starttimefield.value = starttimefield.value.replace(/(\d+)/,'$1:00');	  
	}
	starttimefield.value = starttimefield.value.replace(/P$/,'PM');
	starttimefield.value = starttimefield.value.replace(/A$/,'AM');
	starttimefield.value = starttimefield.value.replace(/(\d)([a-zA-Z])/,'$1 $2');

	var thestart=stringToDatetime(startdatefield.value,starttimefield.value);
	var theend=stringToDatetime(enddatefield.value,endtimefield.value);
	if (thestart>theend){
		theend=thestart;
		theend.setHours(theend.getHours()+1);
		enddatefield.value=dateToString(theend);
		if(starttimefield.value)
			endtimefield.value=timeToString(theend);
	}
}

