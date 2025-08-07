 <header>
    <h1>Find My Dream Home</h1>
    <nav  class="nav-links">
        <a href="#houses">House</a>
        <a href="#apartments">Apartments</a>
       
        <?php if (isset($_SESSION['isLoggedIn'])): ?>
            <a href="views/add_item.php">Add</a>
            <a href="views/logout.php">Logout</a>
        <?php else: ?>
            <a href="views/login.php">Login</a>
        <?php endif; ?>
        
    </nav>
</header>