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
             // setting the user id
             $user_id = $_SESSION['id'];
             $modal = new Model;
             $delete = $modal->delete($id,$user_id);
         }
          //check if category id is set
          if (isset($_GET['exp'])) {
            //setting the id
            $id = $_GET['exp'];
            // setting the user id
            $user_id = $_SESSION['id'];
            $modal = new Model;
            $delete = $modal->delete($id,$user_id);

        }
?>