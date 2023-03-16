<!DOCTYPE html>
<html>
    <body>

        <form action="" method="post">

            <label>Origin:</label> <input type="text" name="o" placeholder="Enter Origin location" required> <br><br>
            <label>Destination:</label> <input type="text" name="d" placeholder="Enter Destination location" required> <br><br>
            <input type="submit" value="Calculate distance & time" name="submit"> <br><br>

        </form>

        <?php
            if(isset($_POST['submit'])){
            $origin = $_POST['o']; $destination = $_POST['d'];
            //https://maps.googleapis.com/maps/api/distancematrix/json?origins=Seattle&destinations=San+Francisco&key=taxi-279315
            $api = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$origin."&destinations=".$destination."&key=AIzaSyCxaM1iuTQAycIeVzX0dJIRPz5cKAP76kg");
            //$api = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$origin."&destinations=".$destination."&key=taxi-279315");
            //echo $origin;
            //echo $destination;
            //echo $api;
            $data = json_decode($api);
            //print_r($data);
        ?>

            <label><b>Distance: </b></label> <span><?php echo ((int)$data->rows[0]->elements[0]->distance->value / 1000).' Km'; ?></span> <br><br>
            <label><b>Travel Time: </b></label> <span><?php echo $data->rows[0]->elements[0]->duration->text; ?></span> 

        <?php } ?>

    </body>
</html>
