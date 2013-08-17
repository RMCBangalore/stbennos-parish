create table subscriptions(
	id integer primary key auto_increment,
	family_id integer,
	trans_id integer,
	yr_month varchar(7),
	constraint fk_sub_family foreign key (family_id) references families(id),
	constraint fk_sub_trans foreign key (trans_id) references transactions(id)
);
