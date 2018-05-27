library(readxl)
# Read in excel file
df <- read_xls('RAW_age.xls',
               sheet = 7,
               skip = 6)
sa2_lga_vic <- read.csv('sa2_lga_vic.csv')

# Subset data
df <- df[-c(1,2),]
df <- head(df, -6)

# Rename/Remove columns 
colnames(df)[10] <- 'Name'
df <- df[,-c(1:9, 29)]
colnames(df)[19] <- '85+'

# Melt dataframe
df <- melt(df, id = c('Name'))
colnames(df)[2] <- 'Age'
colnames(df)[3] <- 'Number'

# Keep only SA2 in reg vic
df <- df[df$Name %in% unique(sa2_lga_vic$SA2_Name),]

# Datatype
df$Age <- as.character(df$Age)

# write out to csv
write.csv(df, 'age_final.csv', row.names = FALSE)

