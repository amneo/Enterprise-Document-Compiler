-- SQL Manager Lite for PostgreSQL 5.9.5.52424
-- ---------------------------------------
-- Host      : 192.168.100.70
-- Database  : submittal
-- Version   : PostgreSQL 9.6.12 on x86_64-pc-linux-gnu (Debian 9.6.12-1.pgdg90+1), compiled by gcc (Debian 6.3.0-18+deb9u1) 6.3.0 20170516, 64-bit



SET search_path = public, pg_catalog;
DROP TABLE IF EXISTS public.userlevelpermissions;
DROP TABLE IF EXISTS public.userlevels;
DROP TABLE IF EXISTS public.users;
DROP TABLE IF EXISTS public.audittrail;
DROP TABLE IF EXISTS public.datasheets;
DROP TABLE IF EXISTS public."countryOfOrigin";
DROP TABLE IF EXISTS public.manufacturer;
SET check_function_bodies = false;
--
-- Structure for table manufacturer (OID = 53325) : 
--
CREATE TABLE public.manufacturer (
    "manufacturerId" bigserial NOT NULL,
    "manufacturerName" varchar NOT NULL,
    "manufacturerAddress" varchar NOT NULL,
    "manufacturerFactory" varchar,
    username varchar
)
WITH (oids = false);
--
-- Structure for table countryOfOrigin (OID = 53340) : 
--
CREATE TABLE public."countryOfOrigin" (
    "cooId" serial NOT NULL,
    "countryName" varchar NOT NULL,
    "countryIsoCode" varchar NOT NULL,
    username varchar
)
WITH (oids = false);
--
-- Structure for table datasheets (OID = 53361) : 
--
CREATE TABLE public.datasheets (
    partid bigserial NOT NULL,
    partno varchar NOT NULL,
    "dataSheetFile" varchar NOT NULL,
    manufacturer varchar NOT NULL,
    "cddFile" varchar DEFAULT 'YTM-CDD'::character varying,
    "thirdPartyFile" varchar DEFAULT 'YTM-UL'::character varying NOT NULL,
    tittle varchar NOT NULL,
    cover varchar DEFAULT 'TBC-COVER'::character varying NOT NULL,
    cddissue date NOT NULL,
    cddno varchar NOT NULL,
    duration interval DEFAULT '2 years'::interval,
    expirydt date DEFAULT '2019-03-20'::date,
    highlighted boolean DEFAULT false,
    coo varchar DEFAULT 'NA'::character varying,
    "hssCode" varchar,
    systrade varchar DEFAULT 'NA'::character varying NOT NULL,
    isdatasheet boolean DEFAULT false NOT NULL,
    datasheetdate date DEFAULT '2019-03-20'::date,
    username varchar,
    "nativeFiles" varchar NOT NULL,
    "thirdPartyNo" varchar NOT NULL
)
WITH (oids = false);
--
-- Structure for table audittrail (OID = 53385) : 
--
CREATE TABLE public.audittrail (
    id serial NOT NULL,
    datetime timestamp without time zone NOT NULL,
    script varchar(255),
    username varchar(255),
    action varchar(255),
    "table" varchar(255),
    field varchar(255),
    keyvalue text,
    oldvalue text,
    newvalue text
)
WITH (oids = false);
--
-- Structure for table users (OID = 53470) : 
--
CREATE TABLE public.users (
    seqid serial NOT NULL,
    "userName" varchar NOT NULL,
    "userLoginId" varchar NOT NULL,
    "uEmail" varchar NOT NULL,
    "uLevel" integer DEFAULT '-2'::integer,
    "uPassword" varchar NOT NULL,
    "uProfile" varchar,
    "uReportsTo" varchar(1) DEFAULT 1,
    "uActivated" boolean DEFAULT true
)
WITH (oids = false);
ALTER TABLE ONLY public.users ALTER COLUMN "userName" SET STATISTICS 0;
--
-- Structure for table userlevels (OID = 53495) : 
--
CREATE TABLE public.userlevels (
    userlevelid integer NOT NULL,
    userlevelname varchar(255) NOT NULL
)
WITH (oids = false);
--
-- Structure for table userlevelpermissions (OID = 53500) : 
--
CREATE TABLE public.userlevelpermissions (
    userlevelid integer NOT NULL,
    tablename varchar(255) NOT NULL,
    permission integer NOT NULL
)
WITH (oids = false);
--
-- Definition for index manufacturer_pkey (OID = 53332) : 
--
ALTER TABLE ONLY manufacturer
    ADD CONSTRAINT manufacturer_pkey
    PRIMARY KEY ("manufacturerId");
--
-- Definition for index manufacturer_manufacturerName_key (OID = 53334) : 
--
ALTER TABLE ONLY manufacturer
    ADD CONSTRAINT "manufacturer_manufacturerName_key"
    UNIQUE ("manufacturerName");
--
-- Definition for index countryOfOrigin_countryName_key (OID = 53349) : 
--
ALTER TABLE ONLY "countryOfOrigin"
    ADD CONSTRAINT "countryOfOrigin_countryName_key"
    UNIQUE ("countryName");
--
-- Definition for index countryOfOrigin_countryIsoCode_key (OID = 53351) : 
--
ALTER TABLE ONLY "countryOfOrigin"
    ADD CONSTRAINT "countryOfOrigin_countryIsoCode_key"
    UNIQUE ("countryIsoCode");
--
-- Definition for index datasheets_pkey (OID = 53378) : 
--
ALTER TABLE ONLY datasheets
    ADD CONSTRAINT datasheets_pkey
    PRIMARY KEY (partid);
--
-- Definition for index datasheets_partno_key (OID = 53380) : 
--
ALTER TABLE ONLY datasheets
    ADD CONSTRAINT datasheets_partno_key
    UNIQUE (partno);
--
-- Definition for index pkaudittrail (OID = 53392) : 
--
ALTER TABLE ONLY audittrail
    ADD CONSTRAINT pkaudittrail
    PRIMARY KEY (id);
--
-- Definition for index users_pkey (OID = 53479) : 
--
ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey
    PRIMARY KEY (seqid);
--
-- Definition for index users_userLoginId_key (OID = 53481) : 
--
ALTER TABLE ONLY users
    ADD CONSTRAINT "users_userLoginId_key"
    UNIQUE ("userLoginId");
--
-- Definition for index users_uEmail_key (OID = 53483) : 
--
ALTER TABLE ONLY users
    ADD CONSTRAINT "users_uEmail_key"
    UNIQUE ("uEmail");
--
-- Definition for index pkuserlevels (OID = 53498) : 
--
ALTER TABLE ONLY userlevels
    ADD CONSTRAINT pkuserlevels
    PRIMARY KEY (userlevelid);
--
-- Definition for index pkuserlevelpermissions (OID = 53503) : 
--
ALTER TABLE ONLY userlevelpermissions
    ADD CONSTRAINT pkuserlevelpermissions
    PRIMARY KEY (userlevelid, tablename);
--
-- Definition for index countryOfOrigin_pkey (OID = 53507) : 
--
ALTER TABLE ONLY "countryOfOrigin"
    ADD CONSTRAINT "countryOfOrigin_pkey"
    PRIMARY KEY ("cooId");
--
-- Comments
--
COMMENT ON SCHEMA public IS 'standard public schema';
