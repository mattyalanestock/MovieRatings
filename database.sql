SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `movies` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` tinytext NOT NULL,
  `upvotes` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `downvotes` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

INSERT INTO `movies` (`id`, `title`, `upvotes`, `downvotes`) VALUES
(1, 'Star Wars: Episode I - The Phantom Menace', 0, 0),
(2, 'Star Wars: Episode II - Attack of the Clones', 0, 0),
(3, 'Star Wars: Episode III - Revenge of the Sith', 0, 0),
(4, 'Star Wars: Episode IV - A New Hope', 0, 0),
(5, 'Star Wars: Episode V - The Empire Strikes Back', 0, 0),
(6, 'Star Wars: Episode VI - Return of the Jedi', 0, 0),
(7, 'Star Wars: Episode VII - The Force Awakens', 0, 0),
(8, 'Star Wars: Episode VIII - The Last Jedi', 0, 0),
(9, 'Star Wars: Episode IV - The Rise of Skywalker', 0, 0);

CREATE TABLE `votes` (
  `id` int(10) UNSIGNED NOT NULL,
  `movie_id` int(11) NOT NULL,
  `vote` tinyint(1) DEFAULT NULL COMMENT '0: down, 1: up',
  `ip_address` varchar(50) NOT NULL,
  `entrydate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vote` (`vote`);


ALTER TABLE `movies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `votes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
