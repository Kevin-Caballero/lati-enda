-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-09-2023 a las 19:20:43
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ce1pra`
--

-- Crea la base de datos si no existe
CREATE DATABASE IF NOT EXISTS `ce1pra`;

-- Usa la base de datos
USE `ce1pra`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(9) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`, `image_url`) VALUES
(1, 'Libros', 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5a/Books_HD_%288314929977%29.jpg/800px-Books_HD_%288314929977%29.jpg'),
(2, 'Películas', 'https://cdn.colombia.com/sdi/2020/03/25/taquilla-en-los-cines-no-registra-datos-821333.jpg'),
(3, 'Música', 'https://cnnespanol.cnn.com/wp-content/uploads/2023/03/230310191236-discos-vinilo-superan-ventas-compactos-redaccion-mexico-00000105-full-169.jpg?quality=100&strip=info'),
(4, 'Videojuegos', 'https://static-uat.cambiocolombia.com/s3fs-public/2023-09/equipo-videojuegos-futurista-iluminado-ia-generativa-discoteca.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customers`
--

CREATE TABLE `customers` (
  `id` int(9) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `customers`
--

INSERT INTO `customers` (`id`, `name`, `address`, `email`, `password`) VALUES
(1, 'Juan Pérez', '123 Calle Principal, Ciudad', 'juan@email.com', 'contraseña1'),
(2, 'María Rodríguez', '456 Avenida Central, Ciudad', 'maria@email.com', 'contraseña2'),
(3, 'Carlos López', '789 Calle Secundaria, Ciudad', 'carlos@email.com', 'contraseña3'),
(4, 'Ana García', '101 Calle Ejemplo, Ciudad', 'ana@email.com', 'contraseña4'),
(5, 'Pedro Martínez', '202 Avenida de Muestra, Ciudad', 'pedro@email.com', 'contraseña5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` int(9) NOT NULL,
  `customer_id` int(9) NOT NULL,
  `date` date NOT NULL,
  `total_amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `date`, `total_amount`) VALUES
(1, 1, '2023-09-30', 49.99),
(2, 2, '2023-09-30', 34.99),
(3, 3, '2023-09-29', 99.99),
(4, 4, '2023-09-28', 24.99),
(5, 5, '2023-09-27', 59.99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_details`
--

CREATE TABLE `order_details` (
  `id` int(9) NOT NULL,
  `order_id` int(9) NOT NULL,
  `product_id` int(9) NOT NULL,
  `quantity` int(9) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(5, 1, 1, 2, 29.99),
(6, 1, 3, 1, 20),
(7, 2, 2, 1, 14.99),
(8, 3, 5, 3, 14.99),
(9, 3, 8, 2, 17.5),
(10, 4, 10, 1, 59.99),
(11, 5, 6, 2, 22.99),
(12, 5, 9, 1, 8.99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(9) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(9) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `stock` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `image_url`, `price`, `stock`) VALUES
(1, 'El Gran Gatsby', 'Una novela clásica de F. Scott Fitzgerald.', 1, 'https://www.lecturafacil.net/media/productthumbss/el_gran_Gatsby_Portada_CAST.png.300x430_q85_crop.jpg', 15.99, 50),
(2, 'Cien años de soledad', 'La obra maestra de Gabriel García Márquez.', 1, 'https://m.media-amazon.com/images/I/61cBNloEAtL._AC_UF1000,1000_QL80_.jpg', 19.99, 40),
(3, '1984', 'La distopía de George Orwell.', 1, 'https://global-uploads.webflow.com/6034d7d1f3e0f52c50b2adee/6254291caac6d1e42e8986df_62023ceb41cd1c2807b2841a_9788418933011.jpeg', 12.99, 60),
(4, 'Harry Potter y la piedra filosofal', 'El primer libro de la saga de Harry Potter.', 1, 'https://images-eu.ssl-images-amazon.com/images/I/91R1AixEiLL.jpg', 14.99, 70),
(5, 'Matar un ruiseñor', 'Un clásico de Harper Lee.', 1, 'https://m.media-amazon.com/images/I/71EqZnXaNoL._AC_UF1000,1000_QL80_.jpg', 16.99, 45),
(6, 'Don Quijote de la Mancha', 'La obra cumbre de Cervantes.', 1, 'https://m.media-amazon.com/images/I/61dW1mWe01L._AC_UF1000,1000_QL80_.jpg', 18.99, 55),
(7, 'La sombra del viento', 'Una novela de Carlos Ruiz Zafón.', 1, 'https://m.media-amazon.com/images/I/61zOWUcvMbL._AC_UF1000,1000_QL80_.jpg', 17.99, 48),
(8, 'Crimen y castigo', 'La obra de Dostoievski.', 1, 'https://global-uploads.webflow.com/6034d7d1f3e0f52c50b2adee/6254541d8ae4df16d4e69bc8_6034d7d1f3e0f54529b2b1a1_Crimen-y-castigo-fiodor-dostoyevski-editorial-alma.jpeg', 20.99, 38),
(9, 'Los juegos del hambre', 'El inicio de la trilogía de Suzanne Collins.', 1, 'https://m.media-amazon.com/images/I/71e4kjCsuAL._AC_UF1000,1000_QL80_.jpg', 14.99, 65),
(10, 'Orgullo y prejuicio', 'La novela clásica de Jane Austen.', 1, 'https://m.media-amazon.com/images/I/81smOptGtLL._AC_UF1000,1000_QL80_.jpg', 15.99, 53),
(11, 'Fundación', 'La primera novela de la serie de ciencia ficción Fundación de Isaac Asimov.', 1, 'https://m.media-amazon.com/images/I/91ktHAuXOCL._AC_UF1000,1000_QL80_.jpghttps://m.media-amazon.com/images/I/91ktHAuXOCL._AC_UF1000,1000_QL80_.jpg', 12.99, 42),
(12, 'Yo, Robot', 'Una colección de cuentos de ciencia ficción sobre robots escrita por Isaac Asimov.', 1, 'https://www.librerias-picasso.com/imagenes/9788435/978843502134.GIF', 11.99, 36),
(13, 'El Padrino', 'La película clásica de Francis Ford Coppola.', 2, 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQjkxk1HXZqweCR7dcKnjQEI5ZjKxiyNMUqZxFLE99AQlGM5f9r', 9.99, 80),
(14, 'Titanic', 'El drama romántico dirigido por James Cameron.', 2, 'https://images.justwatch.com/poster/243429372/s718/titanic-1997.jpg', 7.99, 95),
(15, 'Pulp Fiction', 'La película de Quentin Tarantino.', 2, 'https://m.media-amazon.com/images/I/71mlgE7nUdL._AC_UF1000,1000_QL80_.jpg', 11.99, 70),
(16, 'Forrest Gump', 'La historia de Forrest Gump.', 2, 'https://www.ecartelera.com/carteles/3400/3475/002.jpg', 8.99, 110),
(17, 'El Señor de los Anillos: La Comunidad del Anillo', 'La primera película de la trilogía.', 2, 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQsomad4jdC2GDu3ACxAkRmziK946tKqo9Qib77Quq297HstON6', 12.99, 65),
(18, 'Avatar', 'La película de ciencia ficción de James Cameron.', 2, 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRXfKM55TNktHwzuxJ-4TJcNzGIPMrkbkS9xl37vTTVOrdWOvZ_', 10.99, 75),
(19, 'Jurassic Park', 'La película de aventuras de Steven Spielberg.', 2, 'https://cope-cdnmed.agilecontent.com/resources/jpg/8/3/1621492345138.jpg', 9.49, 90),
(20, 'El Rey León', 'La película animada de Disney.', 2, 'https://www.efeeme.com/wp-content/uploads/2016/06/el-rey-leon-10-06-16-b.jpg', 11.99, 80),
(21, 'Misión Imposible', 'La película de acción con Tom Cruise.', 2, 'https://es.web.img2.acsta.net/pictures/14/02/24/11/10/117666.jpg', 8.99, 105),
(22, 'Star Wars: Una nueva esperanza', 'La película original de Star Wars.', 2, 'https://sm.ign.com/ign_es/movie/s/star-wars-/star-wars-episodio-iv_y2kx.jpg', 13.99, 60),
(23, 'El Señor de los Anillos: Las Dos Torres', 'La segunda película de la trilogía "El Señor de los Anillos" dirigida por Peter Jackson.', 2, 'https://es.web.img3.acsta.net/medias/nmedia/18/89/85/69/20070008.jpg', 13.99, 29),
(24, 'El Señor de los Anillos: El Retorno del Rey', 'La tercera película de la trilogía "El Señor de los Anillos" dirigida por Peter Jackson.', 2, 'https://es.web.img2.acsta.net/medias/nmedia/18/89/68/19/20061877.jpg', 14.99, 30),
(25, '\"Thriller\" de Michael Jackson', 'El legendario álbum de Michael Jackson.', 3, 'https://images.coveralia.com/audio/m/Michael_Jackson-Thriller-Frontal.jpg', 8.99, 120),
(26, '\"Abbey Road\" de The Beatles', 'Uno de los álbumes icónicos de The Beatles.', 3, 'https://s3.amazonaws.com/arc-wordpress-client-uploads/infobae-wp/wp-content/uploads/2017/10/06032902/abbey-road-the-beatles.jpg', 9.99, 100),
(27, '\"Dark Side of the Moon\" de Pink Floyd', 'Una obra maestra del rock progresivo.', 3, 'https://graffica.info/wp-content/uploads/The-Dark-Side-of-the-Moon-03.jpg', 10.99, 90),
(28, '\"Rumours\" de Fleetwood Mac', 'Un clásico del rock.', 3, 'https://www.audiokat.com/recursos/albums/004/03828g.jpg', 7.99, 150),
(29, '\"Back in Black\" de AC/DC', 'Un icónico álbum de rock.', 3, 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3e/ACDC_Back_in_Black_cover.svg/2048px-ACDC_Back_in_Black_cover.svg.png', 11.99, 80),
(30, '\"The Wall\" de Pink Floyd', 'Otra obra maestra de Pink Floyd.', 3, 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b1/The_Wall_Cover.svg/1200px-The_Wall_Cover.svg.png', 9.99, 110),
(31, '\"Hotel California\" de Eagles', 'Un álbum legendario.', 3, 'https://www.lavanguardia.com/files/content_image_mobile_filter/uploads/2016/12/08/5fa2f9876c5dd.jpeg', 10.99, 95),
(32, '\"Nevermind\" de Nirvana', 'Un clásico del grunge.', 3, 'https://m.media-amazon.com/images/I/71DQrKpImPL._UF894,1000_QL80_.jpg', 8.99, 130),
(33, '\"Led Zeppelin IV\" de Led Zeppelin', 'Un álbum influyente del rock.', 3, 'https://musign.es/wp-content/uploads/2021/08/81SNg56GQhL._SL1425_-1-1024x1024.jpg', 10.99, 105),
(34, '\"Born to Run\" de Bruce Springsteen', 'Un clásico del rock estadounidense.', 3, 'https://www.efeeme.com/wp-content/uploads/bruce-springsteen-20-02-13-a.jpg', 9.99, 115),
(35, '"Master of Puppets" de Metallica', 'Uno de los álbumes más influyentes del thrash metal, lanzado en 1986 por Metallica.', 3, 'https://m.media-amazon.com/images/I/61T81lF9meL._UF894,1000_QL80_.jpg', 11.99, 90),
(36, '"Like a Prayer" de Madonna', 'Uno de los álbumes más icónicos de Madonna.', 3, 'https://images.coveralia.com/audio/m/Madonna-Like_a_Prayer-Frontal.jpg', 8.99, 92),
(37, 'The Legend of Zelda: Breath of the Wild', 'Un juego de aventuras de Nintendo.', 4, 'https://upload.wikimedia.org/wikipedia/en/c/c6/The_Legend_of_Zelda_Breath_of_the_Wild.jpg', 49.99, 40),
(38, 'Red Dead Redemption 2', 'Un juego de mundo abierto de Rockstar Games.', 4, 'https://image.api.playstation.com/cdn/UP1004/CUSA03041_00/Hpl5MtwQgOVF9vJqlfui6SDB5Jl4oBSq.png', 44.99, 55),
(39, 'The Witcher 3: Wild Hunt', 'Un RPG épico de CD Projekt.', 4, 'https://cdn1.epicgames.com/offer/14ee004dadc142faaaece5a6270fb628/EGS_TheWitcher3WildHuntCompleteEdition_CDPROJEKTRED_S1_2560x1440-82eb5cf8f725e329d3194920c0c0b64f', 39.99, 60),
(40, 'Grand Theft Auto V', 'Un juego de acción de mundo abierto de Rockstar Games.', 4, 'https://i.blogs.es/2c9c70/gta-20v-20portada-20grande/450_1000.webp', 34.99, 70),
(41, 'FIFA 23', 'El juego de fútbol de EA Sports.', 4, 'https://e00-marca.uecdn.es/assets/multimedia/imagenes/2022/07/18/16581597162266.jpg', 29.99, 80),
(42, 'Minecraft', 'Un juego de construcción y aventuras.', 4, 'https://xombitgames.com/files/2012/12/minecraft.jpg', 24.99, 90),
(43, 'Cyberpunk 2077', 'Un RPG de ciencia ficción de CD Projekt.', 4, 'https://cloudfront-eu-central-1.images.arcpublishing.com/diarioas/6VUNXA3WDZP2PB2OTDZVP5VZUQ.jpg', 54.99, 30),
(44, 'Call of Duty: Warzone', 'Un juego de disparos en línea.', 4, 'https://media.vandal.net/m/82925/call-of-duty-warzone-20203102215835_1.jpg', 19.99, 100),
(45, 'Animal Crossing: New Horizons', 'Un juego de simulación de vida de Nintendo.', 4, 'https://animalcrossing.nintendo.com/new-horizons/assets/img/share-tw.jpg', 44.99, 45),
(46, 'Among Us', 'Un juego multijugador en línea.', 4, 'https://uvejuegos.com/img/caratulas/65526/SQ_NSwitchDS_AmongUs.jpg', 9.99, 150),
(47, 'Dark Souls III', 'La tercera entrega de la aclamada serie Souls, conocida por su dificultad y atmósfera oscura.', 4, 'https://i1.sndcdn.com/artworks-000220587780-tt964a-t500x500.jpg', 19.99, 50),
(48, 'Sekiro: Shadows Die Twice', 'Un juego de acción y aventuras en tercera persona desarrollado por FromSoftware.', 4, 'https://img.asmedia.epimg.net/resizer/zkC2w6O-9-J79tKHT5nC0TRkrYc=/1200x1200/cloudfront-eu-central-1.images.arcpublishing.com/diarioas/QSVRAG7FTRLCVJG7MWQ2UYFCYM.jpg', 24.99, 40);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_customer_id` (`customer_id`);

--
-- Indices de la tabla `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_id` (`order_id`),
  ADD KEY `fk_product_id` (`product_id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category_id` (`category_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
