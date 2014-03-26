<?php $logotext = 'BugBook'; ?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');
		echo $this->Html->css('bugid');
        echo $this->fetch('css');
        echo $this->fetch('script');
        echo $this->Html->script('jquery');
        echo $this->Html->script('bugid');
        
        //For tab UI elements (So we can have thumbnail view and index view on same page)
        echo $this->Html->script('jquery-ui-1.10.4.custom.js');
        echo $this->Html->css('cupertino/jquery-ui-1.10.4.custom.css');          
	?>
    <script>
      var activeTab = 0;
      $(document).ready(function() {
        $("#tabs").tabs({active: activeTab});
          
        //Save the state of the active tab for AJAX pagination call
        $('#tabs a').click(function(e) {
            activeTab = $('#tabs').tabs("option", "active");
        });
      });
    </script>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1 id="logo"><?php echo $this->Html->link(__($logotext), '/'); ?></h1>
                        <?php echo $this->element('navigation_top'); ?>
                        <?php echo $this->element('loginbar'); ?>
		</div>
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<div id="main-content">
                <?php echo $this->fetch('content'); ?>
            </div>
			<?php echo $this->Element('sidebar'); ?>
		</div>
		<div id="footer">
		</div>
	</div>
        <?php 
            //echo $this->Js->writeBuffer(); // Write cached scripts. (For AJAX pagination)
        ?>
</body>
</html>
