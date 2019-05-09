
CREATE TABLE `bezeroak` (
  `id` int(11) NOT NULL,
  `izena` varchar(100) NOT NULL,
  `abizena` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `helbidea` varchar(200) NOT NULL,
  `herria` varchar(100) NOT NULL,
  `herrialdea` varchar(100) NOT NULL,
  `pk` int(11) NOT NULL,
  `pass` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `erabiltzaileak` (
  `id` int(11) NOT NULL,
  `izena` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `pasahitza` varchar(300) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE `eskariak` (
  `id` int(11) NOT NULL,
  `id_bezeroa` int(11) NOT NULL,
  `salneurria` float NOT NULL,
  `ordainketa` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `eskariak_produktuak` (
  `id` int(11) NOT NULL,
  `id_produktoa` int(11) NOT NULL,
  `id_bezeroa` int(11) NOT NULL,
  `kantitatea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `produktuak` (
  `id` int(11) NOT NULL,
  `salneurria` float NOT NULL,
  `kantitatea` int(11) NOT NULL,
  `kategoria` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE `produktuak_lang` (
  `id` int(11) NOT NULL,
  `id_produktoa` int(11) NOT NULL,
  `hizkuntza` varchar(3) NOT NULL,
  `izena` varchar(100) NOT NULL,
  `deskribapena` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `bezeroak`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `erabiltzaileak`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `eskariak`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `eskariak_produktuak`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `produktuak`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `produktuak_lang`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bezeroak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `erabiltzaileak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `eskariak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `eskariak_produktuak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `produktuak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `produktuak_lang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


