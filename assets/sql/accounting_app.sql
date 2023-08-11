-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2023 at 09:12 AM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accounting app`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `no` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `sum_net` decimal(10,2) DEFAULT NULL,
  `sum_gross` decimal(10,2) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `bank` varchar(50) DEFAULT NULL,
  `account_no` varchar(50) DEFAULT NULL,
  `payment_term` varchar(50) DEFAULT NULL,
  `to_pay` decimal(10,2) DEFAULT NULL,
  `to_pay_in_words` tinytext DEFAULT NULL,
  `additional_notes` mediumtext DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `customer_address1` varchar(100) DEFAULT NULL,
  `customer_address2` varchar(100) DEFAULT NULL,
  `customer_company_no` varchar(100) DEFAULT NULL,
  `seller_name` varchar(100) DEFAULT NULL,
  `seller_address1` varchar(100) DEFAULT NULL,
  `seller_address2` varchar(100) DEFAULT NULL,
  `seller_company_no` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `user_id`, `no`, `date`, `sum_net`, `sum_gross`, `city`, `bank`, `account_no`, `payment_term`, `to_pay`, `to_pay_in_words`, `additional_notes`, `customer_name`, `customer_address1`, `customer_address2`, `customer_company_no`, `seller_name`, `seller_address1`, `seller_address2`, `seller_company_no`) VALUES
(127, '29', '1/08/2023', '2023-08-11', 16.99, 20.90, 'New York', 'Citibank', '00 1111 2222 3333 4444 5555 6666', '7 days', 20.90, 'twenty zero 90/100 $', 'This transaction is exempt from sales tax under the provision of New York Tax Code Section 12345.', 'Emily Johnson', '456 Oak Street, Apt 203', 'New York, NY 10001', '---', 'Hairdresser BeSmile', '266 Greenwich Street', 'Hempstead NY 11550-6317 USA', '123456789'),
(128, '29', '2/08/2023', '2023-08-11', 53.56, 58.50, 'New York', 'Citibank', '00 1111 2222 3333 4444 5555 6666', '7 days', 58.50, 'fifty eight 50/100 $', 'This transaction is exempt from sales tax under the provision of New York Tax Code Section 12345.', 'Michael Smith', '789 Maple Avenue', 'Los Angeles, CA 90012', '123456789', 'Hairdresser BeSmile', '266 Greenwich Street', 'Hempstead NY 11550-6317 USA', '123456789'),
(129, '29', '3/08/2023', '2023-08-11', 30.98, 35.06, 'New York', 'Citibank', '00 1111 2222 3333 4444 5555 6666', '7 days', 35.06, 'thirty five 06/100 $', 'This transaction is exempt from sales tax under the provision of New York Tax Code Section 12345.', 'Jessica Williams', '123 Pine Street, Unit B', 'Chicago, IL 60611', '987654321', 'Hairdresser BeSmile', '266 Greenwich Street', 'Hempstead NY 11550-6317 USA', '123456789'),
(130, '29', '4/08/2023', '2023-08-11', 107.96, 129.79, 'New York', 'Citibank', '00 1111 2222 3333 4444 5555 6666', '7 days', 129.79, 'one hundred twenty nine 79/100 $', 'This transaction is exempt from sales tax under the provision of New York Tax Code Section 12345.', 'Christopher Brown', '234 Elm Drive, Suite 100', 'Houston, TX 77002', '---', 'Hairdresser BeSmile', '266 Greenwich Street', 'Hempstead NY 11550-6317 USA', '123456789'),
(131, '29', '5/08/2023', '2023-08-11', 60.48, 65.67, 'New York', 'Citibank', '00 1111 2222 3333 4444 5555 6666', '7 days', 65.67, 'sixty five 67/100 $', 'This transaction is exempt from sales tax under the provision of New York Tax Code Section 12345.', 'Olivia Davis', ' 567 Cedar Lane', 'Miami, FL 33130', '123456789', 'Hairdresser BeSmile', '266 Greenwich Street', 'Hempstead NY 11550-6317 USA', '123456789');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `invoice_id` varchar(10) DEFAULT NULL,
  `position` int(255) NOT NULL,
  `service_name` varchar(250) DEFAULT NULL,
  `service_code` varchar(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `item_net_price` decimal(10,2) DEFAULT NULL,
  `service_tax` decimal(10,2) DEFAULT NULL,
  `service_total_net` decimal(10,2) DEFAULT NULL,
  `service_total_gross` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `user_id`, `invoice_id`, `position`, `service_name`, `service_code`, `quantity`, `item_net_price`, `service_tax`, `service_total_net`, `service_total_gross`) VALUES
(557, 29, '127', 1, 'Service 1', '812112', 1, 16.99, 0.23, 16.99, 20.90),
(558, 29, '128', 1, 'Service 1', '812112', 1, 17.98, 0.23, 17.98, 22.12),
(559, 29, '128', 2, 'Service 2', '812112', 1, 5.00, 0.00, 5.00, 5.00),
(560, 29, '128', 3, 'Service 3 ', '812112', 1, 20.59, 0.00, 20.59, 20.59),
(561, 29, '128', 4, 'Service 4 ', '812112', 1, 9.99, 0.08, 9.99, 10.79),
(562, 29, '129', 1, 'Service 1', '812112', 1, 15.99, 0.23, 15.99, 19.67),
(563, 29, '129', 2, 'Service 2', '812112', 1, 4.99, 0.08, 4.99, 5.39),
(564, 29, '129', 3, 'Service 3', '812112', 1, 10.00, 0.00, 10.00, 10.00),
(565, 29, '130', 1, 'Service 1', '812112', 4, 16.99, 0.23, 67.96, 83.59),
(566, 29, '130', 2, 'Service 2 ', '812112 ', 1, 20.00, 0.08, 20.00, 21.60),
(567, 29, '130', 3, 'Service 3 ', '812112', 4, 5.00, 0.23, 20.00, 24.60),
(568, 29, '131', 1, 'Service 1', '812112', 1, 15.00, 0.08, 15.00, 16.20),
(569, 29, '131', 2, 'Service 2', '812112', 1, 27.50, 0.00, 27.50, 27.50),
(570, 29, '131', 3, 'Service 3', '812112', 1, 16.99, 0.23, 16.99, 20.90),
(571, 29, '131', 4, 'Service 4', '812112', 1, 0.99, 0.08, 0.99, 1.07);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `avatar_file_img` varchar(100) DEFAULT '0',
  `company_name` varchar(250) DEFAULT NULL,
  `address1` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `company_number` varchar(15) DEFAULT NULL,
  `default_invoice_city` varchar(100) DEFAULT NULL,
  `default_invoice_bank_name` varchar(100) DEFAULT NULL,
  `default_invoice_bank_account_no` varchar(100) DEFAULT NULL,
  `default_invoice_additional_info` varchar(300) DEFAULT NULL,
  `company_logo_file_path` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `avatar_file_img`, `company_name`, `address1`, `address2`, `company_number`, `default_invoice_city`, `default_invoice_bank_name`, `default_invoice_bank_account_no`, `default_invoice_additional_info`, `company_logo_file_path`) VALUES
(29, 'testUser', '$2y$10$bjIjaZnUtQ8MfGWPNSbWkOySQ3YH/dYx22QAwUtYRT9oSOVUWbK3K', 'test@test.com', 'default_avatar.png', 'Hairdresser BeSmile', '266 Greenwich Street', 'Hempstead NY 11550-6317 USA', '123456789', 'New York', 'Citibank', '00 1111 2222 3333 4444 5555 6666', 'This transaction is exempt from sales tax under the provision of New York Tax Code Section 12345.', 'testUser_logo_2023-08-11.png');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=572;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
