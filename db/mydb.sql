CREATE TABLE Category (id int primary key, category_name varchar(200));
CREATE TABLE Unit (id int primary key, unit_name varchar(200));
CREATE TABLE List (id int primary key, list_name varchar(200), creation_date date);
CREATE TABLE Item (id int primary key, item_description varchar(200), img_path varchar(200), current_amount int, category_id int references category(id), unit_id int references unit(id));
CREATE TABLE ListItem (id int primary key, item_id int references item(id), list_id int references list(id), buy_amount int);





