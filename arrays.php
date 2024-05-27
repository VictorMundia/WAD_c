<h1>Arrays</h1>


<?php
//indexed or numeric arrays
$fname=["Alex","Peter","James"];

print_r ($fname) ;

echo 'echo';


$colors = array("Black","green","yellow","white","red");
?>

<pre>
  <?php  print_r($colors);?>
</pre>

<?php print $fname[1];?>


<?php
$user = [
    "Fullname" => "Alex Okama",
    "email"=>"AOkama@yahoo.com",
    "phone"=>"+254716145424"
];
?>
<pre>
  <?php  print_r($user);?>
</pre>

<?php
$user_details=[
    "Director"=>array(
    "Fullname" => "Alex Okama",
    "email"=>"AOkama@yahoo.com",
    "phone"=> [ 

    "Mobile"=>"+254716145424",
    "Landline"=>"+254716145424",
    ]
    ),

    "Manager"=>array(
        "Fullname" => "Alex Okama",
        "email"=>"AOkama@yahoo.com",
        "phone"=> [ 
    
        "Mobile"=>"+254716145424",
        "Landline"=>"+254716145424",
        ]
        ),

        "Secretary"=>array(
            "Fullname" => "Alex Okama",
            "email"=>"AOkama@yahoo.com",
            "phone"=> [ 
        
            "Mobile"=>"+254716145424",
            "Landline"=>"+254716145424",
            ]
            )
            ];
            print $user_details["Secretary"]["phone"]["Mobile"];
?>
<pre>
    <?php
    print_r ($user_details);
    ?>
</pre>

<?php
$item=["book","pen",465,45.5,"File54"];
?>

<pre>
    <?php
    var_dump($item);
    ?>
</pre>

<?php
$age = [45,42,23];
$user_age= array_combine($fname,$age);
$user_data= array_merge($fname,$age);

?>

<pre>
    <?php
    
    var_dump($user_data);
    ?>
</pre>