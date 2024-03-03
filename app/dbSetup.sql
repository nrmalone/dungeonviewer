DROP DATABASE IF EXISTS dndviewer;
CREATE DATABASE dndviewer;
USE dndviewer;

CREATE TABLE dms (
    dmID                INT             NOT NULL AUTO_INCREMENT,
    userID              INT             NOT NULL,
    CONSTRAINT dms_PK PRIMARY KEY (dmID)
);

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
    pcHP                INT             NOT NULL DEFAULT 0,
    pcInitiative        INT             NOT NULL DEFAULT 0,
    pcLevel             INT             NOT NULL DEFAULT 0,
    pcXP                INT             NOT NULL DEFAULT 0,
    pcHP                INT             NOT NULL DEFAULT 0,
    pcAC                INT             NOT NULL DEFAULT 0,
    pcSTR               INT             NOT NULL DEFAULT 0,
    pcDEX               INT             NOT NULL DEFAULT 0,
    pcCON               INT             NOT NULL DEFAULT 0,
    pcINT               INT             NOT NULL DEFAULT 0,
    pcWIS               INT             NOT NULL DEFAULT 0,
    pcCHA               INT             NOT NULL DEFAULT 0,
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
    dmID                INT             NOT NULL,
    campaignName        VARCHAR(32)     NOT NULL,
    campaignPassword    VARCHAR(255)    NOT NULL,
    CONSTRAINT campaigns_PK PRIMARY KEY (campaignID),
    INDEX campaigns_DMIDX (dmID)
);

CREATE USER IF NOT EXISTS 'dungeonmaster'@'localhost'
IDENTIFIED BY 'rollforinitiative1d20';

GRANT SELECT, INSERT, DELETE, UPDATE
ON dndviewer.*
TO 'dungeonmaster'@'localhost';