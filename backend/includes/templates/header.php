<body>
<header role="banner" class="probootstrap-header">
    <div class="container">
        <h1 class="probootstrap-logo">Hell Scripts</h1>
        
        <a href="#" class="probootstrap-burger-menu visible-xs" ><i>Menu</i></a>
        <div class="mobile-menu-overlay"></div>

        <nav role="navigation" class="probootstrap-nav hidden-xs">
            <ul class="probootstrap-main-nav">
                <li id="home" class="bannerItem"><a href="<? echo _PUBLIC_URL_.'/home' ?>" class="translate" data-original="Home">Home</a></li>
                <li id="explore" class="bannerItem"><a href="<? echo _PUBLIC_URL_.'/explore' ?>" class="translate" data-original="Explore">Explore</a></li>
                <li id="projects" class="bannerItem"><a href="<? echo _PUBLIC_URL_.'/projects' ?>" class="translate" data-original="Projects">Projects</a></li>
                <li id="jqWidgets" class="bannerItem"><a href="<? echo _PUBLIC_URL_.'/jqWidgets' ?>">JqWidgets</a></li>
                <li id="profile" class="bannerItem"><a href="<? echo _PUBLIC_URL_.'/profile' ?>" class="translate" data-original="Profile">Profile</a></li>
                <li id="contact" class="bannerItem"><a href="<? echo _PUBLIC_URL_.'/contact' ?>" class="translate" data-original="Contact">Contact</a></li>
            </ul>
            <ul class="probootstrap-right-nav hidden-xs">
                <li id="cartButton"><a href="<? echo _PUBLIC_URL_.'/users' ?>" id="cartLink" class="btn btn-sm btn-primary btn-link"><i class="icon-cart"></i></a></li>
                <li id="userButton"><a href="<? echo _PUBLIC_URL_.'/users' ?>" class="btn btn-sm btn-primary btn-link">Log in <i class="icon-user"></i></a></li>
            </ul>
        </nav>
        <nav role="navigation" class="probootstrap-nav hidden-xs">
            <ul class="probootstrap-right-nav hidden-xs">
                <li id="userInfo"></li>
            </ul>
        </nav>
    </div>
</header>
<div class="probootstrap-loader"></div>