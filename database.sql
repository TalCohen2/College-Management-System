-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2021 at 03:08 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `college management system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `hash` varchar(150) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `role_id`, `first_name`, `last_name`, `phone`, `email`, `hash`, `image`) VALUES
(15, 1, 'Tal', 'Cohen', '050123123123', 'tal@hitech.com', '$2y$07$xZ.pPDKD1Jk7u5.iBX/FE.39kXkB8RBj4zts1/jfPfcqJSoLZKasW', 'tal1521921915.jpg'),
(49, 2, 'Lucy', 'Bowman', '050231321321', 'Lucy@hitech.com', '$2y$07$c90FMYzYrKkH/OXcDU4SmeXfZhThsQ7dp2jcunAf3bk7SWR91gnvK', 'tal1521756414.jpg'),
(50, 3, 'Gresham', 'Brooks', '052321321321', 'Gresham@hitech.com', '$2y$07$kDz6QMWSpcDsgSrhQtg9AOaJZqfViZfDh5wW10oGv4hJLsNVhNsYm', 'tal1521756465.jpg'),
(51, 3, 'Winifred', 'Barlow', '054231321123', 'Winifred@hitech.com', '$2y$07$KCGeLomtU9v7si2NuSXNS.VwhNXje6heMpEIfaG9B6rUZMwpeHoJS', 'tal1521756616.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `image`) VALUES
(79, 'Angular', 'AngularJS (commonly referred to as \"Angular.js\" or \"AngularJS 1.X\") is a JavaScript-based open-source front-end web application framework mainly maintained by Google and by a community of individuals and corporations to address many of the challenges encountered in developing single-page applications. The JavaScript components complement Apache Cordova, a framework used for developing cross-platform mobile apps. It aims to simplify both the development and the testing of such applications by providing a framework for client-side model–view–controller (MVC) and model–view–viewmodel (MVVM) architectures, along with components commonly used in rich Internet applications. In 2014, the original AngularJS team began working on Angular (Application Platform).\r\n\r\nThe AngularJS framework works by first reading the HTML page, which has additional custom tag attributes embedded into it. Angular interprets those attributes as directives to bind input or output parts of the page to a model that is represented by standard JavaScript variables. The values of those JavaScript variables can be manually set within the code, or retrieved from static or dynamic JSON resources.\r\n\r\nAccording to JavaScript analytics service Libscore, AngularJS is used on the websites of Wolfram Alpha, NBC, Walgreens, Intel, Sprint, ABC News, and about 12,000 other sites out of 1 million tested in October 2016.[3] AngularJS is currently in the top 100 of the most starred projects on GitHub.[4]\r\n\r\nAngularJS is the frontend part of the MEAN stack, consisting of MongoDB database, Express.js web application server framework, Angular.js itself, and Node.js server runtime environment.', 'tal1521755073.jpg'),
(80, 'OOP', 'Object-oriented programming (OOP) is a programming paradigm based on the concept of \"objects\", which may contain data, in the form of fields, often known as attributes; and code, in the form of procedures, often known as methods. A feature of objects is that an object\'s procedures can access and often modify the data fields of the object with which they are associated (objects have a notion of \"this\" or \"self\"). In OOP, computer programs are designed by making them out of objects that interact with one another.[1][2] There is significant diversity of OOP languages, but the most popular ones are class-based, meaning that objects are instances of classes, which typically also determine their type.\r\n\r\nMany of the most widely used programming languages (such as C++, Object Pascal, Java, Python etc.) are multi-paradigm programming languages that support object-oriented programming to a greater or lesser degree, typically in combination with imperative, procedural programming. Significant object-oriented languages include Java, C++, C#, Python, PHP, Ruby, Perl, Object Pascal, Objective-C, Dart, Swift, Scala, Common Lisp, and Smalltalk.', 'tal1521755256.png'),
(81, 'MySql', 'MySQL (officially pronounced as /ma? ??skju???l/ \"My S-Q-L\",[6]) is an open-source relational database management system (RDBMS).[7] Its name is a combination of \"My\", the name of co-founder Michael Widenius\'s daughter,[8] and \"SQL\", the abbreviation for Structured Query Language. The MySQL development project has made its source code available under the terms of the GNU General Public License, as well as under a variety of proprietary agreements. MySQL was owned and sponsored by a single for-profit firm, the Swedish company MySQL AB, now owned by Oracle Corporation.[9] For proprietary use, several paid editions are available, and offer additional functionality.\r\n\r\nMySQL is a central component of the LAMP open-source web application software stack (and other \"AMP\" stacks). LAMP is an acronym for \"Linux, Apache, MySQL, Perl/PHP/Python\". Applications that use the MySQL database include: TYPO3, MODx, Joomla, WordPress, Simple Machines Forum, phpBB, MyBB, and Drupal. MySQL is also used in many high-profile, large-scale websites, including Google[10][11] (though not for searches), Facebook,[12][13][14] Twitter,[15] Flickr,[16] and YouTube.[17]', 'tal1521755309.png'),
(82, 'node.js', 'Node.js is an open-source, cross-platform JavaScript run-time environment that executes JavaScript code server-side. Historically, JavaScript was used primarily for client-side scripting, in which scripts written in JavaScript are embedded in a webpage\'s HTML and run client-side by a JavaScript engine in the user\'s web browser. Node.js lets developers use JavaScript for server-side scripting—running scripts server-side to produce dynamic web page content before the page is sent to the user\'s web browser. Consequently, Node.js represents a \"JavaScript everywhere\" paradigm,[5] unifying web application development around a single programming language, rather than different languages for server side and client side scripts.\r\n\r\nThough .js is the conventional filename extension for JavaScript code, the name \"Node.js\" does not refer to a particular file in this context and is merely the name of the product. Node.js has an event-driven architecture capable of asynchronous I/O. These design choices aim to optimize throughput and scalability in web applications with many input/output operations, as well as for real-time Web applications (e.g., real-time communication programs and browser games).[6]\r\n\r\nThe Node.js distributed development project, governed by the Node.js Foundation,[7] is facilitated by the Linux Foundation\'s Collaborative Projects program.[8]\r\n\r\nCorporate users of Node.js software include GoDaddy,[9] Groupon,[10] IBM,[11] LinkedIn,[12][13] Microsoft,[14][15] Netflix,[16] PayPal,[17][18] Rakuten, SAP, Tuenti,[19] Voxer,[20] Walmart,[21] and Yahoo!.[22]', 'tal1521755353.jpg'),
(83, 'PHP', 'PHP is a server-side scripting language designed for web development but also used as a general-purpose programming language. It is originally created by Rasmus Lerdorf in 1994,[3] the PHP reference implementation is now produced by The PHP Group.[4] PHP originally stood for Personal Home Page,[3] but it now stands for the recursive acronym PHP: Hypertext Preprocessor[5]\r\n\r\nPHP code may be embedded into HTML code, or it can be used in combination with various web template systems, web content management systems, and web frameworks. PHP code is usually processed by a PHP interpreter implemented as a module in the web server or as a Common Gateway Interface (CGI) executable. The web server combines the results of the interpreted and executed PHP code, which may be any type of data, including images, with the generated web page. PHP code may also be executed with a command-line interface (CLI) and can be used to implement standalone graphical applications.[6]\r\n\r\nThe standard PHP interpreter, powered by the Zend Engine, is free software released under the PHP License. PHP has been widely ported and can be deployed on most web servers on almost every operating system and platform, free of charge.[7]\r\n\r\nThe PHP language evolved without a written formal specification or standard until 2014, leaving the canonical PHP interpreter as a de facto standard. Since 2014 work has gone on to create a formal PHP specification.[8]\r\n\r\nDuring the 2010s there have been increased efforts towards standardisation and code sharing in PHP applications by projects such as PHP-FIG in the form of PSR-initiatives as well as Composer dependency manager and the Packagist repository. PHP hosts a diverse array of web frameworks requiring framework-specific knowledge, with Laravel recently emerging as a popular option by incorporating ideas made popular from other competing non-PHP web frameworks, like Ruby on Rails.', 'tal1521755381.png'),
(84, 'AJAX', 'Ajax (also AJAX; /?e?d?æks/; short for \"Asynchronous JavaScript + XML\")[1][2] is a set of Web development techniques using many Web technologies on the client side to create asynchronous Web applications. With Ajax, Web applications can send and retrieve data from a server asynchronously (in the background) without interfering with the display and behavior of the existing page. By decoupling the data interchange layer from the presentation layer, Ajax allows Web pages, and by extension Web applications, to change content dynamically without the need to reload the entire page.[3] In practice, modern implementations commonly utilize JSON instead of XML due to the advantages of JSON being native to JavaScript.[4]\r\n\r\nAjax is not a single technology, but rather a group of technologies. HTML and CSS can be used in combination to mark up and style information. The webpage can then be modified by JavaScript to dynamically display – and allow the user to interact with — the new information. The built-in XMLHttpRequest object within JavaScript is commonly used to execute Ajax on webpages allowing websites to load content onto the screen without refreshing the page. Ajax is also not a new technology, or another different language, just existing technologies used in new ways.', 'tal1521755563.png'),
(85, 'JavaScript', 'JavaScript (/?d???v??skr?pt/),[6] often abbreviated as JS, is a high-level, interpreted programming language. It is a language which is also characterized as dynamic, weakly typed, prototype-based and multi-paradigm. Alongside HTML and CSS, JavaScript is one of the three core technologies of World Wide Web content engineering. It is used to make webpages interactive and provide online programs, including video games. The majority of websites employ it, and all modern web browsers support it without the need for plug-ins by means of a built-in JavaScript engine. Each of the many JavaScript engines represent a different implementation of JavaScript, all based on the ECMAScript specification, with some engines not supporting the spec fully, and with many engines supporting additional features beyond ECMA.\r\n\r\nAs a multi-paradigm language, JavaScript supports event-driven, functional, and imperative (including object-oriented and prototype-based) programming styles. It has an API for working with text, arrays, dates, regular expressions, and basic manipulation of the DOM, but the language itself does not include any I/O, such as networking, storage, or graphics facilities, relying for these upon the host environment in which it is embedded.\r\n\r\nInitially only implemented client-side in web browsers, JavaScript engines are now embedded in many other types of host software, including server-side in web servers and databases, and in non-web programs such as word processors and PDF software, and in runtime environments that make JavaScript available for writing mobile and desktop applications, including desktop widgets.\r\n\r\nAlthough there are strong outward similarities between JavaScript and Java, including language name, syntax, and respective standard libraries, the two languages are distinct and differ greatly in design; JavaScript was influenced by programming languages such as Self and Scheme.[7]', 'tal1521755609.png');

-- --------------------------------------------------------

--
-- Table structure for table `pivot`
--

CREATE TABLE `pivot` (
  `id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `course_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pivot`
--

INSERT INTO `pivot` (`id`, `student_id`, `course_id`) VALUES
(386, 97, 79),
(387, 97, 81),
(388, 97, 82),
(389, 97, 83),
(390, 97, 85),
(395, 94, 79),
(396, 94, 80),
(397, 94, 81),
(398, 94, 82),
(399, 95, 79),
(400, 95, 83),
(401, 95, 85),
(402, 96, 79),
(403, 96, 80),
(404, 96, 81),
(409, 98, 79),
(410, 98, 81),
(411, 98, 83),
(412, 98, 85),
(413, 99, 79);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` bigint(20) NOT NULL,
  `role_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_name`) VALUES
(1, 'owner'),
(2, 'manager'),
(3, 'sales');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `first_name`, `last_name`, `phone`, `email`, `image`) VALUES
(94, 'Kevin ', 'Motley', '01932123123', 'Kevin@hitech.com', 'tal1521755657.jpg'),
(95, 'Laurel ', 'Young', '21123123', 'Laurel@hitech.com', 'tal1521755720.jpg'),
(96, 'Roderick ', 'Ortega', '123123', 'Roderick@hitech.com', 'tal1521755771.jpg'),
(97, 'Serena ', 'Daniels', '123131', 'Serena@hitech.com', 'tal1521755819.jpg'),
(98, 'Jade', 'Norman', '19283192083', 'Jade@hitech.com', 'tal1521755933.jpg'),
(99, 'Alanna', 'Wood', '6543216132', 'Alanna@hitech.com', 'tal1521756144.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_fk0` (`role_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pivot`
--
ALTER TABLE `pivot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pivot_fk0` (`student_id`),
  ADD KEY `pivot_fk1` (`course_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `pivot`
--
ALTER TABLE `pivot`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=414;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_fk0` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Constraints for table `pivot`
--
ALTER TABLE `pivot`
  ADD CONSTRAINT `pivot_fk0` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `pivot_fk1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
