CREATE TABLE Summoner
(
    id    CHAR(20) PRIMARY KEY,
    level INT,
    rank  CHAR(20),
    money INT
);

CREATE TABLE GameMode
(
    name        CHAR(20) PRIMARY KEY,
    description CHAR(20)
);

CREATE TABLE NonPlayerCharacter
(
    name   CHAR(20) PRIMARY KEY,
    health INT
);

CREATE TABLE Monster
(
    name CHAR(20) PRIMARY KEY,
    buff CHAR(20),
    type CHAR(20),
    FOREIGN KEY (name) REFERENCES NonPlayerCharacter(name)
        ON UPDATE CASCADE
);

CREATE TABLE Minion
(
    name CHAR(20) PRIMARY KEY,
    side CHAR(20),
    type CHAR(20),
    FOREIGN KEY (name) REFERENCES NonPlayerCharacter(name)
        ON UPDATE CASCADE
);

CREATE TABLE Turret
(
    name     CHAR(20) PRIMARY KEY,
    position CHAR(20),
    FOREIGN KEY (name) REFERENCES NonPlayerCharacter(name)
        ON UPDATE CASCADE
);

CREATE TABLE SelectFavorite
(
    id   CHAR(20),
    name CHAR(20),
    PRIMARY KEY (id, name),
    FOREIGN KEY (id) REFERENCES Summoner
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (name) REFERENCES GameMode
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE LearnAbout
(
    id   CHAR(20),
    name CHAR(20),
    PRIMARY KEY (id, name),
    FOREIGN KEY (id) REFERENCES Summoner
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (name) REFERENCES NonPlayerCharacter
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE EpithetBackground
(
    epithet          CHAR(20) PRIMARY KEY,
    background_story CHAR(1000)
);

CREATE TABLE ChampionBCNF
(
    name    CHAR(20) PRIMARY KEY,
    cost    INT,
    epithet CHAR(20),
    region  CHAR(20),
    FOREIGN KEY (epithet) REFERENCES EpithetBackground
        ON UPDATE CASCADE
);

CREATE TABLE Play
(
    id   CHAR(20),
    name CHAR(20),
    PRIMARY KEY (id, name),
    FOREIGN KEY (id) REFERENCES Summoner
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (name) REFERENCES Champion
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE StatisticProduced
(
    id    CHAR(20),
    name  CHAR(20),
    type  CHAR(20),
    value INT,
    PRIMARY KEY (id, name, type),
    FOREIGN KEY (id) REFERENCES Summoner
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (name) REFERENCES Champion
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE StoreVisit
(
    storeID   CHAR(20) PRIMARY KEY,
    promotion CHAR(20),
    id        CHAR(20),
    FOREIGN KEY (id) REFERENCES Summoner
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    UNIQUE (id)
);

CREATE TABLE Sell1
(
    name    CHAR(20),
    storeID CHAR(20),
    PRIMARY KEY (name, storeID),
    FOREIGN KEY (name) REFERENCES Champion
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (storeID) REFERENCES Store
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

CREATE TABLE Sell2
(
    storeID CHAR(20),
    name    CHAR(20),
    PRIMARY KEY (name, storeID),
    FOREIGN KEY (name) REFERENCES Skin
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (storeID) REFERENCES Store
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

CREATE TABLE TypeCost
(
    type CHAR(20) PRIMARY KEY,
    cost INT
);

CREATE TABLE SkinDecorateBCNF
(
    skin_name CHAR(20) PRIMARY KEY,
    type      CHAR(20),
    champion_name CHAR (20),
    FOREIGN KEY (type) REFERENCES TypeCost
        ON UPDATE CASCADE
);

CREATE TABLE AbilityOwned
(
    ability_name  CHAR(20) PRIMARY KEY,
    cooldown      INT,
    key           CHAR(20),
    description   CHAR(1000),
    champion_name CHAR(20) NOT NULL,
    FOREIGN KEY (champion_name) REFERENCES Champion
        ON DELETE CASCADE
        ON UPDATE CASCADE
);
