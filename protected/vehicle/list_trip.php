<?php if(!IsUserLoggedIn()) : ?>
    <h1>Page access is forbidden!</h1>
<?php else: ?>
    <?php if(array_key_exists('vid', $_GET) && !empty($_GET['vid'])) : ?>
        <?php
            $query = "SELECT vehicle_id, vehicle_brand, vehicle_model, vehicle_clock, vehicle_fuel_type FROM vehicle WHERE vehicle_id = ?";    
            $params = [$_GET['vid']];
            require_once DATABASE_CONTROLLER;
            $vehicle = getRecord($query, $params);
        ?>

        <?php
            $query = "SELECT fueling_id, vehicle_id, fuel_quantity, fuel_cost, fuel_cost_per_liter, fuel_station_name, vehicle_before_trip_clock, vehicle_actual_clock FROM fuel WHERE vehicle_id = ?";
            $params = [$_GET['vid']];
            require_once DATABASE_CONTROLLER;
            $fuelings = getList($query, $params);
        ?>

        <?php if(count($fuelings) <= 0) : ?>
            <h1>You don't have any fuelings in the database!</h1>
        <?php else: ?>
            <h1><?=$vehicle['vehicle_brand'].' '.$vehicle['vehicle_model']?> trips</h1>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fuel Quantity</th>
                        <th scope="col">Fuel Cost in HUF</th>
                        <th scope="col">Fuel Cost per Liter</th>
                        <th scope="col">Range</th>
                        <th scope="col">Consumption L/100km</th>
                        <th scope="col">Fuel Station</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    <?php foreach ($fuelings as $f) : ?>
                        <?php $avg = ($f['fuel_quantity'])/($f['vehicle_actual_clock']-$f['vehicle_before_trip_clock'])*100; ?>
                        <?php $i++; ?>
                        <tr>
                            <th scope="row"><?=$i?></th>
                            <td><?=$f['fuel_quantity']?></td>
                            <td><?=$f['fuel_cost']?></td>
                            <td><?=number_format((float)$f['fuel_cost_per_liter'], 1, '.', '');?></td>
                            <td><?=($f['vehicle_actual_clock']-$f['vehicle_before_trip_clock'])?></td>
                            <td><?=number_format((float)$avg, 2, '.', '');?></td>
                            <td><?=$f['fuel_station_name']?></td>               
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>