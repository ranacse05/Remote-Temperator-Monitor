CREATE TABLE "users" (
	"id"	INTEGER,
	"eid"	INTEGER UNIQUE,
	"name"	TEXT,
	"email"	TEXT,
	"password"	TEXT,
	PRIMARY KEY("id" AUTOINCREMENT)
);