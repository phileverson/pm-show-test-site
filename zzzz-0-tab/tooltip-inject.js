var toolTipHTML = '';

toolTipHTML += '<link href="0-tab/css/phil-tooltip.css" rel="stylesheet" type="text/css">';
toolTipHTML += '<iframe src="0-tab/tab-top.php" class="iframeLoad-pm-show h-of-0" width="100%" scrolling="no" frameborder="0"></iframe>'
toolTipHTML += '<div id="tool-tip-bottom-pm-show"><span class="bottom-logo-pm-show">pmShow</span>'
toolTipHTML += '<span><img class="bottom-up-arrow-right open-iframe" src="0-tab/img/up-arrow.png"></span>';
toolTipHTML += '</div>';

$('body').append(toolTipHTML);
$('body').css('margin-bottom', '45px');

var statusOpen = true;

$('.open-iframe').click(function() {
  if(statusOpen) 
  {
    $('.iframeLoad-pm-show').removeClass('h-of-0');
    $('.iframeLoad-pm-show').addClass('h-of-300');
    $('body').css('margin-bottom', '325px');
    $('.bottom-up-arrow-right').addClass('flipped');
    $('.bottom-up-arrow-right').addClass('close-iframe');
    $('.bottom-up-arrow-right').removeClass('open-iframe');
    statusOpen = false;
  }
  else
  {
    $('.bottom-up-arrow-right').removeClass('flipped');
    $('.iframeLoad-pm-show').addClass('h-of-0');
    $('.iframeLoad-pm-show').removeClass('h-of-300');
    $('body').css('margin-bottom', '45px');
    $('.bottom-up-arrow-right').addClass('open-iframe');
    $('.bottom-up-arrow-right').removeClass('close-iframe');
    statusOpen = true;
  }
});

