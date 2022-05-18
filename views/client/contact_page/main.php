 <link rel="stylesheet" href="../../../assets/css/contact_page/main.css">
 <main class="contact_area margin-top">
     <!-- Content -->
     <section class="contact_content">
         <div class="container">
             <div class="row">
                 <div class="col-md-8 col-12 my-md-5 my-3">
                     <section class="contact_form_wrapper">
                         <h3>Fill in information</h3>
                         <form id="contactForm" method="POST">
                             <div class="form-row">
                                 <div class="form-group col-md-6" id="formFirstName">
                                     <label for="inputFirstName">First Name*:</label>
                                     <input type="text" class="form-control" id="inputFirstname" placeholder="Chung"
                                         value="">
                                     <!-- <small><i class="fas fa-exclamation-triangle"></i> sdfsdajjdlsf</small> -->
                                 </div>
                                 <div class="form-group col-md-6" id="formLastName">
                                     <label for="inputLastName">Last Name*:</label>
                                     <input type="text" class="form-control" id="inputLastName" placeholder="Nguyen">
                                 </div>
                             </div>
                             <div class="form-row">
                                 <div class="form-group col-md-6" id="formEmail">
                                     <label for="inputEmail">Email*:</label>
                                     <input type="email" class="form-control" id="inputEmail"
                                         placeholder="xxxx@gmail.com">
                                 </div>
                                 <div class="form-group col-md-6" id="formWebsite">
                                     <label for="inputWebsite">Website:</label>
                                     <input type="text" class="form-control" id="inputWebsite"
                                         >
                                 </div>
                             </div>
                             <div class="form-group" id="formSubject">
                                 <label for="inputSubject">Subject:</label>
                                 <input type="text" class="form-control" id="inputSubject">
                             </div>
                             <div class="form-group" id="formMessage">
                                 <label for="inputMessage">Type your message here*:</label>
                                 <textarea id="inputMessage" class="form-control" rows="8"></textarea>
                             </div>
                             <div class="d-flex justify-content-center">
                                 <button type="button" class="btn btn-primary mt-2" name="btn_send_email"
                                     id="btn_send_email" onclick="send_mail()">
                                     Submit
                                 </button>
                                 <div class="spinner-border mt-2 ml-2" id="spinnerEmail" role="status">

                                 </div>
                             </div>

                         </form>
                     </section>
                 </div>
                 <div class="col-md-4 col-12 my-md-5 my-3">
                     <section class="office_info">
                         <h6 class="text-uppercase fw-bold mb-4">
              Contact
            </h6>
            <p><i class="fa fa-home me-3"></i> Q.3, HCM, VN</p>
            <p>
              <i class="fa fa-envelope me-3"></i>
              bookstore@example.com
            </p>
            <p><i class="fa fa-phone me-3"></i> + 01 234 567 88</p>
            <p><i class="fa fa-print me-3"></i> + 01 234 567 89</p>
                     </section>

                 </div>

             </div>
         </div>
     </section>
     <!-- end content -->
 </main>
 <script>
     function send_mail(){
        alert('Thank you for responding!!!')
     }
 </script>
 <script src="../../../assets/js/contact_page/postEmail.js"></script>
