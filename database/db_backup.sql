PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "minutes2" (
	"id"	INTEGER,
	"minutes"	INTEGER,
	"temp"	REAL,
	"time_stamp"	INTEGER,
	PRIMARY KEY("id" AUTOINCREMENT)
);
INSERT INTO minutes2 VALUES(1,0,33.520000000000003126,1614096027);
INSERT INTO minutes2 VALUES(2,1,33.520000000000003126,1614096088);
INSERT INTO minutes2 VALUES(3,2,33.189999999999997726,1614096148);
INSERT INTO minutes2 VALUES(4,3,33.189999999999997726,1614096209);
INSERT INTO minutes2 VALUES(5,4,33.189999999999997726,1614096269);
INSERT INTO minutes2 VALUES(6,5,33.189999999999997726,1614096329);
INSERT INTO minutes2 VALUES(7,6,33.189999999999997726,1614096390);
INSERT INTO minutes2 VALUES(8,7,33.189999999999997726,1614096450);
INSERT INTO minutes2 VALUES(9,8,33.189999999999997726,1614096510);
INSERT INTO minutes2 VALUES(10,9,33.189999999999997726,1614096571);
INSERT INTO minutes2 VALUES(11,10,33.520000000000003126,1614096631);
INSERT INTO minutes2 VALUES(12,11,33.520000000000003126,1614096692);
INSERT INTO minutes2 VALUES(13,12,33.189999999999997726,1614096752);
INSERT INTO minutes2 VALUES(14,13,33.189999999999997726,1614096812);
INSERT INTO minutes2 VALUES(15,14,33.189999999999997726,1614096875);
INSERT INTO minutes2 VALUES(16,15,33.189999999999997726,1614096937);
INSERT INTO minutes2 VALUES(17,16,33.189999999999997726,1614096997);
INSERT INTO minutes2 VALUES(18,17,33.189999999999997726,1614097058);
INSERT INTO minutes2 VALUES(19,18,33.189999999999997726,1614097118);
INSERT INTO minutes2 VALUES(20,19,33.189999999999997726,1614097178);
INSERT INTO minutes2 VALUES(21,20,33.189999999999997726,1614097239);
INSERT INTO minutes2 VALUES(22,21,33.189999999999997726,1614097299);
INSERT INTO minutes2 VALUES(23,22,33.189999999999997726,1614097360);
INSERT INTO minutes2 VALUES(24,23,33.189999999999997726,1614097420);
INSERT INTO minutes2 VALUES(25,24,33.189999999999997726,1614097480);
INSERT INTO minutes2 VALUES(26,25,33.189999999999997726,1614097543);
INSERT INTO minutes2 VALUES(27,26,33.189999999999997726,1614097604);
INSERT INTO minutes2 VALUES(28,27,32.869999999999997442,1614097664);
INSERT INTO minutes2 VALUES(29,28,33.520000000000003126,1614097725);
INSERT INTO minutes2 VALUES(30,29,33.520000000000003126,1614097785);
INSERT INTO minutes2 VALUES(31,30,33.189999999999997726,1614097845);
INSERT INTO minutes2 VALUES(32,31,33.189999999999997726,1614097906);
INSERT INTO minutes2 VALUES(33,32,33.189999999999997726,1614097966);
INSERT INTO minutes2 VALUES(34,33,33.520000000000003126,1614098027);
INSERT INTO minutes2 VALUES(35,34,33.520000000000003126,1614098087);
INSERT INTO minutes2 VALUES(36,35,33.520000000000003126,1614098147);
INSERT INTO minutes2 VALUES(37,36,33.520000000000003126,1614098208);
INSERT INTO minutes2 VALUES(38,37,33.520000000000003126,1614098268);
INSERT INTO minutes2 VALUES(39,38,33.189999999999997726,1614098328);
INSERT INTO minutes2 VALUES(40,39,33.520000000000003126,1614098389);
INSERT INTO minutes2 VALUES(41,40,33.189999999999997726,1614098449);
INSERT INTO minutes2 VALUES(42,41,33.189999999999997726,1614098509);
INSERT INTO minutes2 VALUES(43,42,33.189999999999997726,1614098570);
INSERT INTO minutes2 VALUES(44,43,32.869999999999997442,1614098630);
INSERT INTO minutes2 VALUES(45,44,33.189999999999997726,1614098691);
INSERT INTO minutes2 VALUES(46,45,33.189999999999997726,1614098751);
INSERT INTO minutes2 VALUES(47,46,33.189999999999997726,1614098812);
INSERT INTO minutes2 VALUES(48,47,33.189999999999997726,1614098872);
INSERT INTO minutes2 VALUES(49,48,33.189999999999997726,1614098932);
INSERT INTO minutes2 VALUES(50,49,33.189999999999997726,1614098993);
INSERT INTO minutes2 VALUES(51,50,33.189999999999997726,1614099053);
INSERT INTO minutes2 VALUES(52,51,33.189999999999997726,1614099114);
INSERT INTO minutes2 VALUES(53,52,33.189999999999997726,1614099174);
INSERT INTO minutes2 VALUES(54,53,33.189999999999997726,1614095602);
INSERT INTO minutes2 VALUES(55,54,33.189999999999997726,1614095662);
INSERT INTO minutes2 VALUES(56,55,33.189999999999997726,1614095723);
INSERT INTO minutes2 VALUES(57,56,33.520000000000003126,1614095783);
INSERT INTO minutes2 VALUES(58,57,33.189999999999997726,1614095846);
INSERT INTO minutes2 VALUES(59,58,33.520000000000003126,1614095907);
INSERT INTO minutes2 VALUES(60,59,33.520000000000003126,1614095967);
CREATE TABLE hours2 (
	id integer PRIMARY KEY,
	date text NOT NULL,
	hour integer NOT NULL,
	temp1 REAL NOT NULL,
	temp2 REAL NOT NULL,
	timestamp integer NOT NULL UNIQUE
);
INSERT INTO hours VALUES(1,'2021-02-18',0,17.736666666666998537,1613585156);
INSERT INTO hours VALUES(2,'2021-02-18',0,25.941666666667000384,1613588397);
INSERT INTO hours VALUES(3,'2021-02-18',1,25.686666666667001379,1613591955);
INSERT INTO hours VALUES(4,'2021-02-18',2,19.820000000000000284,1613595576);
INSERT INTO hours VALUES(5,'2021-02-18',3,25.25,1613599195);
INSERT INTO hours VALUES(6,'2021-02-18',4,25.125,1613602754);
INSERT INTO hours VALUES(7,'2021-02-18',5,24.633333333332998904,1613606372);
INSERT INTO hours VALUES(8,'2021-02-18',6,24.633333333332998904,1613609997);
INSERT INTO hours VALUES(9,'2021-02-18',9,25.05000000000000071,1613619984);
INSERT INTO hours VALUES(10,'2021-02-18',10,26.35000000000000142,1613623610);
INSERT INTO hours VALUES(11,'2021-02-22',23,36.740000000000001989,1614015960);
INSERT INTO hours VALUES(12,'2021-02-23',9,38.600000000000001421,1614052000);
INSERT INTO hours VALUES(13,'2021-02-23',10,30.69999999999999929,1614055619);
INSERT INTO hours VALUES(14,'2021-02-23',11,30.949999999999999289,1614059178);
INSERT INTO hours VALUES(15,'2021-02-23',12,32.10000000000000142,1614062803);
INSERT INTO hours VALUES(16,'2021-02-23',13,32.710000000000000852,1614066366);
INSERT INTO hours VALUES(17,'2021-02-23',15,33.09000000000000341,1614073567);
INSERT INTO hours VALUES(18,'2021-02-23',16,35.219999999999998863,1614077216);
INSERT INTO hours VALUES(19,'2021-02-23',17,35.920000000000001706,1614080792);
INSERT INTO hours VALUES(20,'2021-02-23',18,35.479999999999996874,1614084361);
INSERT INTO hours VALUES(21,'2021-02-23',19,33.820000000000000283,1614087991);
INSERT INTO hours VALUES(22,'2021-02-23',20,34.630000000000002557,1614091615);
INSERT INTO hours VALUES(23,'2021-02-23',21,33.85000000000000142,1614095180);
INSERT INTO hours VALUES(24,'2021-02-23',22,33.289999999999999146,1614098812);
DELETE FROM sqlite_sequence;
INSERT INTO sqlite_sequence VALUES('minutes',60);
COMMIT;