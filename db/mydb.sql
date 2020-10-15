CREATE TABLE Category (id SERIAL primary key, category_name varchar(200));
CREATE TABLE Unit (id SERIAL primary key, unit_name varchar(200));
CREATE TABLE List (id SERIAL primary key, list_name varchar(200), creation_date date);
CREATE TABLE Item (id SERIAL primary key, item_description varchar(200), img_path varchar(200), current_amount int, category_id int references category(id), unit_id int references unit(id));
CREATE TABLE ListItem (id SERIAL primary key, item_id int references item(id), list_id int references list(id), buy_amount int);




insert into category (category_name) values ('Breakfast'), ('Snacks'), ('Drinks'), ('Pastas and Grains'), ('Condiments'), ('Baking Items'), ('Canned Goods'), ('Sauces and Soups'), ('Non-Food Stuffs');

insert into unit (unit_name) values ('pounds'), ('ounces'), ('grams'), ('units'), ('gallons'), ('liters'), ('boxes'), ('cans');

insert into list (list_name, creation_date) values ('Baking Items List', '10/11/2020'), ('Thanksgiving List', '11/20/2019'), ('Camping List', '06/16/2020');

insert into item (item_description, img_path, current_amount, category_id, unit_id) values ('Canned Great Northern Beans', 'images/beans.png', '3', '7', '8');

insert into item (item_description, img_path, current_amount, category_id, unit_id) values ('Whole Wheat Flour', 'images/flour.png', '50', '6', '1');

insert into item (item_description, img_path, current_amount, category_id, unit_id) values ('Gatorade', 'images/drink.png', '20', (SELECT id from category WHERE category_name='Drinks'), (SELECT id from unit WHERE unit_name='liters'));

insert into item (item_description, img_path, current_amount, category_id, unit_id) values ('Cheerios', 'images/cheerios.png', '5', (SELECT id from category WHERE category_name='Breakfast'), (SELECT id from unit WHERE unit_name='boxes'));
