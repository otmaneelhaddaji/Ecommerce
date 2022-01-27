<?php require_once("../../resources/config.php");

if (isset($_GET['delete_reports_id'])) {
    $query = query("DELETE FROM reports WHERE report_id = " . escape_string($_GET['delete_reports_id']) . " ");
    confirm($query);

    set_message("Report Deleted");
    redirect("index.php?reports");
} else {
    redirect("index.php?reports");
}
