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
create table deaths(
    id  integer primary key auto_increment,
    death_dt date not null,
    cause varchar(100),
    fname varchar(50),
    lname varchar(25),
    age float,
    profession varchar(25),
    buried_dt date,
    minister varchar(75),
    burial_place varchar(25)
);

create table death_certs(
    id integer primary key auto_increment,
    death_id integer not null,
    cert_dt date,
    CONSTRAINT death_cert_death FOREIGN KEY (death_id) REFERENCES deaths(id)
);

