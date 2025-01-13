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
        <li><a href="home.php"><i class="fa fa-dashboard"></i> <span>Tableau de Bord</span></a></li>
        
        <li class="header">GESTION AGENT ET ORGANE</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-id-badge"></i> <!-- Icon for Agents and Organs -->
            <span>Agents et Organes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="agent.php"><i class="fa fa-user"></i><span>Liste Agent</span></a></li>
            <li><a href="direction.php"><i class="fa fa-building"></i><span>Direction</span></a></li>
            <li><a href="service.php"><i class="fa fa-briefcase"></i><span>Service</span></a></li>
            <li><a href="poste.php"><i class="fa fa-sitemap"></i> Fonction</a></li>
          </ul>
        </li>
        
        <li class="header">GESTION DE PAIEMENT</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-wallet"></i> <!-- Icon for Finance -->
            <span>Finance</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="avance_salaire.php"><i class="fa fa-hand-holding-usd"></i>Avance sur salaire</a></li>
            <li><a href="paiement.php"><i class="fa fa-credit-card"></i> <span>Paiement</span></a></li>
            <li><a href="deduction.php"><i class="fa fa-minus-circle"></i> Déduction sur salaire</a></li>
          </ul>
        </li>
        
        <li class="header">GESTION PRESENCE ET HORAIRE</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-clock"></i> <!-- Icon for Schedule -->
            <span>Horaire</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="presence.php"><i class="fa fa-calendar"></i><span>Présence</span></a></li>
          <li><a href="abscence.php"><i class="fa fa-calendar"></i><span>Absence</span></a></li>
            <li><a href="prestation.php"><i class="fa fa-calendar-alt"></i><span>Prestation</span></a></li>
            <li><a href="horaire.php"><i class="fa fa-clock"></i> <span>Horaire de travail</span></a></li>
            <li><a href="horaire_agent.php"><i class="fa fa-user-clock"></i> <span>Affectation Horaire</span></a></li>
          </ul>
        </li>
        
        <li class="header">SYSTEME</li>
        <li><a href="#"><i class="fa fa-user-circle"></i> <span>Mon Profil</span></a></li>
        <li><a href="#"><i class="fa fa-users-cog"></i> <span>Utilisateur</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
 