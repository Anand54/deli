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

CREATE TABLE IF NOT EXISTS category (
    id bigint primary key,
    category_name varchar(255) not null,
    category_type varchar(255) not null,
    category_id varchar(255) unique not null,
    path varchar(255) not null,
    image varchar(255) not null,
    remarks varchar(255)
    );

CREATE TABLE IF NOT EXISTS products(
    id bigint primary key,
    product_name varchar(255) not null,
    category_id varchar(255) not null,
    actual_Price decimal(15,2) not null,
    sell_Price decimal(15,2) not null,
    retailer_price decimal(10,2) not null,
    wholesaler_price decimal(10,2) NOT null,
    dealer_price decimal(10,2) NOT null,
    img_path varchar(255) not null,
    primary_image varchar(255) not null,
    secondary_image varchar(255) not  null,
    remarks varchar(255),
    foreign key (category_id) references category(category_id)
    );
