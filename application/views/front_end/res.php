<!--::regervation_part start::-->
<section class="regervation_part section_padding" id="regervation_part" style="
    padding-bottom: 60px;
    padding-top: 60px;
">
        <div class="container">
            <div class="row">
                <div class="col-xl-5">
                    <div class="section_tittle">
                        <p>Reservation</p>
                        <h2>Book A Table</h2>
                    </div>
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="regervation_part_iner">
                        <form  id="reservation_form" action="#" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input name="name" type="text" class="form-control" id="inputEmail4" placeholder="Name *" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <input name="email" type="email" class="form-control" id="inputPassword4" placeholder="Email address *" required>
                                </div>
                                <div class="form-group col-md-6">
									<input type="text" name="capacity" class="form-control" id="capacity" placeholder="No. of Persons *" required>   
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" name="phone" class="form-control" id="pnone" placeholder="Phone number *" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="input-group date">
                                        <input name="dt" id="datepicker" type="text" class="form-control" placeholder="Date *"  required>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <select name="time" class="form-control" id="Select2" required>
                                        <option value="" selected>Time *</option>
                                        <option value="1">8 AM TO 10AM</option>
                                        <option value="1">10 AM TO 12PM</option>
                                        <option value="1">12PM TO 2PM</option>
                                        <option value="1">2PM TO 4PM</option>
                                        <option value="1">4PM TO 6PM</option>
                                        <option value="1">6PM TO 8PM</option>
                                        <option value="1">4PM TO 10PM</option>
                                        <option value="1">10PM TO 12PM</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea name="message" class="form-control" id="Textarea" rows="4" placeholder="Your Note *"></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="regerv_btn">
								<input id="reservesubmitBtn" value="book a table" name="Confirm" type="submit" class="btn_4"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--::regervation_part end::-->