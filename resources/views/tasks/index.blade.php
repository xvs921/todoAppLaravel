@extends('base')
<style>
.testimonials
{
	width: 100%;
	margin: 60px auto;
	display: grid;
	grid-template-columns: repeat( auto-fit, minmax(550px, 1fr));
	grid-gap: 5px;
}
.ready{
	--card-bg-color: green;
}
.todo{
	--card-bg-color: red;
}
.testimonials .card
{
	position: relative;
	width: 550px;
	margin: 0 auto;
	background: var(--card-bg-color);
	padding: 20px;
	box-sizing: border-box;
	text-align: center;
	box-shadow: 0 10px 40px rgba(0,0,0,.5);
	overflow: hidden;
	border-radius: 20px;
}
.testimonials .card .content .buttons
{
	display: flex;
	justify-content: space-between;
}
.testimonials .card .content h3
{
	font-size: 44px;
	line-height: 48px;
	color: #fff;
}
.testimonials .card .content p
{
	font-size: 32px;
	line-height: 36px;
	color: #fff;
}
.testimonials .card .content span
{
	color: #fff;
}
</style>
@section('content')
	<h1>{{ $title }}</h1>
    <div class='testimonials'>
    @foreach($tasks as $t)
		<div class="{{ $t->completedClassFind() }}">
			<div class="content" id="todo{{ $t->id }}">
				<div class="buttons">
					<form action="/tasks/{{ $t->id }}" method="POST">
						@method('DELETE')
						@csrf
						<button class="btn btn-danger btn-lg" input="submit"><i class="fa fa-trash"></i></button>
					</form>
						<button class="btn btn-info btn-lg" input="submit" value="{{ $t->id }}" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-pencil"></i></button>

					<form action="/tasks/{{ $t->id }}" method="POST">
						@method('PATCH')
						@csrf
						<button class="btn btn-light btn-lg" input="submit"><i class="{{ $t->isCompleted() }}"></i></button>
					</form>
				</div>
				<h3>{{ $t->title }}</h3>
				<p>{{ $t->description }}</p>
				<span>Last modify date: {{ $t->updated_at }}</span>
            </div>
		</div>
    @endforeach
    </div>

	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<center><h2 class="modal-title" id="exampleModalLongTitle">Játékos hozzáadása</h2></center>
						<form method="post">
							<div class="row">
								<div class="col-md-6">
									<center><p class="modalSzoveg">Név</p></center>
									<input class="form-control" type="text" name="input_nev" placeholder="név" value="<?php echo $_SESSION["felv_nev"]; ?>">
								</div>
								<div class="col-md-6">
									<center><p class="modalSzoveg">Összpontszám</p></center>
									<input class="form-control" type="text" name="input_osszPontszam" placeholder="1 - 99" value="<?php echo $_SESSION["felv_osszPontszam"]; ?>">
								</div>
								<div class="col-md-6">
									<center><p class="modalSzoveg">Hárompontos</p></center>
									<input class="form-control" type="text" name="input_3pontos" placeholder="1 - 99" value="<?php echo $_SESSION["felv_3pontos"]; ?>">
								</div>
								<div class="col-md-6">
									<center><p class="modalSzoveg">Zsákolás</p></center>
									<input class="form-control" type="text" name="input_zsakolas" placeholder="1 - 99" value="<?php echo $_SESSION["felv_zsakolas"]; ?>">
								</div>
								<div class="col-md-6">
									<center><p class="modalSzoveg">Ár</p></center>
									<input class="form-control" type="text" name="input_ar" placeholder="1 - 250 000" value="<?php echo $_SESSION["felv_ar"]; ?>">
								</div>
								<div class="col-md-6">
									<center><p class="modalSzoveg">Kép</p></center>
									<input class="form-control" type="text" name="input_kep" placeholder="*.png vagy *.jpg" value="<?php echo $_SESSION["felv_kep"]; ?>">
								</div>
							</div>
							<center><p class="modalSzoveg">Minden adat kitöltése kötelező!</p></center>
							<center><p class="modalSzoveg">A pontszámok 1 és 99 között kell legyenek!</p></center>
							<input type="hidden" name="action" value="btnFelvetel">
							<div style="text-align:right"><input type="submit" class="btn btn-primary" value="Felvétel" id="loginbtn"></div>
						</form>
					</div>
				</div>
			</div>
		</div>  
@endsection