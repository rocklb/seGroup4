USE petstore;
CREATE TABLE users (
	user_id INT,
    username VARCHAR (50),
    user_password VARCHAR (50),
    first_name VARCHAR (50),
    last_name VARCHAR (50),
    phone VARCHAR (50),
    created DATE,
    modified DATE
);
ALTER TABLE USERS
RENAME COLUMN user_id to id;

CREATE TABLE user_address (
	id INT,
    username VARCHAR (50),
    user_address VARCHAR (150),
    user_city VARCHAR (50),
    user_state VARCHAR (50),
    user_tx VARCHAR (2),
    user_phone VARCHAR (50),
    user_email VARCHAR (100)
);

CREATE TABLE user_payment (
	id INT,
    username VARCHAR (50),
    user_pymt_type INT,
    user_pymt_provider VARCHAR (50),
    user_acctnum INT,
    user_expiry DATE
);

CREATE TABLE admins (
	id INT,
    username VARCHAR (50),
    user_password VARCHAR (50),
    first_name VARCHAR (50),
    last_name VARCHAR (50),
    user_type VARCHAR(10),
    last_login DATE,
    created DATE
);

CREATE TABLE product_category(
	id INT,
    product_type VARCHAR (50),
    product_desc VARCHAR (150),
    created DATE,
    modified DATE

);

CREATE TABLE product_listings(
	id INT,
    product_name VARCHAR (250),
    product_desc VARCHAR (100),
    product_sku INT,
    category_id INT,
    product_quantity INT,
    product_price FLOAT
);

ALTER TABLE product_category
RENAME COLUMN product_desc to product_subcategory;

USE petstore;


SELECT * FROM product_listings ;

SELECT * FROM admins;

ALTER TABLE product_category
DROP COLUMN modified;

USE petstore;

SELECT * FROM product_category;
