<?php
  $page = 'account';
  include($_SERVER['DOCUMENT_ROOT'].'/header.php');
?>

<div id="content">
  <div class="load-content">
    <div class="row">
      <div class="col6">
        <h1>My Account</h1>
      </div>
      <div class="col6 hide-tab">
        <h1>Payments</h1>
      </div>
    </div>
    <div class="row">
      <div class="card">
        <div class="row">
          <div class="col5">
            <label for="contactName">Contact Name</label>
            <div class="field">
              <span class="field-input"><?php echo $username; ?></span>
              <input id="contactName" class="field-hide" type="text" value="Chris Owens"/>
              <a href="#" class="field-edit">Edit</a>
              <a href="#" class="field-save">Save</a>
            </div>
            <label for="contactEmail">Email</label>
            <div class="field">
              <span class="field-input"><?php echo $email; ?></span>
              <input id="contactEmail" class="field-hide" type="text" value="c.owens@castleberry.com"/>
              <a href="#" class="field-edit">Edit</a>
              <a href="#" class="field-save">Save</a>
            </div>
            <label for="updatePassword">Password</label>
            <div class="field">
              <span class="field-input">*********</span>
              <input id="updatePassword" class="field-hide" type="text" value="*********"/>
              <a href="#" class="field-edit">Edit</a>
              <a href="#" class="field-save">Save</a>
            </div>
          </div>
          <div class="col6 off1">
            <div class="show-tab">
              <h2>Payments</h2>
            </div>
            <form action="register_stripe.php" method="post" id="example-form">
              <div class="form-row hide">
                <label for="name" class="stripeLabel">Stripe Public Key</label>
                <input type="text" id="stripePKEY" value="pk_test_6pRNASCoBOKtIshFeQd4XMUh" class="required" />
              </div>

              <div class="form-row">
                <label for="name" class="stripeLabel">Your Name</label>
                <input type="text" name="name" class="required" />
              </div>

              <div class="form-row">
                <label for="email">E-mail Address</label>
                <input type="text" name="email" class="required" />
              </div>

              <div class="form-row">
                <label>Card Number</label>
                <input type="text" maxlength="20" autocomplete="off" class="card-number stripe-sensitive required" />
              </div>

              <div class="row">
                <div class="col6 shift">
                  <label>Expiration</label>
                  <div class="expiry-wrapper">
                    <select class="card-expiry-month stripe-sensitive required"></select>
                    <script type="text/javascript">
                      var select = $(".card-expiry-month"),
                        month = new Date().getMonth() + 1;

                      for (var i = 1; i <= 12; i++) {
                        select.append($("<option value='"+i+"' "+(month === i ? "selected" : "")+">"+i+"</option>"));
                      }
                    </script>
                    <span> / </span>
                    <select class="card-expiry-year stripe-sensitive required"></select>
                    <script type="text/javascript">
                      var select = $(".card-expiry-year"),
                        year = new Date().getFullYear();

                      for (var i = 0; i < 12; i++) {
                        select.append($("<option value='"+(i + year)+"' "+(i === 0 ? "selected" : "")+">"+(i + year)+"</option>"))
                      }
                    </script>
                  </div>
                </div>
                <div class="col4 off2">
                  <label>CVC</label>
                  <input type="text" maxlength="4" autocomplete="off" class="card-cvc stripe-sensitive required" />
                </div>
              </div>



              <div class="form-row hide">
                <textarea id="stripeTOKEN" cols="100"></textarea>
              </div>
              <div class="form-row a-right">
                <button type="submit" name="submit-button" class="btn">Submit</button>
              </div>
              <span class="payment-errors"></span>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.8.1/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v1/"></script>
<script>
  $(document).ready(function() {
    function addInputNames() {
      // Not ideal, but jQuery's validate plugin requires fields to have names
      // so we add them at the last possible minute, in case any javascript
      // exceptions have caused other parts of the script to fail.
      $(".card-number").attr("name", "card-number")
      $(".card-cvc").attr("name", "card-cvc")
      $(".card-expiry-year").attr("name", "card-expiry-year")
    }

    function removeInputNames() {
      $(".card-number").removeAttr("name")
      $(".card-cvc").removeAttr("name")
      $(".card-expiry-year").removeAttr("name")
    }

    function submit(form) {
      Stripe.setPublishableKey($('#stripePKEY').val());
      // remove the input field names for security
      // we do this *before* anything else which might throw an exception
      removeInputNames(); // THIS IS IMPORTANT!

      // given a valid form, submit the payment details to stripe
      // $(form['submit-button']).attr("disabled", "disabled")

      Stripe.createToken({
        number: $('.card-number').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, function(status, response) {
        if (response.error) {
          // re-enable the submit button
          $(form['submit-button']).removeAttr("disabled")

          // show the error
          $(".payment-errors").html(response.error.message);

          // we add these names back in so we can revalidate properly
          addInputNames();
        } else {
          // token contains id, last4, and card type
          var token = response['id'];
          console.log(response);
          console.log('Token: ' + token);

          // insert the stripe token
          //var input = $("<input name='stripeToken' value='" + token + "' style='display:none;' />");
          //form.appendChild(input[0]);
          $('#stripeTOKEN').val(token);
        }
      });

      return false;
    }

    // add custom rules for credit card validating
    jQuery.validator.addMethod("cardNumber", Stripe.validateCardNumber, "Please enter a valid card number");
    jQuery.validator.addMethod("cardCVC", Stripe.validateCVC, "Please enter a valid security code");
    jQuery.validator.addMethod("cardExpiry", function() {
      return Stripe.validateExpiry($(".card-expiry-month").val(),
                                   $(".card-expiry-year").val())
    }, "Please enter a valid expiration");

    // We use the jQuery validate plugin to validate required params on submit
    $("#example-form").validate({
      submitHandler: submit,
      rules: {
        "card-cvc" : {
          cardCVC: true,
          required: true
        },
        "card-number" : {
          cardNumber: true,
          required: true
        },
        "card-expiry-year" : "cardExpiry" // we don't validate month separately
      }
    });

    // adding the input field names is the last step, in case an earlier step errors
    addInputNames();
  });
</script>

<?php include($_SERVER['DOCUMENT_ROOT'].'/footer.php') ?>
