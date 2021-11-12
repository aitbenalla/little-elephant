<?php

foreach ($_GET as $key => $value) {
    switch ($key) {
        case 'success':
            echo "<div class='alert alert-success' role='alert'>$value</div>";
            break;
        case 'error':
            echo "<div class='alert alert-danger' role='alert'>$value</div>";
            break;
        case 'warning':
            echo "<div class='alert alert-warning' role='alert'>$value</div>";
            break;
    }
}
