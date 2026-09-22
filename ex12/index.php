<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library - Book List</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 40px;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
        }
        .table-container {
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }
        th, td {
            padding: 14px 18px;
        }
        th {
            background-color: #007bff;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        tr:hover {
            background-color: #f1f3f5;
        }
        td {
            border-bottom: 1px solid #dee2e6;
            font-size: 0.95rem;
        }
        .price-col {
            font-weight: bold;
            color: #28a745;
        }
    </style>
</head>
<body>

    <h2> Library Book Details</h2>

    <div class="table-container">
        <table>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Year</th>
                <th>Price</th>
            </tr>
            <?php
            // Load the XML file safely
            $xml = simplexml_load_file("books.xml") or die("<tr><td colspan='4' style='color:red; text-align:center;'>Error: Cannot load XML file.</td></tr>");

            // Loop through each <book> element and display details in table rows
            foreach ($xml->book as $book) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($book->title) . "</td>";
                echo "<td>" . htmlspecialchars($book->author) . "</td>";
                echo "<td>" . htmlspecialchars($book->year) . "</td>";
                echo "<td class=\"price-col\">$" . htmlspecialchars($book->price) . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

</body>
</html>