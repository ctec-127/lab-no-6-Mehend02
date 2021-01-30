<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Lab No. 6 - Temp. Converter</title>
</head>

<body>

    <?php
    // function to calculate converted temperature
    function convertTemp($temp, $unit1, $unit2)
    {
        // conversion formulas
        // Celsius to Fahrenheit = T(°C) × 9/5 + 32
        // Celsius to Kelvin = T(°C) + 273.15
        // Fahrenheit to Celsius = (T(°F) - 32) × 5/9
        // Fahrenheit to Kelvin = (T(°F) + 459.67)× 5/9
        // Kelvin to Fahrenheit = T(K) × 9/5 - 459.67
        // Kelvin to Celsius = T(K) - 273.15

        // You need to develop the logic to convert the temperature based on the selections and input made

        if ($unit1 =='celsius' && $unit2 =='fahrenheit') {
            $convertedTemp = ($temp * (9 / 5) +32);
        } else if ($unit1 =='celsius' && $unit2 =='kelvin') {
            $convertedTemp = $temp + 273.15;
        } else if ($unit1 =='fahrenheit' && $unit2 =='celsius') {
            $convertedTemp = (($temp - 32) * 5/9);
        } else if ($unit1 =='fahrenheit' && $unit2 =='kelvin') {
            $convertedTemp = (($temp + 459.67) * 5/9);
        } else if ($unit1 =='kelvin' && $unit2 =='fahrenheit') {
            $convertedTemp = (($temp * (9/5)) - 459.67);
        } else if ($unit1 =='kelvin' && $unit2 =='celsius') {
            $convertedTemp = $temp - 273.15;
        } 
        return $convertedTemp;
    } // end function

    // Logic to check for POST and grab data from $_POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Store the original temp and units in variables
        // You can then use these variables to help you make the form sticky
        // then call the convertTemp() function
        // Once you have the converted temperature you can place PHP within the converttemp field using PHP
        // I coded the sticky code for the originaltemp field for you

        $originalTemperature = $_POST['originaltemp'];
        $originalUnit = $_POST['originalunit'];
        $conversionUnit = $_POST['conversionunit'];

        if (is_null($originalTemperature)) {
            echo "Please enter a temperature to convert.";
        } else if (!is_numeric($originalTemperature)){
            echo "Please enter a temperature in numeric format.";
        } else if ($originalUnit =="--Select--" || $conversionUnit == "--Select--"){
            echo "Both temperature units need to be selected.";
        } else if ($originalUnit == $conversionUnit) {
            echo "Please select a temperature unit for the conversion that is different than the original unit.";
        } else {
            $convertedTemp = convertTemp($originalTemperature, $originalUnit, $conversionUnit);
        }
    } else {
        $originalTemperature = null;
        $originalUnit = null;
        $conversionUnit = null;
    }
     // end if
    ?>
    <!-- Form starts here -->
    <h1>Temperature Converter</h1>
    <h4>CTEC 127 - PHP with SQL 1</h4>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
        <div class="group">
            <label for="temp">Temperature</label>
            <input type="text" value="<?php if (isset($_POST['originaltemp'])) {
                                            echo $_POST['originaltemp'];
                                        }
                                        ?>" name="originaltemp" size="14" maxlength="7" id="temp">

            <select name="originalunit">
                <option value="--Select--" <?= $originalUnit =='--Select--' ? "selected" : null ?>>--Select--</option>
                <option value="celsius" <?= $originalUnit =='celsius' ? "selected" : null ?>>Celsius</option>
                <option value="fahrenheit" <?= $originalUnit =='fahrenheit' ? "selected" : null ?>>Fahrenheit</option>
                <option value="kelvin" <?= $originalUnit =='kelvin' ? "selected" : null ?>>Kelvin</option>
            </select>
        </div>

        <div class="group">
            <label for="convertedtemp">Converted Temperature</label>
            <input type="text" value="<?php if(isset($convertedTemp)) {echo "$convertedTemp";}?>" name="convertedtemp" size="14" maxlength="7" id="convertedtemp" disabled>

            <select name="conversionunit">
                <option value="--Select--" <?= $conversionUnit == '--Select--' ? "selected": null ?>>--Select--</option>
                <option value="celsius" <?= $conversionUnit =='celsius' ? "selected" : null ?>>Celsius</option>
                <option value="fahrenheit" <?= $conversionUnit=='fahrenheit' ? "selected" : null ?>>Fahrenheit</option>
                <option value="kelvin" <?= $conversionUnit=='kelvin' ? "selected" : null ?>>Kelvin</option>
            </select>
        </div>
        <input type="submit" value="Convert" />
    </form>
</body>

</html>