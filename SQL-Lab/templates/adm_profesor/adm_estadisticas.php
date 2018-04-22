<div class="adm-estadisticas"> 
	
	<div class="row ">
		<div class="col-md-11 jumbotron-propio ">
			
			<h3>Estadísticas</h3>
			<p class="pl-5">Muestra las estadísticas....</p>
			<div class="hrr"></div>

			<canvas id="bar-chart-horizontal" width="800" height="250"></canvas>

			<script>
			new Chart(document.getElementById("bar-chart-horizontal"), {
				    type: 'horizontalBar',
				    data: {
				      labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
				      datasets: [
				        {
				          label: "Population (millions)",
				          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
				          data: [2478,5267,734,784,433]
				        }
				      ]
				    },
				    options: {
				      legend: { display: false },
				      title: {
				        display: true,
				        text: 'Predicted world population (millions) in 2050'
			      		}
			    	}
				});

			</script>

		</div>
	</div>

</div>

