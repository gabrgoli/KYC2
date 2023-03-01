<?php

namespace App\Service;

class Token
{
   protected $policyId = "47c9edf6e5838daa4a421484f7b339c242a4b7968a00fe225b644ae1";
   protected $projectId = "42982";
   protected $metadata;

     function __construct(array $metadata_plain){
        $this->metadata = $metadata_plain;

     }

function getMetadata($type, $did, $data)
{
    try {
        if ($type == "vPool") {
            $metadata = replaceMetadata(file_get_contents("token/vPool.json"), $data);
        } elseif ($type == "vDelegator") {
            $metadata = replaceMetadata(file_get_contents("token/vDelegator.json"), $data);
        } elseif ($type == "vNFT") {
            $metadata = replaceMetadata(file_get_contents("token/vNFT.json"), $data);
        }
        file_put_contents("kyctoken/$type_$did.metadata", $metadata);
    } catch (Excpetion $ex) {
    }
}

   function replaceMetadata($metadata, $data) {
         foreach($data as $key => $value) {
            $metadata = str_replace("<".$key.">",$data[$value], $metadata);    
         }
         return $metadata;
   }

   function uploadMetadata($type, $did){
         try {
            $imagedata = file_get_contents("token/$type.png");
            $metadataraw = file_get_contents("kyctoken/$type_$did.metadata");
            $base64 = base64_encode($imagedata);
            $metadatastr = json_encode( $metadata);
            //var_dump($metadatastr );
            $data = array(
               "AssetName" => "$type_$did",
               "previewImageNft" => array (
                     "displayname" => "$type_$did",
                     "mimetype" => "image/png",
                     "fileFromBase64" => $base64,
               ),
               "metadata" => $metadataraw
            );
            $ch = curl_init();
            $payload = json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
   
            //var_dump( $payload  );
            curl_setopt($ch, CURLOPT_URL,"https://api.nft-maker.io/UploadNft/$policyId/$projectId");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload );
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   
            $result = curl_exec($ch);
            curl_close($ch);
            //var_dump($result);
            $jsonres =  json_decode($result, true);
            $nftUid = str_replace("-","",$jsonres['nftUid']);
            
         } catch (Excpetion $ex) {
   
         }
   }

}