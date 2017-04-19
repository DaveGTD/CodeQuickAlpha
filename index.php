<?php
  $page = 'upload';
  include($_SERVER['DOCUMENT_ROOT'].'/header.php');
?>

<div class="alert alert-info">
  You have <a href="/my-charts.php">2 completed batches</a> to download
  <a href="" class="alert-close">
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
      <path class="st0" d="M9,1c4.4,0,8,3.6,8,8s-3.6,8-8,8s-8-3.6-8-8S4.6,1,9,1z M6.5,12.6l2.5-2.6l2.5,2.5c0.2,0.2,0.5,0.2,0.6,0 c0.2-0.2,0.2-0.5,0-0.6L9.6,9.4l2.7-2.8c0.2-0.2,0.2-0.5,0-0.6c-0.2-0.2-0.5-0.2-0.6,0L8.9,8.8L6.2,6.1C6,5.9,5.7,5.9,5.6,6.1 c-0.2,0.2-0.2,0.5,0,0.6l2.8,2.8L5.8,12c-0.2,0.2-0.2,0.5,0,0.6c0.1,0.1,0.2,0.1,0.3,0.1C6.3,12.8,6.4,12.7,6.5,12.6z"/>
    </svg>
  </a>
</div>

<div id="content">
  <div class="load-content">
    <div class="row">
      <div class="col12">
        <h1 class="f-left">Upload Charts</h1>
      </div>
    </div>
    <div class="row">
      <div class="col12">
        <form action="upload.php" class="dropzone" id="chartUpload">
        </form>
        <p class="small-text a-right">By uploading files, you agree to our <a href="#terms-popup" class="popup-link">Terms of Service</a></p>

        <div id="chartUploadInner">
          <li class="dz-preview dz-file-preview">
            <div class="dz-details">
              <img src="/images/ico-file.png">
              <div class="dz-extension"><span data-dz-errormessage>error</span></div>
              <div class="dz-filename"><span data-dz-name></span></div>
            </div>
            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
            <div class="remove-btn" data-dz-remove>
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                <path class="st0" d="M9,1c4.4,0,8,3.6,8,8s-3.6,8-8,8s-8-3.6-8-8S4.6,1,9,1z M6.5,12.6l2.5-2.6l2.5,2.5c0.2,0.2,0.5,0.2,0.6,0 c0.2-0.2,0.2-0.5,0-0.6L9.6,9.4l2.7-2.8c0.2-0.2,0.2-0.5,0-0.6c-0.2-0.2-0.5-0.2-0.6,0L8.9,8.8L6.2,6.1C6,5.9,5.7,5.9,5.6,6.1 c-0.2,0.2-0.2,0.5,0,0.6l2.8,2.8L5.8,12c-0.2,0.2-0.2,0.5,0,0.6c0.1,0.1,0.2,0.1,0.3,0.1C6.3,12.8,6.4,12.7,6.5,12.6z"/>
              </svg>
            </div>
          </li>
        </div>

        <ul id="uploadPreviews" class="dropzone-previews grid2">
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="col12">
        <div class="a-right">
          <a id="submitBtn" class="btn btn-blue btn-large">Submit files</a>
        </div>
      </div>
    </div>
    <div id="submit-success">
      <div class="row">
        <div class="col12">
          <h1>Success!</h1>
          <p>You have successfully submitted <span id="file-count"></span> to be coded. To view the status or make changes, visit <a href="/my-charts.php" class="link">My Charts</a></p>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="terms-popup" class="white-popup mfp-hide">
  <div class="row">
    <div class="col12">
      <div class="card">
        <div class="limit-height">
          <div class="pad">
            <h2>Terms & Conditions</h2>
            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>
            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>
            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>
          </div>
        </div>
        <div class="popup-footer">
          <a href="#" class="mfp-close">OK</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/footer.php') ?>
