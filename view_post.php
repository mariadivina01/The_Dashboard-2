    <?php
    
    include'core/init.php';

    $general->logged_out_protect();
     
    $username = $user['username']; // using the $user variable defined in init.php and getting the username.

    $p_data=array();

    $user_id = $users->fetch_info('id', 'username', $username); // Getting the user's id from the username in the Url.

    $post_id = $_GET['post_id'];
    
    $profile_data = $users->userdata($user_id);

    $p_data = $users->post_data1($post_id);

    $comments = $users->get_comments($p_data['post_id']);
     
    ?>


<!DOCTYPE html>
<html>
<head>
<title>Cookies</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css'/>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>

<script src="js/jquery-1.11.0.min.js"></script>
</head>
<body>
<!--topheader starts-->  
<div class="top-header">  
   <div class="container">
     <div class="top-menu">
       <span class="menu"> </span>
       <ul>
         <li class="active"><a href="index.php">HOME</a></li>
         <li><a href="searchs.php">SEARCH</a></li>
         <li><a href="your_posts.php">ITEMS FOR SALE</a></li>
         <li><a href="add_post_2.php">SELL ITEMS</a></li>
         <li><a href="logout.php">LOGOUT</a></li>
          <div class="clearfix"></div>
       </ul>  
        <script>
          $("span.menu").click(function(){
            $(".top-menu ul").slideToggle(200);
          });
        </script>

     </div>
    </div>  
</div>  

    <div class="container">

      <div class="row">

        <div class="col-md-3">
          <p class="lead"></p>
       
      
          <div class="list-group">
            <a href="#" class="list-group-item">Categories</a>
            <a href="#" class="list-group-item">Phone</a>
            <a href="#" class="list-group-item">Vehicles</a>
            <a href="#" class="list-group-item">Clothes</a>
            <a href="#" class="list-group-item">Electronics</a>
          </div>
          <p>
            
  
      </p>
    

        </div>

        <div class="col-md-9">

          <div class="col-md-15 col-md-offset-1">

        
              </form>
          </ul> 
          <div class="panel-body">
            
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-8"><!-- dri ibutang ang code sa setting plss h1 ang code lang. -->
                    

                <?php

                if(isset($_POST['delete']))
                {
                  $users->delete_post1($p_data['post_id']);
                  header('Location: view_post.php?success');
                  exit();
                }

                if (isset($_POST['comment'])) 
                {
                  // echo '<h3>You added a comment to this post.</h3>'; 
                  $description = htmlentities(trim($_POST['description']));

                  $filter->strings = array('','','', '', '','');

                  $filter->text = $_POST['description'];

                  $filter->keep_first_last = false;

                  $filter->replace_matches_inside_words = false;

                  $description = $filter->filter();

                  $users->add_comment($user_id,$p_data['post_id'],$description);

                  header('Location: view_post.php?post_id='.$post_id);
                  exit();

                }

                ?>
                
                
                <?php 


                  if (isset($_GET['success']) && empty($_GET['success'])) {
                  echo '<h3>Your product has been deleted!  </h3>';    
                  }

                  else
                  {
                    echo '<form method="POST" action="">';
                    
                    $image = $p_data['image_location'];
                    echo "<img src='$image'>".'<br />';
                    echo 'Name: '.$p_data['name'].'<br />';
                    echo 'Price: '.$p_data['price'].'<br />';
                    echo 'Category: '.$p_data['category'].'<br />';
                    echo 'Description: '.$p_data['description'].'<br />';
                    echo '<a href="your_posts.php?username='.$user['username'].'"><button type="submit" id='.$p_data['post_id'].' name="delete" class="deleteBtn btn btn-default">Mark as done</button></a>';
                    echo '<form/>';
                  
                ?> 

                <hr />

                <h4>Comments</h4>

                          

                <?php 

                    if(empty($comments))
                    {
                      echo 'There are no comments on this post...';
                    }

                    else
                    {

                      foreach ($comments as $c) {

                      <div class="panel panel-default">
                      <div class="panel-heading">
                      <h3 class="panel-title">echo $username.' said at '.date('m/d/Y H:i A', strtotime($c['time_added'])).'<br />&nbsp;'</h3>;
                      </div>
                      <div class="panel-body">
                      echo $c['comment'].'<br />';
                      echo '<hr />';
                      </div>
                    }
                    }

                 ?> 
                   <div class="panel panel-default">
                    <div class="panel-heading">Panel heading without title</div>
                    <div class="panel-body">
                     Panel content
                    </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Panel title</h3>
  </div>
  <div class="panel-body">
    Panel content
  </div>
</div>

                <br />

                <hr />
                <!-- <p><strong><?php echo $row['username']; ?></strong> said at <?php echo date('m/d/Y H:i A', strtotime($row['date_added'])) ?><br /></p> -->

                <form action="" method="post" id="form" enctype="multipart/form-data">
          
                      <div class="form-group">
                        <div class="controls">
                               <label for="exampleInputPassword1">Add Comment</label>
                         </div>
                        <textarea class="form-control"  name="description" placeholder="Add Comment."></textarea>
                        <!-- <input name="description" type="text" class="form-control" id="exampleInputPassword1" placeholder="Description"> -->
                      </div>
                      <button type="submit" name = "comment" id="submit" class="btn btn-primary" >Add Comment</button>
                      <button type="reset" name = "cancel" class="btn btn-default">Cancel</button>
                </form>

              <?php } ?>

              </div>
        </div>
        
        </div>
      </div>
      </div>

        </div>

      </div>
       

    </div><!-- /.container -->
    
    <div class="container">

      <hr>

      <footer>
        <div class="row">
          <div class="col-lg-12">
            <p>Copyright @ CesBuy 2014</p>
            </div>
        </div>
      </footer>

    </div><!-- /.container -->

    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

  </body>
</html>
