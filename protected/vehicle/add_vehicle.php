<?php if(!IsUserLoggedIn()) : ?>
    <h1>Page access is forbidden!</h1>
<?php else: ?>

    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addVehicle']))
        {
            $postData = [
                'vehicle_brand' => $_POST['Brand'],
                'vehicle_model' => $_POST['Model'],
                'vehicle_clock' => $_POST['Clock'],
                'vehicle_fuel_type' => $_POST['FuelType']
            ];

            if(empty($postData['vehicle_brand']) || empty($postData['vehicle_model']) || empty($postData['vehicle_clock']) || $postData['vehicle_fuel_type'] < 0 && $postData['vehicle_fuel_type'] > 1) 
            {
                echo "Missing information!";
            }
            else if($postData['vehicle_clock'] < 0)
            {
                echo "Clock cannot be a negative number!";
            }
            else 
            {
                $query = "INSERT INTO vehicle (user_id, vehicle_brand, vehicle_model, vehicle_clock, vehicle_fuel_type) VALUES (?, ?, ?, ?, ?)";
                $params = [
                    $_SESSION['u_id'],
                    $postData['vehicle_brand'],
                    $postData['vehicle_model'],
                    $postData['vehicle_clock'],
                    $postData['vehicle_fuel_type']
                ];
                require_once DATABASE_CONTROLLER;
                if(!executeDML($query, $params))
                {
                    echo "Entered data is not valid!";
                }
                header('Location: index.php?P=listv');
                
            }

        }
    ?>

    <form method="post">
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="vehicleBrand">Brand</label>
            <input type="text" class="form-control" id="vehicleBrand" name="Brand">
        </div>
        <div class="form-group col-md-3">
            <label for="vehicleModel">Model</label>
            <input type="text" class="form-control" id="vehicleModel" name="Model">
        </div>
        <div class="form-group col-md-3">
            <label for="vehicleClock">Clock</label>
            <input type="text" class="form-control" id="vehicleClock" name="Clock">
        </div>
        <div class="form-group col-md-3">
            <label for="vehicleFuelType">Fuel type</label>
            <select class="form-control" id="vehicleFuelType" name="FuelType">
                <option value="0">Gasoline</option>
                <option value="1">Diesel</option>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary" name="addVehicle">Add Vehicle</button>
</form>

<?php endif; ?>