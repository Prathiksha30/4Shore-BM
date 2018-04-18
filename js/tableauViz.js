var workbook, viz;
//initial visualisations, link to tableau dashboard and then call when page loads
function initViz() {
  var containerDiv = document.getElementById("vizContainer"),
  url = "https://public.tableau.com/views/19_04_2018/Dashboard1?:embed=y&:display_count=yes&publish=yes",
  options = {
    hideTabs: true,
    onFirstInteractive: function () {
      console.log("Run this code when the viz has finished loading.");
      workbook = viz.getWorkbook();
      activeSheet = workbook.getActiveSheet();
    }
  };

  viz = new tableau.Viz(containerDiv, url, options); 
            // Create a viz object and embed it in the container div.         
}
function initViz2() {
  var containerDiv = document.getElementById("vizContainer2"),
  url = "http://public.tableau.com/views/Dashboard_1022/Dashboard1",
  options = {
    hideTabs: true,
    onFirstInteractive: function () {
      console.log("Run this code when the viz has finished loading.");
      workbook = viz.getWorkbook();
      activeSheet = workbook.getActiveSheet();
    }
  };

  viz = new tableau.Viz(containerDiv, url, options); 
            // Create a viz object and embed it in the container div.         
}
//function to switch between dashboard sheets
function switchToMapTab() {
  workbook.activateSheetAsync("Sheet 1");
    console.log("Function test");
}
function getSheetsAlertText(sheets) {
    var alertText = [];
    for (var i = 0, len = sheets.length; i < len; i++) {
        var sheet = sheets[i];
        alertText.push("  Sheet " + i);
        alertText.push(" (" + sheet.getSheetType() + ")");
        alertText.push(" - " + sheet.getName());
        alertText.push("\n");
    }
    return alertText.join("");
}
function querySheets() {
    var sheets = workbook.getPublishedSheetsInfo();
    var text = getSheetsAlertText(sheets);
    text = "Sheets in the workbook:\n" + text;
    alert(text);
}
//event listener for pop-ups
function listenToMarksSelection() {
    viz.addEventListener(tableau.TableauEventName.MARKS_SELECTION, onMarksSelection);
}
function onMarksSelection(marksEvent) {
    return marksEvent.getMarksAsync().then(reportSelectedMarks);
}
function reportSelectedMarks(marks) {
    var html = [];
    for (var markIndex = 0; markIndex < marks.length; markIndex++) {
        var pairs = marks[markIndex].getPairs();
        html.push("<b>Mark " + markIndex + ":</b><ul>");
        for (var pairIndex = 0; pairIndex < pairs.length; pairIndex++) {
          var pair = pairs[pairIndex];
          html.push("<li><b>fieldName:</b> " + pair.fieldName);
          html.push("<br/><b>formattedValue:</b> " + pair.formattedValue + "</li>");
      html.push("View below!");
        }
    }
    var dialog = $("#dialog");
    dialog.html(html.join(""));
    dialog.dialog("open");
}
function removeMarksSelectionEventListener() {
    viz.removeEventListener(tableau.TableauEventName.MARKS_SELECTION, onMarksSelection);
}