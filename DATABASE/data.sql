CREATE TABLE `arcadia_db`.`services`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE = InnoDB;

CREATE TABLE `arcadia_db`.`comments`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `pseudo` VARCHAR(20) UNIQUE NOT NULL,
    `message` VARCHAR(255) NOT NULL,
    `validate` VARCHAR(5) NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE = InnoDB;

CREATE TABLE `arcadia_db`.`users`(
    `userId` INT NOT NULL AUTO_INCREMENT,
    `email` VARCHAR(50) NOT NULL,
    `firstname` VARCHAR(50) NOT NULL,
    `password_hash` VARCHAR(20) NOT NULL,
    PRIMARY KEY(`userId`)
) ENGINE = InnoDB;

CREATE TABLE `arcadia_db`.`roles`(
    `roleId` INT NOT NULL AUTO_INCREMENT,
    `label` VARCHAR(20) NOT NULL,
    `userId` INTEGER NOT NULL,
    PRIMARY KEY(`roleId`),
    FOREIGN KEY(`userId`) REFERENCES users(`userId`)
) ENGINE = InnoDB;

CREATE TABLE `arcadia_db`.`housings`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(20) UNIQUE NOT NULL,
    `description` TEXT NOT NULL,
    `slug` VARCHAR(255) NOT NULL,
    `comments` VARCHAR(255),
    PRIMARY KEY(`id`)
) ENGINE = InnoDB; 

CREATE TABLE `arcadia_db`.`opening`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `day` VARCHAR(10) UNIQUE,
    `hours` VARCHAR(15) NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE = InnoDB;

CREATE TABLE `arcadia_db`.`animals`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `firstname` VARCHAR(20) NOT NULL,
    `breed` VARCHAR(50) NOT NULL,
    `slug` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `housing` VARCHAR(20) NOT NULL,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`housing`) REFERENCES housings(`name`)
) ENGINE = InnoDB;

CREATE TABLE `arcadia_db`.`reports`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `date` VARCHAR(10) NOT NULL,
    `report` TEXT NOT NULL,
    `animal_id` INT,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`animal_id`) REFERENCES animals(`id`)
) ENGINE = InnoDB;

CREATE TABLE `arcadia_db`.`foods`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `date` VARCHAR(10) NOT NULL,
    `hours` VARCHAR(5) NOT NULL,
    `state` VARCHAR(255),
    `food` VARCHAR(50) NOT NULL,
    `weight` VARCHAR(20) NOT NULL,
    `animal_id` INT NOT NULL,
    PRIMARY KEY(`id`),
    FOREIGN KEY(`animal_id`) REFERENCES animals(`id`)
) ENGINE = InnoDB;

/* INSERTS */

INSERT INTO services (name, description, slug)
VALUES
	('Restauration', 'La restauration du zoo a transformé les espaces en habitats modernes et accueillants, améliorant le bien-être des animaux et l''expérience des visiteurs.', 			'https://image.noelshack.com/fichiers/2024/21/7/1716750846-restauration.jpg'),
    ('Visite des habitats', 'La visite des habitats du zoo avec un guide gratuit offre une immersion enrichissante dans la vie des animaux et leurs environnements naturels.', 		     'https://image.noelshack.com/fichiers/2024/21/7/1716751043-avis-zoo-la-palmyre.jpg'),
    ('Visite en petit train', 'La visite du zoo en petit train offre une expérience amusante et confortable pour découvrir les animaux et leurs habitats.', 'https://image.noelshack.com/fichiers/2024/21/7/1716751572-safaritrain-compress-scaled.jpg')

INSERT INTO comments (pseudo, message, validate)
VALUES
	('Patrice B.', 'Une expérience fantastique au zoo avec des installations modernes, des animaux bien soignés, et des activités ludiques - vivement recommandé !', true)

INSERT INTO users (userId, email, firstname, password_hash)
VALUES
	('', 'josearcadia@gmail.com', 'José', 'José945*'),
    ('', 'gerardm@orange.fr', 'Gérard', 'Gérard7528*'),
    ('', 'manonrose@outlook.fr', 'Manon', 'manoN418%')

INSERT INTO roles (roleId, label, userId)
VALUE
	('', 'Administrator', 1),
	('', 'Employee', 2),
	('', 'Veterinarian', 3)

INSERT INTO housings (name, description, slug)
VALUES
	('savane', 'La savane du zoo recrée fidèlement l''habitat naturel avec ses vastes plaines herbeuses où cohabitent lions, éléphants, girafes et zèbres, offrant aux visiteurs une immersion totale dans la vie sauvage africaine.', 'https://image.noelshack.com/fichiers/2024/21/7/1716753877-savane-1.jpg'),
    ('jungle', 'La jungle du zoo est un écosystème luxuriant et dense, abritant des singes, des tigres, des oiseaux exotiques et une végétation tropicale, offrant une expérience immersive et vibrante de la forêt tropicale.', 'https://image.noelshack.com/fichiers/2024/21/7/1716753974-03-1308.jpg'),
    ('marais', 'Le marais du zoo est un habitat riche et humide, peuplé d''alligators, de tortues et d''oiseaux aquatiques, offrant aux visiteurs une plongée fascinante dans cet écosystème unique.', 'https://image.noelshack.com/fichiers/2024/21/7/1716754053-pourquoi-les-marais-sont-un-atout-dans-la-lutte-contre-le-changement-climatique.jpg')

INSERT INTO opening (day, hours)
VALUES
	('lundi', 'FERMÉ'),
	('mardi', '9H00 - 17H30'),    
	('mercredi', '9H00 - 17H30'),    
	('jeudi', '10H00 - 17H30'),
	('vendredi', '9H00 - 17H30'),    
	('samedi', '9H00 - 17H30'),
	('dimanche', '9H00 - 17H30')

INSERT INTO animals (firstname, breed, slug, description, housing)
VALUES
	('Charles', 'caïman', 'https://image.noelshack.com/fichiers/2024/22/1/1716761155-istockphoto-1343189581-612x612.jpg', 'Charles, notre caïman, est une créature impressionnante avec sa peau écailleuse et ses yeux perçants, incarnant parfaitement la puissance et le mystère des marais.', 'marais'),
    ('Antonio', 'cobra royal', 'https://image.noelshack.com/fichiers/2024/22/1/1716761325-12-the-mystical-king-cobra-and-coffee-forests.jpg', 'Antonio, notre cobra royal, fascine avec son élégance serpentines et ses motifs distinctifs, incitant à l''admiration et au respect pour cette majestueuse créature.', 'marais'),
    ('Jules', 'lion', 'https://image.noelshack.com/fichiers/2024/22/1/1716761510-lion-waiting-in-namibia.jpg', 'Jules, notre lion, règne avec grâce et majesté sur sa savane, incarnant la force et la noblesse de son espèce, captivant les visiteurs par sa prestance royale.', 'savane'),
    ('Julia', 'girafe', 'https://image.noelshack.com/fichiers/2024/22/1/1716761656-portraitdunegirafe.jpg', 'Julia, notre girafe, se distingue par sa silhouette gracile et son cou élancé, évoluant avec élégance dans sa savane, émerveillant les visiteurs par sa beauté unique et sa démarche gracieuse.', 'savane'),
    ('Renaud', 'gorille', 'https://image.noelshack.com/fichiers/2024/22/1/1716761818-279168-min.jpg', 'Renaud, notre gorille, impressionne par sa stature imposante et son intelligence vive, évoluant avec grâce et sagesse dans sa jungle, attirant les visiteurs par son charme paisible et sa force tranquille.', 'jungle'),
    ('Richard', 'jaguar', 'https://image.noelshack.com/fichiers/2024/22/1/1716761762-jaguar-full.jpg', 'Richard, notre jaguar, incarne la puissance et l''agilité de son espèce, se fondant habilement dans les ombrages de sa jungle, captivant les visiteurs par son charisme félin et son allure indomptable.', 'jungle')