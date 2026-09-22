<?php

require_once "config/auth.php";
require_once "config/database.php";

// Flash message
$flash = $_SESSION["flash"] ?? "";
$flash_type = $_SESSION["flash_type"] ?? "success";

unset($_SESSION["flash"]);
unset($_SESSION["flash_type"]);

// Search and category filter
$search = trim($_GET["search"] ?? "");
$category_id = (int)($_GET["category"] ?? 0);

// Get categories
$categories = $conn->query(
    "SELECT category_id, category_name
     FROM categories
     ORDER BY category_name"
);

// Get clubs
$sql = "
    SELECT
        c.club_id,
        c.club_name,
        c.description,
        c.coordinator,
        ca.category_name,
        COUNT(cm.member_id) AS members
    FROM clubs c
    LEFT JOIN categories ca
        ON c.category_id = ca.category_id
    LEFT JOIN club_members cm
        ON c.club_id = cm.club_id
    WHERE c.club_name LIKE ?
";

if ($category_id > 0) {
    $sql .= " AND c.category_id = ?";
}

$sql .= "
    GROUP BY
        c.club_id,
        c.club_name,
        c.description,
        c.coordinator,
        ca.category_name
    ORDER BY c.club_name
";

$stmt = $conn->prepare($sql);

$search_value = "%" . $search . "%";

if ($category_id > 0) {
    $stmt->bind_param("si", $search_value, $category_id);
} else {
    $stmt->bind_param("s", $search_value);
}

$stmt->execute();

$clubs = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Campus Clubs</title>

    <link rel="stylesheet" href="css/style.css">

    <script src="js/script.js"></script>

</head>

<body>

<!-- NAVBAR -->

<nav class="navbar">

    <div class="logo">
        Campus Clubs
    </div>

    <div class="nav-links">

        <a href="index.php">
            Home
        </a>

        <?php if (isset($_SESSION["user_id"])): ?>

            <a href="dashboard.php">
                Dashboard
            </a>

            <a href="clubs.php">
                Clubs
            </a>

            <a href="events.php">
                Events
            </a>

            <a href="logout.php">
                Logout
            </a>

        <?php else: ?>

            <a href="login.php">
                Login
            </a>

            <a href="register.php">
                Register
            </a>

        <?php endif; ?>

    </div>

</nav>


<!-- MAIN CONTENT -->

<div class="container">

    <h1>Campus Clubs</h1>

    <p class="muted">
        Explore campus clubs and join the communities you are interested in.
    </p>


    <!-- FLASH MESSAGE -->

    <?php if ($flash): ?>

        <div class="alert <?= $flash_type === "error" ? "error" : "" ?>">

            <?= htmlspecialchars($flash) ?>

        </div>

    <?php endif; ?>


    <!-- SEARCH & FILTER -->

    <form method="GET" class="search">

        <input
            type="text"
            name="search"
            placeholder="Search clubs..."
            value="<?= htmlspecialchars($search) ?>"
        >

        <select name="category">

            <option value="0">
                All Categories
            </option>

            <?php while ($category = $categories->fetch_assoc()): ?>

                <option
                    value="<?= $category["category_id"] ?>"
                    <?= ($category_id == $category["category_id"]) ? "selected" : "" ?>
                >

                    <?= htmlspecialchars($category["category_name"]) ?>

                </option>

            <?php endwhile; ?>

        </select>

        <button type="submit" class="btn">
            Search
        </button>

    </form>


    <!-- CLUB CARDS -->

    <div class="grid">

        <?php if ($clubs->num_rows > 0): ?>

            <?php while ($club = $clubs->fetch_assoc()): ?>

                <div class="card">

                    <span class="badge">

                        <?= htmlspecialchars(
                            $club["category_name"] ?? "General"
                        ) ?>

                    </span>


                    <h2>

                        <?= htmlspecialchars(
                            $club["club_name"]
                        ) ?>

                    </h2>


                    <p>

                        <?= htmlspecialchars(
                            $club["description"]
                        ) ?>

                    </p>


                    <p class="muted">

                        <strong>Coordinator:</strong>

                        <?= htmlspecialchars(
                            $club["coordinator"]
                        ) ?>

                        <br>

                        <strong>Members:</strong>

                        <?= (int)$club["members"] ?>

                    </p>


                    <?php if (isset($_SESSION["user_id"])): ?>

                        <div class="actions">

                            <a
                                class="btn"
                                href="join-club.php?id=<?= (int)$club["club_id"] ?>"
                            >
                                Join Club
                            </a>

                        </div>

                    <?php else: ?>

                        <a
                            class="btn"
                            href="login.php"
                        >
                            Login to Join
                        </a>

                    <?php endif; ?>

                </div>

            <?php endwhile; ?>

        <?php else: ?>

            <div class="card">

                <h2>No clubs found</h2>

                <p class="muted">

                    Try another search keyword or category.

                </p>

            </div>

        <?php endif; ?>

    </div>

</div>


<!-- FOOTER -->

<div class="footer">

    Campus Club Management System • PHP + MySQL

</div>

</body>

</html>