<?php

require __DIR__ . '/includes/database.php';

$conn = db();
if (!$conn) {
  fwrite(STDERR, "DB_CONNECT_FAILED\n");
  exit(2);
}

$res = $conn->query('SHOW TABLES');
if (!$res) {
  fwrite(STDERR, 'QUERY_FAILED: ' . $conn->error . "\n");
  exit(3);
}

while ($row = $res->fetch_row()) {
  echo $row[0] . "\n";
}
