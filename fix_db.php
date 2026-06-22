<?php
$db = new SQLite3('writable/database.db');
$db->exec("DELETE FROM appointments WHERE id NOT IN (SELECT MIN(id) FROM appointments WHERE status='confirmed' GROUP BY patient_id, doctor_id, appointment_date)");
echo "Done";
