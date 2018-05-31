library(readxl)
library(dplyr)
library(stringr)
library(reshape2)
library(data.table)
library(zoo)

# Read in excel files
flat1 <- read_xlsx('RAW_rent.xlsx', sheet = 1)
flat2 <- read_xlsx('RAW_rent.xlsx', sheet = 2)
flat3 <- read_xlsx('RAW_rent.xlsx', sheet = 3)
house2 <- read_xlsx('RAW_rent.xlsx', sheet = 4)
house3 <- read_xlsx('RAW_rent.xlsx', sheet = 5)
house4 <- read_xlsx('RAW_rent.xlsx', sheet = 6)
sa2_lga_vic <- read.csv('sa2_lga_vic.csv')

# Remove rows with all NA
flat1 <- flat1[rowSums(is.na(flat1))!=ncol(flat1), ]
flat2 <- flat2[rowSums(is.na(flat2))!=ncol(flat2), ]
flat3 <- flat3[rowSums(is.na(flat3))!=ncol(flat3), ]
house2 <- house2[rowSums(is.na(house2))!=ncol(house2), ]
house3 <- house3[rowSums(is.na(house3))!=ncol(house3), ]
house4 <- house4[rowSums(is.na(house4))!=ncol(house4), ]

# Remove unnecessary rows
flat3 <- flat3[-(93:96),]
house3 <- house3[-(93:94),]

# Remove unnecessary column
flat1[,1] <- NULL
flat2[,1] <- NULL
flat3[,1] <- NULL
house2[,1] <- NULL
house3[,1] <- NULL
house4[,1] <- NULL
flat1 <- melt(flat1, id = 'X__2')
flat2 <- melt(flat2, id = 'X__2')
flat3 <- melt(flat3, id = 'X__2')
house2 <- melt(house2, id = 'X__2')
house3 <- melt(house3, id = 'X__2')
house4 <- melt(house4, id = 'X__2')

# Subset data
flat1 <- flat1[startsWith(as.character(flat1$variable), 'X'),]
flat2 <- flat2[startsWith(as.character(flat2$variable), 'X'),]
flat3 <- flat3[startsWith(as.character(flat3$variable), 'X'),]
house2 <- house2[startsWith(as.character(house2$variable), 'X'),]
house3 <- house3[startsWith(as.character(house3$variable), 'X'),]
house4 <- house4[startsWith(as.character(house4$variable), 'X'),]
flat1 <- flat1[complete.cases(flat1), ]
flat2 <- flat2[complete.cases(flat2), ]
flat3 <- flat3[complete.cases(flat3), ]
house2 <- house2[complete.cases(house2),]
house3 <- house3[complete.cases(house3),]
house4 <- house4[complete.cases(house4),]

# Function to transform into correct dates
fun <- function(df){
  df$variable <- str_replace_all(df$variable, 'X__3$', '1999/06/01')
  df$variable <- str_replace_all(df$variable, 'X__4$', '1999/09/01')
  df$variable <- str_replace_all(df$variable, 'X__5$', '1999/12/01')
  df$variable <- str_replace_all(df$variable, 'X__6$', '2000/03/01')
  df$variable <- str_replace_all(df$variable, 'X__7$', '2000/06/01')
  df$variable <- str_replace_all(df$variable, 'X__8$', '2000/09/01')
  df$variable <- str_replace_all(df$variable, 'X__9$', '2000/12/01')
  df$variable <- str_replace_all(df$variable, 'X__10', '2001/03/01')
  df$variable <- str_replace_all(df$variable, 'X__11', '2001/06/01')
  df$variable <- str_replace_all(df$variable, 'X__12', '2001/09/01')
  df$variable <- str_replace_all(df$variable, 'X__13', '2001/12/01')
  df$variable <- str_replace_all(df$variable, 'X__14', '2002/03/01')
  df$variable <- str_replace_all(df$variable, 'X__15', '2002/06/01')
  df$variable <- str_replace_all(df$variable, 'X__16', '2002/09/01')
  df$variable <- str_replace_all(df$variable, 'X__17', '2002/12/01')
  df$variable <- str_replace_all(df$variable, 'X__18', '2003/03/01')
  df$variable <- str_replace_all(df$variable, 'X__19', '2003/06/01')
  df$variable <- str_replace_all(df$variable, 'X__20', '2003/09/01')
  df$variable <- str_replace_all(df$variable, 'X__21', '2003/12/01')
  df$variable <- str_replace_all(df$variable, 'X__22', '2004/03/01')
  df$variable <- str_replace_all(df$variable, 'X__23', '2004/06/01')
  df$variable <- str_replace_all(df$variable, 'X__24', '2004/09/01')
  df$variable <- str_replace_all(df$variable, 'X__25', '2004/12/01')
  df$variable <- str_replace_all(df$variable, 'X__26', '2005/03/01')
  df$variable <- str_replace_all(df$variable, 'X__27', '2005/06/01')
  df$variable <- str_replace_all(df$variable, 'X__28', '2005/09/01')
  df$variable <- str_replace_all(df$variable, 'X__29', '2005/12/01')
  df$variable <- str_replace_all(df$variable, 'X__30', '2006/03/01')
  df$variable <- str_replace_all(df$variable, 'X__31', '2006/06/01')
  df$variable <- str_replace_all(df$variable, 'X__32', '2006/09/01')
  df$variable <- str_replace_all(df$variable, 'X__33', '2006/12/01')
  df$variable <- str_replace_all(df$variable, 'X__34', '2007/03/01')
  df$variable <- str_replace_all(df$variable, 'X__35', '2007/06/01')
  df$variable <- str_replace_all(df$variable, 'X__36', '2007/09/01')
  df$variable <- str_replace_all(df$variable, 'X__37', '2007/12/01')
  df$variable <- str_replace_all(df$variable, 'X__38', '2008/03/01')
  df$variable <- str_replace_all(df$variable, 'X__39', '2008/06/01')
  df$variable <- str_replace_all(df$variable, 'X__40', '2008/09/01')
  df$variable <- str_replace_all(df$variable, 'X__41', '2008/12/01')
  df$variable <- str_replace_all(df$variable, 'X__42', '2009/03/01')
  df$variable <- str_replace_all(df$variable, 'X__43', '2009/06/01')
  df$variable <- str_replace_all(df$variable, 'X__44', '2009/09/01')
  df$variable <- str_replace_all(df$variable, 'X__45', '2009/12/01')
  df$variable <- str_replace_all(df$variable, 'X__46', '2010/03/01')
  df$variable <- str_replace_all(df$variable, 'X__47', '2010/06/01')
  df$variable <- str_replace_all(df$variable, 'X__48', '2010/09/01')
  df$variable <- str_replace_all(df$variable, 'X__49', '2010/12/01')
  df$variable <- str_replace_all(df$variable, 'X__50', '2011/03/01')
  df$variable <- str_replace_all(df$variable, 'X__51', '2011/06/01')
  df$variable <- str_replace_all(df$variable, 'X__52', '2011/09/01')
  df$variable <- str_replace_all(df$variable, 'X__53', '2011/12/01')
  df$variable <- str_replace_all(df$variable, 'X__54', '2012/03/01')
  df$variable <- str_replace_all(df$variable, 'X__55', '2012/06/01')
  df$variable <- str_replace_all(df$variable, 'X__56', '2012/09/01')
  df$variable <- str_replace_all(df$variable, 'X__57', '2012/12/01')
  df$variable <- str_replace_all(df$variable, 'X__58', '2013/03/01')
  df$variable <- str_replace_all(df$variable, 'X__59', '2013/06/01')
  df$variable <- str_replace_all(df$variable, 'X__60', '2013/09/01')
  df$variable <- str_replace_all(df$variable, 'X__61', '2013/12/01')
  df$variable <- str_replace_all(df$variable, 'X__62', '2014/03/01')
  df$variable <- str_replace_all(df$variable, 'X__63', '2014/06/01')
  df$variable <- str_replace_all(df$variable, 'X__64', '2014/09/01')
  df$variable <- str_replace_all(df$variable, 'X__65', '2014/12/01')
  df$variable <- str_replace_all(df$variable, 'X__66', '2015/03/01')
  df$variable <- str_replace_all(df$variable, 'X__67', '2015/06/01')
  df$variable <- str_replace_all(df$variable, 'X__68', '2015/09/01')
  df$variable <- str_replace_all(df$variable, 'X__69', '2015/12/01')
  df$variable <- str_replace_all(df$variable, 'X__70', '2016/03/01')
  df$variable <- str_replace_all(df$variable, 'X__71', '2016/06/01')
  df$variable <- str_replace_all(df$variable, 'X__72', '2016/09/01')
  df$variable <- str_replace_all(df$variable, 'X__73', '2016/12/01')
  df$variable <- str_replace_all(df$variable, 'X__74', '2017/03/01')
  df$variable <- str_replace_all(df$variable, 'X__75', '2017/06/01')
  df$variable <- str_replace_all(df$variable, 'X__76', '2017/09/01')
  df$variable <- str_replace_all(df$variable, 'X__77', '2017/12/01')
  return(df)
}

# Transform datasets using function
flat1 <- fun(flat1)
flat2 <- fun(flat2)
flat3 <- fun(flat3)
house2 <- fun(house2)
house3 <- fun(house3)
house4 <- fun(house4)

# Insert dwelling type column
flat1[4] <- '1 Bedroom Flat'
flat2[4] <- '2 Bedroom Flat'
flat3[4] <- '3 Bedroom Flat'
house2[4] <- '2 Bedroom House'
house3[4] <- '3 Bedroom House'
house4[4] <- '4 Bedroom House'

# row bind all dataframes into a single dataframe
df <- rbind(flat1, flat2, flat3, house2, house3, house4)

# Filter by sa2_lga_vic
df <- inner_join(sa2_lga_vic, df, by = c('LGA_Name' = 'X__2'))

# Remove/Rename variables
df[,2] <- NULL
colnames(df)[1] <- 'Name'
colnames(df)[2] <- 'Date'
colnames(df)[3] <- 'Price'
colnames(df)[4] <- 'Type'


# Replace '-' in Price variable with NAs
df$Price[df$Price == '-'] <- NA

# Change Price variable datatype to int
df$Price <- as.integer(df$Price)

# Group by name, type and date and average the price
b <- data.table(df)
b <- b[, .(Price = mean(na.omit(Price))), by = .(Name, Type, Date)]

# Datatype format
b$Date <- as.Date(b$Date)
b$Name <- as.character(b$Name)

# Write to csv
write.csv(b, 'rent_final.csv', row.names = FALSE)

