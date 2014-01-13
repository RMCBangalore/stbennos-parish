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
create table subscriptions(
	id integer primary key auto_increment,
	family_id integer,
	trans_id integer,
	yr_month varchar(7),
	constraint fk_sub_family foreign key (family_id) references families(id),
	constraint fk_sub_trans foreign key (trans_id) references transactions(id)
);
