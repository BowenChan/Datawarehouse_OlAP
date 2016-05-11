<?php session_start();
#Setting the dynamic session variables
    $_SESSION['allAttributes'] = array("store", "product", "time", "promotion");
    $_SESSION['attributes'] = array("store", "product", "time");
    $_SESSION['time'] = 1;
    $_SESSION['product'] = 7;
    $_SESSION['store'] = 4;
    $_SESSION['promotion'] = 1;
    $_SESSION['timeArray'] = array("date", "day_of_week", "day_number_in_month", "week_number_in_year", "week_number_overall","Month", "quarter", "fiscal_period", "year");
    $_SESSION['productArray'] = array("description", "full_description", "sku_number", "package_size", "brand", "subcategory", "category", "department", "package_type", "diet_type");
    $_SESSION['storeArray'] = array("name", "store_number","store_street_address", "city", "store_county", "store_state", "store_zip","sales_district", "sales_region");
    $_SESSION['promotionArray'] = array("promotion_name","price_reduction_type","ad_type", "display_type", "coupon_type", "ad_media","display_provider");

    function createList($type, $name)
	{
		if($type === "drillDown"){
			$neededAttributes = iterateArray();
			foreach ($neededAttributes as $attr) {
				 if($_SESSION[lcfirst($attr)] - 1 < 0)
                    echo '<input type="submit" value="'. ucfirst($attr) .'" name="'.$name.'" disabled/>';
                else
                    echo '<input type="submit" value="'. ucfirst($attr) .'" name="'.$name.'"/>'; 
				
			}
		}
		else if($type === "rollUp"){
			foreach ($_SESSION['attributes'] as $attributes) {
                echo $_SESSION[lcfirst($attributes)];
                if($_SESSION[lcfirst($attributes)] + 1 > count($_SESSION[lcfirst($attributes."Array")]))
    	        	echo '<input type="submit" value="'. ucfirst($attributes) .'" name="'.$name.'" disabled/>';
                else
                    echo '<input type="submit" value="'. ucfirst($attributes) .'" name="'.$name.'"/>'; 
	    	}
		}
	};

	function iterateArray(){
		$newArray = array();
		foreach ($_SESSION['allAttributes'] as $attr) {
			if(!in_array($attr, $_SESSION['attributes']))
				array_push($newArray,$attr);
		}
		return $newArray;
	};

    function increaseHierarchy($sessionVar){
        //$sessionVar += 1;
        echo "Am I called";
    };

    function iterateAttributes($select){
        $length = count($_SESSION['attributes']);
        $i = 0;
        $string = "";
        foreach ($_SESSION['attributes'] as $attributes) {
            $array = $attributes."Array";
            print_r($_SESSION[$array][$_SESSION[$attributes]]);
            echo "<br>";
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
 ?>