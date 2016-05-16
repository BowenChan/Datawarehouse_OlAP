<?php
    include('dbconnect.php');
?>
<?php session_start();
	
#Setting the dynamic session variables
	function setSessions(){
	    $_SESSION['allAttributes'] = array("store", "product", "time", "promotion");
	    $_SESSION['attributes'] = array("store", "product", "time");
	    $_SESSION['currentSlice'] = array();
	    $_SESSION['time'] = 1;
	    $_SESSION['product'] = 7;
	    $_SESSION['store'] = 4;
	    $_SESSION['promotion'] = 1;
	    $_SESSION['timeArray'] = array("date", "day_of_week", "day_number_in_month", "week_number_in_year", "week_number_overall","month", "quarter", "fiscal_period", "year");
	    $_SESSION['productArray'] = array("description", "full_description", "sku_number", "package_size", "brand", "subcategory", "category", "department", "package_type", "diet_type");
	    $_SESSION['storeArray'] = array("name", "store_number","store_street_address", "city", "store_county", "store_state", "store_zip","sales_district", "sales_region");
	    $_SESSION['promotionArray'] = array("promotion_name","price_reduction_type","ad_type", "display_type", "coupon_type", "ad_media","display_provider");
	}


    function grabAllPossibleAttribute($attr){
    	
    	$sql = "select distinct " . $_SESSION[$attr."Array"][$_SESSION[$attr]] . " FROM " . ucfirst($attr);
    	return $sql;
    };

    function createList($type, $name)
	{
		echo '<div class = "inputs">';
		if($type === "drillDown"){
			$neededAttributes = iterateNeededArray();
			if($name === 'Dimension'){

				foreach ($neededAttributes as $attr) {
	                    echo '<input type="submit" value="'. ucfirst($attr) .'" name="'.$name.'"/>'; 					
				}
			}
			else
				foreach ($_SESSION['attributes'] as $attr){
					
					if($_SESSION[lcfirst($attr)] - 1 >=	0){
						echo '<input type="submit" value="'. ucfirst($attr) .'" name="'.$name.'" />';
					}
	                else
	                    echo '<input type="submit" value="'. ucfirst($attr) .'" name="'.$name.'"disabled="disabled"/>'; 
		    	}
		}
		else if($type === "rollUp"){
			foreach ($_SESSION['attributes'] as $attributes) {
               
                if($_SESSION[lcfirst($attributes)] + 1 >= count($_SESSION[lcfirst($attributes."Array")]) && $name === 'Hierarchy')
    	        	echo '<input type="submit" value="'. ucfirst($attributes) .'" name="'.$name.'" disabled="disabled"/>';
                else
                    echo '<input type="submit" value="'. ucfirst($attributes) .'" name="'.$name.'"/>'; 
	    	}
		}
		echo '</div>';
	};

	function createSliceList(){
        /*
		foreach ($_SESSION['attributes'] as $attr) {

            $sql = grabAllPossibleAttribute($attr);
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc())
            {
                buttonCreate($row[$_SESSION[$attr."Array"][$_SESSION[$attr]]]);
                echo "<br>";
            }
        }*/
        foreach ($_SESSION['attributes'] as $attrSlice) {
            $sqlSlice = grabAllPossibleAttribute($attrSlice);
            $resultSlice = $conn->query($sqlSlice);
            while($rowSlice = $resultSlice->fetch_assoc())
            {
                buttonCreate($attrSlice, $rowSlice[$_SESSION[$attrSlice."Array"][$_SESSION[$attrSlice]]]);
                //echo "<br>";
            }
        }
	};

	function createDiceList(){
			foreach ($_SESSION['attributes'] as $attributes) {
                $sql = grabAllPossibleAttribute($attr);
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()){
    				echo "<label>" . $attributes . ": " . "<input type = 'checkbox' name ='" . $attributes . "' value ='" .$row[$_SESSION[$attr."Array"][$_SESSION[$attr]]] . ">";
                }
			}
	}
	function retrieveFirstElements(){
		$returnArray = array();
		foreach ($_SESSION['currentSlice'] as $sliceVar) {
			array_push($returnArray, $sliceVar[0]);
			# code...
		}
		return $returnArray;
	}


	function buttonCreate($type, $attr){
		$sliceArray = retrieveFirstElements();
		

		if(!in_array($type, $sliceArray)) {
			echo '<input type ="submit" value="' .  ucfirst($type) . " | " . $attr  . '" name="slice">';
			# code...\
		}
		else
			if($attr === $_SESSION['currentSlice'][0][1])
				echo '<input type ="submit" value="' .  ucfirst($type) . " | " . $attr  . '" name="slice" disabled>';
			else
				echo '<input type ="submit" value="' .  ucfirst($type) . " | " . $attr  . '" name="slice">';
	
	};
	
	function iterateNeededArray(){
		$newArray = array();
		foreach ($_SESSION['allAttributes'] as $attr) {
			if(!in_array($attr, $_SESSION['attributes']))
				array_push($newArray,$attr);
		}
		return $newArray;
	};

    function increaseHierarchy($sessionVar){
        $_SESSION[$sessionVar] = $_SESSION[$sessionVar] + 1;
    };

    function decreaseHierarchy($sessionVar){
    	$_SESSION[$sessionVar] = $_SESSION[$sessionVar] - 1;
    };

    function iterateAttributes($select){
        $length = count($_SESSION['attributes']);
        $i = 0;
        $string = "";

        foreach ($_SESSION['attributes'] as $attributes) {
        	$array = $attributes."Array";
            if(++$i === $length && $select)
                $string  .= lcfirst($_SESSION[$array][$_SESSION[$attributes]]) .";";
            else
                $string .= lcfirst($_SESSION[$array][$_SESSION[$attributes]]) .", ";
        }
        return $string;
	};

    function displayTableAttributes($type, $data){

        foreach ($_SESSION['attributes'] as $attributes) {

            $array = $attributes."Array";

            if($type === "tr"){
                
                echo '<th>'. ucfirst($_SESSION[$array][$_SESSION[$attributes]]) .'</th>';
            }
            elseif ($type === "td"){
                echo '<td>' . $data[$_SESSION[$array][$_SESSION[$attributes]]] . '</td>';
                
            }
        }
        if($type === "tr")
            echo '<th> Dollar_Sales </th>';
        else if($type === "td")
            echo '<td>' . $data["Dollar_Sales"] . '</td>';
    };  

    function fromAndWhereClause($slice, $spliceKeyword){
    	$string = "";
    	$i = 0;
    	$sliceCounter = 0;
    	foreach ($_SESSION['attributes'] as $attr) {
    		if($attr === "promotion"){
	    		$string .= ucfirst($attr) . " ". substr(ucfirst($attr), 0, 2). ", ";	
    		}
    		else
	    		$string .= ucfirst($attr) . " ". substr(ucfirst($attr), 0, 1). ", ";
    	}
    	$string .= "SalesFact F Where ";
    	foreach ($_SESSION['attributes'] as $attr) {
    		if($attr === 'promotion'){
    			$firstLetter = substr(ucfirst($attr), 0, 2);
    		}
    		else
    			$firstLetter = substr(ucfirst($attr), 0, 1);

    		if(isset($_SESSION['currentSlice'][0][0]) && $_SESSION['currentSlice'][0][0] === 'promotion'){
    			$secondLetter = substr(ucfirst($_SESSION['currentSlice'][0][0]), 0, 2);
    		}
    		else if(isset($_SESSION['currentSlice'][0][0]))
    			$secondLetter = substr(ucfirst($_SESSION['currentSlice'][0][0]), 0, 1);

    		if(!$slice){
	    		if(++$i === count($_SESSION['attributes'])){
	    			
	    			$string .= $firstLetter . "." . $attr ."_key = F." .$attr . "_key ";
	    		}
				else
					$string .= $firstLetter . "." . $attr ."_key = F." .$attr . "_key AND ";
			}
			else
				if(++$sliceCounter === count($_SESSION['attributes'])){
					$arrayVar = $_SESSION['currentSlice'][0][0] . "Array";
					$string .= $firstLetter . "." . $attr ."_key = F." .$attr . "_key AND " . $secondLetter . "." . $_SESSION[$arrayVar][$_SESSION[$_SESSION['currentSlice'][0][0]]] . "='" . $spliceKeyword . "' ";
				}
				else 
					$string .= $firstLetter . "." . $attr ."_key = F." .$attr . "_key AND ";
				
				
    	}

    	return $string;

    }

    function FromAndWhereClauseDice($store, $time, $product, $promotion){
        $string = "";
        $j =  0;
        $varCounter = 0;
        $firstLetter = "";
        $checkCounter;
        $k = 0;

        foreach ($_SESSION['attributes'] as $attr) {
            if($attr === "promotion"){
                $string .= ucfirst($attr) . " ". substr(ucfirst($attr), 0, 2). ", ";    
            }
            else
                $string .= ucfirst($attr) . " ". substr(ucfirst($attr), 0, 1). ", ";
        }
        $string .= "SalesFact F Where ";
        foreach ($_SESSION['attributes'] as $attr) {
            if($attr === 'promotion'){
                $firstLetter = substr(ucfirst($attr), 0, 2);
            }        
            else
                $firstLetter = substr(ucfirst($attr), 0, 1);

            $string .= $firstLetter . "." . $attr ."_key = F." .$attr . "_key AND ";
        }
        foreach ($_SESSION['attributes'] as $attr) {
            if($$attr != null)
                $varCounter++;
        }

        foreach ($_SESSION['attributes'] as $attr) {

            if($attr === 'promotion'){
                $firstLetter = substr(ucfirst($attr), 0, 2);
            }
            else
                $firstLetter = substr(ucfirst($attr), 0, 1);

            $check = $$attr;
            $arrayVar = $attr . "Array";
            if($check != null){

                $checkCounter = count($check);
                $string .= "(";

                if(++$j === $varCounter)
                    foreach ($check as $diceKey) {
                        # code...
                        if(++$k === $checkCounter)
                            $string .=  $firstLetter . "." . $_SESSION[$arrayVar][$_SESSION[$attr]] . "='" . $diceKey . "') ";
                        else
                            $string .=  $firstLetter ."." . $_SESSION[$arrayVar][$_SESSION[$attr]] . "='" . $diceKey . "' OR ";
                    }
                   
                else
                    foreach ($check as $diceKey) {
                        # code...
                        if(++$k === $checkCounter)
                            $string .=  $firstLetter . "." . $_SESSION[$arrayVar][$_SESSION[$attr]] . "='" . $diceKey . "') AND ";
                        else
                            $string .=  $firstLetter . "." . $_SESSION[$arrayVar][$_SESSION[$attr]] . "='" . $diceKey . "' OR ";
                    }
                $k = 0;  
               
            }
            # code...
        }
        return $string;

    }
    function resetSlice(){
    	if(!empty($_SESSION['currentSlice']))
            unset($_SESSION['currentSlice'][0]);
    }
    function createSqlStatement($slice, $spliceKeyword){
    	
    	$sql = "select ";

    	$sql .= iterateAttributes(False) . " sum(dollar_sales) AS Dollar_Sales ";

    	$sql .= "From " . fromAndWhereClause($slice, $spliceKeyword);

    	$sql .= "Group By " . iterateAttributes(True);


    	return $sql;
    }
    function createSqlDiceStatement($store, $time, $product,$promotion){
        
        $sql = "select ";

        $sql .= iterateAttributes(False) . " sum(dollar_sales) AS Dollar_Sales ";

        $sql .= "From " . fromAndWhereClauseDice($store, $time, $product, $promotion);
        
        $sql .= "Group By " . iterateAttributes(True);


        return $sql;
    }
 ?>