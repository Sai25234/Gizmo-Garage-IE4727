DROP TABLE IF EXISTS OrderItems;
DROP TABLE IF EXISTS Orders;
DROP TABLE IF EXISTS Admins;
DROP TABLE IF EXISTS Customers;
DROP TABLE IF EXISTS Promotions;
DROP TABLE IF EXISTS Products;

CREATE TABLE Products (
    ProductID INT PRIMARY KEY AUTO_INCREMENT,
    ProductName VARCHAR(100) NOT NULL,
    Brand VARCHAR(100),
    Category VARCHAR(100),
    Image_url VARCHAR(1000),
    Price DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    SalePrice DECIMAL(10,2) DEFAULT NULL,
    Specs VARCHAR(500) DEFAULT NULL,
    Stock INT NOT NULL
);

CREATE TABLE Promotions (
    PromotionID INT PRIMARY KEY AUTO_INCREMENT,
    Category VARCHAR(100),
    Discount INT NOT NULL CHECK (Discount >= 0 AND Discount <= 100)
);

CREATE TABLE Customers (
    Email VARCHAR(100) UNIQUE NOT NULL PRIMARY KEY,
    Password VARCHAR(100) UNIQUE NOT NULL
);  

CREATE TABLE Admins(
    AdminID INT PRIMARY KEY AUTO_INCREMENT,
    Email VARCHAR(100) UNIQUE NOT NULL,
    Password VARCHAR(100) NOT NULL
);

CREATE TABLE Orders (
    OrderID INT PRIMARY KEY AUTO_INCREMENT,
    CustomerName VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Phone VARCHAR(12) NOT NULL,
    Address TEXT,
    PaymentDetails TEXT,
    Status VARCHAR(50) NOT NULL CHECK (Status IN ('Pending', 'Processing', 'Completed', 'Cancelled')),
    Total DECIMAL(10, 2),
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UpdatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (Email) REFERENCES Customers(Email) ON DELETE CASCADE
);

CREATE TABLE OrderItems (
    OrderID INT,
    ProductID INT,
    Quantity INT NOT NULL,
    Price DECIMAL(10, 2) NOT NULL,
    PRIMARY KEY (OrderID, ProductID),
    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID) ON DELETE CASCADE,
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID)
);

INSERT INTO Admins (Email, Password) VALUES 
('admin@garage.com', MD5('admin123'));

INSERT INTO Products (ProductName, Brand, Category, Image_url, Price, Stock, Specs) VALUES
('ASUS Chromebook Laptop Student Business 2024', 'ASUS', 'Laptops', 'https://m.media-amazon.com/images/I/61wR4i8il-L._AC_SX679_.jpg,https://m.media-amazon.com/images/I/81Bf5NNca6L._AC_SX679_.jpg,https://m.media-amazon.com/images/I/81bOqPWqWoL._AC_SX679_.jpg,https://m.media-amazon.com/images/I/81-obFV8NBL._AC_SX679_.jpg', 239.00, 80, 'Brand: ASUS,Model: 2024 Flagship ASUS Chromebook,Screen size: 14 Inches,Colour: Gravity Grey,Hard disk size: 64 GB,CPU model: Others,Installed RAM memory size: 4 GB,Operating system: Chrome OS'),
('Apple 2024 MacBook Air', 'Apple', 'Laptops', 'https://m.media-amazon.com/images/I/71-D1xCuVwL.jpg,https://down-sg.img.susercontent.com/file/sg-11134207-7rcbs-lss77touv6yb7d.webp,https://down-sg.img.susercontent.com/file/sg-11134207-7rcdd-lss77tov0t8360@resize_w900_nl.webp,https://down-sg.img.susercontent.com/file/sg-11134207-7rce5-lss77touy03776@resize_w900_nl.webp', 1500.00, 100, 'Screen Size: 13.6\" (2560 X 1664) Retina, Battery Life: Go All Day With Up To 18 Hours Of Battery Life,Dimensions (w X H X d): 1.13(h) X 30.41(w) X 21.5(d) cm,Speaker(s): FouR-Speaker Sound System'),
('HP EliteBook 640', 'HP', 'Laptops', 'https://sg-media.apjonlinecdn.com/catalog/product/cache/74c1057f7991b4edb2bc7bdaa94de933/c/0/c08473069_4.png,https://sg-media.apjonlinecdn.com/catalog/product/cache/74c1057f7991b4edb2bc7bdaa94de933/e/l/elitebook-640-g11-rex14-dimension_2.jpg,https://sg-media.apjonlinecdn.com/catalog/product/cache/74c1057f7991b4edb2bc7bdaa94de933/e/l/elitebook-640-g11-rex14-ports_2.jpg', 1859.00, 100, 'Brand: HP,Processor: Intel® Core™ Ultra 5 125U,Graphics: Intel® Graphics,Screen Size: 14\" diagonal WUXGA display,Memory and storage: 16 GB memory; 512 GB SSD storage,Operating system: Windows 11 Pro'),
('HP Pavilion x360', 'HP', 'Laptops', 'https://sg-media.apjonlinecdn.com/catalog/product/cache/74c1057f7991b4edb2bc7bdaa94de933/c/0/c08908326_3_1.png,https://sg-media.apjonlinecdn.com/catalog/product/cache/74c1057f7991b4edb2bc7bdaa94de933/r/i/riesling_sb_ports_1_3_1.jpg, https://sg-media.apjonlinecdn.com/catalog/product/cache/74c1057f7991b4edb2bc7bdaa94de933/A/0/A05LXPA-4_T1711948351_1.png,https://sg-media.apjonlinecdn.com/catalog/product/cache/74c1057f7991b4edb2bc7bdaa94de933/r/i/riesling_sb_dimension_1_1.png', 1349.00, 200, 'Brand: HP,Processor: Intel® Core™ Ultra 7 155U,Graphics: Intel® Graphics,Screen Size: 14\" diagonal 2.8K OLED touch display,Memory and storage: 16 GB memory; 1 TB SSD storage,Operating system: Windows 11 Home'),
('HP Spectre x360', 'HP', 'Laptops', 'https://sg-media.apjonlinecdn.com/catalog/product/cache/b3b166914d87ce343d4dc5ec5117b502/2/3/23c2_spectre_herbie_16_nightfall_black_t_9mp_ir_cam_nonfpr_avicii_2b_win11_core_set_tent_whitebg_touch_evoultra.png,https://sg-media.apjonlinecdn.com/catalog/product/cache/74c1057f7991b4edb2bc7bdaa94de933/2/4/24c1-spectre-14-x360-willie-black-annotated-img-1_1.jpg,https://sg-media.apjonlinecdn.com/catalog/product/cache/74c1057f7991b4edb2bc7bdaa94de933/2/4/24c1-spectre-14-x360-willie-black-annotated-img-2_1.jpg,https://sg-media.apjonlinecdn.com/catalog/product/cache/74c1057f7991b4edb2bc7bdaa94de933/c/0/c08744276.png', 3499.00, 150, 'Brand: HP,Operating system: Windows 11 Home,Processor: Intel® Core™ Ultra 7 155H (up to 4.8 GHz with Intel® Turbo Boost Technology, 24 MB L3 cache, 16 cores, 22 threads),Graphics: NVIDIA GeForce RTX 4050,Screen Size: 40.6 cm (16\") diagonal 2.8K display,Memory and storage: 32 GB memory 1 TB SSD storage'),
('HP Envy x360', 'HP', 'Laptops', 'https://sg-media.apjonlinecdn.com/catalog/product/cache/b3b166914d87ce343d4dc5ec5117b502/c/0/c08891498-touch.png,https://sg-media.apjonlinecdn.com/catalog/product/cache/74c1057f7991b4edb2bc7bdaa94de933/e/n/envy-x360-14-thompson-blue-annotated-img-ports_1.png,https://sg-media.apjonlinecdn.com/catalog/product/cache/74c1057f7991b4edb2bc7bdaa94de933/e/n/envy-x360-14-thompson-blue-annotated-img-features_1.png,https://sg-media.apjonlinecdn.com/catalog/product/cache/74c1057f7991b4edb2bc7bdaa94de933/e/n/envy-x360-14-thompson-blue-annotated-img-dimensions_1.png', 1599.00, 100, 'Brand: HP,Processor: Intel® Core™ Ultra 7 155U,Graphics: Intel® Graphics,Screen Size: 14\" diagonal 2.8K OLED touch display,Memory and storage: 16 GB memory; 1 TB SSD storage,Operating system: Windows 11 Home'),
('HP ProBook 440', 'HP', 'Laptops', 'https://sg-media.apjonlinecdn.com/catalog/product/cache/74c1057f7991b4edb2bc7bdaa94de933/a/7/a77nspt-u85zfe_bundle.png,https://sg-media.apjonlinecdn.com/catalog/product/cache/74c1057f7991b4edb2bc7bdaa94de933/p/r/probook-440-14-g11-olaf14-intel-en-ports.jpg,https://sg-media.apjonlinecdn.com/catalog/product/cache/74c1057f7991b4edb2bc7bdaa94de933/p/r/probook-440-14-g11-olaf14-en-dimension.jpg,https://sg-media.apjonlinecdn.com/catalog/product/cache/74c1057f7991b4edb2bc7bdaa94de933/a/7/a77nspt_2.png', 1839.00, 150, 'Brand: HP,Processor: Intel® Core™ Ultra 7 258V,Graphics: Intel® Arc™ Graphics,Screen Size: 14\" diagonal 2.8K OLED touch display,Memory and storage: 1 TB SSD storage,Operating system: Windows 11 Home'),
('Apple iPhone 16', 'Apple', 'Phones', 'https://down-sg.img.susercontent.com/file/sg-11134301-7rdx4-m014vsvi1vf9d3@resize_w900_nl.webp,https://down-sg.img.susercontent.com/file/sg-11134301-7rdyo-lzzra1nolxg4ec@resize_w900_nl.webp,https://down-sg.img.susercontent.com/file/sg-11134301-7rdwg-lzzrshocwbvnc0@resize_w900_nl.webp,https://down-sg.img.susercontent.com/file/sg-11134301-7rdwy-lzzrshryr26042@resize_w900_nl.webp', 1449.00, 100, 'Screen Size: 6.1-Inch (diagonal) AlL-Screen Oled display,Screen Technology: Super Retina Xdr Display,Camera Effective Pixels: Rear: 48mp+12mp+12mp; Front: 12mp,Warranty: 1 Year,Weight: 170g,Operating System: Ios 18,Processor Model: A18 chip'),
('ASUS Zenbook 14', 'ASUS', 'Laptops', 'https://m.media-amazon.com/images/I/61sOPUk8FNL._AC_SL1300_.jpg,https://m.media-amazon.com/images/I/41APu5f9kpL._AC_SX679_.jpg,https://m.media-amazon.com/images/I/41QZGjGXUNL._AC_SX679_.jpg,https://m.media-amazon.com/images/I/51oOD+rqcpL._AC_SX679_.jpg', 1117.00, 300, 'Brand: ASUS,Model:	Zenbook,Screen size: 14 Inches,Colour:	Jasper Gray,Hard disk size:	1 TB,CPU model:	Others,Installed RAM memory size:	8 GB,Operating system: Windows 11 Pro'),
('ASUS VivoBook 14', 'ASUS', 'Laptops', 'https://m.media-amazon.com/images/I/71vKxjA8dsL.__AC_SX300_SY300_QL70_ML2_.jpg,https://m.media-amazon.com/images/I/719w3YHnTiL._AC_SL1500_.jpg,https://m.media-amazon.com/images/I/61tjM7DhZ0L._AC_SL1500_.jpg,https://m.media-amazon.com/images/I/51UVsr0gyjL._AC_SL1500_.jpg', 561.00, 180, 'Brand: ASUS,Model name:	5Z8N,Screen size: 14 Inches,Colour: Blue,Hard disk size: 512 GB,CPU model: Core i3 Family,Installed RAM memory size: 16 GB,Operating system: Windows 11 Home'),
('ASUS Chromebook Plus CX34', 'ASUS', 'Laptops', 'https://m.media-amazon.com/images/I/61MWHGFXhIL._AC_SX679_.jpg,https://m.media-amazon.com/images/I/81bOqPWqWoL._AC_SX679_.jpg,https://m.media-amazon.com/images/I/81xBii4PHjL._AC_SX679_.jpg,https://m.media-amazon.com/images/I/71-tUFSa+7L._AC_SX679_.jpg', 697.00, 150, 'Brand: ASUS,Model: Chromebook Plus CX34,Screen size: 14 Inches,Colour:	Pearl White,CPU model: Core i3,Installed RAM memory size:	8 GB,Operating system: Chrome OS'),
('Lenovo V14 Gen 4', 'Lenovo', 'Laptops', 'https://m.media-amazon.com/images/I/81HBC8P2a1L._AC_SX679_.jpg,https://m.media-amazon.com/images/I/51JoK-2OjqL._AC_US40_.jpg,https://m.media-amazon.com/images/I/710zdvED8IL._AC_SX679_.jpg,https://m.media-amazon.com/images/I/81m-7FRpepL._AC_SX679_.jpg,https://m.media-amazon.com/images/I/71C3UKdrtiL._AC_SX679_.jpg', 545.00, 120, 'Brand: Oemgenuine,Model name: V14 G4,Screen size: 14 Inches,Colour: Black,Hard disk size: 256 GB,CPU model: AMD Ryzen 5 5500U,Installed RAM memory size: 16 GB,Operating system: Windows 11 Pro'),
('Lenovo IdeaPad 3', 'Lenovo', 'Laptops', 'https://m.media-amazon.com/images/I/6183YBeJJFL._AC_SX679_.jpg,https://p4-ofp.static.pub//fes/cms/2024/09/13/wphiy4ngf8k0difkybwyc3jm9p77so192300.png,https://p3-ofp.static.pub//fes/cms/2024/09/13/69tv7fvrb59q6gssfu8psvwmf4kc4h674190.png,https://p1-ofp.static.pub//fes/cms/2024/09/13/xi9zr0uxa158ui2ig1jud8s2ndnbvu676089.png', 583.00, 250, 'Brand: Lenovo.Model:	15ITL6,Screen size: 15.6 Inches,Colour:	Grey,Hard disk size:	1 TB,CPU model:	Core i3 Family,Installed RAM memory size:	24 GB,Operating system:	Windows 11 Home'),
('Lenovo Thinkbook 16 Ultra 7', 'Lenovo', 'Laptops', 'https://m.media-amazon.com/images/I/81k6SvHC23L._AC_SX679_.jpg,https://m.media-amazon.com/images/I/51lha6kezzL._AC_SX679_.jpg,https://m.media-amazon.com/images/I/61LDY-coQsL._AC_SX679_.jpg,https://m.media-amazon.com/images/I/51oteyCWzmL._AC_SX679_.jpg', 1589.00, 340, 'Brand: Lenovo,Model: ThinkBook,Screen size: 16Inches,Colour:	ArcticGrey,Hard disk size:	1TB,CPU model:	Intel Corei5,Installed RAM memory size:	16GB,Operating system: Windows 11 Pro'),
('Lenovo Legion Slim 5', 'Lenovo', 'Laptops', 'https://m.media-amazon.com/images/I/61cGV9ATZxL._AC_SX679_.jpg,https://m.media-amazon.com/images/I/61j9iSNXCSL._AC_SX679_.jpg,https://m.media-amazon.com/images/I/61IWXjT9sKL._AC_SL1500_.jpg,https://m.media-amazon.com/images/I/51X+4Xmm4ZL._AC_SL1097_.jpg', 1646.00, 200, 'Brand:	Lenovo,Model:	Slim 5,Screen size:	16 Inches,Hard disk size:	512 GB,CPU model:	AMD Ryzen 7,Installed RAM memory size:	16 GB,Operating system: Windows 11 Home'),
('Dell Vostro 3000 Series ', 'Dell', 'Laptops', 'https://m.media-amazon.com/images/I/71R2LA5tZJL._AC_SX679_.jpg,https://m.media-amazon.com/images/I/71+wCbHlOqL._AC_SX679_.jpg,https://m.media-amazon.com/images/I/810dQSR2V3L._AC_SX679_.jpg,https://m.media-amazon.com/images/I/61b-R-Rtk7L._AC_SX679_.jpg', 1294.00, 180, 'Brand: Dell,Model name:	Vostro,Screen size:	15.6 Inches,Hard disk size:	2 TB,CPU model:	Intel Core i7,Installed RAM memory size:	64 GB,Operating system: Windows 11 Pro'),
('Samsung Galaxy S24 Ultra', 'Samsung', 'Phones', 'https://www.courts.com.sg/media/catalog/product/i/p/ip191206_00.jpg,https://www.courts.com.sg/media/catalog/product/i/p/ip191206_01.jpg,https://www.courts.com.sg/media/catalog/product/i/p/ip191206_04.jpg,https://www.courts.com.sg/media/catalog/product/i/p/ip191206_05.jpg', 2300.00, 50, 'Brand: Samsung,Model: Galaxy S24 Ultra,Screen size: 6.8 Inches,Colour: Titanium Violet,Storage: 1 TB,CPU model: Snapdragon 8 Gen 2,Installed RAM memory size: 12 GB,Operating system: Android'),
('Apple iPhone 16 Pro Max', 'Apple', 'Phones', 'https://www.courts.com.sg/media/catalog/product/i/p/ip198704_00.jpg,https://www.courts.com.sg/media/catalog/product/i/p/ip198704_02.jpg,https://www.courts.com.sg/media/catalog/product/i/p/ip198704_03.jpg,https://www.courts.com.sg/media/catalog/product/i/p/ip198704_07.jpg', 2499.00, 80, 'Brand: Apple,Model: iPhone 16 Pro Max,Screen size: 6.9 Inches,Colour: Desert Titanium,Storage: 1 TB,CPU model: A18 Pro Chip,Installed RAM memory size: 12 GB,Operating system: iOS'),
('Samsung Fold 6', 'Samsung', 'Phones', 'https://www.courts.com.sg/media/catalog/product/i/p/ip195957_00.jpg,https://www.courts.com.sg/media/catalog/product/i/p/ip195957_02.jpg,https://www.courts.com.sg/media/catalog/product/i/p/ip195957_07.jpg,https://www.courts.com.sg/media/catalog/product/i/p/ip195957_08.jpg', 2578.00, 60, 'Brand: Samsung,Model: Fold 6,Screen size: 7.6 Inches,Colour: Navy,Storage: 512 GB,CPU model: Snapdragon 8 Gen 3,Installed RAM memory size: 12 GB,Operating system: Android'),
('Samsung Galaxy Z Flip 6', 'Samsung', 'Phones', 'https://www.courts.com.sg/media/catalog/product/i/p/ip195951_08.jpg,https://www.courts.com.sg/media/catalog/product/i/p/ip195951_00.jpg,https://www.courts.com.sg/media/catalog/product/i/p/ip195951_07.jpg,https://www.courts.com.sg/media/catalog/product/i/p/ip195951_05.jpg', 1700.00, 45, 'Brand: Samsung,Model: Galaxy Z Flip 6,Screen size: 6.7 Inches,Colour: Mint,Storage: 256 GB,CPU model: Snapdragon 8 Gen 3,Installed RAM memory size: 8 GB,Operating system: Android'),
('Apple iPhone SE (3rd Gen)', 'Apple', 'Phones', 'https://www.istudiosg.com/cdn/shop/files/IMG-4611765_1e68d98b-5e0e-4d19-ad58-f35b9d867b54.jpg,https://www.istudiosg.com/cdn/shop/files/IMG-4611766_823fcfcd-7d02-409a-aa10-fddabf31225d.jpg,https://www.istudiosg.com/cdn/shop/files/IMG-4611768_efa77b6f-a607-4815-a6b5-b50b936eaa21.jpg,https://www.istudiosg.com/cdn/shop/files/IMG-4611767_11ae56ef-c764-46d5-9049-8c7fa1d223bf.jpg', 899.00, 120, 'Brand: Apple,Model: iPhone SE (3rd Gen),Screen size: 4.7 Inches,Colour: Midnight,Storage: 256 GB,CPU model: A15 Bionic,Installed RAM memory size: 4 GB,Operating system: iOS');
