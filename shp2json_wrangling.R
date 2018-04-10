library(sf)
library(dplyr)
reg_vic <- st_read("SA2_2016_AUST.shp")
print(reg_vic)
sa2 <- read.csv('~/Desktop/FIT5120/4Shore/industry_df.csv')

head(sa2)
head(reg_vic)
reg_vic_codes <- unique(sa2$Code)

both <- intersect(reg_vic$SA2_MAIN16, sa2$Code)
head(both)
reg_vic_cleaned <- reg_vic[reg_vic$SA2_MAIN16 %in% both,]
dim(reg_vic_cleaned)

head(reg_vic_cleaned)

st_write(reg_vic_cleaned, 'SA2_2016_VIC.shp')
