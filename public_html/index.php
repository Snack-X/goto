<?php require "../goto.php";

Router::on("get",  "/admin",        "admin", "index");
Router::on("get",  "/admin/login",  "admin", "login");
Router::on("post", "/admin/login",  "admin", "login_process");
Router::on("get",  "/admin/logout", "admin", "logout");

Router::on("get",  "/admin/travel",              "admin", "travel");
Router::on("get",  "/admin/travel/create",       "admin", "travel_create");
Router::on("post", "/admin/travel/create",       "admin", "travel_create_process");
Router::on("get",  "/admin/travel/update/(\d+)", "admin", "travel_update");
Router::on("post", "/admin/travel/update/(\d+)", "admin", "travel_update_process");
Router::on("get",  "/admin/travel/delete/(\d+)", "admin", "travel_delete");

Router::on("get",  "/admin/write/checkin", "admin", "write_checkin");
Router::on("post", "/admin/write/checkin", "admin", "write_checkin_process");
Router::on("get",  "/admin/write/note",    "admin", "write_note");
Router::on("post", "/admin/write/note",    "admin", "write_note_process");

Router::on("get",  "/error",               "public", "error");
Router::on("get",  "/",                    "public", "travel_list");
Router::on("get",  "/([a-z0-9-_]+)",       "public", "note_list");
Router::on("get",  "/([a-z0-9-_]+)/(\d+)", "public", "note_view");

Router::last("public", "error");

Router::run();