DROP DATABASE IF EXISTS dungeonviewer;
CREATE DATABASE dungeonviewer;
USE dungeonviewer;

CREATE TABLE users (
    userID              INT             NOT NULL AUTO_INCREMENT,
    username            VARCHAR(16)     NOT NULL UNIQUE,
    userEmail           VARCHAR(100)    NOT NULL UNIQUE,
    userPassword        VARCHAR(255)    NOT NULL,
    CONSTRAINT users_PK PRIMARY KEY (userID)
);

CREATE TABLE pcs (
    pcID                INT             NOT NULL AUTO_INCREMENT,
    userID              INT             NOT NULL,
    campaignID          INT,
    pcName              VARCHAR(32)     NOT NULL,
    pcRace              VARCHAR(16)     NOT NULL,
    pcClass             VARCHAR(16)     NOT NULL,
    pcAlignment         VARCHAR(16)     NOT NULL,
    pcCurrentHP         INT             NOT NULL DEFAULT 0,
    pcMaxHP             INT             NOT NULL DEFAULT 0,
    pcLevel             INT             NOT NULL DEFAULT 1,
    pcXP                INT             NOT NULL DEFAULT 0,
    pcAC                INT             NOT NULL DEFAULT 0,
    pcSTR               INT             NOT NULL DEFAULT 8,
    pcDEX               INT             NOT NULL DEFAULT 8,
    pcCON               INT             NOT NULL DEFAULT 8,
    pcINT               INT             NOT NULL DEFAULT 8,
    pcWIS               INT             NOT NULL DEFAULT 8,
    pcCHA               INT             NOT NULL DEFAULT 8,
    CONSTRAINT pcs_PK PRIMARY KEY (pcID),
    INDEX pcs_UserIDX (userID),
    INDEX pcs_CampaignIDX (campaignID)
);

CREATE TABLE npcs (
    npcID               INT             NOT NULL AUTO_INCREMENT,
    campaignID          INT             NOT NULL,
    npcName             VARCHAR(32)     NOT NULL,
    npcRace             VARCHAR(16)     NOT NULL,
    npcHP               INT             NOT NULL DEFAULT 0,
    npcInitiative       INT             NOT NULL DEFAULT 0,
    CONSTRAINT npcs_PK PRIMARY KEY (npcID),
    INDEX npcs_CampaignIDX (campaignID)
);

CREATE TABLE campaigns (
    campaignID          INT             NOT NULL AUTO_INCREMENT,
    userID              INT             NOT NULL,
    campaignName        VARCHAR(32)     NOT NULL,
    campaignPassword    VARCHAR(255)    NOT NULL,
    CONSTRAINT campaigns_PK PRIMARY KEY (campaignID),
    INDEX campaigns_userIDX (userID)
);

CREATE USER IF NOT EXISTS 'dungeonmaster'@'localhost'
IDENTIFIED BY 'rollforinitiative1d20';

GRANT SELECT, INSERT, DELETE, UPDATE
ON dungeonviewer.*
TO 'dungeonmaster'@'localhost';