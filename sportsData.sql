/*Load CSV file into SQL data base
 *Can be imported directly, using phpMyAdmin
 */
LOAD DATA LOCAL INFILE '/lga_names.csv'
INTO TABLE `LGA_Names`
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n'

LOAD DATA LOCAL INFILE '/SportsRec.csv'
INTO TABLE `sports_rec`
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n'

/*Convert columsn to title case*/
UPDATE `sports_rec` SET `LGA`= CONCAT( UPPER( SUBSTRING( `LGA`, 1, 1 ) ) , LOWER( SUBSTRING( `LGA` FROM 2 ) ) );
RENAME TABLE `table 3` TO `LGA_Names`;

/*Join tables on LGA Names*/
SELECT S.`OBJECTID`, S.`FacilityName`, S.`StreetNo`, S.`StreetName`, S.`StreetType`, S.`SuburbTown`, 
	S.`Postcode`, S.`Latitude`, S.`Longitude`, S.`SportsPlayed`, L.lga_name 
FROM 
	`LGA_Names` L 
LEFT JOIN 
	`sports_rec` S
ON
	L.lga_name = S.LGA;
/*Create new table with only required LGAs*/
CREATE TABLE sportsRec_facilities
(
    SELECT DISTINCT S.`FacilityName` as facility_name, S.`StreetNo` as street_no, 
    CONCAT (S.`StreetName`, S.`StreetType`) as street_add, S.`SuburbTown` as suburb, 
	S.`Postcode` as postcode, S.`Latitude` as latitude, S.`Longitude` as longitude, S.`SportsPlayed` as sport_type , L.lga_name as LGA
FROM 
	`LGA_Names` L 
LEFT JOIN 
	`sports_rec` S
ON
	L.lga_name = S.LGA
);
