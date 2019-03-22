INSERT INTO `ost_orderinfo_status` (`id`, `key`, `name`, `rangeStart`, `rangeEnd`, `info`, `type`, `dispatch`) VALUES
(1, NULL, '...', 1, 999, 'Status unbekannt.', 3, NULL),
(2, 1, 'In Bearbeitung', 100, 150, 'Ihre Bestellung wird zurzeit bearbeitet.', NULL, NULL),
(3, 1, 'In Bearbeitung', 151, 509, 'Ihre Bestellung wird zurzeit bearbeitet.', NULL, '|4|5|14|'),
(4, 1, 'Bestellt', 300, 320, 'Ihre Ware wurde beim Hersteller bestellt, die Lieferung an Sie kann\r\nvoraussichtlich termingerecht erfolgen.', NULL, NULL),
(5, 1, 'Planmäßig', 330, 430, 'Die Lieferung an Sie kann zum Planlieferdatum KW #deliveryCalendarWeek# erfolgen.', NULL, '|1|'),
(6, 1, 'Planmäßig', 330, 430, 'Die Abholung kann ab KW #deliveryCalendarWeek# erfolgen.', NULL, '|2|10|12|'),
(7, NULL, 'Buchhaltung', 500, 505, 'Bitte setzen Sie sich mit unserer Buchhaltung in Verbindung.', 3, NULL),
(8, 1, 'Versandvorbereitung', 510, 590, 'Ihre Bestellung wird für den Versand vorbereitet und in Kürze versendet.', NULL, '|4|5|14|'),
(9, 3, 'Abholung bereit', 510, 540, 'Ihre Bestellung wird für den Versand vorbereitet und in Kürze versendet.', NULL, '|2|10|12|'),
(10, 1, 'Auslieferung bereit', 510, 538, 'Weitere Informationen zu Ihrem Auftrag erhalten Sie von uns in den nächsten Tagen.', NULL, '|1|'),
(11, 1, 'Lieferung erfolgt', 538, 539, 'Die von Ihnen bestellte Ware ist bei uns eingetroffen und steht für Sie\r\nzur Auslieferung bereit.', NULL, '|1|'),
(12, 2, 'Lieferung geplant', 540, 580, 'Wir haben die Lieferung Sie eingeplant. Sollte Ihnen der Termin nicht zusagen, wenden Sie sich bitte an unser Kunden-Service-Center.\r\n\r\nNoch offene Beträge können Sie am Liefertag bei unseren Mitarbeitern in Bar, per Scheck oder via Einzugsermächtigung (Formular wird zur Verfügung gestellt) begleichen.\r\n\r\nBitte unterstützen Sie uns, indem Sie am Tag der Auslieferung eine geeignete Parkmöglichkeit für unseren LKW freihalten.', NULL, '|1|'),
(13, 1, 'Bereitgestellt', 560, 560, 'Wir haben die Ware für Sie bereitgestellt.', NULL, '|2|10|12|'),
(14, 4, 'Ausgeliefert', 585, 800, 'Wir hoffen, dass Sie mit den gekauften Artikeln zufrieden sind und würden uns über ein Wiedersehen in unserem Einrichtungs-Centrum freuen.\r\n\r\n', NULL, '|1|2|10|12|'),
(15, NULL, 'Bedanken', 590, 630, 'Wir möchten uns nochmals für die Bestellung bedanken und freuen uns auf Ihren nächsten Besuch.', NULL, '|1|'),
(16, 4, 'Versendet', 600, 800, 'Ihre Bestellung wurde mit DHL versendet und die Lieferzeit beträgt ca. 1-3 Werktage. Von DHL erhalten Sie eine E-Mail mit der Sie die Sendung nachverfolgen können. Wir hoffen, dass Sie mit den gekauften Artikeln zufrieden sind und würden uns über ein Wiedersehen in unserem Onlineshop oder unserem Einrichtungs-Centrum freuen.', NULL, '|4|14|'),
(17, 4, 'Versendet', 600, 800, 'Ihre Bestellung wurde an Hermes übergeben.\r\n\r\n1. Wir liefern Ihre Möbel durch ein qualifiziertes 2-Mann-Team bis zum Verwendungsort in Ihre Wohnung oder Ihrem Haus.\r\n2. Das bedeutet, Sie müssen nicht mit anfassen. Die Entsorgung des Verpackungsmaterial, sowie Kleinstmontagen sind kostenlos.\r\n3. Sobald die Ware im ausliefernden Depot angekommen ist, stimmt die Firma Hermes telefonisch mit Ihnen einen halbtagsgenauen Liefertermin ab.\r\n4. Sie erhalten von Hermes eine E-Mail mit der Sie die Sendung nachverfolgen können.\r\n\r\nWir hoffen, dass Sie mit den gekauften Artikeln zufrieden sind und würden uns über ein Wiedersehen in unserem Onlineshop oder unserem Einrichtungs-Centrum freuen.', NULL, '|5|');

INSERT INTO `ost_orderinfo_dispatches` (`id`, `key`, `name`) VALUES
(1, NULL, 'Eigenauslieferung'),
(2, NULL, 'Selbstabholung'),
(3, NULL, ''),
(4, NULL, 'DHL Paket'),
(5, NULL, 'Hermes'),
(12, NULL, ''),
(14, NULL, 'DHL Express');
