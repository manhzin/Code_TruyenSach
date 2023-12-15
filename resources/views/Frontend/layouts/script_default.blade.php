<script src="{{ asset('assets/frontend/libs/js/jquery.min.js') }}">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('assets/frontend/libs/js/popper.min.js') }}">
</script>
<script src="{{ asset('assets/frontend/libs/js/bootstrap.min.js') }}">
</script>
{{-- <script src="{{ asset('assets/frontend/libs/js/swiper-bundle.min.js') }}">
</script> --}}
<script src="{{ asset(mix('assets/frontend/js/app.js')) }}">
</script>

<script>
    function themyeuthich(){
        var title = $('.btn-yeuthichtruyen').data('fa_title');
        var image = $('.btn-yeuthichtruyen').data('fa_image');
        var publisher_id = $('.btn-yeuthichtruyen').data('fa_publisher_id');
        var date_updated = $('.btn-yeuthichtruyen').data('fa_date_updated');
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:'{{route('themyeuthich')}}',
            method:"POST",
            data:{title:title, image:image, publisher_id:publisher_id,_token:_token},
            success:function(data){
                if(data=='Fail'){
                    alert('Truyện đã có trong yêu thích.');
                }
                alert('Thêm truyện yêu thích thành công.');
            }
        });
    }
</script>