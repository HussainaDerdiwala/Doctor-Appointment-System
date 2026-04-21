-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2025 at 09:37 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aemail` varchar(255) NOT NULL,
  `apassword` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aemail`, `apassword`) VALUES
('admin@edoc.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appoid` int(11) NOT NULL,
  `pid` int(10) DEFAULT NULL,
  `apponum` int(3) DEFAULT NULL,
  `scheduleid` int(10) DEFAULT NULL,
  `appodate` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appoid`, `pid`, `apponum`, `scheduleid`, `appodate`) VALUES
(6, 1, 1, 9, '2025-09-18'),
(2, 2, 1, 11, '2025-07-28'),
(3, 1, 1, 11, '2025-09-01'),
(7, 1, 1, 12, '2025-09-18'),
(8, 1, 1, 1, '2025-09-18'),
(9, 1, 1, 4, '2025-09-18'),
(10, 1, 1, 13, '2025-09-30');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `docid` int(11) NOT NULL,
  `docemail` varchar(255) DEFAULT NULL,
  `docname` varchar(255) DEFAULT NULL,
  `docpassword` varchar(255) DEFAULT NULL,
  `doctel` varchar(15) DEFAULT NULL,
  `specialties` int(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`docid`, `docemail`, `docname`, `docpassword`, `doctel`, `specialties`) VALUES
(5, 'info@sterlinghospitals.com', 'Dr. Sankalp Vanzara', 'Sankalp@123', '98-98-98-78-78', 1),
(6, 'info@vedanthospitalrajkot.in', 'Dr. Sandeep Harsora', 'Sandeep@123', '+918048034831', 1),
(7, 'arkhomeopathicrajkot@gmail.com', 'Dr. Paresh Kared', 'Prakash@123', '+91?8048034845', 2),
(8, 'smayankhospital@gmail.com', 'Dr. Niraj Mehta', 'Niraj@123', '+91-7848334878', 2),
(9, 'sarveshwer@gmail.com', 'Dr. Snehal Dholariya', 'Snehal@123', '+91 99097 51284', 3),
(10, 'pacaiimsrajkot@gmail.com', 'Dr. Abhilasha Motghare', 'Abhilasha@123', '+91-281-2970501', 3),
(11, 'enquire@wockhardthospitals.com', 'Dr. Nisarg Thakkar', 'Nisarg@123', '+91 1800-22-180', 4),
(12, 'adaljaclinic@gmail.com', 'Dr. Harshad Adalja', 'Harshad@123', '02812970892', 4),
(13, 'hcgrajkot@gmail.com', 'Dr. Aamir Kazmi', 'Aamir@123', ' 0281-6191000', 5),
(14, 'enquiry@synergyhospital.co.in', ' Dr. Kinjal Bhatt', 'Kinjal@123', '+91-95121 40058', 5),
(15, 'info@hjdoshihospital.org', ' Dr. Bhavesh Kotak', 'Bhavesh@123', '0281-2388994', 6),
(16, 'neuronhospital.rajkot@gmail.com', 'Dr. Ankit Patel', 'Ankit@123', '+91-97997 70270', 6),
(17, 'lifelinelabrajkot@gmail.com', 'Dr. Nikunj Mehta', 'Nikunj@123', ' +91 281 248085', 7),
(18, 'apexlabrajkot@gmail.com', 'Dr. Hitesh Gadhvi', 'Hitesh@123', '+91 99099 12345', 7),
(19, 'rclalani@yahoo.co.in', 'Dr. Rajendra Lalani', 'Rajendra@123', '+91 94280-10185', 8),
(20, 'jaysadguruhospital@gmail.com', 'Dr. Rachana Solanki', 'Rachana@123', '+91-94280 03755', 8),
(21, 'drdushyantsankalia@gmail.com', 'Dr. Dushyant M. Sankalia', 'Dushyant@123', '+91-99099 87672', 9),
(22, 'info@childneurologyrajkot.com', 'Dr. Deepak Dhami', 'Deepak@123', '94087-89798', 9),
(23, 'hello@hexahealth.com', 'Dr. Shilpa Kumari Patel', 'Shilpa@123', '+91-80699-23891', 10),
(24, 'drvikashjain@outlook.com', 'Dr. Vikash Jain', 'Viksash@123', '+91-9313828405 ', 10),
(25, 'Hello@harshahospital.com', 'Dr.Maitrey G. Bhalodia', 'Maitry@123', '94282-27710', 11),
(26, 'info@thefacialsurgery.com', 'Dr. Kaushik Pethani', 'Kaushik@123', '+91-94266-48485', 11),
(27, 'dr.pmramotia1@gmail.com', 'Dr. P. M. Ramotia', 'Pm@123', '+91-9558105490', 12),
(28, 'drshahbhavesh@gmail.com', 'Dr. Bhavesh Shah', 'Bhavesh@123', '+91 84600 00120', 12),
(29, 'info@therejuveneclinic.com', 'Dr. K. B.Pandya', 'Kb@123', '+91-97372 39239', 13),
(30, 'vividcare@gmail.com', 'Dr. Pratik Sheth', 'Pratik@123', '+91?99257?87879', 13),
(31, 'drpankajpatel.endo@gmail.com', 'Dr. Pankaj M. Patel', 'Pankaj@123', '+91?95866?05660', 14),
(32, 'harshdurg@gmail.com', 'Dr. Harsh Durgia', 'Harsh@123', '0281?2449959', 14),
(33, 'info@gokulhospital.com', 'Dr. Ankit Makadia', 'Ankit@123', '+91?990910458', 15),
(34, 'info@shreegirirajhospital.com', 'Dr. Nikunj D. Patel', 'Nikunj@123', '0281?7151200', 15),
(35, 'apkamani@gmail.com', 'Dr. Praful Kamani', 'Praful@123', '+91 9913599699', 16),
(36, 'dr_paras_shah@hotmail.com', 'Dr. Paras D. Shah', 'Paras@123', '+91 7575036524', 16),
(37, 'info@westernsurgical.in', 'Dr. Amit Jetani', 'Amit@123', '+91?281?222?967', 17),
(38, 'vedanthospitalrajkot@gmail.com', 'Dr. Paras D. Shah', 'Paras@123', '+91?281?2442722', 17),
(39, 'info@arpanlab.com', 'Dr. Chirag Saparia', 'Chirag@123', '+91?281?258?869', 18),
(40, 'drjatin@hotmail.com', 'Dr.?Jatin Bhatt', 'Jatin@123', '9428894466 ', 18),
(41, 'drkathiria@gmail.com', 'Dr.?Vallabhbhai?R.?Kathiria', 'Vallabh@123', '+91?9868180576', 19),
(42, 'christhospitalrajkot@gmail.com', 'Dr. Girish Patel ', 'Girish@123', '+91?80000?33367', 19),
(43, 'ramanathrheumaticcentre@gmail.com', 'Dr. Bhavin Bhatt', 'Bhavin@123', '76210?21795', 21),
(44, 'drdhavalt@gmail.com', 'Dr. Dhaval Tanna', 'Dhaval@123', '+91?81601?12380', 21),
(45, 'akahsh@gmail.com', 'Dr. Aakash R. Doshi', 'Akash@123', '+91?81601?12895', 22),
(46, 'drvinod@yahoo.com', 'Dr. Vinod Rakholia', 'vinod@123', '+91?80699?23891', 23),
(47, 'padhia@gmail.com', 'Dr. Abhishek Padhi', 'abhi@123', '09913599690', 24),
(48, 'synergyhospitals@gmail.com', 'Dr. Sanjay Teelala', 'sanjay@123', '02812970580', 28),
(49, 'drgauravdave@gmail.com', 'Dr. Gaurav Dave', 'Gaurav@123', '84600?21003', 29),
(50, 'jasalfaciallab@gmail.com', 'Dr. Major Ram Krishna', 'majorrk@123', '09913599780', 25),
(51, 'ashviagra@gmail.com', 'Dr. Ashwini Agarwal ', 'ashvi@123', '09913599689', 26),
(52, 'enquiry@synergyhospitals.co.in', 'Dr. Ronak Bhalodia', 'ronak@123', '09913599799', 27),
(53, 'krishnahospitals@gmail.com', 'Dr. Gaurang Vaghani', 'Vagani@123', '09913599688', 30),
(54, 'careservecenter@gmail.com', 'Dr. Sneha Dhillon', 'sneh@123', '07575036529', 31),
(55, 'jyotishah@gmail.com', 'Dr. Jyoti Shah', 'JYOTI@123', '+91 07947115551', 32),
(56, 'chintan@gmail.com', 'Dr. Chintan Bundela', 'chintan@123', '+91 84888 00108', 33),
(57, 'darshaneyecarerajkot@gmail.com', 'Dr. Pratish Savjiani', 'pratish@123', '+91 7859878599', 34),
(58, 'ketan.thakkar@akshathospital.com', 'Dr. Ketan Thakkar', 'ketan@123', '+91 90990?62766', 35),
(59, 'darshan@gmail.com', 'Dr. Darshan Bhatt', 'darshan@123', '+91 94094 26842', 36),
(60, 'niraj@gmail.com', 'Dr. Niraj Patel', 'niraj@123', '+91 94091 37278', 37),
(61, 'niravk@gmail.com', 'Dr. Nirav J. Karmata', 'nirav@123', '07941058565', 38),
(62, 'krishnapatel@email.com', 'Dr. Krishna Patel', 'krish@123', '+91?93693?93193', 39),
(63, 'pharmacologyaiimsrajkot@gmail.com', 'Dr. Rima Shah', 'rima@123', '+918140140573', 40),
(64, 'drsamir@gmail.com', 'Dr. Samir Prajapati', 'samirp@123', '07947131740', 41),
(65, 'mail@alluras.in', 'Dr. Nilesh Padodara', 'nilesh@123', '+91 886 6533355', 42),
(66, 'drcfootwearclinic@gmail.com', 'Dr. Shailesh D. Chhotala', 'sailesh@123', '+91?85110?29949', 43),
(67, 'dramishsanghvi@gmail.com', 'Dr.Amish Sanghvi', 'Amish@123', '9904043393', 44),
(68, 'info@pradipdalsaniya.com', 'Dr.Pradip Dalsaniya', 'pradip@123', '+91?92656?81856', 45),
(69, 'dda.aiimsrajkot@gmail.com', 'Dr. Bhavesh Modi', 'bhavesh@123', '+91?81286?40573', 46),
(70, 'vikasjain@email.com', 'Dr. Vikas Jain', 'vikas@123', '+91 281 222 000', 47),
(71, 'info@rajkotcancersociety.org', 'Dr. Chandani Shah', 'chandni@123', '+91-281-3526300', 48),
(72, 'shwas.rajkot@gmail.com', 'Dr. Abhay Javia', 'abhay@123', '+91 281 234 567', 49),
(73, 'rheucentre@gmail.com', 'Dr. S.S. Chikani', 'chikani@123', '+91 89057 99922', 50),
(74, 'support@docgenie.in', 'Dr. Anwesha Biswas', 'anwesha@123', '+91 98 1809 326', 51),
(75, 'sarveshwerprasad@gmail.com', 'Dr. Sarveshwar Prasad', 'sarveshwar@123', '+91 99097 51284', 1),
(76, 'krutarth@gamil.com', 'Dr. Krutarth Kanjiya', 'krutarth@123', '+91 9898987878', 53),
(77, 'rajesh@gmail.com', 'Dr. Rajesh Ganatra', 'rajesh@123', ' +91 7947105575', 54),
(78, 'divyesh@gmail.com', 'Dr. Divyesh Rathod', 'divyesh@123', '+91 7947427347', 55),
(79, 'suresh@gmail.com', 'Dr. Suresh Joshipura', 'suresh@123', '+91 7942684435', 56);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `pid` int(11) NOT NULL,
  `pemail` varchar(255) DEFAULT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `ppassword` varchar(255) DEFAULT NULL,
  `paddress` varchar(255) DEFAULT NULL,
  `pdob` date DEFAULT NULL,
  `ptel` varchar(15) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pid`, `pemail`, `pname`, `ppassword`, `paddress`, `pdob`, `ptel`) VALUES
(1, 'patient@edoc.com', 'Test Patient', '123', 'Mumbai', '2000-01-01', '+919328245037'),
(2, 'avikaskole786@gmail.com', 'aVikas Kole', '123', 'Pandharpur', '2000-01-10', '+917219447058'),
(3, 'sarangkadam2020@gmail.com', 'Sarang Kadam', '123', 'Kolhapur', '2002-06-03', '+917517562020');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `scheduleid` int(11) NOT NULL,
  `docid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `scheduledate` date DEFAULT NULL,
  `scheduletime` time DEFAULT NULL,
  `nop` int(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleid`, `docid`, `title`, `scheduledate`, `scheduletime`, `nop`) VALUES
(1, 11, 'Test Session', '2033-01-08', '18:00:00', 10),
(2, 1, '1', '2024-06-10', '20:36:00', 1),
(3, 1, '12', '2024-06-10', '20:33:00', 1),
(4, 16, '1', '2034-06-02', '12:32:00', 1),
(5, 1, '1', '2024-06-10', '20:35:00', 1),
(6, 1, '12', '2024-06-10', '20:35:00', 1),
(7, 1, '1', '2025-06-24', '20:36:00', 1),
(8, 1, '12', '2025-06-10', '13:33:00', 1),
(9, 19, 'Cardiology', '2025-10-24', '12:47:00', 10),
(10, 44, 'session1', '2025-09-16', '04:06:00', 10),
(11, 21, 'nn', '2025-09-01', '02:18:00', 1),
(12, 10, 'doctor1', '2025-11-18', '18:42:00', 3),
(13, 74, 'As', '2025-10-03', '12:38:00', 12);

-- --------------------------------------------------------

--
-- Table structure for table `specialties`
--

CREATE TABLE `specialties` (
  `id` int(2) NOT NULL,
  `sname` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specialties`
--

INSERT INTO `specialties` (`id`, `sname`) VALUES
(1, 'Accident and emergency medicine'),
(2, 'Allergology'),
(3, 'Anaesthetics'),
(4, 'Biological hematology'),
(5, 'Cardiology'),
(6, 'Child psychiatry'),
(7, 'Clinical biology'),
(8, 'Clinical chemistry'),
(9, 'Clinical neurophysiology'),
(10, 'Clinical radiology'),
(11, 'Dental, oral and maxillo-facial surgery'),
(12, 'Dermato-venerology'),
(13, 'Dermatology'),
(14, 'Endocrinology'),
(15, 'Gastro-enterologic surgery'),
(16, 'Gastroenterology'),
(17, 'General hematology'),
(18, 'General Practice'),
(19, 'General surgery'),
(20, 'Geriatrics'),
(21, 'Immunology'),
(22, 'Infectious diseases'),
(23, 'Internal medicine'),
(24, 'Laboratory medicine'),
(25, 'Maxillo-facial surgery'),
(26, 'Microbiology'),
(27, 'Nephrology'),
(28, 'Neuro-psychiatry'),
(29, 'Neurology'),
(30, 'Neurosurgery'),
(31, 'Nuclear medicine'),
(32, 'Obstetrics and gynecology'),
(33, 'Occupational medicine'),
(34, 'Ophthalmology'),
(35, 'Orthopaedics'),
(36, 'Otorhinolaryngology'),
(37, 'Paediatric surgery'),
(38, 'Paediatrics'),
(39, 'Pathology'),
(40, 'Pharmacology'),
(41, 'Physical medicine and rehabilitation'),
(42, 'Plastic surgery'),
(43, 'Podiatric Medicine'),
(44, 'Podiatric Surgery'),
(45, 'Psychiatry'),
(46, 'Public health and Preventive Medicine'),
(47, 'Radiology'),
(48, 'Radiotherapy'),
(49, 'Respiratory medicine'),
(50, 'Rheumatology'),
(51, 'Stomatology'),
(52, 'Thoracic surgery'),
(53, 'Tropical medicine'),
(54, 'Urology'),
(55, 'Vascular surgery'),
(56, 'Venereology');

-- --------------------------------------------------------

--
-- Table structure for table `webuser`
--

CREATE TABLE `webuser` (
  `email` varchar(255) NOT NULL,
  `usertype` char(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webuser`
--

INSERT INTO `webuser` (`email`, `usertype`) VALUES
('admin@edoc.com', 'a'),
('info@sterlinghospitals.com', 'd'),
('patient@edoc.com', 'p'),
('emhashenudara@gmail.com', 'p'),
('hussuderdiwala@gmail.com', 'p'),
('info@vedanthospitalrajkot.in', 'd'),
('arkhomeopathicrajkot@gmail.com', 'd'),
('smayankhospital@gmail.com', 'd'),
('sarveshwer@gmail.com', 'd'),
('pacaiimsrajkot@gmail.com', 'd'),
('enquire@wockhardthospitals.com', 'd'),
('adaljaclinic@gmail.com', 'd'),
('hcgrajkot@gmail.com', 'd'),
('enquiry@synergyhospital.co.in', 'd'),
('info@hjdoshihospital.org', 'd'),
('neuronhospital.rajkot@gmail.com', 'd'),
('lifelinelabrajkot@gmail.com', 'd'),
('apexlabrajkot@gmail.com', 'd'),
('rclalani@yahoo.co.in', 'd'),
('jaysadguruhospital@gmail.com', 'd'),
('drdushyantsankalia@gmail.com', 'd'),
('info@childneurologyrajkot.com', 'd'),
('hello@hexahealth.com', 'd'),
('drvikashjain@outlook.com', 'd'),
('Hello@harshahospital.com', 'd'),
('info@thefacialsurgery.com', 'd'),
('dr.pmramotia1@gmail.com', 'd'),
('drshahbhavesh@gmail.com', 'd'),
('info@therejuveneclinic.com', 'd'),
('vividcare@gmail.com', 'd'),
('drpankajpatel.endo@gmail.com', 'd'),
('harshdurg@gmail.com', 'd'),
('info@gokulhospital.com', 'd'),
('info@shreegirirajhospital.com', 'd'),
('apkamani@gmail.com', 'd'),
('dr_paras_shah@hotmail.com', 'd'),
('info@westernsurgical.in', 'd'),
('vedanthospitalrajkot@gmail.com', 'd'),
('info@arpanlab.com', 'd'),
('drjatin@hotmail.com', 'd'),
('drkathiria@gmail.com', 'd'),
('christhospitalrajkot@gmail.com', 'd'),
('ramanathrheumaticcentre@gmail.com', 'd'),
('drdhavalt@gmail.com', 'd'),
('akahsh@gmail.com', 'd'),
('drvinod@yahoo.com', 'd'),
('padhia@gmail.com', 'd'),
('synergyhospitals@gmail.com', 'd'),
('drgauravdave@gmail.com', 'd'),
('jasalfaciallab@gmail.com', 'd'),
('ashviagra@gmail.com', 'd'),
('enquiry@synergyhospitals.co.in', 'd'),
('krishnahospitals@gmail.com', 'd'),
('careservecenter@gmail.com', 'd'),
('jyotishah@gmail.com', 'd'),
('chintan@gmail.com', 'd'),
('darshaneyecarerajkot@gmail.com', 'd'),
('ketan.thakkar@akshathospital.com', 'd'),
('darshan@gmail.com', 'd'),
('niraj@gmail.com', 'd'),
('niravk@gmail.com', 'd'),
('krishnapatel@email.com', 'd'),
('pharmacologyaiimsrajkot@gmail.com', 'd'),
('drsamir@gmail.com', 'd'),
('mail@alluras.in', 'd'),
('drcfootwearclinic@gmail.com', 'd'),
('dramishsanghvi@gmail.com', 'd'),
('info@pradipdalsaniya.com', 'd'),
('dda.aiimsrajkot@gmail.com', 'd'),
('vikasjain@email.com', 'd'),
('info@rajkotcancersociety.org', 'd'),
('shwas.rajkot@gmail.com', 'd'),
('rheucentre@gmail.com', 'd'),
('support@docgenie.in', 'd'),
('sarveshwerprasad@gmail.com', 'd'),
('krutarth@gamil.com', 'd'),
('rajesh@gmail.com', 'd'),
('divyesh@gmail.com', 'd'),
('suresh@gmail.com', 'd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aemail`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appoid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `scheduleid` (`scheduleid`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`docid`),
  ADD KEY `specialties` (`specialties`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`scheduleid`),
  ADD KEY `docid` (`docid`);

--
-- Indexes for table `specialties`
--
ALTER TABLE `specialties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `webuser`
--
ALTER TABLE `webuser`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `docid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `scheduleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
