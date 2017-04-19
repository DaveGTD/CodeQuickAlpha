<!doctype html>
<html>
<head>
<title>Code Quick</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta charset="utf-8" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,700" rel="stylesheet">
<link rel="stylesheet" href="/css/form.css" type="text/css">
<script src="/js/signup-info.js"></script>
</head>
<body>

<div id="header">
  <div id="logo">
    <svg id="codequick-logo" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 302 340">
    	<path d="M287.8,182.5h-37.5c-7.3,0-13.2,6-13.2,13.2v18.6v8.8c0,7.3-6,13.2-13.2,13.2H217l18.6,64.5h0c36,0,65.3-29.3,65.3-65.3 v-21.3v-18.6C301,188.5,295,182.5,287.8,182.5z"/>
    	<path d="M185.5,338.4c-7.4,0-11.3-2.9-13.4-10.1l-32.3-113c-1.1-3.9-0.3-8.3,2.1-11.5c2-2.6,4.9-4.2,7.9-4.2h39 c7.4,0,12.4,3.9,14.5,11.2l32.3,111.9c1,3.6,0.2,7.6-2.2,10.9c-2.3,3.1-5.5,4.8-8.9,4.8H185.5z"/>
    	<path d="M235.7,1H66.3C30.3,1,1,30.3,1,66.3v169.4c0,36,29.3,65.3,65.3,65.3H158l-18.5-64.5H79.3c-7.3,0-13.2-6-13.2-13.2V78.8 c0-7.3,6-13.2,13.2-13.2h144.5c7.3,0,13.2,6,13.2,13.2v9.9v17.6c0,7.3,6,13.2,13.2,13.2h37.5c7.3,0,13.2-6,13.2-13.2V88.7V66.3 C301,30.3,271.7,1,235.7,1z"/>
    </svg>
  </div>
</div>

<form id="signUp" action="register_form.php" method="post">

<div id="contain">
  <div id="slider">

    <div class="title">
      <h1>Custom Pricing</h1>
      <p>Give us 30 seconds and we will get you custom pricing and a Free Trial!</p>
    </div>

    <div class="card-wrap show active" id="card1">
      <div class="card">
        <div class="card-bg"></div>
        <div class="card-no">01</div>
        <div class="card-title">My Info</div>
        <div class="inner-card">
          <p>My name is <input type="text" id="userFullName" name="userName"> and my email is <input type="text" id="userEmail" name="userEmail">.</p>
          <p>The name of my practice is <input type="text" id="userPractice" name="userPractice">.</p>
          <div class="clear">
            <a href="#" class="btn btn-next">Next</a>
          </div>
        </div>
      </div>
    </div>

    <div class="card-wrap" id="card2">
      <div class="card">
        <div class="card-bg"></div>
        <div class="card-no">02</div>
        <div class="card-title">Specialties</div>
        <div class="inner-card">
          <h2>What specialties does <span class="client-name green-t">Your Practice</span> provide?</h2>
          <div id="specialtiesEdit" class="specialties-edit validate"></div>
          <p><a href="#" id="specialtiesOpen" class="btn btn-green">Add Specialties</a></p>
          <div class="clear">
            <a href="#" class="btn btn-next">Next</a>
          </div>
        </div>
      </div>
    </div>

    <div class="card-wrap loading" id="card4">
      <div class="card">
        <div class="card-bg"></div>
        <div class="card-no">03</div>
        <div class="card-title">Pricing</div>
        <div class="inner-card">
          <div id="showLoader">
            <div class="loading-ani">
              <h2 class="a-center blue-t">Calculating Pricing</h2>
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 140 140">
                <path class="loader-circle" d="M70,137c-36.9,0-67-30.1-67-67S33.1,3,70,3c36.9,0,67,30.1,67,67S106.9,137,70,137z M70,9 C36.4,9,9,36.4,9,70s27.4,61,61,61s61-27.4,61-61S103.6,9,70,9z"/>
                <g class="loader-progress">
                  <path class="progress-guide" d="M70,139c-38,0-69-31-69-69S32,1,70,1s69,31,69,69S108,139,70,139z"/>
                  <path class="progress-stroke" d="M123.1,92.1l0.5-1.4c2.5-6.6,3.8-13.6,3.8-20.7c0-10.5-2.9-20.9-8.3-29.8l-0.8-1.3l11.1-6.7l0.8,1.3 c6.7,11,10.2,23.6,10.2,36.6c0,8.8-1.6,17.3-4.7,25.4l-0.5,1.4L123.1,92.1z"/>
                  <path class="progress-fill" d="M125.7,91c2.5-6.7,3.8-13.7,3.8-21c0-10.7-2.9-21.3-8.4-30.4l7.7-4.7c6.3,10.6,9.7,22.7,9.7,35.1 c0,8.3-1.5,16.5-4.4,24.2L125.7,91z"/>
                </g>
              </svg>
            </div>
          </div>
          <div id="showPricing">
            <h2>Congratulations!<br>
            Price per encounter for <span class="client-name green-t">Your Practice</span> is:</h2>
            <div class="table specialties-list" id="specialtiesCurr">
              <div class="t-row t-heading">
                <div></div>
                <div>
                  E&M
                </div>
                <div>
                  Procedures
                </div>
              </div>
            </div>
            <div class="clear">
              <a href="#" class="btn btn-next">Next</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card-wrap" id="card5">
      <div class="card">
        <div class="card-bg"></div>
        <div class="card-no">04</div>
        <div class="card-title">Insurance</div>
        <div class="inner-card">
          <h2>We are almost ready to start coding.<br>
            What insurance does <span class="client-name green-t">Your Practice</span> accept?</h2>
          <div>
            <ul class="checklist grid6">
              <li>
                <input name="userInsurance" id="1100" value="Medicare" type="checkbox">
                <label for="1100">
                  <div class="check-control">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28">
                      <path d="M1.3,14C1.3,7,7,1.3,14,1.3S26.7,7,26.7,14S21,26.7,14,26.7S1.3,21,1.3,14z M21.7,9.8l-1.2-1.2l-9.1,9l-3.9-4.4l-1.2,1.1 l5.1,5.7L21.7,9.8z"></path>
                      <circle cx="14" cy="14" r="11" stroke-width="0" fill="#FFF" class="circle-over"></circle>
                    </svg>
                  </div>Medicare
                </label>
              </li>
              <li>
                <input name="userInsurance" id="1101" value="Medicaid" type="checkbox">
                <label for="1101">
                  <div class="check-control">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28">
                      <path d="M1.3,14C1.3,7,7,1.3,14,1.3S26.7,7,26.7,14S21,26.7,14,26.7S1.3,21,1.3,14z M21.7,9.8l-1.2-1.2l-9.1,9l-3.9-4.4l-1.2,1.1 l5.1,5.7L21.7,9.8z"></path>
                      <circle cx="14" cy="14" r="11" stroke-width="0" fill="#FFF" class="circle-over"></circle>
                    </svg>
                  </div>Medicaid
                </label>
              </li>
              <li>
                <input name="userInsurance" id="1102" value="Blue Cross Blue Shield" type="checkbox">
                <label for="1102">
                  <div class="check-control">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28">
                      <path d="M1.3,14C1.3,7,7,1.3,14,1.3S26.7,7,26.7,14S21,26.7,14,26.7S1.3,21,1.3,14z M21.7,9.8l-1.2-1.2l-9.1,9l-3.9-4.4l-1.2,1.1 l5.1,5.7L21.7,9.8z"></path>
                      <circle cx="14" cy="14" r="11" stroke-width="0" fill="#FFF" class="circle-over"></circle>
                    </svg>
                  </div>Blue Cross Blue Shield
                </label>
              </li>
              <li>
                <input id="custominsurance" name="userInsurance" value="Other" type="checkbox">
                <label for="custominsurance">
                  <div class="check-control">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28">
                      <path d="M1.3,14C1.3,7,7,1.3,14,1.3S26.7,7,26.7,14S21,26.7,14,26.7S1.3,21,1.3,14z M21.7,9.8l-1.2-1.2l-9.1,9l-3.9-4.4l-1.2,1.1 l5.1,5.7L21.7,9.8z"></path>
                      <circle cx="14" cy="14" r="11" stroke-width="0" fill="#FFF" class="circle-over"></circle>
                    </svg>
                  </div>Other: <input id="userInsuranceCustom" name="userInsuranceCustom" class="text-inline optional" placeholder="Submit Insurance Name" type="text">
                </label>
              </li>
            </ul>
          </div>
          <div class="clear">
            <a href="#" class="btn btn-next">Next</a>
          </div>
        </div>
      </div>
    </div>

    <div class="card-wrap" id="card6">
      <div class="card">
        <div class="card-bg"></div>
        <div class="card-no">05</div>
        <div class="card-title">EHR</div>
        <div class="inner-card">
          <h2>What EHR does <span class="client-name green-t">Your Practice</span> use?</h2>
          <div id="ehrList" class="specialties-edit validate"></div>
          <p><a href="#" class="btn btn-green popup-select" data-select="ehr">Select EHR</a></p>
          <div class="clear">
            <a href="#" class="btn btn-next">Next</a>
          </div>
        </div>
      </div>
    </div>

    <div class="card-wrap" id="card7">
      <div class="card">
        <div class="card-bg"></div>
        <div class="card-no">06</div>
        <div class="card-title">Address</div>
        <div class="inner-card">
          <h2>What is <span class="client-name green-t">Your Practice</span>'s address?</h2>
          <p>Address <input type="text" name="userAddress" id="userAddress"></p>
          <p>City <input type="text" name="userCity" id="userCity"> State <input type="text" name="userState" id="userState"> Zip <input type="text" name="userZip" id="userZip"></p>
          <h2><span class="client-name green-t">Your Practice</span> sees around <input type="text" name="userPatients" id="userPatients"> patients per month.</h2>
          <div class="clear">
            <a href="#" class="btn btn-next">Next</a>
          </div>
        </div>
      </div>
    </div>

    <div class="card-wrap" id="card8">
      <div class="card">
        <div class="card-bg"></div>
        <div class="card-no">07</div>
        <div class="card-title">Account</div>
        <div class="inner-card">
          <h2>Last step and you're on your way!<br>
            Create a Code Quick account.</h2>
          <div class="acct-form">
            <p class="form-field">
              <label for="user">Username</label> <input id="user" name="user" type="text">
            </p>
            <p class="form-field">
              <label for="password">Password</label> <input id="password" name="password" type="password">
            </p>
            <p class="form-field">
              <label for="passwordConfirmation">Confirm <br>Password</label> <input id="passwordConfirmation" type="password">
            </p>
          </div>
          <div class="clear">
            <input type="submit" class="btn" value="Finished, Let's Code"></a>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<div id="popupChooser" class="white-popup mfp-hide">
  <div class="row">
    <div class="card">
      <div class="limit-height">
        <div class="pad">
          <h2>Edit <span id="optionsTitle"></span></h2>
          <div id="optionsContainer">
            <ul id="optionsList" class="checklist grid6">
            </ul>
          </div>
        </div>
      </div>
      <div class="popup-footer">
        <a href="#" class="mfp-close red-t">Cancel</a>
        <a href="#" class="mfp-close" id="optionsSave">Save</a>
      </div>
    </div>
  </div>
</div>

<div id="chooseSpecialties" class="white-popup mfp-hide">
  <div class="row">
    <div class="card">
      <div id="showList">
        <div class="limit-height">
          <div class="pad">
            <h2>Edit Specialties</h2>
            <div id="specialtiesContainer">
              <ul id="specialtiesList" class="checklist grid6">
              </ul>
            </div>
          </div>
        </div>
        <div class="popup-footer">
          <a href="#" class="mfp-close red-t">Cancel</a>
          <a href="#" class="mfp-close" id="specialtiesSave">Save Specialties</a>
        </div>
      </div>
    </div>
  </div>
</div>

</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="/js/plugins.min.js"></script>
<script src="/js/form.js"></script>
</body>
</html>
