<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
        <li><a href="/talcohenproject">school</a></li>
        <?php
            if($this->data['logged']['role'] != 'sales') {
                echo "<li><a href=\"/talcohenproject/adminstration\">administration</a></li>";
            }
        ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
    <?php
        echo <<<HTM
            <li>
                <span>hello {$this->data['logged']['first_name']} {$this->data['logged']['last_name']}, {$this->data['logged']['role']}</span>
                <a href="/talcohenproject/logout" class="text-right"><span class="glyphicon glyphicon-log-out"></span>Logout</a>
            </li>
            <img src='/talcohenproject/image/{$this->data['logged']['image']}'>
HTM;
    ?>
    </ul>
</div>