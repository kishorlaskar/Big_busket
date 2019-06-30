<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
</head>
<body>

		<div id="app4">

           <ol>
           	  <li v-for="product in products">@{{product.product_name}}</li>
           </ol>
		</div>
</body>
<script type="text/javascript" src="{{url('js/app.js')}}"></script>

</html>