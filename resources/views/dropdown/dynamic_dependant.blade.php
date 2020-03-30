@extends('layouts/app')

@section('content')
<style type="text/css">
    .box {
        width:600px;
        margin: 0px auto;
        padding-top: 10px;
        padding-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
    }
</style>
<div class="container box">
    <h3 align="center">Ajax Dynamic Dependant Dropdown in Laravel</h3>
    <br>
    <div class="form-group">
        <select name="country" id="country" class="form-control input-lg dynamic" data-dependent="state">
            <option value="">Select Country</option>
            @foreach ($country_list as $country)
                <option value="{{ $country->country }}">{{ $country->country }}</option>
            @endforeach
        </select>
    </div>
    <br>
    <div class="form-group">
        <select name="state" id="state" class="form-control input-lg dynamic" data-dependent="city">
            <option value="">Select State</option>
        </select>
    </div>
    <br>
    <div class="form-group">
        <select name="city" id="city" class="form-control input-lg">
            <option value="">Select City</option>
        </select>
    </div>
    {{ csrf_field() }}
</div>


<script type="text/javascript">

    $(document).ready(function() {

        $('.dynamic').change(function() {
            if($(this).val() != '')
            {
                var select = $(this).attr("id");
                var value = $(this).val();
                var dependant = $(this).data('dependent');
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url:"{{ route('dynamicdependant.fetch') }}",
                    method:"POST",
                    data:{ select:select, value:value, dependant:dependant, _token:_token },
                    success:function(result) {
                        $('#'+ dependant).html(result);
                    }
                });
            }
        });

    })

</script>
@endsection
