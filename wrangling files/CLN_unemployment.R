library(readxl)
library(reshape2)

# Read in excel file
df <- read_xlsx('RAW_unemployment.xlsx',
                          sheet = 1,
                          skip = 2,
                          col_names = TRUE)
# List of regional victoria SA2
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

# Melt the dataframe
df <- melt(df, id = c(colnames(df)[1], colnames(df)[2]))

# Change the datatype of the date column from factor to numeric
df$variable <- as.numeric(as.character(df$variable))

# Convert the datatype of the date column to date 
df$variable <- as.Date(df$variable, origin = "1899-12-30")

# Extract only rows with SA2 code beginning with '2' (Vic.)
df <- df[startsWith(as.character(df$`SA2 Code`), '2'),]
df <- df[df$`Statistical Area Level 2 (SA2)` %in% regional,]

# Rename/Remove unnecessary columns
colnames(df)[1] <- 'Name'
colnames(df)[3] <- 'Date'
colnames(df)[4] <- 'Unemployment_rate'
df$`SA2 Code` <- NULL

# Write out to csv
write.csv(df, 'unemployment_final.csv', row.names = FALSE)
