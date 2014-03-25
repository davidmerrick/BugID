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
      $(function() {
        $( "#tabs" ).tabs();
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
			<?php echo $this->fetch('content'); ?>
			<?php echo $this->Element('sidebar'); ?>
		</div>
		<div id="footer">
		</div>
	</div>
        <?php 
            //For deBUGging 
            //echo $this->element('sql_dump'); 
        ?>
</body>
</html>
