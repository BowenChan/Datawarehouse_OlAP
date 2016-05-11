
	<form method = "POST" id = 'cube' onclick = 'return submitForm()' action = ''>
		

		<button type = "button" id = "centralCube" href = "index.php"> Central Cube </button>
		<button type = "submit" name = "submitB" id = "rollUp" pressed = 'false' value = 'rollUp'> Roll Up </button>
			<input value = "HierarchyR" type = "radio" name = "rollUpB"> Hierarchy
			<input value = "DimensionR" type = "radio" name = "rollUpB"> Dimension

		<button type = "submit" name = "submitB" id = "drillDown" pressed ='false' value = 'drillDown' > Drill Down </button>
			<input value = "HierarchyD" type = "radio" name = "drillDownB"> Hierarchy
			<input value = "DimensionD" type = "radio" name = "drillDownB"> Dimension

		<button type = "submit" name = "submitB" pressed = 'false' id = "slice" value = 'slice'> Slice </button>

		<button type = "submit" name = "submitB" pressed = 'false' id = "dice" value = 'dice'> Dice </button>

	</form>

	<?php
	

		if(isset($_POST['submit']))
		{

		}
	?>
		<script>

		var time;
		var product;
		var store;
		var promotion;

		function setCentralCube(){
			time = ["date", "day_of_week", "day_number_in_month", "week_number_in_year", "week_number_overall","Month", "quarter", "fiscal_period", "year"];
			product = ["description", "full_description", "sku_number", "package_size", "brand", "subcategory", "category", "department", "package_type", "diet_type"];
			store = ["name", "store_number","store_street_address", "city", "store_county", "store_state", "store_zip","sales_district", "sales_region"];
			promotion = ["promotion_name","price_reduction_type","ad_type", "display_type", "coupon_type", "ad_media","display_provider"]
		}
		function submitForm(){
			
			var i;
			var j;
			var radios;
			var submitButtons = document.getElementsByName('submitB');
			
			for(i = 0; i < submitButtons.length;i++)
			{
				
				//alert(submitButtons[i].values.concast("  ").concat(submitButtons[i].pressed));
				if(submitButtons[i].pressed)
				{
					switch(submitButtons[i].id){
						case 'rollUp':
							radios = document.getElementsByName('rollUpB');
							for(j = 0; j < radios.length; j++)
							{
								if(radios[j].checked){
									document.getElementById('cube').action = 'rollup.php';
								}
							}
							resetPressed();
							return true;
						case 'drillDown':
							radios = document.getElementsByName('drillDownB');
							for(j = 0; j < radios.length; j++)
							{
								if(radios[j].checked){
									document.getElementById('cube').action = 'drilldown.php';
								}
							}
							resetPressed();
							return true;
						case 'slice':
							document.getElementById('cube').action = 'slice.php';
							resetPressed();
							return true;
						case 'dice':
							document.getElementById('cube').action = 'dice.php';
							resetPressed();
							return true;
						default :
							alert("This is not  valid");
							return false;
					}

				}
			}
			
		};

		function resetPressed(){
			var submitButtons = document.getElementsByName('submitB');
			var i;
			for(i = 0; i< submitButtons.length;i++){
				submitButtons[i].pressed ='false';
			}
		};
		document.getElementById("centralCube").onclick = function(){
			centralCube();
		};

		document.getElementById("rollUp").onclick = function(){
			document.getElementById('rollUp').pressed = true;
			document.getElementById('drillDown').pressed = false;
			document.getElementById('slice').pressed = false;
			document.getElementById('dice').pressed = false;
		};

		document.getElementById("drillDown").onclick = function(){
			document.getElementById('drillDown').pressed = true;
			document.getElementById('rollUp').pressed = false;
			document.getElementById('slice').pressed = false;
			document.getElementById('dice').pressed = false;
		};

		document.getElementById("slice").onclick = function(){
			document.getElementById('rollUp').pressed = false;
			document.getElementById('drillDown').pressed = false;
			document.getElementById('slice').pressed = true;
			document.getElementById('dice').pressed = false;

		}

		document.getElementById("dice").onclick = function(){
			document.getElementById('rollUp').pressed = false;
			document.getElementById('drillDown').pressed = false;
			document.getElementById('slice').pressed = false;
			document.getElementById('dice').pressed = true;
		}

		function centralCube() {
			alert("You have now accessed the Central Cube");
		}

	</script>