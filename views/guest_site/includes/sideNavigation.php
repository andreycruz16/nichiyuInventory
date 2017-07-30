<nav class="navbar-default navbar-side" role="navigation">
    <div id="sideNav" href=""><i class="fa fa-caret-right" title="Hide / Show"></i></div>
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
             <li>
                <a class="<?php if(basename($_SERVER['REQUEST_URI']) == 'index.php') echo 'active-menu'; else echo ''; ?>" href="index.php"><i class="glyphicon glyphicon-list"></i> Dashboard</a>
            </li>
            <li>
                <a class="<?php if(basename($_SERVER['REQUEST_URI']) == 'recordTally.php') echo 'active-menu'; else echo ''; ?>" href="recordTally.php"><i class="glyphicon glyphicon-list-alt"></i> Record Tally</a>
            </li>
            <li>
                <a class="<?php if(basename($_SERVER['REQUEST_URI']) == 'reports.php') echo 'active-menu'; else echo ''; ?>" href="reports.php"><i class="glyphicon glyphicon-print"></i> Reports</a>
            </li>                         
        </ul>
    </div>
</nav>