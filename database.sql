DROP TABLE IF EXISTS OrderPallet;
DROP TABLE IF EXISTS OrderPastry;
DROP TABLE IF EXISTS Orders;
DROP TABLE IF EXISTS Customers;
DROP TABLE IF EXISTS Pallets;
DROP TABLE IF EXISTS Ingredients;
DROP TABLE IF EXISTS StockEvents;
DROP TABLE IF EXISTS RawMaterials;
DROP TABLE IF EXISTS Pastries;

CREATE TABLE Pastries (
    name varchar(255) NOT NULL,
    PRIMARY KEY (name)
);

CREATE TABLE RawMaterials (
    name varchar(255) NOT NULL,
    unit varchar(255) NOT NULL,
    PRIMARY KEY (name)
);

CREATE TABLE StockEvents (
    id int NOT NULL AUTO_INCREMENT,
    material_name varchar(255) NOT NULL,
    amount int NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (material_name) REFERENCES RawMaterials(name)
);

CREATE TABLE Ingredients (
    id int NOT NULL AUTO_INCREMENT,
    pastry_name varchar(255) NOT NULL,
    material_name varchar(255) NOT NULL,
    amount int NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (pastry_name) REFERENCES Pastries(name),
    FOREIGN KEY (material_name) REFERENCES RawMaterials(name)
);

CREATE TABLE Pallets (
    id int NOT NULL AUTO_INCREMENT,
    barcode_id varchar(255) NOT NULL UNIQUE,
    pastry_name varchar(255) NOT NULL,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    blocked_at datetime,
    PRIMARY KEY (id),
    FOREIGN KEY (pastry_name) REFERENCES Pastries(name)
);

CREATE TABLE Customers (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL UNIQUE,
    address varchar(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE Orders (
    id int NOT NULL AUTO_INCREMENT,
    customer_id int NOT NULL,
    delivery_date datetime NOT NULL,
    delivery_address varchar(255) NOT NULL,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (customer_id) REFERENCES Customers(id)
);

CREATE TABLE OrderPallet (
    pallet_id int NOT NULL,
    order_id int NOT NULL,
    FOREIGN KEY (pallet_id) REFERENCES Pallets(id),
    FOREIGN KEY (order_id) REFERENCES Orders(id)
);

CREATE TABLE OrderPastry (
    order_id int NOT NULL,
    pastry_name varchar(255) NOT NULL,
    amount int NOT NULL,
    FOREIGN KEY (order_id) REFERENCES Orders(id),
    FOREIGN KEY (pastry_name) REFERENCES Pastries(name)
);

INSERT INTO RawMaterials(name, unit) VALUES
('Butter', 'g'),
('Icing sugar', 'g'),
('Roasted, chopped nuts', 'g'),
('Fine-ground nuts', 'g'),
('Ground, roasted nuts', 'g'),
('Bread crumbs', 'g'),
('Sugar', 'g'),
('Chocolate', 'g'),
('Marzipan', 'g'),
('Potato starch', 'g'),
('Wheat flour', 'g'),
('Sodium bicarbonate', 'g'),
('Vanilla', 'g'),
('Chopped almonds', 'g'),
('Cinnamon', 'g'),
('Flour', 'g'),
('Eggs', 'g'),
('Vanilla sugar', 'g'),
('Egg whites', 'dl');

INSERT INTO Pastries(name) VALUES
('Nut ring'),
('Nut cookie'),
('Amneris'),
('Tango'),
('Almond delight'),
('Berliner');

INSERT INTO Ingredients(pastry_name, material_name, amount) VALUES
('Nut ring', 'Flour', 450),
('Nut ring', 'Butter', 450),
('Nut ring', 'Icing sugar', 190),
('Nut ring', 'Roasted, chopped nuts', 225),
('Nut cookie', 'Fine-ground nuts', 750),
('Nut cookie', 'Ground, roasted nuts', 625),
('Nut cookie', 'Bread crumbs', 125),
('Nut cookie', 'Sugar', 375),
('Nut cookie', 'Egg whites', 3.5),
('Nut cookie', 'Chocolate', 50),
('Amneris', 'Marzipan', 750),
('Amneris', 'Butter', 250),
('Amneris', 'Eggs', 250),
('Amneris', 'Potato starch', 25),
('Amneris', 'Wheat flour', 25),
('Tango', 'Butter', 200),
('Tango', 'Sugar', 250),
('Tango', 'Flour', 300),
('Tango', 'Sodium bicarbonate', 4),
('Tango', 'Vanilla', 2),
('Almond delight', 'Butter', 400),
('Almond delight', 'Sugar', 270),
('Almond delight', 'Chopped almonds', 279),
('Almond delight', 'Flour', 400),
('Almond delight', 'Cinnamon', 10),
('Berliner', 'Flour', 350),
('Berliner', 'Butter', 250),
('Berliner', 'Icing sugar', 100),
('Berliner', 'Eggs', 50),
('Berliner', 'Vanilla sugar', 5),
('Berliner', 'Chocolate', 50);


INSERT INTO Pallets(barcode_id, pastry_name, created_at, blocked_at) VALUES
('1234567890128', 'Tango', '2016-03-30 13:37:00', null),
('1345678910128', 'Tango', '2016-03-29 13:37:00', null),
('1574357210128', 'Berliner', '2016-03-28 13:37:00', '2016-03-30 13:37:00'),
('1646753240128', 'Berliner', '2016-03-28 13:37:00', null);
