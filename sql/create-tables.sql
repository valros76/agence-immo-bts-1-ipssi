USE `agence-immo`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `pseudo` VARCHAR(750) NOT NULL,
  `password` TEXT NOT NULL,
  `inscription_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `pseudo` (`pseudo`)
)
COLLATE=`utf8mb4_unicode_ci`;