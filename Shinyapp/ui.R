#
# This is the user-interface definition of a Shiny web application. You can
# run the application by clicking 'Run App' above.
#
# Find out more about building applications with Shiny here:
# 
#    http://shiny.rstudio.com/
#

library(shiny)
library(shinydashboard)
library(data.table)
library(ggplot2)
library(scales)
library(lubridate)
library(dygraphs)
library(rAmCharts)
library(shinyWidgets)
library(leaflet)
library(rgdal)
library(scales)
library(shinycssloaders)
library(dplyr)
library(matrixStats)
library(RMySQL)

shinyUI(fluidPage(
  
  # HTML/CSS stuff
  tags$head(
    tags$meta(name = 'viewport', content = 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no'),
    tags$style(HTML(".shiny-output-error-validation {color: tomato;
                    font-size: 15px; font-family: Georgia, serif;
                    } 
                    .small-box {height: 120px}"))),
  

dashboardPage(
  dashboardHeader(disable = TRUE),
  dashboardSidebar(width = 180, collapsed = TRUE,
    sidebarMenu(id = 'tabs',
      menuItem(text = 'Explore a suburb', tabName = 'single'),
      menuItem(text= "", tabName="single_result"),
      menuItem(text = 'Compare two suburbs', tabName = 'compare', icon = icon('area-chart'))
      )),
  dashboardBody(
    tags$head(
      tags$style(HTML('.content-wrapper, .right-side {background-color: #ffffff;}'))),
    #actionBttn('industryHeader', style = 'gradient', color = 'primary'),
    # conditionalPanel(
    #   condition='tabName == "single_result"',
    #   actionBttn("back", label = 'Back', icon=NULL, style = 'jelly')
    # ),
    # actionBttn("back", label = '', icon=NULL, style = 'jelly'),
    #actionBttn('singleButton', 'Explore a suburb'),
    #hr(),

    tabItems(
      tabItem(tabName = 'single',
              actionBttn('industryHeader', style = 'gradient', color = 'primary'),
              hr(),
              fluidRow(
                column(width=3,
                       infoBox(h3("Instructions"), width=NULL, icon=icon("info"),
                               color = 'light-blue',
                               p("Click on a suburb for an analysis of the area.", 
                                 style="font-weight: normal;"))
                       ),
                column(width=9,
                       withSpinner(leafletOutput("map", width = "100%", height = 600))
                       )
                )
              ),
      tabItem(tabName = 'single_result',
              actionBttn("back", label = '', icon=NULL, style = 'jelly'),
              hr(),
              fluidRow(
                valueBoxOutput("noBusinesses2016", width=2),
                valueBoxOutput('unemploymentRate2017', width=2),
                valueBoxOutput('rentPrice', width=2),
                valueBoxOutput('popInfo', width=2),
                valueBoxOutput('medianAge', width=2),
                valueBoxOutput('income', width=2)
              ),
              fluidRow(
                column(width=4,
                       infoBoxOutput('overviewText', width=NULL)
                       #actionBttn("back","Go Back", icon=icon("arrow-left"))
                       ),
                column(width=8,
                       tabBox(id="overviewTabBox", width=NULL,
                              tabPanel('Industry', dygraphOutput('industryTimeSeries')),
                              tabPanel('Unemployment', dygraphOutput('unemploymentTimeSeries')),
                              tabPanel('Rent', 
                                       selectInput('type', 'Dwelling type',
                                                   c('1 Bedroom Flat', '2 Bedroom Flat',
                                                     '3 Bedroom Flat', '2 Bedroom House',
                                                     '3 Bedroom House', '4 Bedroom House'),
                                                   selected = '2 Bedroom House'),
                                       dygraphOutput('rentTimeSeries')),
                              tabPanel('Population', amChartsOutput(outputId = 'popOverviewBar'))
                              )
                       )
                )
              
              )
              )
    )
  )
))