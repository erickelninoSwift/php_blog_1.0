<?php 
include "../config/config.php";

   $all_categories = [];

   $query_fetch_category = $connection->query("SELECT * FROM categories");
   $query_fetch_category->execute();
   $all_categories = $query_fetch_category->fetchAll(PDO::FETCH_ASSOC);