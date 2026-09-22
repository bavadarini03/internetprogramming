<?php

require_once "config/auth.php";
require_once "config/database.php";

// Flash message
$flash = $_SESSION["flash"] ?? "";
$flash_type = $_SESSION["flash_type"] ?? "success";

unset($_SESSION["flash"]);
unset($_SESSION["flash_type"]);

// Get upcoming events
$sql = "
    SELECT
        e.event_id,
        e.event_name,
        e.description,
        e.event_date,
        e.event_time,
        e.venue,
        e.max_participants,
        e.registration_deadline,
        c.club_name,

        (
            SELECT COUNT(*)
            FROM event_registrations er
            WHERE er.event_id = e.event_id
        ) AS registered

    FROM events e

    INNER JOIN clubs c
        ON e.club_id = c.club_id

    WHERE e.event_date >= CURDATE()

    ORDER BY e.event_date ASC, e.event_time ASC
";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Campus Events</title>

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

    <h1>Upcoming Events</h1>

    <p class="muted">
        Explore upcoming campus events and register for activities.
    </p>


    <!-- FLASH MESSAGE -->

    <?php if ($flash): ?>

        <div class="alert <?= $flash_type === "error" ? "error" : "" ?>">

            <?= htmlspecialchars($flash) ?>

        </div>

    <?php endif; ?>


    <!-- EVENT CARDS -->

    <div class="grid">

        <?php if ($result->num_rows > 0): ?>

            <?php while ($event = $result->fetch_assoc()): ?>

                <?php
                    $registered = (int)$event["registered"];
                    $max = (int)$event["max_participants"];

                    $full = $registered >= $max;

                    $eventDate = date(
                        "d M Y",
                        strtotime($event["event_date"])
                    );

                    $eventTime = date(
                        "h:i A",
                        strtotime($event["event_time"])
                    );
                ?>

                <div class="card">

                    <span class="badge">

                        <?= htmlspecialchars(
                            $event["club_name"]
                        ) ?>

                    </span>


                    <h2>

                        <?= htmlspecialchars(
                            $event["event_name"]
                        ) ?>

                    </h2>


                    <p>

                        <?= htmlspecialchars(
                            $event["description"]
                        ) ?>

                    </p>


                    <p>

                        <strong>Date:</strong>
                        <?= $eventDate ?>

                        <br>

                        <strong>Time:</strong>
                        <?= $eventTime ?>

                        <br>

                        <strong>Venue:</strong>
                        <?= htmlspecialchars(
                            $event["venue"]
                        ) ?>

                    </p>


                    <p class="muted">

                        <strong>Registration:</strong>

                        <?= $registered ?>
                        /
                        <?= $max ?>

                        <br>

                        <strong>Deadline:</strong>

                        <?= date(
                            "d M Y",
                            strtotime($event["registration_deadline"])
                        ) ?>

                    </p>


                    <?php if (isset($_SESSION["user_id"])): ?>

                        <?php if ($full): ?>

                            <button
                                class="btn"
                                disabled
                                style="opacity:0.6;cursor:not-allowed;"
                            >
                                Event Full
                            </button>

                        <?php else: ?>

                            <a
                                class="btn"
                                href="register-event.php?id=<?= (int)$event["event_id"] ?>"
                            >
                                Register
                            </a>

                        <?php endif; ?>

                    <?php else: ?>

                        <a
                            class="btn"
                            href="login.php"
                        >
                            Login to Register
                        </a>

                    <?php endif; ?>

                </div>

            <?php endwhile; ?>

        <?php else: ?>

            <div class="card">

                <h2>No Upcoming Events</h2>

                <p class="muted">
                    There are currently no upcoming events.
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