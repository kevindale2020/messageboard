<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->meta('myToken', $this->request->param('csrfToken'));

		echo $this->Html->css('https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <span class="navbar-brand text-color">Message Board</span>

  <div class="navbar-nav">
    <?php echo $this->Html->link('Home', '/', array('class' => 'nav-item nav-link'));?>
    <?php echo $this->Html->link('About', '', array('class' => 'nav-item nav-link'));?>
    <?php echo $this->Html->link('Contact', '', array('class' => 'nav-item nav-link'));?>
  </div>

  <div class="navbar-nav ml-auto">
  	<?php echo $this->Html->link('Register', '/register', array('class' => 'nav-item nav-link'));?>
    <?php echo $this->Html->link('Login', '/login', array('class' => 'nav-item nav-link'));?>
  </div>
</nav>
	<div class="container">
		<?php echo $this->Flash->render(); ?>
		<?php echo $this->fetch('content'); ?>
	</div>
<!-- 	<?php echo $this->element('sql_dump'); ?> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<?php echo $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js'); ?>
	<script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="myToken"]').attr('content')
            }
        });
    </script>
	<script type="text/javascript">
		$(document).ready(function(){

			$('#registerForm').submit(function(e){

				e.preventDefault();

				var name = $('#name').val();
	            var email = $('#email').val();
	            var pass1 = $('#pass1').val();
	            var pass2 = $('#pass2').val();

	            var message = "";

	            if(name==''||email==''||pass1=='') {

	                if(name=='') {

	                    message += "Name is required\n";
	                }

	                if(email=='') {

	                    message += "Email is required\n";
	                }

	                if(pass1=='') {

	                    message += "Password is required\n";
	                }

	                alert(message);

	                return false;
	            }

	            if(pass1 != pass2) {

	                message += "Password does not match";

	                alert(message);

	                return false;
	            }

	            if(pass1.length < 8) {

	                message += "Password should at least be 8 characters";

	                alert(message);

	                return false;
	            }

	            $.ajax({

	                url: '<?php echo $this->Html->url('/register');?>',
	                method: 'POST',
	                data: new FormData(this),
	                contentType: false,
	                processData: false,
	                success: function(data) {
	                   
	                    var data = JSON.parse(data);

	                   	if(data.success==1) {
	                   		alert(data.message);
	                   		$('#registerForm')[0].reset();
	                   	} else {
	                   		alert(data.messageErr);
	                   	}
	                },
	                error: function(jqXHR, status, error) {
	                  console.log(status);
	                  console.log(error);
	                }
	            });
			})
		});
	</script>
</body>

</html>
