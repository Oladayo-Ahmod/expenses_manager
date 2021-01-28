<?php
     include '../model/modal.php';
     // starting session
     session_start();
     if (strlen($_SESSION['id']) == 0) {
         header('location:../index.php');
     }  
    
     //deleting 
         //check if category id is set
         if (isset($_GET['cat'])) {
             //setting the id
             $id = $_GET['cat'];
             $modal = new Model;
             $delete = $modal->delete($id);

         }
?>