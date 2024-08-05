<?php

error_reporting(E_ALL); // Report all PHP errors
ini_set('display_errors', 1); // Display errors on the web page
ini_set('display_startup_errors', 1); // Display startup errors

// Set the API URL and your authorization token
$url = "https://api-inference.huggingface.co/models/Intel/dynamic_tinybert";
$token = "XXXXXXXXXX"; 

// Initialize a cURL session
$ch = curl_init($url);

// Prepare the data to be sent
$data = array(
    "question"=> "Answer this user question in a single sentence like a customer support agent: Can you recommend a beauty product for someone with sensitive skin who is looking to reduce redness and irritation?", 
    "context"=> "1. CeraVe Hydrating Cleanser Type: Gentle Cleanser Key Ingredients: Ceramides, Hyaluronic Acid Benefits: Hydrates, Cleanses without stripping natural oils Free From: Fragrances, 
    Sulfates Suitable for: Sensitive skin 2. La Roche-Posay Toleriane Hydrating Gentle Cleanser Type: Gentle Cleanser Key Ingredients: Ceramide-3, Niacinamide, Glycerin Benefits: Hydrates, Soothes, 
    Restores skin barrier Free From: Fragrances, Parabens Suitable for: Sensitive skin 3. Vanicream Moisturizing Cream Type: Moisturizer Key Ingredients: Glycerin, Petrolatum Benefits: Deep hydration, 
    Soothes irritation Free From: Fragrances, Dyes, Lanolin, Parabens, Formaldehyde Suitable for: Sensitive skin 4. Avene Skin Recovery Cream Type: Moisturizer Key Ingredients: Avene Thermal Spring Water, 
    Parcerine Benefits: Calms, Protects, Restores skin barrier Free From: Fragrances, Preservatives, Parabens Suitable for: Hypersensitive and irritated skin 5. The Ordinary Niacinamide 10% + Zinc 1% Type: Serum 
    Key Ingredients: Niacinamide, Zinc PCA Benefits: Reduces redness, Regulates sebum production, Improves skin texture Free From: Fragrances, Silicones, Parabens Suitable for: All skin types, including sensitive skin."
);

// Convert the data to JSON format
$jsonData = json_encode($data);

// Set the cURL options
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json",
    "Authorization: Bearer " . $token
));

// Execute the cURL request and get the response
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    // Decode the JSON response
    $decodedResponse = json_decode($response, true);
    print_r($decodedResponse);
}

// Close the cURL session
curl_close($ch);
?>
