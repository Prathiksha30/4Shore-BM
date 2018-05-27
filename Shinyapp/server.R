#
# This is the server logic of a Shiny web application. You can run the 
# application by clicking 'Run App' above.
#
# Find out more about building applications with Shiny here:
# 
#    http://shiny.rstudio.com/
#

library(shiny)
library(shinydashboard)
library(ggplot2)
library(scales)
library(lubridate)
library(dygraphs)
library(rAmCharts)
library(shinyWidgets)
library(leaflet)
library(rgdal)
library(matrixStats)
library(shinycssloaders)
library(dplyr)
library(matrixStats)
library(RMySQL)
library(data.table)


# Industry <<- fread('industry_final.csv')
# Industry$Year <<- as.numeric(Industry$Year)
# Rent <<- fread('rent_final.csv')
# Rent$Date <<- as.Date(Rent$Date)
# Unemployment <<- fread('unemployment_final.csv')
# Unemployment$Date <<- as.Date(Unemployment$Date)
# Income <<- fread('income_final.csv')
# Age <<- fread('age_final.csv')
# Age$Number <<- as.numeric(Age$Number)
# age_order <<- c("0-4","5–9","10–14","15–19","20–24","25–29","30–34","35–39","40–44", 
#               "45–49","50–54","55–59","60–64","65–69","70–74","75–79","80–84","85+")
# Age[, Age := factor(Age, levels = age_order)]

# database config
options(mysql=list(
  "host"="fshore.cxjhwwvvzrvf.ap-southeast-2.rds.amazonaws.com",
  "port"=3306,
  "user"="jkang94",
  "password"="HjPr!4ShoreK1.08"
))

# database name
databaseName <- "beyond_melb"

# function to read in tables from MySQL
fetch_table <- function(tablename, industry=NULL, suburb=NULL) {
  db <- dbConnect(MySQL(), dbname=databaseName, host=options()$mysql$host,
                  port=options()$mysql$port, user=options()$mysql$user,
                  password=options()$mysql$password)
  
  query <- sprintf("SELECT * FROM %s", 
                   tablename)
  if(!is.null(industry)){
    query <- sprintf("SELECT * FROM %s WHERE Industry='%s'", 
                    tablename, industry)
  }
  
  if(!is.null(suburb)){
    query <- sprintf("SELECT * FROM %s WHERE Name='%s'",
                     tablename, suburb)
  }
  
  data <- dbGetQuery(db, query)
  
  dbDisconnect(db)
  
  return(data)
}

# Industry <<- fetch_table('industry_final')
# Industry <<- data.table(Industry)

# Rent <<- fetch_table('rent_final')
# Rent$Date <<- as.Date(Rent$Date)
# Rent$Price[Rent$Price == 0] <<- NA
# Rent <<- data.table(Rent)

Regional_rent <<- fetch_table('regional_rent_final')
Regional_rent$Date <<- as.Date(Regional_rent$Date)
Regional_rent <<- data.table(Regional_rent)
Unemployment <<- fetch_table('unemployment_final')
Unemployment$Date <<- as.Date(Unemployment$Date)
Unemployment <<- data.table(Unemployment)
Income <<- fetch_table('income_final')
Income <<- data.table(Income)
Age <- fetch_table('age_final')
Age <- data.frame(lapply(Age, function(x) {gsub('\x96', '-', x)}))
Age <- data.table(Age)
Age$Number <- as.numeric(Age$Number)
age_order <- c("0-4","5–9","10–14","15–19","20–24","25–29","30–34","35–39","40–44",
              "45–49","50–54","55–59","60–64","65–69","70–74","75–79","80–84","85+")
levels(Age$Age) <- age_order
Age[, age_group := as.integer(Age)]
setkey(Age, Name, Age)
Age[, median_group := weightedMedian(x=age_group, w=Number, ties='min'), by='Name']
Age[, median_age := levels(Age)[median_group]]





###################################################################################################

shinyServer(function(input, output, session) {
  
  # menu buttons
  observeEvent(input$singleButton, {
    updateTabItems(session, 'tabs', 'single')
  })
  observeEvent(input$compareButton, {
    updateTabItems(session, 'tabs', 'compare')
  })
  
  # get URL variable
  observe({
    query <<- parseQueryString(session$clientData$url_search)
    if(length(query)!=0){
      url_industry <<- query[[1]]
      Industry <<- fetch_table('industry_final', industry=url_industry)
      Industry <<- data.table(Industry)
    }
    updateActionButton(session, 'industryHeader',
                       label = url_industry,
                       icon = icon('suitcase'))
  })
  
  ################################ map tab
  output$map <-renderLeaflet({
    
    shape <- readOGR(dsn = ".", layer = "SA2_2016_VIC_SC", verbose = FALSE)
    colnames(shape@data)[1] <- c("Name")
    mapData <- Industry[Industry == url_industry]
    mapData <- mapData[, .(average = mean(No_businesses, na.rm=TRUE)), by = Name]
    mapData[is.na(mapData)] <- 0
    shape@data <- suppressWarnings(left_join(shape@data, mapData, by="Name"))
    
    labels <- sprintf(paste(mapData$Name,"<br/>Avg Number of Businesses in",url_industry, ":",mapData$average)) %>% 
      lapply(htmltools::HTML)
    
    pal <- colorNumeric("Blues", NULL)
    a <- leaflet(data = shape) %>% 
      addProviderTiles(providers$CartoDB.PositronNoLabels) %>%
      addPolygons(fillColor = ~pal(average), layerId=shape@data$Name,
                  fillOpacity = 0.8,
                  color = "#53869B",
                  weight = 1,
                  popup = labels,
                  label = labels,
                  labelOptions = labelOptions(
                    style = list("font-weight" = "normal", padding = "3px 8px"),
                    textsize = "15px",
                    direction = "auto"),
                  highlight = highlightOptions(weight = 5,
                                               color = "white",
                                               bringToFront = TRUE)) %>%
      addLegend('topright', pal = pal, values = ~average, title = 'Avg. number of <br>businesses <br>(2012-2016)') %>%
      setView(145, -36.5, zoom = 7)
    a
  })
  
  # drill down from map
  observeEvent(input$map_shape_click, {
    updateTabItems(session,"tabs", "single_result")
    updateActionButton(session, 'back', label ='Go Back', icon = icon('left-arrow'))
  })
  
  ############################################ single result tab
  observeEvent(input$map_shape_click,{
    map_suburb <- input$map_shape_click$id
    
    Rent <<- fetch_table('rent_final', suburb=map_suburb)
    Rent$Date <<- as.Date(Rent$Date)
    Rent$Price[Rent$Price == 0] <<- NA
    Rent <<- data.table(Rent)
    
    
  
    # value boxes
    output$noBusinesses2016 <- renderValueBox({
      number <- Industry[Year == 2016 & Industry == url_industry & Name == map_suburb, No_businesses]
      valueBox(number, paste(input$industry, paste('Businesses in', url_industry)), icon = icon('briefcase'), color = 'light-blue')
    })
    
    output$unemploymentRate2017 <- renderValueBox({
      rate <- Unemployment[Date == max(Date) & Name == map_suburb, Unemployment_rate]
      valueBox(paste0(rate, '%'), 'Unemployment rate', icon = icon('user-times'), color = 'light-blue')
    })
    
    output$rentPrice <- renderValueBox({
      valid <-Rent[Name == map_suburb & Type == input$type & Price != 'NA', .(Date, Price)]
      price <- valid[Date == max(Date), Price]
      price <- round(price,0)
      date <- valid[Date == max(Date), Date]
      if(nrow(na.omit(Rent[Name == map_suburb & Type == input$type,])) < 12){
        price <- '-'
      }
      valueBox(paste(paste0('$', price), 'p/w'), paste('Median rent - ',input$type), icon = icon('home'), color = 'light-blue')
    })
  
    output$popInfo <- renderValueBox({
      pop <- Age[Name == map_suburb, sum(Number)]
      valueBox(pop, 'Population', icon = icon('group'), color = 'light-blue')
    })
    
    output$medianAge <- renderValueBox({
      valueBox(Age[Name == map_suburb, median_age], 'Median age group', icon = icon('birthday-cake'), color = 'light-blue')
    })
  
    output$income <- renderValueBox({
      income <- Income[Name == map_suburb, Median_income]
      valueBox(paste0('$', income), 'Median Income', icon = icon('money'), color = 'light-blue')
    })
    
    # overview text
    output$overviewText <- renderInfoBox({
      start <- Industry[Year == 2012 & Industry == url_industry & Name == map_suburb, No_businesses]
      end <- Industry[Year == 2016 & Industry == url_industry & Name == map_suburb, No_businesses]
      growth <- round(((end - start)/start) * 100, 1)
      regional <- Industry[Industry == url_industry, .(regional_avg = mean(No_businesses, na.rm = TRUE)), by = Year]
      reg_start <- regional[Year == 2012, regional_avg]
      reg_end <- regional[Year == 2016, regional_avg]
      reg_growth <- round(((reg_end - reg_start)/reg_start) * 100, 1)
      infoBox(h3(map_suburb, style = 'font-weight: bold;'),
              p('An analysis of the data shows an overall', if(growth < 0) {print('negative')}, 'growth rate of', paste0(growth, '%'),
                'in the number of businesses in the',url_industry, 'industry from 2012 - 2016.', br(), br(),
                'This was in contrast to all of regional Victora which showed a net', paste0(reg_growth, '%'),
                if(reg_growth > 0) {print('increase')} else {print('decrease')}, 'over the same period.', br(), br(),
                'On average, unemployment rates in', map_suburb, 'were',
                if(Unemployment[Name == map_suburb, .(avg_rate = mean(Unemployment_rate))] <
                   Unemployment[, .(avg_rate = mean(Unemployment_rate))]) {print('lower')}
                else(print('higher')), 'than regional Victoria by a margin of',
                paste0(abs(round(Unemployment[Name == map_suburb, .(avg_rate = mean(Unemployment_rate))] -
                   Unemployment[, .(avg_rate = mean(Unemployment_rate))], 2)), '%.'), br(), br(),
                'Click on the "Rent" tab to show rent for different dwelling types.',
                style='line-height: 1.3; font-weight: normal;'), fill = TRUE, color = 'light-blue', icon = icon('map-marker'))
      })
    
    # overview tabBox
    output$industryTimeSeries <- renderDygraph({
      suburb <- Industry[Name == map_suburb & Industry == url_industry, ][, c(2, 4)]
      regional <- Industry[Industry == url_industry, .(regional_avg = mean(No_businesses, na.rm = TRUE)), by = Year][,2]
      data <- cbind(suburb, regional)
      data$No_businesses = as.numeric(data$No_businesses)
      dygraph(data) %>%
        dyAxis('x', drawGrid = FALSE, label = 'Year', pixelsPerLabel = 90) %>%
        dyAxis('y', label = 'Number of businesses') %>%
        dySeries('No_businesses', color = 'royalblue', label = map_suburb) %>%
        dySeries('regional_avg', color = 'orangered', label = 'Regional Victoria') %>%
        dyLegend(width = 450) %>%
        dyOptions(includeZero = TRUE, gridLineColor = "lightblue", fillGraph=TRUE)
    })
    
    output$unemploymentTimeSeries <- renderDygraph({
      suburb <- Unemployment[Name == map_suburb,][, 2:3]
      regional <- Unemployment[, .(regional_avg = mean(Unemployment_rate)), by = Date][, 2]
      data <- cbind(suburb, regional)
      dygraph(data) %>%
        dyAxis('x', drawGrid = FALSE, label = 'Year') %>%
        dyAxis('y', label = 'Unemployment Rate (%)') %>%
        dySeries('Unemployment_rate', color = 'royalblue', label = map_suburb) %>%
        dySeries('regional_avg', color = 'orangered', label = 'Regional Victoria') %>%
        dyLegend(width = 450) %>%
        dyOptions(includeZero = TRUE, gridLineColor = 'lightblue', fillGraph = TRUE)
    })
    
    output$rentTimeSeries <- renderDygraph({
      req(input$type)
      validate(
        need(nrow(na.omit(Rent[Name == map_suburb & Type == input$type,])) > 12,
              message = paste('No data available for', input$type, '.',
                               '\nPlease choose another dwelling type. '))
      )
      suburb <- na.omit(Rent[Name == map_suburb & Type == input$type, ][, c(3, 4)])
      valid <- suburb$Date
      #average <- Rent[Type == input$type & Date %in% valid, .(regional_avg = round(mean(Price, na.rm = TRUE), 1)), by = Date][,2]
      average <- Regional_rent[Type == input$type & Date %in% valid,][,3]
      data <- cbind(suburb, average)
      dygraph(data) %>%
        dyAxis('x', drawGrid = FALSE, label = 'Year') %>%
        dyAxis('y', label = 'Median weekly rent ($)') %>%
        dySeries('Price', color = 'royalblue', label = map_suburb) %>% # rgb(0, 0, 139)
        dySeries('regional_avg', color = 'orangered', label = 'Regional Victoria') %>%
        dyLegend(width = 450) %>%
        dyOptions(includeZero = TRUE, gridLineColor = 'lightblue', fillGraph = TRUE) # rgb(0, 100, 0)
    })
    
    output$popOverviewBar <- renderAmCharts({
      data <- Age[Name == map_suburb,]
      amBarplot(x = 'Age', y = 'Number', data = data, groups_color = '#53869B',
                xlab = 'Age group', ylab = 'Number of people', labelRotation = 45)
    })
  })
  
  # go back button
  observeEvent(input$back,{
    updateTabItems(session, "tabs", "single")
    updateActionButton(session, 'back', label = '', icon=NULL)
  })
  
  ################################################ compare tab
  observeEvent(input$suburb1,{
    output$industryComparison <- renderDygraph({
      suburb1 <- Industry[Name == input$suburb1[1] & Industry == url_industry, ][, c(2, 4)]
      suburb2 <- Industry[Name == input$suburb1[2] & Industry == url_industry, ][, 4]
      data <- cbind(suburb1, suburb2)
      colnames(data)[2] <- input$suburb1[1]
      colnames(data)[3] <- input$suburb1[2]
      dygraph(data) %>% 
        dyAxis('x', drawGrid = FALSE, label = 'Year') %>%
        dyAxis('y', label = 'Number of businesses') %>%
        dySeries(input$suburb1[1], color = 'rgb(0, 0, 139)', label = input$suburb1[1]) %>%
        dySeries(input$suburb1[2], color = 'rgb(0, 100, 0)', label = input$suburb1[2]) %>%
        dyLegend(width = 450) %>%
        dyOptions(includeZero = TRUE, gridLineColor = "lightblue")
    })
    
    output$unemploymentComparison <- renderDygraph({
      suburb1 <- Unemployment[Name == input$suburb1[1],][, c(2,3)]
      suburb2 <- Unemployment[Name == input$suburb1[2],][, 3]
      data <- cbind(suburb1, suburb2)
      colnames(data)[2] <- input$suburb1[1]
      colnames(data)[3] <- input$suburb1[2]
      dygraph(data) %>% 
        dyAxis('x', drawGrid = FALSE, label = 'Year') %>%
        dyAxis('y', label = 'Unemployment Rate') %>%
        dySeries(input$suburb1[1], color = 'rgb(0, 0, 139)', label = input$suburb1[1]) %>%
        dySeries(input$suburb1[2], color = 'rgb(0, 100, 0)', label = input$suburb1[2]) %>%
        dyLegend(width = 450) %>%
        dyOptions(includeZero = TRUE, gridLineColor = "lightblue")
    })
    
    output$rentComparison <- renderDygraph({
      suburb1 <- Rent[Name == input$suburb1[1] & Type == input$typeCompare,][, c(3, 4)]
      suburb2 <- Rent[Name == input$suburb1[2] & Type == input$typeCompare,][, 4]
      data <- cbind(suburb1, suburb2)
      colnames(data)[2] <- input$suburb1[1]
      colnames(data)[3] <- input$suburb1[2]
      dygraph(data) %>%
        dyAxis('x', drawGrid = FALSE, label = 'Year') %>%
        dyAxis('y', label = 'Price ($)') %>%
        dySeries(input$suburb1[1], color = 'rgb(0, 0, 139)', label = input$suburb1[1]) %>%
        dySeries(input$suburb1[2], color = 'rgb(0, 100, 0)', label = input$suburb1[2]) %>%
        dyLegend(width = 450) %>%
        dyOptions(includeZero = TRUE, gridLineColor = "lightblue")
    })
  })
  
  
    
  # Overview tab
  # observeEvent(c(input$industry, input$suburb, input$suburb1, input$type, input$choice, input$typeCompare),{
  #   
  #   output$popOverviewBar <- renderAmCharts({
  #     data <- Age[Name == input$suburb,]
  #     amBarplot(x = 'Age', y = 'Number', data = data, groups_color = '#53869B',
  #               xlab = 'Age group', ylab = 'Number of people', labelRotation = 45)
  #   })       
  #                  
  #   output$noBusinesses2016 <- renderValueBox({
  #     number <- Industry[Year == 2016 & Industry == input$industry & Name == input$suburb, No_businesses]
  #     valueBox(number, paste(input$industry, 'businesses'), icon = icon('briefcase'), color = 'light-blue')
  #   })
  #   
  #   output$income <- renderValueBox({
  #     income <- Income[Name == input$suburb, Median_income]
  #     valueBox(paste0('$', income), 'Median Income', icon = icon('money'), color = 'light-blue')
  #   })
  #   
  #   output$rentPrice <- renderValueBox({
  #     valid <-Rent[Name == input$suburb & Type == input$type & Price != 'NA', .(Date, Price)]
  #     price <- valid[Date == max(Date), Price]
  #     date <- valid[Date == max(Date), Date]
  #     valueBox(paste('$', round(price,2), 'p/w'), paste('Median rent - ',input$type), icon = icon('home'), color = 'light-blue')
  #   })
  #   
  #   output$medianAge <- renderValueBox({
  #     Age[, Age := factor(Age, levels = age_order)]
  #     Age[, age_group := as.integer(Age)]
  #     setkey(Age, Name, Age)
  #     Age[, median_group := weightedMedian(x=age_group, w=Number, ties='min'), by='Name']
  #     Age[, median_age := levels(Age)[median_group]]
  #     valueBox(Age[Name == input$suburb, median_age], 'Median age group', icon = icon('birthday-cake'), color = 'light-blue')
  #   })
  #   
  #   output$unemploymentRate2017 <- renderValueBox({
  #     rate <- Unemployment[Date == max(Date) & Name == input$suburb, Unemployment_rate]
  #     valueBox(paste0(rate, '%'), 'Unemployment rate', icon = icon('user-times'), color = 'light-blue')
  #   })
  #   
  #   output$popInfo <- renderValueBox({
  #     pop <- Age[Name == input$suburb, sum(Number)]
  #     valueBox(pop, 'Population', icon = icon('group'), color = 'light-blue')
  #   })
  #   
  #   output$overviewText <- renderInfoBox({
  #     start <- Industry[Year == 2012 & Industry == input$industry & Name == input$suburb, No_businesses]
  #     end <- Industry[Year == 2016 & Industry == input$industry & Name == input$suburb, No_businesses]
  #     growth <- round(((end - start)/start) * 100, 1)
  #     regional <- Industry[Industry == input$industry, .(regional_avg = mean(No_businesses, na.rm = TRUE)), by = Year]
  #     reg_start <- regional[Year == 2012, regional_avg]
  #     reg_end <- regional[Year == 2016, regional_avg]
  #     reg_growth <- round(((reg_end - reg_start)/reg_start) * 100, 1)
  #     infoBox(h3(input$suburb, style = 'font-weight: bold;'),
  #             p('An analysis of the data shows an overall', if(growth < 0) {print('negative')}, 'growth rate of', paste0(growth, '%'), 
  #               'in the number of businesses in the',input$industry, 'industry from 2012 - 2016.', br(), br(),
  #               'This was in contrast to all of regional Victora which showed a net', paste0(reg_growth, '%'), 
  #               if(reg_growth > 0) {print('increase')} else {print('decrease')}, 'over the same period.', br(), br(),
  #               'On average, unemployment rates in', input$suburb, 'were', 
  #               if(Unemployment[Name == input$suburb, .(avg_rate = mean(Unemployment_rate))] <
  #                  Unemployment[, .(avg_rate = mean(Unemployment_rate))]) {print('lower')}
  #               else(print('higher')), 'than regional Victoria by a margin of',
  #               paste0(abs(round(Unemployment[Name == input$suburb, .(avg_rate = mean(Unemployment_rate))] -
  #                  Unemployment[, .(avg_rate = mean(Unemployment_rate))], 1)), '%.'), br(), br(),
  #               'Click on the "Rent" tab to show rent for different dwelling types.',
  #               style='line-height: 1.3; font-weight: normal;'), fill = TRUE, color = 'light-blue', icon = icon('info-circle'))
  #   })
  #   
  #   output$industryTimeSeries <- renderDygraph({
  #     suburb <- Industry[Name == input$suburb & Industry == input$industry, ][, c(2, 4)]
  #     regional <- Industry[Industry == input$industry, .(regional_avg = mean(No_businesses, na.rm = TRUE)), by = Year][,2]
  #     data <- cbind(suburb, regional)
  #     dygraph(data) %>% 
  #       dyAxis('x', drawGrid = FALSE, label = 'Year') %>%
  #       dyAxis('y', label = 'Number of businesses') %>%
  #       dySeries('No_businesses', color = 'rgb(0, 0, 139)', label = input$suburb) %>%
  #       dySeries('regional_avg', color = 'rgb(0, 100, 0)', label = 'Regional Victoria') %>%
  #       dyLegend(width = 450) %>%
  #       dyOptions(includeZero = TRUE, gridLineColor = "lightblue")
  #   })
  #   
  #   output$unemploymentTimeSeries <- renderDygraph({
  #     suburb <- Unemployment[Name == input$suburb,][, 2:3]
  #     regional <- Unemployment[, .(regional_avg = mean(Unemployment_rate)), by = Date][, 2]
  #     data <- cbind(suburb, regional)
  #     dygraph(data) %>% 
  #       dyAxis('x', drawGrid = FALSE, label = 'Year') %>%
  #       dyAxis('y', label = 'Unemployment Rate (%)') %>%
  #       dySeries('Unemployment_rate', color = 'rgb(0, 0, 139)', label = input$suburb) %>%
  #       dySeries('regional_avg', color = 'rgb(0, 100, 0)', label = 'Regional Victoria') %>%
  #       dyLegend(width = 450) %>%
  #       dyOptions(includeZero = TRUE, gridLineColor = 'lightblue')
  #   })
  #   
  #   output$rentTimeSeries <- renderDygraph({
  #     req(input$type)
  #     validate(
  #       need(nrow(na.omit(Rent[Name == input$suburb & Type == input$type,])) > 12,
  #            message = paste('No data available for', input$type, '.',
  #                            '\nPlease choose another dwelling type. '))
  #     )
  #     suburb <- na.omit(Rent[Name == input$suburb & Type == input$type, ][, c(3, 4)])
  #     valid <- suburb$Date
  #     average <- Rent[Type == input$type & Date %in% valid, .(regional_avg = round(mean(Price, na.rm = TRUE), 1)), by = Date][,2]
  #     data <- cbind(suburb, average)
  #     dygraph(data) %>%
  #       dyAxis('x', drawGrid = FALSE, label = 'Year') %>%
  #       dyAxis('y', label = 'Median weekly rent ($)') %>%
  #       dySeries('Price', color = 'rgb(0, 0, 139)', label = input$suburb) %>%
  #       dySeries('regional_avg', color = 'rgb(0, 100, 0)', label = 'Regional Victoria') %>%
  #       dyLegend(width = 450) %>%
  #       dyOptions(includeZero = TRUE, gridLineColor = 'lightblue')
  #   })
  #   
  #   ###################################################################################################
  #   # Suburb vs Suburb
  #   ###################################################################################################
  #   
  #   output$industryComparison <- renderDygraph({
  #     suburb1 <- Industry[Name == input$suburb1[1] & Industry == input$industry, ][, c(2, 4)]
  #     suburb2 <- Industry[Name == input$suburb1[2] & Industry == input$industry, ][, 4]
  #     data <- cbind(suburb1, suburb2)
  #     colnames(data)[2] <- input$suburb1[1]
  #     colnames(data)[3] <- input$suburb1[2]
  #     dygraph(data) %>% 
  #       dyAxis('x', drawGrid = FALSE, label = 'Year') %>%
  #       dyAxis('y', label = 'Number of businesses') %>%
  #       dySeries(input$suburb1[1], color = 'rgb(0, 0, 139)', label = input$suburb1[1]) %>%
  #       dySeries(input$suburb1[2], color = 'rgb(0, 100, 0)', label = input$suburb1[2]) %>%
  #       dyLegend(width = 450) %>%
  #       dyOptions(includeZero = TRUE, gridLineColor = "lightblue")
  #   })
  #   
  #   output$unemploymentComparison <- renderDygraph({
  #     suburb1 <- Unemployment[Name == input$suburb1[1],][, c(2,3)]
  #     suburb2 <- Unemployment[Name == input$suburb1[2],][, 3]
  #     data <- cbind(suburb1, suburb2)
  #     colnames(data)[2] <- input$suburb1[1]
  #     colnames(data)[3] <- input$suburb1[2]
  #     dygraph(data) %>% 
  #       dyAxis('x', drawGrid = FALSE, label = 'Year') %>%
  #       dyAxis('y', label = 'Unemployment Rate') %>%
  #       dySeries(input$suburb1[1], color = 'rgb(0, 0, 139)', label = input$suburb1[1]) %>%
  #       dySeries(input$suburb1[2], color = 'rgb(0, 100, 0)', label = input$suburb1[2]) %>%
  #       dyLegend(width = 450) %>%
  #       dyOptions(includeZero = TRUE, gridLineColor = "lightblue")
  #   })
  #   
  #   output$rentComparison <- renderDygraph({
  #     validate(
  #       need(nrow(na.omit(Rent[(Name == input$suburb1[1] | Name == input$suburb1[2]) & Type == input$typeCompare,])) > 12,
  #            message = paste('No data available for', input$typeCompare, '.',
  #                            '\nPlease choose another dwelling type. '))
  #     )
  #     suburb1 <- Rent[Name == input$suburb1[1] & Type == input$typeCompare,][, c(3, 4)]
  #     suburb2 <- Rent[Name == input$suburb1[2] & Type == input$typeCompare,][, 4]
  #     data <- cbind(suburb1, suburb2)
  #     colnames(data)[2] <- input$suburb1[1]
  #     colnames(data)[3] <- input$suburb1[2]
  #     dygraph(data) %>%
  #       dyAxis('x', drawGrid = FALSE, label = 'Year') %>%
  #       dyAxis('y', label = 'Price ($)') %>%
  #       dySeries(input$suburb1[1], color = 'rgb(0, 0, 139)', label = input$suburb1[1]) %>%
  #       dySeries(input$suburb1[2], color = 'rgb(0, 100, 0)', label = input$suburb1[2]) %>%
  #       dyLegend(width = 450) %>%
  #       dyOptions(includeZero = TRUE, gridLineColor = "lightblue")
  #   })
  #   
  # })
  # 
  # # Industry tab
  # observeEvent(c(input$suburb, input$industry, input$choice), {
  #   
  #   output$growthRate <- renderValueBox({
  #     start <- Industry[Year == 2012 & Industry == input$industry & Name == input$suburb, No_businesses]
  #     end <- Industry[Year == 2016 & Industry == input$industry & Name == input$suburb, No_businesses]
  #     growth <- round(((end - start)/start) * 100, 1)
  #     valueBox(paste0(growth, '%'), 'Overall growth rate 2012-2016', icon = icon('percent'))
  #   })
  #   
  #   output$industryRank <- renderValueBox({
  #     rank <- which(Industry[Year == 2016 & Industry == input$industry,][order(-No_businesses), Name == input$suburb])
  #     valueBox(
  #       rank, 'Overall rank in 2016', icon = icon('trophy')
  #     )
  #   })
  # })
  # 
  # # Rent Tab
  # observeEvent(c(input$suburb, input$type),{
  #   #req(input$type)
  #   
  #   output$rentGrowthRate <- renderValueBox({
  #     start <- Rent[Name == input$suburb & Type == input$type & Date %in% (tail(Date,4) - years(5)), .(median_rent = round(median(Price, na.rm = TRUE), 1))]
  #     end <- Rent[Name == input$suburb & Type == input$type & Date %in% tail(Date,4), .(median_rent = round(median(Price, na.rm = TRUE), 1))]
  #     growth <- round((((end/start)^(1/5)) - 1) * 100, 1)
  #     valueBox(paste(growth, '%'), 'Annual growth rate (2012-2017)', icon = icon('bar-chart'), color = 'light-blue')
  #   })
  #   
  #   output$rentText <- renderInfoBox({
  #     infoBox(p('Hi', style='line-height: 1.3; font-weight: normal;'), fill = TRUE, color = 'light-blue', icon = icon('info-circle'))
  #   })
  #   
  #   # Unemployment tab
  #   
  #   output$unemploymentGrowthRate <- renderValueBox({
  #     start <- Unemployment[Date == min(Date) & Name == input$suburb, Unemployment_rate]
  #     end <- Unemployment[Date == max(Date) & Name == input$suburb, Unemployment_rate]
  #     rate <- round(((end - start)/start) * 100, 1)
  #     valueBox(paste(rate,'%'), 'Overall unemployment percent change', icon = icon('percent'))
  #   })
  #   
  #   output$unemploymentRank <- renderValueBox({
  #     rank <- which(Unemployment[Date == max(Date),][order(Unemployment_rate), Name == input$suburb])
  #     valueBox(rank, 'Overall rank in Dec 2017', icon = icon('trophy'))
  #   })
  # })
  # 
})