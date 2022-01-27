-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2021 at 09:35 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Chairs'),
(2, 'Couches'),
(3, 'Bedding'),
(4, 'Tables'),
(5, 'Lighting');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_amount` float(11,2) NOT NULL,
  `order_transaction` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `order_currency` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_amount`, `order_transaction`, `order_status`, `order_currency`) VALUES
(2, 209.70, '3YE22647FP606324L', 'Completed', 'USD'),
(3, 4199.70, '87M706918A6796640', 'Completed', 'USD'),
(4, 4199.70, '87M706918A6796640', 'Completed', 'USD'),
(5, 4199.70, '87M706918A6796640', 'Completed', 'USD'),
(6, 2279.82, '7U726267AV5667222', 'Completed', 'USD'),
(8, 5531.70, '7DH279652X801345L', 'Completed', 'USD'),
(9, 5531.70, '7DH279652X801345L', 'Completed', 'USD'),
(10, 5531.70, '7DH279652X801345L', 'Completed', 'USD');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_category_id` int(11) NOT NULL,
  `product_price` float(11,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_short_description` text NOT NULL,
  `product_description` text NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_large_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_category_id`, `product_price`, `product_quantity`, `product_short_description`, `product_description`, `product_image`, `product_large_image`) VALUES
(1, 'Spitfire Tub Chair', 1, 16899.00, 3, 'Tub chairs are hugely popular for restaurants, hotels, and waiting rooms – anywhere where guests need to sit in comfort. With their low seat, soft cushioning, and high, supportive arms and back, they can add a touch of relaxed luxury to any environment.', 'Bold and daring, going where no chair has gone before—the Spitfire lives up to its namesake.  Featuring full-grain leather tailored to perfection, with a distinctive curved frame wrapped in vintage aluminium panelling to replicate the famed WWII fighter plane design the iconic Spitfire Chair makes a statement that simply can’t be ignored.\r\n\r\nThis beautiful tub chair is handmade in South Africa.\r\n\r\nHigh standard, industrial-strength wooden frame work, which will not wobble or creak.\r\n\r\nHigh-density foam. (Our standard)\r\n\r\nWe exclusively use Home fabrics when selecting a cover for our furniture due to the high quality and reputation of this house.\r\n', 'https://www.cielo.co.za/13156-thickbox_default/spitfire-chair-armchair.jpg', 'https://www.cielo.co.za/2097-thickbox_default/spitfire-chair-armchair.jpg'),
(2, 'Spitfire 2 Seater', 2, 22499.00, 10, 'Bold and daring, going where no chair has gone before the Spitfire lives up to its namesake. ', 'Featuring full-grain leather tailored to perfection, with a distinctive curved frame wrapped in vintage aluminum paneling to replicate the famed WWII fighter plane design the iconic Spitfire 2-Seater makes a statement that simply can’t be ignored.', 'https://www.cielo.co.za/12676-thickbox_default/spitfire-2-seater-tan-leather-couches.jpg', 'https://www.cielo.co.za/12642-thickbox_default/spitfire-2-seater-tan-leather-couches.jpg'),
(3, 'Coleford Couch', 2, 18999.00, 10, 'Distinctive and daring, the Coleford Couch puts a modern twist on the classic Chesterfield look with its plush deep-buttoned tufting covering the entire couch surface.', 'Upholstered in high-quality space grey velvet, this 3-seater couch is both luxurious and supremely comfortable a creative and enticing statement piece for any living space.  ', 'https://www.cielo.co.za/20858-thickbox_default/coleford-couch-space-grey.jpg', 'https://www.cielo.co.za/22178-thickbox_default/coleford-couch-space-grey.jpg'),
(4, 'Morello Chaise', 1, 24999.00, 1, 'Vintage full-grain leather meets mid-century modern simplicity.', 'The large 2-person chaise features channel stitching and a polished stainless steel framework.\r\nThis modern silhouette is a true combination of beauty and comfort, transforming your living space into extraordinary.', 'https://www.cielo.co.za/22051-thickbox_default/morello-chaise-large-distressed-black.jpg', 'https://www.cielo.co.za/22364-thickbox_default/morello-chaise-large-distressed-black.jpg'),
(5, 'Jupiter Bed', 3, 9498.00, 5, 'This stylish and versatile bed set offers a convenient, space-saving solution for your family’s sleep needs, with two beds in one.', 'The pull-out bed features a built-in foam mattress and is ideal as a transitional bed for toddlers, an extra bed for young children, or for sleepovers at any age! \r\n\r\nThe set includes a Drew Headboard, platform bed base, and pull-out bed, all upholstered in high-quality polyester. ', 'https://www.cielo.co.za/13325-thickbox_default/jupiter-dual-function-queen-bed.jpg', 'https://www.cielo.co.za/13321-thickbox_default/jupiter-dual-function-queen-bed.jpg'),
(6, 'Lara Bed Base', 3, 4199.00, 50, 'The industrial-inspired Lara bed offers a sleek, modern, and versatile look that will add an understated style to any contemporary space.', 'Featuring a strong steel frame and polyester upholstered headboard and footboard, this bed frame offers excellent durability and low maintenance while adding comfort and style to amplify your bedroom look.    \r\n\r\nThe platform base features sprung slats, providing proper support for heavier mattresses such as memory foam and latex while ensuring excellent ventilation.', 'https://www.cielo.co.za/13457-thickbox_default/lara-metal-queen-size-bed-flash.jpg', 'https://www.cielo.co.za/13454-thickbox_default/lara-metal-queen-size-bed-flash.jpg'),
(7, 'Tarbes Geo Pendant', 5, 699.00, 100, 'Geometric black hanging pendant.', 'SPECIFICATIONS\r\nProduct Code	E-P690BK\r\nMaterial	Steel\r\nColour	Black\r\nProduct Assembly	No Assembly', 'https://www.cielo.co.za/20540-thickbox_default/tarbes-geometric-black-pendant.jpg', 'https://www.cielo.co.za/18478-thickbox_default/tarbes-geometric-black-pendant.jpg'),
(8, 'Lexi Coffee Table', 4, 6499.00, 50, 'Create the focal point in any living space with the Lexi coffee table. ', 'This piece has an industrial flair featuring a blend of metal, Acacia wood, and Acacia veneers which balances the look of this urban-inspired item.', 'https://www.cielo.co.za/53419-thickbox_default/lexi-coffee-table-14m.jpg', 'https://www.cielo.co.za/72336-thickbox_default/lexi-coffee-table-14m.jpg'),
(11, 'Falcon', 1, 7299.00, 15, 'The Falcon armchair is a modern rendition of the mid-century classic.  Perfectly crafted and luxurious, featuring upholstery in vintage full-grain leather, wrapped in riveted aluminum panels, and features a swivel steel base.', 'Note:   To reflect the finish of a vintage WWII fighter plane, the metal sheeting used is not spotless.  Minor marks, scratches, abrasions, and even small indentations are part of the design and not defects in the material or workmanship.\r\n\r\nNote: Only items specified are included. Any other furniture pieces, décor, and accessories shown in the product photography are excluded.\r\n\r\nX-Shield Leather Protection is a new advanced anti-age technology that has been specially developed to help shield and ensure maximum surface protection on all genuine and synthetic leather, aiding in preventing damage caused by soiling, stains, and exposure to sunlight for a period of up to 3 years! This remarkable leather protection penetrates the leather and forms an invisible and durable shield around each pore and fiber to help protect your fabric furnishings against everyday risk stains and general wear and tear.', 'https://www.cielo.co.za/20225-thickbox_default/falcon-chair.jpg', 'https://www.cielo.co.za/20224-thickbox_default/falcon-chair.jpg'),
(13, 'Bandit', 1, 10800.00, 15, 'The Bandit is all personality with its bold looks and irresistible charms. Tailored for comfort, this stylish armchair features a superbly plush seat and backrest with armrests perfectly curved for comfort—all wrapped in luxurious full-grain leather.  A chrome metal base with 360-degree swivel feature gives this piece an extra element of surprise, ensuring the Bandit lives up to its name. A trendy, durable and enviable addition to any room. ', 'Upgrade your comfort and style levels with the luxurious Bandit Armchair – impressive in any setting.\r\n\r\nTop-quality full grain leather upholstery, plush cushioning and sophisticated design ensure this armchair delivers on comfort, ease and durability, with a full swivel feature providing extra ‘cool’ points.\r\n\r\nA standout addition to any modern or contemporary space, whether as part of an ensemble or a solo statement piece. \r\n\r\n\r\nX-SHIELD LEATHER PROTECTION is a new advanced anti-age technology, specially developed to ensure maximum surface protection on all genuine and synthetic leather, helping prevent damage from soiling, stains, and exposure to sunlight for a period of up to 3 years. This remarkable leather protection penetrates the leather and forms an invisible and durable shield around each pore and fiber to help protect your furniture against everyday stain risks as well as general wear and tear.\r\n\r\nLEATHERGUARD’S water-based Full Grain spray protector is a modified polyfluorocarbon emulsion, developed to provide highly advanced stain resistance properties to absorbent and unfinished leather surfaces, greatly reducing the risk of stains and water spots.\r\n\r\nNote: Only items specified are included. Any other furniture pieces, décor, and accessories are shown in the product photography are excluded.', 'https://www.cielo.co.za/51155-thickbox_default/bandit-armchair-distressed-black.jpg', 'https://www.cielo.co.za/64957-thickbox_default/bandit-armchair-distressed-black.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_price` float(11,2) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `product_id`, `order_id`, `product_price`, `product_title`, `product_quantity`) VALUES
(1, 8, 1, 6499.00, 'Lexi Coffee Table', 1),
(2, 7, 2, 699.00, 'Tarbes Geo Pendant', 5),
(3, 2, 3, 22499.00, 'Spitfire 2 Seater', 1),
(4, 3, 4, 18999.00, 'Coleford Couch', 2),
(5, 5, 5, 9498.00, 'Jupiter Bed', 1),
(6, 4, 6, 24999.00, 'Morello Chaise', 1),
(7, 8, 7, 6499.00, 'Lexi Coffee Table', 2),
(12, 2, 8, 22499.00, 'Spitfire 2 Seater', 1),
(13, 1, 9, 16899.00, 'Spitfire Tub Chair', 3),
(14, 3, 10, 18999.00, 'Coleford Couch', 1);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `slide_id` int(11) NOT NULL,
  `slide_title` varchar(255) NOT NULL,
  `slide_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`slide_id`, `slide_title`, `slide_image`) VALUES
(6, 'Spitfire Combo', 'b57a9c4195e8c3c5dcd87a9a06eb9a03.jpg'),
(7, 'Test 1', 'burbank-modular-leather-couch-tan.jpg'),
(8, 'Test 2', 'heston-chesterfield-lounge-suite-brushed-metal.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'Morne', 'morne@test.com', '1234'),
(2, 'Pieter', 'Pieter@test.com', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`slide_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
