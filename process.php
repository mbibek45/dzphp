<?php
error_reporting(0);
$url = "http://localhost/cc/dz/";

$post = [
    'search' => $_POST['name']
];


$ch = curl_init($url.'search.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

// execute!
$response = curl_exec($ch);

// close the connection, release resources used
curl_close($ch);

//dd(json_decode($response));

//echo json_decode($response);

$gch = curl_init(json_decode($response));
curl_setopt($gch, CURLOPT_CUSTOMREQUEST, 'GET' );
curl_setopt($gch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($gch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($gch, CURLOPT_RETURNTRANSFER, true);

// execute!
$gres = curl_exec($gch);

// close the connection, release resources used
curl_close($gch);



if (count(json_decode($gres)->SuccessResponse->Body->Products)==0)
{
    echo "product not found";
}else {
    $daraz_product = json_decode($gres)->SuccessResponse->Body->Products[0];



    if (file_exists("myfile.xml"))
    {
        unlink("myfile.xml");
    }


    /* create a dom document with encoding utf8 */
    $domtree = new DOMDocument('1.0', 'UTF-8');

    /* create the root element of the xml tree */
    $xmlRoot = $domtree->createElement("xml");
    /* append it to the document created */
    $xmlRoot = $domtree->appendChild($xmlRoot);

    $currentTrack = $domtree->createElement("Product");
    $currentTrack = $xmlRoot->appendChild($currentTrack);

    /* you should enclose the following two lines in a cicle */
   $currentTrack->appendChild($domtree->createElement('PrimaryCategory', $daraz_product->PrimaryCategory));
    $currentTrack->appendChild($domtree->createElement('SPUId', ""));
    $attri = $currentTrack->appendChild($domtree->createElement('Attributes'));
    $att_daraz = $daraz_product->Attributes;
    $attri->appendChild($domtree->createElement('name', $att_daraz->name));
    $attri->appendChild($domtree->createElement('short_description', htmlentities($att_daraz->short_description)));
    $attri->appendChild($domtree->createElement('brand', $att_daraz->brand));
	if ($att_daraz->bras_types) {
        $attri->appendChild($domtree->createElement('bras_types', $att_daraz->bras_types));
    }

	if ($att_daraz->fa_pattern) {
        $attri->appendChild($domtree->createElement('fa_pattern', $att_daraz->fa_pattern));
    }

	if ($att_daraz->clothing_material) {
        $attri->appendChild($domtree->createElement('clothing_material', $att_daraz->clothing_material));
    }
    if ($att_daraz->model) {
        $attri->appendChild($domtree->createElement('model', ""));
    }
	if ($att_daraz->material_type) {
        $attri->appendChild($domtree->createElement('material_type', $att_daraz->material_type));
    }
	if ($att_daraz->earring_size) {
        $attri->appendChild($domtree->createElement('earring_size', $att_daraz->earring_size));
    }

	if ($att_daraz->closure_type) {
        $attri->appendChild($domtree->createElement('closure_type', $att_daraz->closure_type));
    }
	if ($att_daraz->dust_resistant) {
        $attri->appendChild($domtree->createElement('dust_resistant', $att_daraz->dust_resistant));
    }
	if ($att_daraz->lockable) {
        $attri->appendChild($domtree->createElement('lockable', $att_daraz->lockable));
    }
	if ($att_daraz->clothing_material) {
        $attri->appendChild($domtree->createElement('clothing_material', $att_daraz->clothing_material));
    }
	if ($att_daraz->bras_types) {
        $attri->appendChild($domtree->createElement('bras_types', $att_daraz->bras_types));
    }
	if ($att_daraz->compartment) {
        $attri->appendChild($domtree->createElement('compartment', $att_daraz->compartment));
    }
    if ($att_daraz->bluetooth)
    {
        $attri->appendChild($domtree->createElement('bluetooth', $att_daraz->bluetooth));
    }
    if ($att_daraz->wireless_connectivity)
    {
        $attri->appendChild($domtree->createElement('wireless_connectivity', $att_daraz->wireless_connectivity));
    }

    if ($att_daraz->cable_length)
    {
        $attri->appendChild($domtree->createElement('cable_length', $att_daraz->cable_length));
    }

    if ($att_daraz->compatible_devices)
    {
        $attri->appendChild($domtree->createElement('compatible_devices', $att_daraz->compatible_devices));
    }

    if ($att_daraz->warranty)
    {
        $attri->appendChild($domtree->createElement('warranty', $att_daraz->warranty));
    }

    if ($att_daraz->warranty_type)
    {
        $attri->appendChild($domtree->createElement('warranty_type', $att_daraz->warranty_type));
    }

    if ($att_daraz->Cable__Length)
    {
        $attri->appendChild($domtree->createElement('Cable__Length', $att_daraz->Cable__Length));
    }

    if ($att_daraz->connectivity)
    {
        $attri->appendChild($domtree->createElement('connectivity', $att_daraz->connectivity));
    }

    if ($att_daraz->mouse_type)
    {
        $attri->appendChild($domtree->createElement('mouse_type', $att_daraz->mouse_type));
    }

    if ($att_daraz->wattage)
    {
        $attri->appendChild($domtree->createElement('wattage', $att_daraz->wattage));
    }

    if ($att_daraz->charging_cable_included)
    {
        $attri->appendChild($domtree->createElement('charging_cable_included', $att_daraz->charging_cable_included));
    }

    if ($att_daraz->battery_capacity)
    {
        $attri->appendChild($domtree->createElement('battery_capacity', $att_daraz->battery_capacity));
    }

    if ($att_daraz->ports)
    {
        $attri->appendChild($domtree->createElement('ports', $att_daraz->ports));
    }

    if ($att_daraz->power_output)
    {
        $attri->appendChild($domtree->createElement('power_output', $att_daraz->power_output));
    }

    if ($att_daraz->multiple_usb_charging)
    {
        $attri->appendChild($domtree->createElement('multiple_usb_charging', $att_daraz->multiple_usb_charging));
    }

    if ($att_daraz->source)
    {
        $attri->appendChild($domtree->createElement('source', $att_daraz->source));
    }

    $skus = $currentTrack->appendChild($domtree->createElement('Skus'));

    $sku_daraz = $daraz_product->Skus;

    for($i=0; $i<count($sku_daraz); $i++ )
    {
        $sku = $skus->appendChild($domtree->createElement('Sku'));
        $sku->appendChild($domtree->createElement('SellerSku', $sku_daraz[$i]->SellerSku));
        if ($sku_daraz[$i]->_compatible_variation_)
        {
            $sku->appendChild($domtree->createElement('_compatible_variation_', $sku_daraz[$i]->_compatible_variation_));
        }

        if ($sku_daraz[$i]->package_content)
        {
            $sku->appendChild($domtree->createElement('package_content', $sku_daraz[$i]->package_content));
        }

        if ($sku_daraz[$i]->powerbank_capacity)
        {
            $sku->appendChild($domtree->createElement('powerbank_capacity', $sku_daraz[$i]->powerbank_capacity));
        }
        $sku->appendChild($domtree->createElement('color_family', $sku_daraz[$i]->color_family));
        $sku->appendChild($domtree->createElement('size', $sku_daraz[$i]->size));
        $sku->appendChild($domtree->createElement('quantity', $sku_daraz[$i]->quantity));
        $sku->appendChild($domtree->createElement('price', $sku_daraz[$i]->price));
        if ($sku_daraz[$i]->special_price!=0)
        {
            $sku->appendChild($domtree->createElement('special_price', $sku_daraz[$i]->special_price));

            $sku->appendChild($domtree->createElement('special_from_date', $sku_daraz[$i]->special_from_time));
            $sku->appendChild($domtree->createElement('special_to_date', $sku_daraz[$i]->special_to_time));
        }

        $sku->appendChild($domtree->createElement('package_height', $sku_daraz[$i]->package_height));
        $sku->appendChild($domtree->createElement('package_length', $sku_daraz[$i]->package_length));
        $sku->appendChild($domtree->createElement('package_width', $sku_daraz[$i]->package_width));
        $sku->appendChild($domtree->createElement('package_weight', $sku_daraz[$i]->package_weight));
        $image = $sku->appendChild($domtree->createElement('Images'));

        $image_daraz = $sku_daraz[$i]->Images;
        for ($j=0; $j<count($image_daraz); $j++)
        {
            $image->appendChild($domtree->createElement('Image', $image_daraz[$j]));
        }
    }

//echo $domtree->saveXML();


    /* get the xml printed */
    $domtree->save("myfile.xml");



    $cr = curl_init($url.'create.php?id='.$_POST['shop_id']);
    curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($cr, CURLOPT_POSTFIELDS, $post);

// execute!
    $cr_res = curl_exec($cr);

// close the connection, release resources used
    curl_close($cr);


    $lsend = "myfile.xml";

    $mno = curl_init(json_decode($cr_res));
    curl_setopt($mno, CURLOPT_CUSTOMREQUEST, 'POST' );
    curl_setopt($mno, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($mno, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($mno, CURLOPT_RETURNTRANSFER, true);
    curl_setopt( $mno, CURLOPT_PUT, 1 );
    curl_setopt( $mno, CURLOPT_HEADER, true);
    curl_setopt( $mno, CURLOPT_INFILESIZE, filesize($lsend) );

    curl_setopt( $mno, CURLOPT_INFILE, ($in=fopen($lsend, 'r')) );


// execute!
    $mres = curl_exec($mno);

// close the connection, release resources used
    curl_close($mno);

    echo $mres;

//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL,json_decode($cr_res));
//    curl_setopt($ch, CURLOPT_POST,1);
//    curl_setopt($ch, CURLOPT_POSTFIELDS, $lsend);
//    $result=curl_exec ($ch);
//    curl_close ($ch);
//
//    var_dump($result);
}
