DROP DATABASE IF EXISTS delinepal;
CREATE database IF not exists delinepal;
use delinepal;

CREATE TABLE IF NOT EXISTS admin(
    `id` bigint PRIMARY key,
    `active_state` boolean default 0,
    `username` varchar(255) NOT null,
    `email` varchar(255) NOT null,
    `admin_pass` varchar(255) not null,
    `superAdmin` boolean default 0,
    `admin` boolean default 0,
    `remarks` varchar(255)
    );
    INSERT INTO `admin`(`id`,`active_state`,`username`, `email`, `admin_pass`,`superAdmin`, `remarks`) VALUES (1,1,'admin','admin@gmail.com','admin23@#$',1,'active');

CREATE TABLE IF NOT EXISTS users(
    id bigint primary key,
    username varchar(255),
    email varchar(255),
    phone varchar(255),
    pass varchar(255),
    remarks varchar(255)
    );

CREATE TABLE IF NOT EXISTS product(
   id bigint PRIMARY KEY,
   categoryID bigint not null,
   pCode bigint NOT NULL,
   product varchar(255) NOT NULL,
   unit varchar(255) NOT NULL,
   availableQty varchar(255) NOT NULL,
   rate varchar(255) NOT NULL,
   pStatus varchar(255) NOT NULL,
   FOREIGN KEY (categoryID) REFERENCES category(id)
);
CREATE TABLE IF NOT EXISTS category(
      id bigint PRIMARY KEY,
      pGroup varchar(255) NOT NULL,
      remarks varchar(255)
);

CREATE TABLE `vendor_users` (
  `id` bigint PRIMARY KEY NOT NULL,
  `active_state` tinyint(1) DEFAULT '1',
  `user_type` varchar(25) NOT NULL,
  `vendor_company_name` varchar(255) NOT NULL,
  `vendor_email` varchar(255) NOT NULL,
  `vendor_pass` varchar(255) NOT NULL,
  `vendor_contact` varchar(255) NOT NULL,
  `vendor_pan` varchar(255) DEFAULT '0',
  `vendor_vat` varchar(255)  DEFAULT '0',
  `discountPercent` varchar(255) DEFAULT '0',
  `vendor_address` varchar(255) NOT NULL,
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `deactivate_date` datetime DEFAULT NULL,
  `remarks` varchar(1000) DEFAULT NULL
);


