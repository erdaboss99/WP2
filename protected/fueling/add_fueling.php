<?php if(!IsUserLoggedIn()) : ?>
    <h1>Page access is forbidden!</h1>
<?php else: ?>
    <?php
        if(array_key_exists('vid', $_GET) && !empty($_GET['vid'])) 
        {
            $query = "SELECT vehicle_id, vehicle_clock FROM vehicle WHERE vehicle_id = ?";    
            $params = [$_GET['vid']];
            require_once DATABASE_CONTROLLER; 
            $v = getRecord($query, $params);

            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addFueling']))
            {
                $postData = [
                    'fuel_quantity' => $_POST['Quantity'],
                    'fuel_cost' => $_POST['Cost'],
                    'fuel_station_name' => $_POST['StationName'],
                    'vehicle_actual_clock' => $_POST['ActualClock']
                ];

                if(empty($postData['fuel_quantity']) || empty($postData['fuel_cost']) || empty($postData['fuel_station_name']) || empty($postData['vehicle_actual_clock'])) 
                {
                    echo "Missing information!";
                }
                else if($postData['fuel_quantity'] < 0)
                {
                    echo "Fuel quantity cannot be a negative number!";
                }
                else if($postData['fuel_cost'] < 0)
                {
                    echo "Fuel cost cannot be a negative number!";
                }
                else if($postData['vehicle_actual_clock'] < $v['vehicle_clock'])
                {
                    echo "Actual clock cannot be less than the clock before trip!";
                }
                else 
                {
                    $query = "INSERT INTO fuel (vehicle_id, fuel_quantity, fuel_cost, fuel_cost_per_liter, fuel_station_name, vehicle_before_trip_clock, vehicle_actual_clock) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $params = [
                        $_GET['vid'],
                        $postData['fuel_quantity'],
                        $postData['fuel_cost'],
                        ($postData['fuel_cost']/$postData['fuel_quantity']),
                        $postData['fuel_station_name'],
                        $v['vehicle_clock'],
                        $postData['vehicle_actual_clock']
                    ];
                    require_once DATABASE_CONTROLLER;
                    if(!executeDML($query, $params))
                    {
                        echo "Entered data is not valid!";
                    }

                    $query = "UPDATE vehicle SET vehicle_clock = ? WHERE vehicle_id = ?";
                    $params = [
                        $postData['vehicle_actual_clock'],
                        $_GET['vid']
                    ];
                    if(!executeDML($query, $params)) 
                    {
                        echo "Entered data is not valid!";
                    }
                    header('Location: index.php?P=listv');
                    
                }

            }
        }
    ?>

    <form method="post">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="fuelQuantity">Quantity in Liters</label>
                <input type="text" class="form-control" id="fuelQuantity" name="Quantity">
            </div>
            <div class="form-group col-md-3">
                <label for="fuelCost">Cost in HUF</label>
                <input type="text" class="form-control" id="fuelCost" name="Cost">
            </div>
            <div class="form-group col-md-3">
                <label for="fuelStationName">Station name</label>
                <input type="text" class="form-control" id="fuelStationName" name="StationName">
            </div>
            <div class="form-group col-md-3">
                <label for="vehicleActualClock">Vehicle actual clock</label>
                <input type="text" class="form-control" id="vehicleActualClock" name="ActualClock">
            </div>
        </div>
        <button type="submit" class="btn btn-primary" name="addFueling">Add Fueling</button>
    </form>

<?php endif; ?>