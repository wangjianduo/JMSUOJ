<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../favicon.ico">

	<title>
		<?php echo $OJ_NAME ?> <?php echo $OJ_BBS ?>
	</title>

	<?php include "template/$OJ_TEMPLATE/css.php";?>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body>
	<div class="container">
		<?php include "template/$OJ_TEMPLATE/nav.php";?>

		<!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron"></div>

		<div class="card">
			<div class="card-header">
				<?php
if ($pr_flag) {
    echo "<title>$MSG_PROBLEM" . $row['problem_id'] . "--" . $row['title'] . "</title>";
    echo "<center><h3>#$id-" . $row['title'] . "</h3>";
} else {
    //$PID="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $id = $row['problem_id'];
    echo "<title>$MSG_PROBLEM " . $PID[$pid] . ": " . $row['title'] . " </title>";
    echo "<center><h3>$MSG_PROBLEM " . $PID[$pid] . ": " . $row['title'] . "</h3>";
}

echo "<span>$MSG_Time_Limit: </span><span><span class='badge badge-light' fd='time_limit' pid='" . $row['problem_id'] . "'  >" . $row['time_limit'] . " Sec</span></span>&nbsp;&nbsp;";
echo "<span>$MSG_Memory_Limit: </span><span class='badge badge-light'>" . $row['memory_limit'] . " MB</span>";

if ($row['spj']) {
    echo "&nbsp;&nbsp;<span class=red>Special Judge</span>";
}

if (isset($OJ_OI_MODE) && $OJ_OI_MODE) {
    echo "<br>";
} else {
    echo "<br><span style='line-height:30px;'><span>$MSG_SUBMIT: </span><span class='badge badge-info'>" . $row['submit'] . "</span>&nbsp;&nbsp;";
    echo "<span>$MSG_SOVLED: </span><span class='badge badge-success'>" . $row['accepted'] . "</span></span><br>";
    echo "<a class='btn btn-info btn-sm' href='problemstatus.php?id=" . $row['problem_id'] . "'><i class='fas fa-chart-bar'></i> $MSG_STATUS</a> ";
    if ($OJ_BBS) {
        echo "<a class='btn btn-dark btn-sm' href='bbs.php?pid=" . $row['problem_id'] . "$ucid'><i class='fas fa-comment-alt'></i> $MSG_BBS</a> ";
    }
}

if ($pr_flag) {
    echo "<a class='btn btn-success btn-sm' href='submitpage.php?id=$id'><i class='fas fa-arrow-circle-up'></i> $MSG_SUBMIT</a> ";
} else {
    echo "<a class='btn btn-success btn-sm' href='submitpage.php?cid=$cid&pid=$pid&langmask=$langmask'><i class='fas fa-arrow-circle-up'></i> $MSG_SUBMIT</a> ";
}

//命题人信息
//echo "<span class='badge badge-secondary'>$MSG_Creator:<span id='creator'></span></span>";

if (isset($_SESSION[$OJ_NAME . '_' . 'administrator'])) {
    require_once "include/set_get_key.php"; ?>

				<a class="btn btn-primary btn-sm" href="admin/problem_edit.php?id=<?php echo $id ?>&getkey=<?php echo $_SESSION[$OJ_NAME . '_' . 'getkey'] ?>"><i class='fas fa-edit'></i> 编辑</a>
				<a class="btn btn-secondary btn-sm" href='javascript:phpfm(<?php echo $row['problem_id']; ?>)'><i class='fas fa-database'></i> 测试数据</a>

				<?php
}

echo "</center>";
# end of head
echo "</div>";
echo "<!--StartMarkForVirtualJudge-->";
?>

				<div class="card-body">
					<div class='card' style="margin-bottom:15px;">
						<div class='card-header'>
							<h5>
								<?php echo $MSG_Description ?>
							</h5>
						</div>
						<div class='card-body content'>
							<?php echo $row['description'] ?>
						</div>
					</div>

					<?php
if ($row['input']) {?>
					<div class='card' style="margin-bottom:15px;">
						<div class='card-header'>
							<h5>
								<?php echo $MSG_Input ?>
							</h5>
						</div>
						<div class='card-body content'>
							<?php echo $row['input'] ?>
						</div>
					</div>
					<?php }
if ($row['output']) {?>
					<div class='card' style="margin-bottom:15px;">
						<div class='card-header'>
							<h5>
								<?php echo $MSG_Output ?>
							</h5>
						</div>
						<div class='card-body content'>
							<?php echo $row['output'] ?>
						</div>
					</div>
					<?php }
$sinput = str_replace("<", "&lt;", $row['sample_input']);
$sinput = str_replace(">", "&gt;", $sinput);
$soutput = str_replace("<", "&lt;", $row['sample_output']);
$soutput = str_replace(">", "&gt;", $soutput);

if (strlen($sinput)) {?>
					<div class='card' style="margin-bottom:15px;">
						<div class='card-header'>
							<h5>
								<?php echo $MSG_Sample_Input ?>
								<a class="btn btn-secondary btn-sm" href="javascript:CopyToClipboard($('#sampleinput').text())">复制</a>
							</h5>
						</div>
						<div class='card-body'><pre class=content><span id="sampleinput" class=sampledata><?php echo $sinput ?></span></pre>
						</div>
					</div>
					<?php }

if (strlen($soutput)) {?>
					<div class='card' style="margin-bottom:15px;">
						<div class='card-header'>
							<h5>
								<?php echo $MSG_Sample_Output ?>
								<a class="btn btn-secondary btn-sm" href="javascript:CopyToClipboard($('#sampleoutput').text())">复制</a>
							</h5>
						</div>
						<div class='card-body'><pre class=content><span id='sampleoutput' class=sampledata><?php echo $soutput ?></span></pre>
						</div>
					</div>
					<?php }

if ($row['hint']) {?>
					<div class='card' style="margin-bottom:15px;">
						<div class='card-header'>
							<h5>
								<?php echo $MSG_HINT ?>
							</h5>
						</div>
						<div class='card-body content'>
							<?php echo $row['hint'] ?>
						</div>
					</div>
					<?php }

if ($pr_flag) {?>
					<div class='card' style="margin-bottom:15px;">
						<div class='card-header'>
							<h5>
								<?php echo $MSG_SOURCE ?>

							</h5>
						</div>
						<div fd="source" pid=<?php echo $row['problem_id'] ?> class='card-body content'>
							<?php
$cats = explode(" ", $row['source']);
    foreach ($cats as $cat) {
        echo "<a class='badge badge-primary' href='problemset.php?search=" . urlencode(htmlentities($cat, ENT_QUOTES, 'utf-8')) . "'>" . htmlentities($cat, ENT_QUOTES, 'utf-8') . "</a>&nbsp;";
    }?>
						</div>
					</div>
					<?php }?>

				</div>
			<center>
				<!--EndMarkForVirtualJudge-->
				<div class='card-footer'>
					<?php
if ($pr_flag) {
        echo "<a class='btn btn-success btn-sm' href='submitpage.php?id=$id'><i class='fas fa-arrow-circle-up'></i> $MSG_SUBMIT</a> ";
    } else {
        echo "<a class='btn btn-success btn-sm' href='submitpage.php?cid=$cid&pid=$pid&langmask=$langmask'><i class='fas fa-arrow-circle-up'></i> $MSG_SUBMIT</a> ";
    }
echo "<a class='btn btn-info btn-sm' href='problemstatus.php?id=" . $row['problem_id'] . "'><i class='fas fa-chart-bar'></i> $MSG_STATUS</a> ";
//echo "[<a href='bbs.php?pid=".$row['problem_id']."$ucid'>$MSG_BBS</a>]";

if (isset($_SESSION[$OJ_NAME . '_' . 'administrator'])) {
    require_once "include/set_get_key.php"; ?>

<a class="btn btn-primary btn-sm" href="admin/problem_edit.php?id=<?php echo $id ?>&getkey=<?php echo $_SESSION[$OJ_NAME . '_' . 'getkey'] ?>"><i class='fas fa-edit'></i> 编辑</a>
				<a class="btn btn-secondary btn-sm" href='javascript:phpfm(<?php echo $row['problem_id']; ?>)'><i class='fas fa-database'></i> 测试数据</a>
					<?php
}?>
				</div>
			</center>
		</div>
	</div>
	<!-- /container -->


	<!-- Bootstrap core JavaScript
  ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<?php include "template/$OJ_TEMPLATE/js.php";?>
	<script>
		function phpfm( pid ) {
			//alert(pid);
			$.post( "admin/phpfm.php", {
				'frame': 3,
				'pid': pid,
				'pass': ''
			}, function ( data, status ) {
				if ( status == "success" ) {
					document.location.href = "admin/phpfm.php?frame=3&pid=" + pid;
				}
			} );
		}

		$( document ).ready( function () {
			$( "#creator" ).load( "problem-ajax.php?pid=<?php echo $id ?>" );
		} );
		function CopyToClipboard (input) {
			var textToClipboard = input;

			var success = true;
			if (window.clipboardData) { // Internet Explorer
			    window.clipboardData.setData ("Text", textToClipboard);
			}
			else {
				// create a temporary element for the execCommand method
			    var forExecElement = CreateElementForExecCommand (textToClipboard);

				    /* Select the contents of the element
					(the execCommand for 'copy' method works on the selection) */
			    SelectContent (forExecElement);

			    var supported = true;

				// UniversalXPConnect privilege is required for clipboard access in Firefox
			    try {
				if (window.netscape && netscape.security) {
				    netscape.security.PrivilegeManager.enablePrivilege ("UniversalXPConnect");
				}

				    // Copy the selected content to the clipboard
				    // Works in Firefox and in Safari before version 5
				success = document.execCommand ("copy", false, null);
			    }
			    catch (e) {
				success = false;
			    }

				// remove the temporary element
			    document.body.removeChild (forExecElement);
			}

			if (success) {
			    alert ("The text is on the clipboard, try to paste it!");
			}
			else {
			    alert ("Your browser doesn't allow clipboard access!");
			}
			}

			function CreateElementForExecCommand (textToClipboard) {
			var forExecElement = document.createElement ("pre");
			    // place outside the visible area
			forExecElement.style.position = "absolute";
			forExecElement.style.left = "-10000px";
			forExecElement.style.top = "-10000px";
			    // write the necessary text into the element and append to the document
			forExecElement.textContent = textToClipboard;
			document.body.appendChild (forExecElement);
			    // the contentEditable mode is necessary for the  execCommand method in Firefox
			forExecElement.contentEditable = true;

			return forExecElement;
			}

			function SelectContent (element) {
			    // first create a range
			var rangeToSelect = document.createRange ();
			rangeToSelect.selectNodeContents (element);

			    // select the contents
			var selection = window.getSelection ();
			selection.removeAllRanges ();
			selection.addRange (rangeToSelect);
			}
	</script>

</body>
</html>
