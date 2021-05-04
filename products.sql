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

CREATE TABLE news
(
    id serial NOT NULL,
    author character varying NOT NULL,
    image character varying NOT NULL,
    header character varying NOT NULL,
    content character varying NOT NULL,
    PRIMARY KEY (id)
);

insert into news (author, image, header, content) values 
('Admin', './images/news1.jpg', 'Styling White Shirts After A Cool Day', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo praesentium, numquam non provident rem sed minus natus unde vel modi!'),
('Admin', './images/news2.jpg', 'Styling White Shirts After A Cool Day', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo praesentium, numquam non provident rem sed minus natus unde vel modi!'),
('Admin', './images/news3.jpg', 'Styling White Shirts After A Cool Day', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo praesentium, numquam non provident rem sed minus natus unde vel modi!'),
('Admin', './images/news4.jpg', 'Styling White Shirts After A Cool Day', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo praesentium, numquam non provident rem sed minus natus unde vel modi!'),
('Admin', './images/news5.jpg', 'Styling White Shirts After A Cool Day', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo praesentium, numquam non provident rem sed minus natus unde vel modi!');