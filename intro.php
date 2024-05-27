
<h1>Loops</h1>

<h4>While Loops</h4>
<?php
$init = 0;
while($init<10){
print $init. "<br>";
$init++;
}
?>

<h4>Do - While Loops</h4>

<?php
$i=0;
do{
   print $i ."<br>";
   $i++;
}while($i<16)
?>

<h4>For Loops</h4>

<?php
for ($s=45;$s<55;$s+=2){
    print $s."<br>";
    
}
?>

<h4>Foreach</h4>

<?php
$months = ["January","February","March","April","May","June","July","August","September","October","November","December"];

foreach($months AS $month){
    print $month."<br>";
}
?>

<form action="">
    <select name="" id="">
        <option value="">--Months--</option>
        <?php
         print $month."<br>";
        foreach($months AS $month){
            
            echo "<option value=''>$month</option>";
            }
?>
    </select>
</form>

<form action="">
    <select name="" id="">
        <option value="">--Years--</option>
        <?php
$init = 2015;
while($init<2030){
print "<option value=''>$init</option>";
$init++;
}
?>
    </select>
</form>