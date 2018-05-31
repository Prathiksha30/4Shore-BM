library(data.table)
library(readxl)
library(stringr)
regional <- c('Alfredton','Ballarat','Ballarat - North','Ballarat - South','Buninyong',
                     'Delacombe','Smythes Creek','Wendouree - Miners Rest','Bacchus Marsh Region',
                     'Creswick - Clunes','Daylesford','Gordon (Vic.)','Avoca','Beaufort','Golden Plains - North',
                     'Maryborough (Vic.)','Maryborough Region','Bendigo','California Gully - Eaglehawk',
                     'East Bendigo - Kennington','Flora Hill - Spring Gully','Kangaroo Flat - Golden Square',
                     'Maiden Gully','Strathfieldsaye','White Hills - Ascot','Bendigo Region - South','Castlemaine',
                     'Castlemaine Region','Heathcote','Kyneton','Woodend','Bendigo Region - North','Loddon',
                     'Bannockburn','Golden Plains - South','Winchelsea','Belmont','Corio - Norlane','Geelong',
                     'Geelong West - Hamlyn Heights','Grovedale','Highton','Lara','Leopold','Newcomb - Moolap',
                     'Newtown (Vic.)','North Geelong - Bell Park','Clifton Springs','Lorne - Anglesea',
                     'Ocean Grove - Barwon Heads','Portarlington','Torquay','Alexandra','Euroa','Kilmore - Broadford',
                     'Mansfield (Vic.)','Nagambie','Seymour','Seymour Region','Yea','Benalla','Benalla Region',
                     'Rutherglen','Wangaratta','Wangaratta Region','Beechworth','Bright - Mount Beauty',
                     'Chiltern - Indigo Valley','Myrtleford','Towong','West Wodonga','Wodonga','Yackandandah',
                     'Drouin','Mount Baw Baw Region','Trafalgar (Vic.)','Warragul','Bairnsdale','Bruthen - Omeo',
                     'Lakes Entrance','Orbost','Paynesville','Foster','Korumburra','Leongatha','Phillip Island',
                     'Wonthaggi - Inverloch','Churchill','Moe - Newborough','Morwell','Traralgon','Yallourn North - Glengarry',
                     'Longford - Loch Sport','Maffra','Rosedale','Sale','Yarram','Ararat','Ararat Region',
                     'Horsham','Horsham Region','Nhill Region','St Arnaud','Stawell','West Wimmera','Yarriambiack',
                     'Irymple','Merbein','Mildura Region','Red Cliffs','Buloke','Gannawarra','Kerang','Robinvale',
                     'Swan Hill','Swan Hill Region','Echuca','Kyabram','Lockington - Gunbower','Rochester',
                     'Rushworth','Cobram','Moira','Numurkah','Yarrawonga','Mooroopna','Shepparton - North',
                     'Shepparton - South','Shepparton Region - East','Shepparton Region - West','Glenelg (Vic.)',
                     'Hamilton (Vic.)','Portland','Southern Grampians','Camperdown','Colac','Colac Region',
                     'Corangamite - North','Corangamite - South','Otway','Moyne - East','Moyne - West',
                     'Warrnambool - North','Warrnambool - South')

# Read in excel file
sa2_lga <- read_xls('RAW_correspondence.xls',
                    sheet = 4,
                    skip = 5,
                    col_names = TRUE)

# Omit NA rows
sa2_lga <- na.omit(sa2_lga)

# Select rows only in regional Vic SA2
sa2_lga_vic <- sa2_lga[sa2_lga$SA2_NAME_2011 %in% regional,]

# Rename/Remove columns
colnames(sa2_lga_vic)[2] <- 'SA2_Name'
colnames(sa2_lga_vic)[4] <- 'LGA_Name'
sa2_lga_vic$SA2_MAINCODE_2011 <- NULL
sa2_lga_vic$LGA_CODE_2011 <- NULL
sa2_lga_vic$RATIO <- NULL
sa2_lga_vic$PERCENTAGE <- NULL

# Remove trailing parenthesis item in LGA_Name
sa2_lga_vic$LGA_Name <- str_replace_all(sa2_lga_vic$LGA_Name, '\\s[(]\\w+[)]', '')

# Write out to csv
write.csv(sa2_lga_vic, 'sa2_lga_vic.csv', row.names = FALSE)
