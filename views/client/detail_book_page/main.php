<?php
session_start();
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<?php
    $book_id = $_GET["id"]; 
    require ('../../../data/config.php'); 

    $sql = "SELECT name, price, description, link_image, published_at from book where id = $book_id";
    $res = $mysql_db -> query($sql);

    $name_book ="";
    $price ="";
    $published ="";
    $link = "";
    while ($row = $res->fetch_assoc()){
        $name_book = $row['name'];
        $price = $row['price'];
        $description = $row['description'];
        $published = $row['published_at'];
        $link = $row['link_image'];
    }

    // get author
    $author="";
    $sql = "SELECT author from written_by where book_id = $book_id";
    $res = $mysql_db -> query($sql);
    while ($row = $res -> fetch_assoc()){
        $author.=' - ' . $row['author']; 
    }

    // submit review
    $qualityStar = 0;
    $contentReview = "";
    $name_cus = "Customer - Not login";

    if (isset($_POST['submit'])){

        if (!isset($_SESSION['email'])) {
            header('Location: ../authenticate/login.php');
            exit();
        }

        $name_cus = $_SESSION['name'];
        $id_cus = -1;
        // get id by name
        $sql = "SELECT id FROM customer where name LIKE '$name_cus' ";
        $res = $mysql_db -> query($sql);
        while ($row = $res -> fetch_assoc()){
            $id_cus = $row['id'];
        }
        
        if ($_POST['star']==0){
            $qualityStar =  5;    
        } else {
            $qualityStar =  6 - $_POST['star'];
        }
        $contentReview = $_POST['content'];

        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $day = date('Y-m-d H:i:s');

        $sql = "INSERT INTO reviewed_by(book_id,customer_id,quality,date_review,content)
                VALUES ($book_id,$id_cus,$qualityStar,'$day','$contentReview')";
        
        $res = $mysql_db -> query($sql);
    }

    // get address and quality
    $quality = 0;
    $address = "";

    if (isset($_POST['add_to_card'])){  // sẽ gửi book_id, $quality, $address
        $quality = $_POST['qty'];
        $address = $_POST['address'];  
        
    }

?>

<!-- prevent resubmit -->
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>


<link rel="stylesheet" href="../../../assets/css/detail_book_page/detail_book.css">
<div class="container-fluid" style="margin-top: 100px">
    <div class="row">
        <div class="col-md-9" id="thumb">
            <div class="row">
                <div class="col-md-6">
                    <div class="fotorama" data-nav="thumbs">    
                        <?php
                            $sql = "SELECT link from image_foto where book_id = $book_id";
                            $res = $mysql_db -> query($sql);
                            while ($row = $res -> fetch_assoc()){
                        ?>
                            
                            <img src=" <?php echo $row['link'] ?> " alt="image">
                        <?php
                            }
                        ?>
                    </div>

                   

                </div>
                <div class="col-md-6">
                    <div class="infor_product">
                        <h4 class="titlebook"> <?php echo $name_book ?> </h4>
                        <h6 class="author">Author: <span> <?php echo $author ?> </span></h6>

                        <?php
                            $sum = 0;
                            $count = 0;
                            $sql = "SELECT quality FROM reviewed_by where book_id = $book_id";
                            $res = $mysql_db -> query($sql);
                            while ($row = $res->fetch_assoc()){
                                $sum += $row['quality'];
                                $count++;
                            }
                            if ($count==0){
                                $avr = 0;
                            } 
                            else {
                                $avr = (int)($sum/$count);
                            }
                        ?>

                        <div class="viewrating">
                            <?php
                                $n = $avr;
                                $output = "";
                                for ($i=0; $i<$n; $i++){
                                    $output .= "
                                        <span class='fa fa-star fa-1x checked'></span>";
                                }
                                for ($i=0; $i<5-$n; $i++){
                                    $output .= "
                                        <span class='fa fa-star fa-1x'></span>";
                                }
                                echo $output;
                            ?>
                        </div>
                        <div class="price">
                            <h4>$ <?php echo $price ?> </h4>
                        </div>
                        <div class="line_1"></div>
                        <div class="description">
                            <p> Publication date: <?php echo $published ?> </p>
                        </div>
                        <div class="line_1"></div>



                        <div class="address">
                            <form action="#" method="post">
                            <label for="addr">Address delivery</label>
                                <select class="form-control hidden-city" id="address" name="address">
                                    <option>An Giang</option>
                                    <option>Bac Ninh</option>
                                    <option>Ben Tre</option>
                                    <option>Ca Mau</option>
                                    <option>Can Tho</option>
                                    <option>Da Nang</option>
                                    <option>Dong Nai</option>
                                    <option>Ha Noi</option>
                                    <option>Khanh Hoa</option>
                                    <option>Kien Giang</option>
                                    <option>Long An</option>
                                    <option>Nam Dinh</option>
                                    <option>Nghe An</option>
                                    <option>Ninh Binh</option>
                                    <option>Quang Binh</option>
                                    <option>Quang Nam</option>
                                    <option>Quang Ngai</option>
                                    <option>Thanh Hoa</option>
                                    <option>Tien Giang</option>
                                    <option selected="selected">TP Ho Chi Minh</option>
                                    <option>Tra Vinh</option>
                                    <option>Vinh Long</option>
                                    <option>Vinh Phuc</option>
                                    <option>Yen Bai</option>
                                </select>
                                <br>
                                <p>Ship charges: <span>$2</span></p>
                                <div class="line_1"></div>

                                <div class=row>
                                    <div class="col-md-5">
                                        <span>Quantity</span>
                                        <input id="qty" class="input-text qty hidden-quantity" name="qty" min="1" value="1" title="Qty" type="number">
                                    </div>
                                    <div class="col-md-5" style="display:inline-block">
                                        <input name="add_to_card" type="submit" value="ADD TO CART" class="btn btn-primary btn-add-to-cart" style="margin-top: 8%;">

                                        <input type='hidden' class='hidden-name' name='hidden_img' value='<?php echo $name_book ?>'/>
                                        <input type='hidden' class='hidden-id' name='hidden_id' value='<?php echo $book_id ?>'/>
                                        <input type='hidden' class='hidden-image' name='hidden_image' value='<?php echo $link ?>'/>
                                        <input type='hidden' class='hidden-price' name='hidden_price' value='<?php echo $price ?>'/>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                            
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class=row>
                <div class="tabproduct col-md-12">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a id="tab1" class="nav-link active" data-toggle="tab" role="tab" href="#detailproduct">Detail</a>
                        </li>
                        <li class="nav-item">
                            <a id="tab2" class="nav-link" data-toggle="tab" role="tab" href="#reviewproduct">Reviews</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="detailproduct" role="tabpanel" aria-labelledby="tab1">
                            <p> <?php echo $description ?> </p>
                        </div>
                        <div class="tab-pane fade" id="reviewproduct" role="tabpanel" aria-labelledby="tab2">
                           
                            <div class="reviewed">
                                <h4 style="margin-top: 3%; margin-bottom: 2%;">You're reviewing</h4>
                                <div class="row" style="margin-top: 2%;">
                                    <div class="col-md-12">
                                        <div class="stars">
                                            <form action="" method="POST">
                                                <div class="row">
                                                    <div class = "col-md-3">
                                                        <h6>Quality</h6>
                                                        <input class="star star-1" id="star-1" type="radio" name="star" value="1" checked/>
                                                        <label class="star star-1" for="star-1"></label>
                                                        <input class="star star-2" id="star2" type="radio" name="star" value="2"/>
                                                        <label class="star star-2" for="star2"></label>
                                                        <input class="star star-3" id="star-3" type="radio" name="star" value="3"/>
                                                        <label class="star star-3" for="star-3"></label>
                                                        <input class="star star-4" id="star-4" type="radio" name="star" value="4"/>
                                                        <label class="star star-4" for="star-4"></label>
                                                        <input class="star star-5" id="star-5" type="radio" name="star" value="5"/>
                                                        <label class="star star-5" for="star-5"></label>   
                                                    </div>
                                                    <div class = "col-md-9"></div>
                                                </div>
                                                <br>
                                                <label for="contentreview">
                                                <h6>Review</h6>
                                                </label>
                                                <textarea class="form-control" id="contentreview" name="content" rows="5"></textarea>

                                                <input name="submit" type="submit" value="Submit review" class="btn btn-primary" style="margin-top: 2%;">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-9"></div>


                                </div>
                            </div>

                            <div class="line_1"></div>

                            <div class="row">
                                <h4 class="titlereview col-md-12">Customer Reviews</h4>
                            </div>

                            <?php
                                $sql = "SELECT * 
                                FROM reviewed_by r, customer c
                                WHERE r.customer_id = c.id AND r.book_id = $book_id 
                                ORDER BY date_review DESC";
                                $res = $mysql_db -> query($sql);
                                while ($row = $res -> fetch_assoc()){
                            ?>

                            <div class="row">
                                <div class="customer col-md-12">
                                    <h6> <?php echo $row['name'] ?> </h6>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="row" style="margin-bottom: 1%;">
                                                <div class="col-md-3">
                                                    Quality
                                                </div>
                                                <div class="col-md-9">

                                                    <?php
                                                        $n = $row['quality'];
                                                        $output = "";
                                                        for ($i=0; $i<$n; $i++){
                                                            $output .= "
                                                            <span class='fa fa-star fa-1x checked'></span>";
                                                        }
                                                        for ($i=0; $i<5-$n; $i++){
                                                            $output .= "
                                                            <span class='fa fa-star fa-1x'></span>";
                                                        }
                                                        echo $output;
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="row" style="margin-bottom: 1%;">
                                                <div class="col-md-3">
                                                </div>
                                                <div class="col-md-9">
                                                </div>
                                            </div>
                                            <div class="row" style="margin-bottom: 1%;">
                                                <div class="col-md-3">
                                                    Review:
                                                </div>
                                                <p>
                                                    <?php echo $row['content'] ?>
                                                </p>
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="inforrating">
                                                <p>
                                                    Review by: <?php echo $row['name'] ?>
                                                </p>
                                                <p>
                                                    Posted on: <?php echo $row['date_review'] ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line_1"></div>
                                </div>
                            </div>

                            <?php 
                                }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>      
        $(".btn-add-to-cart").click(function(event) {                                           
            // let id = this.className.split('-');
            // id = id[id.length - 1];
            let id = $('.hidden-id').val();
            let name = $('.hidden-name').val();
            let price = $('.hidden-price').val();
            let image = $('.hidden-image').val();
            let quantity = $('.hidden-quantity').val();
            let city = $('.hidden-city').val();
            $.ajax({
                type: 'POST',
                url: "../cart/process-cart.php",
                data: { id, name, price, image, quantity, city },
                success: function(mesg){
                    if (mesg == 'error') {                      
                        return;
                    }            
                    toastr.options = {
                        "debug": false,
                        "positionClass": "toast-top-full-width",
                        "onclick": null,
                        "fadeIn": 300,
                        "fadeOut": 600,
                        "timeOut": 2000,
                        "extendedTimeOut": 1000
                    }
                toastr.success('Add product to cart successfully');   
                console.log(mesg)          
                }  
            })                   

            event.preventDefault();
            return false;
        });                      
</script>
