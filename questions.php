<div class="container">

    <div class="row">
        <div class="col-8">
            <h1 class="heading">Questions</h1>
            <?php
            include("./common/db.php");
            
            // Initialize variables
            $query = "";
            $cid = isset($_GET["c-id"]) ? (int)$_GET["c-id"] : 0;
            $uid = isset($_GET["u-id"]) ? (int)$_GET["u-id"] : 0;
            $search = isset($_GET["search"]) ? $conn->real_escape_string($_GET["search"]) : '';
            $currentUserId = isset($_SESSION['user']['user_id']) ? (int)$_SESSION['user']['user_id'] : 0;

            // Build query based on parameters
            if ($cid > 0) {
                $query = "SELECT * FROM questions WHERE category_id = $cid";
            } else if ($uid > 0) {
                $query = "SELECT * FROM questions WHERE user_id = $uid";
            } else if (isset($_GET["latest"])) {
                $query = "SELECT * FROM questions ORDER BY id DESC";
            } else if (!empty($search)) {
                $query = "SELECT * FROM questions WHERE title LIKE '%$search%'";
            } else {
                $query = "SELECT * FROM questions";
            }

            $result = $conn->query($query);
            if ($result) {
                foreach ($result as $row) {
                    $title = htmlspecialchars($row['title']);
                    $id = (int)$row['id'];
                    echo "<div class='row question-list'>";
                    echo "<h4 class='my-question'><a href='?q-id=$id'>$title</a>";
                    // Show delete button only if user owns the question
                    if ($currentUserId > 0 && $currentUserId === (int)$row['user_id']) {
                        echo "<a href='./server/requests.php?delete=$id'>Delete</a>";
                    }
                    echo "</h4></div>";
                }
            }
            ?>
        </div>
        <div class="col-4">
            <?php include('categorylist.php'); ?>
        </div>
    </div>
</div>