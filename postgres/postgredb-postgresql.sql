--sample db
CREATE TABLE "public"."person" (
    "name" text NOT NULL,
    "surname" text NOT NULL,
    "age" integer NOT NULL,
    "national_id" text NOT NULL
) WITH (oids = false);

INSERT INTO "person" ("name", "surname", "age", "national_id") VALUES
('Arya',	'Stark',	15,	'66347888'),
('Sansa',	'Stark',	19,	'9876543456'),
('Tiger',	'Nixon',	22,	'123456'),
('Garrett',	'Winters',	55,	'223344');

-- 2019-05-21 23:26:01.531852+00
