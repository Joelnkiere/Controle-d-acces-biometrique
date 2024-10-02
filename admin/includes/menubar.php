<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user['prenom'].' '.$user['nom']; ?></p>
          <a><i class="fa fa-circle text-success"></i> Connecté</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">RAPPORT</li>
        <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>Tableau de Bord</span></a></li>
        <li class="header">GESTION AGENT</li>
        <li><a href="agent.php"><i class="fa fa-users"></i><span>Agent</span></a></li>
        <li><a href="direction.php"><i class="fa fa-building"></i><span>Direction</span></a></li> 
        <li><a href="service.php"><i class="fa fa-suitcase"></i><span>Service</span></a></li> 
        <li class="header">GESTION PRESENCE</li>
        
        <li><a href="presence.php"><i class="fa fa-calendar"></i><span>Presence</span></a></li>
        
        
        <li><a href="horaire.php"><i class="fa fa-clock-o"></i> <span>Horaire</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>