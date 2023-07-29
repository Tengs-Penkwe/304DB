CREATE TABLE Summoner (
  id CHAR(20) NOT NULL PRIMARY KEY,
  level INT,
  rank CHAR(20),
  money INT
);

CREATE TABLE Friend
(
  name CHAR(20) NOT NULL PRIMARY KEY,
  rank CHAR(20),
  status CHAR(20)
);

CREATE TABLE NonPlayerCharacter
(
  name CHAR(20) NOT NULL PRIMARY KEY,
  health INT
);

CREATE TABLE Monster
(
  name CHAR(20) NOT NULL PRIMARY KEY REFERENCES NonPlayerCharacter(name),
  buff CHAR(20),
  type CHAR(20)
);

CREATE TABLE Minion
(
  name CHAR(20) NOT NULL PRIMARY KEY REFERENCES NonPlayerCharacter(name),
  side CHAR(20),
  type CHAR(20)
);

CREATE TABLE Turret
(
  name CHAR(20) NOT NULL PRIMARY KEY REFERENCES NonPlayerCharacter(name),
  position CHAR(20)
);

CREATE TABLE View
(
  id CHAR(20) NOT NULL,
  name CHAR(20) NOT NULL,
  PRIMARY KEY (id, name),
  FOREIGN KEY (id) REFERENCES Summoner(id),
  FOREIGN KEY (name) REFERENCES Friend(name)
);

CREATE TABLE LearnAbout
(
  id CHAR(20) NOT NULL,
  name CHAR(20) NOT NULL,
  PRIMARY KEY (id, name),
  FOREIGN KEY (id) REFERENCES Summoner(id),
  FOREIGN KEY (name) REFERENCES NonPlayerCharacter(name)
);

CREATE TABLE Champion
(
  name CHAR(20) NOT NULL PRIMARY KEY,
  cost INT,
  epithet CHAR(20),
  region CHAR(20),
  background_story CHAR(1000)
);

CREATE TABLE Play
(
  id CHAR(20) NOT NULL,
  name CHAR(20) NOT NULL,
  PRIMARY KEY (id, name),
  FOREIGN KEY (id) REFERENCES Summoner(id),
  FOREIGN KEY (name) REFERENCES Champion(name)
);

CREATE TABLE StatisticProduced
(
  id CHAR(20) NOT NULL,
  name CHAR(20) NOT NULL,
  type CHAR(20) NOT NULL,
  value INT,
  PRIMARY KEY (id, name, type),
  FOREIGN KEY (id) REFERENCES Summoner(id),
  FOREIGN KEY (name) REFERENCES Champion(name)
);

CREATE TABLE Store
(
  patch CHAR(20) NOT NULL PRIMARY KEY,
  promotion CHAR(20)
);

CREATE TABLE Visit
(
  id CHAR(20) NOT NULL,
  patch CHAR(20) NOT NULL,
  PRIMARY KEY (id, patch),
  FOREIGN KEY (id) REFERENCES Summoner(id),
  FOREIGN KEY (patch) REFERENCES Store(patch)
);

CREATE TABLE Sell1
(
  name CHAR(20) NOT NULL,
  patch CHAR(20) NOT NULL,
  PRIMARY KEY (name, patch),
  FOREIGN KEY (name) REFERENCES Champion(name),
  FOREIGN KEY (patch) REFERENCES Store(patch)
);

CREATE TABLE SkinDecorate
(
  skin_name CHAR(20) NOT NULL PRIMARY KEY,
  type CHAR(20),
  cost INT,
  champion_name CHAR(20) NOT NULL,
  FOREIGN KEY (champion_name) REFERENCES Champion(name)
);

CREATE TABLE AbilityOwned
(
  ability_name CHAR(20) NOT NULL PRIMARY KEY,
  cooldown INT,
  key CHAR(20),
  description CHAR(1000),
  champion_name CHAR(20) NOT NULL,
  FOREIGN KEY (champion_name) REFERENCES Champion(name)
);

