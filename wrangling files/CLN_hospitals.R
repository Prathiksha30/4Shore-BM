library(readxl)
library(dplyr)

# Read in excel file
df <- read.csv('RAW_hospitals.csv', stringsAsFactors = FALSE)
sa2_lga_vic <- read.csv('sa2_lga_vic.csv', stringsAsFactors = FALSE)

# Keep only Vic. hospitals 
df <- df[df$State == 'VIC',]

# Subset and concatenate variables
df <- df[,c(1,2,4,6,7,8,9,12,14)]
df$StreetAddress <- paste(df$StreetNum, df$RoadName, df$RoadType)
df <- df[, -c(5,6,7)]
colnames(df)[1] <- 'latitude'
colnames(df)[2] <- 'longitude'

# Remove trailing parenthesis item in LGA_Name
df$LGAName <- str_replace_all(df$LGAName, '\\s[(]\\w+[)]', '')

# Dealing with all caps LGA names
df$LGAName <- sapply(df$LGAName, tolower) # convert everything to lower case

simpleCap <- function(x) {
  s <- strsplit(x, " ")[[1]]
  paste(toupper(substring(s, 1,1)), substring(s, 2),
        sep="", collapse=" ")
} # function to capitalise the first letter of each word

df$LGAName <- sapply(df$LGAName, simpleCap) # convert lower cases back to proper form

# Keep hospitals only from regional Vic SA2
a <- inner_join(sa2_lga_vic, df, by = c('LGA_Name' = 'LGAName'))
a <- a[, -2]

# Write out to csv
write.csv(a, 'hospitals_final.csv', row.names = FALSE)
