CREATE TABLE orders (
  order_id bigint PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  address VARCHAR(200) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  payment_method VARCHAR(50) NOT NULL,
  total_price NUMERIC(10,2) NOT NULL,
  shipment_status VARCHAR(50) NOT NULL DEFAULT 'ordered',
  order_date TIMESTAMP NOT NULL DEFAULT NOW()
);


CREATE TABLE product (
  product_id BIGSERIAL PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  price NUMERIC(10,2) NOT NULL,
  picture_name VARCHAR(255) NOT NULL,
  picture_type VARCHAR(255) NOT NULL,
  picture_path VARCHAR(255) NOT NULL,
  stock INTEGER NOT NULL,
  category VARCHAR(255) NOT NULL
);


CREATE TABLE cart (
  product_id BIGINT NOT NULL,
  product_name VARCHAR(255) NOT NULL,
  quantity INTEGER NOT NULL,
  size VARCHAR(10) NOT NULL,
  price NUMERIC(10, 2) NOT NULL,
  picture_path VARCHAR(255) NOT NULL,
  FOREIGN KEY (product_id) REFERENCES product (product_id),
  CONSTRAINT cart_pk PRIMARY KEY (product_id, size)
);

CREATE TABLE users (
  username varchar(50),
  password varchar(50)
);

INSERT INTO users (username, password) VALUES ('admin', 'admin');

INSERT INTO product (name, description, price, picture_name, picture_type, picture_path, stock, category)
VALUES 
('Activewear Oversized T-Shirt Black', 'T-Shirt', 999, 'black_overt', 'image/webp', 'black_overt.webp', 10, 'activewear'),
('Activewear Tracksuit Black', 'Tracksuit', 1999, 'black_tracksuit', 'image/webp', 'black_tracksuit.webp', 10, 'activewear'),
('Activewear Joggers Black', 'Joggers', 1499, 'black_joggers', 'image/webp', 'black_joggers.webp', 10, 'activewear'),
('Activewear Training Top Black', 'Training Top', 1999, 'black_training_top', 'image/webp', 'black_training_top.webp', 10, 'activewear'),
('Activewear Oversized T-Shirt Stone', 'T-Shirt', 999, 'stone_overt', 'image/webp', 'stone_overt.webp', 10, 'activewear'),
('Activewear Oversized T-Shirt White', 'T-Shirt', 999, 'white_overt', 'image/webp', 'white_overt.webp', 10, 'activewear'),
('Activewear Tracksuit Grey', 'Tracksuit', 1999, 'grey_tracksuit', 'image/webp', 'grey_tracksuit.webp', 10, 'activewear'),
('Activewear Joggers Grey', 'Joggers', 1499, 'grey_joggers', 'image/webp', 'grey_joggers.webp', 10, 'activewear'),
('Activewear Oversized T-Shirt Blue', 'T-Shirt', 999, 'blue_overt', 'image/webp', 'blue_overt.webp', 10, 'activewear'),
('Activewear Training Top Grey', 'Training Top', 1999, 'grey_training_top', 'image/webp', 'grey_training_top.webp', 10, 'activewear'),
('Activewear Hoodie Black', 'Hoodie', 2299, 'black_hoodie', 'image/webp', 'black_hoodie.webp', 10, 'activewear'),
('Activewear Hoodie Grey', 'Hoodie', 2299, 'grey_hoodie', 'image/webp', 'grey_hoodie.webp', 10, 'activewear'),

('Shirt Black', 'Shirt', 999, 'm1', 'image/png', 'm1.png', '10', 'men'),
('Shirt Grey', 'Shirt', 999, 'm2', 'image/png', 'm2.png', '10', 'men'),
('Polo T-Shirt White', 'T-Shirt', 999, 'm3', 'image/png', 'm3.png', '10', 'men'),
('Polo T-Shirt Yellow', 'T-Shirt', 999, 'm4', 'image/png', 'm4.png', '10', 'men'),
('Jacket Neon', 'Jacket', 1999, 'm5', 'image/png', 'm5.png', '10', 'men'),
('Jacket Black', 'Jacket', 999, 'm6', 'image/png', 'm6.png', '10', 'men'),
('Jacket Red', 'Jacket', 999, 'm7', 'image/png', 'm7.png', '10', 'men'),
('Shirt Blue', 'Shirt', 999, 'm8', 'image/png', 'm8.png', '10', 'men'),
('Polo T-Shirt Grey', 'Shirt', 999, 'm9', 'image/png', 'm9.png', '10', 'men'),
('Shirt White', 'Shirt', 999, 'm10', 'image/png', 'm10.png', '10', 'men'),
('Button Polo T-Shirt White', 'Shirt', 999, 'm11', 'image/png', 'm11.png', '10', 'men'),
('Button Polo T-Shirt Black', 'Shirt', 999, 'm12', 'image/png', 'm12.png', '10', 'men'),

('White Gown', 'Gown', 1999, 'w1', 'image/png', 'w1.png', '10', 'women'),
('Black Gown', 'Gown', 1999, 'w2', 'image/png', 'w2.png', '10', 'women'),
('Cream Gown', 'Gown', 1999, 'w3', 'image/png', 'w3.png', '10', 'women'),
('Sky Blue Gown', 'Gown', 1999, 'w4', 'image/png', 'w4.png', '10', 'women'),
('Cream Gown', 'Gown', 1999, 'w5', 'image/png', 'w5.png', '10', 'women'),
('Blue Gown', 'Gown', 1999, 'w6', 'image/png', 'w6.png', '10', 'women'),
('Pink Gown', 'Gown', 1999, 'w7', 'image/png', 'w7.png', '10', 'women'),
('White and Blue Gown', 'Gown', 1999, 'w8', 'image/png', 'w8.png', '10', 'women'),
('New Pink', 'Gown', 1999, 'w9', 'image/png', 'w9.png', '10', 'women'),
('Blue Dress', 'Gown', 1999, 'w10', 'image/png', 'w10.png', '10', 'women'),
('White Dress', 'Gown', 1999, 'w11', 'image/png', 'w11.png', '10', 'women'),
('Pink Dress', 'Gown', 1999, 'w12', 'image/png', 'w12.png', '10', 'women'),

('Gold Necklace', 'Necklace', 999, 'a1', 'image/png', 'a1.png', '10', 'accessories'),
('Purple Bowtie', 'Bowtie', 999, 'a2', 'image/png', 'a2.png', '10', 'accessories'),
('White Bowtie', 'Bowtie', 999, 'a3', 'image/png', 'a3.png', '10', 'accessories'),
('Rainbow Bowtie', 'Bowtie', 999, 'a4', 'image/png', 'a4.png', '10', 'accessories'),
('Blue Tie', 'Necklace', 999, 'a5', 'image/png', 'a5.png', '10', 'accessories'),
('Wallet', 'Wallet', 699, 'a6', 'image/png', 'a6.png', '10', 'accessories'),
('Leather Belt', 'Belt', 599, 'a7', 'image/png', 'a7.png', '10', 'accessories'),
('Hat', 'Hat', 499, 'a8', 'image/png', 'a8.png', '10', 'accessories'),
('Blue Bag', 'Bag', 999, 'a9', 'image/png', 'a9.png', '10', 'accessories'),
('Leather Bag', 'Bag', 699, 'a10', 'image/png', 'a10.png', '10', 'accessories'),
('Pink Bag', 'Bag', 599, 'a11', 'image/png', 'a11.png', '10', 'accessories'),
('Ring', 'Rings', 499, 'a12', 'image/png', 'a12.png', '10', 'accessories');
