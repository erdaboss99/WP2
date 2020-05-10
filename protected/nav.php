<hr>

<ul class="nav nav-pills nav-fill">
        <li class="nav-item">
            <a class="nav-link <?=$_GET['P'] == 'home' ? 'active' : ''?>" data-toggle="tab" href="index.php?P=home">Home</a>
        </li>
        <?php if(!IsUserLoggedIn()) : ?>
            <li class="nav-item">
                <a class="nav-link <?=$_GET['P'] == 'login' ? 'active' : ''?>" data-toggle="tab" href="index.php?P=login">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=$_GET['P'] == 'registration' ? 'active' : ''?>" data-toggle="tab" href="index.php?P=registration">Registration</a>
            </li>
        <?php else : ?>
            <li class="nav-item">
                <a class="nav-link <?=$_GET['P'] == 'listv' ? 'active' : ''?>" href="index.php?P=listv">List Vehicles</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?=$_GET['P'] == 'addv' ? 'active' : ''?>" href="index.php?P=addv">Add Vehicle</a>
            </li>
            <?php if(!isset($_SESSION['access_level']) || $_SESSION['access_level'] = 1) : ?>
                <li class="nav-item">
                    <a class="nav-link <?=$_GET['P'] == 'permission' ? 'active' : ''?>" href="index.php?P=permission">Permission test</a>
                </li>
            <?php endif; ?>
            <li class="nav-item">
                <a class="nav-link"href="index.php?P=logout">Logout</a>
            </li>
        <?php endif; ?>
    </ul>

<hr>