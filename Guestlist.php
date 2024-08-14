<?php
require 'vendor/autoload.php';

use Aws\DynamoDb\DynamoDbClient;
use Aws\DynamoDb\Exception\DynamoDbException;

// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "Please log in first to see the guest list.";
    exit;
}

// Set up AWS DynamoDB client
$client = new DynamoDbClient([
    'region'  => 'us-east-1',
    'version' => 'latest',
    'credentials' => [
        'key'    => 'aws-access-key', //input your aws access key
        'secret' => 'aws-secret-key', //input your aws secret key
    ],
]);

$tableName = 'GuestBook';

try {
    $result = $client->scan([
        'TableName' => $tableName
    ]);

    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Guest List</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .container {
                width: 80%;
                max-width: 1000px;
                background-color: #ffffff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                text-align: center;
            }
            h2 {
                color: #333;
                margin-bottom: 20px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            th, td {
                padding: 12px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }
            th {
                background-color: #007bff;
                color: #ffffff;
            }
            tr:hover {
                background-color: #f1f1f1;
            }
            .no-guests {
                color: #666;
                font-size: 18px;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <h2>Guest List</h2>";

    if (count($result['Items']) > 0) {
        echo "<table>
            <tr>
                <th>Email</th>
                <th>Name</th>
                <th>Country</th>
            </tr>";

        foreach ($result['Items'] as $item) {
            $email = $item['Email']['S'];
            $name = $item['Name']['S'];
            $country = $item['Country']['S'];
            echo "<tr>
                <td>{$email}</td>
                <td>{$name}</td>
                <td>{$country}</td>
            </tr>";
        }

        echo "</table>";
    } else {
        echo "<div class='no-guests'>No guests found in the GuestBook.</div>";
    }

    echo "</div>
    </body>
    </html>";

} catch (DynamoDbException $e) {
    echo "Unable to query DynamoDB: " . $e->getMessage();
}
