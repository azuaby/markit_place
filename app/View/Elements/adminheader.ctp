<div class="navbar">
        <div class="navbar-inner">
                <ul class="nav pull-right">
                    
                    <li><a href="<?php echo SITE_URL; ?>addadminsettings" class="hidden-phone visible-tablet visible-desktop" role="button">Settings</a></li>
                    <li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i> Admin
                            <i class="icon-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a tabindex="-1" href="<?php echo SITE_URL.'logout'; ?>">Logout</a></li>
                        </ul>
                    </li>
                    
                </ul>
                <a class="brand" href="<?php echo SITE_URL; ?>"><img src="<?php echo SITE_URL.'images/logo.png'; ?>" width="100px"></a>
        </div>
    </div>
    <div id="flashmsg">
			<?php echo $this->Session->flash(); 
			echo $this->Session->flash('good');
			echo $this->Session->flash('bad');?>
		</div>