DROP TABLE IF EXISTS countryflags;

CREATE TABLE IF NOT EXISTS countryflags(
country varchar(50) not null,
flagname varchar(50) NOT NULL

    
     )Engine INNODB;
     
     
LOAD data INFILE 'D:/Documents and Settings/common/flags/flags.txt' INTO TABLE countryflags 
FIELDS OPTIONALLY ENCLOSED BY '"' 
LINES TERMINATED BY '\r\n' 