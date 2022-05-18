 <link rel="stylesheet" href="../../../assets/css/about_page/main.css">
 <?php
    require_once "../../../data/config.php";
    $query = "select * from employee";
    $result = $mysql_db->query($query);

    ?>
 <main class="about_area  margin-top" style="margin-top: 100px">
     <!-- Introduction -->
     <section class="summary">
         <div class="container">
             <p style="text-align: justify;">Welcome to Bookshop!
                 Bookshop is an online bookstore with a mission to financially support local, independent bookstores.
                 We believe that bookstores are essential to a healthy culture. They’re where authors can connect with readers, where we discover new writers, where children get hooked on the thrill of reading that can last a lifetime. They’re also anchors for our downtowns and communities.
                 As more and more people buy their books online, we wanted to create an easy, convenient way for you to get your books and support bookstores at the same time.
                 If you want to find a specific local bookstore to support, find them on our map and they’ll receive the full profit off your order. Otherwise, your order will contribute to an earnings pool that will be evenly distributed among independent bookstores (even those that don’t use Bookshop).
                 We also support anyone who advocates for books through our affiliate program, which pays a 10% commission on every sale, and gives a matching 10% to independent bookstores. If you are an author, a website or magazine, have a bookclub, an organization that wants to recommend books, or even just a book-lover with an Instagram feed, you can sign up to be an affiliate, start your own shop, and be rewarded for your advocacy of books. Bookshop wants to give back to everyone who promotes books, authors, and independent bookstores!
                 By design, we give away over 75% of our profit margin to stores, publications, authors and others who make up the thriving, inspirational culture around books!
                 We hope that Bookshop can help strengthen the fragile ecosystem and margins around bookselling and keep local bookstores an integral part of our culture and communities.
                 Bookshop is a benefit corporation - a corporation dedicated to the public good.
             </p>
         </div>
     </section>
     <section class="intro_team">
         <div class="container">
             <div class="row">
                 <div class="col-12 my-md-4 my-3">
                     <section id="teamHeader" class="text-center">
                         <h3>Tearm</h3>
                     </section>
                 </div>
             </div>
             <div class="row d-flex justify-content-center">
                 <!-- "../../../assets/images/about_page/avatar1.gif" -->
                 <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                 <div class="col-md-3 col-6 my-md-4 my-3 d-flex align-items-stretch">
                     <div class="team_member card text-center border-danger">
                         <img class="card-img-top img-fluid" src=<?php echo "../../.." . $row['link_image']; ?>
                             alt="A team member">
                         <div class="card-body">
                             <h5 class="card-title"><?php echo $row['full_name']; ?></h5>
                             <h6 class="card-subtitle mb-2 text-muted"><?php echo $row['work_as']; ?></h6>
                             <nav id="nav_member">
                                 <a href=<?php echo $row["link_twitter"]; ?> class="card-link"><i
                                         class="fab fa-twitter"></i></a>
                                 <a href=<?php echo $row["link_facebook"]; ?> class="card-link"><i
                                         class="fab fa-facebook-f"></i></a>
                                 <a href=<?php echo $row["link_instagram"]; ?> class="card-link"><i
                                         class="fab fa-instagram"></i></a>
                             </nav>
                         </div>
                     </div>
                 </div>
                 <?php
                        }
                    } else {
                        ?>
                 <div>
                     <h3>There are current no experts.</h3>
                 </div>
                 <?php
                    }
                    ?>
             </div>
     </section>
 </main>