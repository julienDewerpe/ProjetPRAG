<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
       
        toString($_boolean);

        if (isset($_POST["role"])){
            if ($_POST["role"] == "Entre'edeur") 
            {  
                $_boolean = false;
                if($_boolean){
                    toString($_boolean);
                }
                
            }
            else 
            {
                $_boolean = false;
                echo $_boolean;
            }
        }
    ?>

</body>
</html>