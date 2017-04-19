<?php

require_once "vendor/autoload.php";
use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;
use MicrosoftAzure\Storage\Blob\Models\ListContainersResult;
use MicrosoftAzure\Storage\Common\ServicesBuilder;
use MicrosoftAzure\Storage\Common\ServiceException;
use MicrosoftAzure\Storage\Common\Internal\InvalidArgumentTypeException;

$account_name = "";
$account_key = "";

$connectionString = "DefaultEndpointsProtocol=https;AccountName=$account_name;AccountKey=$account_key";

$blobClient = ServicesBuilder::getInstance()->createBlobService($connectionString);

// container name = name of specialty

function uploadToAzure($container, $file_path, $blob_name)
{
	global $blobClient;
	$content = fopen($file_path, "r");
	try
	{
		$blobClient->createBlockBlob($container, $blob_name, $content);
	} catch (Exception $e)
	{
		$code = $e->getCode();
		$error_message = $e->getMessage();
		error_log($error_message, 0);
	}

}


function downloadBlob($container, $blob_name)
{
	global $blobClient;
	try
		{
			$getBlobResult = $blobClient->getBlob($container, $blob_name);
			$output_name = "/tmp_downloads/$blob_name";
			file_put_contents($output_name, $getBlobResult->getContentStream());
		}
		catch (ServiceException $e)
		{
			$code = $e->getCode();
			$error_message = $e->getMessage();
			error_log($error_message, 0);
		}


}

//Note: usering username as container
function list_blobs_in_container($container)
{
	global $blobClient;
	$files = array();
  try
		{
    	// List blobs.
      $blob_list = $blobClient->listBlobs($container);
      $blobs = $blob_list->getBlobs();

      foreach ($blobs as $blob)
			{
				array_push($files, $blob->getName());
      	// echo $blob->getName().": ".$blob->getUrl().PHP_EOL;
      }
    } catch (ServiceException $e) {
        $code = $e->getCode();
        $error_message = $e->getMessage();
        error_log($error_message, 0);
    }
	return $files;
}

function create_container($container)
{
	global $blobClient;
	// OPTIONAL: Set public access policy and metadata.
	// Create container options object.
	$createContainerOptions = new CreateContainerOptions();

	// Set public access policy. Possible values are
	// PublicAccessType::CONTAINER_AND_BLOBS and PublicAccessType::BLOBS_ONLY.
	// CONTAINER_AND_BLOBS: full public read access for container and blob data.
	// BLOBS_ONLY: public read access for blobs. Container data not available.
	// If this value is not specified, container data is private to the account owner.
	// $createContainerOptions->setPublicAccess(PublicAccessType::CONTAINER_AND_BLOBS);

	// Set container metadata
	$createContainerOptions->addMetaData("key1", "value1");
	$createContainerOptions->addMetaData("key2", "value2");

	try
	{
			// Create container.
			$blobClient->createContainer($container, $createContainerOptions);
			return true;
	} catch (ServiceException $e)
	{
			$code = $e->getCode();
			$error_message = $e->getMessage();
			error_log($error_message, 0);
			return false;
	}
}
