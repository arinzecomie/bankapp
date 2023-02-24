<?php
session_start();
?>
<?php

include('../library/library.php');
?>



<?php
$title= "Bizrator-Online Digital Printing";
$meta_key = "Bizrator, printing, branding";
$meta_desc = "Bizrator, printing, branding";
main_menu("$title", "$meta_key", "$meta_desc", "../")
?>

                  <div class="container">
                    <div class="row">

                        <div class="col-md-8">
                            <h3>Drop us a line</h3>
                            <form  id="contact_msg" class="ajax-form" method="post" action="../contact/send_msg.php">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Name..." value="" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Your email..." value="" required>
                                </div>
                                <div class="form-group">
                                    <input type="phone" class="form-control" id="phone" name="phone" placeholder="Your phone..." value="" required>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" rows="4" name="msg" placeholder="Your message..." required></textarea>
                                </div>
                                <div class="form-group">
								<input type="hidden" name="submit_contact"/>
                                    <button onclick="ajax_sub('contact_msg');" type="submit" name="submit_contact" class="site-btn"><i class="fa fa-paper-plane fa-fw"></i> Send</button>
                                </div>
                            </form>
							
                        </div><!-- /.contact-form -->

						
						
						
                        <div class="col-md-4 contact-address">
						<h4> Contact Us </h4>
                            <ul>
                                <li><i class="fa fa-envelope fa-fw"></i>contact@bizrator.com</li>
                                <li><i class="fa fa-phone fa-fw">+2348160738496</i></li>
                            </ul>
                        </div><!-- /.contact-address -->

                    </div><!-- /.row -->
                </div><!-- /.container -->


<?php 
footer("../");
?>