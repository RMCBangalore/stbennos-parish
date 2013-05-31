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

