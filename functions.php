<?php
function log_action($pdo, $type, $id, $action) {
    $pdo->prepare("INSERT INTO logs (user_type, user_id, action, timestamp) VALUES (?, ?, ?, NOW())")
        ->execute([$type, $id, $action]);
}
