<?php
// Test 1: Payment approved (simplified mock)
$amount = 9999;
if ($amount > 0 && $amount < 10000) {
    echo "Test 1 PASS: Payment approved\n";
} else {
    echo "Test 1 FAIL: Payment declined\n";
}
?>