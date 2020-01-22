<aside class="main-sidebar">

	<section class="sidebar">
	
		<ul class="sidebar-menu">
			
		<?php

		if($_SESSION["perfil"] == "Administrador"){

		echo '<li class="active">
				<a href="inicio">
					<i class="fa fa-home"></i>
					<span>Inicio</span>
				</a> 
			</li>

			<li>
				<a href="usuarios">
					<i class="fa fa-user"></i>
					<span>Usuarios</span>
				</a> 
			</li>';

		}

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial"){

		echo '<li>
				<a href="categorias">
					<i class="fa fa-th"></i>
					<span>Categorías</span>
				</a> 
			</li>

			<li>
				<a href="productos">
					<i class="fa fa-product-hunt"></i>
					<span>Productos</span>
				</a> 
			</li>';

		}

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor" || $_SESSION["perfil"] == "Especial"){

		echo '<li>
				<a href="clientes">
					<i class="fa fa-users"></i>
					<span>Clientes</span>
				</a> 
			</li>

			<li>
				<a href="reporte">
					<i class="fa fa-file-text-o"></i>
					<span>Reporte Diario</span>
				</a> 
			</li>

			<li>
				<a href="entradas">
					<i class="fa fa-arrow-circle-down "></i>
					<span>Entrada De Producto</span>
				</a> 
			</li>

			<li>
				<a href="translados">
					<i class="fa fa-exchange"></i>
					<span>Translado de Material</span>
				</a> 
			</li>
	
			<li>
				<a href="cotizaciones">
					<i class="fa fa-book"></i>
					<span>Cotizaciones</span>
				</a> 
			</li>

			<li>
				<a href="pagos">
					<i class="fa fa-usd"></i>
					<span>Pagos</span>
				</a> 
			</li>';

		}

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor" || $_SESSION["perfil"] == "Especial"){

		echo '<li class="treeview">
				<a href="">
					<i class="fa fa-list-ul"></i>

					<span>Ventas</span>
					<span class="pull-right-container">
						
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>

				<ul class="treeview-menu">
					<li>
						<a href="ventas">
						
							<i class="fa fa-circle-o"></i>
							<span>Administrar Ventas</span>

						</a>
					</li>

					<li>
						<a href="crear-venta">
						
							<i class="fa fa-circle-o"></i>
							<span>Crear Venta</span>

						</a>
					</li>

					<li>
						<a href="crear-cotizacion">
						
							<i class="fa fa-circle-o"></i>
							<span>Crear Cotización</span>

						</a>
					</li>';

					if($_SESSION["perfil"] == "Administrador"){

				echo '<li>
						<a href="reportes">
						
							<i class="fa fa-circle-o"></i>
							<span>Reporte de Ventas</span>

						</a>
					</li>';

					}

				echo '</ul>
			</li>';
			}

		?>

		</ul>	
	</section>
</aside>