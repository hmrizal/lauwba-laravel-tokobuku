{{-- <div class="bg-gray tab-content" id="nav-tabContent"> --}}
{{-- <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab"> --}}
<style>
    .star-rating {
        color: gray;
        /* Set color to gold/yellow */
    }

    .rating-star {
        font-size: 20px;
        margin-right: 5px;
    }

    .star-rating .active {
        color: gold;
        /* Set color to gold/yellow for active stars */
    }
</style>
<div class="add-review margin-small">
    <h3>Add a review</h3>
    <p>Required fields are marked *</p>
    <form id="form" action="/book-detail/ulasan/store/{{ $dasar->id_buku }}" method="POST">
        @csrf
        <div class="py-3">
            <input type="hidden" name="id_buku" value="{{ $dasar->id_buku }}">
        </div>
        <div class="py-3">
            <label>Your Rating *</label>
            <div class="star-rating">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="rating-star fa fa-star" id="rating-{{ $i }}" name="rating"
                        aria-valuenow="{{ $i }}"></i>
                @endfor
            </div>
            <input type="hidden" name="rating" id="selected-rating" value="{{ $i }}" required>
        </div>
        <div class="py-3">
            <label>Your Name</label>
            <input type="text" name="name" class="w-100" value="{{ Auth::user()->name }}" disabled readonly>
        </div>
        <div class="py-3">
            <label>Your Review</label>
            <textarea placeholder="Write your review here" class="w-100" cols=50 rows=10 name="ulasan"></textarea>
        </div>
        <label class="py-3">
            <input type="checkbox" required="" class="d-inline">
            <span>Save my name, email, and website in this browser for the next time.</span>
        </label>
        <button type="submit" name="submit" class="btn btn-dark w-100 my-3">Submit</button>
    </form>
</div>
<!-- JavaScript for Star Rating in Review Form -->
<script>
    $(document).ready(function() {
        $('.rating-star').on('click', function() {
            var selectedRating = $(this).val('rating');
            // console.log(selectedRating[0].ariaValueNow);
            var data = selectedRating[0].ariaValueNow;
            $('#selected-rating').val(data);

            // Toggle active class for clicked star and previous stars
            $('.rating-star').removeClass('active');
            for (var i = 1; i <= 5; i++) {
                if (i <= data) {
                    $('#rating-' + i).addClass('active');
                }
            }
        });
    });
</script>
{{-- </div> --}}
{{-- </div> --}}
