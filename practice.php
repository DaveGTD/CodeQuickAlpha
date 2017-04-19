<?php
  $page = 'practice';
  include($_SERVER['DOCUMENT_ROOT'].'/header.php');

	$practice = $address = $city = $state = $zip = $patients = $insurance = $insurance_custom = $ehr = $ehr_custom = $specialties = '';

	populate_user_details($email, $practice, $address, $city, $state, $zip, $patients, $insurance, $insurance_custom, $ehr, $ehr_custom, $specialties);


?>

<div id="content">
  <div class="load-content">
    <div class="row">
      <div class="col6">
        <h1>Practice Info</h1>
      </div>
      <div class="col6">
        <h1>Specialties & Pricing</h1>
      </div>
    </div>
    <div class="row">
      <div class="card">
        <div class="row">
          <div class="col5">
            <label for="companyName">Company Name</label>
            <div class="field">
              <span class="field-input"><?php echo $practice; ?></span>
              <input id="companyName" class="field-hide" type="text" value="Castleberry Clinic"/>
              <a href="#" class="field-edit">Edit</a>
              <a href="#" class="field-save">Save</a>
            </div>
            <label for="address">Address</label>
            <div class="field">
              <span class="field-input"><?php echo $address; ?><br> <?php echo "$city, $state, $zip"; ?></span>
              <textarea id="address" class="field-hide">123 E. Main
  Salt Lake City, UT 84101
              </textarea>
              <a href="#" class="field-edit">Edit</a>
              <a href="#" class="field-save">Save</a>
            </div>
            <label for="patients">Patients per month</label>
            <div class="field">
              <span class="field-input"><?php echo $patients; ?></span>
              <input id="patients" class="field-hide" type="text" value="150"/>
              <a href="#" class="field-edit">Edit</a>
              <a href="#" class="field-save">Save</a>
            </div>

            <label for="insurance">Insurance</label>
            <div class="field">
              <span class="field-input"><?php echo $insurance; ?></span>
              <a href="#" class="field-edit popup-select">Edit</a>
            </div>
            <label for="ehr">EHR</label>
            <div class="field">
              <span class="field-input"><?php echo $ehr; ?></span>
              <a href="#" class="field-edit popup-select">Edit</a>
            </div>
						<label for="ehr">Specialties</label>
						<div class="field">
							<span class="field-input"><?php echo $specialties; ?></span>
							<a href="#" class="field-edit popup-select">Edit</a>
						</div>

          </div>
          <div class="col6 off1">
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

            <p class="a-right">
              <a href="#" id="specialtiesOpen" class="btn">Edit Specialties</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="popupChooser" class="white-popup mfp-hide">
  <div class="row">
    <div class="card">
      <div id="showList">
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
          <a href="#" id="specialtiesPricing">Save Specialties</a>
        </div>
      </div>
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
        <div class="limit-height">
          <div class="pad">
            <div class="pricing-accept">
              <h2 class="a-center blue-t">Price per Encounter</h2>
              <div class="table specialties-list" id="pricingApproval">
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
            </div>
          </div>
        </div>
        <div class="popup-footer">
          <a href="#" class="mfp-close red-t">Cancel</a>
          <a href="#" class="mfp-close" id="specialtiesSave">Accept Pricing</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/footer.php') ?>
