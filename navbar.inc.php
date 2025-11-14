<nav class = "navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand titleNavbar" href="#">
            <img src="assets/removebg-logo.png" alt="logo Pack & Dash" width="60" height="40" class="d-inline-block align-text-bottom">
            Pack & Dash
        </a>
        <?php if($title !== 'Dashboard Demenageur'): ?>
        <div class="listLink">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#infos">Infos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#slogan">A propos de nous</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contacts">Contacter nous</a>
                </li>
            </ul>
        </div>
        <?php endif; ?>
        <div class="listButton list-Buttons">
            <?php if($title !== 'Dashboard Demenageur'): ?>
                <a class="nav-link link-connection" href="login.inc.php">Se connecter</a>
                <a class="nav-link link-inscription" href="register.php">S'inscrire</a>
            <?php else: ?>
                <a class="nav-link rocket" href="#" title="nouvelles annonces">
                    <i class="fa-solid fa-rocket"></i>
                </a>
                <a class="nav-link inbox" href="#" title="mes propositions">
                    <i class="fa-solid fa-inbox"></i>
                </a>
                <a class="nav-link inbox" href="#" title="mon profil">
                    <i class="fa-solid fa-user"></i>
                </a>
            <?php endif; ?>
            <div class="bar-diviseur-vertical"></div>
            <a href="#" title="dark mode">
                <i class="fa-solid fa-cloud-moon"></i>
            </a>
            
        </div>
        <div class="menu-icon">
            <i class="fa-solid fa-bars"></i>
            <span>Menu</span>
        </div>
    </div>
</nav>

<div class="menu-responsive">
    <div class="listLink-menu">
        <ul class="navbar-nav">
            <?php if($title !== 'Dashboard Demenageur'): ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#infos">Infos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#slogan">A propos de nous</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contacts">Contacter nous</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">
                        <i class="fa-solid fa-house"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#infos">
                        <i class="fa-solid fa-rocket"></i>
                        Nouvelles annonces
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">
                        <i class="fa-solid fa-inbox"></i>
                        Mes propositions
                    </a>
                </li>
            <?php endif ?>
        </ul>
    </div>
    <div class="bar-diviseur-horizontal"></div>
    <div class="list-Buttons-menu">
        <?php if($title !== 'Dashboard Demenageur'): ?>
            <a class="nav-link link-connection" href="login.inc.php">Se connecter</a>
            <a class="nav-link link-inscription" href="register.php">S'inscrire</a>
        <?php else: ?>
            <a class="nav-link profil-user" href="#">
                <span>Profile</span>
                <i class="fa-solid fa-user"></i>
            </a>
            <a class="nav-link deconnexion bg-danger" href="#">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Deconnexion</span>
            </a>
        <?php endif ?>
        <a class="nav-link link-dark-mode bg-dark" href="#">
            <span>Dark mode</span>
            <i class="fa-solid fa-moon"></i>
        </a>
    </div>
</div>

