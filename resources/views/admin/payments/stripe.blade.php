<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Secure Payment Terminal</title>
    <meta name="description" content="A demo of Stripe Payment Intents">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{url('/')}}/admin/payment_terminal/css/normalize.css">
    <link rel="stylesheet" href="{{url('/')}}/admin/payment_terminal/css/global.css">
    <link rel="stylesheet" href="{{url('/')}}/admin/payment_terminal/css/font-awesome.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{url('/')}}/admin/payment_terminal/css/style.css">
    <link rel="stylesheet" href="{{url('/')}}/admin/payment_terminal/css/responsive.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <style type="text/css">
        #loading img {
            max-width: 600px;
            width: 100%;
            height: auto;
        }

        #loading {
            display: none;
        }

        @font-face {
            font-weight: 400;
            font-style: normal;
            font-family: 'Circular-Loom';

            src: url('https://cdn.loom.com/assets/fonts/circular/CircularXXWeb-Book-cd7d2bcec649b1243839a15d5eb8f0a3.woff2') format('woff2');
        }

        @font-face {
            font-weight: 500;
            font-style: normal;
            font-family: 'Circular-Loom';

            src: url('https://cdn.loom.com/assets/fonts/circular/CircularXXWeb-Medium-d74eac43c78bd5852478998ce63dceb3.woff2') format('woff2');
        }

        @font-face {
            font-weight: 700;
            font-style: normal;
            font-family: 'Circular-Loom';

            src: url('https://cdn.loom.com/assets/fonts/circular/CircularXXWeb-Bold-83b8ceaf77f49c7cffa44107561909e4.woff2') format('woff2');
        }

        @font-face {
            font-weight: 900;
            font-style: normal;
            font-family: 'Circular-Loom';

            src: url('https://cdn.loom.com/assets/fonts/circular/CircularXXWeb-Black-bf067ecb8aa777ceb6df7d72226febca.woff2') format('woff2');
        }
    </style>



    <style type="text/css">
        body #payment-form {
            font-family: "Helvetica Neue", Helvetica, sans-serif;
        }

        #payment-form form {
            padding: 30px;
            height: 120px;
            margin-bottom: 20px;
            margin-left: auto;
            margin-right: auto;
            width: 600px;
        }

        #payment-form label {
            font-weight: 500;
            font-size: 14px;
            display: block;
            margin-bottom: 8px;
        }

        #payment-form #card-errors {
            height: 20px;
            padding: 4px 0;
            color: #fa755a;
        }

        #payment-form .token {
            color: #32325d;
            font-family: 'Source Code Pro', monospace;
            font-weight: 500;
        }

        .wrapper {
            width: 90%;
            margin: 0 auto;
            height: 100%;
        }

        #stripe-token-handler {
            position: absolute;
            top: 0;
            left: 25%;
            right: 25%;
            padding: 20px 30px;
            border-radius: 0 0 4px 4px;
            box-sizing: border-box;
            box-shadow: 0 50px 100px rgba(50, 50, 93, 0.1),
                0 15px 35px rgba(50, 50, 93, 0.15),
                0 5px 15px rgba(0, 0, 0, 0.1);
            -webkit-transition: all 500ms ease-in-out;
            transition: all 500ms ease-in-out;
            transform: translateY(0);
            opacity: 1;
            background-color: white;
        }

        #stripe-token-handler.is-hidden {
            opacity: 0;
            transform: translateY(-80px);
        }

        .form-row {
            width: 70%;
            height: 100px;
            float: left;
        }

        #card-element {
            background-color: white;
            width: 400px;
            height: 50px;
            padding: 15px 12px;
            border-radius: 4px;
            border: 1px solid transparent;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .btn-Stripe {
            border: none;
            border-radius: 4px;
            outline: none;
            text-decoration: none;
            color: #fff;
            background: #32325d;
            white-space: nowrap;
            display: inline-block;
            height: 52px;
            line-height: 40px;
            padding: 0 14px;
            box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
            border-radius: 4px;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.025em;
            text-decoration: none;
            -webkit-transition: all 150ms ease;
            transition: all 150ms ease;
            float: left;
            margin-left: 12px;
            margin-top: 28px;
        }

        .btn-Stripe:hover {
            transform: translateY(-1px);
            box-shadow: 0 7px 14px rgba(50, 50, 93, .10), 0 3px 6px rgba(0, 0, 0, .08);
            background-color: #43458b;
        }

        #card-element--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        #card-element--invalid {
            border-color: #fa755a;
        }

        #card-element--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>



</head>

<body>

    <form id="payment-form" class="sr-payment-form payment-form">
        <section class="sec-1">
            <div class="container">
                <div class="pg-top">
                    <p class="title">CHECKOUT TERMINAL</p>
                    <p class="sub-title">PAY &amp; PROCEED</p>
                </div>





                <div id="loading" class="mt-5">

                    <div class="row">
                        <div class="col-3">

                        </div>

                        <div class="col-6">

                            <img src="{{url('admin/images/stripe_payment.gif')}}">
                        </div>
                        <div class="col-3">
                        </div>

                    </div>
                </div>

                <div class="row detailsDiv">
                    <div class="col-12">
                        <div class="form-group">


                            <p class="g-title">Payment Information</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="">Invoice Number</label>
                            <input type="text" name="invoice_number" id="invoice_number" readonly="" value="{{$data['invoice_number']}}" onkeyup="checkFieldBack(this);">

                            <span id="invoice_number_err" class="text-danger laravel_validation"> </span>

                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="">Amount: USD</label>
                            <input type="text" name="amount" id="amount" value="{{$data['amount_payable']}}" @php echo ($data['partial_payments']==0)?'readonly=""':'' @endphp   value="0" onkeyup="checkFieldBack(this);noAlpha(this);" onkeypress="noAlpha(this);">
                            <input type="hidden" name="currencycode" id="currencycode" value="usd">
                            <input type="hidden" name="invoice_id" id="invoice_id"  value="{{$data['invoice_id']}}" >

                            <span id="amount_err" class="text-danger laravel_validation"> </span>
                            
                        </div>
                    </div>
                </div>
                <div class="row detailsDiv" >
                    <div class="col-12">
                        <div class="form-group">
                            <p class="g-title">Billing Information</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" placeholder="Enter Your First Name" name="first_name" id="first_name" value="{{$data['client_first_name']}}" >
                        
                            <span id="first_name_err" class="text-danger laravel_validation"> </span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" placeholder="Enter Your Last Name" name="last_name" id="last_name"  value="{{$data['client_last_name']}}">

                            <span id="last_name_err" class="text-danger laravel_validation"> </span>
                        </div>
                    </div>
                    <!-- <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" placeholder="Enter Address" name="address" id="address" value="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-6">
                                <div class="form-group">
                                    <label for="">City</label>
                                    <input type="text" placeholder="Enter City" name="city" id="city" value="">
                                    <input name="ipcountry" type="hidden" value="">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-6">
                                <div class="form-group">
                                    <label for="">Country</label>
                                    <select name="country" id="country">
                                        <option value="-1">Select Country</option>
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antartica">Antartica</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Aruba">Aruba</option>
                                        <option value="Ashmore and Cartier Island">Ashmore and Cartier Island</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bermuda">Bermuda</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="British Virgin Islands">British Virgin Islands</option>
                                        <option value="Brunei">Brunei</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burma">Burma</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Cape Verde">Cape Verde</option>
                                        <option value="Cayman Islands">Cayman Islands</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Christmas Island">Christmas Island</option>
                                        <option value="Clipperton Island">Clipperton Island</option>
                                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo, Democratic Republic of the">Congo, Democratic Republic of the</option>
                                        <option value="Congo, Republic of the">Congo, Republic of the</option>
                                        <option value="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Cote d' Ivoire">Cote d'Ivoire</option>
                            <option value="Croatia">Croatia</option>
                            <option value="Cuba">Cuba</option>
                            <option value="Cyprus">Cyprus</option>
                            <option value="Czeck Republic">Czeck Republic</option>
                            <option value="Denmark">Denmark</option>
                            <option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option>
                            <option value="Dominican Republic">Dominican Republic</option>
                            <option value="Ecuador">Ecuador</option>
                            <option value="Egypt">Egypt</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Europa Island">Europa Island</option>
                            <option value="Falkland Islands (Islas Malvinas)">Falkland Islands (Islas Malvinas)</option>
                            <option value="Faroe Islands">Faroe Islands</option>
                            <option value="Fiji">Fiji</option>
                            <option value="Finland">Finland</option>
                            <option value="France">France</option>
                            <option value="French Guiana">French Guiana</option>
                            <option value="French Polynesia">French Polynesia</option>
                            <option value="French Southern and Antarctic Lands">French Southern and Antarctic Lands</option>
                            <option value="Gabon">Gabon</option>
                            <option value="Gambia, The">Gambia, The</option>
                            <option value="Gaza Strip">Gaza Strip</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option>
                            <option value="Ghana">Ghana</option>
                            <option value="Gibraltar">Gibraltar</option>
                            <option value="Glorioso Islands">Glorioso Islands</option>
                            <option value="Greece">Greece</option>
                            <option value="Greenland">Greenland</option>
                            <option value="Grenada">Grenada</option>
                            <option value="Guadeloupe">Guadeloupe</option>
                            <option value="Guam">Guam</option>
                            <option value="Guatemala">Guatemala</option>
                            <option value="Guernsey">Guernsey</option>
                            <option value="Guinea">Guinea</option>
                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                            <option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option>
                            <option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
                            <option value="Holy See (Vatican City)">Holy See (Vatican City)</option>
                            <option value="Honduras">Honduras</option>
                            <option value="Hong Kong">Hong Kong</option>
                            <option value="Howland Island">Howland Island</option>
                            <option value="Hungary">Hungary</option>
                            <option value="Iceland">Iceland</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Iran">Iran</option>
                            <option value="Iraq">Iraq</option>
                            <option value="Ireland">Ireland</option>
                            <option value="Ireland, Northern">Ireland, Northern</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option>
                            <option value="Jan Mayen">Jan Mayen</option>
                            <option value="Japan">Japan</option>
                            <option value="Jarvis Island">Jarvis Island</option>
                            <option value="Jersey">Jersey</option>
                            <option value="Johnston Atoll">Johnston Atoll</option>
                            <option value="Jordan">Jordan</option>
                            <option value="Juan de Nova Island">Juan de Nova Island</option>
                            <option value="Kazakhstan">Kazakhstan</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Kiribati">Kiribati</option>
                            <option value="Korea, North">Korea, North</option>
                            <option value="Korea, South">Korea, South</option>
                            <option value="Kuwait">Kuwait</option>
                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Laos">Laos</option>
                            <option value="Latvia">Latvia</option>
                            <option value="Lebanon">Lebanon</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Libya">Libya</option>
                            <option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option>
                            <option value="Luxembourg">Luxembourg</option>
                            <option value="Macau">Macau</option>
                            <option value="Macedonia, Former Yugoslav Republic of">Macedonia, Former Yugoslav Republic of</option>
                            <option value="Madagascar">Madagascar</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option>
                            <option value="Malta">Malta</option>
                            <option value="Man, Isle of">Man, Isle of</option>
                            <option value="Marshall Islands">Marshall Islands</option>
                            <option value="Martinique">Martinique</option>
                            <option value="Mauritania">Mauritania</option>
                            <option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                            <option value="Midway Islands">Midway Islands</option>
                            <option value="Moldova">Moldova</option>
                            <option value="Monaco">Monaco</option>
                            <option value="Mongolia">Mongolia</option>
                            <option value="Montserrat">Montserrat</option>
                            <option value="Morocco">Morocco</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Namibia">Namibia</option>
                            <option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Netherlands">Netherlands</option>
                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                            <option value="New Caledonia">New Caledonia</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option>
                            <option value="Nigeria">Nigeria</option>
                            <option value="Niue">Niue</option>
                            <option value="Norfolk Island">Norfolk Island</option>
                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                            <option value="Norway">Norway</option>
                            <option value="Oman">Oman</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Palau">Palau</option>
                            <option value="Panama">Panama</option>
                            <option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option>
                            <option value="Peru">Peru</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Pitcaim Islands">Pitcaim Islands</option>
                            <option value="Poland">Poland</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Puerto Rico">Puerto Rico</option>
                            <option value="Qatar">Qatar</option>
                            <option value="Reunion">Reunion</option>
                            <option value="Romainia">Romainia</option>
                            <option value="Russia">Russia</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="Saint Helena">Saint Helena</option>
                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                            <option value="Saint Lucia">Saint Lucia</option>
                            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                            <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                            <option value="Samoa">Samoa</option>
                            <option value="San Marino">San Marino</option>
                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="Scotland">Scotland</option>
                            <option value="Senegal">Senegal</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra Leone">Sierra Leone</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Slovakia">Slovakia</option>
                            <option value="Slovenia">Slovenia</option>
                            <option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="South Georgia and South Sandwich Islands">South Georgia and South Sandwich Islands</option>
                            <option value="Spain">Spain</option>
                            <option value="Spratly Islands">Spratly Islands</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                            <option value="Sudan">Sudan</option>
                            <option value="Suriname">Suriname</option>
                            <option value="Svalbard">Svalbard</option>
                            <option value="Swaziland">Swaziland</option>
                            <option value="Sweden">Sweden</option>
                            <option value="Switzerland">Switzerland</option>
                            <option value="Syria">Syria</option>
                            <option value="Taiwan">Taiwan</option>
                            <option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania">Tanzania</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Tobago">Tobago</option>
                            <option value="Toga">Toga</option>
                            <option value="Tokelau">Tokelau</option>
                            <option value="Tonga">Tonga</option>
                            <option value="Trinidad">Trinidad</option>
                            <option value="Tunisia">Tunisia</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option>
                            <option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="Uruguay">Uruguay</option>
                            <option value="USA">USA</option>
                            <option value="Uzbekistan">Uzbekistan</option>
                            <option value="Vanuatu">Vanuatu</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Vietnam">Vietnam</option>
                            <option value="Virgin Islands">Virgin Islands</option>
                            <option value="Wales">Wales</option>
                            <option value="Wallis and Futuna">Wallis and Futuna</option>
                            <option value="West Bank">West Bank</option>
                            <option value="Western Sahara">Western Sahara</option>
                            <option value="Yemen">Yemen</option>
                            <option value="Yugoslavia">Yugoslavia</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="form-group">
                    <label for="">State/Province</label>
                    <select name="state" id="state"></select>
                </div>
            </div> -->
            <div class="col-lg-12 col-md-12 col-sm-6 col-12">
                <div class="row">
                    <!-- <div class="col-lg-6 col-md-6 col-sm-12 col-6">
                        <div class="form-group">
                            <label for="">Zip/Postal Code</label>
                            <input type="text" placeholder="Zip/Postal Code" name="zip" id="zip" value="">
                        </div>
                    </div> -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="">Email Address</label>
                            <input type="text" placeholder="Email" name="email" id="email" value="{{$data['client_email']}}">

                            <span id="email_err" class="text-danger laravel_validation"> </span>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="row detailsDiv">
                <div class="col-12 ">
                    <div class="form-group">
                        <p class="g-title">Credit Card Information</p>
                        <div class="container">


                            <div class="col-12 mt-2">
                                <label for="card-element">

                                </label>
                                <div id="card-element">
                                    <!-- a Stripe Element will be inserted here. -->
                                </div>
                                <!-- Used to display Element errors -->
                                <div id="card-errors" role="alert"></div>
                            </div>
                        </div>
                        <button type="button" class="btn-Stripe">Paynow</button>
                    </div>
                </div>
            </div>


            <span id="stripe_token_err" class="text-danger laravel_validation"> </span>

            </div>
        </section>



    </form>
    <script src="{{url('/')}}/admin/payment_terminal/js/countries.js"></script>
    <script>
        populateCountries("country", "state");
    </script>




    <script src="https://js.stripe.com/v3/"></script>


    <script>
        var stripeToken = "";
        $('.btn-Stripe').click(async () => {



            await getStripeToken();
            var orderData = {
                currency: document.getElementById("currencycode").value,
                first_name: document.getElementById("first_name").value,
                last_name: document.getElementById("last_name").value,
                // address: document.getElementById("address").value,
                // city: document.getElementById("city").value,
                // country: document.getElementById("country").value,
                // state: document.getElementById("state").value,
                // zip: document.getElementById("zip").value,
                email: document.getElementById("email").value,
                amount: document.getElementById("amount").value,
                invoice_number: document.getElementById("invoice_number").value,
                invoice_id: document.getElementById("invoice_id").value,
                stripe_token: stripeToken
            };

            $('#loading').css('display', 'block');
            $('.detailsDiv').css('display', 'none');

            $(`.laravel_validation`).html('');
            var settings = {
                "url": "{{route('payment.create')}}",
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "Content-Type": "application/json",
                    "Cookie": "laravel_session=eyJpdiI6IlZObS8zTi91SUlrSVlVUjR2Q0doWGc9PSIsInZhbHVlIjoiNTg5VW14NmhZMkJ1TGp5bHA4YWgvcVpYMXpTeTBNeXJLbXc1TWxUcEcvcnlqUDliUkpZV0xKMC90ZVBtYTJaWWRvQ21uRjBXM0ozaWRaZVpDT0s3ZkRGemZ2RVVzVnd0Y2h2a2EzMFd0blQ5MU5RSHM5N0Y5ejBlOXNzTlFFTzMiLCJtYWMiOiJlM2Y1YzYxNjE5ZjAyYWI5M2M3ZjYxMDJjODYyMWZjZmYzYTIyYTRlNDc3M2FjZDAwOTIzZDJlMDgxYjc3ODE1IiwidGFnIjoiIn0%3D",
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                "data": JSON.stringify(orderData),
            };
            $.ajax(settings).done(function(response) {


                $('#loading').css('display', 'none');
                $('.detailsDiv').css('display', 'flex');


                if (response.status == false) {


                    for (let key of Object.entries(response.data)) {
                        $(`#${key[0]}_err`).html(key[1]);
                    }
                } else {


                    $('#loading').css('display', 'none');
                    $('.detailsDiv').css('display', 'none');

                    swal("Transaction Completed!", response.message, "success");
                    setTimeout(function() {

                        window.location = "{{url('/')}}/invoice/" + response.data.slug;
                    }, 2000);
                }
            });
        });

        // Create a Stripe client
        var stripe = Stripe("{{$data['public_key']}}");

        // Create an instance of Elements
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element
        var card = elements.create('card', {
            style: style
        });

        // Add an instance of the card Element into the `card-element` <div>
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission
        var form = document.getElementById('payment-form');

        function getStripeToken() {
            return new Promise(resolve => {
                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {

                        resolve(result.token.id);
                        /* token contains id, last4, and card type */
                        stripeToken = result.token.id;
                    }
                });
                return stripeToken;
            });
        }
    </script>





</html>