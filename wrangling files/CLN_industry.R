library(gdata)
library(dplyr)
library(reshape2)

# Read in excel file
df <- read.xls('RAW_industry.xls', stringsAsFactor = FALSE)
headers <- read.xls('RAW_industry.xls', stringsAsFactor = FALSE)
sa2_lga_vic <- read.csv('sa2_lga_vic.csv')

# Subset data
df <- df[, c(1:3, 19:36)]
df <- df[startsWith(as.character(df$X), '2'),]
a <- subset(df, grepl('(2\\d\\d\\d\\d\\d\\d\\d\\d)', X))
colnames(a)[2] <- 'Name'
colnames(a)[3] <- 'Year'
b <- a[a$Name %in% unique(sa2_lga_vic$SA2_Name),]
cols <- headers[5,]
cols <- cols[c(1:3, 19:36)]
colnames(cols)[2] <- 'Name'
colnames(cols)[3] <- 'Year'
c <- rbind(cols, b)
colnames(c) <- c[1,]
colnames(c)[1] <- 'Code'
colnames(c)[2] <- 'Name'
colnames(c)[3] <- 'Year'
c <- c[-1,]
c <- c[!c$Year == 2011,]
c <- c[,-1]
c <- melt(c, id = c('Name', 'Year'))
colnames(c)[3] <- 'Industry'
colnames(c)[4] <- 'No_businesses'
c$No_businesses[c$No_businesses == '-'] <- NA
c$No_businesses <- as.numeric(c$No_businesses)

# write out to csv
write.csv(c, 'industry_final.csv', row.names = FALSE)

