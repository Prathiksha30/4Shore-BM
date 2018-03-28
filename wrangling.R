library(reshape2)
SA2 <- read_csv('All_SA2.csv')
vic <- read_csv('sa2_vic.csv')

vic_SA2 <- left_join(vic, SA2)

melb <- data.frame(name = c('Brunswick', 'Brunswick East', 'Brunswick West', 'Coburg', 'Pascoe Vale South', 
                            'Alphington - Fairfield', 'Northcote', 'Thornbury', 'Ascot Vale', 
                            'Essendon - Aberfeldie', 'Flemington', 'Moonee Ponds', 'Carlton', 'Docklands',
                            'East Melbourne', 'Kensington (Vic.)', 'Melbourne', 'North Melbourne', 'Parkville',
                            'South Yarra - West', 'Southbank', 'Albert Park', 'Elwood', 'Port Melbourne',
                            'South Melbourne', 'St Kilda', 'St Kilda East', 'Armadale', 'Prahran - Windsor',
                            'South Yarra - East', 'Toorak', 'Abbotsford', 'Carlton North - Princes Hill',
                            'Collingwood', 'Fitzroy', 'Fitzroy North', 'Richmond (Vic.)', 'Yarra - North', 'Ashburton (Vic.)',
                            'Balwyn', 'Balwyn North', 'Camberwell', 'Glen Iris - East', 'Hawthorn', 'Hawthorn East',
                            'Kew', 'Kew East', 'Surrey Hills (West) - Canterbury', 'Bulleen', 'Doncaster','Templestowe',
                            'Templestowe Lower','Doncaster East (North)','Doncaster East (South)','Blackburn','Blackburn South',
                            'Box Hill','Box Hill North','Burwood','Burwood East','Surrey Hills (East) - Mont Albert',
                            'Beaumaris','Brighton (Vic.)', 'Brighton East','Cheltenham - Highett (West)','Hampton',
                            'Sandringham - Black Rock','Bentleigh - McKinnon', 'Carnegie','Caulfield - North',
                            'Caulfield - South','Elsternwick','Hughesdale','Murrumbeena','Ormond - Glen Huntly',
                            'Bentleigh East (North)','Bentleigh East (South)','Aspendale Gardens - Waterways',
                            'Carrum - Patterson Lakes','Chelsea - Bonbeach','Chelsea Heights','Cheltenham - Highett (East)',
                            'Edithvale - Aspendale','Mentone','Moorabbin - Heatherton','Mordialloc - Parkdale',
                            'Malvern - Glen Iris','Malvern East','Bundoora - East','Greensborough','Heidelberg - Rosanna',
                            'Heidelberg West','Ivanhoe','Ivanhoe East - Eaglemont','Montmorency - Briar Hill',
                            'Viewbank - Yallambie','Watsonia','Kingsbury','Reservoir - East','Reservoir - West',
                            'Preston - East','Preston - West','Eltham','Hurstbridge','Kinglake','Panton Hill - St Andrews',
                            'Plenty - Yarrambat','Research - North Warrandyte','Wattle Glen - Diamond Creek','Bundoora - North',
                            'Bundoora - West','Lalor','Mill Park - North','Mill Park - South','Thomastown','Wallan',
                            'Whittlesea','Doreen','Epping - East','Epping - South','Epping - West','Mernda','South Morang (North)',
                            'South Morang (South)','Wollert','Airport West','Keilor','Keilor East','Niddrie - Essendon West',
                            'Strathmore','Gisborne','Macedon','Riddells Creek','Romsey','Coburg North','Fawkner','Pascoe Vale',
                            'Glenroy','Gowanbrae','Hadfield','Sunbury','Sunbury - South','Broadmeadows','Campbellfield - Coolaroo',
                            'Gladstone Park - Westmeadows','Greenvale - Bulla','Meadow Heights','Melbourne Airport','Roxburgh Park - Somerton',
                            'Tullamarine','Craigieburn - Central','Craigieburn - North','Craigieburn - South','Craigieburn - West',
                            'Mickleham - Yuroke','Bayswater','Knoxfield - Scoresby','Lysterfield','Rowville - Central','Rowville - North',
                            'Rowville - South','Wantirna','Wantirna South','Boronia','Ferntree Gully (North)','Ferntree Gully (South) - Upper Ferntree Gully',
                            'The Basin','Donvale - Park Orchards','Warrandyte - Wonga Park','Bayswater North','Croydon Hills - Warranwood',
                            'Ringwood','Ringwood East','Ringwood North','Croydon - East','Croydon - West','Croydon South','Forest Hill',
                            'Mitcham (Vic.)','Nunawading','Vermont','Vermont South','Belgrave - Selby','Chirnside Park','Healesville - Yarra Glen',
                            'Kilsyth','Lilydale - Coldstream','Monbulk - Silvan','Montrose','Mooroolbark','Mount Dandenong - Olinda','Mount Evelyn',
                            'Upwey - Tecoma','Wandin - Seville','Yarra Valley','Beaconsfield - Officer','Bunyip - Garfield','Emerald - Cockatoo',
                            'Koo Wee Rup','Pakenham - North','Pakenham - South','Berwick - North','Berwick - South','Doveton','Hallam',
                            'Narre Warren North','Endeavour Hills - North','Endeavour Hills - South','Narre Warren - North East','Narre Warren - South West',
                            'Cranbourne','Cranbourne East','Cranbourne North','Cranbourne South','Cranbourne West','Hampton Park - Lynbrook',
                            'Lynbrook - Lyndhurst','Pearcedale - Tooradin','Narre Warren South (East)','Narre Warren South (West)',
                            'Clarinda - Oakleigh South','Clayton South','Dandenong','Dandenong North','Dingley Village','Keysborough',
                            'Noble Park North','Springvale','Springvale South','Noble Park - East','Noble Park - West','Ashwood - Chadstone',
                            'Clayton','Glen Waverley - East','Glen Waverley - West','Mount Waverley - North','Mount Waverley - South',
                            'Mulgrave','Oakleigh - Huntingdale','Wheelers Hill','Ardeer - Albion','Cairnlea','Deer Park - Derrimut',
                            'Delahey','Keilor Downs','Kings Park (Vic.)','St Albans - North','St Albans - South','Sunshine','Sunshine North',
                            'Sunshine West','Sydenham','Taylors Lakes','Altona','Altona Meadows','Altona North','Newport','Seabrook',
                            'Williamstown','Braybrook','Footscray','Maribyrnong','Seddon - Kingsville','West Footscray - Tottenham',
                            'Yarraville','Bacchus Marsh','Hillside','Melton','Melton South','Melton West','Rockbank - Mount Cottrell',
                            'Taylors Hill','Burnside','Burnside Heights','Caroline Springs','Hoppers Crossing - North','Hoppers Crossing - South',
                            'Laverton','Tarneit','Truganina','Werribee - South','Wyndham Vale','Point Cook - East','Point Cook - North',
                            'Point Cook - South','Werribee - East','Werribee - West','Carrum Downs','Frankston','Frankston North','Frankston South',
                            'Langwarrin','Seaford (Vic.)','Skye - Sandhurst','Dromana','Flinders','Hastings - Somers','Mornington','Mount Eliza',
                            'Mount Martha','Point Nepean','Rosebud - McCrae','Somerville'))

reg_vic <- vic_SA2[!(vic_SA2$name %in% melb$name),]
reg_vic <- reg_vic[complete.cases(reg_vic), ]
write.csv(reg_vic, file='regional_victoria.csv')


industry <- read.csv('industry.csv')
industry$Total <- NULL
industry$Currently.unknown <- NULL

df <- melt(industry, id=c('code', 'name', 'year'))

write.csv(df, 'industry_df.csv')

unique(df$LABEL)

reg_vic <- read.csv('regional_victoria_df.csv')
unique(reg_vic$name)

one_bed_flat <- read.csv('1bedflat.csv')
one_bed_flat <- melt(one_bed_flat, id='Name')
colnames(one_bed_flat)[2] <- 'Date'
colnames(one_bed_flat)[3] <- 'Price'
one_bed_flat[4] <- '1 Bedroom Flat'
colnames(one_bed_flat)[4] <- 'Type'

two_bed_flat <- read.csv('2bedflat.csv')
two_bed_flat <- melt(two_bed_flat, id='Name')
colnames(two_bed_flat)[2] <- 'Date'
colnames(two_bed_flat)[3] <- 'Price'
two_bed_flat[4] <- '2 Bedroom Flat'
colnames(two_bed_flat)[4] <- 'Type'

three_bed_flat <- read.csv('3bedflat.csv')
three_bed_flat <- melt(three_bed_flat, id='Name')
colnames(three_bed_flat)[2] <- 'Date'
colnames(three_bed_flat)[3] <- 'Price'
three_bed_flat[4] <- '3 Bedroom Flat'
colnames(three_bed_flat)[4] <- 'Type'

two_bed_house <- read.csv('2bedhouse.csv')
two_bed_house <- melt(two_bed_house, id='Name')
colnames(two_bed_house)[2] <- 'Date'
colnames(two_bed_house)[3] <- 'Price'
two_bed_house[4] <- '2 Bedroom House'
colnames(two_bed_house)[4] <- 'Type'

three_bed_house <- read.csv('3bedhouse.csv')
three_bed_house <- melt(three_bed_house, id='Name')
colnames(three_bed_house)[2] <- 'Date'
colnames(three_bed_house)[3] <- 'Price'
three_bed_house[4] <- '3 Bedroom House'
colnames(three_bed_house)[4] <- 'Type'

four_bed_house <- read.csv('4bedhouse.csv')
four_bed_house <- melt(four_bed_house, id='Name')
colnames(four_bed_house)[2] <- 'Date'
colnames(four_bed_house)[3] <- 'Price'
four_bed_house[4] <- '4 Bedroom House'
colnames(four_bed_house)[4] <- 'Type'

rent <- rbind(one_bed_flat, two_bed_flat, three_bed_flat, two_bed_house, three_bed_house, four_bed_house)
rent$Price <- as.numeric(gsub('\\$', '', rent$Price))

write.csv(rent, 'rent_df.csv', row.names=FALSE)

rent$Date[rent$Date =='Dec.03.1']
rent[is.na(rent$Name)]
