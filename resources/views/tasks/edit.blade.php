@extends('base')
<style>
.header
{
  font-size: 32px;
}
</style>

@section('content')
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<center><h2 class="modal-title" id="exampleModalLongTitle">Játékos hozzáadása</h2></center>
						<form method="post">
							<div class="row">
								<div class="col-md-6">
									<center><p class="modalSzoveg">Zsákolás</p></center>
									<input class="form-control" type="text" name="input_zsakolas" placeholder="1 - 99" value="">
								</div>
								<div class="col-md-6">
									<center><p class="modalSzoveg">Ár</p></center>
									<input class="form-control" type="text" name="input_ar" placeholder="1 - 250 000" value="">
								</div>
								<div class="col-md-6">
									<center><p class="modalSzoveg">Kép</p></center>
									<input class="form-control" type="text" name="input_kep" placeholder="*.png vagy *.jpg" value="">
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