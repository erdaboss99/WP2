<?php if(!IsUserLoggedIn()) : ?>
    <h1>Page access is forbidden!</h1>
<?php else: ?>

    <?php 
        if(!array_key_exists('vid', $_GET) || empty($_GET['vid']))
        {
            header('Location: index.php?P=home'); 
        } 
        else
        { 
            $query = "SELECT vehicle_id, user_id, vehicle_brand, vehicle_model, vehicle_clock, vehicle_fuel_type FROM vehicle WHERE user_id = ?";    
            $params = [$_SESSION['u_id']];
            require_once DATABASE_CONTROLLER;
            $vehicles = getList($query, $params);
        }
    ?>
    <?php $i = 0; ?>
    <?php foreach ($vehicles as $v) : ?>
        <?php if($v['vehicle_id'] == $_GET['vid']) : ?>
            <?php
                $query = "SELECT vehicle_id, file_name FROM filenames WHERE vehicle_id = ?";
                $params = [$v['vehicle_id']];
                require_once DATABASE_CONTROLLER;
                $filename = getRecord($query, $params);    
            ?>
            <img src="public/uploads/<?=$filename['file_name']?>" alt="<?=$v['vehicle_brand'].' '.$v['vehicle_model'] ?>" style="float">
            <h2><b>Vehicle: </b> <?=$v['vehicle_brand'].' '.$v['vehicle_model'] ?></h2>
            <h3><b>Clock: </b><?=$v['vehicle_clock'] ?> km</h3>
            <p><b>Fuel type: </b><?=$v['vehicle_fuel_type'] == 0 ? 'Gasoline' : 'Diesel' ?></p>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>
