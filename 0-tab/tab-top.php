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
                    <a href="#">pm-show: Restuarant Site 1</a>
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
                    <a href="#">Single Task</a>
                    <ul class="dropdown">
                        <li><a href="#" class="env-list">Single Task</a></li>
                        <li class="divider"></li>
                        <li><a href="#" class="env-list">DEV Testing</a></li>
                        <li class="divider"></li>
                        <li><a href="#" class="env-list">QA</a></li>
                        <li class="divider"></li>
                        <li><a href="#" class="env-list">UAT/Staging</a></li>
                    </ul>
                </li>
                <li class="divider"></li>
            </ul>
        </section>
    </nav>

    <div class="large-12 columns tab-top-container">
        <table class="large-12">
            <thead>
                <tr>
                    <td>
                        Project Tasks/Milestones:
                    </td>
                </tr>
            </thead>
            <tbody id="asanaTasks">

            </tbody>
        </table>
    </div>
<!-- <tr>
<td>
    <a href="execute.php?newBranch=dev-1" class="tiny button in-table" id="switch-branch">View Progress</a>
    This is longer content Donec id elit non mi porta gravida at eget metus.
    <span class="round label right dev-status-label">Dev Done</span>
    <span class="round label right dev-status-label">Needs QA</span>
</td>
</tr>
<tr>
<td><a href="execute.php?newBranch=dev-1" class="tiny button in-table" id="switch-branch">View Progress</a>
This is longer Content Goes Here Donec id elit non mi porta gravida at eget metus.</td>
</tr>
<tr>
<td><a href="execute.php?newBranch=dev-1" class="tiny button in-table" id="switch-branch">View Progress</a>
This is longer Content Goes Here Donec id elit non mi porta gravida at eget metus.</td>
</tr> -->

<div class="large-12 columns bottom-hold no-pad-right no-pad-left">

</div>


<!-- I NEED THIS LINK ADDRESS LATER....  execute.php?newBranch=dev-1   -->

<script>
// From this Awesome GIST: https://gist.github.com/agnoster/6e38a1c595102e892381
// You must specify or replace ASANA_API_KEY with a valid string containing your Asana API key
// Alternatively, you can supply the options { token: ASANA_OAUTH_TOKEN } with a valid OAuth bearer token

var asana = new AsanaApi({ api_key: "1shFwfh2.S4XB2Tc88QeX0If94OWrpMU" })
asana.request("GET", "projects/23796687427088/tasks", function(err, response) {
    if (err) console.error("Error:", err)
        else makeTable(response)
    })

function makeTable (asanaTasks) {
    var numTasks = asanaTasks.data.length;
    var arrayTasks = asanaTasks.data;

    var rowsHTML = '';
    for (var i = 0; i < numTasks; i++) {
        taskID = arrayTasks[i].name.substring(0, 3);
        rowsHTML += '<tr><td>';
        rowsHTML += '<a href="execute.php?newBranch=task/' + taskID + '" class="tiny button in-table" id="switch-branch">View Progress</a>';
        rowsHTML += arrayTasks[i].name;
        rowsHTML += '<span class="round label right dev-status-label">Dev Done</span>';
        rowsHTML += '</td></tr>';
    };

    // $('#asanaTasks').html('hi');
    $('#asanaTasks').html(rowsHTML);


    // var asanaTasksArray = JSON.parse(asanaTasks);
    // console.log(asanaTasksArray);
}
</script>


<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script>
    $(document).foundation();
</script>
</body>
</html>
