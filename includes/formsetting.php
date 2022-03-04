<?php 

function formconfig(){

?>

<div class="tab">
  <button  class="tablinks colora" onclick="tabsetting(event, 'London')" id="defaultOpen">Form settings</button>
  <button class="tablinks color1" onclick="tabsetting(event, 'Paris')" id="secondOpen">Form entries</button>

</div>

<div id="London" class="tabcontent">
 
<div class="container">  

<?php include('settingpage.php'); ?>

    
</div>

</div>


<div id="Paris" class="tabcontent">
 
<div class="container">  


<?php   include('formentries.php'); ?>

</div>

</div>

<?php 

}

?>