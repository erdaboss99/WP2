<?php if(!IsUserLoggedIn()) : ?>
    <h1>Page access is forbidden!</h1>
<?php else: ?>

    <?php
        $query = "SELECT vehicle_id, user_id, vehicle_brand, vehicle_model, vehicle_clock, vehicle_fuel_type FROM vehicle WHERE user_id = ?";    
        $params = [$_SESSION['u_id']];
        require_once DATABASE_CONTROLLER;
        $vehicles = getList($query, $params);
    ?>
    <?php if(count($vehicles) <= 0) : ?>
        <h1>You don't have any vehicles in the database!</h1>
    <?php else: ?>
        <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Picture</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Model</th>
                        <th scope="col">Clock</th>
                        <th scope="col">Fuel type</th>
                        <th scope="col">Add fueling</th>
                        <th scope="col">List trips</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    <?php foreach ($vehicles as $v) : ?>
                        <?php
                            $query = "SELECT vehicle_id, file_name FROM filenames WHERE vehicle_id = ?";
                            $params = [$v['vehicle_id']];
                            require_once DATABASE_CONTROLLER;
                            $filename = getRecord($query, $params);
                        ?>
                        <?php $i++; ?>
                        <tr>
                            <th scope="row"><?=$i?></th>
                            <td><?=empty($filename) ? '<a href="?P=upload&vid='.$v['vehicle_id'].'">Upload Image</a>' : '<img src="public/uploads/'.$filename['file_name'].'" alt="'.$v['vehicle_brand'].' '.$v['vehicle_model'].'" height="50" width="50">' ?></td>
                            <td><?=$v['vehicle_brand']?></td>
                            <td><a href="?P=profilev&vid=<?=$v['vehicle_id'] ?>"><?=$v['vehicle_model'] ?></a></td>
                            <td><?=$v['vehicle_clock']?></td>
                            <td><?=$v['vehicle_fuel_type'] == 0 ? 'Gasoline' : 'Diesel'?></td>
                            <td><a href="?P=addf&vid=<?=$v['vehicle_id']?>">Add Fueling</a></td>
                            <td><a href="?P=listt&vid=<?=$v['vehicle_id']?>">List Trip</a></td>                 
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
    <?php endif; ?>
<?php endif; ?>