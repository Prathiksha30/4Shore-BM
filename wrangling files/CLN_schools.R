library(readxl)
library(dplyr)
library(stringr)

# Read in excel files
df <- read.csv('RAW_schools.csv', stringsAsFactors = FALSE)
sa2_lga_vic <- read.csv('sa2_lga_vic.csv', stringsAsFactors = FALSE)

# Subset and concatenate variables
df <- df[, c(1,4,5,7,8,9,11,17,19,20,21)]
df$Street_Address <- paste(paste0(df$Address_Line_1, ','), df$Address_Line_2, df$Address_Town)
df <- df[, -c(4,5,6)]
colnames(df)[7] <- 'Latitude'
colnames(df)[8] <- 'Longitude'

# Remove trailing parenthesis item in LGA_Name
df$LGA_Name <- str_replace_all(df$LGA_Name, '\\s[(]\\w+[)]', '')

# Join to correspondance to obtain SA2 from LGA
a <- inner_join(sa2_lga_vic, df, by = c('LGA_Name' = 'LGA_Name'))
a <- a[, -2]

# Write out to csv
write.csv(a, 'schools_final.csv', row.names = FALSE)
