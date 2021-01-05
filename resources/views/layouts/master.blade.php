
<!DOCTYPE html>
<html>
<head>
	<title>Alan Resto</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link href="{{url('css/metro-all.css?ver=@@b-version')}}" rel="stylesheet">
</head>
<body>
	<div>
		<div class="head-bar pos-absolute fg-white" style="background-color: #00ACEE;">
			<div class="container">
				<span class="app-title">Alan Resto</span>
			</div>
		</div>
		<div class="container">
			<ul data-app-bar="true" data-role="materialtabs" data-deep="true" data-cls-tab-active="text-bold fg-blue" data-cls-marker="bg-blue" style="margin-left: 0;padding-left: 0">
				<li {!!$tab=='transaksi'?'':'class="active"'!!}><a href="#food">Food</a></li>
				<li {!!$tab=='transaksi'?'class="active"':''!!}><a href="#transaksi">Transaksi</a></li>
			</ul>
			<div style="margin-top: 50px;">
				<div id="food">
					<div id="section_add_food" style="display: none;">
						<div style="padding:5px 0;">&nbsp;</div>
						<div class="card" style="padding: 0;margin: 0;">
							<div class="card-content p-5">
								<h5 class="fg-blue">Tambahkan Menu</h5>
								<form method="POST" action="{{url('add_menu')}}" enctype="multipart/form-data">
									{{csrf_field()}}
									<div class="form-group">
										<label for="name">Nama Menu</label>
										<input type="text" data-role="input" name="name">
									</div>
									<div class="form-group">
										<label for="image_url">Foto</label>
										<input type="file" data-role="file" data-mode="drop" name="image_url">
									</div>
									<div class="form-group">
										<label for="price">Harga</label>
										<input data-prepend="Rp" type="text" data-role="input" name="price">
									</div>
									<br>
									<input type="submit" class="button success" value="Simpan">
								</form>
							</div>
						</div>
					</div>
					<div id="section_food">
						<div style="padding:20px 0;">Tambahkan menu makanan yang ada di resto</div>
						<div class="card" style="padding: 0;margin: 0;">
							<div class="card-content p-5">
								<button class="button primary" onclick="add_menu()">+ Tambah Menu</button>
								<table class="table striped">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th>Nama</th>
											<th class="text-center">Foto</th>
											<th>Harga</th>
										</tr>
									</thead>
									<tbody>
										@foreach($food as $key => $val)
										<tr>
											<td class="text-center">{{++$key}}</td>
											<td>{{$val->name}}</td>
											<td class="text-center"><img src="{{Storage::url($val->image_url)}}" style="width: 100px;"></td>
											<td>Rp. {{number_format($val->price,0,"",".")}}</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div id="transaksi">
					<div class="grid">
						<div class="row">
							<div class="cell-7">
								<div class="row">
									@foreach($food as $key => $val)
									<a  class="cell-4" style="text-decoration: none;" href="{{url('add_temp/'.$val->id)}}"><div>
										<div class="card image-header">
											<div class="card-header fg-white"
											style="background-image: url({{Storage::url($val->image_url)}})"></div>
											<div class="card-content p-2 text-center">
												<b>{{$val->name}}</b><br>
												<span class="fg-blue">Rp. {{number_format($val->price,0,"",".")}}</span>
											</div>
										</div>
									</div></a>
									@endforeach
								</div>
							</div>
							<div class="cell-3">
								<h3 class="text-center">Pesanan</h3>

								<table class="table striped">
									<tbody>
										@foreach($temp_transaction as $key => $val)
										<tr>
											<td class="text-center"><img src="{{Storage::url($val->food->image_url)}}" style="width: 50px;"></td>
											<td>{{$val->food->name}}</td>
											<td>x {{$val->quantity}}</td>
											<td>Rp. {{number_format($val->total,0,"",".")}}</td>
										</tr>
										@endforeach
									</tbody>
								</table>
								<button class="button alert cell-12">Clear Cart</button>
								<div class="row">
									<div class="cell">
										<button class="button success cell-12">Save Bill</button>
									</div>
									<div class="cell">
										<button class="button success cell-12">Print Bill</button>
									</div>
								</div>
								<button class="button primary cell-12">Charge Rp. {{number_format($temp_transaction->sum('total'),0,"",".")}}</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="{{url('js/metro.js?ver=@@b-version')}}"></script>
<script src="{{url('js/jquery-3.4.1.min.js')}}"></script>
<script type="text/javascript">
	function add_menu() {
		$("#section_food").hide();
		$("#section_add_food").show();
	}
</script>
</html>