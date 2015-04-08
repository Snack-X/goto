<?php require "../goto.php";

Router::get ("/admin",        "admin", "index");
Router::get ("/admin/login",  "admin", "login");
Router::post("/admin/login",  "admin", "login_process");
Router::get ("/admin/logout", "admin", "logout");

Router::get ("/admin/travel",              "admin", "travel");
Router::get ("/admin/travel/create",       "admin", "travel_create");
Router::post("/admin/travel/create",       "admin", "travel_create_process");
Router::get ("/admin/travel/update/(\d+)", "admin", "travel_update");
Router::post("/admin/travel/update/(\d+)", "admin", "travel_update_process");
Router::get ("/admin/travel/delete/(\d+)", "admin", "travel_delete");

Router::get ("/admin/write/checkin", "admin", "write_checkin");
Router::post("/admin/write/checkin", "admin", "write_checkin_process");
Router::get ("/admin/write/note",    "admin", "write_note");
Router::post("/admin/write/note",    "admin", "write_note_process");

Router::get ("/api/travel",               "api", "travel_list");
Router::get ("/api/travel/([a-z0-9-_]+)", "api", "note_list");
Router::post("/api/checkin",              "api", "write_checkin");
Router::post("/api/note",                 "api", "write_note");

Router::last("public", "error");

Router::run();