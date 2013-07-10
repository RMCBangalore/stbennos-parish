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

