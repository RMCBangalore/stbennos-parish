--
-- This file is part of Alive Parish Software
--
-- Alive Parish - software to manage tomorrow's parish
-- Copyright (C) 2013  Redemptorist Media Center
--
-- Alive Parish Software is free software: you can redistribute it
-- and/or modify it under the terms of the GNU General Public License as
-- published by the Free Software Foundation, either version 3 of the
-- License, or (at your option) any later version.
--
-- Alive Parish Software is distributed in the hope that it will
-- be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
-- of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
-- GNU General Public License for more details.
--
-- You should have received a copy of the GNU General Public License
-- along with this program.  If not, see <http://www.gnu.org/licenses/>.
--
create table transactions(
	id integer primary key auto_increment,
	type varchar(10),
	descr varchar(99),
	created datetime,
	creator integer,
	amount double
);

create table mass_bookings(
	id integer primary key auto_increment,
	mass_id integer,
	booked_by varchar(99),
	intention varchar(99),
	trans_id integer,
	constraint mass_bookings_mass foreign key (mass_id) references masses(id),
	constraint mass_bookings_trans foreign key (trans_id) references transactions(id)
);

