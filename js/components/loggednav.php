<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
        <li><a href="/College-Managment-System">School</a></li>
        <?php
            if($this->data['logged']['role'] != 'sales') {
                echo "<li><a href=\"/College-Managment-System/adminstration\">Administration</a></li>";
            }
        ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
    <?php
        echo <<<HTM
            <li>
                <span>hello {$this->data['logged']['first_name']} {$this->data['logged']['last_name']}, {$this->data['logged']['role']}</span>
                <a href="/College-Managment-System/logout" class="text-right"><span class="glyphicon glyphicon-log-out"></span>Logout</a>
            </li>
            <img src='/College-Managment-System/image/{$this->data['logged']['image']}'>
HTM;
    ?>
    </ul>
</div>