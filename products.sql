--
-- Database: `ecommerce`
--

CREATE TABLE IF NOT EXISTS cart (
  id serial NOT NULL,
  name varchar(250) NOT NULL,
  code varchar(100) NOT NULL unique,
  price double precision NOT NULL,
  image varchar(250) NOT NULL,
  PRIMARY KEY (id),
);

INSERT INTO cart (name, code, price, image) VALUES
('Laptop Core i5', 'Laptop01', 600.00, 'product-images/laptop.jpg'),
('Laptop Bag', 'Bag01', 50.00, 'product-images/laptop-bag.jpg'),
('iPhone X', 'iphone01', 700.00, 'product-images/iphone.jpg');
