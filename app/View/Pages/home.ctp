<?php

?>
<div class="box span12">
	<div class="box-header well">
		<h2><i class="icon-info-sign"></i> Login</h2>
		
	</div>
	<div class="box-content">

					
	<div class="container-fluid">
		<div class="row-fluid">
		
			<div class="row-fluid">
				<div class="span12 center login-header">
					<h2>Infusionsoft Opt-out Rate Calculator</h2>
				</div><!--/span-->
			</div><!--/row-->
			
			<div class="row-fluid">
				<div class="well span5 center login-box">
					
					<div class="alert alert-info">
						Please login with your InfusionsoftID and Password.
					</div>
					
					<?php if($this->Session->check('Message.flash')){ ?>	
					<div class="alert alert-error">
						<button data-dismiss="alert" class="close" type="button">x</button>
						<strong><?php echo $this->Session->flash(); ?></strong>
					</div>
					<?php } ?>
					<form class="form-horizontal" action="optouts" method="post">
						<fieldset>
							<div class="input-prepend" title="Application Name" data-rel="tooltip">
								
								<?php 
									echo $this->Form->input('appname', 
										array(
											'class' => 'input-large span10', 
											'label' => 'Application Name',
											'div' => false
										)
									);
								?>
							</div>
							<div class="clearfix"></div>
							<div class="input-prepend" title="Username" data-rel="tooltip">
								<?php 
									echo $this->Form->input('username', 
										array(
											'class' => 'input-large span10', 
											'label' => 'Username',
											'div' => false
										)
									);
								?>
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password" data-rel="tooltip">
								
								<?php 
									echo $this->Form->input('password', 
										array(
											'class' => 'input-large span10', 
											'label' => 'Password',
											'div' => false
										)
									);
								?>
							</div>
							<div class="clearfix"></div>

							<p class="center span5">
							<button type="submit" class="btn btn-primary">Login</button>
							</p>
						</fieldset>
					</form>
				</div><!--/span-->
			</div><!--/row-->
				</div><!--/fluid-row-->
		
	</div><!--/.fluid-container-->
</div>
				</div>