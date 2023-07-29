# Project Description
The domain of our application is to develop a simple game platform, which will focus on providing detailed game information of League of Legends that associate with player accounts to the summoners once they log in. The main functionality will include showing the summoner's profile, friend list, champions and skins owned in account, statistics on the champions, learning about store information, champion’s ability, non-player characters and other in-game information.

There are seven entities designed for the database, which includes summoners(players), friend, store, champion, skin, ability and non-player character. The database will model the following relationship:
1. Summoners are allowed to view their friend information from the feature of friend list.
2. Summoners are allowed to visit the store and purchase the items.
3. Store is able to sell the champions owning name, epithet and background stories
4. Store is able to sell different champion skins
5. Summoners are allowed to play the champions they purchased 
6. Champions must have the abilities and they can be decorated by skins
7. Summoners are able to learn about non-player characters including monsters, minions and turrets.

The statistics entity is designed as a weak entity because it depends on the existence of the champion entity for meaningful context. Meanwhile, we design the participation constraints(total) for the relationship between champion and ability, since every champion must have the abilities in the setting.

# Database Specification
The database aims to provide users with convenience to go through valuable statistical information and tools. It allows users to analyze their performance and facilitates social interaction among players by providing a friend list feature. Store functionality is also offered for the player to purchase champions and skins. Furthermore, the database can be utilized for the player to know more about in-game information including but not limited to champion skills and neutral monster buffs. It contributes a collective of passionate gamers to League of Legends.

Application Platform Description
Our team will be using PHP as the platform to develop the application. As for DBMS, we will be using Oracle which is supported by the department's installation. For collaboration purposes, Github will be used to collect different parts of the project that are completed by different group members.

# ER Diagram




