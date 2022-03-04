(function($) {
    $(document).ready(function() {

var inputfield = $('#get_hidden').val();

     var nameArr = inputfield.split(',');

jQuery('.countries-dropdown').val(nameArr);


     jQuery('.countries-dropdown').select2();
     
    

    });   
    

})(jQuery);

(function($) {
    $(document).ready(function() {
var input = $('#get_country').val();

if(input == ''){
 jQuery('.countries-dropdown0').prepend('<option selected=""></option>').select2({placeholder: "Choose nationality"});
 }else{
 jQuery('.countries-dropdown0').select2();
}
    });   
    

})(jQuery);


    function tabsetting(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
    
}

function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
}

function exportTableToCSV(filename) {
    var csv = [];
    var rows = document.querySelectorAll("#export tr");
    
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td:not(.exclude), th:not(.exclude)");
        
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
        csv.push(row.join(","));        
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}

function showactiveTab01(){

var get = loadactiveTab();

if(get == null){
// Get the element with id="defaultOpenq" and click on it
document.getElementById("defaultOpen").click();
}else{
 document.getElementById(get).click();
}
}


$('.tablinks').click(function(){

    var activetab = $(this).attr('id');


     localStorage.setItem('activetab', activetab );
      
       
});

function loadactiveTab(){

  var activetab = localStorage.getItem('activetab');
 

 return activetab;

}


document.addEventListener("DOMContentLoaded", function() {

 showactiveTab01();

});

document.addEventListener("DOMContentLoaded", function() {

 loadactiveTab();

});