 <?php
        $backgroundImage = "img/sea.jpg";
        include 'api/pixabayAPI.php';
        //API call goes here
        if(!empty($_GET['keyword'])){
            //print_r($_GET['keyword']);
            $imageURLs = getImageURLs($_GET['keyword'],$_GET[layout]);
            $backgroundImage = $imageURLs[array_rand($imageURLs)];
            
        }
        elseif(isset($_GET['category'])){
        
            $imageURLs = getImageURLs($_GET['category'],$_GET[layout]);
            $backgroundImage = $imageURLs[array_rand($imageURLs)];
        
        }
        ?>

<!DOCTYPE html>
<html>
    
    <head>
  
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
    <title> Image Carousel</title>
       
       
       <style> 
        @import url("css/styles.css");
        body {
            background-image: url('<?=$backgroundImage ?>');
            background-size: 100% 100%;
            background-attachment: fixed;
        }
        </style>
    
    </head>
        
   
   <body>
       <form>
        <input type="text" name="keyword" placeholder="Keyword">
        
        <div id="layoutDiv">
            <input type="radio" name="layout" value="horizontal" id="layout_h"/>
            <label for="layout_h"> Horizontal</label>
            <br/>
            <input type="radio" name="layout" value="vertical" id="layout_v" />
            <label for="layout_v"> Vertical</label><br/>
         </div>   
            <br/>
            <select name="category" style="color:black; font-size:1.5em">
                <option value=""> -Select One </option>
                <option value="Ocean" > Sea </option>
                <option value="Tea" > Tea </option>
                <option value="Chocolate" > Chocolate </option>
                <option value="Music" > Music </option>
                <option value="Red" > Red </option>
            </select> </br> </br>
            
         <input type="submit" value="Submit" />   
         </form>  
       
    <br/> <br/>
        <?php
        if(!isset($imageURLs)){
            echo "<h2> Type a Keyword to display a slideshow <br/> with random images from Pixabay.com </h2>";
            }elseif (empty($_GET['keyword'])&&empty($_GET['category'])) {
                //print_r("hello");
                echo "<h2> You need to select something. </h2>";
                
            
        } else{
            //DIsplay Carousel here
            for($i = 0; $i < 7; $i++){
                do{
                    $randomIndex = rand(0, count($imageURLs));
                }
                while (!isset($imageURLs[$randomIndex]));
                
            
                //echo "<img src= '" . $imageURLs[$randomIndex] . "' width = '200' >";
                unset($imageURLs[$randomIndex]);
            }
        
       
        ?>
     
  
    
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"> 
    
    <!-- Indicators here -->
    <ol class="carousel-indicators">
         <?php
         for($i = 0; $i < 7; $i++){
             echo "<li data-target='#carousel-example-generic' data-slide-to='$i'";
             echo($i == 0)?" class='active'": "";
             echo "></li>";
         }
         ?>
         
    </ol>
          
   
     <!-- Wrapper for Images -->
     
     <div class="carousel-inner" role="listbox">
         <?php
         for($i=0; $i<7; $i++){
            do{
                $randomIndex = rand(0, count($imageURLs));
                }
                while (!isset($imageURLs[$randomIndex]));
                
                echo '<div class="item ';
                echo ($i == 0)?"active": "";
                echo '">';
                echo '<img src="' . $imageURLs[$randomIndex] . '">';
                echo '</div>';
                unset($imageURLs[$randomIndex]);
             
         }
        
        ?>
    </div>
    <!--Controls Here -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>  
      <span class="sr-only">Next</span>
    </a>
    
    </div>
    
    
    <?php
        }
        
        ?>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>