<?php
$tmp = shell_exec('git rev-parse --abbrev-ref HEAD');
$output = htmlentities(trim($tmp));
echo '<span id="currentBranchOutput" style="display:none">' . $output . '</span>';
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

    <div class="large-12 columns tab-top-container no-pad-left no-pad-right">
        <table class="large-12">
            <thead>
                <tr>
                    <td colspan="2">
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

var currentBranch = $('#currentBranchOutput').text()
if(currentBranch == 'master')
{
    currentBranch = 'Production';
}
// var currentBranch = 'task/001';
$('#currentBranchNav').text(currentBranch);


function updateBranchButtons ()
{
    if(currentBranch.search('task') >= 0)
    {
        var branchTaskID = currentBranch.substring(5,8);
        console.log(branchTaskID);
        $('#switch-branch-' + branchTaskID).text('Currently Viewing');
        $('#switch-branch-' + branchTaskID).addClass('disabled');
    }
}

function getGitHubCommits (branch, taskID, callback) {
    $.ajax
    ({
        type: "GET",
        url: "https://api.github.com/repos/phileverson/pm-show-test-site/commits?sha=task/" + taskID,
        dataType: 'json',
        async: false,
        headers: {
        "Authorization": "Basic " + btoa('5a8ed8ea12397e217c39a0ac846a175946518597')
    }
    })
    .done(function( msg ) {
        var taskStatusLabel = tagsFromCommits(msg);
        if(taskStatusLabel == 'Started')
        {
            $('#label-' + taskID).text(taskStatusLabel);
            $('#label-' + taskID).addClass('secondary');
            $('#label-' + taskID).css('opacity','1');
        }
        else(taskStatusLabel.length > 1 && taskStatusLabel != 'Started')
        {
            $('#label-' + taskID).text(taskStatusLabel);
            $('#label-' + taskID).addClass('success');
            $('#label-' + taskID).css('opacity','1');
        }
    })
    .fail(function(){
            $('#label-' + taskID).text('Not Started');
            $('#label-' + taskID).addClass('alert');
            $('#label-' + taskID).css('opacity','1');
            $('#switch-branch-' + taskID).text('No Progress to View');
            $('#switch-branch-' + taskID).addClass('disabled');
            $('#switch-branch-' + taskID).removeAttr("href");
            $('#switch-branch-' + taskID).css('display', 'none');

    });

}

function tagsFromCommits (gitHubCommits) {
    var numCommits = gitHubCommits.length;
    for (var i = 0; i < numCommits; i++) {
        console.log(gitHubCommits[i].commit.message);
        var commitMsg = gitHubCommits[i].commit.message;
        if(commitMsg.search('#DevDone') >= 0)
        {
            return 'Dev Done';
        }
        if(commitMsg.search('#QADone') >= 0)
        {
            return 'QA Done';
        }
        if(commitMsg.search('#ForUAT') >= 0)
        {
            return 'Ready For UAT';
        }   
    }
    return 'Started';
}

function makeTable (asanaTasks) {
    var numTasks = asanaTasks.data.length;
    var arrayTasks = asanaTasks.data;

    var rowsHTML = '';
    for (var i = 0; i < numTasks; i++) {
        taskID = arrayTasks[i].name.substring(0, 3);
        rowsHTML += '<tr><td style="width: 10px">';
        rowsHTML += '<a href="execute.php?newBranch=task/' + taskID + '" class="tiny button in-table" id="switch-branch-' + taskID + '">View&nbsp;Progress</a>';
        rowsHTML += '</td><td>';
        rowsHTML += arrayTasks[i].name;
        var branch = 'task/' + taskID;

        rowsHTML += '<span class="round label right dev-status-label" id="label-' + taskID + '"></span>';
        rowsHTML += '</td></tr>';
    }
    // adding the rows we've made to the page.
    $('#asanaTasks').html(rowsHTML);
    updateBranchButtons();

    for (var j = 0; j < numTasks; j++) {
        var taskID = arrayTasks[j].name.substring(0, 3);
        var branch = 'task/' + taskID;
        getGitHubCommits(branch, taskID);
    }

}
</script>


<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script>
    $(document).foundation();
</script>
</body>
</html>
