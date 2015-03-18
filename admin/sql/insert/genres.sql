LOCK TABLES `genre` WRITE;

/*!40000
ALTER TABLE `genre`
DISABLE KEYS                                                                */;

INSERT INTO `genre`
     VALUES (1, 'Lovecraftian'),
            (2, 'High Fantasy'),
            (3, 'Low Fantasy'),
            (4, 'Horror'),
            (5, 'Magical Realism'),
            (6, 'Science Fiction'),
            (7, 'Bildungsroman'),
            (8, 'Young Adult'),
            (9, 'Dystopian');

/*!40000
ALTER TABLE `genre`
ENABLE KEYS                                                                 */;

UNLOCK TABLES;