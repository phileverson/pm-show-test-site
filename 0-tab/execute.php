<?php
	/**
	 * GIT DEPLOYMENT SCRIPT
	 *
	 * Used for automatically deploying websites via github or bitbucket, more deets here:
	 *
	 *		https://gist.github.com/1809044
	 */

	// The commands

	$newBranch = $_GET['newBranch'];

echo $newBranch;

	$commands = array(
		'echo $PWD',
		'whoami',
		'git checkout ' . $newBranch,
		'git pull',
		// 'git pull',
		// 'git status',
		// 'git submodule sync',
		// 'git submodule update',
		// 'git submodule status',
	);

	// Run the commands for output
	$output = '';
	foreach($commands AS $command){
		// Run it
		$tmp = shell_exec($command);
		// Output
		$output .= "<span style=\"color: #6BE234;\">\$</span> <span style=\"color: #729FCF;\">{$command}\n</span>";
		$output .= htmlentities(trim($tmp)) . "\n";
	}

	// Make it pretty for manual user access (and why not?)
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Foundation | Welcome</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/phil-custom.css" />
    <script src="js/vendor/modernizr.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="asana-api-cors.js"></script>
</head>
<body class="tab-top-container">
    <nav class="top-bar" data-topbar="">
        <ul class="title-area">
            <!-- Title Area -->
            <li class="name">
                <h1>
                    <a href="#">Project Overview: Restuarant Site 1</a>
                </h1>
            </li>
            <li class="toggle-topbar menu-icon"><a href="#"><span>menu</span></a></li>
        </ul>

        <section class="top-bar-section">
            <!-- Right Nav Section -->
            <ul class="right">
                <li class="divider"></li>
                <li>
                    <a href="#" class="nav-legend">Enviorment: </a>
                </li>
                <li class="has-dropdown not-click">
                    <a href="#" id="currentBranchNav"></a>
                    <ul class="dropdown">
                        <li><a href="execute.php?newBranch=master" class="env-list">Production</a></li>
                        <li class="divider"></li>
                        <li><a href="execute.php?newBranch=DEV" class="env-list">DEV Testing</a></li>
                        <li class="divider"></li>
                        <li><a href="execute.php?newBranch=QA" class="env-list">QA</a></li>
                        <li class="divider"></li>
                        <li><a href="execute.php?newBranch=UAT" class="env-list">UAT/Staging</a></li>
                    </ul>
                </li>
                <li class="divider"></li>
            </ul>
        </section>
    </nav>
    
<pre>
 .  ____  .    ____________________________
 |/      \|   |                            |
[| <span style="color: #FF0000;">&hearts;    &hearts;</span> |]  | Git Deployment Script v0.1 |
 |___==___|  /              &copy; oodavid 2012 |
              |____________________________|

<?php echo $output; ?>
</pre>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>