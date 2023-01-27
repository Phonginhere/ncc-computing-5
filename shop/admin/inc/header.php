<?php
include '../lib/session.php';
include '../classes/config.php';
Session::checkSession();
?>
<?php
$cg = new configclass();
?>
<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <?php
	$cglist = $cg->show_config();
	if ($cglist) {
		$i = 0;
		while ($result = $cglist->fetch_assoc()) {
	?>
			<title>Admin page / <?= $result['title_website'] ?></title>
			<link rel="icon" type="image/x-icon" href="uploads/<?= $result['image_main_web'] ?>">
	<?php
		}
	}
	?>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script type="text/javascript" src="js/table/table.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            setupLeftMenu();
            setSidebarHeight();
        });
    </script>


</head>

<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <?php
                $cglist = $cg->show_config();
                if ($cglist) {
                    $i = 0;
                    while ($result = $cglist->fetch_assoc()) {
                ?>
                        <div class="floatleft logo">
                            <img src="uploads/<?= $result['image_main_web'] ?>" alt="Logo" />
                        </div>

                        <div class="floatleft middle">
                            <h1><?= $result['title_website'] ?></h1>
                            <p><?= $result['slogan_website'] ?></p>
                        </div>
                <?php
                    }
                }
                ?>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="img/img-profile.jpg" alt="Profile Pic" />
                    </div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello <?php echo Session::get('adminName') ?></li>
                            <?php
                            if (isset($_GET['action']) && $_GET['action'] == 'logout') {
                                Session::destroy();
                            }
                            ?>
                            <li><a href="?action=logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="index.php"><span>Dashboard</span></a> </li>
                <li class="ic-form-style"><a href=""><span>User Profile</span></a></li>
                <li class="ic-typography"><a href="changepassword.php"><span>Change Password</span></a></li>
                <li class="ic-grid-tables"><a href="inbox.php"><span>Inbox</span></a></li>
                <li class="ic-charts"><a href="../" target="_blank"><span>Visit Website</span></a></li>
            </ul>
        </div>
        <div class="clear">
        </div>