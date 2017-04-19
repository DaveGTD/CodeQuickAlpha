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

// createContainerSample($blobClient);

// uploadBlobSample($blobClient);
//
// downloadBlobSample($blobClient);
//
// listBlobsSample($blobClient);

function createContainerSample($blobClient)
{
    // OPTIONAL: Set public access policy and metadata.
    // Create container options object.
    $createContainerOptions = new CreateContainerOptions();

    // Set public access policy. Possible values are
    // PublicAccessType::CONTAINER_AND_BLOBS and PublicAccessType::BLOBS_ONLY.
    // CONTAINER_AND_BLOBS: full public read access for container and blob data.
    // BLOBS_ONLY: public read access for blobs. Container data not available.
    // If this value is not specified, container data is private to the account owner.
    $createContainerOptions->setPublicAccess(PublicAccessType::CONTAINER_AND_BLOBS);

    // Set container metadata
    $createContainerOptions->addMetaData("key1", "value1");
    $createContainerOptions->addMetaData("key2", "value2");

    try {
        // Create container.
        $blobClient->createContainer("mycontainer1", $createContainerOptions);
    } catch (ServiceException $e) {
        $code = $e->getCode();
        $error_message = $e->getMessage();
        echo $code.": ".$error_message.PHP_EOL;
    }
}

function uploadBlobSample($blobClient)
{
    $content = fopen("../some_file.txt", "r");
    $blob_name = "myblob";

    try {
        //Upload blob
        $blobClient->createBlockBlob("mycontainer1", $blob_name, $content);
    } catch (ServiceException $e) {
        $code = $e->getCode();
        $error_message = $e->getMessage();
        echo $code.": ".$error_message.PHP_EOL;
    }
}

function downloadBlobSample($blobClient)
{
    try {
        $getBlobResult = $blobClient->getBlob("mycontainer1", "myblob");
    } catch (ServiceException $e) {
        $code = $e->getCode();
        $error_message = $e->getMessage();
        echo $code.": ".$error_message.PHP_EOL;
    }

    file_put_contents("output.txt", $getBlobResult->getContentStream());
}

function listBlobsSample($blobClient)
{
    try {
        // List blobs.
        $blob_list = $blobClient->listBlobs("mycontainer1");
        $blobs = $blob_list->getBlobs();

        foreach ($blobs as $blob) {
            echo $blob->getName().": ".$blob->getUrl().PHP_EOL;
        }
    } catch (ServiceException $e) {
        $code = $e->getCode();
        $error_message = $e->getMessage();
        echo $code.": ".$error_message.PHP_EOL;
    }
}


function uploadCall($container, $blob_path)
{
	global $blobClient;
	$content = fopen($blob_path, "r");
	$blob_name = $blob_path;
	try
	{
		$blobClient->createBlockBlob($container, $blob_name, $content);
	} catch (Exception $e)
	{
		$code = $e->getCode();
		$error_message = $e->getMessage();
		echo $code . ": " . $error_message.PHP_EOL;
	}

}
