CREATE TABLE IF NOT EXISTS "minutes2" (
	"id"	INTEGER,
	"minutes"	INTEGER,
	"temp"	REAL,
	"time_stamp"	INTEGER,
	PRIMARY KEY("id" AUTOINCREMENT)
);
INSERT INTO minutes2 VALUES(1,0,0.520000000000003126,1614096027);
INSERT INTO minutes2 VALUES(2,1,0.520000000000003126,1614096088);
INSERT INTO minutes2 VALUES(3,2,0.189999999999997726,1614096148);
INSERT INTO minutes2 VALUES(4,3,0.189999999999997726,1614096209);
INSERT INTO minutes2 VALUES(5,4,0.189999999999997726,1614096269);
INSERT INTO minutes2 VALUES(6,5,0.189999999999997726,1614096329);
INSERT INTO minutes2 VALUES(7,6,0.189999999999997726,1614096390);
INSERT INTO minutes2 VALUES(8,7,0.189999999999997726,1614096450);
INSERT INTO minutes2 VALUES(9,8,0.189999999999997726,1614096510);
INSERT INTO minutes2 VALUES(10,9,0.189999999999997726,1614096571);
INSERT INTO minutes2 VALUES(11,10,0.520000000000003126,1614096631);
INSERT INTO minutes2 VALUES(12,11,0.520000000000003126,1614096692);
INSERT INTO minutes2 VALUES(13,12,0.189999999999997726,1614096752);
INSERT INTO minutes2 VALUES(14,13,0.189999999999997726,1614096812);
INSERT INTO minutes2 VALUES(15,14,0.189999999999997726,1614096875);
INSERT INTO minutes2 VALUES(16,15,0.189999999999997726,1614096937);
INSERT INTO minutes2 VALUES(17,16,0.189999999999997726,1614096997);
INSERT INTO minutes2 VALUES(18,17,0.189999999999997726,1614097058);
INSERT INTO minutes2 VALUES(19,18,0.189999999999997726,1614097118);
INSERT INTO minutes2 VALUES(20,19,0.189999999999997726,1614097178);
INSERT INTO minutes2 VALUES(21,20,0.189999999999997726,1614097239);
INSERT INTO minutes2 VALUES(22,21,0.189999999999997726,1614097299);
INSERT INTO minutes2 VALUES(23,22,0.189999999999997726,1614097360);
INSERT INTO minutes2 VALUES(24,23,0.189999999999997726,1614097420);
INSERT INTO minutes2 VALUES(25,24,0.189999999999997726,1614097480);
INSERT INTO minutes2 VALUES(26,25,0.189999999999997726,1614097543);
INSERT INTO minutes2 VALUES(27,26,0.189999999999997726,1614097604);
INSERT INTO minutes2 VALUES(28,27,32.869999999999997442,1614097664);
INSERT INTO minutes2 VALUES(29,28,0.520000000000003126,1614097725);
INSERT INTO minutes2 VALUES(30,29,0.520000000000003126,1614097785);
INSERT INTO minutes2 VALUES(31,30,0.189999999999997726,1614097845);
INSERT INTO minutes2 VALUES(32,31,0.189999999999997726,1614097906);
INSERT INTO minutes2 VALUES(33,32,0.189999999999997726,1614097966);
INSERT INTO minutes2 VALUES(34,33,0.520000000000003126,1614098027);
INSERT INTO minutes2 VALUES(35,34,0.520000000000003126,1614098087);
INSERT INTO minutes2 VALUES(36,35,0.520000000000003126,1614098147);
INSERT INTO minutes2 VALUES(37,36,0.520000000000003126,1614098208);
INSERT INTO minutes2 VALUES(38,37,0.520000000000003126,1614098268);
INSERT INTO minutes2 VALUES(39,38,0.189999999999997726,1614098328);
INSERT INTO minutes2 VALUES(40,39,0.520000000000003126,1614098389);
INSERT INTO minutes2 VALUES(41,40,0.189999999999997726,1614098449);
INSERT INTO minutes2 VALUES(42,41,0.189999999999997726,1614098509);
INSERT INTO minutes2 VALUES(43,42,0.189999999999997726,1614098570);
INSERT INTO minutes2 VALUES(44,43,32.869999999999997442,1614098630);
INSERT INTO minutes2 VALUES(45,44,0.189999999999997726,1614098691);
INSERT INTO minutes2 VALUES(46,45,0.189999999999997726,1614098751);
INSERT INTO minutes2 VALUES(47,46,0.189999999999997726,1614098812);
INSERT INTO minutes2 VALUES(48,47,0.189999999999997726,1614098872);
INSERT INTO minutes2 VALUES(49,48,0.189999999999997726,1614098932);
INSERT INTO minutes2 VALUES(50,49,0.189999999999997726,1614098993);
INSERT INTO minutes2 VALUES(51,50,0.189999999999997726,1614099053);
INSERT INTO minutes2 VALUES(52,51,0.189999999999997726,1614099114);
INSERT INTO minutes2 VALUES(53,52,0.189999999999997726,1614099174);
INSERT INTO minutes2 VALUES(54,53,0.189999999999997726,1614095602);
INSERT INTO minutes2 VALUES(55,54,0.189999999999997726,1614095662);
INSERT INTO minutes2 VALUES(56,55,0.189999999999997726,1614095723);
INSERT INTO minutes2 VALUES(57,56,0.520000000000003126,1614095783);
INSERT INTO minutes2 VALUES(58,57,0.189999999999997726,1614095846);
INSERT INTO minutes2 VALUES(59,58,0.520000000000003126,1614095907);
INSERT INTO minutes2 VALUES(60,59,0.520000000000003126,1614095967);
CREATE TABLE hours2 (
	id integer PRIMARY KEY,
	date text NOT NULL,
	hour integer NOT NULL,
	temp REAL NOT NULL,
	timestamp integer NOT NULL UNIQUE
);