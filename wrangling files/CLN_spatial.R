library(sf)
library(dplyr)
reg_vic <- st_read("SA2_2016_AUST.shp")
sa2_lga_vic <- read.csv('sa2_lga_vic.csv')

reg_vic_codes <- unique(sa2_lga_vic$SA2_Name)

both <- intersect(reg_vic$SA2_NAME16, sa2_lga_vic$SA2_Name)

reg_vic_cleaned <- reg_vic[reg_vic$SA2_NAME16 %in% both,]
dim(reg_vic_cleaned)
head(reg_vic_cleaned)

reg_vic_super_cleaned <- subset(reg_vic_cleaned, select=c(SA2_NAME16, geometry))

st_write(reg_vic_super_cleaned, 'SA2_2016_VIC_SC.shp')
