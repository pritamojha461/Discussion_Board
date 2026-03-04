<?php
// No session_start() here since it's called in index.php
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Discuss Project</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?latest">Latest Questions</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['user']) && is_array($_SESSION['user']) && !empty($_SESSION['user']['username'])): ?>
                    <li class="nav-item">
                        <span class="nav-link">Welcome, <?php echo htmlspecialchars($_SESSION['user']['username']); ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="server/logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?signup">SignUp</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>