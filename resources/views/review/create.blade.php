<div class="col-md-6 reveal">
	<div class="reveal" id="product-review-modal" data-reveal>
		<div>
			<form action="{{route('review.store')}}" method="get" role="form">
				{{csrf_field()}}
				<legend> Rate for this car </legend>

				<div class="form-group">
					<label for=""> Rate It </label>
					<input type="text" class="form-control" name="rating" id="" placeholder="Input...">
				</div>

				<div class="form-group">
					<label for=""> Why this rating? </label>
					<input type="text" class="form-control" name="rating" id="" placeholder="Input...">
				</div>
				<input type="submit" class="btn btn-danger" name="" value="VOTE">
			</form>
		</div>
	</div>
</div>