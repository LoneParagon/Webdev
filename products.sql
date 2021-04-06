--
-- Database: `ecommerce`
--

CREATE TABLE IF NOT EXISTS products (
  id serial NOT NULL,
  name varchar(250) NOT NULL,
  code varchar(100) NOT NULL unique,
  price double precision NOT NULL,
  image varchar(250) NOT NULL,
  PRIMARY KEY (id),
);

INSERT INTO products (name, code, price, image) VALUES
('Laptop Core i5', 'Laptop01', 600.00, 'product-images/laptop.jpg'),
('Laptop Bag', 'Bag01', 50.00, 'product-images/laptop-bag.jpg'),
('iPhone X', 'iphone01', 700.00, 'product-images/iphone.jpg');

CREATE TABLE subscribers
(
    id serial NOT NULL,
    email character varying(100) NOT NULL,
    date date NOT NULL,
    PRIMARY KEY (id)
);

insert into subscribers (email, date) values ('abs@abs.abs', '04.04.2021');

create TABLE orders
(
    id serial NOT NULL,
    productCodes character varying[] NOT NULL,
    productQuantities character varying[] NOT NULL,
    email character varying NOT NULL,
    shipping bool NOT NULL,
    PRIMARY KEY (id)
);