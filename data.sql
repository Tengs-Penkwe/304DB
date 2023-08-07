INSERT INTO EntityImages(entity_type, entity_name, image_url)
VALUES
('Summoner', 'Rookie', 'https://ddragon.leagueoflegends.com/cdn/11.14.1/img/profileicon/934.png'),
('Summoner', 'Uzi', 'https://ddragon.leagueoflegends.com/cdn/11.14.1/img/profileicon/7.png'),
('Summoner', 'Theshy', 'https://ddragon.leagueoflegends.com/cdn/11.14.1/img/profileicon/28.png'),
('Summoner', 'Caps', 'https://ddragon.leagueoflegends.com/cdn/11.14.1/img/profileicon/23.png'),
('Summoner', 'Lwx', 'https://ddragon.leagueoflegends.com/cdn/11.14.1/img/profileicon/29.png'),
('Champion', 'Yasuo', 'https://ddragon.leagueoflegends.com/cdn/img/champion/splash/Yasuo_0.jpg'),
('Champion', 'Riven', 'https://ddragon.leagueoflegends.com/cdn/img/champion/splash/Riven_0.jpg'),
('Champion', 'Thresh', 'https://ddragon.leagueoflegends.com/cdn/img/champion/splash/Thresh_0.jpg'),
('Champion', 'Amumu', 'https://ddragon.leagueoflegends.com/cdn/img/champion/splash/Amumu_0.jpg'),
('Champion', 'Lee Sin', 'https://ddragon.leagueoflegends.com/cdn/img/champion/splash/LeeSin_0.jpg'),
('Ability', 'WAY OF THE WANDERER', 'https://ddragon.leagueoflegends.com/cdn/11.14.1/img/passive/Yasuo_Passive.png'),
('Ability', 'STEEL TEMPEST', 'https://ddragon.leagueoflegends.com/cdn/11.14.1/img/spell/YasuoQ1Wrapper.png'),
('Ability', 'WIND WALL', 'https://ddragon.leagueoflegends.com/cdn/11.14.1/img/spell/YasuoW.png'),
('Ability', 'SWEEPING BLADE', 'https://ddragon.leagueoflegends.com/cdn/11.14.1/img/spell/YasuoE.png'),
('Ability', 'LAST BREATH', 'https://ddragon.leagueoflegends.com/cdn/11.14.1/img/spell/YasuoR.png'),
('Ability', 'RUNIC BLADE', 'https://ddragon.leagueoflegends.com/cdn/11.14.1/img/passive/RivenPassive.png'),
('Ability', 'BROKEN WINGS', 'https://ddragon.leagueoflegends.com/cdn/11.14.1/img/spell/RivenTriCleave.png'),
('Ability', 'KI BURST', 'https://ddragon.leagueoflegends.com/cdn/11.14.1/img/spell/RivenMartyr.png'),
('Ability', 'VALOR', 'https://ddragon.leagueoflegends.com/cdn/11.14.1/img/spell/RivenFeint.png'),
('Ability', 'BLADE OF THE EXILE', 'https://ddragon.leagueoflegends.com/cdn/11.14.1/img/spell/RivenFengShuiEngine.png');

INSERT INTO Summoner(id, level, rank, money)
VALUES ('Rookie', 10, 'Gold', 5000),
       ('Uzi', 20, 'Platinum', 7500),
       ('Theshy', 30, 'Diamond', 10000),
       ('Caps', 40, 'Master', 12500),
       ('Lwx', 50, 'Grandmaster', 15000);

INSERT INTO GameMode(name, description)
VALUES ('Ultra Rapid Fire', 'no cooldown'),
       ('One for All', 'same 5 champion'),
       ('Ultimate Spellbook', 'gain extra ability'),
       ('Soul Fighter', '2v2v2v2'),
       ('Nexus Blitz', 'more frequent fight');

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

INSERT INTO Monster(name, buff, type)
VALUES ('monsterA', 'Damage Boost', 'Dragon'),
       ('monsterB', 'Health Boost', 'Baron'),
       ('monsterC', 'Speed Boost', 'Rift Herald'),
       ('monsterD', 'Critical Boost', 'Kraken'),
       ('monsterE', 'Armor Boost', 'Elder Dragon');

INSERT INTO Minion(name, side, type)
VALUES ('minion1', 'Blue', 'Melee'),
       ('minion2', 'Blue', 'Caster'),
       ('minion3', 'Red', 'Melee'),
       ('minion4', 'Red', 'Caster'),
       ('minion5', 'Blue', 'Siege');

INSERT INTO Turret(name, position)
VALUES ('turret1', 'Top Lane outer'),
       ('turret2', 'Mid Lane inner'),
       ('turret3', 'Bot Lane outer'),
       ('turret4', 'Top Lane inhibitor'),
       ('turret5', 'Mid Lane inhibitor');

INSERT INTO SelectFavorite(id, name)
VALUES ('Rookie', 'Ultra Rapid Fire'),
       ('Rookie', 'One for All'),
       ('Uzi', 'Ultra Rapid Fire'),
       ('Lwx', 'Soul Fighter'),
       ('Caps', 'Nexus Blitz');

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
VALUES 
('The Unforgiven', 
 'In a land painted with betrayal and deception, one sword stood as a beacon of justice. Yet, even it fell victim to the corrosive nature of lies. Its gleaming blade tarnished, not with use, but with treachery. The story of this sword is not one of heroes or villains, but of redemption and vengeance. It is a tale inked with blood, each droplet a testament to its unyielding spirit.'),
('The Exile', 
 'In the vastness of an unforgiving world, a broken-sword wielding exile trudged through deserts and mountains. Her sword, once a symbol of honor, now shattered, just like the trust she once held. Each step, a journey towards mending not just the blade, but her fragmented soul. Through tempests and trials, she seeks not revenge, but atonement and a chance to once again stand tall.'),
('The Chain Warden', 
 'In the haunting mist of the Shadow Isles, Thresh emerged as a spirit not bound by the melancholy of his peers. Ambitious, relentless, and ever scheming, he seeks not just souls, but the pure ecstasy in their torment. His chains, an extension of his wicked will, are always ready to ensnare those who dare to venture close, drawing them into an abyss of eternal despair.'),
('The Sad Mummy', 
 'Legend speaks of a time when joy and laughter filled the world, and among them was a child mummy, gleeful and radiant. But a curse, cruel and unyielding, tore away his happiness, leaving him a lonely and melancholy soul. Now, he roams the world, wrapped in bandages and sorrow, yearning for the embrace of a friend, hoping to mend his broken heart.'),
('The Blind Monk', 
 'In the heart of an ancient monastery, lived a monk whose sight was taken not by age or ailment, but by choice. For in blindness, he saw the world more clearly than those with sight. With every resonating echo and whispering wind, he perceived truths that remained hidden from the world. Many see only a blind man, but in battle, with swift kicks and resonating strikes, he opens their eyes to the profound depths of his abilities.');

INSERT INTO ChampionBCNF(name, cost, region, epithet)
VALUES ('Yasuo', 4800, 'Ionia', 'The Unforgiven'),
       ('Riven', 2500, 'Noxus', 'The Exile'),
       ('Thresh', 10000, 'Shadow Isles', 'The Chain Warden'),
       ('Amumu', 450, 'Shurima', 'The Sad Mummy'),
       ('Lee Sin', 4800, 'Ionia', 'The Blind Monk');

INSERT INTO Play(id, name)
VALUES ('Rookie', 'Yasuo'),
       ('Rookie', 'Riven'),
       ('Uzi', 'Yasuo'),
       ('Lwx', 'Amumu'),
       ('Caps', 'Lee Sin');

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

INSERT INTO StoreVisit(storeID, promotion, id)
VALUES ('store 1', '20', 'Uzi'),
       ('store 2', '30', 'Rookie'),
       ('store 3', '45', 'Theshy'),
       ('store 4', '10', 'Caps'),
       ('store 5', '20', 'Lwx');

INSERT INTO Sell1(name, storeID)
VALUES ('Yasuo', 'store 1'),
       ('Lee Sin', 'store 2'),
       ('Thresh', 'store 2'),
       ('Thresh', 'store 3'),
       ('Amumu', 'store 4'),
       ('Lee Sin', 'store 5');

INSERT INTO Sell2(name, storeID)
VALUES ('PROJECT', 'store 1'),
       ('NIGHTBRINGER', 'store 2'),
       ('HEXTECH', 'store 3'),
       ('PULSEFIRE', 'store 4'),
       ('BLOOD MOON', 'store 5');

INSERT INTO TypeCost(type, cost)
VALUES ('Ultimate', 3250),
       ('Legendary', 1820),
       ('Mythic', 2000),
       ('Standard', 975),
       ('Epic', 1350);

INSERT INTO SkinDecorateBCNF(skin_name, type, champion_name)
VALUES ('PROJECT', 'Epic', 'Yasuo'),
       ('NIGHTBRINGER', 'Epic', 'Lee Sin'),
       ('HEXTECH', 'Mythic', 'Amumu'),
       ('PULSEFIRE', 'Legendary', 'Thresh'),
       ('BLOOD MOON', 'Epic', 'Yasuo');

INSERT INTO AbilityOwned(ability_name, cooldown, key, description, champion_name)
VALUES ('WAY OF THE WANDERER', 60, 'P', 'Yasuo’s resolve hardens as he moves, represented by his passive Resolve Bar. Resolve is divided into two parts, Resolve Flow and Resolve Steel, enhancing Yasuo’s abilities in different ways.', 'Yasuo'),
       ('STEEL TEMPEST', 8, 'Q', 'Yasuo thrusts forward with his sword, damaging all enemies in a line. Successfully landing Steel Tempest grants Yasuo Gathering Storm stacks for a short period.', 'Yasuo'),
       ('WIND WALL', 40, 'W', 'Yasuo creates a gust of wind that travels forward to form a wall, blocking all enemy projectiles except tower attacks.', 'Yasuo'),
       ('SWEEPING BLADE', 5, 'E', 'Yasuo dashes through the target enemy, dealing magic damage and marking them briefly. Each cast increases his next dash’s base damage.', 'Yasuo'),
       ('LAST BREATH', 120, 'R', 'Yasuo blinks to a nearby airborne enemy champion, immobilizing them and increasing his armor penetration significantly for a brief duration. He then deals physical damage to the target.', 'Yasuo'),
       ('RUNIC BLADE', 60, 'P', 'Riven’s abilities charge her blade, and her basic attacks expend charges to deal an additional physical damage. Her blade may be charged up to three times.', 'Riven'),
       ('BROKEN WINGS', 8, 'Q', 'Riven lashes out in a series of three strikes. The final strike can knock back surrounding enemies and all strikes deal physical damage.', 'Riven'),
       ('KI BURST', 40, 'W', 'Riven emits a Ki Burst, damaging and stunning nearby enemies. The radius of effect increases with each ability rank.', 'Riven'),
       ('VALOR', 5, 'E', 'Riven steps forward a short distance and gains a shield, absorbing incoming damage.', 'Riven'),
       ('BLADE OF THE EXILE', 120, 'R', 'Riven empowers her keepsake weapon with energy, extending her attack range and granting her bonus attack damage. She can also activate this ability to perform Wind Slash, dealing physical damage to all enemies hit.', 'Riven');
