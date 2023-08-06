-- Populating the Summoner table
INSERT INTO Summoner(id, level, rank, money)
VALUES ('Rookie', 10, 'Gold', 5000),
       ('Uzi', 20, 'Platinum', 7500),
       ('Theshy', 30, 'Diamond', 10000),
       ('Caps', 40, 'Master', 12500),
       ('Lwx', 50, 'Grandmaster', 15000);

-- Populating the GameMode table
INSERT INTO GameMode(name, description)
VALUES ('Ultra Rapid Fire', 'no cooldown'),
       ('One for All', 'same 5 champion'),
       ('Ultimate Spellbook', 'gain extra ability'),
       ('Soul Fighter', '2v2v2v2'),
       ('Nexus Blitz', 'more frequent fight');

-- Populating the NonPlayerCharacter table
INSERT INTO NonPlayerCharacter(name, health)
VALUES ('monsterA', 1200),
       ('monsterB', 3000),
       ('monsterC', 1500),
       ('monsterD', 1200),
       ('monsterE', 4500),
       ('minion1', 100),
       ('minion2', 80),
       ('minion3', 100),
       ('minion4', 80),
       ('minion5', 250),
       ('turret1', 5000),
       ('turret2', 5000),
       ('turret3', 5000),
       ('turret4', 5000),
       ('turret5', 5000);

-- Populating the Monster table
INSERT INTO Monster(name, buff, type)
VALUES ('monsterA', 'Damage Boost', 'Dragon'),
       ('monsterB', 'Health Boost', 'Baron'),
       ('monsterC', 'Speed Boost', 'Rift Herald'),
       ('monsterD', 'Critical Boost', 'Kraken'),
       ('monsterE', 'Armor Boost', 'Elder Dragon');

-- Populating the Minion table
INSERT INTO Minion(name, side, type)
VALUES ('minion1', 'Blue', 'Melee'),
       ('minion2', 'Blue', 'Caster'),
       ('minion3', 'Red', 'Melee'),
       ('minion4', 'Red', 'Caster'),
       ('minion5', 'Blue', 'Siege');

-- Populating the Turret table
INSERT INTO Turret(name, position)
VALUES ('turret1', 'Top Lane outer'),
       ('turret2', 'Mid Lane inner'),
       ('turret3', 'Bot Lane outer'),
       ('turret4', 'Top Lane inhibitor'),
       ('turret5', 'Mid Lane inhibitor');

-- Populating the SelectFavorite table
INSERT INTO SelectFavorite(id, name)
VALUES ('Rookie', 'Ultra Rapid Fire'),
       ('Rookie', 'One for All'),
       ('Uzi', 'Ultra Rapid Fire'),
       ('Lwx', 'Soul Fighter'),
       ('Caps', 'Nexus Blitz');

-- Populating the LearnAbout table
INSERT INTO LearnAbout(id, name)
VALUES ('Rookie', 'monsterA'),
       ('Uzi', 'monsterB'),
       ('Lwx', 'monsterC'),
       ('Caps', 'monsterD'),
       ('Theshy', 'monsterE'),
       ('Rookie', 'minion1'),
       ('Uzi', 'minion2'),
       ('Lwx', 'minion3'),
       ('Caps', 'minion4'),
       ('Theshy', 'minion5'),
       ('Rookie', 'turret1'),
       ('Uzi', 'turret2'),
       ('Lwx', 'turret3'),
       ('Caps', 'turret4'),
       ('Theshy', 'turret5');

-- Populating the EpithetBackground table
INSERT INTO EpithetBackground(epithet, background_story)
VALUES ('The Unforgiven', 'The story of a sword is inked in blood'),
       ('The Exile', 'It is all about broken-sword wielding exile and her journey towards fixing her broken sword'),
       ('The Chain Warden', 'Thresh is an ambitious and restless spirit of the Shadow Isles'),
       ('The Sad Mummy', 'a lonely and melancholy soul, roaming the world in search of a friend'),
       ('The Blind Monk', 'They see only a blind man, I will open their eyes');

-- Populating the ChampionBCNF table
INSERT INTO ChampionBCNF(name, cost, region, epithet)
VALUES ('Yasuo', 4800, 'Ionia', 'The Unforgiven'),
       ('Riven', 2500, 'Noxus', 'The Exile'),
       ('Thresh', 4800, 'Shadow Isles', 'The Chain Warden'),
       ('Amumu', 450, 'Shurima', 'The Sad Mummy'),
       ('Lee Sin', 4800, 'Ionia', 'The Blind Monk');

-- Populating the Play table
INSERT INTO Play(id, name)
VALUES ('Rookie', 'Yasuo'),
       ('Rookie', 'Riven'),
       ('Uzi', 'Yasuo'),
       ('Lwx', 'Amumu'),
       ('Caps', 'Lee Sin');

-- Populating the StatisticProduced table
INSERT INTO StatisticProduced(id, name, type, value)
VALUES ('Uzi', 'Yasuo', 'Kills', 12),
       ('Uzi', 'Yasuo', 'Assists', 7),
       ('Uzi', 'Yasuo', 'Deads', 5),
       ('Uzi', 'Yasuo', 'Roaming score', 6),
       ('Uzi', 'Yasuo', 'Gold earned', 12000),
       ('Rookie', 'Riven', 'Kills', 6),
       ('Rookie', 'Riven', 'Assists', 10),
       ('Rookie', 'Riven', 'Deads', 8),
       ('Rookie', 'Riven', 'Roaming score', 3),
       ('Rookie', 'Riven', 'Gold earned', 9000);

-- Populating the StoreVisit table
INSERT INTO StoreVisit(storeID, promotion, id)
VALUES ('store 1', '20% off', 'Uzi'),
       ('store 2', '30% off', 'Rookie'),
       ('store 3', '45% off', 'Theshy'),
       ('store 4', '10% off', 'Caps'),
       ('store 5', '20% off', 'Lwx');

-- Populating the Sell1 table
INSERT INTO Sell1(name, storeID)
VALUES ('Yasuo', 'store 1'),
       ('Riven', 'store 2'),
       ('Thresh', 'store 3'),
       ('Amumu', 'store 4'),
       ('Lee Sin', 'store 5');

-- Populating the Sell2 table
INSERT INTO Sell2(name, storeID)
VALUES ('PROJECT', 'store 1'),
       ('NIGHTBRINGER', 'store 2'),
       ('HEXTECH', 'store 3'),
       ('PULSEFIRE', 'store 4'),
       ('BLOOD MOON', 'store 5');

-- Populating the TypeCost table
INSERT INTO TypeCost(type, cost)
VALUES ('Ultimate', 3250),
       ('Legendary', 1820),
       ('Mythic', 2000),
       ('Standard', 975),
       ('Epic', 1350);

-- Populating the SkinDecorateBCNF table
INSERT INTO SkinDecorateBCNF(skin_name, type, champion_name)
VALUES ('PROJECT', 'Epic', 'Yasuo'),
       ('NIGHTBRINGER', 'Epic', 'Lee Sin'),
       ('HEXTECH', 'Mythic', 'Amumu'),
       ('PULSEFIRE', 'Legendary', 'Thresh'),
       ('BLOOD MOON', 'Epic', 'Yasuo');

-- Populating the AbilityOwned table
INSERT INTO AbilityOwned(ability_name, cooldown, key, description, champion_name)
VALUES ('WAY OF THE WANDERER', 60, 'P', 'Passive ability', 'Yasuo'),
       ('STEEL TEMPEST', 8, 'Q', 'Thrusts forward', 'Yasuo'),
       ('WIND WALL', 40, 'W', 'blocks all enemy projectiles', 'Yasuo'),
       ('SWEEPING BLADE', 5, 'E', 'Dashes through target enemy', 'Yasuo'),
       ('LAST BREATH', 120, 'R', 'Blinks to an enemy champion, dealing physical damage', 'Yasuo'),
       ('RUNIC BLADE', 60, 'P', 'Passive ability', 'Riven'),
       ('BROKEN WINGS', 8, 'Q', 'Riven lashes out in a series of strikes', 'Riven'),
       ('KI BURST', 40, 'W', 'Riven emits a Ki Burst, damaging nearby enemies', 'Riven'),
       ('VALOR', 5, 'E', 'Riven steps forward a short distance', 'Riven'),
       ('BLADE OF THE EXILE', 120, 'R', 'Riven empowers her keepsake weapon with energy', 'Riven');
