<?php
  $page = 'charts';
  include($_SERVER['DOCUMENT_ROOT'].'/header.php');

	$download_files = get_coded_files_list($username);

?>

<div id="content">
  <div class="load-content">
    <div class="row">
      <div class="col12">
        <h1 class="f-left">My Charts</h1>
        <a href="/archive.php" class="text-link f-right">View Archived Charts</a>
      </div>
    </div>
    <div class="row">
      <div class="col12">
        <div class="flex-table">
          <div class="t-row t-heading">
            <div class="t-cell">
              Status
            </div>
						<div class="t-cell">
							File Name
						</div>
            <div class="t-cell">
              Date Submitted
            </div>
            <div class="t-cell">
              File ID
            </div>
            <div class="t-cell">
              Batch ID #
            </div>
            <div class="t-cell">
              Download Link
            </div>
            <div class="t-cell t-large"></div>
          </div>


					<?php
					foreach($download_files as $f)
					{

						$time_of_upload = $file_id = $batch_id = $file_name = '';
						if(!populate_file_details($f, $time_of_upload, $file_id, $batch_id, $file_name))
							{
							// if open
							?>

								<div class="t-row t-card" id="batch-1006">
									<div class="t-cell tooltip" data-tooltip="Complete">
										<svg class="ico-complete" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28">
											<path d="M1.3,14C1.3,7,7,1.3,14,1.3C21,1.3,26.7,7,26.7,14c0,7-5.7,12.7-12.7,12.7C7,26.7,1.3,21,1.3,14z M21.7,9.8 l-1.2-1.2l-9.1,9l-3.9-4.4l-1.2,1.1l5.1,5.7L21.7,9.8z"/>
										</svg>
									</div>
									<div class="t-cell">
										<?php echo $file_name; ?>
									</div>
									<div class="t-cell">
										<?php echo $time_of_upload; ?>
									</div>
									<div class="t-cell">
										<?php echo $file_id; ?>
									</div>
									<div class="t-cell">
										<?php echo $batch_id; ?>
									</div>
									<div class="t-cell t-large t-btn">
										<a href="<?php echo "test_download.php?file=$f"; ?>" class="btn btn-fade">Download</a>
									</div>
								</div>

							<?php
							// if closed
							}
					// foreach closed
					}
					?>



        </div>
      </div>
    </div>
  </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/footer.php') ?>
