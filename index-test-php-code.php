<?php 
    $apple = 5;
    // echo $apple;
    $str ="Hello World"; 
    
    //switch
    $day=1;

    switch($day){
        case 1: echo "Monday";
        break;
        case 2: echo "Tuesday";
        break;
        case 3: echo "Wednesday";
        break;
        default: echo "No Date";
    }
   echo "<br/>";

   //if
    if($day==1){
        echo "Monday from if statement";
    }else if($day==2){
        echo "Tuesday from if statement";
    }else{
        echo "No date";
    }
    echo "<br/>";

    //array
    $fruits = ["apple","orange","grapes"];
    
    echo "<pre>";
    var_dump($fruits);
    echo"</pre>";
    
    //associated array
    $person =[
       [ 
        "name"=>"mg mg",
        "age"=> "30"
       ],
       [ 
        "name"=>"bo bo",
        "age"=> "30"
       ],

    ];

    echo "<pre>";
    var_dump($person);
    echo"</pre>";

        

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

   <!-- for loop -->
    <ul>
        <?php 
            for($i=0; $i<count($fruits); $i++){
                echo "<li>".$fruits[$i]."</li>";
            }
        ?>
    </ul>
    <br>

    <!-- while loop -->
    <div>
        <?php 
            $i=0;
            while($i<count($fruits)){
                echo $fruits[$i];
                $i++;
            }                    
        ?>
    </div>  

    <br>
   

  <!-- foreach loop -->
    <div>
    
        <?php 
            foreach($fruits as $f){
                echo $f;
            }        
        ?>

       <br>
       <br>
  
        <?php
            foreach($person as $p){
                echo $p["name"];
                echo $p["age"];
            }
        ?>

        <br>

        <?php foreach($person as $p): ?>
            <h3><?=$p['name']?></h3> 
            <p><?=$p['age']?></p>           
        <?php endforeach;?>

    </div> 
    
    

   <!-- <h1><?= $str; ?></h1>
   <?php echo "<h1>" . $str . "</h1>" ?> -->

   <!-- <?php echo $apple; echo $str; ?> -->

</body>
</html>