<div class="container">
    <h1 class="heading">Question</h1>
    <div class="row">
        <div class="col-8">
            <?php
            include("./common/db.php");

            // Fetching question id safely from URL
            $qid = isset($_GET['q-id']) ? intval($_GET['q-id']) : 0;

            if ($qid > 0) {
                // Get question details
                $query = "SELECT * FROM questions WHERE id = $qid";
                $result = $conn->query($query);

                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $cid = $row['category_id'];

                    echo "<h4 class='margin-bottom-15 question-title'>Question : " . $row['title'] . "</h4>
                          <p class='margin-bottom-15'>" . $row['description'] . "</p>";

                    include("answers.php");

                    // Answer submission form
                    echo '
                    <form action="./server/requests.php" method="post">
                        <input type="hidden" name="question_id" value="' . $qid . '">
                        <textarea name="answer" class="form-control margin-bottom-15" placeholder="Your answer..."></textarea>
                        <button class="btn btn-primary">Write your answer</button>
                    </form>';
                } else {
                    echo "<p>Question not found.</p>";
                }
            } else {
                echo "<p>Invalid question ID.</p>";
            }
            ?>
        </div>

        <div class="col-4">
            <?php
            if (isset($cid)) {
                // Get category name
                $categoryQuery = "SELECT name FROM category WHERE id = $cid";
                $categoryResult = $conn->query($categoryQuery);

                if ($categoryResult && $categoryResult->num_rows > 0) {
                    $categoryRow = $categoryResult->fetch_assoc();
                    echo "<h1>" . ucfirst($categoryRow['name']) . "</h1>";
                }

                // Get related questions
                $query = "SELECT * FROM questions WHERE category_id = $cid AND id != $qid";
                $result = $conn->query($query);

                if ($result && $result->num_rows > 0) {
                    foreach ($result as $row) {
                        $id = $row['id'];
                        $title = $row['title'];

                        echo "<div class='question-list'>
                            <h4><a href='?q-id=$id'>$title</a></h4>
                        </div>";
                    }
                } else {
                    echo "<p>No related questions found.</p>";
                }
            }
            ?>
        </div>
    </div>
</div>
