library(readxl)

# Read in excel file
df <- read_xls('RAW_income.xls',
               sheet = 5,
               skip = 6,
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

# Extract only rows with SA2 code beginning with '2' (Vic.)
df <- df[startsWith(as.character(df$SA2), '2'),]

# Select rows that have regional Vic. SA2
df <- df[df$`SA2 NAME` %in% regional,]
df <- df[,c(2, 22)]
colnames(df)[1] <- 'Name'
colnames(df)[2] <- 'Median_income'

# write out to csv
write.csv(df, 'income_final.csv', row.names = FALSE)