
	<form method = "POST" id = 'cube' onclick = 'return submitForm()' action = ''>
		
		<button type = "button" id = "centralCube" action = "./"> Central Cube </button>

		<button type = "submit" name = "submitB" id = "rollUp" pressed = 'false' value = 'rollUp'> Roll Up </button>
			<input value = "HierarchyR" type = "radio" name = "rollUpB"> Hierarchy
			<input value = "DimensionR" type = "radio" name = "rollUpB"> Dimension

		<button type = "submit" name = "submitB" id = "drillDown" pressed ='false' value = 'drillDown' > Drill Down </button>
			<input value = "HierarchyD" type = "radio" name = "drillDownB"> Hierarchy
			<input value = "DimensionD" type = "radio" name = "drillDownB"> Dimension

		<button type = "button" id = "slice"> Slice </button>

		<button type = "button" id = "dice"> Dice </button>

	</form>

	<?php
		if(isset($_POST['submit']))
		{

		}
	?>
		<script>

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
		};

		document.getElementById("drillDown").onclick = function(){
			document.getElementById('drillDown').pressed = true;
			document.getElementById('rollUp').pressed = false;
		};

		document.getElementById("slice").onclick = function(){
			slice();
		}

		document.getElementById("dice").onclick = function(){
			dice();
		}

		function centralCube() {
			alert("You have now accessed the Central Cube");
		}

		function rollUp(word){
			alert("You are rolling up by ".concat(word));
		}

		function drillDown(word){
			alert("You are drilling down by ".concat(word));
		}

		function slice(){
			alert("You are slicing");
		}

		function dice(){
			alert("You are dicing");
		}
	</script>